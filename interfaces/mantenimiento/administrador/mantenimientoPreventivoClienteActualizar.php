<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cronograma.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/MantenimientoPreventivo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$cliente=new Cliente('nit', "'{$nitCliente}'");
date_default_timezone_set('America/Bogota');

$cronograma=new Cronograma('nitCliente',"'{$nitCliente}'");
$añoActual= date('Y');
$ideCronograma=$cronograma->getIde();
switch ($accion) {
    case 'Adicionar':
        $mantenimiento=new MantenimientoPreventivo(null, null);
        $mantenimiento->setFecha($fecha);
        $mes= explode('-', $fecha)[1];
        $mantenimiento->setNitCliente($nitCliente);
        $mantenimiento->setValidar("$ideCronograma-$mes-$añoActual");
		$mantenimiento->setGenerar($generar);
        $mantenimiento->adicionarCliente();
     break;
    case 'Modificar':
        $mantenimiento=new MantenimientoPreventivo('ide', $ideAnterior);
        $mantenimiento->setFecha($fecha);
        $mes= explode('-', $fecha)[1];
        $mantenimiento->setValidar("$ideCronograma-$mes-$añoActual");
		$mantenimiento->setGenerar($generar);
        $mantenimiento->modificar();
     break;
    case 'Eliminar':
        $mantenimiento=new MantenimientoPreventivo('ide', $ideAnterior);
        $mantenimiento->eliminar();
     break;
}
header('Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/mantenimientoPreventivoCliente.php&nitCliente='.$cliente->getNit());
