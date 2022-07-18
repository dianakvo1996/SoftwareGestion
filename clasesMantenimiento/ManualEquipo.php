<?php 

/**
 * 
 */
class ManualEquipo{
	private $ide;	
	private $ideTipoEquipo;	
	private $ruta;
	private $principal;
	
	function __construct($campo,$valor){
		if($campo!=null){
			if(is_array($campo))$this->cargarAtributos($campo);
			else{
				$cadenaSQL="select * from manualEquipo where $campo=$valor";
				$resultado=ConectorBD::ejecutarQuery($cadenaSQL,null);
				if (count($resultado)>0)$this->cargarAtributos($resultado[0]);
			}
		}
	}

	private function cargarAtributos($datos){
		$this->ide=$datos['ide'];
		$this->ideTipoEquipo=$datos['idetipoequipo'];
		$this->ruta=$datos['ruta'];
		$this->principal=$datos['principal'];
	}
	//Getter
	function getIde() {
        	return $this->ide;
    	}

	function getIdeTipoEquipo() {
		return $this->ideTipoEquipo;
	}

	function getRuta(){
		return $this->ruta;
	}

	function getPrincipal(){
		return $this->principal;
	}
	//Setter

	function setIde($ide){
		$this->ide=$ide;
	}
	function setIdeTipoEquipo($ideTipoEquipo){
		$this->ideTipoEquipo=$ideTipoEquipo;
	}
	function setRuta($ruta){
		$this->ruta=$ruta;
	}
	function setPrincipal($principal){
		$this->principal=$principal;
	}
	// Llaves foraneas
	function getTipoEquipo(){
		return new TipoEquipo('ide',$this->ideTipoEquipo);
	}
	// funciones de gestion

	function adicionar(){
		$cadenaSQL="insert into manualEquipo(ideTipoEquipo,ruta)values({$this->ideTipoEquipo},'{$this->ruta}')";
		ConectorBD::ejecutarQuery($cadenaSQL,null);
	}

	function modificar(){
		$cadenaSQL="update manualEquipo set idetipoEquipo={$this->ideTipoEquipo}, ruta='{$this->ruta}' where ide={$this->ide}";
		ConectorBD::ejecutarQuery($cadenaSQL,null);
	}
	function eliminar(){
		$cadenaSQL="delete from manualEquipo where ide={$this->ide}";
		ConectorBD::ejecutarQuery($cadenaSQL,null);
	}

	public static function getDatos($filtro,$orden){
		$cadenaSQL="select * from manualEquipo";
		if($filtro!=null)$cadenaSQL.=" where $filtro";
		if($orden!=null)$cadenaSQL.=" order by $orden";
		return ConectorBD::ejecutarQuery($cadenaSQL,null);
	}
	public static function getDatosEnObjetos($filtro,$orden){
		$datos=ManualEquipo::getDatos($filtro,$orden);
		$lista=array();
		for ($i=0 ; $i < count($datos) ; $i++ ) { 
			$manual=new ManualEquipo($datos[$i],null);
			$lista[$i]=$manual;
		}
		return $lista;
	}
}