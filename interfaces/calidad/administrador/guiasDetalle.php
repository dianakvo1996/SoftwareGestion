<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/GuiasProceso.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$opcion=new OpcionesProceso("ide", $ideOpcion);
$carpeta= str_replace(' ','_',$opcion->getProcesoEnObjeto()->getNombre());

$datos= GuiasProceso::getDatosEnObjetos("ideOpcionesProceso=".$ideOpcion, "nombre");
$lista='';

for ($i = 0; $i < count($datos); $i++) {
   $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$objeto->getNombre()}</td>";
    $lista.="<td>{$objeto->getRuta()}</td>";
    $lista.="<td><a href='principal.php?CONTENIDO=calidad/administrador/menuProceso.php&ideProceso={$ideProceso}&CONTENIDOINTERNO=calidad/administrador/visualizadorPDF.php&ruta=/{$carpeta}/Guias/{$objeto->getRuta()}'><img src='../presentacion/iconos/pdf.png' height='50px' title='PDF'></a></td>";
    $lista.='</tr>';
}

?>
<div id="listados">
     <img src="../presentacion/iconos/guias.png" title="Guias" height="90px" style="opacity: 0.8;float: left">
    <h3>GUIAS <?= strtoupper($opcion->getProcesoEnObjeto()->getNombre())?></h3>
    <h3><?=$opcion->getNombre()?></h3>
    <table style="width: 100%; text-align: center">    
            <tr>
                <th>NOMBRE</th>
                <th>ARCHIVO</th>
                <th>TIPO</th>
            </tr>
            <?=$lista?>
    </table>

</div>