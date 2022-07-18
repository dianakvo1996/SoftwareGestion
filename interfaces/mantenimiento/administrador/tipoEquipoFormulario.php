<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/TipoEquipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ManualEquipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/GuiaEquipo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$auxiliar='';
$inicio='-';
if ($accion=='Modificar') {
    	$tipo=new TipoEquipo('ide', $ide);
	$guiaRapida=new GuiaEquipo('ideTipoEquipo',$ide);
    $inicio='';
	$requerido="";
    if ($tipo->getCalibrable()=='S') $auxiliar='checked';
    if ($tipo->getRutina()==null)$inicio='-';
} else {
    	$tipo=new TipoEquipo(null, null);
	$guiaRapida=new GuiaEquipo(null,null);
	$requerido="required";
}

$datosLista=TipoEquipo::getNombreArreglo(null,null);
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/tiposEquipos.php"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="formulario" >
    <center>
        <form action="mantenimiento/administrador/tipoEquipoActualizar.php" method="POST" enctype="multipart/form-data"  name="formTipo">
        <table>
            <tr>
                <th colspan="2"><?= strtoupper($accion)?> EQUIPO</th>
            </tr>
            <tr>
                <th>Nombre</th>
                <td><input type="text" class="awesomplete" name="nombre" spellcheck="false" value="<?=$tipo->getNombre()?>" style="text-transform: uppercase"  required="true" autocomplete="off" data-list="<?=$datosLista?>" data-minChars="1"></td>
            </tr>
            <tr>
                <th>Calibrable</th>
                <td>
                    <label><input type="checkbox" <?=$auxiliar?> name="calibrable" value="S" style="width:50px">Si</label>
                </td>
            </tr>
            <tr>
                <th>Rutina</th>
                <td>
                    <textarea class="textarea" cols="25" rows="6" id="rutina" name="rutinas" style="text-transform: uppercase" spellcheck="false" ><?=$inicio?><?=$tipo->getRutina()?></textarea>
                </td>
            </tr>
            <tr>
                <th>Tipo Equipo</th>
                <td>
			<select name="tipo" class="cajon"><?=$tipo->getTipoOptions()?></select>
                </td>
            </tr>
			<tr>
                <th>Clasificación Biomédica</th>
                <td>
			<select name="clasificacionBiomedica" class="cajon"><?=$tipo->getClasificacionBiomedicaOptions()?></select>
                </td>
            </tr>
			<tr>
                <th>Clasificación del Riesgo</th>
                <td>
			<select name="clasificacionRiesgo" class="cajon"><?=$tipo->getClasificacionRiesgoOptions()?></select>
                </td>
            </tr>
			<tr>
                <th>Tecnologia Predominante</th>
                <td>
			<select name="tecnologiaPredominante" class="cajon"><?=$tipo->getTecnologiaPredomienanteOption()?></select>
                </td>
            </tr>
		<tr>
                <th>Descripcion Funcional</th>
                <td>
			<textarea name="descripcionFuncional" class="textarea" cols="25" rows="4" style="text-transform: uppercase" required="true"><?=$tipo->getDescripcionFuncional()?></textarea>
                </td>
            </tr>
	<tr>
                <th>Fotografia</th>
                <td>
					<input type="file" class="cajon" accept=".jpg,.jpeg,.png" name="fotografia" id="fotografia" <?=$requerido?>>
                </td>
            </tr>
            <tr>
                <th colspan="2">
		<input type="hidden" name="fotografiaAnterior" value="<?=$tipo->getFotografia()?>">
                    <input type="hidden" name="ide" value="<?=$tipo->getIde()?>">
                    <input type="submit" name="accion" value="<?=$accion?>">
                </th>
            </tr>
        </table>
        </form>
    </center>
</div>
<script>
	function validarAccion(){
        if('<?=$accion?>'==='Adicionar') {
			document.getElementById("fotografia").required = true;
		}else {
			document.getElementById("fotografia").required = false;
		}
	}
</script>