<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/ProcedimientosProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/OpcionesProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$datosOpciones=new OpcionesProceso("ide", $ideOpcion);

if ($accion=='Modificar') {
    $procedimientoProceso=new ProcedimientosProceso("codigo", $codigo);
    $requerido='';
}else{
    $procedimientoProceso=new ProcedimientosProceso(null, null);
    $requerido="required";
}
?>
<a href="principal.php?CONTENIDO=calidad/administrador/procedimientosProceso.php&ideOpcion=<?=$datosOpciones->getIde()?>"><img src="../presentacion/iconos/atras.png" title="Volver" width="50px"></a>
<div id="formulario">
    <center>
    <form action="calidad/administrador/procedimientosProcesoActualizar.php" method="post" enctype="multipart/form-data">
        <label id="alerta" style="color: red"></label>
        <table>
            <tr>
                <th colspan="2"><?= strtoupper($accion)?> PROCEDIMIENTO</th>
            </tr>
            <tr>
                <th colspan="2"><?= strtoupper($datosOpciones->getProcesoEnObjeto()->getNombre())?></th>
            </tr>
            <tr>
                <th>Nombre:</th>
                <td><input type="text" name="nombre" required value="<?=$procedimientoProceso->getNombre()?>"></td>
            </tr>
            <tr>
                <th>Procedimiento:</th>
                <td><input type="file" name="procedimiento" <?=$requerido?> accept=".pdf"></td>
            </tr>       
            <tr>
            
                <th colspan="2">
                    <input type="hidden"  name="usuarioActual" value="<?=$_SESSION['usuario']?>">
                    <input type="hidden"  name="rutaAnterior" value="<?=$procedimientoProceso->getRuta()?>">
                    <input type="hidden" name="ideOpcion" value="<?=$ideOpcion?>">
                    <input type="hidden" name="codigo" value="<?=$procedimientoProceso->getCodigo()?>">
                    <input type="hidden" name="tipoAnterior" value="<?=$procedimientoProceso->getTipo()?>">
                    <input type="submit" value="<?=$accion?>" name="accion">
                </th>
            </tr>
            
        </table>
        
    </form>
        </center>
</div>