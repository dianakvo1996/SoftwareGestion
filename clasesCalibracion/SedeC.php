<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SedeC
 *
 * @author Diana
 */
require_once dirname(__FILE__) . '/ClienteC.php';
class SedeC {
    private $ide;
    private $nombre;
    private $nitCliente;
    private $codCiudad;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))
                $this->cargarAtributos($campo);
            else{
                $cadenaSQL="select * from sedeC where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0)
                    $this->cargarAtributos($resultado[0]);
            }
        }
    }
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->nombre=$datos['nombre'];
        $this->nitCliente=$datos['nitcliente'];
        $this->codCiudad=$datos['codciudad'];
    }
    function getIde() {
        return $this->ide;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getNitCliente() {
        return $this->nitCliente;
    }

    function getCodCiudad() {
        return $this->codCiudad;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setNitCliente($nitCliente) {
        $this->nitCliente = $nitCliente;
    }

    function setCodCiudad($codCiudad) {
        $this->codCiudad = $codCiudad;
    }
// Inicio llaves foraneas
	function getCiudad(){
		return new Ciudad('codigo',"'{$this->codCiudad}'");
	}
    function getCliente() {
        return new ClienteC('nit',"'".$this->nitCliente."'");
    }
// Fin llaves foraneas
//Inicio Procedimientos
    function adicionar() {
        $cadenaSQL="insert into sedeC(nombre,nitCliente,codCiudad) values ('{$this->nombre}','{$this->nitCliente}','{$this->codCiudad}');";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    function modificar() {
        $cadenaSQL="update sedeC set nombre='{$this->nombre}', nitCliente='{$this->nitCliente}', codCiudad='{$this->codCiudad}' where ide=$this->ide";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    function eliminar() {
        $cadenaSQL="delete from sedeC where ide=$this->ide";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
//Fin Procedimientos
    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from sedeC";
        if ($filtro!=null) $cadenaSQL.=" where $filtro";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= SedeC::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $sede=new SedeC($datos[$i], null);
            $lista[$i]=$sede;
        }
        return $lista;
    }
}
