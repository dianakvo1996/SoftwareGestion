<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Equipo
 *
 * @author Adriana
 */
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/TipoEquipo.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/Ambiente.php';

class Equipo {
    private $ide;
    private $nombreEquipo;
    private $marca;
    private $modelo;
    private $serial;
    private $activoFijo;
    private $ubicacion;
    private $ideSede;
    private $nitCliente;
    private $registroInvima;
	private $referencia;
	private $ideAmbiente;
    private $ideRecomendacionFabricante;

    function __construct($campo,$valor) {
        if ($campo!= null) {
            if (is_array($campo))
                $this->cargarAtributos($campo);
            else{
                $cadenaSQL="select * from equipo where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0)
                    $this->cargarAtributos($resultado[0]);
            }         
        }
    }
   
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->nombreEquipo=$datos['nombreequipo'];
        $this->marca=$datos['marca'];
        $this->modelo=$datos['modelo'];
        $this->serial=$datos['serial'];
        $this->activoFijo=$datos['activofijo'];
        $this->ubicacion=$datos['ubicacion'];
        $this->ideSede=$datos['idesede'];
        $this->nitCliente=$datos['nitcliente'];
		$this->registroInvima=$datos['registroinvima'];
		$this->referencia=$datos['referencia'];
		$this->ideAmbiente=$datos['ideambiente'];
		$this->ideRutinaExtra=$datos['iderutinaextra'];
		$this->ideRecomendacionFabricante=$datos['iderecomendacionfabricante'];

    }
    
    function getIde() {
        return $this->ide;
    }

    function getNombreEquipo() {
        return $this->nombreEquipo;
    }
    function getTipoEquipo() {
        return new TipoEquipo('nombre',"'{$this->nombreEquipo}'");
    }
    function getMarca() {
        return $this->marca;
    }

    function getModelo() {
        return $this->modelo;
    }

    function getSerial() {
        return $this->serial;
    }

    function getActivoFijo() {
        return $this->activoFijo;
    }

    function getUbicacion() {
        return $this->ubicacion;
    }


    function getIdeSede() {
        return $this->ideSede;
    }
    
    function getSede() {
        return new Sede('ide', $this->ideSede);
    }

    function getNitCliente() {
        return $this->nitCliente;
    }
    function getCliente() {
        return new Cliente('nit', "'".$this->nitCliente."'");
    }

    function getRegistroInvima() {
		if($this->registroInvima==null)$this->registroInvima='NO APLICA';
        return $this->registroInvima;
    }
    function getReferencia() {
        return $this->referencia;
    }
    function getIdeAmbiente() {
        return $this->ideAmbiente;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setNombreEquipo($nombreEquipo) {
        $this->nombreEquipo = $nombreEquipo;
    }

    function setMarca($marca) {
        $this->marca = $marca;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    function setSerial($serial) {
        $this->serial = $serial;
    }

    function setActivoFijo($activoFijo) {
        $this->activoFijo = $activoFijo;
    }

    function setUbicacion($ubicacion) {
        $this->ubicacion = $ubicacion;
    }

    function setIdeSede($ideSede) {
        $this->ideSede = $ideSede;
    }

    function setNitCliente($nitCliente) {
        $this->nitCliente = $nitCliente;
    }

    function setRegistroInvima($registoInvima) {
        $this->registroInvima = $registoInvima;
    }

    function setReferencia($referencia) {
        $this->referencia = $referencia;
    }

    function setIdeAmbiente($ideAmbiente) {
        $this->ideAmbiente= $ideAmbiente;
    }

//nuevos get y set
    function setIdeRutinaExtra($ideRutinaExtra) {
        $this->ideRutinaExtra= $ideRutinaExtra;
    }

	function setIdeRecomendacionFabricante($ideRecomendacionFabricante){
		$this->ideRecomendacionFabricante=$ideRecomendacionFabricante;

	}

	function getIdeRecomendacionFabricante(){
		return $this->ideRecomendacionFabricante;

	}
    function getIdeRutinaExtra() {
        return $this->ideRutinaExtra;
    }


    function moverEquipo() {
        $cadenaSQL="update equipo set ideSede={$this->ideSede}, ubicacion='{$this->ubicacion}' where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function adicionarEquipoSede($ideAmbiente) {
		$campo='';
		$valor='';
		if($ideAmbiente!='null'){
			$campo=',ideAmbiente';
			$valor=",'".$ideAmbiente."'";
		}
        $cadenaSQL="insert into equipo(nombreEquipo,marca,modelo,serial,activoFijo, ubicacion,ideSede,registroInvima,referencia{$campo})values"
                . "('{$this->nombreEquipo}','{$this->marca}','{$this->modelo}','{$this->serial}','{$this->activoFijo}','{$this->ubicacion}','{$this->ideSede}','{$this->registroInvima}','{$this->referencia}'{$valor})";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function adicionarEquipoCliente($ideAmbiente) {
		$campo='';
		$valor='';
		if($ideAmbiente!='null'){
			$campo=',ideAmbiente';
			$valor=",'".$ideAmbiente."'";
		}
        $cadenaSQL="insert into equipo(nombreEquipo,marca,modelo,serial,activoFijo, ubicacion,nitCliente,registroInvima,referencia{$campo})values"
                . "('{$this->nombreEquipo}','{$this->marca}','{$this->modelo}','{$this->serial}','{$this->activoFijo}','{$this->ubicacion}','{$this->nitCliente}','{$this->registroInvima}','{$this->referencia}'{$valor})";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function ModificarEquipoCliente($ideAmbiente) {
		$extra='';
		if($ideAmbiente!='null') $extra=", ideAmbiente={$ideAmbiente}, ideRecomendacionFabricante={$this->ideRecomendacionFabricante}";
        $cadenaSQL="update equipo set nombreEquipo='{$this->nombreEquipo}', marca='{$this->marca}', modelo='{$this->modelo}', serial='{$this->serial}', activoFijo='{$this->activoFijo}', ubicacion='{$this->ubicacion}', nitCliente='{$this->nitCliente}', registroInvima='{$this->registroInvima}', referencia='{$this->referencia}'{$extra} where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function ModificarEquipoSede($ideAmbiente) {
		$extra='';
		if($ideAmbiente!='null') $extra=", ideAmbiente={$ideAmbiente}, ideRecomendacionFabricante={$this->ideRecomendacionFabricante}";

        $cadenaSQL="update equipo set nombreEquipo='{$this->nombreEquipo}', marca='{$this->marca}', modelo='{$this->modelo}', serial='{$this->serial}', activoFijo='{$this->activoFijo}', ubicacion='{$this->ubicacion}',ideSede='{$this->ideSede}', registroInvima='{$this->registroInvima}', referencia='{$this->referencia}'{$extra} where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function Eliminar() {
        $cadenaSQL="delete from equipo where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatos($filtro, $orden) {
        $cadenaSQL='select * from equipo';
        if ($filtro!=null) $cadenaSQL.=" where $filtro";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= Equipo::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $equipo=new Equipo($datos[$i],null);
            $lista[$i]=$equipo;
        }
        return $lista;
    }
    
    public static function getEquiposClienteEnOptions($nitCliente) {
        $equipos= Equipo::getDatosEnObjetos("nitCliente='$nitCliente'", 'nombreEquipo');
        $lista='<option>Seleccione Equipo...</option>';
        for ($i = 0; $i < count($equipos); $i++) {
            $equipo=$equipos[$i];
            $lista.="<option value='{$equipo->getIde()}'>{$equipo->getActivoFijo()} - {$equipo->getNombreEquipo()}</option>";
        }
        return $lista;
    }    
    function getCronogramaCalibracion() {
        return new CronogramaCalibracion('ideSede', $this->ideSede);
    }
	function getAmbiente(){
		if($this->ideAmbiente!=null)
			return new Ambiente('ide',$this->ideAmbiente);
		else
			return new Ambiente(null,null);
	}
}
