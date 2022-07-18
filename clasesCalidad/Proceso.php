<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Proceso
 *
 * @author Adriana
 */
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';
class Proceso {
    private $ide;
    private $nombre;
    private $imagen;
   
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))
                $this->cargarAtributos($campo);
            else{
                $cadenaSQL="select ide,nombre,imagen from proceso where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if(count($resultado)>0)
                    $this->cargarAtributos($resultado[0]);
            }
        }
    }
    private function cargarAtributos($vector) {
        $this->ide=$vector['ide'];
        $this->nombre=$vector['nombre'];
        $this->imagen=$vector['imagen'];
    }
    function getIde() {
        return $this->ide;
    }

    function getNombre() {
        return $this->nombre;
    }
    
    function getImagen() {
        return $this->imagen;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

        function setIde($ide) {
        $this->ide = $ide;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select ide,nombre,imagen from proceso";
        if ($filtro!=null) $cadenaSQL.=" where $filtro";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatosEnObjeto($filtro,$orden) {
        $datos= Proceso::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $proceso=new Proceso($datos[$i], null);
            $lista[$i]=$proceso;
        }
        return $lista;
    }
}
