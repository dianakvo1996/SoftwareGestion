<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/UnidadMedida.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$unidadMedida=new UnidadMedida(null, null);
$unidadMedida->setUnidad($unidad);
$unidadMedida->setSimbolo($unidad);
$unidadMedida->adicionar();

header('Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/reporteMantenimientoPreventivo.php&ideMantenimiento='.$ideMantenimiento.'&ideEquipo='.$ideEquipo.'&accion='.$accion);