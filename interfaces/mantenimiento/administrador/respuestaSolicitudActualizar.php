<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/RespuestaSolicitud.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

date_default_timezone_set('America/Bogota');
$fechaRealizacion= date('Y-m-d H:i:s');

switch ($accion) {
    case 'Responder':
        $respuestaSolicitud=new RespuestaSolicitud('ide', $ideRespuesta);
	if($_FILES['evidencia']['tmp_name']!=null){
        //Inicio subir evidencia
            $origen = $_FILES['evidencia']['tmp_name'];
            list($evidencia, $extension) = explode('.', $_FILES['evidencia']['name']);
        
         $destino = '/var/www/html/SoftwareGestion/EvidenciasCorrectivos/' . $evidencia.'_'.date('YmdHis'). '.' . $extension;
         
        if (move_uploaded_file($origen, $destino)) {
            $respuestaSolicitud->setRespuesta($respuesta);
            $respuestaSolicitud->setEstado($estado);
            $respuestaSolicitud->setFechaRealizacion($fechaRealizacion);
            $respuestaSolicitud->setEvidencia($evidencia.'_'.date('YmdHis'). '.' . $extension);
            $respuestaSolicitud->modificarRespuesta();
        }
	}else{
			$respuestaSolicitud->setRespuesta($respuesta);
			$respuestaSolicitud->setFechaEnProceso(date('Y-m-d H:i:s'));
            $respuestaSolicitud->setEstado($estado);
            $respuestaSolicitud->modificarRespuestaEnProceso();
		}     
        //Fin subir evidencia
     break;

    default:
        break;
}
header('Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/bandejaEntrada.php');