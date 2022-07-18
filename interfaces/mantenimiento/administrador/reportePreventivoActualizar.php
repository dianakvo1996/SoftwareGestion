<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ReportePreventivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Repuesto.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/VerificacionMetrologica.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/MantenimientoPreventivo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$afirmativo='S';
$negativo='N';

switch ($accion) {
    case 'Guardar':
        $reporte=new ReportePreventivo(null, null);
		$consecutivo= ConectorBD::ejecutarQuery('select max(numeroreporte) from reportePreventivo', null)[0][0];
		$numeroSig=$consecutivo+1;
        $reporte->setNumeroReporte($numeroSig);
        $reporte->setCiudad($ciudad);
        $reporte->setFecha($fecha);
        $reporte->setIdePersona($idePersona);
        $reporte->setIdeEquipo($ideEquipo);
        $reporte->setIdeMantenimientoPreventivo($ideMantenimientoPreventivo);
        $reporte->setTipoFalla($tipoFalla);
        $reporte->setOtraFalla($otraFalla);
        $reporte->setProblemaPresentado($problemaPresentado);
        $reporte->setTipoMantenimiento($tipoMantenimiento);
        // inicio validacion de actividades
        if (isset($pruebaInicial))$reporte->setPruebaInicial($afirmativo);     
        else $reporte->setPruebaInicial($negativo);
        if (isset($aspectoFisico))$reporte->setAspectoFisico($afirmativo);     
        else $reporte->setAspectoFisico($negativo);
        if (isset($condicionAmbiental))$reporte->setCondicionaAmbiental($afirmativo);     
        else $reporte->setCondicionaAmbiental($negativo);
        if (isset($sistemaElectronico))$reporte->setSistemaElectronico($afirmativo);     
        else $reporte->setSistemaElectronico($negativo);
        if (isset($sistemaHidraulico))$reporte->setSistemaHidraulico($afirmativo);     
        else $reporte->setSistemaHidraulico($negativo);
        if (isset($sistemaNeumatico))$reporte->setSistemaNeumatico($afirmativo);     
        else $reporte->setSistemaNeumatico($negativo);
        if (isset($sistemaMecanico))$reporte->setSistemaMecanico($afirmativo);     
        else $reporte->setSistemaMecanico($negativo);
        if (isset($sistemaElectrico))$reporte->setSistemaElectrico($afirmativo);     
        else $reporte->setSistemaElectrico($negativo);
        if (isset($sistemaOptico))$reporte->setSistemaOptico($afirmativo);     
        else $reporte->setSistemaOptico($negativo);
        if (isset($sistemaElectromecanico))$reporte->setSistemaElectromecanico($afirmativo);     
        else $reporte->setSistemaElectromecanico($negativo);
        if (isset($sistemaVapor))$reporte->setSistemaVapor($afirmativo);     
        else $reporte->setSistemaVapor($negativo);
        if (isset($sistemaOperativo))$reporte->setSistemaOperativo($afirmativo);     
        else $reporte->setSistemaOperativo($negativo);
        if (isset($limpiezaInterna))$reporte->setLimpiezaInterna($afirmativo);     
        else $reporte->setLimpiezaInterna($negativo);
        if (isset($limpiezaExterna))$reporte->setLimpiezaExterna($afirmativo);     
        else $reporte->setLimpiezaExterna($negativo);
        if (isset($lubricacionPartes))$reporte->setLubricacionPartes($afirmativo);     
        else $reporte->setLubricacionPartes($negativo);
        if (isset($pruebasFuncionamiento))$reporte->setPruebasFuncionamiento($afirmativo);     
        else $reporte->setPruebasFuncionamiento($negativo);
        // fin validacion de actividades
        $reporte->setFuncionamiento($funcionamiento);
        $reporte->setObservaciones($observaciones);
        $reporte->setIdeRutinaExtra($ideRutinaExtra);
		$reporte->setIdeUnidadMedida1($ideUnidadMedida1);
		$reporte->setValorMedido1($valorMedido1);
		$reporte->setValorNominal1($valorNominal1);
		$reporte->setIdeUnidadMedida2($ideUnidadMedida2);
		$reporte->setValorMedido2($valorMedido2);
		$reporte->setValorNominal2($valorNominal2);
		$reporte->setIdeUnidadMedida3($ideUnidadMedida3);
		$reporte->setValorMedido3($valorMedido3);
		$reporte->setValorNominal3($valorNominal3);
		$reporte->setIdeUnidadMedida4($ideUnidadMedida4);
		$reporte->setValorMedido4($valorMedido4);
		$reporte->setValorNominal4($valorNominal4);
		$reporte->setIdeUnidadMedida5($ideUnidadMedida5);
		$reporte->setValorMedido5($valorMedido5);
		$reporte->setValorNominal5($valorNominal5);
		$reporte->setIdeUnidadMedida6($ideUnidadMedida6);
		$reporte->setValorMedido6($valorMedido6);
		$reporte->setValorNominal6($valorNominal6);
        $reporte->grabar();

		$numeroReporte=$reporte->getRedireccionamiento($ideMantenimientoPreventivo,$ideEquipo);
//Inicio grabar repuestos  
        $repuesto=new Repuesto(null, null);
        $repuesto->setNumeroPreventivo($numeroReporte);
        $numFilas=$numeroFilas-1;
        for ($i = 1; $i <=$numFilas; $i++) {
            if ($_POST["detalle$i"]) {
                $repuesto->setDetalle($_POST["detalle$i"]);
                $repuesto->setReferencia($_POST["referencia$i"]);
                $repuesto->setCantidad($_POST["cantidad$i"]);
                $repuesto->adicionarPreventivo();				
            }         
        }
//Fin grabar repuestos
//Inicio grabar verificacion metrologica
//Fin grabar verificacion metrologica
     break;
    case 'Modificar':
        $reporte=new ReportePreventivo('numeroReporte',"'".$numeroReporte."'");
        $reporte->setNumeroReporte($numeroReporte);
        $reporte->setCiudad($ciudad);
        $reporte->setFecha($fecha);
        $reporte->setIdePersona($idePersona);
        $reporte->setIdeEquipo($ideEquipo);
        $reporte->setIdeMantenimientoPreventivo($ideMantenimientoPreventivo);
        $reporte->setTipoFalla($tipoFalla);
        $reporte->setOtraFalla($otraFalla);
        $reporte->setProblemaPresentado($problemaPresentado);
        // inicio validacion de actividades
        if (isset($pruebaInicial))$reporte->setPruebaInicial($afirmativo);     
        else $reporte->setPruebaInicial($negativo);
        if (isset($aspectoFisico))$reporte->setAspectoFisico($afirmativo);     
        else $reporte->setAspectoFisico($negativo);
        if (isset($condicionAmbiental))$reporte->setCondicionaAmbiental($afirmativo);     
        else $reporte->setCondicionaAmbiental($negativo);
        if (isset($sistemaElectronico))$reporte->setSistemaElectronico($afirmativo);     
        else $reporte->setSistemaElectronico($negativo);
        if (isset($sistemaHidraulico))$reporte->setSistemaHidraulico($afirmativo);     
        else $reporte->setSistemaHidraulico($negativo);
        if (isset($sistemaNeumatico))$reporte->setSistemaNeumatico($afirmativo);     
        else $reporte->setSistemaNeumatico($negativo);
        if (isset($sistemaMecanico))$reporte->setSistemaMecanico($afirmativo);     
        else $reporte->setSistemaMecanico($negativo);
        if (isset($sistemaElectrico))$reporte->setSistemaElectrico($afirmativo);     
        else $reporte->setSistemaElectrico($negativo);
        if (isset($sistemaOptico))$reporte->setSistemaOptico($afirmativo);     
        else $reporte->setSistemaOptico($negativo);
        if (isset($sistemaElectromecanico))$reporte->setSistemaElectromecanico($afirmativo);     
        else $reporte->setSistemaElectromecanico($negativo);
        if (isset($sistemaVapor))$reporte->setSistemaVapor($afirmativo);     
        else $reporte->setSistemaVapor($negativo);
        if (isset($sistemaOperativo))$reporte->setSistemaOperativo($afirmativo);     
        else $reporte->setSistemaOperativo($negativo);
        if (isset($limpiezaInterna))$reporte->setLimpiezaInterna($afirmativo);     
        else $reporte->setLimpiezaInterna($negativo);
        if (isset($limpiezaExterna))$reporte->setLimpiezaExterna($afirmativo);     
        else $reporte->setLimpiezaExterna($negativo);
        if (isset($lubricacionPartes))$reporte->setLubricacionPartes($afirmativo);     
        else $reporte->setLubricacionPartes($negativo);
        if (isset($pruebasFuncionamiento))$reporte->setPruebasFuncionamiento($afirmativo);     
        else $reporte->setPruebasFuncionamiento($negativo);
        // fin validacion de actividades
        $reporte->setFuncionamiento($funcionamiento);
        $reporte->setObservaciones($observaciones);
        $reporte->setIdeRutinaExtra($ideRutinaExtra);
		$reporte->setIdeUnidadMedida1($ideUnidadMedida1);
		$reporte->setValorMedido1($valorMedido1);
		$reporte->setValorNominal1($valorNominal1);
		$reporte->setIdeUnidadMedida2($ideUnidadMedida2);
		$reporte->setValorMedido2($valorMedido2);
		$reporte->setValorNominal2($valorNominal2);
		$reporte->setIdeUnidadMedida3($ideUnidadMedida3);
		$reporte->setValorMedido3($valorMedido3);
		$reporte->setValorNominal3($valorNominal3);
		$reporte->setIdeUnidadMedida4($ideUnidadMedida4);
		$reporte->setValorMedido4($valorMedido4);
		$reporte->setValorNominal4($valorNominal4);
		$reporte->setIdeUnidadMedida5($ideUnidadMedida5);
		$reporte->setValorMedido5($valorMedido5);
		$reporte->setValorNominal5($valorNominal5);
		$reporte->setIdeUnidadMedida6($ideUnidadMedida6);
		$reporte->setValorMedido6($valorMedido6);
		$reporte->setValorNominal6($valorNominal6);
        $reporte->modificar();
//Inicio grabar repuestos  
        
        $numFilas=$numeroFilas-1;
        for ($i = 1; $i <=$numFilas; $i++) {
            if (isset($_POST["ideRepuesto$i"])) {
                $repuesto=new Repuesto('ide', $_POST["ideRepuesto$i"]);
                $repuesto->setDetalle($_POST["detalle$i"]);
                $repuesto->setReferencia($_POST["referencia$i"]);
                $repuesto->setCantidad($_POST["cantidad$i"]);
                $repuesto->modificar();
            }else{
                $repuesto=new Repuesto(null, null);
                $repuesto->setDetalle($_POST["detalle$i"]);
                $repuesto->setReferencia($_POST["referencia$i"]);
                $repuesto->setCantidad($_POST["cantidad$i"]);
                $repuesto->setNumeroPreventivo($numeroReporte);
                $repuesto->adicionarPreventivo();
            }       
        }
//Fin grabar repuestos        
        break;
}
header('Location: verReportePreventivo.php?numeroReporte='.$numeroReporte);