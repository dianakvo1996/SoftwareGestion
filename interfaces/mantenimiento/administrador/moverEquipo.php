<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';

$equipo=new Equipo('ide', $ide);

$sedes= Sede::getDatosEnObjetos("nitCliente='{$equipo->getSede()->getNitCliente()}' and ide <> {$equipo->getIdeSede()}", 'nombre');
$lista='';
for ($i = 0; $i < count($sedes); $i++) {
    $objeto=$sedes[$i];
    $lista.='<tr>';
    $lista.="<td><input type='radio' name='sede'>{$objeto->getNombre()}</td>";
    $lista.='</tr>';
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/equiposSede.php&ideSede=<?=$equipo->getIdeSede()?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="40px"></a>
<div id="listados">
    <img src="../presentacion/iconos/mover2.png" height="90px">
    <table>
        <tr>
            <th>Cliente</th>
            <td><?=$equipo->getSede()->getCliente()->getNombre()?></td>
            <th>Nit</th>
            <td><?=$equipo->getSede()->getCliente()->getNit()?></td>
            
        </tr>
    </table>
</div>
<div id="formulario">
    <center>
    <table>
        <tr>
            <th colspan="2">EQUIPO</th>
            <th rowspan="7"></th>
            <th colspan="2" style="width: 350px">SEDE ACTUAL</th>
            <th rowspan="7"></th>
            <th style="width: 350px">SEDE A MOVER</th>
        </tr>
        <tr>
            <th>ACTIVO FIJO</th>
            <td><?=$equipo->getActivoFijo()?></td>
            <th>NOMBRE</th>
            <td id="sedeNombre"><?=$equipo->getSede()->getNombre()?></td>
            <td rowspan="11">
                <form id="formulario" onsubmit="return confirmarMover()" action="mantenimiento/administrador/moverActualizar.php" method="POST">
                    <select name="sedeNueva" id="sedes" size="7" class="listaSede">
                    <?= Sede::getSedesOptions("nitCliente='{$equipo->getSede()->getNitCliente()}' and ide <> {$equipo->getIdeSede()}")?>
                </select>
                    <br>
                    <br>
                <input type="text" name="ubicacion" placeholder="Ingrese nueva ubicación...."><br><br>
                <input type="hidden" name="ideSede" value="<?=$equipo->getIdeSede()?>">
                <input type="hidden" name="ideEquipo" value="<?=$equipo->getIde()?>">
                <input type="submit" name="mover" value="Mover">
                </form>
            </td>
        </tr>
        <tr>
            <th>EQUIPO</th>
            <td><?=$equipo->getNombreEquipo()?></td>
        </tr>
        <tr>
            <th>MARCA</th>
            <td><?=$equipo->getMarca()?></td>
        </tr>
        <tr>
            <th>MODELO</th>
            <td><?=$equipo->getModelo()?></td>
        </tr>
        <tr>
            <th>SERIE</th>
            <td><?=$equipo->getSerial()?></td>
            
        </tr>
        <tr>
            <th>UBICACIÓN</th>
            <td><?=$equipo->getUbicacion()?></td>
        </tr>
    </table>      
    </center>
</div>
<script>
    function confirmarMover(){
        var valido=false;
        if (confirm('¿Esta seguro de mover este equipo?')){
            valido=true;
        }
        return valido;
    }
</script>
