<?php
require_once dirname(__FILE__) . '/../../../clasesCalibracion/ClienteC.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/EquipoC.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable => $Valor) ${$Variable} = $Valor;

$cliente=new ClienteC('nit', "'".$nitCliente."'");
switch ($accion) {
    case 'Adicionar':
        $equipo=new EquipoC(null,null);
        $equipo->setNombreEquipo(trim($nombreEquipo));
        $equipo->setMarca(strtoupper($marca));
        $equipo->setModelo(strtoupper($modelo));
        $equipo->setSerial(strtoupper($serial));
        $equipo->setActivoFijo(strtoupper($activoFijo));
        $equipo->setUbicacion(strtoupper($ubicacion));
        $equipo->setNitCliente($cliente->getNit());
        $equipo->adicionarEquipoCliente();
     break;
    case 'Modificar':
        $equipo=new EquipoC('ide', $ide);
        $equipo->setNombreEquipo(strtoupper($nombreEquipo));
        $equipo->setMarca(strtoupper($marca));
        $equipo->setModelo(strtoupper($modelo));
        $equipo->setSerial(strtoupper($serial));
        $equipo->setActivoFijo(strtoupper($activoFijo));
        $equipo->setUbicacion(strtoupper($ubicacion));
        $equipo->setNitCliente($cliente->getNit());
        $equipo->ModificarEquipoCliente();
     break;
    case 'Eliminar':
        $equipo=new EquipoC('ide', $ide);
        $equipo->Eliminar();
     break;

}
header('Location: ../../principal.php?CONTENIDO=calibracion/administrador/equiposCliente.php&nitCliente='.$cliente->getNit());
