<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/Usuario.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cronograma.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

switch ($accion) {
    case 'Adicionar':
        $cliente=new Cliente(null, null);
        $cliente->setNit($nit);
        $cliente->setNombre($nombre);
        $cliente->setResponsable($responsable);
        $cliente->setTelefono($telefono);
        $cliente->setDireccion($direccion);
        $cliente->setCodCiudad($codCiudad);
        //grabar usuario
        $usuario= new Usuario(null, null);
        $usuario->setUsuario($nombre);
        $usuario->setClave($nit);
        $usuario->setTipo('C');
        $usuario->grabar();
        //grabar usuario
        if (isset($sede)){ 
            $cliente->setSede('S');                 
        }else{
            $cliente->setSede ('N');
        } 
        $cliente->setUsuario($nombre);
		if($identificacionIC=='1233188733'){
			$cliente->setPabon('SI');
		}else{
			$cliente->setPabon('');
		}
        $cliente->grabar();
        
        if (!isset($sede)) {
            $cronograma=new Cronograma(null, null);
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
        $usuario->setClave(md5($nit));
        $usuario->setTipo('C');
        $usuario->modificar($usuarioAnterior);
        //Fin modificar usuario
        $cliente=new Cliente(null, null);
        $cliente->setNit($nit);
        $cliente->setNombre($nombre);
        $cliente->setResponsable($responsable);
        $cliente->setTelefono($telefono);
        $cliente->setDireccion($direccion);
        $cliente->setCodCiudad($codCiudad);
        $cliente->setUsuario($nombre);
		if($identificacionIC=='1233188733'){
			$cliente->setPabon('SI');
		}else{
			$cliente->setPabon('');
		}
        if (isset($sede)) $cliente->setSede('S');
            else $cliente->setSede ('N');
        $cliente->modificar($nitAnterior);
        if (!isset($sede)) {            
            $cronograma=new Cronograma(null, null);
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
        $cliente=new Cliente('nit',"'".$nit."'");
        $cronograma=new Cronograma('nitCliente', "'".$nit."'");
        $usuario=new Usuario('usuario',"'".$cliente->getUsuario()."'");
        $cronograma->setNitCliente($nit);
        $cliente->setNit($nit);
        $cronograma->eliminarCliente();
        $cliente->eliminar();
     break;
}
header('Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/clientes.php');