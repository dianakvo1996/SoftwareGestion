<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/OpcionesProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/RegistroActividad.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/GuiasProceso.php';

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
        $guiaProceso=new GuiasProceso(null, null);
        $guiaProceso->setNombre($nombre);
        $guiaProceso->setIdeOpcionesProceso($ideOpcion);
        //inicio grabar archivo
        $origen = $_FILES['guia']['tmp_name'];
        list($guia, $extension) = explode('.', $_FILES['guia']['name']);
        
         $destino = '/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Guias/'.$guia. '.' . $extension;
         
         if (move_uploaded_file($origen, $destino)) {
             $guiaProceso->setRuta($guia. '.' . $extension);
             $guiaProceso->setTipo($extension);
             $guiaProceso->grabar();
         }
        break;
        
    case 'Modificar':
        $guiaProceso=new GuiasProceso("codigo", $codigo);
        //grabar registro de actividades
            $registrarActividad->setTabla('Guias');
            $registrarActividad->setAccion('Modificar');
            $registrarActividad->setRegistroAnterior($guiaProceso->getNombre().":".$rutaAnterior);
            $registrarActividad->setIdeOpcion($ideOpcion);
            $registrarActividad->setUsuario($usuarioActual);
            $registrarActividad->setFechaRealizacion($fechaActual);
        // fin grabar registro de actividades
        $guiaProceso->setNombre($nombre);
        $guiaProceso->setIdeOpcionesProceso($ideOpcion);
        
        //iniciar grabar
        $origen = $_FILES['guia']['tmp_name'];

        if ($origen != "") {

            unlink('/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Guias/' . $rutaAnterior);

            list($guia, $extension) = explode('.', $_FILES['guia']['name']);
            $destino = '/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Guias/'. $guia. '.' . $extension;
                
            if (move_uploaded_file($origen, $destino)) {
                $guiaProceso->setRuta($guia. '.' . $extension);
                $guiaProceso->setTipo($extension);
                $guiaProceso->modificar();
                $registrarActividad->setRegistroNuevo($nombre.":".$guia. '.' . $extension);
            }
        }else{
            $guiaProceso->setRuta($rutaAnterior);
            $guiaProceso->setTipo($tipoAnterior);
            $guiaProceso->modificar();
            $registrarActividad->setRegistroNuevo($nombre.": no se cambio el archivo");
        }
        $registrarActividad->grabar();
        break;
        
    case 'Eliminar':
        $guiaProceso=new GuiasProceso("codigo", $codigo);
        //grabar registro de actividades
            $registrarActividad->setTabla('Guias');
            $registrarActividad->setAccion('Eliminar');
            $registrarActividad->setRegistroAnterior($guiaProceso->getNombre().":".$rutaAnterior);
            $registrarActividad->setIdeOpcion($ideOpcion);
            $registrarActividad->setUsuario($usuarioActual);
            $registrarActividad->setFechaRealizacion($fechaActual);
            $registrarActividad->grabar();
        // fin grabar registro de actividades
        if (unlink('/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Guias/'.$rutaAnterior)){
            $guiaProceso->eliminar();
        }
        break;
}
header("Location: ../../principal.php?CONTENIDO=calidad/administrador/guiasProceso.php&ideOpcion=$ideOpcion");