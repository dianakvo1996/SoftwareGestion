<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CodigoUsoEquipo
 *
 * @author BIOMETRICAL
 */
class CodigoUsoEquipo {
    private $ide;
    private $ideEquipo;
    private $servicio;
    private $unidad;
    private $ambiente;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))$this->cargarAtributos($campo);
            else{
                $cadenaSQL="select * from codigoUsoEquipo where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)$this->cargarAtributos($resultado[0]);
            }
        }
    }

    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->ideEquipo=$datos['ideequipo'];
        $this->servicio=$datos['servicio'];
        $this->unidad=$datos['unidad'];
        $this->ambiente=$datos['ambiente'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getIdeEquipo() {
        return $this->ideEquipo;
    }

    function getServicio() {
        return $this->servicio;
    }

    function getUnidad() {
        return $this->unidad;
    }

    function getAmbiente() {
        return $this->ambiente;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setIdeEquipo($ideEquipo) {
        $this->ideEquipo = $ideEquipo;
    }

    function setServicio($servicio) {
        $this->servicio = $servicio;
    }

    function setUnidad($unidad) {
        $this->unidad = $unidad;
    }

    function setAmbiente($ambiente) {
        $this->ambiente = $ambiente;
    }

    function adicionar() {
        $cadenaSQL="insert into codigoUsoEquipo(ideEquipo,servicio,unidad,ambiente)values({$this->ideEquipo},'{$this->servicio}','{$this->unidad}','{$this->ambiente}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    function modificar() {
        $cadenaSQL="update codigoUsoEquipo set ideEquipo={$this->ideEquipo}, servicio='{$this->servicio}', unidad='{$this->unidad}', ambiente='{$this->ambiente}' where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatos($filtro, $orden) {
        $cadenaSQL="select * from codigoUsoEquipo ";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos = CodigoUsoEquipo::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $codigo=new CodigoUsoEquipo($datos[$i], null);
            $lista[$i]=$codigo;
        }
        return $lista;
    }
}