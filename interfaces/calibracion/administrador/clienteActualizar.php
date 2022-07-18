<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalibracion/ClienteC.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/Usuario.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/CronogramaC.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

switch ($accion) {
    case 'Adicionar':
        $cliente=new ClienteC(null, null);
        $cliente->setNit($nit);
        $cliente->setNombre($nombre);
        $cliente->setResponsable($responsable);
        $cliente->setTelefono($telefono);
        $cliente->setDireccion($direccion);
		$cliente->setCodCiudad($codCiudad);
//Inicio grabar Usuario
	$clienteM=new Cliente('nit',"'".$cliente->setNit($nit)."'");
        if ($clienteM->getNit()=='') {
			$usuario=new Usuario(null, null);
            $usuario->setUsuario($nombre);
            $usuario->setClave($nit);
            $usuario->setTipo('C');
            $usuario->grabar();
        }
//Fin grabar Usuario
        if (isset($sede)){ 
            $cliente->setSede('S');                 
        }else{
            $cliente->setSede ('N');
        } 
        $cliente->setUsuario($nombre);
        $cliente->grabar();
        
        if (!isset($sede)) {
            $cronograma=new CronogramaC(null, null);
            $cronograma->setNitCliente($nit);
            $cronograma->setMes($mes);
            $cronograma->setPerioricidad($perioricidad);
            $cronograma->adicionarCronogramaCliente();
        }
    break;
    case 'Modificar':
        //Inicio modificar usuario
        $usuario=new Usuario(null, null);
        $usuario->setUsuario($nombre);
        $usuario->setClave($nit);
        $usuario->modificar($usuarioAnterior);
        //Fin modificar usuario
        $cliente=new ClienteC(null, null);
        $cliente->setNit($nit);
        $cliente->setNombre($nombre);
        $cliente->setResponsable($responsable);
        $cliente->setTelefono($telefono);
        $cliente->setDireccion($direccion);
		$cliente->setCodCiudad($codCiudad);
        $cliente->setUsuario($nombre);
        if (isset($sede)) $cliente->setSede('S');
            else $cliente->setSede ('N');
        $cliente->modificar($nitAnterior);
        if (!isset($sede)) {            
            $cronograma=new CronogramaC(null, null);
            $cronograma->setNitCliente($nit);
            $cronograma->setMes($mes);
            $cronograma->setPerioricidad($perioricidad);
            if ($ideCronograma=='') {
                $cronograma->adicionarCronogramaCliente();
            }else{
                $cronograma->setIde($ideCronograma);
                $cronograma->modificarCronogramaCliente();
            }
        }
        break;
    case 'Eliminar':
        $cliente=new ClienteC('nit',"'".$nit."'");
        $cronograma=new CronogramaC('nitCliente', "'".$nit."'");
		$usuario=new usuario('usuario',"'".$cliente->getNombre()."'");
	
        $cronograma->eliminarCliente();
        $cliente->eliminar();
		$usuario->eliminar();
        break;
}
header('Location: ../../principal.php?CONTENIDO=calibracion/administrador/clientes.php');