<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClasificacionElectrica
 *
 * @author BIOMETRICAL
 */
class ClasificacionElectrica {
    private $ide;
    private $ideEquipo;
    private $tipo;
    private $clase;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))$this->cargarAtributos($campo);
            else{
                $cadenaSQL="select * from clasificacionElectrica where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)$this->cargarAtributos($resultado[0]);
            }
        }
    }
    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->ideEquipo=$datos['ideequipo'];
        $this->tipo=$datos['tipo'];
        $this->clase=$datos['clase'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getIdeEquipo() {
        return $this->ideEquipo;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getClase() {
        return $this->clase;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setIdeEquipo($ideEquipo) {
        $this->ideEquipo = $ideEquipo;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setClase($clase) {
        $this->clase = $clase;
    }

    function adicionar() {
        $cadenaSQL="insert into clasificacionElectrica(ideEquipo,tipo,clase)values({$this->ideEquipo},'{$this->tipo}','{$this->clase}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificar() {
        $cadenaSQL="update clasificacionElectrica set tipo='{$this->tipo}', clase='{$this->clase}' where ideEquipo={$this->ideEquipo}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from clasificacionElectrica ";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro, $orden) {
        $datos= ClasificacionElectrica::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $clasificacion=new ClasificacionElectrica($datos[$i], null);
            $lista[$i]=$clasificacion;
        }
        return $lista;
    }
}
