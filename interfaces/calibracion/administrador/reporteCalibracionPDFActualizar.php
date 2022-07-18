<?php

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/ReporteCalibracionPDF.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

switch($accion){
	case 'Adicionar':
		$reporte=new ReporteCalibracionPDF(null,null);
		$reporte->setFecha($fecha);
		$reporte->setIdeEquipo($ideEquipo);
//Inicio subir Reporte
        $origen = $_FILES['archivo']['tmp_name'];
		if($origen!=""){
           	list($archivo, $extension) = explode('.', $_FILES['archivo']['name']);
        		$destino = '/var/www/html/SoftwareGestion/ReporteCalibracionPDF/' . $archivo.'_'.date('YmdHis'). '.' . $extension;         
        		if (move_uploaded_file($origen, $destino)) {
					$reporte->setArchivo($archivo.'_'.date('YmdHis'). '.' . $extension);
					$reporte->adicionar();
				}
        }
	break;
	case 'Eliminar':
		$reporte=new ReporteCalibracionPDF('ide',$ide);
		if (unlink("/var/www/html/SoftwareGestion/ReporteCalibracionPDF/".$reporte->getArchivo())) {
			$reporte->eliminar();
		}
	break;
}
header('Location: ../../principal.php?CONTENIDO=calibracion/administrador/reportesCalibracionPDF.php&ideEquipo='.$ideEquipo);
