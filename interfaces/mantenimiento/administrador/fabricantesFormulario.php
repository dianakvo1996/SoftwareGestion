<?php

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/DatosFabricante.php';


foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

if($accion=='Modificar'){
	$datosFabricante=new DatosFabricante('ide',$ide);
}else{
	$datosFabricante=new DatosFabricante(null,null);
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/fabricantes.php"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="formulario">
    <center>
		<form method="POST" name="formulario" action="mantenimiento/administrador/fabricantesActualizar.php">
			<table>
	            <tr>
                	<th  colspan="2"><?= strtoupper($accion)?> FABRICANTE / PROVEEDOR</th>
            	</tr>
				<tr>
					<th>TIPO</th>
					<td>
						<?=$datosFabricante->getTipoRadio()?>
					</td>
				</tr>
				<tr>
					<th>NOMBRE</th>
					<td>
						<input type="text" name="nombre" value="<?=$datosFabricante->getNombre()?>" style="text-transform: uppercase" required>						
					</td>
				</tr>
				<tr>
					<th>TELEFONO</th>
					<td>
						<input type="text" name="telefono" value="<?=$datosFabricante->getTelefono()?>" required>
						
					</td>
				</tr>
				<tr>
					<th>DIRECCION</th>
					<td>
						<input type="text" name="direccion" value="<?=$datosFabricante->getDireccion()?>" style="text-transform: uppercase" required>
						
					</td>
				</tr>
				<tr>
					<th>EMAIL</th>
					<td>
						<input type="text" name="email" value="<?=$datosFabricante->getEmail()?>" id="email" disabled style="background:#b4b4b4">
					</td>
				</tr>
				<tr>
					<th>LUGAR ORIGEN</th>
					<td>
						<input type="text" name="lugarOrigen" value="<?=$datosFabricante->getLugarOrigen()?>" id="lugarOrigen" style="text-transform: uppercase;background:#b4b4b4" disabled>						
					</td>
				</tr>
	            <tr>
                	<th  colspan="2">
						<input type="hidden" value="<?=$datosFabricante->getIde()?>" name="ide">
						<input type="submit" name="accion" value="<?=$accion?>">
						
					</th>
            	</tr>

			</table>
		</form>
	</center>
</div>
<script>
	MostrarOpciones()
	function MostrarOpciones(){
		/*Condicion de validacion seleccion*/		 
		for (i = 0; i < document.formulario.tipo.length; i++){
			if (document.formulario.tipo[i].checked) {
				switch (document.formulario.tipo[i].value){
					case 'F':
						document.formulario.lugarOrigen.disabled=false
						document.formulario.email.disabled=true
						document.formulario.lugarOrigen.style.backgroundColor="transparent"
						document.formulario.email.style.backgroundColor="#b4b4b4"
						break;
					case 'P':
						document.formulario.email.disabled=false
						document.formulario.lugarOrigen.style.backgroundColor="#b4b4b4"
						document.formulario.lugarOrigen.disabled=true
						document.formulario.email.style.backgroundColor="transparent"
						break;
				}
	 		}
		}
	}

</script>
