<?php

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ReportePreventivoPDF.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/MantenimientoPreventivo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$mantenimiento=new MantenimientoPreventivo('ide', $ide);
$reporte=new ReportePreventivoPDF('ideMantenimientoPreventivo', $mantenimiento->getIde());
$equipos= Equipo::getDatosEnObjetos("nitCliente='{$mantenimiento->getNitCliente()}'", 'ubicacion,nombreequipo asc');
$lista='';
$item=1;
for($i = 0; $i < count($equipos); $i++){
	$objeto = $equipos[$i];
	$lista.='<tr>';
	$lista.="<td>{$item}</td>";
    $lista.="<td>{$objeto->getActivoFijo()}</td>";
    $lista.="<td>{$objeto->getNombreEquipo()}</td>";
    $lista.="<td>{$objeto->getMarca()}</td>";
    $lista.="<td>{$objeto->getModelo()}</td>";
    $lista.="<td>{$objeto->getSerial()}</td>";
    $lista.="<td>{$objeto->getUbicacion()}</td>";
	$ideReporte=$reporte->getBuscarReporte($mantenimiento->getIde(),$objeto->getIde());
	if($ideReporte==null){
		$lista.="<td><a href='principal.php?CONTENIDO=mantenimiento/administrador/equiposMantenimientoClientePDF.php&ide={$ide}&accion=Subir&ideEq={$objeto->getIde()}#formulario' class='enlace' style='background:#C8C52B'>Subir Reporte</a></td>";
	}else{
		$reportePreventivoPDF = new ReportePreventivoPDF('ide',$ideReporte);
		$lista.="<td><a href='../ReportePreventivosPDF/{$reportePreventivoPDF->getArchivo()}' target='_blank' style='background:#0C5808;color:#fff' class='enlace'>Ver Reporte</a></td>";
	}
	$lista.='</tr>';
$item++;
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/mantenimientoPreventivoCliente.php&nitCliente=<?=$mantenimiento->getNitCliente()?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="listados">
	<h2>Reportes mantenimiento Preventivo</h2>
	<table>
        <tr>
            <th>Cliente:</th>
            <td><?=$mantenimiento->getCliente()->getNombre()?></td>
        </tr>
        <tr>
            <th>Fecha Mantenimiento</th>
            <td><?=$mantenimiento->getMostarFecha()?></td>
        </tr>
    </table>

	<table>
        <tr>
            <th colspan="2">ACTIVO FIJO</th>
            <th>EQUIPO</th>
            <th>MARCA</th>
            <th>MODELO</th>
            <th>SERIE</th>
            <th>UBICACIÓN</th>
            <th></th>
        </tr>
        <?=$lista?>
    </table>
</div>

<div id="formulario" class="modalDialog">
    <div>
        <a href="#close" title="Cerrar" class="close">X</a>
        <div id="formulario">
			<?php
				$equipo=new Equipo('ide',$ideEq);
			?>
              <form method="POST" action="mantenimiento/administrador/reportePreventivoPDFActualizar.php"  enctype="multipart/form-data">
                <center>
                    <br>
                    <table>
                        <tr>
                            <th colspan="2"><?=strtoupper($accion)?> REPORTE PREVENTIVO</th>
                        </tr>
                        <tr>
                            <th>INFORMACION EQUIPO</th>
                            <td>
								<strong>Equipo:</strong><?=$equipo->getNombreEquipo()?></br>
								<strong>Activo Fijo:</strong><?=$equipo->getActivoFijo()?></br>
								<strong>Serie:</strong><?=$equipo->getSerial()?></br>
							</td>
                        </tr>

                        <tr>
                            <th>REPORTE</th>
                            <td><input type="file" name="reporte" accept="image/*,.pdf" required="true"></td>
                        </tr>
                        <tr>
                            <th colspan="2"> 
								<input type="hidden" name="ideEquipo" value="<?=$equipo->getIde()?>">
								<input type="hidden" name="ideMantenimiento" value="<?=$ide?>">
								<input type="hidden" name="fecha" value="<?=$mantenimiento->getFecha()?>">
                            	<input type="submit" value="<?=$accion?>" name="accion">
                            </th>
                        </tr>
                    </table>
                </center>
            </form>
        </div>
    </div>
</div>
