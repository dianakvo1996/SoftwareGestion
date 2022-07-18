<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/CaracterizacionProceso.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$datosProceso=new Proceso("ide", $ideProceso);

if ($accion=='Modificar') {
    $caracterizacionProceso=new CaracterizacionProceso("codigo", $codigo);
    $requerido='';
}else{
    $caracterizacionProceso=new CaracterizacionProceso(null, null);
    $requerido="required";
}
?>
<a href="principal.php?CONTENIDO=calidada/administrador/caracterizacionProceso.php&ideProceso=<?=$ideProceso?>"><img src="../presentacion/iconos/atras.png" title="Atras" height="50px"></a>
<div id="formulario">
    <center>
    <form action="calidad/administrador/caracterizacionProcesoActualizar.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <th colspan="2">CAMBIAR CARACTERIZACIÓN</th>
            </tr>
            <tr>
                <th colspan="2"><?= strtoupper($datosProceso->getNombre())?></th>
            </tr>
            <tr>
                <th>Nombre:</th>
                <td><input type="text" name="nombre" required value="<?=$caracterizacionProceso->getNombre()?>"></td>
            </tr>
            <tr>
                <th>Caracterización:</th>
                <td><input type="file" name="caracterizacion" <?=$requerido?> accept=".pdf"></td>
            </tr>
            
            <tr>
            
                <th colspan="2">
                    <input type="hidden"  name="usuarioActual" value="<?=$_SESSION['usuario']?>">
                    <input type="hidden"  name="rutaAnterior" value="<?=$caracterizacionProceso->getRuta()?>">
                    <input type="hidden" name="ideProceso" value="<?=$datosProceso->getIde()?>">
                    <input type="hidden" name="codigo" value="<?=$caracterizacionProceso->getCodigo()?>">
                    <input type="hidden" name="tipoAnterior" value="<?=$caracterizacionProceso->getTipo()?>">
                    <input type="submit" value="<?=$accion?>" name="accion">
                </th>
            </tr>
            
        </table>
        
    </form>
        </center>
</div>