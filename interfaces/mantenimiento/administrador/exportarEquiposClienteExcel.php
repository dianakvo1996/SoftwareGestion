<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

date_default_timezone_set('America/Bogota');
$cliente=new Cliente('nit', "'".$nit."'");
$nombreDescarga="Inventario_Equipos_{$cliente->getNombre()}_".date('Y-m-d_His');

header('Content-type: application/vnd.ms-;charset=iso-8859-15');
header('Content-Disposition: attachment; filename='.$nombreDescarga.'.xls');


$datos=Equipo::getDatosEnObjetos("nitCliente='".$nit."'", 'ubicacion,nombreequipo asc');
$lista='';
$item=1;
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<th style='font-weight: bold'>{$item}.</th>";
    $lista.="<td style='text-align: center';mso-number-format:'@'>&nbsp;{$objeto->getActivoFijo()}</td>";
    $lista.="<td style='text-align: center'>{$objeto->getNombreEquipo()}</td>";
    $lista.="<td style='text-align: center'>{$objeto->getMarca()}</td>";
    $lista.="<td style='text-align: center';mso-number-format:'@'>&nbsp;{$objeto->getModelo()}</td>";
    $lista.="<td style='text-align: center'>&nbsp;{$objeto->getSerial()}</td>"; 
    $lista.="<td style='text-align: center'>&nbsp;{$objeto->getRegistroInvima()}</td>";   
    $lista.="<td style='text-align: center'>{$objeto->getUbicacion()}</td>";
    $lista.="<td style='text-align: center'>{$objeto->getTipoEquipo()->getTipoLista()}</td>";
    $lista.="<td style='text-align: center'>{$objeto->getTipoEquipo()->clasificacionBiomedicaLista()}</td>";
    $lista.="<td style='text-align: center'>{$objeto->getTipoEquipo()->clasificacionRiesgoLista()}</td>";
    $lista.="<td style='text-align: center'>{$objeto->getTipoEquipo()->getManualLista()}</td>";
    $lista.='</tr>';
    $item++;
}
?>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<table border='1' style="margin:auto;font-size: 14px">
    <tr>
        <th colspan="2" rowspan="4">
            <img src="http://laboratoriobiometrical.com.co/SoftwareGestion/presentacion/imagenes/biometrical-143.png" width="50px">
        </th>
        <th colspan="8" rowspan="4">INVENTARIO DE EQUIPOS</th>
        <th>CÓDIGO</th>
        <th>VERSIÓN</th>
     </tr>
    <tr>
        <td style="text-align: center">F-O-M-LC-01</td>
        <td style="text-align: center">&nbsp;02</td>
    </tr>
    <tr>
        <th colspan="2">FECHA VIGENCIA</th>
    </tr>
    <tr>
        <td style="text-align: center" colspan="2">01/02/2020</td>
    </tr>
</table>
<br>
<table border="1" style="margin:auto;font-size: 14px;">
	<tr>
		<th style="background-color: #D9D9D9" colspan="2">EMPRESA:</th>
		<th style="font-weight: normal" colspan="2"><?=$cliente->getNombre()?></th>
		<th style="background-color: #D9D9D9">FECHA:</th><th style="font-weight: normal"><?= date('d/m/Y')?></th>
		<th style="background-color: #D9D9D9" colspan="2">TIPO DE EQUIPAMIENTO:</th><th style="font-weight: normal" colspan="4">BIOMÉDICO</th>
	</tr>
</table>
<br>
<table border="1" style="margin:auto;font-size: 14px;">
    <tr style="background-color: #D9D9D9; height: 50px">
        <th>ITEM</th>
        <th>NO. DE ACTIVO FÍJO</th>
        <th>EQUIPO</th>
        <th>MARCA</th>
        <th>MODELO</th>
        <th>SERIE</th>
        <th>REGISTRO INVIMA</th>            
        <th>UBICACIÓN</th>  
        <th>TIPO</th>  
        <th>CLASIFICACION BIOMÉDICA</th>
        <th>CLASIFICACION DEL RIESGO</th>
        <th>MANUAL</th>  
    </tr>
    <?=$lista?>
</table>

