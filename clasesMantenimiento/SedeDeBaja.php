<?php

require_once dirname(__FILE__) . '/../clasesGenericas/Ciudad.php';

class SedeDeBaja {
	priavte $ide;
	private $nombre;
    private $nitCliente;
    private $codCiudad;
	
	function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))
                $this->cargarAtributos($campo);
            else{
                $cadenaSQL="select * from sedeDeBaja where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0)
                    $this->cargarAtributos($resultado[0]);
            }
        }
    }
   
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->nombre=$datos['nombre'];
        $this->nitCliente=$datos['nitcliente'];
        $this->codCiudad=$datos['codciudad'];
    }
//Inicio get y set
	    function getIde() {
        return $this->ide;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getNitCliente() {
        return $this->nitCliente;
    }
    function getCodCiudad() {
        return $this->codCiudad;
    }
	
    function setCodCiudad($codCiudad) {
        $this->codCiudad = $codCiudad;
    }
    function setIde($ide) {
        $this->ide = $ide;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setNitCliente($nitCliente) {
        $this->nitCliente = $nitCliente;
    }
//Fin get y set

//Inicio Llaves foraneas
    function getCiudad() {
        return new Ciudad('codigo', "'{$this->codCiudad}'");
    }
    
    function getCliente() {
        return new Cliente('nit',"'".$this->nitCliente."'");
    }
    function getCronogramaCalibracion() {
        return new CronogramaCalibracion('ideSede', $this->ide);
    }
//Fin Llaves Foraneas

    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from sedeDeBaja";
        if ($filtro!=null) $cadenaSQL.=" where $filtro";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= Sede::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $sede=new Sede($datos[$i], null);
            $lista[$i]=$sede;
        }
        return $lista;
    } 

}