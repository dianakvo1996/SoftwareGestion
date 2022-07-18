<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ComponentesEquipo
 *
 * @author DIANA V
 */
class ComponentesEquipo {
    private $ide;
    private $ideEquipo;
    private $partes;
    private $referencia;
    private $accesorios;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))$this->cargarAtributos($campo);
            else{
                $cadenaSQL="select * from componentesEquipo where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)$this->cargarAtributos ($resultado[0]);
            }
        }
    }
    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->ideEquipo=$datos['ideequipo'];
        $this->partes=$datos['partes'];
        $this->referencia=$datos['referencia'];
        $this->accesorios=$datos['accesorios'];        
    }
    
    function getIde() {
        return $this->ide;
    }

    function getIdeEquipo() {
        return $this->ideEquipo;
    }

    function getPartes() {
        return $this->partes;
    }

    function getReferencia() {
        return $this->referencia;
    }

    function getAccesorios() {
        return $this->accesorios;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setIdeEquipo($ideEquipo) {
        $this->ideEquipo = $ideEquipo;
    }

    function setPartes($partes) {
        $this->partes = $partes;
    }

    function setReferencia($referencia) {
        $this->referencia = $referencia;
    }

    function setAccesorios($accesorios) {
        $this->accesorios = $accesorios;
    }

    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from componentesEquipo";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public function getDatosEnObjetos($filtro,$orden) {
        $datos= ComponentesEquipo::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $componentes=new ComponentesEquipo($datos[$i], null);
            $lista[$i]=$componentes;
        }
        return $lista;
    }
    //Inicio Llaves foraneas
    function getEquipoObjeto() {
        return new Equipo('ide', $this->ideEquipo);
    }
    //Fin Llaves foraneas
    //Inicio funciones de gestion
    function adicionar() {
        $cadenaSQL="insert into componentesEquipo(ideEquipo,partes,referencia,accesorios)values({$this->ideEquipo},'{$this->partes}','{$this->referencia}','{$this->accesorios}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificar() {
        $cadenaSQL="update componentesEquipo set ideEquipo={$this->ideEquipo}, partes='{$this->partes}', referencia='{$this->referencia}', accesorios='{$this->accesorios}' where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminar() {
        $cadenaSQL="delete from componentesEquipo where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, $bd);
    }
    //Fin funciones de gestion
}
