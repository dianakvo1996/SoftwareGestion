<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesGenericas/Usuario.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/Persona.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/Permiso.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/LugarIC.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$direccion='usuario.php';
$validarIdentificacion=new Persona("identificacion", "'".$identificacion."'");
$validarUsuario=new Persona("usuario", "'".$identificacion."'");
 $permisos=new Permiso(null, null);
switch ($accion) {
    case 'Adicionar':       
        $usuario=new Usuario(null, null);
        $nombre=explode(" ", $nombres)[0];
        $apellido=explode(" ", $apellidos)[0];
        $nombreUsuario=$nombre.".".$apellido;
        $usuario->setUsuario(strtolower($nombreUsuario));
        
        $validarUsuario=new Persona("usuario", "'".$nombreUsuario."'");
        if ($validarUsuario->getUsuario()!=null) {
            $direccion='usuarioFormulario.php&accion=Adicionar&MENSAJE=Ese nombre de usuario ya esta en uso';
        } else {
            $usuario->setTipo($tipo);
            $usuario->setClave($clave);
        }
        
        $persona=new Persona(null, null);
        if ($validarIdentificacion->getIdentificacion()!=null) {
            $direccion='formularioUsuario.php&accion=Adicionar&MENSAJE=Número de identificación ya esta guardado en el sistema.';
        } else {
            $persona->setIdentificacion($identificacion);
            $persona->setNombres(ucwords($nombres));
            $persona->setApellidos(ucwords($apellidos));
            $persona->setCargo(ucwords($cargo));
			$persona->setUsuario(strtolower($nombreUsuario));
            $usuario->grabar();
            $persona->grabar();
        }
        if ($tipo!='A') {
            $permisos->grabarPermisosIniciales(strtolower($nombreUsuario));
        }
		if ($tipo=='IC'){
			$lugarIC=new LugarIC(null,null);
			$lugarIC->setIdeIngeniero($identificacion);
			$lugarIC->setNitCliente($lugar);
			$lugarIC->setIdeIngeniero($identificacion);
			$lugarIC->grabar();
		}            

     break;
    case 'Modificar':
        $usuario=new Usuario("usuario","'".$usuarioAnterior."'");
        // creacion de Usuario
        $nombre=explode(" ", $nombres)[0];
        $apellido=explode(" ", $apellidos)[0];
        $nombreUsuario=$nombre.".".$apellido;
        $usuario->setUsuario(strtolower($nombreUsuario));
        $usuario->setTipo($tipo);
        if ($clave!=null) {
          $usuario->setClave(md5($clave));  
        }else{
            $usuario->setClave($claveAnterior);
        }
        $usuario->modificar($usuarioAnterior);
        
        $persona=new Persona("identificacion", "'".$identificacion."'");
        $persona->setIdentificacion($identificacion);
        $persona->setNombres(ucwords($nombres));
        $persona->setApellidos(ucwords($apellidos));
        $persona->setCargo(ucwords($cargo));
        $persona->setUsuario(strtolower($nombreUsuario));
        $persona->modificar($identificacionAnterior);
        if ($tipo!='A') {
            $permisos->grabarPermisosIniciales(strtolower($nombreUsuario));
        } 
		if ($tipo=='IC'){
	
			$lugarIC=new LugarIC(null,null);
			$lugarIC->setIdeIngeniero($identificacion);
			$lugarIC->setNitCliente($lugar);
			$lugarIC->setIdeIngeniero($identificacion);
			$lugarIC->grabar();
		}

     break;
    case 'Eliminar':
            $persona=new Persona("identificacion", "'".$identificacion."'");
            $permisos=new Permiso("usuario","'".$usuario."'" );
            $usuarios=new Usuario("usuario","'".$usuario."'");
            $persona->eliminar();
            if ($usuarios->getTipo()!='A'){
               $permisos->eliminar();  
            }
            $usuarios->eliminar();
     break;       
}
header("Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/$direccion");
