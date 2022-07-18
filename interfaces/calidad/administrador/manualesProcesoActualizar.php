<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/OpcionesProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/RegistroActividad.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/ManualesProceso.php';

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
        $manualProceso=new ManualesProceso(null, null);
        $manualProceso->setNombre($nombre);
        $manualProceso->setIdeOpcionesProceso($ideOpcion);
        //inicio subir Archivo
        $origen = $_FILES['manual']['tmp_name'];
        list($manual, $extension) = explode('.', $_FILES['manual']['name']);
        
         $destino = '/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Manuales/' . $manual. '.' . $extension;
         
         if (move_uploaded_file($origen, $destino)) {
             $manualProceso->setRuta($manual. '.' . $extension);
             $manualProceso->setTipo($extension);
             $manualProceso->grabar();
         }
        break;
    case 'Modificar':
        $manualProceso=new ManualesProceso('codigo', $codigo);
        //grabar registro de actividades
            $registrarActividad->setTabla('Manual');
            $registrarActividad->setAccion('Modificar');
            $registrarActividad->setRegistroAnterior($manualProceso->getNombre().":".$rutaAnterior);
            $registrarActividad->setIdeOpcion($ideOpcion);
            $registrarActividad->setUsuario($usuarioActual);
            $registrarActividad->setFechaRealizacion($fechaActual);
            // fin grabar registro de actividades
        $manualProceso->setNombre($nombre);
        $manualProceso->setIdeOpcionesProceso($ideOpcion);
        
        //inicio subir Archivo
        $origen = $_FILES['manual']['tmp_name'];
        if ($origen !="") {
            if (unlink('/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Manuales/' . $rutaAnterior)) {            
                list($manual, $extension) = explode('.', $_FILES['manual']['name']);

                $destino = '/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Manuales/' . $manual. '.' . $extension;

                if (move_uploaded_file($origen, $destino)) {
                  $manualProceso->setRuta($manual. '.' . $extension);
                  $manualProceso->setTipo($extension);
                  $manualProceso->modificar();
                  $registrarActividad->setRegistroNuevo($nombre.":".$manual. '.' . $extension);
              } 
            }
        }else{
            $manualProceso->setRuta($rutaAnterior);
            $manualProceso->setTipo($tipoAnterior);
            $manualProceso->modificar();
            $registrarActividad->setRegistroNuevo($nombre.": el archivo no se cambio");
        }
        $registrarActividad->grabar();
        break;
    case 'Eliminar':
        $manualProceso=new ManualesProceso("codigo", $codigo);
        //grabar registro de actividades
            $registrarActividad->setTabla('Manuales');
            $registrarActividad->setAccion('Eliminar');
            $registrarActividad->setRegistroAnterior($manualProceso->getNombre().":".$rutaAnterior);
            $registrarActividad->setIdeOpcion($ideOpcion);
            $registrarActividad->setUsuario($usuarioActual);
            $registrarActividad->setFechaRealizacion($fechaActual);
            $registrarActividad->grabar();
            // fin grabar registro de actividades
        if (unlink('/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Manuales/'. $rutaAnterior)) {
            $manualProceso->eliminar();
        }
        break;     
}
header("Location: ../../principal.php?CONTENIDO=calidad/administrador/ManualesProceso.php&ideOpcion=$ideOpcion");

