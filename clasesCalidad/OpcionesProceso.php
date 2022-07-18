<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OpcionesProceso
 *
 * @author Adriana
 */
class OpcionesProceso {
    private $ide;
    private $nombre;
    private $ideProceso;
    
    function __construct($campo,$valor){
        if ($campo!=null) {
            if (is_array($campo)) 
                $this->cargarAtributos($campo);
            else {
                $cadenaSQL="select ide, nombre,ideProceso from opcionesProceso where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)
                    $this->cargarAtributos($resultado[0]);
            }
        }
    }  
    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->nombre=$datos['nombre'];
        $this->ideProceso=$datos['ideproceso'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getIdeProceso() {
        return $this->ideProceso;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setIdeProceso($ideProceso) {
        $this->ideProceso = $ideProceso;
    }
    function getProcesoEnObjeto() {
        return new Proceso('ide', $this->getIdeProceso());
    }
    
    function grabar() {
        $cadenaSQL="insert into opcionesProceso(nombre,ideProceso)values('{$this->nombre}',{$this->ideProceso})";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificar() {
        $cadenaSQL="update opcionesProceso set nombre='{$this->nombre}',ideproceso={$this->ideProceso} where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminar() {
        $cadenaSQL="delete from opcionesProceso where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatos($filtro, $orden) {
        $cadenaSQL="select ide, nombre,ideProceso from opcionesProceso";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($filtro!=null)$cadenaSQL.=" order by $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= OpcionesProceso::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $opcionesProceso=new OpcionesProceso($datos[$i], null);
            $lista[$i]=$opcionesProceso;
        }
    return $lista;
    }
}
