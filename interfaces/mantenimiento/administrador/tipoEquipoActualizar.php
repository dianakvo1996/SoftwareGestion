<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/TipoEquipo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;
date_default_timezone_set("America/Bogota");
$fechaActual= date('dmYHis');

echo $accion;
switch ($accion) {
    case 'Adicionar':
        $tipoEquipo=new TipoEquipo(null, null);
        $tipoEquipo->setNombre(strtoupper($nombre));
        $tipoEquipo->setRutina(strtoupper($rutinas));
        if (isset($calibrable)) $tipoEquipo->setCalibrable('S');
        else $tipoEquipo->setCalibrable ('N');
        $tipoEquipo->setTipo($tipo);
	$tipoEquipo->setClasificacionBiomedica($clasificacionBiomedica);
	$tipoEquipo->setClasificacionRiesgo($clasificacionRiesgo);
	$tipoEquipo->setTecnologiaPredominante($tecnologiaPredominante);
	$tipoEquipo->setManual('S');
	$tipoEquipo->setDescripcionFuncional($descripcionFuncional);

 //inicio subir Archivo
        $origen = $_FILES['fotografia']['tmp_name'];
        list($fotografia, $extension) = explode('.', $_FILES['fotografia']['name']);
        $nombreF= $fotografia.rand().'.' . $extension;
         $destino = '/var/www/html/SoftwareGestion/FotografiasEquipos/'. $fotografia.$fechaActual.'.' . $extension;
         
         if (move_uploaded_file($origen, $destino)) {
            $tipoEquipo->setFotografia($fotografia.$fechaActual.'.' . $extension);
			$tipoEquipo->adicionar();
         }

     break;
    case 'Modificar':
        $tipoEquipo=new TipoEquipo('ide', $ide);
        $tipoEquipo->setNombre(strtoupper($nombre));
        $tipoEquipo->setRutina(strtoupper($rutinas));
        if (isset($calibrable)) $tipoEquipo->setCalibrable('S');
        else $tipoEquipo->setCalibrable ('N');
        $tipoEquipo->setTipo($tipo);
	$tipoEquipo->setClasificacionBiomedica($clasificacionBiomedica);
	$tipoEquipo->setClasificacionRiesgo($clasificacionRiesgo);
	$tipoEquipo->setTecnologiaPredominante($tecnologiaPredominante);
	$tipoEquipo->setManual('S');
	$tipoEquipo->setDescripcionFuncional($descripcionFuncional);

        $origen = $_FILES['fotografia']['tmp_name'];
        if ($origen !="") {
            if ($fotografiaAnterior!="") unlink('/var/www/html/SoftwareGestion/FotografiasEquipos/' . $fotografiaAnterior);
			         
            	list($fotografia, $extension) = explode('.', $_FILES['fotografia']['name']);
         		$destino = '/var/www/html/SoftwareGestion/FotografiasEquipos/'. $fotografia.$fechaActual.'.' . $extension;	
					
                if (move_uploaded_file($origen, $destino)) {

            		$tipoEquipo->setFotografia($fotografia.$fechaActual.'.' . $extension);
				echo 'Hola';
					$tipoEquipo->modificar();
			}
        }else{
        	$tipoEquipo->setFotografia($fotografiaAnterior);
			$tipoEquipo->modificar();
        }

     break;
    case 'Eliminar':
        $tipoEquipo=new TipoEquipo('ide', $ide);
 		unlink('/var/www/html/SoftwareGestion/FotografiasEquipos/' . $tipoEquipo->getFotografia());
        $tipoEquipo->eliminar();
     break;

}
header('Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/tiposEquipos.php');

