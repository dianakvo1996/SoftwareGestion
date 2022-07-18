<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/InstructivosProceso.php';
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
        $instructivoProceso=new InstructivosProceso(null, null);
        $instructivoProceso->setNombre($nombre);
        $instructivoProceso->setIdeOpcionesProceso($ideOpcion);
        // inicio grabar archivo
        $origen = $_FILES['instructivo']['tmp_name'];
        list($instructivo, $extension) = explode('.', $_FILES['instructivo']['name']);
        
         $destino = '/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Instructivos/' . $instructivo. '.' . $extension;
         
         if (move_uploaded_file($origen, $destino)) {

            $instructivoProceso->setRuta($instructivo. '.' . $extension);
            $instructivoProceso->setTipo($extension);
            $instructivoProceso->setIdeOpcionesProceso($ideOpcion);
            $instructivoProceso->grabar();
         }
        break;
        
        case 'Modificar':
            $instructivoProceso=new InstructivosProceso("codigo", $codigo);
            //grabar registro de actividades
            $registrarActividad->setTabla('Instructivo');
            $registrarActividad->setAccion('Modificar');
            $registrarActividad->setRegistroAnterior($instructivoProceso->getNombre().":".$rutaAnterior);
            $registrarActividad->setIdeOpcion($ideOpcion);
            $registrarActividad->setUsuario($usuarioActual);
            $registrarActividad->setFechaRealizacion($fechaActual);
            // fin grabar registro de actividades
            $instructivoProceso->setNombre($nombre);
            $instructivoProceso->setIdeOpcionesProceso($ideOpcion);
            
            //iniciar grabar
            $origen = $_FILES['instructivo']['tmp_name'];
            if ($origen != "") {
                unlink('/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Instructivos/' . $rutaAnterior);
                list($instructivo, $extension) = explode('.', $_FILES['instructivo']['name']);
                $destino = '/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Instructivos/' . $instructivo. '.' . $extension;
                
                if (move_uploaded_file($origen, $destino)) {
                    $instructivoProceso->setRuta($instructivo. '.' . $extension);
                    $instructivoProceso->setTipo($extension);
                    $instructivoProceso->modificar();
                    $registrarActividad->setRegistroNuevo($nombre.";".$instructivo. '.' . $extension);
                }  
            }else{
                $instructivoProceso->setRuta($rutaAnterior);
                $instructivoProceso->setTipo($tipoAnterior);
                $instructivoProceso->modificar();
                $registrarActividad->setRegistroNuevo($nombre."; no se cambio el archivo");
            }
            $registrarActividad->grabar();
            break;
    case 'Eliminar':
        $instructivoProceso=new InstructivosProceso("codigo", $codigo);
        //grabar registro de actividades
            $registrarActividad->setTabla('Instructivo');
            $registrarActividad->setAccion('Eliminar');
            $registrarActividad->setRegistroAnterior($instructivoProceso->getNombre().":".$rutaAnterior);
            $registrarActividad->setIdeOpcion($ideOpcion);
            $registrarActividad->setUsuario($usuarioActual);
            $registrarActividad->setFechaRealizacion($fechaActual);
            $registrarActividad->grabar();
            // fin grabar registro de actividades
        if (unlink('/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Instructivos/'. $rutaAnterior)){
                $instructivoProceso->eliminar();
            }
        break;
}
header("Location: ../../principal.php?CONTENIDO=calidad/administrador/instructivosProceso.php&ideOpcion=$ideOpcion");
