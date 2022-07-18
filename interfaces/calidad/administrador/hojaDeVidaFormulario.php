<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/HojaDeVida.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;
$extra='';
if ($accion=='Adicionar'){
    $hojaVida=new HojaDeVida (null, null);
	$extra="required";
}else{
    $hojaVida=new HojaDeVida('ide', $ide);
}
?>
<a href="principal.php?CONTENIDO=calidad/administrador/hojasDeVida.php"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="formulario">
    <center>
	<form method="POST" action="calidad/administrador/hojaDeVidaActualizar.php" enctype="multipart/form-data">
        <table>
            <tr>
                <th colspan="2"><?= strtoupper($accion)?> HOJA DE VIDA</th>
            </tr>
            <tr>
                <th>NOMBRE COMPLETO:</th>
                <td><input type="text" name="nombre" value="<?=$hojaVida->getNombre()?>" required onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
            </tr>
            <tr>
                <th>CARGO:</th>
                <td><input type="text" name="cargo" value="<?=$hojaVida->getCargo()?>" required onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
            </tr>
            <tr>
                <th>PROCESO:</th>
                <td><select class="cajon" name="area"><option>--Seleccione Proceso--</option><?=$hojaVida->getAreaOptions()?></select></td>
            </tr>
            <tr>
                <th>CIUDAD:</th>
                <td><select class="cajon" name="codCiudad"><option>--Seleccione Ciudad--</option><?=$hojaVida->getCiudadesOptions()?></select></td>
            </tr>
			<tr>
				<th>HOJA DE VIDA:</th>
				<td><input type="file" name="archivo" accept=".pdf" <?=$extra?>></td>
			</tr>
			<tr>
                <th colspan="2">
					<input type="hidden" name="ide" value="<?=$hojaVida->getIde()?>">
					<input type="hidden" name="rutaAnterior" value="<?=$hojaVida->getRuta()?>">
					<input type="submit" name="accion" value="<?=$accion?>">
					
				</th>
            </tr>
        </table>
		</form>
    </center>
</div>