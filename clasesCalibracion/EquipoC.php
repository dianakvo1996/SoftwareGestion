<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EquipoC
 *
 * @author Diana
 */

require_once dirname(__FILE__) . '/../clasesCalibracion/NombreEquipo.php';

class EquipoC {
    private $ide;
    private $nombreEquipo;
    private $marca;
    private $modelo;
    private $serial;
    private $activoFijo;
    private $ubicacion;
    private $ideSede;
    private $nitCliente;
    
    function __construct($campo,$valor) {
        if ($campo!= null) {
            if (is_array($campo))
                $this->cargarAtributos($campo);
            else{
                $cadenaSQL="select * from equipoC where $campo=$valor";
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
    }
    
    function getIde() {
        return $this->ide;
    }

    function getNombreEquipo() {
        return $this->nombreEquipo;
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

    function getNitCliente() {
        return $this->nitCliente;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setNombreEquipo($nombreEquipo){
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

	function getNombreEquipoObjeto(){
		return new NombreEquipo('nombre',"'".trim($this->nombreEquipo)."'");
	}
	
	 public static function getModal($ideEquipo){
		$equipoC=new EquipoC('ide',$ideEquipo);
		$nombreEquipo=trim($equipoC->getNombreEquipo());
		$lista='';
		$nombreObjeto=new NombreEquipo('nombre',"'".$nombreEquipo."'");
			$lista.="<tr><th colspan='2'>DETALLES EQUIPO</th></tr>";
			$lista.="<tr>";
			$lista.="<th>ACTIVO FIJO</th><td>{$equipoC->getActivoFijo()}</td>";
			$lista.="</tr>";
			$lista.="<tr>";
			$lista.="<th>NOMBRE EQUIPO</th><td>{$equipoC->getNombreEquipo()}</td>";
			$lista.="</tr>";
			$lista.="<tr>";
			$lista.="<th>MARCA</th><td>{$equipoC->getMarca()}</td>";
			$lista.="</tr>";
			$lista.="<tr>";
			$lista.="<th>MODELO</th><td>{$equipoC->getModelo()}</td>";
			$lista.="</tr>";
			$lista.="<tr>";
			$lista.="<th>SERIE</th><td>{$equipoC->getSerial()}</td>";
			$lista.="</tr>";
			$lista.="<tr>";
			$lista.="<th>TIPO</th><td>{$nombreObjeto->getTipoLista()}</td>";
			$lista.="</tr>";
			$lista.="<tr>";
			$lista.="<th>CLASIFICACION BIOMEDICA</th><td>{$nombreObjeto->getClasificacionBiomedicaLista()}</td>";
			$lista.="</tr>";
			$lista.="<tr>";
			$lista.="<th>UBICACION</th><td>{$equipoC->getUbicacion()}</td>";
			$lista.="</tr>";
		return $lista;
	}
//Inicio procedimientos
    function adicionarEquipoSede() {
        $cadenaSQL="insert into equipoC(nombreEquipo,marca,modelo,serial,activoFijo, ubicacion,ideSede)values"
                . "('{$this->nombreEquipo}','{$this->marca}','{$this->modelo}','{$this->serial}','{$this->activoFijo}','{$this->ubicacion}','{$this->ideSede}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function adicionarEquipoCliente() {
        $cadenaSQL="insert into equipoC(nombreEquipo,marca,modelo,serial,activoFijo,ubicacion,nitCliente)values('{$this->nombreEquipo}','{$this->marca}','{$this->modelo}','{$this->serial}','{$this->activoFijo}','{$this->ubicacion}','{$this->nitCliente}')";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
echo $this->nombreEquipo;

    }
    function ModificarEquipoCliente() {
        $cadenaSQL="update equipoC set nombreEquipo='{$this->nombreEquipo}', marca='{$this->marca}', modelo='{$this->modelo}', serial='{$this->serial}', activoFijo='{$this->activoFijo}', ubicacion='{$this->ubicacion}', nitCliente='{$this->nitCliente}' where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function ModificarEquipoSede() {
        $cadenaSQL="update equipoC set nombreEquipo='{$this->nombreEquipo}', marca='{$this->marca}', modelo='{$this->modelo}', serial='{$this->serial}', activoFijo='{$this->activoFijo}', ubicacion='{$this->ubicacion}',ideSede='{$this->ideSede}' where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function Eliminar() {
        $cadenaSQL="delete from equipoC where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
//Fin procedimientos
//inicio Funciones
    public static function getDatos($filtro, $orden) {
        $cadenaSQL='select * from equipoC';
        if ($filtro!=null) $cadenaSQL.=" where $filtro";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= EquipoC::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $equipo=new EquipoC($datos[$i],null);
            $lista[$i]=$equipo;
        }
        return $lista;
    }
//inicio Funciones
}
