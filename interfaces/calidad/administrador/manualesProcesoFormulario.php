<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/OpcionesProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/ManualesProceso.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$datosOpciones=new OpcionesProceso("ide", $ideOpcion);

if ($accion=='Modificar') {
    $manualProceso=new ManualesProceso("codigo", $codigo);
    $requerido='';
}else{
    $manualProceso=new ManualesProceso(null, null);
    $requerido="required";
}
?>
<a href="principal.php?CONTENIDO=calidad/administrador/manualesProceso.php&ideOpcion=<?=$datosOpciones->getIde()?>"><img src="../presentacion/iconos/atras.png" title="Volver" width="50px"></a>
<div id="formulario">
    <center>
    <form action="calidad/administrador/manualesProcesoActualizar.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <th colspan="2"><?= strtoupper($accion)?> MANUAL</th>
            </tr>
            <tr>
                <th colspan="2"><?= strtoupper($datosOpciones->getProcesoEnObjeto()->getNombre())?></th>
            </tr>
            <tr>
                <th>Nombre:</th>
                <td><input type="text" name="nombre" required value="<?=$manualProceso->getNombre()?>"></td>
            </tr>
            <tr>
                <th>Manual:</th>
                <td><input type="file" name="manual" <?=$requerido?> accept=".pdf"></td>
            </tr>
            
            <tr>
            
                <th colspan="2">
                    <input type="hidden"  name="usuarioActual" value="<?=$_SESSION['usuario']?>">
                    <input type="hidden"  name="rutaAnterior" value="<?=$manualProceso->getRuta()?>">
                    <input type="hidden" name="ideOpcion" value="<?=$datosOpciones->getIde()?>">
                    <input type="hidden" name="codigo" value="<?=$manualProceso->getCodigo()?>">
                    <input type="hidden" name="tipoAnterior" value="<?=$manualProceso->getTipo()?>">
                    <input type="submit" value="<?=$accion?>" name="accion">
                </th>
            </tr>
            
        </table>
        
    </form>
    </center>
</div>

