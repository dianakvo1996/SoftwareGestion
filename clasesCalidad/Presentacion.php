<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Presentacion
 *
 * @author Adriana
 */
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';

class Presentacion {
    private $codigo;
    private $nombre;
    private $presentacion;
    
    function __construct($campo, $valor) {
        if ($campo!=null) {
            if (is_array($campo))
                $this->cargarAtributos($campo);
            else {
                $cadenaSQL="select codigo, nombre, presentacion from presentacion where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)
                    $this->cargarAtributos($resultado[0]);
            }
        }
    }
 
    private function cargarAtributos($datos) {
        $this->codigo=$datos['codigo'];
        $this->nombre=$datos['nombre'];
        $this->presentacion=$datos['presentacion'];
    }
    
    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getPresentacion() {
        return $this->presentacion;
    }
    function getMostrarFormato() {
        $formato= str_replace("//", "/", $this->presentacion);
        return $formato;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setPresentacion($presentacion) {
        $this->presentacion = $presentacion;
    }

    function grabar() {
        $cadenaSQL="insert into presentacion(nombre, presentacion)values('{$this->nombre}','{$this->presentacion}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificar() {
        $cadenaSQL="update presentacion set nombre='{$this->nombre}', presentacion='{$this->presentacion}' where codigo={$this->codigo}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminar() {
        $cadenaSQL="delete from presentacion where codigo={$this->codigo}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatos($filtro, $orden) {
        $cadenaSQL="select codigo, nombre, presentacion from presentacion";
        if ($filtro!=null) $cadenaSQL.=" where $filtro";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, NULL);
    }
    
    public static function getDatosEnObjetos($filtro, $orden) {
        $datos= Presentacion::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $presentacion=new Presentacion($datos[$i], null);
            $lista[$i]=$presentacion;
        }
        return $lista;
    }

}
