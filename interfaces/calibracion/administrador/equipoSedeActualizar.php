<?php

require_once dirname(__FILE__) . '/../../../clasesCalibracion/ClienteC.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/EquipoC.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/SedeC.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$sede=new Sedec('ide', $ideSede);
echo $ideSede;
switch ($accion) {
    case 'Adicionar':
        $equipo=new EquipoC(null, null);
        $equipo->setNombreEquipo(strtoupper($nombreEquipo));
        $equipo->setMarca(strtoupper($marca));
        $equipo->setModelo(strtoupper($modelo));
        $equipo->setSerial(strtoupper($serial));
        $equipo->setActivoFijo(strtoupper($activoFijo));
        $equipo->setUbicacion(strtoupper($ubicacion));
        $equipo->setIdeSede($sede->getIde());
        $equipo->adicionarEquipoSede();
     break;
    case 'Modificar':
        $equipo=new EquipoC('ide', $ide);
        $equipo->setNombreEquipo(strtoupper($nombreEquipo));
        $equipo->setMarca(strtoupper($marca));
        $equipo->setModelo(strtoupper($modelo));
        $equipo->setSerial(strtoupper($serial));
        $equipo->setActivoFijo(strtoupper($activoFijo));
        $equipo->setUbicacion(strtoupper($ubicacion));
        $equipo->setIdeSede($sede->getIde());
        $equipo->ModificarEquipoSede();
     break;
    case 'Eliminar':
        $equipo=new EquipoC('ide', $ide);
        $equipo->Eliminar();
     break;

}
header('Location: ../../principal.php?CONTENIDO=calibracion/administrador/equiposSede.php&ideSede='.$sede->getIde());
