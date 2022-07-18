<?php

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/DatosFabricante.php';

$datos=DatosFabricante::getDatosEnObjetos(null,'tipo, nombre asc');
$lista='';
for ($i = 0; $i < count($datos); $i++) { 
	$objeto=$datos[$i];
	$lista.='<tr>';
	$lista.="<td>{$objeto->getTipoLista()}</td>";
	$lista.="<td>{$objeto->getNombre()}</td>";
	$lista.="<td>{$objeto->getTelefono()}</td>";
	$lista.="<td>{$objeto->getDireccion()}</td>";
	if($objeto->getTipo()=='F')$lugar=$objeto->getLugarOrigen();
	else $lugar=$objeto->getEmail();
	$lista.="<td>{$lugar}</td>";
	$lista.="<td><a href='principal.php?CONTENIDO=mantenimiento/administrador/fabricantesFormulario.php&accion=Modificar&ide={$objeto->getIde()}'><img src='../presentacion/iconos/modificar.png' height='30px' title='Modificar'></a><img src='../presentacion/iconos/eliminar.png' height='30px' title='Eliminar' onclick='eliminar({$objeto->getIde()})'></td>";
	$lista.='</tr>';
}
?>
<div id="listados">
	<table>
		<tr>
			<th colspan="6" class="tituloSuperior">FABRICANTES - PROVEEDORES</th>
		</tr>
		<tr>
			<th>TIPO</th>
			<th>NOMBRE</th>
			<th>TELEFONO</th>
			<th>DIRECCION</th>
			<th>LUGAR ORIGEN/EMAIL</th>
			<th><a href="principal.php?CONTENIDO=mantenimiento/administrador/fabricantesFormulario.php&accion=Adicionar" class="enlace">ADICIONAR</a></th>
		</tr>
		<?=$lista?>
	</table>
</div>
<script>
	function eliminar(ide){
		if(confirm("Esta seguro de eliminar registro")){
			location = 'mantenimiento/administrador/fabricantesActualizar.php?accion=Eliminar&ide='+ide;

		}
	}
</script>