<?php
/*

*/
class Ambiente{
	private $ide;
	private $codigo;
	private $nombre;
	private $codUnidad;
	
	function __construct($campo,$valor) {
		if($campo!=null){
			if(is_array($campo))$this->cargarAtributos($campo);
			else{
				$cadenaSQL="select * from ambiente where $campo=$valor";
				$resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
				if(count($resultado)>0)$this->cargarAtributos($resultado[0]);
			}
		}
	}
	private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->codigo=$datos['codigo'];
		$this->nombre=$datos['nombre'];
        $this->codUnidad=$datos['codunidad'];
    }

// Get
	function getIde() {
        return $this->ide;
    }
	
	function getCodigo() {
        return $this->codigo;
    }
	
	function getNombre() {
        return $this->nombre;
    }	
	
	function getCodUnidad() {
        return $this->codUnidad;
    }
// Set	
	function setIde($ide) {
        $this->ide = $ide;
    }
	
	function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

	function setNombre($nombre) {
        $this->nombre = $nombre;
    }
	
	function setCodUnidad($codUnidad) {
        $this->codUnidad = $codUnidad;
    }
// scrum
	public static function getDatos($filtro,$orden){
		$cadenaSQL="select * from  ambiente ";
		if($filtro!=null)$cadenaSQL.=" where $filtro";
		if($orden!=null)$cadenaSQL.=" order by $orden";
		return ConectorBD::ejecutarQuery($cadenaSQL,null);
	}
	
	public static function getDatosEnObjetos($filtro,$orden){
		$datos=Ambiente::getDatos($filtro,$orden);
		$lista=array();
		for($i = 0; $i < count($datos); $i++){
			$ambiente=new Ambiente($datos[$i],null);
			$lista[$i]=$ambiente;
		}
		return $lista;
	}
	
	public  static function getAmbienteEnArreglosJS(){
        $datos="var ambientes=new Array();\n";
        $ambientes= Ambiente::getDatosEnObjetos(null, "codigo");
        for ($i = 0; $i < count($ambientes); $i++) {
            $ambiente=$ambientes[$i];
            $datos.="ambientes[$i]=new Array();\n";
            $datos.="\tambientes[$i][0]='{$ambiente->getCodigo()}'\n";
            $datos.="\tambientes[$i][1]='{$ambiente->getNombre()}'\n";
            $datos.="\tambientes[$i][2]='{$ambiente->getCodUnidad()}'\n";
            $datos.="\tambientes[$i][3]='{$ambiente->getIde()}'\n";

        }
        return $datos;
    }
}