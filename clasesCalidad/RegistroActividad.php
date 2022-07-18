<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegistroActividad
 *
 * @author Adriana
 */
class RegistroActividad {
    private $ide;
    private $tabla;
    private $accion;
    private $registroNuevo;
    private $registroAnterior;
    private $ideProceso;
    private $ideOpcion;
    private $usuario;
    private $fechaRealizacion;
            
    function __construct($campo, $valor) {
        if ($campo!=null) {
            if (is_array($campo))
                $this->cargarAtributos($campo);
            else{
                $cadenaSQL="select ide, tabla, accion, regristroNuevo, registroAnterior, ideProceso, ideOpcion, usuario, fechaRealizacion where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)
                    $this->cargarAtributos($resultado[0]);
            }
        }
    }
   
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->tabla=$datos['tabla'];
        $this->accion=$datos['accion'];
        $this->registroNuevo=$datos['registronuevo'];
        $this->registroAnterior=$datos['registroanterior'];
        $this->ideProceso=$datos['ideproceso'];
        $this->ideOpcion=$datos['ideopcion'];
        $this->usuario=$datos['usuario'];
        $this->fechaRealizacion=$datos['fecharealizacion'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getTabla() {
        return $this->tabla;
    }

    function getAccion() {
        return $this->accion;
    }

    function getRegistroNuevo() {
        return $this->registroNuevo;
    }

    function getRegistroAnterior() {
        return $this->registroAnterior;
    }

    function getIdeProceso() {
        return $this->ideProceso;
    }

    function getIdeOpcion() {
        return $this->ideOpcion;
    }

    function getUsuario() {
        return $this->usuario;
    }
    
    function getFechaRealizacion() {
        return $this->fechaRealizacion;
    }

    function setFechaRealizacion($fechaRealizacion) {
        $this->fechaRealizacion = $fechaRealizacion;
    }

    
    function setIde($ide) {
        $this->ide = $ide;
    }

    function setTabla($tabla) {
        $this->tabla = $tabla;
    }

    function setAccion($accion) {
        $this->accion = $accion;
    }

    function setRegistroNuevo($registroNuevo) {
        $this->registroNuevo = $registroNuevo;
    }

    function setRegistroAnterior($registroAnterior) {
        $this->registroAnterior = $registroAnterior;
    }

    function setIdeProceso($ideProceso) {
        $this->ideProceso = $ideProceso;
    }

    function setIdeOpcion($ideOpcion) {
        $this->ideOpcion = $ideOpcion;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    function grabar() {
        $cadenaAtributos="insert into registroActividad(tabla,accion, usuario,fechaRealizacion";
        $cadenaValues="values('{$this->tabla}','{$this->accion}','{$this->usuario}','{$this->fechaRealizacion}'";
        if ($this->getRegistroNuevo()!=null) {
            $cadenaAtributos.=",registroNuevo";
            $cadenaValues.=",'{$this->registroNuevo}'";
        }
        if ($this->getRegistroAnterior()!=null) {
            $cadenaAtributos.=",registroAnterior";
            $cadenaValues.=",'{$this->registroAnterior}'";
        }
        if ($this->getIdeProceso()!=null) {
            $cadenaAtributos.=",ideProceso";
            $cadenaValues.=",{$this->ideProceso}";
        }
        if ($this->getIdeOpcion()!=null) {
            $cadenaAtributos.=",ideOpcion";
            $cadenaValues.=",{$this->ideOpcion}";
        }
        $cadenaAtributos.=")";
        $cadenaValues.=")";
        $cadenaSQL=$cadenaAtributos.$cadenaValues;
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
}
