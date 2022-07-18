<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdquisicionInstalacion
 *
 * @author DIANA V
 */

require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/DatosFabricante.php';
class AdquisicionInstalacion {
    private $ide;
    private $ideEquipo;
	private $ideFabricante;
	private $ideProveedor;
    private $formaAquisicion;
    private $costoAquisicion;
    private $fechaCompra;
    private $fechaInstalacion;
    private $inicioGarantia;
    private $finalizacionGarantia;
    private $fechaPuestaServicio;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))$this->cargarAtributos ($campo);
            else{
                $cadenaSQL="select * from adquisicionInstalacion where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)$this->cargarAtributos ($resultado[0]);
            }
        }
    }

    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->ideEquipo=$datos['ideequipo'];
        $this->ideFabricante=$datos['idefabricante'];
        $this->ideProveedor=$datos['ideproveedor'];
        $this->formaAquisicion=$datos['formaadquisicion'];
        $this->costoAquisicion=$datos['costoadquisicion'];
        $this->fechaCompra=$datos['fechacompra'];
        $this->fechaInstalacion=$datos['fechainstalacion'];
        $this->inicioGarantia=$datos['iniciogarantia'];
        $this->finalizacionGarantia=$datos['finalizaciongarantia'];
        $this->fechaPuestaServicio=$datos['fechapuestaservicio'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getIdeEquipo() {
        return $this->ideEquipo;
    }

    function getIdeFabricante() {
        return $this->ideFabricante;
    }

    function getIdeProveedor() {
        return $this->ideProveedor;
    }

    function getFormaAquisicion() {
        return $this->formaAquisicion;
    }

    function getCostoAquisicion() {
        return $this->costoAquisicion;
    }
	
	function getCostoAdquisicionMostrar(){
		$costo = "$ ".number_format($this->costoAquisicion);
		return $costo; 
	}
    function getFechaCompra() {
		$this->fechaCompra = explode(" ", $this->fechaCompra)[0];
        return $this->fechaCompra;
    }

    function getFechaInstalacion() {
		$this->fechaInstalacion = explode(" ", $this->fechaInstalacion)[0];
        return $this->fechaInstalacion;
    }

    function getInicioGarantia() {
		$this->inicioGarantia = explode(" ", $this->inicioGarantia)[0];
        return $this->inicioGarantia;
    }

    function getFinalizacionGarantia() {
		$this->finalizacionGarantia = explode(" ", $this->finalizacionGarantia)[0];
        return $this->finalizacionGarantia;
    }

    function getFechaPuestaServicio() {
		$this->fechaPuestaServicio = explode(" ", $this->fechaPuestaServicio)[0];
        return $this->fechaPuestaServicio;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setIdeEquipo($ideEquipo) {
        $this->ideEquipo = $ideEquipo;
    }

    function setIdeFabricante($ideFabricante) {
        $this->ideFabricante = $ideFabricante;
    }

    function setIdeProveedor($ideProveedor) {
        $this->ideProveedor = $ideProveedor;
    }

    function setFormaAquisicion($formaAquisicion) {
        $this->formaAquisicion = $formaAquisicion;
    }

    function setCostoAquisicion($costoAquisicion) {
        $this->costoAquisicion = $costoAquisicion;
    }

    function setFechaCompra($fechaCompra) {
		if ($fechaCompra!='')$this->fechaCompra ="'{$fechaCompra}'";
		else $this->fechaCompra = " null ";        
    }


    function setFechaInstalacion($fechaInstalacion) {
		if ($fechaInstalacion!='')$this->fechaInstalacion="'{$fechaInstalacion}'";
        else $this->fechaInstalacion = "null";
    }

    function setInicioGarantia($inicioGarantia) {
		if($inicioGarantia!='') $this->inicioGarantia = "'{$inicioGarantia}'";
        else $this->inicioGarantia = "null";
    }

    function setFinalizacionGarantia($finalizacionGarantia) {
		if($finalizacionGarantia!='')$this->finalizacionGarantia = "'{$finalizacionGarantia}'";
        else $this->finalizacionGarantia = "null";
    }

    function setFechaPuestaServicio($fechaPuestaServicio) {
		if($fechaPuestaServicio!='')$this->fechaPuestaServicio = "'{$fechaPuestaServicio}'";
        else $this->fechaPuestaServicio = " null";
    }
//Llaves foraneas
	function getProveedor(){
		$ide=$this->ideProveedor;
		if($this->ideProveedor=='')$ide='16';
		return new DatosFabricante('ide', $ide);
	}

	function getFabricante(){
		$ide=$this->ideFabricante;
		if($this->ideFabricante=='')$ide='15';
		return new DatosFabricante('ide', $ide);
	}

// Inicio funciones de gestion

    function adicionar() {
        $columnas="insert into adquisicionInstalacion(ideEquipo,ideFabricante,ideProveedor,formaAdquisicion,costoAdquisicion,fechaCompra,fechaInstalacion,inicioGarantia, finalizacionGarantia,fechaPuestaServicio)";
        $valores="values({$this->ideEquipo},{$this->ideFabricante},{$this->ideProveedor},'{$this->formaAquisicion}','{$this->costoAquisicion}',{$this->fechaCompra},{$this->fechaInstalacion},{$this->inicioGarantia},{$this->finalizacionGarantia},{$this->fechaPuestaServicio})";
        $cadenaSQL=$columnas.$valores;
echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL, null);    
    }
    function modificar() {
        $cadenaSQL="update adquisicionInstalacion set ideEquipo={$this->ideEquipo},ideFabricante={$this->ideFabricante},ideProveedor={$this->ideProveedor},formaAdquisicion='{$this->formaAquisicion}', costoAdquisicion='{$this->costoAquisicion}', fechaCompra={$this->fechaCompra}, fechaInstalacion={$this->fechaInstalacion}, inicioGarantia={$this->inicioGarantia}, finalizacionGarantia={$this->finalizacionGarantia}, fechaPuestaServicio={$this->fechaPuestaServicio} where ideEquipo={$this->ideEquipo}";
        echo $cadenaSQL;
		ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
// Fin funciones de gestion
    
    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from adquisicionInstalacion";
        if ($filtro!=null) $cadenaSQL.=" where $filtro";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= AdquisicionInstalacion::getDatos($filtro, $orden);
        $lista=array();
        for ($j = 0; $j < count($datos); $j++) {
            $adquisicion=new AdquisicionInstalacion($datos[$j], null);
            $lista[$j]=$adquisicion;
        }
        return $lista;
    }

	function getContenido($valor){
		switch($valor){
			case '':
				$cadena='NO REGISTRA';
				break;
			default:
				$cadena=$valor;
				break;
		}
		return $cadena;
	}
	
}
