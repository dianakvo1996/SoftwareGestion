<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/EquipoDeBaja.php';

$cliente=new Cliente('usuario', "'".$_SESSION['usuario']."'");
$datos= EquipoDeBaja::getDatosEnObjetos("nitCliente='{$cliente->getNit()}'", 'nombreEquipo');
$lista='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$objeto->getActivoFijo()}</td>";
    $lista.="<td>{$objeto->getNombreEquipo()}</td>";
    $lista.="<td colspan='2' style='text-align:justify'>{$objeto->getJustificacion()}</td>";  
    $lista.="<td>{$objeto->getMostrarFechaRealizacion()}</td>";
    $lista.='</tr>';
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/cliente/equiposCliente.php" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="40px"></a>
<div  id="listados">
    <img src="../presentacion/iconos/deBaja1.png" height="90px" style="opacity: 0.8">
    <br>
    <br>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th>CODIGO ACTIVO FIJO</th>
            <th>EQUIPO</th>
            <th>JUSTIFICACION</th>
            <th></th>
            <th style="width: 100px">FECHA DE REALIZACIÓN</th>
        </tr>
        <?=$lista?>
    </table>
</div>