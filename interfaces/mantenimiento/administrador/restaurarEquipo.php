<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/EquipoDeBaja.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;
date_default_timezone_set('America/Bogota');
$direccion='';
switch ($lugar) {
    case 'sede':
        $equipoBaja=new EquipoDeBaja('ide', $ide);
        $equipo=new Equipo(null, null);
        $equipo->setNombreEquipo($equipoBaja->getNombreEquipo());
        $equipo->setMarca($equipoBaja->getMarca());
        $equipo->setModelo($equipoBaja->getModelo());
        $equipo->setSerial($equipoBaja->getSerial());
        $equipo->setActivoFijo($equipoBaja->getActivoFijo());
        $equipo->setUbicacion($equipoBaja->getUbicacion());
        $equipo->setIdeSede($equipoBaja->getIdeSede());
        $equipo->adicionarEquipoSede();
        $equipoBaja->eliminar();
        $direccion='equiposDeBajaSede.php&ideSede='.$ideSede;
        break;
    case 'cliente':
        $equipoBaja=new EquipoDeBaja('ide', $ide);
        $equipo=new Equipo(null, null);
        $equipo->setNombreEquipo($equipoBaja->getNombreEquipo());
        $equipo->setMarca($equipoBaja->getMarca());
        $equipo->setModelo($equipoBaja->getModelo());
        $equipo->setSerial($equipoBaja->getSerial());
        $equipo->setActivoFijo($equipoBaja->getActivoFijo());
        $equipo->setUbicacion($equipoBaja->getUbicacion());
        $equipo->setNitCliente($equipoBaja->getNitCliente());
        $equipo->adicionarEquipoCliente();
        $equipoBaja->eliminar();
        $direccion='equiposDeBaja.php&nitCliente='.$nitCliente;

        break;
}
header('Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/'.$direccion);