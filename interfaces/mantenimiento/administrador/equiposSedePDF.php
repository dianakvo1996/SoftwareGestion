<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

date_default_timezone_set('America/Bogota');
$sede=new Sede('ide',$ideSede);

$datos=Equipo::getDatosEnObjetos("ideSede=$ideSede", 'ubicacion,nombreequipo asc');
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
<style>
*{
	margin: 0px 0;
}
table{
	font-family:Helvetica;
    border-collapse: collapse;
    border-spacing: 0 0;
	width:97%;
	margin:5 auto;
	font-size:10px;
	text-align:center;
}
</style>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<table border="1" class="encabezado">
    <tr>
        <th colspan="2" rowspan="4">
            <img src="/var/www/html/SoftwareGestion/presentacion/imagenes/LOGO BIOMETRICAL.jpg" width="130px">
        </th>
        <th colspan="8" rowspan="4">INVENTARIO DE EQUIPOS</th>
        <th>CÓDIGO</th>
        <th>VERSIÓN</th>
     </tr>
    <tr>
        <td >F-O-M-LC-01</td>
        <td>&nbsp;02</td>
    </tr>
    <tr>
        <th colspan="2">FECHA VIGENCIA</th>
    </tr>
    <tr>
        <td colspan="2">01/02/2020</td>
    </tr>
</table>
<table  border="1">
	<tr>
		<th style="background-color: #D9D9D9" colspan="2">EMPRESA:</th>
		<th style="font-weight: normal" colspan="2"><?=$sede->getCliente()->getNombre().' - '.$sede->getNombre()?></th>
		<th style="background-color: #D9D9D9">FECHA:</th><th style="font-weight: normal"><?= date('d/m/Y')?></th>
		<th style="background-color: #D9D9D9" colspan="2">TIPO DE EQUIPAMIENTO:</th><th style="font-weight: normal" colspan="4">BIOMÉDICO</th>
	</tr>
</table>
<table  border="1">
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

