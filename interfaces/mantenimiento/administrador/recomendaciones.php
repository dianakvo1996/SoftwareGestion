<?php

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/TipoEquipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/InformacionExtra.php';

$tipoEquipo=new TipoEquipo('ide', $ideTipoEquipo);

$datos= InformacionExtra::getDatosEnObjetos('ideTipoEquipo='.$ideTipoEquipo,'ide');
$lista='';
$item=1;
for($i = 0; $i < count($datos); $i++){
    $objeto=$datos[$i];
	$lista.='<tr>';
	$lista.="<td>{$item}</td>";
	$lista.="<td style='text-align:left'>{$objeto->getRecomendacionesFabricanteListaOrdenada()}</td>";
    $lista.="<td><a href='principal.php?CONTENIDO=mantenimiento/administrador/recomendacionesFormulario.php&accion=Modificar&ide={$objeto->getIde()}&ideTipoEquipo={$objeto->getIdeTipoEquipo()}'><img src='../presentacion/iconos/modificar.png' height='20px'></a>";
    $lista.="<img src='../presentacion/iconos/eliminar.png' height='20px' onclick='eliminar({$objeto->getIde()})'>"; 	
	$lista.="</td>";
	$lista.='</tr>';
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/tiposEquipos.php"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="listados">
	<table>
		<tr>
			<th  class="tituloSuperior" colspan="3">RECOMENDACIONDES DEL FABRICANTE</th>
		</tr>
		<tr>
			<th  class="tituloSuperior" colspan="3"><?=$tipoEquipo->getNombre()?></th>
		</tr>
		<tr>
			<th style="width: 20px">#</th>
			<th style="width: 90%">RECOMENDACION</th>
			<th><a href="principal.php?CONTENIDO=mantenimiento/administrador/recomendacionesFormulario.php&accion=Adicionar&ideTipoEquipo=<?=$ideTipoEquipo?>"><img src='../presentacion/iconos/adicionar.png' height='30px'></a></th>
		</tr>
		<?=$lista?>
	</table>
</div>

<script>
	function eliminar(ide){
		if(confirm("Esta seguro de eliminar registro")){
			location = 'mantenimiento/administrador/recomendacionesActualizar.php?accion=Eliminar&ide='+ide+'&ideTipoEquipo='+<?=$ideTipoEquipo?>;
		}
	}
</script>