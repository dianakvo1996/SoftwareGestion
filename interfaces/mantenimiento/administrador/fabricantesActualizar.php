<?php


require_once dirname(__FILE__) . '/../../../clasesMantenimiento/DatosFabricante.php';


foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

switch($accion){
	case 'Adicionar':
		$fabricante=new DatosFabricante(null,null);
		$fabricante->setTipo($tipo);
		$fabricante->setNombre($nombre);
		$fabricante->setTelefono($telefono);
		$fabricante->setDireccion($direccion);
		$fabricante->setEmail("null");
		$fabricante->setLugarOrigen("null");
		if(isset($email))$fabricante->setEmail("'{$email}'");
		if(isset($lugarOrigen))$fabricante->setLugarOrigen("'{$lugarOrigen}'");
		$fabricante->setTelefono($telefono);
		$fabricante->grabar();
		break;

	case 'Modificar':
		$fabricante=new DatosFabricante('ide',$ide);
		$fabricante->setTipo($tipo);
		$fabricante->setNombre($nombre);
		$fabricante->setTelefono($telefono);
		$fabricante->setDireccion($direccion);
		$fabricante->setEmail("null");
		$fabricante->setLugarOrigen("null");
		if(isset($email))$fabricante->setEmail("'{$email}'");
		if(isset($lugarOrigen))$fabricante->setLugarOrigen("'{$lugarOrigen}'");
		$fabricante->setTelefono($telefono);
		$fabricante->modificar();
		break;
	case 'Eliminar':
		$fabricante=new DatosFabricante('ide',$ide);
		$fabricante->eliminar();
		break;
}

header('Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/fabricantes.php');