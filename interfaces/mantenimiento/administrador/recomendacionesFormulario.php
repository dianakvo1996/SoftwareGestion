<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/TipoEquipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/InformacionExtra.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$tipoEquipo=new TipoEquipo('ide', $ideTipoEquipo);

if($accion=='Modificar'){
	$recomendaciones=new InformacionExtra('ide',$ide);
}else{
	$recomendaciones=new InformacionExtra(null,null);
}

?>

<a href="principal.php?CONTENIDO=mantenimiento/administrador/recomendaciones.php&ideTipoEquipo=<?=$ideTipoEquipo?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="formulario">
    <center>
	<form method="POST" name="formulario" action="mantenimiento/administrador/recomendacionesActualizar.php">
		<table>
			<tr>
				<th  colspan="2"><?= strtoupper($accion)?> RECOMENDACIONES</th>
			</tr>
			<tr>
				<th  colspan="2"><?=$tipoEquipo->getNombre()?></th>
			</tr>
			<tr>
				<th>RECOMENDACION</th>
				<td>
					<textarea class="textarea" cols="40" rows="5" name="recomendacionesFabricante"><?=$recomendaciones->getRecomendacionesFabricante()?></textarea>
				</td>
			</tr>
			<tr>
				<th colspan="2">
					<input type="hidden" name="ide" value="<?=$ide?>">	
					<input type="hidden" name="ideTipoEquipo" value="<?=$ideTipoEquipo?>">	
					<input type="submit" name="accion" value="<?=$accion?>">
				</th>
			</tr>
		</table>
	</form>
	</center>
</div>