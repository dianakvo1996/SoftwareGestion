<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/FormatoProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/OpcionesProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$datosOpciones=new OpcionesProceso("ide", $ideOpcion);

if ($accion=='Modificar') {
    $formatoProceso=new FormatoProceso("Codigo", $codigo);
}else{
    $formatoProceso=new FormatoProceso(null, null);
}
?>
<a href="principal.php?CONTENIDO=calidad/administrador/formatosProceso.php&ideOpcion=<?=$ideOpcion?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="50px"></a>
<div id="formulario">
    <center>
    <form action="calidad/administrador/formatosProcesoActualizar.php" method="post" enctype="multipart/form-data">
        <label id="alerta" style="color: red"></label>
        <table>
            <tr>
                <th colspan="2"><?= strtoupper($accion)?> FORMATO</th>
            </tr>
            <tr>
                <th colspan="2"><?= strtoupper($datosOpciones->getProcesoEnObjeto()->getNombre())?></th>
            </tr>
            <tr>
                <th>Nombre:</th>
                <td><input type="text" name="nombre" value="<?=$formatoProceso->getNombre()?>"></td>
            </tr>
            <tr>
                <th>Formato:</th>
                <td><input type="file" name="formato" accept=".pdf,.xls,.xlsx,.doc,.docx,.ppt,.pptx"></td>
            </tr>
            
            <tr>
            
                <th colspan="2">
                    <input type="hidden"  name="usuarioActual" value="<?=$_SESSION['usuario']?>">
                    <input type="hidden"  name="rutaAnterior" value="<?=$formatoProceso->getRuta()?>">
                    <input type="hidden" name="ideOpcion" value="<?=$datosOpciones->getIde()?>">
                    <input type="hidden" name="codigo" value="<?=$formatoProceso->getCodigo()?>">
                    <input type="hidden" name="tipoAnterior" value="<?=$formatoProceso->getTipo()?>">
                    <input type="submit" value="<?=$accion?>" name="accion">
                </th>
            </tr>    
        </table>        
    </form>
        </center>
</div>

