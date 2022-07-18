<?php

require_once dirname(__FILE__) . '/../../../clasesCalidad/Persona.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/FirmaIngeniero.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$firmaIng=new FirmaIngeniero('ideIngeniero',"'{$ideIngeniero}'");

if($firmaIng->getIde()==null){
	$img = $_POST['base64'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$fileData = base64_decode($img);
	$fileName = uniqid().'.png';
	if(file_put_contents('../../../FirmasIMG/'.$fileName, $fileData)){
		$firmaIng->setIdeIngeniero($ideIngeniero);
		$firmaIng->setImgFirma($fileName);
		$firmaIng->adicionar();
	}
}else{
$img = $_POST['base64'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$fileData = base64_decode($img);
	$fileName = uniqid().'.png';
	if(unlink("/var/www/html/SoftwareGestion/FirmasIMG/".$firmaIng->getImgFirma())){
		if(file_put_contents('../../../FirmasIMG/'.$fileName, $fileData)){
			$firmaIng->setImgFirma($fileName);
			$firmaIng->modificar();
		}
	}
}

header("Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/usuario.php"); 