<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Persona
 *
 * @author Adriana
 */
require_once dirname(__FILE__) . '/../clasesGenericas/Usuario.php';

class Persona {
    private $identificacion;
    private $nombres;
    private $apellidos;
    private $cargo;
    private $usuario;
    
    function __construct($campo,$valor) {
        if ($campo!=null){
            if (is_array($campo))
                $this->cargarAtributos($campo);
            else{
                $cadenaSQL="select identificacion,nombres,apellidos,usuario,cargo from persona where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)
                    $this->cargarAtributos($resultado[0]);
            }
        }
    }
    
    private function cargarAtributos($vector) {
        $this->identificacion=$vector['identificacion'];
        $this->nombres=$vector['nombres'];
        $this->apellidos=$vector['apellidos'];
        $this->cargo=$vector['cargo'];
        $this->usuario=$vector['usuario'];
    }
    function getIdentificacion() {
        return $this->identificacion;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getApellidos() {
        return $this->apellidos;
    }
    function getNombresCompletos() {
            return $this->nombres . " " . $this->apellidos;
    }
    function getCargo() {
        return $this->cargo;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function setIdentificacion($identificacion) {
        $this->identificacion = $identificacion;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function getUsuarioClase() {
        return new Usuario("Usuario","'".$this->usuario."'");
    }
    function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    

    function grabar() {
        $cadenaSQL="insert into persona(identificacion,nombres,apellidos,cargo,usuario)values('$this->identificacion','$this->nombres','$this->apellidos','$this->cargo','$this->usuario')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    function modificar($identificacionAnterior) {
        $cadenaSQL="update persona set identificacion='$this->identificacion', nombres='$this->nombres', apellidos='$this->apellidos', cargo='$this->cargo', usuario='$this->usuario' where identificacion='$identificacionAnterior'";
        
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL, null);        
    }
    
    function eliminar() {
       $cadenaSQL="delete from persona where identificacion='$this->identificacion'"; 
       ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select identificacion,nombres,apellidos,usuario,cargo from persona";
        if ($filtro!=null) $cadenaSQL.=" where $filtro ";
        if ($orden!=null) $cadenaSQL.=" order by $orden ";
        return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro, $orden) {
        $datos = Persona::getDatos($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($datos); $i++) {
            $persona= new Persona($datos[$i], null);
            $lista[$i] = $persona;
        }
        return $lista;
    }
    public static function validarIdentificacion($identificacion) {
        $cadenaSQL="Select identificacion from persona where identificacion=$identificacion";
        return ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
    }

    public static function getDatosIngenierosMantenimento(){
	$cadenaSQL=" SELECT identificacion, nombres, apellidos, cargo, persona.usuario FROM persona,usuario where usuario.usuario=persona.usuario and usuario.tipo='IM' or usuario.tipo='IC' order by identificacion,usuario.tipo";
	print $cadenaSQL;
	$datos=ConectorBD::ejecutarQuery($cadenaSQL, null);
	$lista = array();
        for ($i = 0; $i < count($datos); $i++) {
            $persona= new Persona($datos[$i], null);
            $lista[$i] = $persona;
        }
        return $lista;
	}
}

