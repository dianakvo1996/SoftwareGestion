<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CronogramaC
 *
 * @author Diana
 */
require_once dirname(__FILE__) . '/Calibracion.php';
class CronogramaC {
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
                $cadenaSQL="select * from cronogramaC where $campo=$valor";
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

    function getPerioricidad() {
        return $this->perioricidad;
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

    function getPerioricidadOptions() {
        $periodo='';
        switch ($this->perioricidad) {
            case '2':
                $periodo.="<option>--Selecccione--</option><option value='2' selected>Bimestral</option><option value='3'>Trimestral</option><option value='4'>Cuatrimestral</option><option value='6'>Semestral</option><option value='12'>Anual</option>";
                break;
            case '3':
                $periodo.="<option>--Selecccione--</option><option value='2'>Bimestral</option><option value='3' selected>Trimestral</option><option value='4'>Cuatrimestral</option><option value='6'>Semestral</option><option value='12'>Anual</option>";
                break;
            case '4':
                $periodo.="<option>--Selecccione--</option><option value='2'>Bimestral</option><option value='3'>Trimestral</option><option value='4' selected>Cuatrimestral</option><option value='6'>Semestral</option><option value='12'>Anual</option>";
                break;
            case '6':
                $periodo.="<option>--Selecccione--</option><option value='2'>Bimestral</option><option value='3'>Trimestral</option><option value='4'>Cuatrimestral</option><option value='6' selected>Semestral</option><option value='12'>Anual</option>";
                break;
            case '12':
                $periodo.="<option>--Selecccione--</option><option value='2'>Bimestral</option><option value='3'>Trimestral</option><option value='4'>Cuatrimestral</option><option value='6'>Semestral</option><option value='12' selected>Anual</option>";
                break;	
            default:
                $periodo.="<option>--Selecccione--</option><option value='2'>Bimestral</option><option value='3'>Trimestral</option><option value='4'>Cuatrimestral</option><option value='6'>Semestral</option><option value='12'>Anual</option>";
                break;
        }
        return $periodo;
    }
    
    function getPerioricidadLista() {
        $periodo='';
        switch ($this->perioricidad) {
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
            case '12':
                $periodo.="Anual";
                break;

        }
        return $periodo;
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

    function adicionarCronogramaCliente() {
        $cadenaSQL="insert into cronogramaC(nitCliente,perioricidad,mes)values('{$this->nitCliente}',{$this->perioricidad},{$this->mes})";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificarCronogramaSede() {
        $cadenaSQL="update cronogramaC set ideSede={$this->ideSede}, perioricidad={$this->perioricidad}, mes={$this->mes} where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificarCronogramaCliente() {
        $cadenaSQL="update cronogramaC set nitCliente='{$this->nitCliente}', perioricidad={$this->perioricidad}, mes={$this->mes} where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function adicionarCronogramaSede() {
        $cadenaSQL="insert into cronogramaC(ideSede,perioricidad,mes)values('{$this->ideSede}',{$this->perioricidad},{$this->mes})";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminarCliente() {
        $cadenaSQL="delete from cronogramaC where nitCliente='{$this->nitCliente}'";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminaSede() {
        $cadenaSQL="delete from cronogramaC where ideSede={$this->ideSede}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from cronogramaC";
        if ($filtro!=null) $cadenaSQL.=" where $filtro";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden){
        $datos= CronogramaC::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $cronograma=new CronogramaC($datos[$i],null);
            $lista[$i]=$cronograma;
        }
        return $lista;
    }
	
	function getCalculo() {
        $arreglo=array();       
        $arreglo[0]= $this->mes;
        for ($i = 0; $i < 5; $i++) {
            $arreglo[$i+1]=$arreglo[$i]+$this->perioricidad;
        }
        return $arreglo;
    }
    
    function getValidarCalibracion($mes,$ideCronograma) {
        $añoActual=date('Y');
        $semanas='';
        $mesMas= str_pad($mes, 2,'0',STR_PAD_LEFT);
        $calibracion=new Calibracion('ide', "'$ideCronograma-$mesMas-$añoActual'");
        if ($calibracion->getIde()==null) {
            $semanas="<th class='cambio'></th><th class='cambio'></th><th class='cambio'></th><th class='cambio'></th>";
                       
        }else{
            $semanas="<th style='background:red'></th><th style='background:red'></th><th style='background:red'></th><th style='background:red'></th>";
            
        }
        return $semanas;
    }

}
