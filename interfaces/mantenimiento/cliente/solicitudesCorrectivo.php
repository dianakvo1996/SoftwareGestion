<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/solicitudCorrectivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/RespuestaSolicitud.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

date_default_timezone_set('America/Bogota');
//Inicio filtro busqueda
$filtro='';
$filDescarga='';
$mas='';
$condicion=null;
if (isset($_POST['filtro'])) {
    $filDescarga=$_POST['filtro'];
    switch ($_POST['filtro']) {
        case 'P':
            $condicion=" estado='P' and";
            $mas='Pendientes';
        break;
        case 'R':            
            $condicion=" estado='R' and";
            $mas='Ejecutados';
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
$cliente=new Cliente('usuario',"'".$_SESSION['usuario']."'");
$datos= solicitudCorrectivo::getConsultaTablaCombinada($condicion." nitCliente='{$cliente->getNit()}'".$condicionAdicional, 'fecha desc');
$lista='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $respuesta=new RespuestaSolicitud('ideSolicitud', $objeto->getIde());
    $lista.='<tr>';
    $lista.="<td>{$objeto->getMostrarFecha()}</td>";
    $lista.="<td>{$objeto->getEquipo()->getNombreEquipo()}</td>";
    $lista.="<td>{$objeto->getEquipo()->getActivoFijo()}</td>";
    $lista.="<td>{$objeto->getSolicitante()}</td>";
    $lista.="<td style='font-size:10px'>{$objeto->getDetalle()}</td>";
	$lista.="<td>{$respuesta->getCalcularTiempoRespuesta($objeto->getFecha(),$respuesta->getFechaRealizacion())}</td>";

    switch ($respuesta->getEstado()){
        case 'R':
            $estado="<td><a href='principal.php?CONTENIDO=mantenimiento/cliente/visualizacionSolicitud.php&ideSolicitud={$objeto->getIde()}' style='background:#61F955;color:#000' class='enlace'>Ejecutado</a></td>";
            break;
        case 'P':
            $estado="<td><a href='principal.php?CONTENIDO=mantenimiento/cliente/visualizacionSolicitud.php&ideSolicitud={$objeto->getIde()}' style='background:#E34321;color:#fff' class='enlace'>Pendiente</a></td>";
            break;
        case 'E':
            $estado="<td><a href='principal.php?CONTENIDO=mantenimiento/cliente/visualizacionSolicitud.php&ideSolicitud={$objeto->getIde()}' style='background:#3230C4;color:#fff;font-size:10px' class='enlace'>En Proceso</a></td>";
            break;

        default :
            $estado="<td><a href='principal.php?CONTENIDO=mantenimiento/cliente/visualizacionSolicitud.php&ideSolicitud={$objeto->getIde()}' style='background:#E34321;color:#fff' class='enlace'>Pendiente</a></td>";
            break;
    }
    $lista.=$estado;
    $lista.='</tr>';
}
?>
<div id="listados">
    <img src="../presentacion/iconos/solicitudes.png" width="50px">
    <h2>CONSOLIDADO CORRECTIVOS</h2>
    <form method="POST">
    <table>
        <tr>
            <th>Cliente</th>
            <td colspan="2"><?=$cliente->getNombre()?></td>
            <th><a href="mantenimiento/cliente/descargarConsolidadoExcel.php?filtro=<?=$filDescarga?>&nit=<?=$cliente->getNit()?>&condicionAdicional=<?=$condicionAdicional?>" class="enlace">Descargar excel</a></th>
        </tr>
        <tr>
            <th>Filtros</th>
            <td>                
                <input type="radio" value="T" id="T" name="filtro"><label for="T">Todos</label>
                <input type="radio" value="P" id="P" name="filtro"><label for="P">Pendientes</label>
                <input type="radio" value="R" id="R" name="filtro"><label for="R">Ejecutados</label>
               
            </td>
            <td>
                <input type="month" name="mesAño" max="<?= date('Y-m')?>" value="<?= date('Y-m')?>">
            </td>
            <th>
                <input type="submit" value="filtrar" class="enlace">
            </th>
        </tr>
    </table>
    </form>
    <table>
        <tr>
            <th>FECHA Y HORA</th>
            <th>EQUIPO</th>
            <th>ACTIVO FIJO</th>
            <th>ACTIVO SOLICITANTE</th>
            <th>DETALLE</th>
            <th>ESTADO</th>
        </tr>
        <?=$lista?>
    </table>
</div>