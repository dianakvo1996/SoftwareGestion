<?php
/*

*/
require_once dirname(__FILE__) . '/../clasesMantenimiento/Servicio.php';
class Unidad{
	private $codigo;
	private $nombre;
	private $codServicio;
	
	function __construct($campo,$valor) {
		if($campo!=null){
			if(is_array($campo))$this->cargarAtributos($campo);
			else{
				$cadenaSQL="select * from unidad where $campo=$valor";
				$resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
				if(count($resultado)>0)$this->cargarAtributos($resultado[0]);
			}
		}
	}
	
	private function cargarAtributos($datos) {
        $this->codigo=$datos['codigo'];
		$this->nombre=$datos['nombre'];
        $this->codServicio=$datos['codservicio'];
    }
	
	// Funciones get	
	function getCodigo() {
        return $this->codigo;
    }
	
	function getNombre() {
        return $this->nombre;
    }	
	
	function getCodServicio() {
        return $this->codServicio;
    }
	//Funciones Set	
	function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

	function setNombre($nombre) {
        $this->nombre = $nombre;
    }
	
	function setCodServicio($codServicio) {
        $this->codServicio = $codServicio;
    }

	function getServicio(){
		return new Servicio('codigo',"'{$this->codServicio}'");
	}
	public static function getDatos($filtro,$orden){
		$cadenaSQL="select * from unidad";
		if($filtro!=null)$cadenaSQL.=" where $filtro";
		if($orden!=null)$cadenaSQL.=" order by $orden";
		return ConectorBD::ejecutarQuery($cadenaSQL,null);
	}
	public static function getDatosEnObjetos($filtro,$orden){
		$datos=Unidad::getDatos($filtro,$orden);
		$lista=array();
		for($i = 0; $i < count($datos); $i++){
			$unidad=new Unidad($datos[$i],null);
			$lista[$i]=$unidad;
		}
		return $lista;
	}
    public  static function getUnidadesEnArreglosJS(){
        $datos="var unidades=new Array();\n";
        $unidades= Unidad::getDatosEnObjetos(null, "codigo");
        for ($i = 0; $i < count($unidades); $i++) {
            $unidad=$unidades[$i];
            $datos.="unidades[$i]=new Array();\n";
            $datos.="\tunidades[$i][0]='{$unidad->getCodigo()}'\n";
            $datos.="\tunidades[$i][1]='{$unidad->getNombre()}'\n";
            $datos.="\tunidades[$i][2]='{$unidad->getCodServicio()}'\n";

        }
        return $datos;
    }

}