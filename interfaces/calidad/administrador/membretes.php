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
        $listaImagen.="<td><img src='../presentacion/iconos/eliminar.png' title='Eliminar' onclick='eliminar({$objeto->getCodigo()}," . '"' . "{$objeto->getArchivo()}" . '"' . ")' height='50px'></td>";
            break;
        case 'jpeg':      
            $listaImagen.="<td>{$objeto->getNombre()}</td>";
        $listaImagen.="<td><img src='../ArchivosProcesos/Membretes/{$objeto->getArchivo()}'height='100px'></td>";
        $listaImagen.="<td><a href='../ArchivosProcesos/Membretes/{$objeto->getArchivo()}' download><img src='../presentacion/iconos/descargarMembrete.png' height='80px' title='Descargar'></a></td>";
        $listaImagen.="<td><img src='../presentacion/iconos/eliminar.png' title='Eliminar' onclick='eliminar({$objeto->getCodigo()}," . '"' . "{$objeto->getArchivo()}" . '"' . ")' height='50px'></td>";
            break;
        case 'jpg':      
            $listaImagen.="<td>{$objeto->getNombre()}</td>";
        $listaImagen.="<td><img src='../ArchivosProcesos/Membretes/{$objeto->getArchivo()}'height='100px'></td>";
        $listaImagen.="<td><a href='../ArchivosProcesos/Membretes/{$objeto->getArchivo()}' download><img src='../presentacion/iconos/descargarMembrete.png' height='80px' title='Descargar'></a></td>";
        $listaImagen.="<td><img src='../presentacion/iconos/eliminar.png' title='Eliminar' onclick='eliminar({$objeto->getCodigo()}," . '"' . "{$objeto->getArchivo()}" . '"' . ")' height='50px'></td>";
            break;
        case 'doc':            
        $lista.="<td>{$objeto->getNombre()}</td>";
        $lista.="<td><a href='../ArchivosProcesos/Membretes/{$objeto->getArchivo()}' download><img src='../presentacion/iconos/descargarMembrete.png' height='80px'></a></td>";
        $lista.="<td><img src='../presentacion/iconos/eliminar.png' title='Eliminar' onclick='eliminar({$objeto->getCodigo()}," . '"' . "{$objeto->getArchivo()}" . '"' . ")' height='50px'></td>";
            break;
        case 'docx':            
        $lista.="<td>{$objeto->getNombre()}</td>";
        $lista.="<td><a href='../ArchivosProcesos/Membretes/{$objeto->getArchivo()}' download><img src='../presentacion/iconos/descargarMembrete.png' height='80px'></a></td>";
        $lista.="<td><img src='../presentacion/iconos/eliminar.png' title='Eliminar' onclick='eliminar({$objeto->getCodigo()}," . '"' . "{$objeto->getArchivo()}" . '"' . ")' height='50px'></td>";
            break;

    }
       
    $lista.='</tr>';
    $listaImagen.='</tr>';
}
?>
<a href="principal.php?CONTENIDO=calidad/administrador/inicio.php"><img src="../presentacion/iconos/atras.png" title="Atras" height="40px" style="float: left"></a>
<div id="listados">
    
    <h3>GESTIÓN DE MEMBRETES</h3>
    <a href="principal.php?CONTENIDO=calidad/administrador/membreteFormulario.php&accion=Adicionar">
        <img src="../presentacion/iconos/addMembrete.png"  height="90px" title="Adicionar Membrete">
    </a>
    <table style="float: left">
        <tr>
            <th colspan="4" style="font-size: 25px">IMAGENES</th>
        </tr>
        <tr>
            <th>MEMBRETE</th>
            <th>VISTA PREVIA</th>            
            <th colspan="2">OPCIONES</th>
        </tr>
            <?=$listaImagen?>
    </table>
</div>
<div id="listados">
    <table style="float: right">
        <tr>
            <th colspan="4" style="font-size: 25px">WORD</th>
        </tr>
        <tr>
            <th>MEMBRETES</th>
            <th  colspan="2">OPCIONES</th>
        </tr>
            <?=$lista?>
    </table>
</div>
<script>
    function eliminar(codigo,rutaAnterior) {
        if(confirm("¿Realmente desea eliminar este Registro?")){
            location = 'calidad/administrador/membreteActualizar.php?accion=Eliminar&codigo='+codigo+'&ruta='+rutaAnterior;
         }
    }
</script>