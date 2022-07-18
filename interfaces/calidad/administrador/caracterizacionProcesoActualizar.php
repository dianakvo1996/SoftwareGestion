<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/RegistroActividad.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/CaracterizacionProceso.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$procesos=new Proceso("ide", $ideProceso);
$carpeta= str_replace(' ','_',$procesos->getNombre());
// registrar Actividad
date_default_timezone_set("America/Bogota");
$fechaActual= date('d-m-Y H:i:s');
$registrarActividad=new RegistroActividad(null, null);
// fin registrar Actividad
switch ($accion) {
    case 'Adicionar':
        $caracterizacionProceso=new CaracterizacionProceso(null, null);
        $caracterizacionProceso->setNombre($nombre);
        $caracterizacionProceso->setIdeProceso($ideProceso);
        //inicio grabar archivo
        $origen = $_FILES['caracterizacion']['tmp_name'];
        list($caracterizacion, $extension) = explode('.', $_FILES['caracterizacion']['name']);
        
        $destino = '/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Caracterizacion/' . $caracterizacion. '.' . $extension;
         
         if (move_uploaded_file($origen, $destino)) {
             $caracterizacionProceso->setRuta($caracterizacion. '.' . $extension);
             $caracterizacionProceso->setTipo($extension);
             $caracterizacionProceso->grabar();
         }

        break;
    case 'Modificar':
        $caracterizacionProceso=new CaracterizacionProceso(null, null);
        $caracterizacionProceso->setCodigo($codigo);
        $caracterizacionProceso->setNombre($nombre);
        $caracterizacionProceso->setIdeProceso($ideProceso);
        //grabar registro de actividades
        $registrarActividad->setTabla('Caracterizacion');
        $registrarActividad->setAccion('Cambiar');
        $registrarActividad->setRegistroAnterior($caracterizacionProceso->getNombre().":".$rutaAnterior);
        $registrarActividad->setIdeProceso($ideProceso);
        $registrarActividad->setUsuario($usuarioActual);
        $registrarActividad->setFechaRealizacion($fechaActual);
        
        // fin grabar registro de actividades
        //inicio grabar archivo
        $origen = $_FILES['caracterizacion']['tmp_name'];
        if ($origen != "") {
            if (unlink('/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Caracterizacion/' . $rutaAnterior)) {
               list($caracterizacion, $extension) = explode('.', $_FILES['caracterizacion']['name']);        
                $destino = '/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Caracterizacion/' . $caracterizacion. '.' . $extension;
                if (move_uploaded_file($origen, $destino)) {
                    $caracterizacionProceso->setRuta($caracterizacion. '.' . $extension);
                    $caracterizacionProceso->setTipo($extension);
                    $caracterizacionProceso->modificar();
                    $registrarActividad->setRegistroNuevo($nombre.":".$caracterizacion. '.' . $extension);
                } 
            }     
        }else{
            $caracterizacionProceso->setRuta($rutaAnterior);
            $caracterizacionProceso->setTipo($tipoAnterior);
            $caracterizacionProceso->modificar();
            $registrarActividad->setRegistroNuevo($nombre);
        }
        $registrarActividad->grabar();
        break;
    case 'Eliminar':
        $caracterizacionProceso=new CaracterizacionProceso(null, null);
        $caracterizacionProceso->setCodigo($codigo);
        if (unlink('/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Caracterizacion/' . $rutaAnterior)) {
            $caracterizacionProceso->eliminar();
        }
        break;
}
header("Location: ../../principal.php?CONTENIDO=calidad/administrador/caracterizacionProceso.php&ideProceso=$ideProceso");