<?php

require_once dirname(__FILE__) . '/../../../clasesCalidad/TipoDocumento.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

switch($accion){
	case'Adicionar':
		$tipo = new TipoDocumento(null,null);
		$tipo->setNombre($nombre);
        $tipo->setTipo($tipoD);
        $tipo->adicionar();
		break;
}

header('Location: ../../principal.php?CONTENIDO=calidad/administrador/documentosGestion.php&nitCliente='.$nitCliente);
?>