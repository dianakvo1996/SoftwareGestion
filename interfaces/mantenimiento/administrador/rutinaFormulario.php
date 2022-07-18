<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/TipoEquipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/RutinaEquipo.php';

$tipo=new TipoEquipo('ide', $ideTipo);
if ($accion=='Modificar') {
    $rutina=new RutinaEquipo('ide', $ide);
}else{
    $rutina=new RutinaEquipo(null, null);
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/rutina.php&ideTipo=<?=$tipo->getIde()?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="40px"></a>
<div id="formulario">
    <center>
    <form action="mantenimiento/administrador/rutinaActualizar.php" method="POST">
    <table>
        <tr>
            <th colspan="2"><?= strtoupper($accion)?> RUTINA</th>
        </tr>
        <tr>
            <th colspan="2"><?= strtoupper($tipo->getNombre())?></th>
        </tr>
        <tr>
            <th>Rutina </th>
            <td>
                <textarea class="textarea" cols="40" rows="3" name="descripcion"><?=$rutina->getDescripcion()?></textarea>
            </td>
        </tr>
        <tr>
            <th colspan="2">
                <input type="hidden" name="ide" value="<?=$rutina->getIde()?>">
                <input type="hidden" name="ideTipoEquipo" value="<?=$tipo->getIde()?>">
                <input type="submit" name="accion" value="<?=$accion?>">
            </th>
        </tr>
    </table>
    </form>
    </center>
</div>
<script>
</script>