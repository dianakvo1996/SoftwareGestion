<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClienteC
 *
 * @author Diana
 */
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';
class ClienteC {
    private $nit;
    private  $nombre;
    private  $direccion;
    private  $responsable;
    private  $telefono;
    private  $sede;
    private  $usuario;
    private  $codCiudad;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))
                $this->cargarAtributos ($campo);
            else{
                $cadenaSQL="select * from clienteC where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0)
                    $this->cargarAtributos ($resultado[0]);
            }
        }
    }
    
    private function cargarAtributos($datos) {
        $this->nit=$datos['nit'];
        $this->nombre=$datos['nombre'];
        $this->direccion=$datos['direccion'];
        $this->responsable=$datos['responsable'];
        $this->telefono=$datos['telefono'];
        $this->usuario=$datos['usuario'];
        $this->sede=$datos['sede'];
		$this->codCiudad=$datos['codciudad'];
    }
    
    function getNit() {
        return $this->nit;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getResponsable() {
        return $this->responsable;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getSede() {
        return $this->sede;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getCodCiudad() {
        return $this->codCiudad;
    }

    function setNit($nit) {
        $this->nit = $nit;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setResponsable($responsable) {
        $this->responsable = $responsable;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setSede($sede) {
        $this->sede = $sede;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setCodCiudad($codCiudad) {
        $this->codCiudad = $codCiudad;
    }
//inicio llaves foraneas
	function getCiudad() {
        return new Ciudad('codigo',"'".$this->codCiudad."'");
    }
//fin llaves foraneas

//Inicio Procedimientos de gestion
    function grabar() {
        $cadenaSQL="insert into clienteC(nit,nombre,direccion,responsable,telefono,sede,usuario,codCiudad) values('{$this->nit}','{$this->nombre}','{$this->direccion}','{$this->responsable}','{$this->telefono}','{$this->sede}','{$this->usuario}','{$this->codCiudad}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificar($nitAnterior) {
        $cadenaSQL="update clienteC set nit='{$this->nit}',nombre='{$this->nombre}', direccion='{$this->direccion}',responsable='{$this->responsable}',telefono='{$this->telefono}',sede='{$this->sede}', usuario='{$this->usuario}', codCiudad='{$this->codCiudad}' where nit='{$nitAnterior}'";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminar() {
        $cadenaSQL="delete from clienteC where nit='{$this->nit}'";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
//Fin Procedimientos de gestion
//Inicio funciones
    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from clienteC";
        if ($filtro!=null) $cadenaSQL.=" where $filtro";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= ClienteC::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $cliente=new ClienteC($datos[$i], null);
            $lista[$i]=$cliente;
        }
        return $lista;
    }
 //Fin funciones
}
