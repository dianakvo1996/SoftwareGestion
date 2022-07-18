<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/TipoEquipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/RutinaEquipo.php';

$tipo=new TipoEquipo('ide', $ideTipo);
$datos= RutinaEquipo::getDatosEnObjetos('ideTipoEquipo='.$ideTipo,'ide');
$lista='';
$item=1;
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$item}</td>";
    $lista.="<td>{$objeto->getDescripcion()}</td>";
    $lista.="<td><a href='principal.php?CONTENIDO=mantenimiento/administrador/rutinaFormulario.php&accion=Modificar&ideTipo={$tipo->getIde()}&ide={$objeto->getIde()}'><img src='../presentacion/iconos/modificar.png' height='40px'></a>";
    $lista.="<img src='../presentacion/iconos/eliminar.png' onclick='eliminar({$objeto->getIde()}," . '"' . "{$tipo->getIde()}" . '"' . ")' height='40px'></td>";
    $lista.='</tr>';
    $item++;
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/tiposEquipos.php"><img src="../presentacion/iconos/atras.png" title="Volver" height="40px"></a>
<div id="listados">
    <h3>RUTINAS</h3>
    <table>
        <tr>
            <th>Equipo</th>
            <td><?=$tipo->getNombre()?></td>
        </tr>
    </table>
    <table>
        <tr>
            <th colspan="2">Rutina</th>
            <th><a href="principal.php?CONTENIDO=mantenimiento/administrador/rutinaFormulario.php&accion=Adicionar&ideTipo=<?=$tipo->getIde()?>"><img src="../presentacion/iconos/addEquipo.png" height="60px"></a></th>
        </tr>
        <?=$lista?>
    </table>    
</div>
<script>
    function eliminar(ide,ideTipoEquipo) {
        if(confirm("¿Realmente desea eliminar esta Rutina?")){
            location = 'mantenimiento/administrador/rutinaActualizar.php?accion=Eliminar&ide='+ide+'&ideTipoEquipo='+ideTipoEquipo;
         }
    }
</script>
