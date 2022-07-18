<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalibracion/EquipoC.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/SedeC.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$sede=new SedeC('ide',$ideSede);
$datos= EquipoC::getDatosEnObjetos('ideSede='.$sede->getIde(),null);
$lista='';
$item = 1;
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$item}.</td>";
    $lista.="<td>{$objeto->getActivoFijo()}</td>";
    $lista.="<td>{$objeto->getNombreEquipo()}</td>";
    $lista.="<td>{$objeto->getMarca()}</td>";
    $lista.="<td>{$objeto->getModelo()}</td>";
    $lista.="<td>{$objeto->getSerial()}</td>";  
    $lista.="<td>{$objeto->getUbicacion()}</td>";
    $lista.='</tr>';
$item++;
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/cliente/sedesC.php" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="40px"></a>
<div id="listados">
    <img src="../presentacion/iconos/equipo.png" title="Clientes" height="50px">
	<h2>INVENTARIO EQUIPOS CALIBRACION</h2>
    <table>
        <tr>
            <th>Sede:</th>
            <td style="text-align: initial"><?=$sede->getNombre()?></td>
        </tr>
    </table>
    <br>
    <div class="sub_Menu">
        <a href="principal.php?CONTENIDO=mantenimiento/cliente/cronogramaCalibracionSede.php&ideSede=<?=$sede->getIde()?>">Cronograma de Calibración</a>
    </div>
    <table>
        <tr>
            <th colspan="2">ACTIVO FIJO</th>
            <th>NOMBRE</th>
            <th>MARCA</th>
            <th>MODELO</th>
            <th>SERIAL</th>
            <th>UBICACIÓN</th>    
        </tr>
        <?=$lista?>
    </table>
</div>