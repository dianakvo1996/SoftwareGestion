<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/Membrete.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

switch ($accion) {
    case 'Adicionar':
        $membretes=new Membrete(null, null);
        // inicio grabar archivo
        $origen = $_FILES['membrete']['tmp_name'];
        list($membrete, $extension) = explode('.', $_FILES['membrete']['name']);
        
         $destino = '/var/www/html/SoftwareGestion/ArchivosProcesos/Membretes/' . $membrete. '.' . $extension;
         
         if (move_uploaded_file($origen, $destino)) {
            $membretes->setNombre($membrete);
            $membretes->setArchivo($membrete.'.'.$extension);
            $membretes->setTipo($extension);
            $membretes->grabar();
           
         }
     break;
     case 'Eliminar':
        $membretes=new Membrete(null, null);
        $membretes->setCodigo($codigo);
         if (unlink("/var/www/html/SoftwareGestion/ArchivosProcesos/Membretes/" . $ruta)){
                $membretes->eliminar();
            }
         break;
    }
header("Location: ../../principal.php?CONTENIDO=calidad/administrador/membretes.php");
