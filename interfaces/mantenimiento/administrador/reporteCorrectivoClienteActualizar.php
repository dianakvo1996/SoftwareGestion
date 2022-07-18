<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ReporteCorrectivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Repuesto.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/VerificacionMetrologica.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$afirmativo='S';
$negativo='N';

switch ($accion) {
    case 'Guardar':
        $reporte=new ReporteCorrectivo(null, null);
        $reporte->setNumeroReporte($numeroReporte);
        $reporte->setCiudad($ciudad);
        $reporte->setFecha($fecha);
        $reporte->setTipoFalla($tipoFalla);
        $reporte->setOtraFalla($otraFalla);
        $reporte->setIdePersona($idePersona);
        $reporte->setIdeEquipo($ideEquipo);
        $reporte->setProblemaPresentado($problemaPresentado);
        $reporte->setFuncionamiento($funcionamiento);
        $reporte->setObservaciones($observaciones);
        //inicio validacion actividades
        if (isset($aspectoFisico))$reporte->setAspectoFisico($afirmativo);
        else $reporte->setAspectoFisico($negativo);
        if (isset($condicionAmbiental))$reporte->setCondicionAmbiental($afirmativo);
        else $reporte->setCondicionAmbiental($negativo);
        if (isset($limpiezaInterna))$reporte->setLimpiezaInterna($afirmativo);
        else $reporte->setLimpiezaInterna($negativo);
        if (isset($limpiezaExterna))$reporte->setLimpiezaExterna($afirmativo);
        else $reporte->setLimpiezaExterna($negativo);
        if (isset($pruebasFuncionamiento))$reporte->setPruebasFuncionamiento($afirmativo);
        else $reporte->setPruebasFuncionamiento($negativo);
        if (isset($lubricacionPartes))$reporte->setLubricacionPartes($afirmativo);
        else $reporte->setLubricacionPartes($negativo);        
        if(isset($pruebaInicial))$reporte->setPruebaInicial($afirmativo);
        else $reporte->setPruebaInicial ($negativo);
        if (isset($sistemaElectronico))$reporte->setSistemaElectronico($afirmativo);
        else $reporte->setSistemaElectronico ($negativo);
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
        if (isset($sistemaOperativo))$reporte->setSistemaOperativo($afirmativo);
        else $reporte->setSistemaOperativo($negativo);
        if (isset($sistemaElectromecanico))$reporte->setSistemaElectromecanico($afirmativo);
        else $reporte->setSistemaElectromecanico($negativo);
        if (isset($sistemaVapor))$reporte->setSistemaVapor($afirmativo);
        else $reporte->setSistemaVapor($negativo);
        //Fin validacion actividades
        $reporte->setFecha($fecha);
        $reporte->setTipoMantenimiento($tipoMantenimiento);
        $reporte->setNitCliente($nitCliente);
        $reporte->setIdeSede($ideSede);
        $reporte->grabarCliente();
//Inicio grabar repuestos  
        $repuesto=new Repuesto(null, null);
        $repuesto->setNumeroCorrectivo($numeroReporte);
        $numFilas=$numeroFilas-1;
        for ($i = 1; $i <=$numFilas; $i++) {
            if ($_POST["detalle$i"]) {
                $repuesto->setDetalle($_POST["detalle$i"]);
                $repuesto->setReferencia($_POST["referencia$i"]);
                $repuesto->setCantidad($_POST["cantidad$i"]);
                $repuesto->adicionarCorrectivo();
            }         
        }
//Fin grabar repuestos
//Inicio grabar verificacion metrologica
        $verificacion=new VerificacionMetrologica(null, null);
        $verificacion->setNumeroCorrectivo($numeroReporte);
        for ($j = 1; $j < 3; $j++) {
            $verificacion->setIdeUnidadMedida($_POST["udMedida$j"]);
            $verificacion->setValorMedido($_POST["valorMedido$j"]);
            $verificacion->setValorNominal($_POST["valorNominal$j"]);
            $verificacion->adicionarCorrectivo();
        }
//Fin grabar verificacion metrologica
        break;
    case 'Modificar':
        $reporte=new ReporteCorrectivo('numeroReporte',"'".$numeroReporte."'");
        $reporte->setCiudad($ciudad);
        $reporte->setFecha($fecha);
        $reporte->setTipoFalla($tipoFalla);
        $reporte->setOtraFalla($otraFalla);
        $reporte->setIdePersona($idePersona);
        $reporte->setIdeEquipo($ideEquipo);
        $reporte->setProblemaPresentado($problemaPresentado);
        $reporte->setFuncionamiento($funcionamiento);
        $reporte->setObservaciones($observaciones);
        //inicio validacion actividades
        if (isset($aspectoFisico))$reporte->setAspectoFisico($afirmativo);
        else $reporte->setAspectoFisico($negativo);
        if (isset($condicionAmbiental))$reporte->setCondicionAmbiental($afirmativo);
        else $reporte->setCondicionAmbiental($negativo);
        if (isset($limpiezaInterna))$reporte->setLimpiezaInterna($afirmativo);
        else $reporte->setLimpiezaInterna($negativo);
        if (isset($limpiezaExterna))$reporte->setLimpiezaExterna($afirmativo);
        else $reporte->setLimpiezaExterna($negativo);
        if (isset($pruebasFuncionamiento))$reporte->setPruebasFuncionamiento($afirmativo);
        else $reporte->setPruebasFuncionamiento($negativo);
        if (isset($lubricacionPartes))$reporte->setLubricacionPartes($afirmativo);
        else $reporte->setLubricacionPartes($negativo);        
        if(isset($pruebaInicial))$reporte->setPruebaInicial($afirmativo);
        else $reporte->setPruebaInicial ($negativo);
        if (isset($sistemaElectronico))$reporte->setSistemaElectronico($afirmativo);
        else $reporte->setSistemaElectronico ($negativo);
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
        if (isset($sistemaOperativo))$reporte->setSistemaOperativo($afirmativo);
        else $reporte->setSistemaOperativo($negativo);
        if (isset($sistemaElectromecanico))$reporte->setSistemaElectromecanico($afirmativo);
        else $reporte->setSistemaElectromecanico($negativo);
        if (isset($sistemaVapor))$reporte->setSistemaVapor($afirmativo);
        else $reporte->setSistemaVapor($negativo);
        //Fin validacion actividades
        $reporte->setFecha($fecha);
        $reporte->setTipoMantenimiento($tipoMantenimiento);
        $reporte->setNitCliente($nitCliente);
        $reporte->setIdeSede($ideSede);
        $reporte->modificarCliente();
        //Inicio Verificacion Metrologica
        for ($j = 1; $j < 3; $j++) {
            $verificacion=new VerificacionMetrologica('ide', $_POST["ideValor$j"]);
            $verificacion->setIdeUnidadMedida($_POST["udMedida$j"]);
            $verificacion->setValorMedido($_POST["valorMedido$j"]);
            $verificacion->setValorNominal($_POST["valorNominal$j"]);
            $verificacion->modificar();
        }
        //Fin Verificacion Metrologica
        //Inicio Repuestos
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
                $repuesto->setNumeroCorrectivo($numeroReporte);
                $repuesto->adicionarCorrectivo();
            }       
        }
        //Fin Repuestos
        break;
}
//header('Location: verReporteCorrectivo.php?numeroReporte='.$numeroReporte);