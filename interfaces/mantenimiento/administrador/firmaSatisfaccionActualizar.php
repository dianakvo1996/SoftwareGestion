<?php

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ReportePreventivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/FirmaSatisfaccion.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$img = $_POST['base64'];
$img = str_replace('data:image/png;base64,', '', $img);
$fileData = base64_decode($img);
$fileName = uniqid().'.png';
if(file_put_contents('../../../FirmasIMG/FirmaSatisfaccion/'.$fileName, $fileData)){
	for ($i = 1; $i <= $numReportes; $i++) {
    	if(isset($_POST["numReporte$i"])) {
			$firmaSatisfaccion=new FirmaSatisfaccion(null,null);
			$firmaSatisfaccion->setNumReporte($_POST["numReporte$i"]);
			$firmaSatisfaccion->setImgFirma($fileName);
			$firmaSatisfaccion->adicionar();
		}
	}	
}

header("Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/equiposMantenimientoSede.php&ide=".$ideMantenimiento);