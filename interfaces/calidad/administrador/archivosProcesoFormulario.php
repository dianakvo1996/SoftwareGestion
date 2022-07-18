<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/ArchivosProceso.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$datosProceso=new Proceso("ide", $ideProceso);
$archivoProceso=new ArchivosProceso("ideProceso", $datosProceso->getIde());
?>
<a href="principal.php?CONTENIDO=calidad/administrador/menuProcesoAlterno.php&ideProceso=<?=$datosProceso->getIde()?>&CONTENIDOINTERNO=calidad/administrador/visualizadorPDF.php"><img src="../presentacion/iconos/atras.png" title="Volver" height="50px"></a>
<div id="formulario">
    <center>
    <form action="calidad/administrador/archivosProcesoActualizar.php" method="post" enctype="multipart/form-data">
        <label id="alerta" style="color: red"></label>
        <table>
            <tr>
                <th colspan="2"><?= strtoupper($accion)?> ARCHIVO</th>
            </tr>
            <tr>
                <th colspan="2"><?= strtoupper($datosProceso->getNombre())?></th>
            </tr>
            <tr>
                <th>Nombre:</th>
                <td><input type="text" name="nombre" required></td>
            </tr>
            <tr>
                <th>Archivo:</th>
                <td><input type="file" name="archivo" required accept=".pdf"></td>
            </tr>
            
            <tr>
            
                <th colspan="2">
                    <input type="hidden"  name="rutaAnterior" value="<?=$archivoProceso->getRuta()?>">
                    <input type="hidden" name="ideProceso" value="<?=$datosProceso->getIde()?>">
                    <input type="submit" value="<?=$accion?>" name="accion">
                </th>
            </tr>
            
        </table>
        
    </form>
    </center>
</div>
