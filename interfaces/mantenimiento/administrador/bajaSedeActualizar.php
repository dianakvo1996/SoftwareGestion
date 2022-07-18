<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$direccion='';

if(isset($ideSede)){
$sede=new Sede('ide',$ideSede);
}else{
$cliente=new Cliente('nit',"'{$nit}'");
}

switch($accion){
	case 'bajarS':
		$cadenaSQL="update sede set baja='SI' where ide={$ideSede}";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
		$direccion="sedes.php&nit=".$sede->getNitCliente();
	break;
	case 'volverS':
		$cadenaSQL="update sede set baja='' where ide={$ideSede}";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
	break;
	case 'bajarC':
		$cadenaSQL="update cliente set baja='SI' where nit='{$nit}'";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
		$direccion="clientes.php";
	break;
	case 'volverC':
		$cadenaSQL="update cliente set baja='' where ide={$ideSede}";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
	break;


}
header('Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/'.$direccion);