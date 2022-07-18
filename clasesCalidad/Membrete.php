<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Membrete
 *
 * @author Adriana
 */
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';

class Membrete {
    private $codigo;
    private $nombre;
    private $archivo;
    private $tipo;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))
                $this->cargarAtributos($campo);
            else {
                $cadenaSQL="select codigo, nombre, archivo,tipo from membrete where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)
                    $this->cargarAtributos($resultado[0]);
            }
        }
    }
    private function cargarAtributos($datos) {
        $this->codigo=$datos['codigo'];
        $this->nombre=$datos['nombre'];
        $this->archivo=$datos['archivo'];
        $this->tipo=$datos['tipo'];
    }
    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getArchivo() {
        return $this->archivo;
    }
    function getMostrarFormato() {
        $formato= str_replace("//", "/", $this->archivo);
        return $formato;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
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
    function grabar() {
        $cadenaSQL="insert into membrete(nombre,archivo,tipo)values('{$this->nombre}','{$this->archivo}','{$this->tipo}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificar() {
        $cadenaSQL="update membrete set nombre='{$this->nombre}', archivo='{$this->archivo}', tipo='{$this->tipo}' where codigo={$this->codigo}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminar() {
        $cadenaSQL="delete from membrete where codigo={$this->codigo}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatos($filtro, $orden) {
        $cadenaSQL="select codigo, nombre, archivo, tipo from membrete";
        if ($filtro!=null) $cadenaSQL.=" where $filtro";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, NULL);
    }
    
    public static function getDatosEnObjetos($filtro, $orden) {
        $datos= Membrete::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $membrete=new Membrete($datos[$i], null);
            $lista[$i]=$membrete;
        }
        return $lista;
    }
}
