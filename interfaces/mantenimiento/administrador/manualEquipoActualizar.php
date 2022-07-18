<?php

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/TipoEquipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ManualEquipo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

switch($accion){
	case 'SUBIR':
		$manualObjeto=new ManualEquipo(null,null);
		$manualObjeto->setIdeTipoEquipo($ideEquipo);
       		//Inicio subir guia
           	$origen = $_FILES['manual']['tmp_name'];
		if($origen!=null){
           		list($manual, $extension) = explode('.', $_FILES['manual']['name']);
        		$destino = '/var/www/html/SoftwareGestion/ManualEquipo/' . $manual.'_'.date('YmdHis'). '.' . $extension;         
        		if (move_uploaded_file($origen, $destino)) {
				$manualObjeto->setRuta($manual.'_'.date('YmdHis'). '.' . $extension);
				$manualObjeto->adicionar();
        		}
		}
		break;
	case 'ACTUALIZAR':
		$manualObjeto=new ManualEquipo('ide',$ideManual);
		$origen = $_FILES['manual']['tmp_name'];
		if(unlink("/var/www/html/SoftwareGestion/ManualEquipo/".$manualObjeto->getRuta())){
           		list($manual, $extension) = explode('.', $_FILES['manual']['name']);
        		$destino = '/var/www/html/SoftwareGestion/ManualEquipo/' . $manual.'_'.date('YmdHis'). '.' . $extension;         
        		if (move_uploaded_file($origen, $destino)) {
				$manualObjeto->setRuta($manual.'_'.date('YmdHis'). '.' . $extension);
				$manualObjeto->modificar();
        		}
		}
		break;
	case 'ELIMINAR':
		$manualObjeto=new ManualEquipo('ide',$ideManual);
		if(unlink("/var/www/html/SoftwareGestion/ManualEquipo/".$manualObjeto->getRuta())){
				$manualObjeto->eliminar();
        		}
		break;
}
header('Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/manualEquipo.php&pag='.$pagina);
?>