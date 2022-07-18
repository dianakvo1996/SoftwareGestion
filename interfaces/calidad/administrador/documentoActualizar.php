<?php

require_once dirname(__FILE__) . '/../../../clasesCalidad/DocumentoGestion.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

date_default_timezone_set("America/Bogota");
$fecha=date('dmYHisu');
switch($accion){
	case'Agregar':
		$documento= new DocumentoGestion(null,null);
		$documento->setNitCliente($nitCliente);
        $documento->setIdeTipo($ideTipo);
// grabar archivo
		$origen = $_FILES['archivo']['tmp_name'];
        list($archivo, $extension) = explode('.', $_FILES['archivo']['name']);
		
		$destino = '/var/www/html/SoftwareGestion/Documento_Gestion/'.$archivo.$fecha.'.' . $extension;

		if (move_uploaded_file($origen, $destino)) {
			$documento->setRuta($archivo.$fecha.'.' . $extension);
			$documento->adicionar();         
		}
        
		break;
	case 'Actualizar':
		$documento= new DocumentoGestion('ide',$ideDocumento);
		if (unlink("/var/www/html/SoftwareGestion/Documento_Gestion/".$documento->getRuta())) {
			$origen = $_FILES['archivo']['tmp_name'];
        	list($archivo, $extension) = explode('.', $_FILES['archivo']['name']);
		
			$destino = '/var/www/html/SoftwareGestion/Documento_Gestion/'.$archivo.$fecha.'.' . $extension;

			if (move_uploaded_file($origen, $destino)) {
				$documento->setRuta($archivo.$fecha.'.' . $extension);
				$documento->modificar();         
			}
		}		
		break;
}

 
header('Location: ../../principal.php?CONTENIDO=calidad/administrador/documentosGestion.php&nitCliente='.$nitCliente);

?>