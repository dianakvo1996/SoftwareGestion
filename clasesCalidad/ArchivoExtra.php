<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArchivoExtra
 *
 * @author Adriana
 */
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';

class ArchivoExtra {
    private $ide;
    private $nombre;
    private $archivo;
    private $tipo;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))
                $this->cargarAtributos($campo);
            else{
                $cadenaSQL="Select ide, nombre, archivo, tipo from archivoextra where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0) 
                    $this->cargarAtributos($resultado[0]);
            }
        }
    }
    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->nombre=$datos['nombre'];
        $this->archivo=$datos['archivo'];
        $this->tipo=$datos['tipo'];
    }
    function getIde() {
        return $this->ide;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getArchivo() {
        return $this->archivo;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setArchivo($archivo) {
        $this->archivo = $archivo;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    function modificar() {
        $cadenaSQL="update archivoExtra set nombre='{$this->nombre}', archivo='{$this->archivo}' where tipo='{$this->tipo}'";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
}