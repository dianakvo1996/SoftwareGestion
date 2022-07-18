<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/OpcionesProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/GuiasProceso.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$datosOpciones=new OpcionesProceso("ide", $ideOpcion);

if ($accion=='Modificar') {
    $guiaProceso=new GuiasProceso("codigo", $codigo);
    $requerido='';
}else{
    $guiaProceso=new GuiasProceso(null, null);
    $requerido="required";
}
?>
<a href="principal.php?CONTENIDO=calidad/administrador/guiasProceso.php&ideOpcion=<?=$datosOpciones->getIde()?>"><img src="../presentacion/iconos/atras.png" title="Volver" width="50px"></a>
<div id="formulario">
    <center>
    <form action="calidad/administrador/guiasProcesoActualizar.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <th colspan="2"><?= strtoupper($accion)?> GUIA</th>
            </tr>
            <tr>
                <th colspan="2"><?= strtoupper($datosOpciones->getProcesoEnObjeto()->getNombre())?></th>
            </tr>
            <tr>
                <th>Nombre:</th>
                <td><input type="text" name="nombre" required value="<?=$guiaProceso->getNombre()?>"></td>
            </tr>
            <tr>
                <th>Guia:</th>
                <td><input type="file" name="guia" <?=$requerido?> accept=".pdf"></td>
            </tr>
            
            <tr>
            
                <th colspan="2">
                    <input type="hidden"  name="usuarioActual" value="<?=$_SESSION['usuario']?>">
                    <input type="hidden"  name="rutaAnterior" value="<?=$guiaProceso->getRuta()?>">
                    <input type="hidden" name="ideOpcion" value="<?=$datosOpciones->getIde()?>">
                    <input type="hidden" name="codigo" value="<?=$guiaProceso->getCodigo()?>">
                    <input type="hidden" name="tipoAnterior" value="<?=$guiaProceso->getTipo()?>">
                    <input type="submit" value="<?=$accion?>" name="accion">
                </th>
            </tr>
            
        </table>
        
    </form>
        </center>
</div>