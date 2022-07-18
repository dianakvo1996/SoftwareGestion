<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/PoliticasOperativasProceso.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$datosProceso=new Proceso("ide", $ideProceso);

if ($accion=='Modificar') {
    $politicaOperativaProceso=new PoliticasOperativasProceso("codigo", $codigo);
    $requerido='';
}else{
    $politicaOperativaProceso=new PoliticasOperativasProceso(null, null);
    $requerido="required";
}
?>
<a href="principal.php?CONTENIDO=calidad/administrador/politicasOperativasProceso.php&ideProceso=<?=$ideProceso?>"><img src="../presentacion/iconos/atras.png" title="Atras" height="50px"></a>
<div id="formulario">
    <center>
    <form action="calidad/administrador/politicasProcesoActualizar.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <th colspan="2">CAMBIAR POLITICA OPERATIVA</th>
            </tr>
            <tr>
                <th colspan="2"><?= strtoupper($datosProceso->getNombre())?></th>
            </tr>
            <tr>
                <th>Nombre:</th>
                <td><input type="text" name="nombre" required value="<?=$politicaOperativaProceso->getNombre()?>"></td>
            </tr>
            <tr>
                <th>Politica:</th>
                <td><input type="file" name="politica" <?=$requerido?> accept=".pdf"></td>
            </tr>
            
            <tr>
            
                <th colspan="2">
                    <input type="hidden"  name="usuarioActual" value="<?=$_SESSION['usuario']?>">
                    <input type="hidden"  name="rutaAnterior" value="<?=$politicaOperativaProceso->getRuta()?>">
                    <input type="hidden" name="ideProceso" value="<?=$datosProceso->getIde()?>">
                    <input type="hidden" name="codigo" value="<?=$politicaOperativaProceso->getCodigo()?>">
                    <input type="hidden" name="tipoAnterior" value="<?=$politicaOperativaProceso->getTipo()?>">
                    <input type="submit" value="<?=$accion?>" name="accion">
                </th>
            </tr>
            
        </table>      
    </form>
        </center>
</div>