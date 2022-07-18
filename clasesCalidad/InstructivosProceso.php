<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlaneacionesProceso
 *
 * @author Adriana
 */
class InstructivosProceso {
    private $codigo;
    private $nombre;
    private $tipo;
    private $ruta;
    private $ideOpcionesProceso;
    
    function __construct($campo, $valor) {
        if ($campo!=null) {
            if (is_array($campo))
                $this->cargarAtributos($campo);
            else{
                $cadenaSQL="select codigo, nombre, tipo, ruta, ideOpcionesProceso from instructivosProceso where $campo=$valor";
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
        $this->ideOpcionesProceso=$datos['ideopcionesproceso'];
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
    

    function getIdeOpcionesProceso() {
        return $this->ideOpcionesProceso;
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

    function setIdeOpcionesProceso($ideOpcionesProceso) {
        $this->ideOpcionesProceso = $ideOpcionesProceso;
    }

    function grabar() {
        $cadenaSQL="insert into instructivosProceso(nombre,ruta,tipo,ideOpcionesProceso)values('{$this->nombre}','{$this->ruta}','{$this->tipo}',{$this->ideOpcionesProceso})";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificar() {
        $cadenaSQL="update instructivosProceso set nombre='{$this->nombre}', ruta='{$this->ruta}',tipo='{$this->tipo}',ideOpcionesProceso={$this->ideOpcionesProceso} where codigo={$this->codigo}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminar() {
        $cadenaSQL="delete from instructivosProceso where codigo={$this->codigo}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    public static function getDatos($filtro, $orden) {
        $cadenaSQL="select codigo, nombre, tipo, ruta, ideOpcionesProceso from instructivosProceso";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro, $orden) {
        $datos= InstructivosProceso::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $instructivosProceso=new InstructivosProceso($datos[$i], null);
            $lista[$i]=$instructivosProceso;
        }
        return $lista;
    }

}
