<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/ProcedimientosProceso.php';
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
        $procedimientoProceso=new ProcedimientosProceso(null,null);
        $procedimientoProceso->setNombre($nombre);
        $procedimientoProceso->setIdeOpcionesProceso($ideOpcion);
        // inicio grabar archivo
        $origen = $_FILES['procedimiento']['tmp_name'];
        list($procedimiento, $extension) = explode('.', $_FILES['procedimiento']['name']);
        
         $destino = '/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Procedimientos/' . $procedimiento. '.' . $extension;
         
         if (move_uploaded_file($origen, $destino)) {

            $procedimientoProceso->setRuta($procedimiento. '.' . $extension);
            $procedimientoProceso->setTipo($extension);
            $procedimientoProceso->setIdeOpcionesProceso($ideOpcion);
            $procedimientoProceso->grabar();
         }
        break;

        case 'Modificar':
            $procedimientoProceso=new ProcedimientosProceso('codigo',$codigo);            
            //grabar registro de actividades
            $registrarActividad->setTabla('Procedimiento');
            $registrarActividad->setAccion('Modificar');
            $registrarActividad->setRegistroAnterior($procedimientoProceso->getNombre().":".$rutaAnterior);
            $registrarActividad->setIdeOpcion($ideOpcion);
            $registrarActividad->setUsuario($usuarioActual);
            $registrarActividad->setFechaRealizacion($fechaActual);
            // fin grabar registro de actividades
            $procedimientoProceso->setNombre($nombre);
            $procedimientoProceso->setIdeOpcionesProceso($ideOpcion);
             //iniciar grabar
            $origen = $_FILES['procedimiento']['tmp_name'];

            if ($origen != "") {

                unlink('/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Procedimientos/' . $rutaAnterior);

                list($procedimiento, $extension) = explode('.', $_FILES['procedimiento']['name']);
                $destino = '/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Procedimientos/' . $procedimiento. '.' . $extension;
                
                if (move_uploaded_file($origen, $destino)) {
                    $procedimientoProceso->setRuta($procedimiento. '.' . $extension);
                    $procedimientoProceso->setTipo($extension);
                    $procedimientoProceso->modificar();
                    $registrarActividad->setRegistroNuevo($nombre.";".$procedimiento. '.' . $extension);
                }  
            }else{
                $procedimientoProceso->setRuta($rutaAnterior);
                $procedimientoProceso->setTipo($tipoAnterior);
                $procedimientoProceso->modificar();
                $registrarActividad->setRegistroNuevo($nombre.";El archivo no se cambio");
            }
            $registrarActividad->grabar();
            break;
            
        case 'Eliminar':
            $procedimientoProceso=new ProcedimientosProceso("codigo",$codigo);
            //grabar registro de actividades
            $registrarActividad->setTabla('Procedimiento');
            $registrarActividad->setAccion('Eliminar');
            $registrarActividad->setRegistroAnterior($procedimientoProceso->getNombre().":".$rutaAnterior);
            $registrarActividad->setIdeOpcion($ideOpcion);
            $registrarActividad->setUsuario($usuarioActual);
            $registrarActividad->setFechaRealizacion($fechaActual);
            $registrarActividad->grabar();
            // fin grabar registro de actividades
            if (unlink('/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Procedimientos/' . $rutaAnterior)){
                $procedimientoProceso->eliminar();
            }
        break;
}
header("Location: ../../principal.php?CONTENIDO=calidad/administrador/procedimientosProceso.php&ideOpcion=$ideOpcion");