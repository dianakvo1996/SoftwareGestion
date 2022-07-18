<?php

require_once dirname(__FILE__) . '/../../../clasesCalidad/PermisoHojaVida.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$cliente=new Cliente('nit',"'{$nitCliente}'");
echo $cliente->getCodCiudad();
switch($accion){
	case'Add':
		$permisoHV=new PermisoHojaVida(null,null);
		$permisoHV->setNitCliente($nitCliente);
		$permisoHV->setCodCiudad($cliente->getCodCiudad());
		$permisoHV->setPermiso($permiso);
		$permisoHV->adicionar();
		break;
	case 'Up':
		$permisoHV=new PermisoHojaVida('nitCliente',"'{$nitCliente}'");
		$permisoHV->setPermiso($permiso);
		$permisoHV->modificar();
		break;
}

header('Location: ../../principal.php?CONTENIDO=calidad/administrador/documentosGestion.php&nitCliente='.$nitCliente);
