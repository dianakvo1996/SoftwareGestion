<?php
require_once dirname(__FILE__) . '/../../../clasesCalibracion/ClienteC.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/SedeC.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/CronogramaC.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$cliente=new ClienteC('nit', "'".$nitCliente."'");
switch ($accion) {
    case 'Adicionar':
        $sede=new SedeC(null, null);
        $sede->setNitCliente($nitCliente);
        $sede->setNombre($nombre);
        $sede->setCodCiudad($codCiudad);
        $sede->adicionar();
        $ideSede= ConectorBD::ejecutarQuery("select max(ide) from sedeC", null)[0][0];
        $cronograma=new CronogramaC(null, null);
        $cronograma->setIdeSede($ideSede);
        $cronograma->setMes($mes);
        $cronograma->setPerioricidad($perioricidad);
        $cronograma->adicionarCronogramaSede();
     break;
    case 'Modificar':
        $sede=new SedeC('ide', $ide);
        $sede->setNitCliente($nitCliente);
        $sede->setNombre($nombre);
        $sede->setCodCiudad($codCiudad);
        $sede->modificar();
        $cronograma=new CronogramaC('ide', $ideCronograma);
        $cronograma->setIdeSede($ide);
        $cronograma->setMes($mes);
        $cronograma->setPerioricidad($perioricidad);
        $cronograma->modificarCronogramaSede();
     break;
    case 'Eliminar':
        $sede=new SedeC('ide', $ide);
        $cronograma=new CronogramaC('ideSede', $ide);
        $cronograma->eliminaSede();
        $sede->eliminar();
     break;


}

header('Location: ../../principal.php?CONTENIDO=calibracion/administrador/sedes.php&nitCliente='.$cliente->getNit());