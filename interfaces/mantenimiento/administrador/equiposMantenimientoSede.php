<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ReportePreventivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/MantenimientoPreventivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/FirmaSatisfaccion.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$mantenimiento=new MantenimientoPreventivo('ide', $ide);
$reporte=new ReportePreventivo('ideMantenimientoPreventivo', $mantenimiento->getIde());
$equipos= Equipo::getDatosEnObjetos("ideSede={$mantenimiento->getIdeSede()}", 'ubicacion,nombreequipo asc');
$lista='';
$item=1;
$columnaExtra="<th style='width:40px'></th>";
for ($i = 0; $i < count($equipos); $i++) {
    $objeto=$equipos[$i];
    $lista.='<tr>';
    $lista.="<td>{$item}</td>";
    $lista.="<td>{$objeto->getActivoFijo()}</td>";
    $lista.="<td>{$objeto->getNombreEquipo()}</td>";
    $lista.="<td>{$objeto->getMarca()}</td>";
    $lista.="<td>{$objeto->getModelo()}</td>";
    $lista.="<td>{$objeto->getSerial()}</td>";
    $lista.="<td>{$objeto->getUbicacion()}</td>";
    $numeroReporte= ReportePreventivo::getBuscarReporte($mantenimiento->getIde(), $objeto->getIde());
    if ($numeroReporte){
		$lista.="<td><a href='mantenimiento/administrador/verReportePreventivo.php?numeroReporte={$numeroReporte}' style='background:#0C5808;color:#fff' class='enlace'>Ver Reporte</a></td>";
		$firma=new FirmaSatisfaccion('numReporte',$numeroReporte);
		if($firma->getIde()==null){
		    $lista.="<td><input type='checkbox' id='firmaChk' name='firmar{$item}' value='{$numeroReporte}'></td>";
			$columnaExtra="<th style='width:40px' onclick='seleccionarTodos()'><input type='checkbox' id='ST' name='selectTodos'></th>";
		}else{
			$lista.='<td></td>';
		}
	}else{
        $lista.="<td><a href='principal.php?CONTENIDO=mantenimiento/administrador/reporteMantenimientoPreventivo.php&ideMantenimiento={$mantenimiento->getIde()}&ideEquipo={$objeto->getIde()}&accion=Guardar' style='background:#C8C52B' class='enlace'>Generar Reporte</a></td>";
    	$lista.="<td></td>";
	}
    $lista.='</tr>';
    $item++;
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/mantenimientoPreventivoSede.php&ideSede=<?=$mantenimiento->getIdeSede()?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="listados">
    <h2>Reportes Mantenimiento Preventivo</h2>
    <table>
        <tr>
            <th>Cliente:</th>
            <td><?=$mantenimiento->getSede()->getCliente()->getNombre()?></td>
            <th>Sede:</th>
            <td><?=$mantenimiento->getSede()->getNombre()?></td>
        </tr>
        <tr>
            <th>Fecha Mantenimiento</th>
            <td colspan="2"><?=$mantenimiento->getMostarFecha()?></td>
			<th></th>
        </tr>
    </table>
<form name="f1" action="principal.php?CONTENIDO=mantenimiento/administrador/firmaSatisfaccionForm.php" method="post">
    <table>
		<tr>
			<td colspan="7"></td>
			<th colspan="2"><input type="submit" value="Firmar" id="submitBoton" class="enlace"></th>
		</tr>
        <tr>
            <th colspan="2">ACTIVO FIJO</th>
            <th>EQUIPO</th>
            <th>MARCA</th>
            <th>MODELO</th>
            <th>SERIE</th>
            <th>UBICACIÓN</th>
            <th><a href="mantenimiento/administrador/exMantenimientoPreventivo.php?ide=<?=$ide?>">Exportar Lista</a></th>
			<?=$columnaExtra?>
        </tr>
        <?=$lista?>
    </table>
</div>
<input type="hidden" name="numReportes" value="<?=count($equipos)?>">
<input type="hidden" name="ideMantenimiento" value="<?=$ide?>">
</form>
<script>
	window.onload = showSubmit();
	
	function showSubmit(){
		var contar= 0;
		for (i=0;i<document.f1.elements.length;i++){
      		if(document.f1.elements[i].type == "checkbox"){
         		contar++;
			}
		}
		if(contar==0) document.getElementById("submitBoton").style.display="none";
	}
	function seleccionarTodos(){
		var isChecked = document.getElementById('ST').checked;
		if(isChecked){
  			for (i=0;i<document.f1.elements.length;i++){
      			if(document.f1.elements[i].type == "checkbox"){
         			document.f1.elements[i].checked = 1;
				}
			}
		}else{
			for (i=0;i<document.f1.elements.length;i++){
      			if(document.f1.elements[i].type == "checkbox"){
         			document.f1.elements[i].checked = 0;
				}
			}
		}
	}
</script>