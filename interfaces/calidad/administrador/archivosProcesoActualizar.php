<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/ArchivosProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$procesos=new Proceso("ide", $ideProceso);
$carpeta= str_replace(' ','_',$procesos->getNombre());

$archivoProceso=new ArchivosProceso("ideProceso", $ideProceso);
    $archivoProceso->setNombre($nombre);        
    //iniciar grabar
        $origen = $_FILES['archivo']['tmp_name'];


        if (unlink('/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/' . $rutaAnterior)){     
            list($archivo, $extension) = explode('.', $_FILES['archivo']['name']);
            $destino = '/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/' . $archivo. '.' . $extension;
                
            if (move_uploaded_file($origen, $destino)) {
                $archivoProceso->setRuta($archivo. '.' . $extension);
                $archivoProceso->setTipo($extension);
                $archivoProceso->modificar();
            }
         }      
header("Location: ../../principal.php?CONTENIDO=calidad/administrador/menuProcesoAlterno.php&ideProceso={$procesos->getIde()}&CONTENIDOINTERNO=calidad/administrador/visualizadorPDF.php");
