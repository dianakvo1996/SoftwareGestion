<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LugarIC
 *
 * @author BIOMETRICAL
 */
require_once dirname(__FILE__) . '/../clasesMantenimiento/Cliente.php';

class LugarIC {
    private $ide;
    private $ideIngeniero;
    private $nitCliente;
	private $pabon;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo)) {
                $this->cargarAtributos($campo);
            }else{
                $cadenaSQL="select * from lugarIC where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0) {
                    $this->cargarAtributos($resultado[0]);
                }
            }
        }
    }
    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->ideIngeniero=$datos['ideingeniero'];
        $this->nitCliente=$datos['nitcliente'];
		$this->pabon=$datos['pabon'];
    }
    function getIde() {
        return $this->ide;
    }

    function getIdeIngeniero() {
        return $this->ideIngeniero;
    }

    function getNitCliente() {
        return $this->nitCliente;
    }
	function getPabon() {
        return $this->pabon;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setIdeIngeniero($ideIngeniero) {
        $this->ideIngeniero = $ideIngeniero;
    }

    function setNitCliente($nitCliente) {
        $this->nitCliente = $nitCliente;
    }
    function setPabon($pabon) {
        $this->pabon= $pabon;
    }

    function getCliente() {
        return new Cliente('nit',"'".$this->nitCliente."'");
    }
	function getIngeniero() {
        return new Persona('nit',"'".$this->nitCliente."'");
    }


	function grabar(){
		$cadenaSQL="insert into lugaric(ideIngeniero,nitCliente,pabon)values('{$this->ideIngeniero}','{$this->nitCliente}','{$this->pabon}')";
echo $cadenaSQL;
		ConectorBD::ejecutarQuery($cadenaSQL, null);

	}

    public static function getDatos($filtro, $orden) {
        $cadenaSQL="select * from lugarIC";
        if ($filtro!=null)$cadenaSQL." where $filtro";
        if ($orden!=null)$cadenaSQL." order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= LugarIC::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $lugar=new LugarIC($datos[$i], null);
            $lista[$i]=$lugar;
        }
        return $lista;
    }
	public static function getLugarLista($identificacion){
		$lugar=new LugarIC('ideingeniero',"'".$identificacion."'");
		switch ($lugar->getNitCliente()){
			case'900597845-3':
				$lista='Clinica Cardioneurovascular Pabón';
				break;
			case'900077584RV':
				$lista='Sede Valle';
				break;
			case'900077584-HC':
				$lista='UCI Valle';
				break;
			case'900077584-HT':
				$lista='Hospital Tuquerres';
				break;
			default:
				$lista='--';
				break;

		}
	return $lista;

	}
    public static function getLugarEnOptions() {
        $options='';
		$predeterminada=$this->nitCliente;
        switch ($predeterminada) {
            case '900597845-3'://Pabon
                $options.="<option value='0'>--Seleccione--</option>";
                $options.="<option value='900597845-3' selected>Clinica Cardioneurovascular Pabón</option>";
                $options.="<option value='900077584RV'>Sede Valle</option>";
                $options.="<option value='900077584-HC'>UCI Valle</option>";
                $options.="<option value='900077584-HT'>Hospital Tuquerres</option>";
                break;
            case '900709554-8'://Sede Valle
                $options.="<option value='0'>--Seleccione--</option>";
                $options.="<option value='900597845-3'>Clinica Cardioneurovascular Pabón</option>";
                $options.="<option value='900709554-8' selected>Sede Valle</option>";
                $options.="<option value='900077584-HC'>UCI Valle</option>";
                $options.="<option value='900077584-HT'>Hospital Túquerres</option>";
                break;
            case '000000000-1'://UCI Valle
                $options.='<option value="0">--Seleccione--</option>';
                $options.='<option value="900597845-3" >Clinica Cardioneurovascular Pabón</option>';
                $options.='<option value="900709554-8">Sede Valle</option>';
                $options.='<option value="900077584-HC" selected>UCI Valle</option>';
                $options.='<option value="900077584-HT">Hospital Tuquerres</option>';
                break;
            case '000000000-2'://Hospital Tuqueres
                $options.='<option value="0">--Seleccione--</option>';
                $options.='<option value="900597845-3" >Clinica Cardioneurovascular Pabón</option>';
                $options.='<option value="900709554-8">Sede Valle</option>';
                $options.='<option value="900077584-HC" >UCI Valle</option>';
                $options.='<option value="900077584-HT" selected>Hospital Tuquerres</option>';
                break;
            default://Por Defecto
                $options.="<option value='0'>--Seleccione--</option>";
                $options.="<option value='900597845-3'>Clínica Cardioneurovascular Pabon</option>";
                $options.="<option value='900709554-8'>Sede Valle</option>";
                $options.="<option value='900077584-HC'>UCI Valle</option>";
                $options.="<option value='900077584-HT'>Hospital Tuquerres</option>";
                break;
        }
	return $options;
    }
}
