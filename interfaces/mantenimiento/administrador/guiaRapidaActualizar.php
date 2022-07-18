<?php

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/TipoEquipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/GuiaEquipo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

switch ($accion) {
	case 'SUBIR':
		$guiaObjeto=new GuiaEquipo(null,null);
		$guiaObjeto->setIdeTipoEquipo($ideEquipo);
       		//Inicio subir guia
           	$origen = $_FILES['guia']['tmp_name'];
		if($origen!=null){
           		list($guia, $extension) = explode('.', $_FILES['guia']['name']);
        		$destino = '/var/www/html/SoftwareGestion/GuiaRapidaEquipo/' . $guia.'_'.date('YmdHis'). '.' . $extension;         
        		if (move_uploaded_file($origen, $destino)) {
				$guiaObjeto->setRuta($guia.'_'.date('YmdHis'). '.' . $extension);
				$guiaObjeto->adicionar();
        		}
		}
		break;
	case 'ACTUALIZAR':
		$guiaObjeto=new GuiaEquipo('ideTipoEquipo',$ideEquipo);
		$origen = $_FILES['guia']['tmp_name'];
		if(unlink("/var/www/html/SoftwareGestion/GuiaRapidaEquipo/".$guiaObjeto->getRuta())){
           		list($guia, $extension) = explode('.', $_FILES['guia']['name']);
        		$destino = '/var/www/html/SoftwareGestion/GuiaRapidaEquipo/' . $guia.'_'.date('YmdHis'). '.' . $extension;         
        		if (move_uploaded_file($origen, $destino)) {
				$guiaObjeto->setRuta($guia.'_'.date('YmdHis'). '.' . $extension);
				$guiaObjeto->modificar();
        		}
		}
		break;
	case 'ELIMINAR':
		$guiaObjeto=new GuiaEquipo('ideTipoEquipo',$ideEquipo);
		if(unlink("/var/www/html/SoftwareGestion/GuiaRapidaEquipo/".$guiaObjeto->getRuta())){
				$guiaObjeto->eliminar();
        		}
		break;
}
header('Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/guiaEquipo.php&pag='.$pagina);