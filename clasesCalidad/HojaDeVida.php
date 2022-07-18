<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HojaDeVida
 *
 * @author DIANA V
 */
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../clasesGenericas/Ciudad.php';
class HojaDeVida {
    private $ide;
    private $nombre;
    private $cargo;
    private $area;
    private $codCiudad;
    private $ruta;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))$this->cargarAtributos($campo);
            else{
                $cadenaSQL="select * from hojaDeVida where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
				if(count($resultado)>0)$this->cargarAtributos($resultado[0]);
            }
        }
    }

    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->nombre=$datos['nombre'];
        $this->cargo=$datos['cargo'];
        $this->area=$datos['area'];
        $this->codCiudad=$datos['codciudad'];
        $this->ruta=$datos['ruta'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getCargo() {
        return $this->cargo;
    }

    function getArea() {
        return $this->area;
    }

    function getCodCiudad() {
        return $this->codCiudad;
    }

	function getRuta() {
        return $this->ruta;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    function setArea($area) {
        $this->area = $area;
    }

    function setCodCiudad($codCiudad) {
        $this->codCiudad = $codCiudad;
    }
    
    function setRuta($ruta) {
        $this->ruta = $ruta;
    }

//Inicio Llaves Foraneas
    function getCiudad() {
        return new Ciudad('codigo',"'{$this->codCiudad}'");
    }
//Fin Llaves Foraneas
    function getAreaLista() {
        $area='';
        switch ($this->area) {
            case 'K':
            $area='CALIBRACION';    
            break;
            case 'M':
            $area='MANTENIMIENTO';    
            break;
        }
		return $area;
    }
    function getAreaOptions() {
        $area='';
        switch ($this->area) {
            case 'K':
                $area.="<option value='K' selected>CALIBRACION</option>";
                $area.="<option value='M'>MANTENIMIENTO</option>";
            break;
            case 'M':
                $area.="<option value='K'>CALIBRACION</option>";
                $area.="<option value='M' selected>MANTENIMIENTO</option>";
            break;
            default:
                $area.="<option value='K'>CALIBRACION</option>";
                $area.="<option value='M'>MANTENIMIENTO</option>";
            
            break;
        }
        return $area;
    }

    function getCiudadesOptions() {
        $lista='';
        switch ($this->codCiudad) {
            case '52001'://pasto
                $lista.="<option value='76001'>Cali</option>";
                $lista.="<option value='52001' selected>Pasto</option>";
                $lista.="<option value='52838'>Tuquerres</option>";
                break;
            case '52838'://tuquerres
                $lista.="<option value='76001'>Cali</option>";
                $lista.="<option value='52001'>Pasto</option>";
                $lista.="<option value='52838' selected>Tuquerres</option>";
                break;
            case '76001'://cali
                $lista.="<option value='76001' selected>Cali</option>";
                $lista.="<option value='52001'>Pasto</option>";
                $lista.="<option value='52838'>Tuquerres</option>";
                break;
            default:
                $lista.="<option value='76001'>Cali</option>";
                $lista.="<option value='52001'>Pasto</option>";
                $lista.="<option value='52838'>Tuquerres</option>";
                break;
        }
        return $lista;
    }
    function getCiudadesLista() {
        $ciudad='';
        switch ($this->codCiudad) {
            case '52001'://pasto
                $ciudad='Pasto';
                break;
            case '52838'://tuquerres
                $ciudad='Tuquerres';
                break;
            case '76001'://cali
                $ciudad='Cali';
                break;
            default:
                $ciudad='/';
                break;
        }
        return $ciudad;
    }

    function adicionar() {
        $cadenaSQL="insert into hojaDeVida(nombre, cargo, area, codCiudad,ruta)values('{$this->nombre}','{$this->cargo}','{$this->area}','{$this->codCiudad}','{$this->ruta}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificar() {
        $cadenaSQL="update hojaDeVida set nombre='{$this->nombre}', cargo='{$this->cargo}', area='{$this->area}', codCiudad='{$this->codCiudad}',ruta='{$this->ruta}' where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminar() {
        $cadenaSQL="delete from hojaDeVida where ide=$this->ide";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    public static function getDatos($filtro,$orden) {
        $cadenaSQL = "select * from hojaDeVida";
        if($filtro!=null)$cadenaSQL.=" where $filtro";
        if($orden!=null)$cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= HojaDeVida::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $hojaVida=new HojaDeVida($datos[$i], null);
            $lista[$i]=$hojaVida;
        }
        return $lista;
    }
}
