<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SubMenuProceso
 *
 * @author Adriana
 */
class SubMenuProceso {
    private $ide;
    private $ideOpcion;
    private $menu;
    
    function __construct($campo, $valor) {
        if ($campo!=null) {
            if (is_array($campo)) 
                $this->cargarAtributos($campo);
            else {
                $cadenaSQL="select ide, ideOpcion,menu from subMenuProceso where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)
                    $this->cargarAtributos($resultado[0]);
            }
        }
    }
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->ideOpcion=$datos['ideopcion'];
        $this->menu=$datos['menu'];
    }
    function getIde() {
        return $this->ide;
    }

    function getIdeOpcion() {
        return $this->ideOpcion;
    }

    function getMenu() {
        return $this->menu;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setIdeOpcion($ideOpcion) {
        $this->ideOpcion = $ideOpcion;
    }

    function setMenu($menu) {
        $this->menu = $menu;
    }

    function grabar() {
      $cadenaSQL="insert into subMenuProceso(ideOpcion,menu)values({$this->ideOpcion},'{$this->menu}')";
      ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificar() {
      $cadenaSQL="update subMenuProceso set ideOpcion={$this->ideOpcion},menu='{$this->menu}' where ide=$this->ide";
      ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminar() {
      $cadenaSQL="delete from subMenuProceso where ideOpcion=$this->ideOpcion";
      ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select ide, ideOpcion,menu from subMenuProceso";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= SubMenuProceso::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $subMenuProceso=new SubMenuProceso($datos[$i], null);
            $lista[$i]=$subMenuProceso;
        }
    return $lista;
    }
}
