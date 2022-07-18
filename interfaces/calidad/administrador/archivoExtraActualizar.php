<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/ArchivoExtra.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/RegistroActividad.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;
// registrar Actividad
    date_default_timezone_set("America/Bogota");
    $fechaActual= date('d-m-Y H:i:s');
    $registrarActividad=new RegistroActividad(null, null);
// fin registrar Actividad
$archivoExtra=new ArchivoExtra(null,null);
//grabar registro de actividades
            $registrarActividad->setTabla('ArchivoExtra:'.$tipo);
            $registrarActividad->setAccion('Modificar');
            $registrarActividad->setRegistroAnterior($tipo.":".$archivoAnterior);
            $registrarActividad->setUsuario($usuarioActual);
            $registrarActividad->setFechaRealizacion($fechaActual);
        // fin grabar registro de actividades
//inicio subir Archivo
        $origen = $_FILES['archivo']['tmp_name'];
        if ($origen !="") {
            if (unlink("/var/www/html/SoftwareGestion/ArchivosProcesos/Archivos_Extras/" . $archivoAnterior)) {            
                list($archivo, $extension) = explode('.', $_FILES['archivo']['name']);

                $destino = '/var/www/html/SoftwareGestion/ArchivosProcesos/Archivos_Extras/' . $archivo. '.' . $extension;

                if (move_uploaded_file($origen, $destino)) {
                  $archivoExtra->setNombre($archivo);
                  $archivoExtra->setArchivo($archivo.".".$extension);
                  $archivoExtra->setTipo($tipo);
                  $archivoExtra->modificar();
                  $registrarActividad->setRegistroNuevo($archivo.".".$extension.":{$tipo}");
                  $registrarActividad->grabar();
              } 
           }
        }
header("Location: ../../principal.php?CONTENIDO=calidad/administrador/visualizadorArchivos.php&tipo=$tipo");