<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Calibracion
 *
 * @author Diana
 */
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';

class Calibracion {
    private $ide;
    private $ideCronograma;
    private $fecha;
    private $anioActual;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))$this->cargarAtributos($campo);
            else{
                $cadenaSQL="select * from calibracion where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)
                    $this->cargarAtributos($resultado[0]);
            }
        }
    }
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->ideCronograma=$datos['idecronograma'];
        $this->fecha=$datos['fecha'];
        $this->anioActual=$datos['anioactual'];
    }
    function getIde() {
        return $this->ide;
    }

    function getIdeCronograma() {
        return $this->ideCronograma;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getAnioActual() {
        return $this->anioActual;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setIdeCronograma($ideCronograma) {
        $this->ideCronograma = $ideCronograma;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setAnioActual($anioActual) {
        $this->anioActual = $anioActual;
    }
    
    function adicionar() {
        $cadenaSQL="insert into calibracion(ide,ideCronograma,fecha,anioActual)values('{$this->ide}',{$this->ideCronograma},'{$this->fecha}','{$this->anioActual}');";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from calibracion";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjeto($filtro,$orden) {
        $datos= Calibracion::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $calibracion=new Calibracion($datos[$i], null);
            $lista[$i]=$calibracion;
        }
        return $lista;
    }
}
