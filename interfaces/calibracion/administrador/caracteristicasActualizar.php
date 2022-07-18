<?php
require_once dirname(__FILE__) . '/../../../clasesCalibracion/NombreEquipo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable => $Valor) ${$Variable} = $Valor;

switch($accion){
	case 'Adicionar':
		$nombreEquipo=new NombreEquipo(null,null);
		$nombreEquipo->setNombre(strtoupper($nombre));
		$nombreEquipo->setTipo($tipo);
		$nombreEquipo->setClasificacionBiomedica($clasificacionBiomedica);
		$nombreEquipo->adicionar();
		break;
	case 'Modificar':
		$nombreEquipo=new NombreEquipo('ide',$ide);
		$nombreEquipo->setNombre(strtoupper($nombre));
		$nombreEquipo->setTipo($tipo);
		$nombreEquipo->setClasificacionBiomedica($clasificacionBiomedica);
		$nombreEquipo->modificar();
		break;
	case 'Eliminar':
		$nombreEquipo=new NombreEquipo('ide',$ide);
		$nombreEquipo->eliminar();
		break;
}

header('Location: ../../principal.php?CONTENIDO=calibracion/administrador/equiposCaracteristicas.php');
?>