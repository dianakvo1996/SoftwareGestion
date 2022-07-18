<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EquipoCorrectivo
 *
 * @author BIOMETRICAL
 */
class EquipoCorrectivo {
    private $item;
    private $ide;
    private $marca;
    private $modelo;
    private $serial;
    private $activoFijo;
    private $ubicacion;
    private $ideSede;
    private $nitCliente;
    private $nombreEquipo;
    private $registroInvima;
    private $referencia;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))$this->cargarAtributos($campo);
            else{
                $cadenaSQL="select * from equipocorrectivo where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)$this->cargarAtributos($resultado[0]);
            }
        }
    }

    
    private function cargarAtributos($datos) {
        $this->item=$datos['item'];
        $this->ide=$datos['ide'];
        $this->marca=$datos['marca'];
        $this->modelo=$datos['modelo'];
        $this->serial=$datos['serial'];
        $this->activoFijo=$datos['activofijo'];
        $this->ubicacion=$datos['ubicacion'];
        $this->ideSede=$datos['idesede'];
        $this->nitCliente=$datos['nitcliente'];
        $this->nombreEquipo=$datos['nombreequipo'];
        $this->registroInvima=$datos['registroinvima'];
        $this->referencia=$datos['referencia'];
    }
    
    function getItem() {
        return $this->item;
    }

    function getIde() {
        return $this->ide;
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

    function getNombreEquipo() {
        return $this->nombreEquipo;
    }

    function getRegistroInvima() {
        return $this->registroInvima;
    }

    function getReferencia() {
        return $this->referencia;
    }

    function setItem($item) {
        $this->item = $item;
    }

    function setIde($ide) {
        $this->ide = $ide;
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

    function setNombreEquipo($nombreEquipo) {
        $this->nombreEquipo = $nombreEquipo;
    }

    function setRegistroInvima($registroInvima) {
        $this->registroInvima = $registroInvima;
    }

    function setReferencia($referencia) {
        $this->referencia = $referencia;
    }
    
    function adicionarSede() {
        $cadenaSQL="insert into equipoCorrectivo(ide, marca, modelo, serial,activofijo,ubicacion, registroInvima, referencia, nombreEquipo, ideSede)values"
                . "({$this->ide},'{$this->marca}','{$this->modelo}','{$this->serial}','{$this->activoFijo}','{$this->ubicacion}','{$this->registroInvima}','{$this->referencia}','{$this->nombreEquipo}',{$this->ideSede})";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function adicionarCliente() {
        $cadenaSQL="insert into equipoCorrectivo(ide, marca, modelo, serial,activofijo,ubicacion, registroInvima, referencia, nombreEquipo, nitCliente)values"
                . "({$this->ide},'{$this->marca}','{$this->modelo}','{$this->serial}','{$this->activoFijo}','{$this->ubicacion}','{$this->registroInvima}','{$this->referencia}','{$this->nombreEquipo}','{$this->nitCliente}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from equipoCorrectivo";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= EquipoCorrectivo::getDatosEnObjetos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $equipos=new EquipoCorrectivo($datos[$i], null);
            $lista[$i]=$equipos;
        }
        return $lista;
    }
}
