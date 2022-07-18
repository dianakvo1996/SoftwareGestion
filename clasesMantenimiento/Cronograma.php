<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cronograma
 *
 * @author Adriana
 */
require_once dirname(__FILE__) . '/MantenimientoPreventivo.php';
require_once dirname(__FILE__) . '/Sede.php';
require_once dirname(__FILE__) . '/Cliente.php';

class Cronograma {
    private $ide;
    private $ideSede;
    private $nitCliente;
    private $mes;
    private $perioricidad;
    
    function __construct($campo,$valor) {
        if ($campo!=null){
            if (is_array($campo))
                $this->cargarAtributos($campo);
            else{
                $cadenaSQL="select ide, ideSede, nitCliente, mes, perioricidad from cronograma where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)
                    $this->cargarAtributos ($resultado[0]);
        }
    }
}
    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->ideSede=$datos['idesede'];
        $this->nitCliente=$datos['nitcliente'];
        $this->mes=$datos['mes'];
        $this->perioricidad=$datos['perioricidad'];
    }
    function getIde() {
        return $this->ide;
    }

    function getIdeSede() {
        return $this->ideSede;
    }

    function getNitCliente() {
        return $this->nitCliente;
    }

    function getMes() {
        return $this->mes;
    }
    
    
    function getMesLista() {
        $mes='';
        switch ($this->mes) {
            case '1':
                $mes='Enero';
                break;
            case '2':
                $mes='Febrero';
                break;
            case '3':
                $mes='Marzo';
                break;
            case '4':
                $mes='Abril';
                break;
            case '5':
                $mes='Mayo';
                break;
            case '6':
                $mes='Junio';
                break;
            case '7':
                $mes='Julio';
                break;
            case '8':
                $mes='Agosto';
                break;
            case '9':
                $mes='Septiembre';
                break;
            case '10':
                $mes='Octubre';
                break;
            case '11':
                $mes='Noviembre';
                break;
            case '12':
                $mes='Diciembre';
                break;
        }
        return $mes;       
    }

    function getPerioricidad() {
        return $this->perioricidad;
    }
    function getPerioricidadOptions() {
        $periodo='';
        switch ($this->perioricidad) {
	    case '1':
                $periodo.="<option>--Selecccione--</option><option value='1' selected>Mensual</option><option value='2'>Bimestral</option><option value='3'>Trimestral</option><option value='4'>Cuatrimestral</option><option value='6'>Semestral</option>";
                break;

            case '2':
                $periodo.="<option>--Selecccione--</option><option value='1'>Mensual</option><option value='2' selected>Bimestral</option><option value='3'>Trimestral</option><option value='4'>Cuatrimestral</option><option value='6'>Semestral</option>";
                break;
            case '3':
                $periodo.="<option>--Selecccione--</option><option value='1'>Mensual</option><option value='2'>Bimestral</option><option value='3' selected>Trimestral</option><option value='4'>Cuatrimestral</option><option value='6'>Semestral</option>";
                break;
            case '4':
                $periodo.="<option>--Selecccione--</option><option value='1'>Mensual</option><option value='2'>Bimestral</option><option value='3'>Trimestral</option><option value='4' selected>Cuatrimestral</option><option value='6'>Semestral</option>";
                break;
            case '6':
                $periodo.="<option>--Selecccione--</option><option value='1'>Mensual</option><option value='2'>Bimestral</option><option value='3'>Trimestral</option><option value='4'>Cuatrimestral</option><option value='6' selected>Semestral</option>";
                break;
            default:
                $periodo.="<option>--Selecccione--</option><option value='1'>Mensual</option><option value='2'>Bimestral</option><option value='3'>Trimestral</option><option value='4'>Cuatrimestral</option><option value='6'>Semestral</option>";
                break;
        }
        return $periodo;
    }
    
    function getPerioricidadLista() {
        $periodo='';
        switch ($this->perioricidad) {
	    case '1':
                $periodo.="Mensual";
                break;
            case '2':
                $periodo.="Bimestral";
                break;
            case '3':
                $periodo.="Trimestal";
                break;
            case '4':
                $periodo.="Cuatrimestral";
                break;
            case '6':
                $periodo.="Semestral";
                break;
        }
        return $periodo;
    }
    
    function setIde($ide) {
        $this->ide = $ide;
    }

    function setIdeSede($ideSede) {
        $this->ideSede = $ideSede;
    }

    function setNitCliente($nitCliente) {
        $this->nitCliente = $nitCliente;
    }

    function setMes($mes) {
        $this->mes = $mes;
    }

    function setPerioricidad($perioricidad) {
        $this->perioricidad = $perioricidad;
    }
    
    function adicionarCronogramaCliente() {
        $cadenaSQL="insert into cronograma(nitCliente,perioricidad,mes)values('{$this->nitCliente}',{$this->perioricidad},{$this->mes})";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificarCronogramaSede() {
        $cadenaSQL="update cronograma set ideSede={$this->ideSede}, perioricidad={$this->perioricidad}, mes={$this->mes} where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificarCronogramaCliente() {
        $cadenaSQL="update cronograma set nitCliente='{$this->nitCliente}', perioricidad={$this->perioricidad}, mes={$this->mes} where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function adicionarCronogramaSede() {
        $cadenaSQL="insert into cronograma(ideSede,perioricidad,mes)values('{$this->ideSede}',{$this->perioricidad},{$this->mes})";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminarCliente() {
        $cadenaSQL="delete from cronograma where nitCliente='{$this->nitCliente}'";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminaSede() {
        $cadenaSQL="delete from cronograma where ideSede={$this->ideSede}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select ide, ideSede, nitCliente, mes, perioricidad from cronograma";
        if ($filtro!=null) $cadenaSQL.=" where $filtro";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden){
        $datos= Cronograma::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $cronograma=new Cronograma($datos[$i],null);
            $lista[$i]=$cronograma;
        }
        return $lista;
    }
    
    function getCalculo() {
        $arreglo=array();       
        $arreglo[0]= $this->mes;
        for ($i = 0; $i < 11; $i++) {
            $arreglo[$i+1]=$arreglo[$i]+$this->perioricidad;
        }
        return $arreglo;
    }
    
    function getValidarMantenimiento($mes,$ideCronograma) {
        $añoActual=date('Y');
        $semanas='';
        $mesMas= str_pad($mes, 2,'0',STR_PAD_LEFT);
        $calibracion=new MantenimientoPreventivo('validar', "'$ideCronograma-$mesMas-$añoActual'");
        if ($calibracion->getIde()==null) {
            $semanas="<th class='cambio'></th><th class='cambio'></th><th class='cambio'></th><th class='cambio'></th>";               
        }else{
            $semanas="<th style='background:#60EF35'></th><th style='background:#60EF35'></th><th style='background:#60EF35'></th><th style='background:#60EF35'></th>";            
        }
        return $semanas;
    }
//Inicio llaves foraneas
	function getSede(){
		return new Sede('ide',$this->ide);
	}
//Fin llaves foraneas
}
