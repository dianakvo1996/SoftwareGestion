<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of solicitudCorrectivo
 *
 * @author Lenovo
 */
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/EquipoCorrectivo.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/EquipoDeBaja.php';
require_once dirname(__FILE__) . '/../clasesGenericas/Ciudad.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/RespuestaSolicitud.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/Mes.php';

class solicitudCorrectivo {
    private $ide;
    private $ideEquipo;
    private $solicitante;
    private $cargo;
    private $detalle;
    private $fotografia;
    private $fecha;
    private $nitCliente;
    private $ideSede;
    private $codCiudad;
	private $ideEquipoDeBaja;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))$this->cargarAtributos ($campo);
            else{
                $cadenaSQL="select * from solicitudCorrectivo where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)$this->cargarAtributos ($resultado[0]);
            }
        }
    }
    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->ideEquipo=$datos['ideequipo'];
        $this->solicitante=$datos['solicitante'];
        $this->cargo=$datos['cargo'];
        $this->detalle=$datos['detalle'];
        $this->fotografia=$datos['fotografia'];
        $this->fecha=$datos['fecha'];
        $this->nitCliente=$datos['nitcliente'];
        $this->ideSede=$datos['idesede'];
        $this->codCiudad=$datos['codciudad'];
	$this->ideEquipoDeBaja=$datos['ideequipodebaja'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getIdeEquipo() {
        return $this->ideEquipo;
    }

    function getSolicitante() {
        return $this->solicitante;
    }

    function getCargo() {
        return $this->cargo;
    }

    function getDetalle() {
        return $this->detalle;
    }

    function getFotografia() {
        return $this->fotografia;
    }

    function getFecha() {
        return $this->fecha;
    }

	function getFechaLista(){
		$fecha= date_create($this->fecha);
		$mes=new Mes('ide',date_format($fecha,'n'));
		$dia=date_format($fecha,'j');
		$año=date_format($fecha,'Y');
	return $dia.' de '.$mes->getNombre().' de '.$año;
	}
    function getMostrarFecha() {
        $fecha= date_create($this->fecha);
        return date_format($fecha,'d/m/Y h:i A');
    }
    
    function getNitCliente() {
        return $this->nitCliente;
    }

    function getIdeSede() {
        return $this->ideSede;
    }
    function getCodCiudad() {
        return $this->codCiudad;
    }
	function getIdeEquipoDeBaja() {
        return $this->ideEquipoDeBaja;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setIdeEquipo($ideEquipo) {
        $this->ideEquipo = $ideEquipo;
    }

    function setSolicitante($solicitante) {
        $this->solicitante = $solicitante;
    }

    function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    function setDetalle($detalle) {
        $this->detalle = $detalle;
    }

    function setFotografia($fotografia) {
        $this->fotografia = $fotografia;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    function setNitCliente($nitCliente) {
        $this->nitCliente = $nitCliente;
    }

    function setIdeSede($ideSede) {
        $this->ideSede = $ideSede;
    }
    function setCodCiudad($codCiudad) {
        $this->codCiudad = $codCiudad;
    }

    function setIdeEquipoDeBaja($ideEquipoDeBaja) {
        $this->codCiudad = $codCiudad;
    }
    
    //Inicio llaves foraneas
    function getEquipo() {
        return new EquipoCorrectivo('ide', $this->ideEquipo);
    }
    function getCliente() {
        return new Cliente('nit',"'{$this->nitCliente}'");
    }
    function getSede() {
        return new Sede('ide', $this->ideSede);
    }
    function getCiudad() {
        return new Ciudad('codigo', "'{$this->codCiudad}'");
    }
	function getEquipoDeBaja() {
        return new EquipoDeBaja('ide', $this->ideEquipoDeBaja);
    }
    function getRespuesta() {
        return new RespuestaSolicitud('ideSolicitud', $this->ide);   
    }
    //Fin llaves foraneas

    function adicionarSolicitudCliente() {
        $cadenaSQL="insert into solicitudCorrectivo(ideEquipo,solicitante,cargo,fotografia,fecha,detalle,nitCliente,codCiudad)values({$this->ideEquipo},'{$this->solicitante}','{$this->cargo}','{$this->fotografia}','{$this->fecha}','{$this->detalle}','{$this->nitCliente}','{$this->codCiudad}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function adicionarSolicitudSede() {
        $cadenaSQL="insert into solicitudCorrectivo(ideEquipo,solicitante,cargo,fotografia,fecha,detalle,ideSede,codCiudad)values({$this->ideEquipo},'{$this->solicitante}','{$this->cargo}','{$this->fotografia}','{$this->fecha}','{$this->detalle}','{$this->ideSede}','{$this->codCiudad}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from solicitudCorrectivo";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getConsultaTablaCombinada($condicionExtra, $orden) {
        // inicio construccion de la cadena
        $cadenaSQL="select solicitudCorrectivo.ide,ideEquipo,solicitante,cargo,detalle,fotografia,fecha,nitCliente,ideSede,codCiudad,ideequipodebaja from solicitudCorrectivo,respuestaSolicitud,ciudad,departamento where solicitudCorrectivo.ide=respuestaSolicitud.ideSolicitud and solicitudCorrectivo.codCiudad=ciudad.codigo and ciudad.codDepartamento=Departamento.codigo";
        if ($condicionExtra!=null) $cadenaSQL.=" and $condicionExtra";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
        // fin construccion de la cadena
        $datos= ConectorBD::ejecutarQuery($cadenaSQL, null);
        $lista=array();
			//echo $cadenaSQL;
        for ($j = 0; $j < count($datos); $j++) {
            $solicitud=new solicitudCorrectivo($datos[$j], null);
            $lista[$j]=$solicitud;
        }        
        return $lista;
    }

    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= solicitudCorrectivo::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $solicitud=new solicitudCorrectivo($datos[$i], null);
            $lista[$i]=$solicitud;
        }
        return $lista;
    }
    public static function getDatosArregloJS($filtro){
	$datos = "var solicitudes=new Array();\n";
	$solicitudes = solicitudCorrectivo::getDatosEnObjetos($filtro, 'fecha desc');
        for ($i = 0; $i < count($solicitudes); $i++) {
            $solicitud= $solicitudes[$i];
            $datos .= "solicitudes[$i]=new Array();\n";
            $datos .= "\tsolicitudes[$i][0]='{$solicitud->getIde()}'\n";
            $datos .= "\tsolicitudes[$i][1]='{$solicitud->getFecha()}'\n";
            $datos .= "\tsolicitudes[$i][2]='{$solicitud->getRespuesta()->getEvidencia()}'\n";
	    $datos .= "\tsolicitudes[$i][3]='{$solicitud->getFechaLista()}'\n";
        }
        return $datos;
	}
}
