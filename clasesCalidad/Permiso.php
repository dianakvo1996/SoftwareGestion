<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Permiso
 *
 * @author Adriana
 */
require_once dirname(__FILE__) . '/../clasesCalidad/Proceso.php';
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';
class Permiso {
    private $ide;
    private $usuario;
    private $ideProceso;
    private $permiso;
    
    function __construct($campo, $valor) {
        if ($campo!=null) {
            if (is_array($campo))
                $this->cargarAtributos($campo);
            else {
                $cadenaSQL="select ide, usuario, ideProceso, permiso from permiso where $campo=$valor";
                echo $cadenaSQL;
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)
                    $this->cargarAtributos($resultado[0]);
            }
        }
    }
    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->usuario=$datos['usuario'];
        $this->ideProceso=$datos['ideproceso'];
        $this->permiso=$datos['permiso'];
    }
    function getIde() {
        return $this->ide;
    }

    function getUsuario() {
        return $this->usuario;
    }
    public function getUsuarioClase() {
        return new Usuario("usuario","'".$this->ideProceso."'");
    }
    
    public function getProcesoLista($predeterminado) {
        switch ($predeterminado) {
            case 'SL':
                return'<option value="">Seleccione Proceso</option>'
                . '<option value="SL" selected >Solo Lectura</option>'
                    . '<option value="D">Descarga</option>';
                break;
            case 'D':
                return'<option value="">Seleccione Proceso</option>'
                . '<option value="SL">Solo Lectura</option>'
                    . '<option value="D" selected>Descarga</option>';
                break;

            default:
                return'<option value="">Seleccione Proceso</option>'
                . '<option value="SL">Solo Lectura</option>'
                    . '<option value="D">Descarga</option>';
                break;
        }
    }
    
    function getIdeProceso() {
        return $this->ideProceso;
    }
    
    public function getProceso() {
        return new Proceso("ide", $this->ideProceso);
    }

    function getPermiso() {
        return $this->permiso;
    }
    
    public static function getPermisoRadio($predeterminado) {
        switch ($predeterminado) {
            case 'SL': return"<input type='radio' value='SL' checked>Solo Lectura<input type='radio' value='D'>Descarga";
                break;
            case 'D': return"<input type='radio' value='SL'>Solo Lectura<input type='radio' value='D' checked>Descarga";
                break;
            default: return"<input type='radio' value='SL'>Solo Lectura<input type='radio' value='D'>Descarga";
                break;
        }
    }
    
    function setIde($ide) {
        $this->ide = $ide;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setIdeProceso($ideProceso) {
        $this->ideProceso = $ideProceso;
    }

    function setPermiso($permiso) {
        $this->permiso = $permiso;
    }
    function grabarPermisosIniciales($usuario) {
        $cadenaSQL='';
        for($i = 1; $i < 16 ; $i++){
            $cadenaSQL.="insert into permiso(usuario,ideproceso,permiso)values('{$usuario}',{$i},'SL');";           
        } 
        ConectorBD::ejecutarQueryMultiple($cadenaSQL, null);     
    }
    
    function grabar() {
        $cadenaSQL="insert into permiso(usuario, ideProceso,permiso)values('{$this->usuario}',{$this->ideProceso},'{$this->permiso}')";
        ConectorBD::ejecutarQuery($cadena, null);
    }
    
    function modificar() {
        $cadenaSQL="update permiso set permiso='{$this->permiso}' where ide ={$this->ide}";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    function eliminar() {
        $cadenaSQL="delete from permiso where usuario='{$this->usuario}'";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatos($filtro, $orden) {
        $cadenaSQL="select ide, usuario, ideProceso, permiso from permiso";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjeto($filtro, $orden) {
        $datos= Permiso::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $permiso=new Permiso($datos[$i], null);
            $lista[$i]=$permiso;
        }
        return $lista;
    }
}
