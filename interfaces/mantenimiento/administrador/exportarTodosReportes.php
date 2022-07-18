<?php
require_once dirname(__FILE__) . '/../../../librerias/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;
date_default_timezone_set('America/Bogota');

$dompdf=new Dompdf();
$dompdf->set_paper('letter','portrait');
$dompdf->load_html( file_get_contents( 'http://laboratoriobiometrical.com.co/SoftwareGestion/interfaces/mantenimiento/administrador/totalReportes.php?numeroReporte='.$numeroReporte));
ini_set("memory_limit", "128M");
$dompdf->render();
$fecha= "_".date('Y-m-d_His');
$dompdf->stream("reportesPreventivos.pdf",array('enable_remote' => true));
?>