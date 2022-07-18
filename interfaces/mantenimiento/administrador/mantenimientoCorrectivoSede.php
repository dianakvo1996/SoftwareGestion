<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ReporteCorrectivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';

$sede=new Sede('ide', $ideSede);
$datos= ReporteCorrectivo::getDatosEnObjetos('ideSede='.$ideSede,'numeroReporte');
$lista='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$objeto->getNumeroReporte()}</td>";
    $lista.="<td>{$objeto->getFecha()}</td>";
    $lista.="<td>{$objeto->getEquipo()->getNombreEquipo()}</td>";
    $lista.="<td><a href='mantenimiento/administrador/verReporteCorrectivo.php?numeroReporte={$objeto->getNumeroReporte()}' style='background:#0C5808;color:#fff' class='enlace'>Ver Reporte</a></td>";
    $lista.='</tr>';
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/equiposSede.php&ideSede=<?=$sede->getIde()?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px" style="float: left"></a>
<div id="listados">
    <h2>MANTENIMIENTOS CORRECTIVOS</h2>
    <table>
        <tr>
            <th>CLIENTE:</th>
            <td><?=$sede->getCliente()->getNombre()?></td>
            <th>SEDE:</th>
            <td><?=$sede->getNombre()?></td>
        </tr>
    </table>
    <table>
        <tr>
            <th>Número Reporte</th>
            <th>Fecha</th>
            <th>Equipo</th>
            <th><a href="principal.php?CONTENIDO=mantenimiento/administrador/seleccionarEquipoSede.php&ideSede=<?=$sede->getIde()?>"><img src="../presentacion/iconos/adicionar.png" height="30px" title="Adicionar"></a></th>
        </tr>
        <?=$lista?>
    </table>
</div>
