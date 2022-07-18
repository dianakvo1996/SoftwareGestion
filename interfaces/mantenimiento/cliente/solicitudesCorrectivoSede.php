<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/solicitudCorrectivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/RespuestaSolicitud.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

//Inicio filtro busqueda
$filtro='';
$filDescarga='';
$mas='';
$condicion=null;
if (isset($_POST['filtro'])) {
    $filDescarga=$_POST['filtro'];
    switch ($_POST['filtro']) {
        case 'P':
                $condicion=" estado='P' and ";
                $mas='Pendientes';
        break;
        case 'R':            
            $condicion=" estado='R' and ";
            $mas='Ejecutadas';
        break;
        case 'T':
            $condicion=null;
            $mas='';
        break;
    }
}
$condicionAdicional='';
if (isset($_POST['mesAño'])) {
    $fechaDividida= explode('-', $_POST['mesAño']);
    $numeroDias= cal_days_in_month(CAL_GREGORIAN, $fechaDividida[1], $fechaDividida[0]);
    $condicionAdicional="and fecha between '".$_POST['mesAño']."-1' and '".$_POST['mesAño']."-".$numeroDias."'";
   
}
//Fin filtro busqueda
$promedio= RespuestaSolicitud::getCalcularPromedioGeneral("solicitudcorrectivo.ideSede={$ideSede}");

$sede=new Sede('ide', $ideSede);
$datos=solicitudCorrectivo::getConsultaTablaCombinada($condicion." ideSede={$sede->getIde()} ".$condicionAdicional,'fecha desc');
$lista='';
$estado='';
$falta='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $respuesta=new RespuestaSolicitud('ideSolicitud', $objeto->getIde());
    switch ($respuesta->getEstado()) {
        case 'R':
            $estado="<a href='principal.php?CONTENIDO=mantenimiento/cliente/visualizacionSolicitud_1.php&ideSolicitud={$objeto->getIde()}' style='background:#61F955;color:#000' class='enlace'>Ejecutado</a>";
            break;
        case 'P':
            $estado="<a href='principal.php?CONTENIDO=mantenimiento/cliente/visualizacionSolicitud_1.php&ideSolicitud={$objeto->getIde()}' style='background:#E34321;color:#fff' class='enlace'>Pendiente</a>";
            break;
        case 'E':
            $estado="<a href='principal.php?CONTENIDO=mantenimiento/cliente/visualizacionSolicitud_1.php&ideSolicitud={$objeto->getIde()}' style='background:#3230C4;color:#fff' class='enlace'>En Proceso</a>";
            break;
    }
    $lista.='<tr>';
    $lista.="<td>{$objeto->getMostrarFecha()}</td>";
	if($objeto->getIdeEquipo()!=null){
		$lista.="<td>{$objeto->getEquipo()->getNombreEquipo()}</td>";
    	$lista.="<td>{$objeto->getEquipo()->getActivoFijo()}</td>";
	}else{
		$lista.="<td>{$objeto->getEquipoDeBaja()->getNombreEquipo()}</td>";
    	$lista.="<td>{$objeto->getEquipoDeBaja()->getActivoFijo()}</td>";
	}

    $lista.="<td>{$objeto->getSolicitante()}</td>";
    $lista.="<td style='width:100px'>{$objeto->getDetalle()}</td>";
	$lista.="<td>{$respuesta->getCalcularTiempoRespuesta($objeto->getFecha(),$respuesta->getFechaRealizacion())}</td>";
    $lista.="<td>{$estado}</td>";
    $lista.='</tr>';
}
if ($lista=='')$falta='<h2>Sin Solicitudes '.$mas.'</h2>';
?>
<a href="principal.php?CONTENIDO=mantenimiento/cliente/seleccionSede.php" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="30px"></a>
<div id="listados">
    <img src="../presentacion/iconos/solicitudesSalida.png" height="100px">
    <br>
    <form method="POST">
    <table>
        <tr>
            <th style="width: 5%">Cliente</th>
            <td><?=$sede->getCliente()->getNombre()?></td>
            <th style="width: 5%">Sede</th>
            <td><?=$sede->getNombre()?></td>
            <td>
                <a href="mantenimiento/cliente/descargarConsolidadoSedeExcel.php?filtro=<?=$filDescarga?>&ideSede=<?=$sede->getIde()?>&condicionAdicional=<?=$condicionAdicional?>" class="enlace">Descargar Excel</a>
            </td>
        </tr>
        <tr>
            <td colspan="2">                
                <input type="radio" value="T" id="T" name="filtro"><label for="T">Todos</label>
                <input type="radio" value="P" id="P" name="filtro"><label for="P">Pendientes</label>
                <input type="radio" value="R" id="R" name="filtro"><label for="R">Ejecutados</label>               
            </td>
            <td colspan="2">
                <input type="month" name="mesAño" value="<?= date('Y-m')?>" max="<?= date('Y-m')?>">
            </td>
            <td>
                <input type="submit" value="Filtrar" class="enlace">
            </td>
        </tr>
		<tr>
			<th colspan="2">Promedio tiempo de respuesta</th><td colspan="2"><?=$promedio?></td>
		</tr>
    </table>
    </form>
	<label style="color:red">Pendiente █ </label><label style="color:#3230C4"> En Proceso █ </label><label style="color:#61F955">Ejecutado █</label>
    <table>
        <tr>
            <th style="width: 10%">Fecha</th>
            <th>Equipo</th>
            <th>Activo Fijo</th>
            <th>Solicitante</th>
            <th>Detalle</th>
            <th>Tiempo Respuesta</th>
            <th>Estado</th>
        </tr>
        <?=$lista?>
    </table> 
    <?=$falta?>
</div>
