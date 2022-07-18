<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EquipoHV
 *
 * @author BIOMETRICAL
 */
require_once dirname(__FILE__) . '/../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/Sede.php';

class EquipoHV {
    private $ide;
    private $activoFijo;
    private $nombreEquipo;
    private $marca;
    private $modelo;
    private $serial;
    private $ubicacion;
    private $registroInvima;
    private $referencia;
    private $ideSede;
    private $nitCliente;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))$this->cargarAtributos ($campo);
            else{
                $cadenaSQL="select * from equipohv where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)$this->cargarAtributos ($resultado[0]);
            }
        }
    }

    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->activoFijo=$datos['activofijo'];
        $this->nombreEquipo=$datos['nombreequipo'];
        $this->marca=$datos['marca'];
        $this->modelo=$datos['modelo'];
        $this->serial=$datos['serial'];
        $this->ubicacion=$datos['ubicacion'];
        $this->registroInvima=$datos['registroinvima'];
        $this->referencia=$datos['referencia'];
        $this->ideSede=$datos['idesede'];
        $this->nitCliente=$datos['nitcliente'];
    }
    function getIde() {
        return $this->ide;
    }

    function getActivoFijo() {
        return $this->activoFijo;
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

    function getUbicacion() {
        return $this->ubicacion;
    }

    function getRegistroInvima() {
        return $this->registroInvima;
    }

    function getReferencia() {
        return $this->referencia;
    }

    function getIdeSede() {
        return $this->ideSede;
    }

    function getNitCliente() {
        return $this->nitCliente;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setActivoFijo($activoFijo) {
        $this->activoFijo = $activoFijo;
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

    function setUbicacion($ubicacion) {
        $this->ubicacion = $ubicacion;
    }

    function setRegistroInvima($registroInvima) {
        $this->registroInvima = $registroInvima;
    }

    function setReferencia($referencia) {
        $this->referencia = $referencia;
    }

    function setIdeSede($ideSede) {
        $this->ideSede = $ideSede;
    }

    function setNitCliente($nitCliente) {
        $this->nitCliente = $nitCliente;
    }

    function adicionarIdeSede() {
        $cadenaSQL="insert into equipohv(activoFijo,nombreEquipo, marca, modelo, serial, ubicacion, registroInvima, referencia, ideSede)values"
                . "('{$this->activoFijo}','{$this->nombreEquipo}','{$this->marca}','{$this->modelo}','{$this->serial}','{$this->ubicacion}','{$this->registroInvima}','{$this->referencia}',{$this->ideSede})";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    function adicionarNitCliente() {
        $cadenaSQL="insert into equipohv(activoFijo,nombreEquipo, marca, modelo, serial, ubicacion, registroInvima, referencia, nitCliente)values"
                . "('{$this->activoFijo}','{$this->nombreEquipo}','{$this->marca}','{$this->modelo}','{$this->serial}','{$this->ubicacion}','{$this->registroInvima}','{$this->referencia}','{$this->nitCliente}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
	
	function modificar(){
		$cadenaSQL="update equipohv set activoFijo='{$this->activoFijo}', nombreEquipo='{$this->nombreEquipo}', marca='{$this->marca}',modelo='{$this->modelo}', serial='{$this->serial}',ubicacion='{$this->ubicacion}',registroInvima='{$this->registroInvima}', referencia='{$this->referencia}' where ide={$this->getIde()}";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
	}
    
	function eliminar(){
		$cadenaSQL="delete from equipohv where ide={$this->ide}";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
	}
    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from equipohv ";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= EquipoHV::getDatos($filtro, $orden);
        $lista=array();
        for ($h = 0; $h < count($datos); $h++) {
            $equipo=new EquipoHV($datos[$h], null);
            $lista[$h]=$equipo;
        }
        return $lista;
    }
//llaves foraneas
	function getCliente(){
		return new Cliente('nit',"'{$this->nitCliente}'");
	}
	
	function getSede(){
		return new Sede('ide',$this->ideSede);
	}

}
