<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalibracion/EquipoC.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/ClienteC.php';
$cliente=new Cliente('usuario', "'".$_SESSION['usuario']."'");
$datos= EquipoC::getDatosEnObjetos("nitCliente='{$cliente->getNit()}'", 'nombreequipo');
$lista='';
$item=1;
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td style='font-weight: bold'>{$item}.</td>";
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
<!--<a href="principal.php?CONTENIDO=mantenimiento/cliente/inicio.php" style=""><img src="../presentacion/iconos/atras.png" title="Volver" height="40px"></a>-->
<div id="listados">
    <img src="../presentacion/iconos/equipo.png" title="Clientes" height="80px" style="float: left">
    <h2>
        INVENTARIO EQUIPOS CALIBRACION</h2><br>
        <h3>
        <?=$cliente->getNombre()?>
        </h3>
        <br>
        <table>
            <tr>
                <th><a href="principal.php?CONTENIDO=mantenimiento/cliente/cronogramaCalibracionCliente.php&nitCliente=<?=$cliente->getNit()?>" class="enlace">Cronograma de Calibración</a></th>
            </tr>
        </table>
    <table>
        <tr>
            <th colspan="2">ACTIVO FÍJO</th>
            <th >EQUIPO</th>
            <th>MARCA</th>
            <th>MODELO</th>
            <th>SERIE</th>     
            <th>UBICACIÓN</th>           
        </tr>
        <?=$lista?>
    </table>
</div>
