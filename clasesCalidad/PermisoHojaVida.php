<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PermisoHojaVida
 *
 * @author BIOMETRICAL
 */
class PermisoHojaVida {
    private $ide;
    private $nitCliente;
    private $codCiudad;
    private $permiso;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))$this->cargarAtributos($campo);
            else{
                $cadenaSQL="select * from permisoHojaVida where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)$this->cargarAtributos ($resultado[0]);
            }
        }
    }
    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->nitCliente=$datos['nitcliente'];
        $this->codCiudad=$datos['codciudad'];
        $this->permiso=$datos['permiso'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getNitCliente() {
        return $this->nitCliente;
    }

    function getCodCiudad() {
        return $this->codCiudad;
    }

    function getPermiso() {
        return $this->permiso;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setNitCliente($nitCliente) {
        $this->nitCliente = $nitCliente;
    }

    function setCodCiudad($codCiudad) {
        $this->codCiudad = $codCiudad;
    }

    function setPermiso($permiso) {
        $this->permiso = $permiso;
    }
		
	function adicionar(){
		$cadenaSQL="insert into permisoHojaVida(nitCliente,codCiudad,permiso)values('{$this->nitCliente}','{$this->codCiudad}','$this->permiso')";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
	}
	function modificar(){
		$cadenaSQL="update permisoHojaVida set permiso='$this->permiso' where nitCliente='{$this->nitCliente}'";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
	}

    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from permisoHojaVida";
        if ($filtro!=null)$cadenaSQL=" where $filtro";
        if ($orden!=null)$cadenaSQL=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos = PermisoHojaVida::getDatos($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($datos); $i++) {
            $permiso=new PermisoHojaVida($datos[$i], null);
            $lista[$i] = $permiso;
        }
        return $lista;
    }
	
	function getPermisosLista($nitCliente){
		$seleccion='';
		switch($this->permiso){
			case '1':
				$seleccion.="<label><input type='radio' name='permiso' value='1' style='margin:0 2px;' checked onchange='upPermiso(this.value," . '"' . "{$nitCliente}" . '"' . ")'>MANTENIMIENTO&nbsp;&nbsp;</label>";
				$seleccion.="<label><input type='radio' name='permiso' value='2' style='margin:0 2px;' onchange='upPermiso(this.value," . '"' . "{$nitCliente}" . '"' . ")'>CALIBRACION&nbsp;&nbsp;</label>";
				$seleccion.="<label><input type='radio' name='permiso' value='3' style='margin:0 2px;' onchange='upPermiso(this.value," . '"' . "{$nitCliente}" . '"' . ")'>AMBOS</label>";
				break;
			case '2':
				$seleccion.="<label><input type='radio' name='permiso' value='1' style='margin:0 2px;' onchange='upPermiso(this.value," . '"' . "{$nitCliente}" . '"' . ")'>MANTENIMIENTO&nbsp;&nbsp;</label>";
				$seleccion.="<label><input type='radio' name='permiso' value='2' style='margin:0 2px;' checked onchange='upPermiso(this.value," . '"' . "{$nitCliente}" . '"' . ")'>CALIBRACION&nbsp;&nbsp;</label>";
				$seleccion.="<label><input type='radio' name='permiso' value='3' style='margin:0 2px;' onchange='upPermiso(this.value," . '"' . "{$nitCliente}" . '"' . ")'>AMBOS</label>";
				break;
			case '3':
				$seleccion.="<label><input type='radio' name='permiso' value='1' style='margin:0 2px;' onchange='upPermiso(this.value," . '"' . "{$nitCliente}" . '"' . ")'>MANTENIMIENTO&nbsp;&nbsp;</label>";
				$seleccion.="<label><input type='radio' name='permiso' value='2' style='margin:0 2px;' onchange='upPermiso(this.value," . '"' . "{$nitCliente}" . '"' . ")'>CALIBRACION&nbsp;&nbsp;</label>";
				$seleccion.="<label><input type='radio' name='permiso' value='3' style='margin:0 2px;' checked onchange='upPermiso(this.value," . '"' . "{$nitCliente}" . '"' . ")'>AMBOS</label>";
				break;
			default:
				$seleccion.="<label><input type='radio' ide='permiso' name='permiso' value='1' style='margin:0 2px;' onchange='addPermiso(this.value," . '"' . "{$nitCliente}" . '"' . ")'>MANTENIMIENTO&nbsp;&nbsp;</label>";
				$seleccion.="<label><input type='radio' ide='permiso' name='permiso' value='2' style='margin:0 2px;' onchange='addPermiso(this.value," . '"' . "{$nitCliente}" . '"' . ")'>CALIBRACION&nbsp;&nbsp;</label>";
				$seleccion.="<label><input type='radio' ide='permiso' name='permiso' value='3' style='margin:0 2px;' onchange='addPermiso(this.value," . '"' . "{$nitCliente}" . '"' . ")'>AMBOS</label>";
				break;
		}
		return $seleccion;
	}

}
