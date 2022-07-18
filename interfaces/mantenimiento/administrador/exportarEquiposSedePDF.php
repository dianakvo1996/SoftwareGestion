<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../librerias/dompdf/autoload.inc.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
use Dompdf\Dompdf;

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;
date_default_timezone_set('America/Bogota');
$sede=new Sede('ide',$ideSede);

$dompdf=new Dompdf();
$dompdf->set_paper('letter','landscape');
$dompdf->load_html( file_get_contents( 'http://laboratoriobiometrical.com.co/SoftwareGestion/interfaces/mantenimiento/administrador/equiposSedePDF.php?ideSede='.$ideSede));
ini_set("memory_limit", "128M");
$dompdf->render();
$fecha= "_".date('Y-m-d_His');
$dompdf->stream("InventarioEquipos_".$sede->getCliente()->getNombre().'-'.$sede->getNombre().'_'.$fecha.".pdf",array('enable_remote' => true));