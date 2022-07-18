<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RutinaEquipo
 *
 * @author Adriana
 */
class RutinaExtra {
    private $ide;
    private $descripcion;
    private $ideTipoEquipo;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))
                $this->cargarAtributos ($campo);
            else {
                $cadenaSQL="select * from rutinaExtra where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)
                    $this->cargarAtributos ($resultado[0]);
            }
        }
    }
  
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->descripcion=$datos['descripcion'];
        $this->ideTipoEquipo=$datos['idetipoequipo'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getDescripcion() {
        return $this->descripcion;
    }
    
    function getRutinaMostrar() {
        $rutina1= explode('-', $this->descripcion);
        $item=1;
        $rutinas='<p>';
        for ($i = 1; $i< count($rutina1); $i++) {
            $rutinas.='<strong>'.$item.'.</strong> '.$rutina1[$i].'</br>';
            $item++;
        }
        return $rutinas.'</p>';
    }
    
    
    function getIdeTipoEquipo() {
        return $this->ideTipoEquipo;
    }
    function getTipoEquipo() {
        return new TipoEquipo('ide', $this->ideTipoEquipo);
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setIdeTipoEquipo($ideTipoEquipo) {
        $this->ideTipoEquipo = $ideTipoEquipo;
    }

    function adicionar() {
        $cadenaSQL="insert into rutinaExtra(descripcion,ideTipoEquipo)values('{$this->descripcion}',{$this->ideTipoEquipo})";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificar() {
        $cadenaSQL="update rutinaExtra set descripcion='{$this->descripcion}' where ide=$this->ide";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminar() {
        $cadenaSQL="delete from rutinaExtra where ide=$this->ide";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select ide, descripcion,idetipoequipo from rutinaExtra ";
        if ($filtro!=null) $cadenaSQL.=" where $filtro";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= RutinaExtra::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $rutina=new RutinaExtra($datos[$i], null);
            $lista[$i]=$rutina;
        }
        return $lista;
    }
    
    public static function rutinaExtraEnRadio($predeterminado,$ideTipoEquipo) {
        $rutinas= RutinaExtra::getDatosEnObjetos('ideTipoEquipo='.$ideTipoEquipo, 'ide');
        $lista='';
        for ($i = 0; $i < count($rutinas); $i++) {
            $rutina=$rutinas[$i];
            $lista.="<input type='radio' value='{$rutina->getIde()}' name='ideRutinaExtra' id='{$rutina->getIde()}'><label for='{$rutina->getIde()}'>{$rutina->getRutinaMostrar()}</label>";
        }
        return $lista;
    }    
}