<?php 
/**
 
 */
class GuiaEquipo{

	private $ide;	
	private $ideTipoEquipo;	
	private $ruta;

	function __construct($campo,$valor){
		if ($campo!=null) {
			if (is_array($campo))$this->cargarAtributos($campo);
			else{
				$cadenaSQL="select * from guiaEquipo where $campo=$valor";
				$resultado=ConectorBD::ejecutarQuery($cadenaSQL,null);
				if(count($resultado)>0)$this->cargarAtributos($resultado[0]);
			}
		}
	}

	private function cargarAtributos($datos){
		$this->ide=$datos['ide'];
		$this->ideTipoEquipo=$datos['idetipoequipo'];
		$this->ruta=$datos['ruta'];
	}

	//Getter

    function getIde() {
        return $this->ide;
    }

	function getIdeTipoEquipo(){
		return $this->ideTipoEquipo;
	}

	function getRuta(){
		return $this->ruta;
	}
	//Setter

	function setIde($ide){
		$this->ide=$ide;
	}
	function setIdeTipoEquipo($ideTipoEquipo){
		$this->ideTipoEquipo=$ideTipoEquipo;
	}
   	function setRuta($ruta) {
        	$this->ruta= $ruta;
    	}
	// Llaves foraneas
	function getTipoEquipo(){
		return new TipoEquipo('ide',$this->ideTipoEquipo);
	}
	// funciones CRUD
	function adicionar(){
		$cadenaSQL="insert into guiaEquipo(ideTipoEquipo,ruta)values({$this->ideTipoEquipo},'{$this->ruta}')";
		ConectorBD::ejecutarQuery($cadenaSQL,null);
	}

	function modificar(){
		$cadenaSQL="update guiaEquipo set ruta='{$this->ruta}' where ide={$this->ide}";
		ConectorBD::ejecutarQuery($cadenaSQL,null);
	}
	function eliminar(){
		$cadenaSQL="delete from guiaEquipo where ide={$this->ide}";
		ConectorBD::ejecutarQuery($cadenaSQL,null);
	}

	public static function getDatos($filtro,$orden){
		$cadenaSQL="select * from guiaEquipo";
		if($filtro!=null)$cadenaSQL.=" where $filtro";
		if($orden!=null)$cadenaSQL.=" order by $orden";
		return ConectorBD::ejecutarQuery($cadenaSQL,null);
	}
	public static function getDatosEnObjetos($filtro,$orden){
		$datos=GuiaEquipo::getDatos($filtro,$orden);
		$lista=array();
		for ($i=0 ; $i < count($datos) ; $i++ ) { 
			$guia=new GuiaEquipo($datos[$i]);
			$lista[$i]=$guia;
		}
		return $lista;
	}
	
	public static function getDatosEnJS($ide){
		$guia=new GuiaEquipo('ide',$ide);
		$datos=" let guiaDatos =['{$guia->getIde()}','{$guia->getIdeTipoEquipo()}','{$guia->getRuta()}']";
		return $datos;
	}
}