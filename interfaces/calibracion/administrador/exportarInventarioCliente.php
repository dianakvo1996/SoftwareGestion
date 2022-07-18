<?php
require_once dirname(__FILE__) . '/../../../librerias/PHPExcel-1.8/Classes/PHPExcel.php';
require_once dirname(__FILE__) . '/../../../librerias/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php';

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator('Quality System');
$objPHPExcel->getProperties()->setTitle('Inventario Calibracion');
$objPHPExcel->setActiveSheetIndex(0); //Elegimos la hoja 0

$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,1,'Contenido de la celda A1');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,1,'Contenido de la celda B1');
$objPHPExcel->mergeCells("D1:E1");
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save('/var/www/html/SoftwareGestion/excelDescargas/aaaa.xlsx');
?>