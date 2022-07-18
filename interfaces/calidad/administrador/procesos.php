<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';

$datos= Proceso::getDatosEnObjeto('ide between 5 and 15',"nombre");
$lista='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$objeto->getNombre()}</td>";
    $lista.="<th>";
    $lista.="<a href='principal.php?CONTENIDO=calidad/administrador/opcionesProceso.php&ideProceso={$objeto->getIde()}' class='enlace' title='Subprocesos'>subprocesos</a>";
    $lista.="<a href='principal.php?CONTENIDO=calidad/administrador/politicasOperativasProceso.php&ideProceso={$objeto->getIde()}' class='enlace' title='Politica Operativa'>Politica operativa</a>";
    $lista.="<a href='principal.php?CONTENIDO=calidad/administrador/caracterizacionProceso.php&ideProceso={$objeto->getIde()}' class='enlace' title='Caracterizacion del Proceso'>Caracterización</a>";
    $lista.="</th>";
    $lista.='</tr>';
}
?>
<br>
<div id="listados">
    <img src="../presentacion/iconos/procesosGestion.png" height="100px" style="opacity: 0.8" title="Procesos">
<h3 style="text-align: center">LISTADO DE PROCESOS</h3>
<table>
    <tr>
        <th>NOMBRE</th>
        <th colspan="3">OPCIONES</th>
    </tr>
    <?=$lista?>
</table>
</div>