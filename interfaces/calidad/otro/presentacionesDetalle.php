<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/Presentacion.php';

$datos = Presentacion::getDatosEnObjetos(null, "nombre");
$lista ='';

for ($i= 0; $i< count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$objeto->getNombre()}</td>";
    $lista.="<td><a href='../ArchivosProcesos/Presentaciones/{$objeto->getPresentacion()}'><img src='../presentacion/iconos/presentacion.png' title='Descargar' height='80px'></a></td>";
    $lista.='</tr>';
}
?>
<a href="principal.php?CONTENIDO=calidad/otro/inicio.php" ><img src="../presentacion/iconos/atras.png" title="Atras" height="40px" style="float: left"></a>
<div id="listados">
    <img src="../presentacion/iconos/presentaciones.png" title="Presentaciones" height="90px" style="opacity: 0.8">   
    <h3>PRESENTACIONES</h3>
    <table>
        <tr>
            <th>NOMBRE</th>
            <th>OPCIONES</th>
        </tr>
            <?=$lista?>
    </table>
</div>
