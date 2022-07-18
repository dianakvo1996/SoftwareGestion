<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/Presentacion.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

switch ($accion) {
    case 'Adicionar':
        $presentaciones=new Presentacion(null, null);
        // inicio grabar archivo
        $origen = $_FILES['presentacion']['tmp_name'];
        list($presentacion, $extension) = explode('.', $_FILES['presentacion']['name']);
        
         $destino = '/var/www/html/SoftwareGestion/ArchivosProcesos/Presentaciones/' . $presentacion. '.' . $extension;
         
         if (move_uploaded_file($origen, $destino)) {
             $presentaciones->setNombre($presentacion);
             $presentaciones->setPresentacion($presentacion.'.'.$extension);
             $presentaciones->grabar();
           
         }
     break;
     case 'Eliminar':
         $presentaciones=new Presentacion(null, null);
         $presentaciones->setCodigo($codigo);
         if (unlink("/var/www/html/SoftwareGestion/ArchivosProcesos/Presentaciones/" . $ruta)){
                $presentaciones->eliminar();
            }
         break;
    }
header("Location: ../../principal.php?CONTENIDO=calidad/administrador/presentaciones.php");
