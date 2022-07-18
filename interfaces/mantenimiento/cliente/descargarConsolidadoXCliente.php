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

date_default_timezone_set('America/Bogota');

$cliente=new Cliente('nit',"'".$nitCliente."'");

$nombreDescarga="Consolidado_Correctivos-{$cliente->getNombre()}_".date('Y-m-d_His');

header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename='.$nombreDescarga.'.xls');

//Inicio filtro busqueda
//Fin filtro busqueda
$datos=solicitudCorrectivo::getConsultaTablaCombinada(null,'ideSede,fecha desc');
$lista='';
$estado='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    if ($objeto->getSede()->getNitCliente()==$cliente->getNit()) {
            $respuesta=new RespuestaSolicitud('ideSolicitud', $objeto->getIde());
    $lista.='<tr>';
    $lista.="<td>{$objeto->getMostrarFecha()}</td>";
	$lista.="<td>{$objeto->getSede()->getNombre()}</td>";
if($objeto->getIdeEquipo()!=null){
		$lista.="<td style='text-align:center'>{$objeto->getEquipo()->getNombreEquipo()}</td>";
    	$lista.="<td style='text-align:center'>{$objeto->getEquipo()->getActivoFijo()}</td>";
		$lista.="<td style='text-align:center'>{$objeto->getEquipo()->getMarca()}</td>";
    	$lista.="<td style='text-align:center'>{$objeto->getEquipo()->getModelo()}</td>";
    	$lista.="<td style='text-align:center'>{$objeto->getEquipo()->getSerial()}</td>";
	}else{
		$lista.="<td style='text-align:center'>{$objeto->getEquipoDeBaja()->getNombreEquipo()}</td>";
    	$lista.="<td style='text-align:center'>{$objeto->getEquipoDeBaja()->getActivoFijo()}</td>";
		$lista.="<td style='text-align:center'>{$objeto->getEquipoDeBaja()->getMarca()}</td>";
    	$lista.="<td style='text-align:center'>{$objeto->getEquipoDeBaja()->getModelo()}</td>";
    	$lista.="<td style='text-align:center'>{$objeto->getEquipoDeBaja()->getSerial()}</td>";

	}
  
    $lista.="<td>{$objeto->getSolicitante()}</td>";
    $lista.="<td>{$objeto->getDetalle()}</td>";
$lista.="<td>{$respuesta->getCalcularTiempoRespuesta($objeto->getFecha(),$respuesta->getFechaRealizacion())}</td>";
    switch ($respuesta->getEstado()){
        case 'R':
            $estado="<td style='background: #33FF61;font-weight: bolder;text-align: center;'><label>Ejecutado</label></td>";
            break;
        case 'P':
            $estado="<td style='background: #FF5733;font-weight: bolder;text-align: center'><label>Pendiente</label></td>";
            break;
        default :
            $estado="<td style='background: #FF5733;font-weight: bolder;text-align: center'><label>Pendiente</label></td>";
            break;
    }
    $lista.=$estado;
    $lista.='</tr>';
    }

}
?>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />  
    <table border='1' style="margin:auto;font-size: 17px">
        <tr>
            <th rowspan="2" colspan="2">
                <img src="http://laboratoriobiometrical.com.co/SoftwareGestion/presentacion/imagenes/Biometrical_Miniatura.png" width="50px" style="vertical-align: middle">
            </th>
            <th colspan="4">CONSOLIDADO MANTENIMIENTOS CORRECTIVOS</th>
        </tr>
        <tr>
            <th>Cliente</th>
            <td><?=$cliente->getNombre()?></td>
            <th>Sede</th>
            <td>Todas las Sedes</td>
        </tr>
    </table>
    <br>
    <table border='1' style="margin:auto;font-size: 17px; ">
        <tr style="background: #9999ff">
            <th>FECHA Y HORA</th>
<th>SEDE</th>
            <th>EQUIPO</th>
            <th>ACTIVO FIJO</th>
            <th>MARCA</th>
            <th>MODELO</th>
            <th>SERIAL</th>
            <th>SOLICITANTE</th>
            <th>DETALLE</th>
            <th>TIEMPO RESPUESTA</th>
            <th>ESTADO</th>
        </tr>
        <?=$lista?>
    </table>
