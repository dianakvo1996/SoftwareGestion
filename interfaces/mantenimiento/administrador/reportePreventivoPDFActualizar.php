<?php

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ReportePreventivoPDF.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$direccion="";
$mantenimiento=new MantenimientoPreventivo('ide',$ideMantenimiento);
if($mantenimiento->getIdeSede()!=null){
$direccion='equiposMantenimientoSedePDF.php';
}else{
$direccion="equiposMantenimientoClientePDF.php";
}
switch($accion){
	case 'Subir':
		$reportePreventivoPDF=new ReportePreventivoPDF(null,null);
		$reportePreventivoPDF->setIdeEquipo($ideEquipo);
		$reportePreventivoPDF->setIdeMantenimientoPreventivo($ideMantenimiento);
		$reportePreventivoPDF->setFecha($fecha);
		//Inicio subir Reporte
        $origen = $_FILES['reporte']['tmp_name'];
		if($origen!=""){
           	list($reporte, $extension) = explode('.', $_FILES['reporte']['name']);
        		$destino = '/var/www/html/SoftwareGestion/ReportePreventivosPDF/' . $reporte.'_'.date('YmdHis'). '.' . $extension;         
        		if (move_uploaded_file($origen, $destino)) {
					$reportePreventivoPDF->setArchivo($reporte.'_'.date('YmdHis'). '.' . $extension);
					$reportePreventivoPDF->adicionar();
				}
        }
	break;
}
header('Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/'.$direccion.'&ide='.$ideMantenimiento);