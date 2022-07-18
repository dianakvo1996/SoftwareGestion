<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EquipoDeBaja
 *
 * @author Adriana
 */
class EquipoDeBaja {
    private $ide;
    private $nombreEquipo;
    private $marca;
    private $modelo;
    private $serial;
    private $activoFijo;
    private $ubicacion;
    private $ideSede;
    private $nitCliente;
    private $fechaSistema;
    private $fechaRealizacion;
    private $justificacion;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo)) 
                $this->cargarAtributos($campo);
            else{
                $cadenaSQL="select ide,nombreequipo,marca,modelo,serial,activofijo,ubicacion,idesede,nitcliente,fechasistema,fecharealizacion,justificacion from equipoDeBaja where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0) 
                    $this->cargarAtributos ($resultado[0]);
            }
        }
    }
    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->nombreEquipo=$datos['nombreequipo'];
        $this->marca=$datos['marca'];
        $this->modelo=$datos['modelo'];
        $this->serial=$datos['serial'];
        $this->activoFijo=$datos['activofijo'];
        $this->ubicacion=$datos['ubicacion'];
        $this->ideSede=$datos['idesede'];
        $this->nitCliente=$datos['nitcliente'];
        $this->fechaSistema=$datos['fechasistema'];
        $this->fechaRealizacion=$datos['fecharealizacion'];
        $this->justificacion=$datos['justificacion'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getNombreEquipo() {
        return $this->nombreEquipo;
    }

    function getMarca() {
        return $this->marca;
    }

    function getModelo() {
        return $this->modelo;
    }

    function getSerial() {
        return $this->serial;
    }

    function getActivoFijo() {
        return $this->activoFijo;
    }

    function getUbicacion() {
        return $this->ubicacion;
    }

    function getIdeSede() {
        return $this->ideSede;
    }

    function getNitCliente() {
        return $this->nitCliente;
    }

    function getFechaSistema() {
        return $this->fechaSistema;
    }
    function getMostrarFechaSistema() {
        $fechaSistema= explode(' ', $this->fechaSistema);
        return $fechaSistema;
    }

    function getFechaRealizacion() {
        return $this->fechaRealizacion;
    }
    
    function getMostrarFechaRealizacion() {
        $fechaRealizacion= explode(' ', $this->fechaRealizacion);
        return $fechaRealizacion[0];
    }
    
    function getJustificacion() {
        return $this->justificacion;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setNombreEquipo($nombreEquipo) {
        $this->nombreEquipo = $nombreEquipo;
    }

    function setMarca($marca) {
        $this->marca = $marca;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    function setSerial($serial) {
        $this->serial = $serial;
    }

    function setActivoFijo($activoFijo) {
        $this->activoFijo = $activoFijo;
    }

    function setUbicacion($ubicacion) {
        $this->ubicacion = $ubicacion;
    }

    function setIdeSede($ideSede) {
        $this->ideSede = $ideSede;
    }

    function setNitCliente($nitCliente) {
        $this->nitCliente = $nitCliente;
    }

    function setFechaSistema($fechaSistema) {
        $this->fechaSistema = $fechaSistema;
    }

    function setFechaRealizacion($fechaRealizacion) {
        $this->fechaRealizacion = $fechaRealizacion;
    }

    function setJustificacion($justificacion) {
        $this->justificacion = $justificacion;
    }
    function grabarSede() {
        $cadenaSQL="insert into equipoDeBaja(nombreEquipo, marca, modelo, serial, activoFijo, ubicacion, fechaSistema, fechaRealizacion, justificacion, ideSede)values"
                . "('{$this->nombreEquipo}','{$this->marca}','{$this->modelo}','{$this->serial}','{$this->activoFijo}','{$this->ubicacion}','{$this->fechaSistema}','{$this->fechaRealizacion}','{$this->justificacion}',{$this->ideSede})";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function grabarCliente() {
        $cadenaSQL="insert into equipoDeBaja(nombreEquipo, marca, modelo, serial, activoFijo, ubicacion, fechaSistema, fechaRealizacion, justificacion, nitCliente)values"
                . "('{$this->nombreEquipo}','{$this->marca}','{$this->modelo}','{$this->serial}','{$this->activoFijo}','{$this->ubicacion}','{$this->fechaSistema}','{$this->fechaRealizacion}','{$this->justificacion}','{$this->nitCliente}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    function eliminar() {
        $cadenaSQL="delete from equipodebaja where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select ide,nombreequipo,marca,modelo,serial,activofijo,ubicacion,idesede,nitcliente,fechasistema,fecharealizacion,justificacion from equipoDeBaja ";
        if ($filtro!=null) $cadenaSQL.=" where $filtro";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= EquipoDeBaja::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $equipoBaja=new EquipoDeBaja($datos[$i],null);
            $lista[$i]=$equipoBaja;
        }
        return $lista;
    }
}
