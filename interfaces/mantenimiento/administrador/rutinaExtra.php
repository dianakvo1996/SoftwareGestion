<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/TipoEquipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/RutinaExtra.php';

$tipoEquipo=new TipoEquipo('ide', $ideTipoEquipo);

$datos= RutinaExtra::getDatosEnObjetos('ideTipoEquipo='.$ideTipoEquipo, 'ide');
$lista='';
$item=1;
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$item}</td>";
    $lista.="<td style='text-align:left;'>{$objeto->getRutinaMostrar()}</td>";
    $lista.="<td><a href='principal.php?CONTENIDO=mantenimiento/administrador/rutinaExtraFormulario.php&accion=Modificar&ideRutina={$objeto->getIde()}&ideTipoEquipo={$objeto->getIdeTipoEquipo()}'><img src='../presentacion/iconos/modificar.png' height='40px'></a>";
    $lista.="<img src='../presentacion/iconos/eliminar.png' height='40px' onclick='eliminar({$objeto->getIde()})'>";
    $lista.="</td>";
    $lista.='</tr>';
    $item++;
}
$falta='';
if ($lista=='') {
    $falta='Sin Rutinas Extra';
}
?>
<div id="listados">
    <h2>RUTINAS EXTRA</h2>
    <table>
        <tr>
            <th>EQUIPO</th>
            <td><?=$tipoEquipo->getNombre()?></td>
        </tr>
    </table>
    <table>
        <tr>
            <th style="width: 20px">#</th>
            <th style="width: 90%">Rutina</th>
            <th>
                <a href="principal.php?CONTENIDO=mantenimiento/administrador/rutinaExtraFormulario.php&accion=Adicionar&ideTipoEquipo=<?=$tipoEquipo->getIde()?>"><img src="../presentacion/iconos/adicionarRutina.png" height="40px"></a> 
            </th>
        </tr>
        <?=$lista?>
    </table>
    <h2><?=$falta?></h2>
</div>
<script>
    function eliminar(ide) {
        if(confirm('¿Realmente desea eliminar?')){
            location = 'mantenimiento/administrador/rutinaExtraActualizar.php?accion=Eliminar&ide='+ide+'&ideTipoEquipo='+<?=$tipoEquipo->getIde()?>;
        }
    }
</script>
