<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/FormatoProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/OpcionesProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/RegistroActividad.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';
foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$opcionesProceso=new OpcionesProceso("ide", $ideOpcion);
$carpeta= str_replace(' ','_',$opcionesProceso->getProcesoEnObjeto()->getNombre());
// registrar Actividad
    date_default_timezone_set("America/Bogota");
    $fechaActual= date('d-m-Y H:i:s');
    $registrarActividad=new RegistroActividad(null, null);
// fin registrar Actividad
switch ($accion) {
    case 'Adicionar':
        $formatoProceso=new FormatoProceso(null, null);
        $formatoProceso->setNombre($nombre);
        $formatoProceso->setIdeOpcionesProceso($ideOpcion);
        // inicio grabar archivo
        date_default_timezone_set("America/Bogota");
        $origen = $_FILES['formato']['tmp_name'];
        list($formato, $extension) = explode('.', $_FILES['formato']['name']);
        
         $destino = '/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Formatos/' . $formato. '.' . $extension;
         
         if (move_uploaded_file($origen, $destino)) {

            $formatoProceso->setRuta($formato. '.' . $extension);
            $formatoProceso->setTipo($extension);     
            $formatoProceso->grabar();
         }
     break;
    case 'Modificar':
        $formatoProceso=new FormatoProceso("codigo", $codigo); 
        //grabar registro de actividades
            $registrarActividad->setTabla('Formatos');
            $registrarActividad->setAccion('Modificar');
            $registrarActividad->setRegistroAnterior($formatoProceso->getNombre().":".$rutaAnterior);
            $registrarActividad->setIdeOpcion($ideOpcion);
            $registrarActividad->setUsuario($usuarioActual);
            $registrarActividad->setFechaRealizacion($fechaActual);
        // fin grabar registro de actividades
        $formatoProceso->setNombre($nombre);        
        $formatoProceso->setIdeOpcionesProceso($ideOpcion);
        
        //iniciar grabar
        $origen = $_FILES['formato']['tmp_name'];
        
        if ($origen != "") {
            
           if( unlink('/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Formatos/' . $rutaAnterior)){
            
            list($formato, $extension) = explode('.', $_FILES['formato']['name']);
            $destino = '/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Formatos/' . $formato. '.' . $extension;
            
            if (move_uploaded_file($origen, $destino)) {
                $formatoProceso->setRuta($formato. '.' . $extension);
                $formatoProceso->setTipo($extension);
                $formatoProceso->modificar();   
                $registrarActividad->setRegistroNuevo($nombre.";".$formato. '.' . $extension);
            } 
        }
        }else{
            $formatoProceso->setRuta($rutaAnterior);
            $formatoProceso->setTipo($tipoAnterior);
            $formatoProceso->modificar();
            $registrarActividad->setRegistroNuevo($nombre."; no se cambio el archivo");
        }
        $registrarActividad->grabar();
     break;
     case 'Eliminar':
         $formatoProceso=new FormatoProceso("codigo", $codigo);
         //grabar registro de actividades
            $registrarActividad->setTabla('Formatos');
            $registrarActividad->setAccion('Eliminar');
            $registrarActividad->setRegistroAnterior($formatoProceso->getNombre().":".$rutaAnterior);
            $registrarActividad->setIdeOpcion($ideOpcion);
            $registrarActividad->setUsuario($usuarioActual);
            $registrarActividad->setFechaRealizacion($fechaActual);
            $registrarActividad->grabar();
        // fin grabar registro de actividades
         if (unlink('/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Formatos/' . $rutaAnterior)) {
            $formatoProceso->eliminar();   
         }
        break;
    
}
header("Location: ../../principal.php?CONTENIDO=calidad/administrador/formatosProceso.php&ideOpcion=$ideOpcion");