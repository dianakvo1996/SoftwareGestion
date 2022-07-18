<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/PoliticasOperativasProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/RegistroActividad.php';

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
        $politicaProceso=new PoliticasOperativasProceso(null, null) ;
        $politicaProceso->setNombre($nombre);
        $politicaProceso->setIdeProceso($ideProceso);
        //inicio grabar archivo
        $origen = $_FILES['politica']['tmp_name'];
        list($politica, $extension) = explode('.', $_FILES['politica']['name']);
        
        $destino = '/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Politicas/' . $politica. '.' . $extension;
         
         if (move_uploaded_file($origen, $destino)) {
             $politicaProceso->setRuta($politica. '.' . $extension);
             $politicaProceso->setTipo($extension);
             $politicaProceso->grabar();
         }

        break;
    case 'Modificar':
        $politicaProceso=new PoliticasOperativasProceso(null, null);
        $politicaProceso->setCodigo($codigo);
        $politicaProceso->setNombre($nombre);
        $politicaProceso->setIdeProceso($ideProceso);
        //grabar registro de actividades
        $registrarActividad->setTabla('PoliticaOperativa');
        $registrarActividad->setAccion('Modificar');
        $registrarActividad->setRegistroAnterior($politicaProceso->getNombre().":".$rutaAnterior);
        $registrarActividad->setIdeProceso($ideProceso);
        $registrarActividad->setUsuario($usuarioActual);
        $registrarActividad->setFechaRealizacion($fechaActual);        
        // fin grabar registro de actividades
        //inicio grabar archivo
        $origen = $_FILES['politica']['tmp_name'];
        if ($origen != "") {
            unlink('/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Politicas/' . $rutaAnterior);
            list($politica, $extension) = explode('.', $_FILES['politica']['name']);        
            $destino = '/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Politicas/' . $politica. '.' . $extension;
            if (move_uploaded_file($origen, $destino)) {
                $politicaProceso->setRuta($politica. '.' . $extension);
                $politicaProceso->setTipo($extension);
                $politicaProceso->modificar();
                $registrarActividad->setRegistroNuevo($nombre.":".$politica. '.' . $extension);
            }
        }else{
            $politicaProceso->setRuta($rutaAnterior);
            $politicaProceso->setTipo($tipoAnterior);
            $politicaProceso->modificar();
        }
        $registrarActividad->grabar();

        break;
    case 'Eliminar':
        $politicaProceso=new PoliticasOperativasProceso("codigo", $codigo);
        //grabar registro de actividades
        $registrarActividad->setTabla('PoliticaOperativa');
        $registrarActividad->setAccion('Eliminar');
        $registrarActividad->setRegistroAnterior($politicaProceso->getNombre().":".$rutaAnterior);
        $registrarActividad->setIdeProceso($ideProceso);
        $registrarActividad->setUsuario($usuarioActual);
        $registrarActividad->setFechaRealizacion($fechaActual);
        $registrarActividad->grabar();
        // fin grabar registro de actividades
        if (unlink('/var/www/html/SoftwareGestion/ArchivosProcesos/'.$carpeta.'/Politicas/' . $rutaAnterior)) {
            $politicaProceso->eliminar();
        }

        break;

}
header("Location: ../../principal.php?CONTENIDO=calidad/administrador/politicasOperativasProceso.php&ideProceso=$ideProceso");