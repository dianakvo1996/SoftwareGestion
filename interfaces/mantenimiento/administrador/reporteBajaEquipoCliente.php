<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/EquipoDeBaja.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

date_default_timezone_set('America/Bogota');
$equipo=new EquipoDeBaja('ide', $ideEquipo);
$cliente=new Cliente('nit', "'".$equipo->getNitCliente()."'");
$nombreDescarga=$equipo->getNombreEquipo().'-'.date('Y-m-d');

header('Content-type: application/vnd.ms-word;charset=charset=utf-8');
header('Content-Disposition: attachment; filename='.$nombreDescarga.'.doc');

?>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<p style="font-family: Arial"><strong>Cliente:</strong>&nbsp;<?=$cliente->getNombre()?></p>
<br>
<table border="2" style="font-family: Arial;border-collapse: collapse;text-transform: capitalize">
    <tr style="background-color: #9999ff;border: 2px solid #000">
        <th>Equipo</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Serie</th>
        <th>Activo Fijo</th>
        <th>Ubicación</th>
    </tr>
    <tr style="text-align: center;border: 2px solid #000">
        <td><?=$equipo->getNombreEquipo()?></td>
        <td><?=$equipo->getMarca()?></td>
        <td><?=$equipo->getModelo()?></td>
        <td><?=$equipo->getSerial()?></td>
        <td><?=$equipo->getActivoFijo()?></td>
        <td><?=$equipo->getUbicacion()?></td>
    </tr>
</table>
<p style="font-family: Arial;text-align: justify"><strong>Diagnostico:</strong> <?=$equipo->getJustificacion()?></p>
<p style="font-family: Arial"><strong>Fecha de Baja:</strong>&nbsp;<?=$equipo->getMostrarFechaRealizacion()?></p>
