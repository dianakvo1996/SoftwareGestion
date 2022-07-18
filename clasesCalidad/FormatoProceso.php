<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Formato
 *
 * @author Adriana
 */
class FormatoProceso {
    private $codigo;
    private $nombre;
    private $ruta;
    private $tipo;
     private $ideOpcionesProceso;
    
    function __construct($campo, $valor) {
        if ($campo!=null) {
            if (is_array($campo))
                $this->cargarAtributos($campo);
            else{
                $cadenaSQL="select  codigo, nombre, ruta, tipo, ideOpcionesProceso from formatosProceso where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0) 
                     $this->cargarAtributos($resultado[0]);
            }
        }
    }
   
    private function cargarAtributos($datos) {
        $this->codigo=$datos['codigo'];
        $this->nombre=$datos['nombre'];
        $this->ruta=$datos['ruta'];
        $this->tipo=$datos['tipo'];
        $this->ideOpcionesProceso=$datos['ideopcionesproceso'];
    }
    
    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getRuta() {
        return $this->ruta;
    }
    function mostrarFormato() {
        $formato= str_replace("//", "/", $this->ruta);
        return $formato;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getIdeOpcionesProceso() {
        return $this->ideOpcionesProceso;
    }

    function setIdeOpcionesProceso($ideOpcionesProceso) {
        $this->ideOpcionesProceso = $ideOpcionesProceso;
    }

    
    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setRuta($ruta) {
        $this->ruta = $ruta;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    
    function grabar() {
        $cadenaSQL=" insert into formatosProceso(nombre,ruta,tipo,ideOpcionesProceso)values('{$this->nombre}','{$this->ruta}','{$this->tipo}',{$this->ideOpcionesProceso})";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificar() {
        $cadenaSQL="update formatosProceso set nombre='{$this->nombre}',ruta='{$this->ruta}', tipo='{$this->tipo}', ideOpcionesProceso={$this->ideOpcionesProceso} where codigo={$this->codigo}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminar() {
        $cadenaSQL=" delete from formatosProceso where codigo={$this->codigo}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    public static function getDatos($filtro, $orden) {
        $cadenaSQL="select  codigo, nombre, ruta, tipo, ideOpcionesProceso from formatosProceso";
        if ($filtro!=null) $cadenaSQL.=" where $filtro";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatosEnObjeto($filtro, $orden) {
        $datos= FormatoProceso::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $formatoProceso=new FormatoProceso($datos[$i], null);
            $lista[$i]=$formatoProceso;
        }
        return $lista;
    }
    
    
    
}
