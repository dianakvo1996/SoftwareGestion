<?php

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/InformacionExtra.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

switch($accion){
	case 'Adicionar':
		$recomendaciones=new InformacionExtra(null,null);
		$recomendaciones->setIdeTipoEquipo($ideTipoEquipo);
		$recomendaciones->setRecomendacionesFabricante($recomendacionesFabricante);
		$recomendaciones->adicionar();
		break;
	case 'Modificar':
		$recomendaciones=new InformacionExtra('ide',$ide);
		$recomendaciones->setRecomendacionesFabricante($recomendacionesFabricante);
		$recomendaciones->modificar();
		break;
	case 'Eliminar':
		$recomendaciones=new InformacionExtra('ide',$ide);
		$recomendaciones->eliminar();
		break;
}
header('Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/recomendaciones.php&ideTipoEquipo='.$ideTipoEquipo);
