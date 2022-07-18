<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CaracteristicasFisicasTecnicas
 *
 * @author DIANA V
 */
class CaracteristicasFisicasTecnicas {
    private $ide;
    private $ideEquipo;
    private $voltajeOperacion;
	private $voltajeMaxOperacion;
    private $corrienteMaxOperacion;
    private $corrienteMinOperacion;
    private $potenciaConsumida;
    private $frecuencia;
    private $presion;
    private $velocidad;
    private $peso;
    private $capacidad;
    private $dimensiones;
    private $aniosVida;
    private $requiereAgua;
    private $requiereGasPropano;
    private $requiereCombustible;
    private $requiereGasMedicinal;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))$this->cargarAtributos ($datos);
            else{
                $cadenaSQL="select * from caracteristicasFisicasTecnicas where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)$this->cargarAtributos ($resultado[0]);
            }
        }
    }
    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->ideEquipo=$datos['ideequipo'];
        $this->voltajeOperacion=$datos['voltajeoperacion'];
        $this->voltajeMaxOperacion=$datos['voltajemaxoperacion'];
        $this->corrienteMaxOperacion=$datos['corrientemaxoperacion'];
        $this->corrienteMinOperacion=$datos['corrienteminoperacion'];
        $this->potenciaConsumida=$datos['potenciaconsumida'];
        $this->frecuencia=$datos['frecuencia'];
        $this->presion=$datos['presion'];
        $this->velocidad=$datos['velocidad'];
        $this->peso=$datos['peso'];
        $this->capacidad=$datos['capacidad'];
        $this->dimensiones=$datos['dimensiones'];
        $this->aniosVida=$datos['aniosvida'];
        $this->requiereAgua=$datos['requiereagua'];
        $this->requiereGasPropano=$datos['requieregaspropano'];
        $this->requiereCombustible=$datos['requierecombustible'];
        $this->requiereGasMedicinal=$datos['requieregasesmedicinales'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getIdeEquipo() {
        return $this->ideEquipo;
    }

    function getVoltajeOperacion() {
        return $this->voltajeOperacion;
    }

    function getVoltajeMaxOperacion() {
        return $this->voltajeMaxOperacion;
    }

    function getCorrienteMaxOperacion() {
        return $this->corrienteMaxOperacion;
    }

    function getCorrienteMinOperacion() {
        return $this->corrienteMinOperacion;
    }

    function getPotenciaConsumida() {
        return $this->potenciaConsumida;
    }

    function getFrecuencia() {
        return $this->frecuencia;
    }

    function getPresion() {
        return $this->presion;
    }

    function getVelocidad() {
        return $this->velocidad;
    }

    function getPeso() {
        return $this->peso;
    }

    function getCapacidad() {
        return $this->capacidad;
    }

    function getDimensiones() {
        return $this->dimensiones;
    }

    function getAniosVida() {
        return $this->aniosVida;
    }

    function getRequiereAgua() {
        return $this->requiereAgua;
    }

    function getRequiereGasPropano() {
        return $this->requiereGasPropano;
    }

    function getRequiereCombustible() {
        return $this->requiereCombustible;
    }

    function getRequiereGasMedicinal() {
        return $this->requiereGasMedicinal;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setIdeEquipo($ideEquipo) {
        $this->ideEquipo = $ideEquipo;
    }

    function setVoltajeOperacion($voltajeOperacion) {
        $this->voltajeOperacion = $voltajeOperacion;
    }

    function setVoltajeMaxOperacion($voltajeMaxOperacion) {
        $this->voltajeMaxOperacion = $voltajeMaxOperacion;
    }

    function setCorrienteMaxOperacion($corrienteMaxOperacion) {
        $this->corrienteMaxOperacion = $corrienteMaxOperacion;
    }

    function setCorrienteMinOperacion($corrienteMinOperacion) {
        $this->corrienteMinOperacion = $corrienteMinOperacion;
    }

    function setPotenciaConsumida($potenciaConsumida) {
        $this->potenciaConsumida = $potenciaConsumida;
    }

    function setFrecuencia($frecuencia) {
        $this->frecuencia = $frecuencia;
    }

    function setPresion($presion) {
        $this->presion = $presion;
    }

    function setVelocidad($velocidad) {
        $this->velocidad = $velocidad;
    }

    function setPeso($peso) {
        $this->peso = $peso;
    }

    function setCapacidad($capacidad) {
        $this->capacidad = $capacidad;
    }

    function setDimensiones($dimensiones) {
        $this->dimensiones = $dimensiones;
    }

    function setAniosVida($aniosVida) {
        $this->aniosVida = $aniosVida;
    }

    function setRequiereAgua($requiereAgua) {
        $this->requiereAgua = $requiereAgua;
    }

    function setRequiereGasPropano($requiereGasPropano) {
        $this->requiereGasPropano = $requiereGasPropano;
    }

    function setRequiereCombustible($requiereCombustible) {
        $this->requiereCombustible = $requiereCombustible;
    }

    function setRequiereGasMedicinal($requiereGasMedicinal) {
        $this->requiereGasMedicinal = $requiereGasMedicinal;
    }

	function adicionar(){
		$columnas="ideEquipo,voltajeOperacion,voltajemaxoperacion,corrientemaxoperacion,corrienteminoperacion,potenciaConsumida,frecuencia,presion, velocidad, peso, capacidad,dimensiones,aniosvida,requiereagua,requieregaspropano,requierecombustible,requieregasesmedicinales";
		$values="{$this->ideEquipo},'{$this->voltajeOperacion}','{$this->voltajeMaxOperacion}','{$this->corrienteMaxOperacion}','{$this->corrienteMinOperacion}','{$this->potenciaConsumida}','{$this->frecuencia}','{$this->presion}','{$this->velocidad}','{$this->peso}','{$this->capacidad}','{$this->dimensiones}','{$this->aniosVida}','{$this->requiereAgua}','{$this->requiereGasPropano}','{$this->requiereCombustible}','{$this->requiereGasMedicinal}'";
		$cadenaSQL="insert into caracteristicasFisicasTecnicas({$columnas})values({$values})";
		ConectorBD::ejecutarQuery($cadenaSQL, null);

	}

	function modificar(){
		$valores="voltajeOperacion='{$this->voltajeOperacion}', voltajeMaxOperacion='{$this->voltajeMaxOperacion}', corrienteMaxOperacion='{$this->corrienteMaxOperacion}', corrienteMinOperacion='{$this->corrienteMinOperacion}', potenciaConsumida='{$this->potenciaConsumida}', frecuencia='{$this->frecuencia}', presion='{$this->presion}', velocidad='{$this->velocidad}',peso='{$this->peso}',capacidad='{$this->capacidad}',dimensiones='{$this->dimensiones}',aniosvida='{$this->aniosVida}', requiereagua='{$this->requiereAgua}', requieregaspropano='{$this->requiereGasPropano}', requierecombustible='{$this->requiereCombustible}', requiereGasesMedicinales='{$this->requiereGasMedicinal}'";
		$cadenaSQL="update caracteristicasFisicasTecnicas set {$valores} where ideEquipo={$this->ideEquipo}";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
	}

    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from caracteristicasFisicasTecnicas";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos = CaracteristicasFisicasTecnicas::getDatos($filtro, $orden);
        $lista = array();
        for ($j = 0; $j < count($datos); $j++) {
            $caracteristicas=new CaracteristicasFisicasTecnicas($datos[j], null);
            $lista[$i]=$caracteristicas;
        }
        return $lista;
    }

//Inicio procedimeintos radios options listas
    function getRequiereAguaOptions() {
        $radio='';
        $lista='';
        switch ($this->requiereAgua) {
            case 'SI':
                $radio.="<input type='radio' id='S1' value='SI' checked name='requiereAgua' required> <label for='S1'>SI</label> <input type='radio' id='N1' value='NO' name='requiereAgua'> <label for='N1'>NO</label>";
                $lista.="<img src='../presentacion/imagenes/vistoBlue.png' width='15px'> SI <img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NO";
                break;
            case 'NO':
                $radio.="<input type='radio' id='S1' value='SI' name='requiereAgua' required> <label for='S1'>SI</label> <input type='radio' id='N1' value='NO' checked name='requiereAgua'> <label for='N1'>NO</label>";
                $lista.="<img src='../presentacion/imagenes/vacioBlue.png' width='15px'>  SI  <img src='../presentacion/imagenes/vistoBlue.png' width='15px'> NO";
                break;
            default:
                $radio.="<input type='radio' id='S1' value='SI' name='requiereAgua' required> <label for='S1'>SI</label> <input type='radio' id='N1' value='NO' name='requiereAgua'> <label for='N1'>NO</label>";
                $lista.='-';
                break;
        }
        return array($radio,$lista);
    }
    
    function getRequiereGasPropanoOptions() {
        $radio='';
        $lista='';
        switch ($this->requiereGasPropano) {
            case 'SI':
                $radio.="<input type='radio' id='S2' value='SI' checked name='requiereGasPropano' required> <label for='S2'>SI</label> <input type='radio' id='N2' value='NO' name='requiereGasPropano'> <label for='N2'>NO</label>";
                $lista.="<img src='../presentacion/imagenes/vistoBlue.png' width='15px'> SI <img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NO";
                break;
            case 'NO':
                $radio.="<input type='radio' id='S2' value='SI' name='requiereGasPropano' required> <label for='S2'>SI</label> <input type='radio' id='N2' value='NO' checked name='requiereGasPropano'> <label for='N2'>NO</label>";
                $lista.="<img src='../presentacion/imagenes/vacioBlue.png' width='15px'> SI <img src='../presentacion/imagenes/vistoBlue.png' width='15px'> NO";
                break;
            default:
                $radio.="<input type='radio' id='S2' value='SI' name='requiereGasPropano' required> <label for='S2'>SI</label> <input type='radio' id='N2' value='NO' name='requiereGasPropano'> <label for='N2'>NO</label>";
                $lista.='-';
                break;
        }
        return array($radio,$lista);
    }
    function getRequiereCombustibleOptions() {
        $radio='';
        $lista='';
        switch ($this->requiereCombustible) {
            case 'SI':
                $radio.="<input type='radio' id='S3' value='SI' checked name='requiereCombustible' required> <label for='S3'> SI </label><input type='radio' id='N3' value='NO' name='requiereCombustible'><label for='N3'>NO</label>";
                $lista.="<img src='../presentacion/imagenes/vistoBlue.png' width='15px'> SI     <img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NO";
                break;
            case 'NO':
                $radio.="<input type='radio' id='S3' value='SI' name='requiereCombustible' required> <label for='S3'>SI</label> <input type='radio' id='N3' value='NO' checked name='requiereCombustible'><label for='N3'>NO</label>";
                $lista.="<img src='../presentacion/imagenes/vacioBlue.png' width='15px'> SI     <img src='../presentacion/imagenes/vistoBlue.png' width='15px'> NO";
                break;
            default:
                $radio.="<input type='radio' id='S3' value='SI' name='requiereCombustible' required> <label for='S3'>SI</label> <input type='radio' id='N3' value='NO' name='requiereCombustible'> <label for='N3'>NO</label>";
                $lista.='-';
                break;
        }
        return array($radio,$lista);
    }
    function getRequiereGasMedicinalOptions() {
        $radio='';
        $lista='';
        switch ($this->requiereGasMedicinal) {
            case 'SI':
                $radio.="<input type='radio' id='S4' value='SI' checked name='requiereGasMedicinal' required> <label for='S4'>SI</label> <input type='radio' id='N4' value='NO' name='requiereGasMedicinal'> <label for='N4'>NO</label>";
                $lista.="<img src='../presentacion/imagenes/vistoBlue.png' width='15px'>  SI <img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NO";
                break;
            case 'NO':
                $radio.="<input type='radio' id='S4' value='SI' name='requiereGasMedicinal' required> <label for='S4'>SI</label> <input type='radio' id='N4' value='NO' checked name='requiereGasMedicinal'> <label for='N4'>NO</label>";
                $lista.="<img src='../presentacion/imagenes/vacioBlue.png' width='15px'>  SI <img src='../presentacion/imagenes/vistoBlue.png' width='15px'> NO";
                break;
            default:
                $radio.="<input type='radio' id='S4' value='SI' name='requiereGasMedicinal' required> <label for='S4'>SI</label> <input type='radio' id='N4' value='NO' name='requiereGasMedicinal'> <label for='N4'>NO</label>";
                $lista.='-';
                break;
        }
        return array($radio,$lista);
    }
//Fin procedimeintos radios options listas
}

