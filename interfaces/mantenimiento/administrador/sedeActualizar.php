<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cronograma.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$cliente=new Cliente('nit', "'".$nitCliente."'");
switch ($accion) {
    case 'Adicionar':
        $sede=new Sede(null, null);
        $sede->setNitCliente($nitCliente);
        $sede->setNombre($nombre);
        $sede->setCodCiudad($codCiudad);
        $sede->adicionar();
        $ideSede= ConectorBD::ejecutarQuery("select max(ide) from sede", null)[0][0];
        $cronograma=new Cronograma(null, null);
        $cronograma->setIdeSede($ideSede);
        $cronograma->setMes($mes);
        $cronograma->setPerioricidad($perioricidad);
        $cronograma->adicionarCronogramaSede();
     break;
    case 'Modificar':
        $sede=new Sede('ide', $ide);
        $sede->setNitCliente($nitCliente);
        $sede->setNombre($nombre);
        $sede->setCodCiudad($codCiudad);
        $sede->modificar();
        $cronograma=new Cronograma('ide', $ideCronograma);
        $cronograma->setIdeSede($ide);
        $cronograma->setMes($mes);
        $cronograma->setPerioricidad($perioricidad);
        $cronograma->modificarCronogramaSede();
     break;
    case 'Eliminar':
        $sede=new Sede('ide', $ide);
        $cronograma=new Cronograma('ideSede', $ide);
        $cronograma->eliminaSede();
        $sede->eliminar();
     break;

}
header('Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/sedes.php&nit='.$cliente->getNit());
