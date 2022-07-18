<?php

require_once dirname(__FILE__) . '/../../../librerias/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

	$dompdf = new DOMPDF();
	$dompdf->set_paper("letter", "landscape");
	$dompdf->load_html( file_get_contents( 'http://laboratoriobiometrical.com.co/SoftwareGestion/interfaces/mantenimiento/administrador/imprimirHojaVidaEquipo.php?ideEquipo='.$ideEquipo ));
	$dompdf->render();
	$dompdf->stream("mi_archivo.pdf");
?>