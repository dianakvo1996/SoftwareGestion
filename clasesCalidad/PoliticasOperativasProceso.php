<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PoliticasProceso
 *
 * @author Adriana
 */
class PoliticasOperativasProceso{
    private $codigo;
    private $nombre;
    private $tipo;
    private $ruta;
    private $ideProceso;
    
    function __construct($campo, $valor) {
        if ($campo!=null) {
            if (is_array($campo))
                $this->cargarAtributos($campo);
            else {
                $cadenaSQL="select codigo, nombre, tipo, ruta, ideProceso from politicaOperativaProceso where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)
                    $this->cargarAtributos($resultado[0]);
            }
        }
    }
    private function cargarAtributos($datos) {
        $this->codigo=$datos['codigo'];
        $this->nombre=$datos['nombre'];
        $this->tipo=$datos['tipo'];
        $this->ruta=$datos['ruta'];
        $this->ideProceso=$datos['ideproceso'];
    }
    
    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getRuta() {
        return $this->ruta;
    }
    function mostrarFormato() {
        $formato= str_replace("//", "/", $this->ruta);
        return $formato;
    }
    function getIdeProceso() {
        return $this->ideProceso;
    }


    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setRuta($ruta) {
        $this->ruta = $ruta;
    }

    function setIdeProceso($ideProceso) {
        $this->ideProceso = $ideProceso;
    }


    function grabar() {
        $cadenaSQL="insert into politicaOperativaProceso(nombre,ruta,tipo,ideProceso)values('{$this->nombre}','{$this->ruta}','{$this->tipo}',{$this->ideProceso})";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificar() {
        $cadenaSQL="update politicaOperativaProceso set nombre='{$this->nombre}',ruta='{$this->ruta}',tipo='{$this->tipo}',ideProceso={$this->ideProceso} where codigo={$this->codigo}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminar() {
        $cadenaSQL="delete from politicaOperativaProceso where codigo={$this->codigo}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select codigo, nombre, tipo, ruta, ideProceso from politicaOperativaProceso";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= PoliticasOperativasProceso::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $politicasProceso=new PoliticasOperativasProceso($datos[$i], null);
            $lista[$i]=$politicasProceso;
        }
        return  $lista;
    }
    
}
