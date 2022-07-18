<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/RutinaExtra.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/TipoEquipo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

if ($accion=='Modificar') {
    $rutinaExtra=new RutinaExtra('ide', $ideRutina);
}else{
    $rutinaExtra=new RutinaExtra(null, null);
}
$tipoEquipo=new TipoEquipo('ide', $ideTipoEquipo);
if ($rutinaExtra->getDescripcion()==null) {
    $inicio='-';
}else{
    $inicio='';
}
?>
<div id="formulario">
    <center>
        <form action="mantenimiento/administrador/rutinaExtraActualizar.php" method="POST">
        <table>
            <tr>
                <th colspan="2"><?= strtoupper($accion)?> RUTINA</th>
            </tr>
            <tr>
                <th>Equipo</th>
                <td><?=$tipoEquipo->getNombre()?></td>
            </tr>
            <tr>
                <th>Rutina</th>
                <td>
                    <textarea name="descripcion" cols="25" rows="6" id="descripcion" class="textarea" onkeypress="adicionarItem()" style="text-transform: uppercase"  onkeyup="javascript:this.value=this.value.toUpperCase();"><?=$inicio.$rutinaExtra->getDescripcion()?></textarea>
                </td>
            </tr>
            <tr>
                <th colspan="2">
                    <input type="hidden" name="ideTipoEquipo" value="<?=$tipoEquipo->getIde()?>" >
                    <input type="hidden" name="ide" value="<?=$rutinaExtra->getIde()?>" >
                    <input type="submit" name="accion" value="<?=$accion?>" >
                </th>
            </tr>
        </table>
    </form>
    </center>
</div>
<script>
        function adicionarItem() {
            var key = window.event.keyCode;
           // If the user has pressed enter
           if (key === 13) {
               document.getElementById("descripcion").value = document.getElementById("descripcion").value + "\n-";
               return false;
           }
           else {
               return true;
           }
        }
</script>