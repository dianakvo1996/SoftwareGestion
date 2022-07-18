<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/HojaDeVida.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;
date_default_timezone_set("America/Bogota");
$fecha=date('dmYHisu');
switch ($accion) {
    case 'Adicionar':
        $hoja=new HojaDeVida(null, null);
		//Inicio subir archivo
        $origen = $_FILES['archivo']['tmp_name'];
        list($archivo, $extension) = explode('.', $_FILES['archivo']['name']);
        
         $destino = '/var/www/html/SoftwareGestion/HojasDeVidaPersonal/' . $archivo.'-'.$fecha.'.' . $extension;
         $ruta=$archivo.'-'.$fecha. '.' . $extension;
         if (move_uploaded_file($origen, $destino)) {
			$hoja->setNombre($nombre);
        	$hoja->setCargo($cargo);
        	$hoja->setArea($area);
        	$hoja->setCodCiudad($codCiudad);
			$hoja->setRuta($ruta);
        	$hoja->adicionar();
         }
		//}Fin subir archivo
     break;
    case 'Modificar':
        $hoja=new HojaDeVida('ide', $ide);
        $hoja->setNombre($nombre);
        $hoja->setCargo($cargo);
        $hoja->setArea($area);
        $hoja->setCodCiudad($codCiudad);
 		$origen = $_FILES['archivo']['tmp_name'];        
        if ($origen != "") {
			if( unlink('/var/www/html/SoftwareGestion/HojasDeVidaPersonal/'.$rutaAnterior)){
				list($archivo, $extension) = explode('.', $_FILES['archivo']['name']);        
         		$destino = '/var/www/html/SoftwareGestion/HojasDeVidaPersonal/' . $archivo.'-'.$fecha.'.' . $extension;
         		$ruta=$archivo.'-'.$fecha. '.' . $extension;
         		if (move_uploaded_file($origen, $destino)) {
					$hoja->setRuta($ruta);
					$hoja->modificar();
				}
			}
		}else{
			$hoja->setRuta($rutaAnterior);
			$hoja->modificar();
		}        
     break;
    case 'Eliminar':
        $hoja=new HojaDeVida('ide', $ide);
		if( unlink('/var/www/html/SoftwareGestion/HojasDeVidaPersonal/'.$hoja->getRuta())) $hoja->eliminar();
     break;
}

header("Location: ../../principal.php?CONTENIDO=calidad/administrador/hojasDeVida.php");

