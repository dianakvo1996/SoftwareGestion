<?php


require_once dirname(__FILE__) . '/../../../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../../../librerias/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

date_default_timezone_set('America/Bogota');

$documento = new Spreadsheet();
$documento
    ->getProperties()
    ->setCreator("Quality System")
    ->setLastModifiedBy('Quality System') // última vez modificado por
    ->setTitle('Hoja de vida Equipo Biomedico')
    ->setDescription('Este documento fue generado para Laboratorio Biometrical S.A.S')
    ->setKeywords('hoja vida')
    ->setCategory('Documentos');
 
	$hoja = $documento->getActiveSheet();
	$hoja->setTitle("HOJA DE VIDA EQUIPO BIOMEDICO");
	$hoja->setCellValue("A1", "HOJA DE VIDA DE EQUIPO BIOMEDICO");
	$hoja->setCellValue("A2", "INFORMACIÓN GENERAL");
	$hoja->setCellValue("A3", "NOMBRE DEL EQUIPO");
//Inicio estilos
	$hoja->getStyle('A1')->getFont()->setBold(true)->setSize(12);
	$hoja->mergeCells('A2:D2');
//Fin estilos


	$nombreDelDocumento = "Hoja de Vida Equipo.xlsx";
/**
 * Los siguientes encabezados son necesarios para que
 * el navegador entienda que no le estamos mandando
 * simple HTML
 * Por cierto: no hagas ningún echo ni cosas de esas; es decir, no imprimas nada
 */
 
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
header('Cache-Control: max-age=0');
 
$writer = IOFactory::createWriter($documento, 'Xlsx');
$writer->save('php://output');
exit;