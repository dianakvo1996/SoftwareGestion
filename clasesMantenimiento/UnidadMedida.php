<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UnidadMedida
 *
 * @author Adriana
 */
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';

class UnidadMedida {
    private $ide;
    private $unidad;
    private $simbolo;
    
    function __construct($campo, $valor) {
        if ($campo!=null){
            if (is_array($campo))
                $this->cargarAtributos ($campo);
            else {
                $cadenaSQL="select * from unidadMedida where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)
                    $this->cargarAtributos($resultado[0]);
            }
        }
    }    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->unidad=$datos['unidad'];
        $this->simbolo=$datos['simbolo'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getUnidad() {
        return $this->unidad;
    }

    function getSimbolo() {
        return $this->simbolo;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setUnidad($unidad) {
        $this->unidad = $unidad;
    }

    function setSimbolo($simbolo) {
        $this->simbolo = $simbolo;
    }
    function adicionar() {
      $cadenaSQL="insert into unidadMedida(unidad,simbolo)values('{$this->unidad}','{$this->simbolo}')";
      ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from unidadMedida";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos = UnidadMedida::getDatos($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($datos); $i++) {
            $unidad=new UnidadMedida($datos[$i], null);
            $lista[$i]=$unidad;
        }
        return $lista;
    }
    
    public static function getUnidadesOptions($predeterminado) {
        $unidades = UnidadMedida::getDatosEnObjetos(null, 'unidad');
        $lista='';
        for ($i = 0; $i < count($unidades); $i++) {
            $unidad=$unidades[$i];
            if ($predeterminado === $unidad->getIde()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$unidad->getIde()}' {$auxiliar}>{$unidad->getUnidad()}</option>";
        }
        return $lista;
    }
}
