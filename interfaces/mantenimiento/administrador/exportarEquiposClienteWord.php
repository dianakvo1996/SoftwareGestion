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

header('Content-type: application/vnd.ms-word;charset=iso-8859-15');
header('Content-Disposition: attachment; filename='.$nombreDescarga.'.doc');

$datos=Equipo::getDatosEnObjetos("nitCliente='".$nit."'", 'nombreequipo');
$lista='';
$item=1;
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<th style='font-weight: bold'>{$item}.</th>";
    $lista.="<td style='text-align: left';mso-number-format:'@'>&nbsp;{$objeto->getActivoFijo()}</td>";
    $lista.="<td style='text-align: left' colspan='2'>{$objeto->getNombreEquipo()}</td>";
    $lista.="<td style='text-align: left'>{$objeto->getMarca()}</td>";
    $lista.="<td style='text-align: left';mso-number-format:'@'>&nbsp;{$objeto->getModelo()}</td>";
    $lista.="<td style='text-align: left'>&nbsp;{$objeto->getSerial()}</td>";    
    $lista.="<td style='text-align: left'>{$objeto->getUbicacion()}</td>";
    $lista.="<td style='text-align: left'></td>";
    $lista.="<td style='text-align: left'></td>";
    $lista.='</tr>';
    $item++;
}
?>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<table border='1' style="margin:auto;font-size: 17px">
    <tr>
        <th colspan="4" rowspan="4">
            <img src="file:///C:/Programas/wamp64/www/LaboratorioBiometrical/presentacion/imagenes/Biometrical_Miniatura.png" width="50px">
        </th>
        <th colspan="4" rowspan="4">INVENTARIO DE EQUIPOS</th>
        <th>CÓDIGO</th>
        <th>VERSIÓN</th>
     </tr>
    <tr>
        <td style="text-align: center">F-O-M-LC-09</td>
        <td style="text-align: center">&nbsp;01</td>
    </tr>
    <tr>
        <th colspan="2">FECHA VIGENCIA</th>
    </tr>
    <tr>
        <td style="text-align: center" colspan="2">19/01/2017</td>
    </tr>
</table>
<br>
<table border="1" style="margin:auto;font-size: 17px;">
    <tr>
        <th colspan="2" rowspan="2" style="background-color: #CDC9C8">EMPRESA</th>
        <th colspan="3" rowspan="2"><?=$cliente->getNombre()?></th>
        <th rowspan="3" style="background-color: #CDC9C8">TIPO</th>
        <th style="background-color: #9999ff">BIOMEDICO</th>
        <th>X</th>
        <th style="background-color: #9999ff">PATRON</th>
        <th></th>
    </tr>
    <tr>
        <th style="background-color: #9999ff">INDUSTRIAL</th>
        <th></th>
        <th style="background-color: #9999ff">COMPUTO</th>
        <th></th>
    </tr>
    <tr>
        <th colspan="2" style="background-color: #CDC9C8">FECHA</th>
        <th colspan="3"><?= date('d/m/Y')?></th>
        <th style="background-color: #9999ff">OTROS:¿Cuál?</th>
        <th colspan="3"></th>
    </tr>
    <tr style="background-color: #9999ff; height: 50px">
        <th>ITEM</th>
        <th>CODIGO ACTIVO FÍJO</th>
        <th colspan="2">EQUIPO</th>
        <th>MARCA</th>
        <th>MODELO</th>
        <th>SERIE</th>            
        <th>UBICACIÓN</th>  
        <th>ACCESORIOS</th>  
        <th>OBSERVACION</th>  
    </tr>
    <?=$lista?>
</table>