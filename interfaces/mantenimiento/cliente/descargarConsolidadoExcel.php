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
$cliente=new Cliente('nit', "'".$nit."'");
$nombreDescarga="Consolidado_Correctivos{$cliente->getNombre()}_".date('Y-m-d_His');

header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename='.$nombreDescarga.'.xls');

//Inicio filtro busqueda
$condicion=null;
if ($filtro!=null) {
    switch ($filtro) {
        case 'P':
            $condicion=" estado='P' and";
        break;
        case 'R':            
            $condicion=" estado='R' and";
        break;
        case 'T':
            $condicion=null;
        break;
    }
}
//Fin filtro busqueda
$datos= solicitudCorrectivo::getConsultaTablaCombinada($condicion." nitCliente='{$cliente->getNit()}'".$condicionAdicional, 'fecha desc');
$lista='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $respuesta=new RespuestaSolicitud('ideSolicitud', $objeto->getIde());
    $lista.='<tr>';
    $lista.="<td>{$objeto->getMostrarFecha()}</td>";
    $lista.="<td>{$objeto->getEquipo()->getNombreEquipo()}</td>";
    $lista.="<td>{$objeto->getEquipo()->getActivoFijo()}</td>";
    $lista.="<td>{$objeto->getEquipo()->getMarca()}</td>";
    $lista.="<td>{$objeto->getEquipo()->getModelo()}</td>";
    $lista.="<td>{$objeto->getEquipo()->getSerial()}</td>";
    $lista.="<td>{$objeto->getSolicitante()}</td>";
    $lista.="<td>{$objeto->getDetalle()}</td>";
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
?>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />  
    <table border='1' style="margin:auto;font-size: 17px">
        <tr>
            <th rowspan="2" colspan="2">
                <img src="file:///D:/Programas/wamp64/www/LaboratorioBiometrical/presentacion/imagenes/Biometrical_Miniatura.png" width="50px" style="vertical-align: middle">
            </th>
            <th colspan="4">CONSOLIDADO</th>
        </tr>
        <tr>
            <th>Nit</th>
            <td><?=$cliente->getNit()?></td>
            <th>Cliente</th>
            <td><?=$cliente->getNombre()?></td>
        </tr>
    </table>
    <br>
    <table border='1' style="margin:auto;font-size: 17px; ">
        <tr style="background: #9999ff">
            <th>FECHA Y HORA</th>
            <th>EQUIPO</th>
            <th>ACTIVO FIJO</th>
            <th>MARCA</th>
            <th>MODELO</th>
            <th>SERIAL</th>
            <th>ACTIVO SOLICITANTE</th>
            <th>DETALLE</th>
            <th>ESTADO</th>
        </tr>
        <?=$lista?>
    </table>
