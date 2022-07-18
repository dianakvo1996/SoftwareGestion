<?php

require_once dirname(__FILE__) . '/../../../clasesGenericas/Usuario.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/ConectorBD.php';


foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

switch($accion){
	case 'Quitar':
		$cadenaSQL="update usuario set acceso='N' where usuario='{$usuario}'";
		ConectorBD::ejecutarQuery($cadenaSQL,null);
	break;
}

header('Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/usuario.php');
?>