<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$sede=new Sede('ide', $ideSede);

switch ($accion) {
    case 'Adicionar':
        $equipo=new Equipo(null, null);
        $equipo->setNombreEquipo(strtoupper($nombreEquipo));
        $equipo->setMarca(strtoupper($marca));
        $equipo->setModelo(strtoupper($modelo));
        $equipo->setSerial(strtoupper($serial));
        $equipo->setActivoFijo(strtoupper($activoFijo));
        $equipo->setUbicacion(strtoupper($ubicacion));
        $equipo->setIdeSede($sede->getIde());
		$equipo->setRegistroInvima($registroInvima);
        $equipo->adicionarEquipoSede('null');
     break;
    case 'Modificar':
        $equipo=new Equipo('ide', $ide);
        $equipo->setNombreEquipo(strtoupper($nombreEquipo));
        $equipo->setMarca(strtoupper($marca));
        $equipo->setModelo(strtoupper($modelo));
        $equipo->setSerial(strtoupper($serial));
        $equipo->setActivoFijo(strtoupper($activoFijo));
        $equipo->setUbicacion(strtoupper($ubicacion));
        $equipo->setIdeSede($sede->getIde());
		$equipo->setRegistroInvima($registroInvima);
		$equipo->setReferencia(strtoupper($modelo));
        $equipo->ModificarEquipoSede('null');
     break;
    case 'Eliminar':
        $equipo=new Equipo('ide', $ide);
        $equipo->Eliminar();
     break;

}
header('Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/equiposSede.php&ideSede='.$sede->getIde());


