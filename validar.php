<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once dirname(__FILE__) . '/clasesGenericas/Usuario.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;


$objetoUsuario= Usuario::validar($usuario, $clave);
$direccion='';

if($objetoUsuario!=null) {
    session_start();
    $tipo=$objetoUsuario->getTipo();
    $_SESSION['usuario']=$usuario;
    $_SESSION['tipo']=$tipo;
	$acceso=$objetoUsuario->getAcceso();
	if($acceso==''){
    	switch ($tipo) {
        	case 'C':
            	$direccion='mantenimiento/cliente/inicio.php';
            	break;
        	case 'O':
            	$direccion='calidad/otro/inicio.php';
            	break; 
        	default:
            	$direccion='seleccionPlataforma.php';
            	break;
    	}
    	header("Location: interfaces/principal.php?CONTENIDO=$direccion");
	}else{
		header("Location: index.php?MENSAJE=** ACCESO RESTRINGIDO **");
	}
}else{
    header("Location: index.php?MENSAJE=Usuario y/o contraseña incorrectas.");
}
