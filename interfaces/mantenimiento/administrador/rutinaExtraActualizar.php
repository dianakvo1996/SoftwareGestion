<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/RutinaExtra.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/TipoEquipo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

switch ($accion) {
    case 'Adicionar':
        $rutinaExtra=new RutinaExtra(null, null);
        $rutinaExtra->setDescripcion($descripcion);
        $rutinaExtra->setIdeTipoEquipo($ideTipoEquipo);
        $rutinaExtra->adicionar();
     break;
    case 'Modificar':
        $rutinaExtra=new RutinaExtra('ide', $ide);
        $rutinaExtra->setDescripcion($descripcion);
        $rutinaExtra->setIdeTipoEquipo($ideTipoEquipo);
        $rutinaExtra->modificar();
     break;
    case 'Eliminar':
        $rutinaExtra=new RutinaExtra('ide', $ide);
        $rutinaExtra->eliminar();
     break;
}
header('Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/rutinaExtra.php&ideTipoEquipo='.$ideTipoEquipo);
