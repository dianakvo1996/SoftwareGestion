<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/TipoEquipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/RutinaEquipo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$tipo=new TipoEquipo('ide', $ideTipoEquipo);

switch ($accion) {
    case 'Adicionar':
        $rutina=new RutinaEquipo(null, null);
        $rutina->setDescripcion(strtoupper($descripcion));
        $rutina->setIdeTipoEquipo($ideTipoEquipo);
        $rutina->adicionar();
        break;
    case 'Modificar':
        $rutina=new RutinaEquipo('ide', $ide);
        $rutina->setDescripcion(strtoupper($descripcion));
        $rutina->modificar();
        break;
    case 'Eliminar':
        $rutina=new RutinaEquipo('ide', $ide);
        $rutina->eliminar();
        break;
}
header('Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/rutina.php&ideTipo='.$tipo->getIde());
