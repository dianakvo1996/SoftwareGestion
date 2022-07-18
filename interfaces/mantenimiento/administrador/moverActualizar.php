<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$moverEquipo=new Equipo('ide', $ideEquipo);
$moverEquipo->setIdeSede($sedeNueva);
$moverEquipo->setUbicacion($ubicacion);
$moverEquipo->moverEquipo();

header('Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/equiposSede.php&ideSede='.$sedeNueva);
