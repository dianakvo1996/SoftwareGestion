<?php

require_once dirname(__FILE__) . '/../../../librerias/dompdf/autoload.inc.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
use Dompdf\Dompdf;

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

date_default_timezone_set('America/Bogota');
$cliente=new Cliente('nit', "'".$nit."'");
$dompdf=new Dompdf();
$dompdf->set_paper('a4','landscape');
$dompdf->load_html( file_get_contents( 'http://laboratoriobiometrical.com.co/SoftwareGestion/interfaces/mantenimiento/administrador/equiposClientePDF.php?nitCliente='.$nit));
ini_set("memory_limit", "128M");
$dompdf->render();
$fecha= "_".date('Y-m-d_His');
$dompdf->stream("InventarioEquipos_".$cliente->getNombre().'_'.$fecha.".pdf",array('enable_remote' => true));