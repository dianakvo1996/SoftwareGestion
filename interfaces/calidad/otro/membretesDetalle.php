<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/Membrete.php';

$datos= Membrete::getDatosEnObjetos(null, null);
$listaImagen='';
$lista='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $listaImagen.='<tr>';
    $lista.='<tr>';
    switch ($objeto->getTipo()) {
        case 'png':      
            $listaImagen.="<td>{$objeto->getNombre()}</td>";
            $listaImagen.="<td><img src='../ArchivosProcesos/Membretes/{$objeto->getArchivo()}'height='100px'></td>";
            $listaImagen.="<td><a href='../ArchivosProcesos/Membretes/{$objeto->getArchivo()}' download><img src='../presentacion/iconos/descargarMembrete.png' height='80px' title='Descargar'></a></td>";
            break;
        case 'jpg':      
            $listaImagen.="<td>{$objeto->getNombre()}</td>";
            $listaImagen.="<td><img src='../ArchivosProcesos/Membretes/{$objeto->getArchivo()}'height='100px'></td>";
            $listaImagen.="<td><a href='../ArchivosProcesos/Membretes/{$objeto->getArchivo()}' download><img src='../presentacion/iconos/descargarMembrete.png' height='80px' title='Descargar'></a></td>";
            break;
        case 'jpeg':      
            $listaImagen.="<td>{$objeto->getNombre()}</td>";
            $listaImagen.="<td><img src='../ArchivosProcesos/Membretes/{$objeto->getArchivo()}'height='100px'></td>";
            $listaImagen.="<td><a href='../ArchivosProcesos/Membretes/{$objeto->getArchivo()}' download><img src='../presentacion/iconos/descargarMembrete.png' height='80px' title='Descargar'></a></td>";
            break;
        
        case 'docx':            
        $lista.="<td>{$objeto->getNombre()}</td>";
        $lista.="<td><a href='../ArchivosProcesos/Membretes/{$objeto->getArchivo()}' download><img src='../presentacion/iconos/descargarMembrete.png' height='80px'></a></td>";
            break;
        case 'doc':            
        $lista.="<td>{$objeto->getNombre()}</td>";
        $lista.="<td><a href='../ArchivosProcesos/Membretes/{$objeto->getArchivo()}' download><img src='../presentacion/iconos/descargarMembrete.png' height='80px'></a></td>";
            break;

    }
       
    $lista.='</tr>';
    $listaImagen.='</tr>';
}
?>
<a href="principal.php?CONTENIDO=calidad/otro/inicio.php"><img src="../presentacion/iconos/atras.png" title="Atras" height="40px" style="float: left"></a>
<div id="listados">
    <img src="../presentacion/iconos/membrete.png"  height="100px" title="Membrete" style="opacity: 0.8">
    <h3>MEMBRETES</h3>
        
    <table style="float: left">
        <tr>
            <th colspan="4" style="font-size: 25px">IMAGENES</th>
        </tr>
        <tr>
            <th>MEMBRETE</th>
            <th>VISTA PREVIA</th>            
            <th>OPCIONES</th>
        </tr>
            <?=$listaImagen?>
    </table>
</div>

<br>
<div id="listados">
   
    <table style="float: right">
        <tr>
            <th colspan="4" style="font-size: 25px">WORD</th>
        </tr>
        <tr>
            <th>MEMBRETES</th>
            <th>OPCIONES</th>
        </tr>
            <?=$lista?>
    </table>
</div>