<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/OpcionesProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/RegistroActividad.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/ProtocolosProceso.php';

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
        $protocoloProceso=new ProtocolosProceso(null, null);
        $protocoloProceso->setNombre($nombre);
        $protocoloProceso->setIdeOpcionesProceso($ideOpcion);
        //inicio subir Archivo
        $origen = $_FILES['protocolo']['tmp_name'];
        list($protocolo, $extension) = explode('.', $_FILES['protocolo']['name']);
        
         $destino = '/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Protocolos/' . $protocolo. '.' . $extension;
         
         if (move_uploaded_file($origen, $destino)) {
             $protocoloProceso->setRuta($protocolo. '.' . $extension);
             $protocoloProceso->setTipo($extension);
             $protocoloProceso->grabar();
         }
        break;
    case 'Modificar':
        $protocoloProceso=new ProtocolosProceso("codigo", $codigo);
        //grabar registro de actividades
            $registrarActividad->setTabla('Protocolo');
            $registrarActividad->setAccion('Modificar');
            $registrarActividad->setRegistroAnterior($protocoloProceso->getNombre().":".$rutaAnterior);
            $registrarActividad->setIdeOpcion($ideOpcion);
            $registrarActividad->setUsuario($usuarioActual);
            $registrarActividad->setFechaRealizacion($fechaActual);
        // fin grabar registro de actividades
        $protocoloProceso->setNombre($nombre);
        $protocoloProceso->setIdeOpcionesProceso($ideOpcion);
        
        //inicio subir Archivo
        $origen = $_FILES['protocolo']['tmp_name'];
        if ($origen !="") {
            if (unlink('/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Protocolos/' . $rutaAnterior)) {            
                list($protocolo, $extension) = explode('.', $_FILES['protocolo']['name']);

                $destino = '/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Protocolos/' . $protocolo. '.' . $extension;

                if (move_uploaded_file($origen, $destino)) {
                  $protocoloProceso->setRuta($protocolo. '.' . $extension);
                  $protocoloProceso->setTipo($extension);
                  $protocoloProceso->modificar();
                  $registrarActividad->setRegistroNuevo($nombre.":".$protocolo. '.' . $extension);
              } 
            }
        }else{
            $protocoloProceso->setRuta($rutaAnterior);
            $protocoloProceso->setTipo($tipoAnterior);
            $protocoloProceso->modificar();
            $registrarActividad->setRegistroNuevo($nombre.": no se cambio el archivo");
        }
        $registrarActividad->grabar();
        break;
    case 'Eliminar':
        $protocoloProceso=new ProtocolosProceso("codigo", $codigo);
        //grabar registro de actividades
            $registrarActividad->setTabla('Protocolo');
            $registrarActividad->setAccion('Eliminar');
            $registrarActividad->setRegistroAnterior($protocoloProceso->getNombre().":".$rutaAnterior);
            $registrarActividad->setIdeOpcion($ideOpcion);
            $registrarActividad->setUsuario($usuarioActual);
            $registrarActividad->setFechaRealizacion($fechaActual);
            $registrarActividad->grabar();
        // fin grabar registro de actividades
        if (unlink('/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Protocolos/' . $rutaAnterior)) {
            $protocoloProceso->eliminar();
        }
        break;     
}
header("Location: ../../principal.php?CONTENIDO=calidad/administrador/protocolosProceso.php&ideOpcion=$ideOpcion");
