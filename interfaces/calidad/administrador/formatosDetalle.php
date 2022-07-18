<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/FormatoProceso.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$opcion=new OpcionesProceso("ide", $ideOpcion);
$carpeta= str_replace(' ','_',$opcion->getProcesoEnObjeto()->getNombre());

$datos= FormatoProceso::getDatosEnObjeto("ideOpcionesProceso=".$ideOpcion, "nombre");
$lista='';

for ($i = 0; $i < count($datos); $i++) {
   $objeto=$datos[$i];
   $tipoArchivo=$objeto->getTipo();
    $lista.='<tr>';
    $lista.="<td>{$objeto->getNombre()}</td>";
    
    switch ($tipoArchivo) {
        case 'pdf':
            $lista.="<td><a href='principal.php?CONTENIDO=calidad/administrador/menuProceso.php&ideProceso={$ideProceso}&CONTENIDOINTERNO=calidad/administrador/visualizadorPDF.php&ruta=/{$carpeta}/Formatos/{$objeto->getRuta()}'><img src='../presentacion/iconos/pdf.png' height='50px' title='PDF'></a></td>";
        break;
        case 'doc':
            $lista.="<td><a href='../ArchivosProcesos/{$carpeta}/Formatos/{$objeto->getRuta()}'><img src='../presentacion/iconos/word.png' height='50px' title='WORD'></a></td>";
        break;
        case 'docx':
            $lista.="<td><a href='../ArchivosProcesos/{$carpeta}/Formatos/{$objeto->getRuta()}'><img src='../presentacion/iconos/word.png' height='50px' title='WORD'></a></td>";
        break;
        case 'xls':
            $lista.="<td><a href='../ArchivosProcesos/{$carpeta}/Formatos/{$objeto->getRuta()}'><img src='../presentacion/iconos/excel.png' height='50px' title='EXCEL'></a></td>";
        break;
        case 'xlsx':
            $lista.="<td><a href='../ArchivosProcesos/{$carpeta}/Formatos/{$objeto->getRuta()}'><img src='../presentacion/iconos/excel.png' height='50px'title='EXCEL'></a></td>";
        break;
        case 'pptx':
            $lista.="<td><a href='../ArchivosProcesos/{$carpeta}/Formatos/{$objeto->getRuta()}'><img src='../presentacion/iconos/powerPoint.png' height='50px' title='POWER POINT'></a></td>";
        break;
        case 'ppt':
            $lista.="<td><a href='../ArchivosProcesos/{$carpeta}/Formatos/{$objeto->getRuta()}'><img src='../presentacion/iconos/powerPoint.png' height='50px' title='POWER POINT'></a></td>";
        break;
    }
    $lista.='</tr>';
}

?>
<div id="listados">
    <img src="../presentacion/iconos/formatos.png" title="Formatos" height="90px" style="opacity: 0.8;float: left">
    <h3>FORMATOS <?= strtoupper($opcion->getProcesoEnObjeto()->getNombre())?></h3>
    <h3><?=$opcion->getNombre()?></h3>
    <table>    
            <tr>
                <th>NOMBRE</th>
                <th>TIPO</th>
            </tr>
            <?=$lista?>
    </table>

</div>