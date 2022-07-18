<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalibracion/Calibracion.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/CronogramaC.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

date_default_timezone_set('America/Bogota');
$anoActual= date('Y');
$cronograma=new CronogramaC('ide', $ideCronograma);

switch ($accion) {
    case 'Adicionar':
        $calibracion=new Calibracion(null, null);        
        $calibracion->setIdeCronograma($ideCronograma);
        $calibracion->setFecha($fecha);
        $mes= explode('-', $fecha)[1];
        $calibracion->setAnioActual($anoActual);        
        $calibracion->setIde($ideCronograma.'-'.$mes.'-'.$anoActual);
        $calibracion->adicionar();
     break;
}

header('Location: ../../principal.php?CONTENIDO=calibracion/administrador/cronogramaSede.php&ideSede='.$cronograma->getIdeSede());