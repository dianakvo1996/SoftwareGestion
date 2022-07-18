<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$cliente=new Cliente('nit', "'".$nitCliente."'");
switch ($accion) {
    case 'Adicionar':
        $equipo=new Equipo(null, null);
        $equipo->setNombreEquipo(strtoupper($nombreEquipo));
        $equipo->setMarca(strtoupper($marca));
        $equipo->setModelo(strtoupper($modelo));
        $equipo->setSerial(strtoupper($serial));
        $equipo->setActivoFijo(strtoupper($activoFijo));
        $equipo->setUbicacion(strtoupper($ubicacion));
        $equipo->setNitCliente($cliente->getNit());
		$equipo->setRegistroInvima($registroInvima);
		$equipo->setReferencia($referencia);
        $equipo->adicionarEquipoCliente('null');
     break;
    case 'Modificar':
        $equipo=new Equipo('ide', $ide);
        $equipo->setNombreEquipo(strtoupper($nombreEquipo));
        $equipo->setMarca(strtoupper($marca));
        $equipo->setModelo(strtoupper($modelo));
        $equipo->setSerial(strtoupper($serial));
        $equipo->setActivoFijo(strtoupper($activoFijo));
        $equipo->setUbicacion(strtoupper($ubicacion));
        $equipo->setNitCliente($cliente->getNit());
		$equipo->setRegistroInvima($registroInvima);
		$equipo->setReferencia($referencia);
        $equipo->ModificarEquipoCliente('null');
     break;
    case 'Eliminar':
        $equipo=new Equipo('ide', $ide);
        $equipo->Eliminar();
     break;

}
header('Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/equiposCliente.php&nit='.$cliente->getNit());

