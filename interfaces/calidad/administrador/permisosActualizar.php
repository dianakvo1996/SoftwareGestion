<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/Permiso.php';

foreach ($_GET as $Variable=> $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$permiso=new Permiso("ide", $ide);
switch ($permiso->getPermiso()) {
    case 'SL':
        $permiso->setPermiso("D");
        $permiso->modificar();
    break;
    case 'D':
        $permiso->setPermiso("SL");
        $permiso->modificar();
    break;

}
header("Location: ../../principal.php?CONTENIDO=calidad/administrador/permisos.php&usuario=$usuario");

