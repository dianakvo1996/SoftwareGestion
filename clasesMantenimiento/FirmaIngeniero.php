<?php


require_once dirname(__FILE__) . '/../clasesCalidad/Persona.php';
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';

class FirmaIngeniero{
	private $ide;
	private $ideIngeniero;
	private $imgFirma;

	function __construct($campo,$valor) {
		if($campo!=null){
			if(is_array($campo)) {
				$this->cargarAtributos($campo);
				}else{
				$cadenaSQL="select * from firmaIngeniero where $campo=$valor";
				$resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
				if(count($resultado)>0)
					$this->cargarAtributos($resultado[0]);
			}
		}
	}

	private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->ideIngeniero=$datos['ideingeniero'];
		$this->imgFirma=$datos['imgfirma'];
    }
//get
	function getIde() {
        return $this->ide;
    }

	function getIdeIngeniero() {
        return $this->ideIngeniero;
    }

	function getImgFirma() {
        return $this->imgFirma;
    }
//set
	function setIde($ide) {
        $this->ide = $ide;
    }
	
	function setIdeIngeniero($ideIngeniero) {
        $this->ideIngeniero = $ideIngeniero;
    }
	function setImgFirma($imgFirma) {
        $this->imgFirma= $imgFirma;
    }
//foraneas	
	function getPersona(){
		return new Persona('identificacion',"'{$this->ideIngeniero}'");
	}

// crud
	public static function getDatos($filtro,$orden){
		$cadenaSQL="select * from  firmaIngeniero";
		if($filtro!=null)$cadenaSQL.=" where $filtro";
		if($orden!=null)$cadenaSQL.=" order by $orden";
		return ConectorBD::ejecutarQuery($cadenaSQL,null);
	}
	
	public static function getDatosEnObjetos($filtro,$orden){
		$datos=FirmaIngeniero::getDatos($filtro,$orden);
		$lista=array();
		for($i = 0; $i < count($datos); $i++){
			$firma=new FirmaIngeniero($datos[$i],null);
			$lista[$i]=$firma;
		}
		return $lista;
	}
	
	function adicionar(){
		$cadenaSQL="insert into firmaIngeniero(ideIngeniero,imgFirma)values('{$this->ideIngeniero}','{$this->imgFirma}')";
		ConectorBD::ejecutarQuery($cadenaSQL,null);
	}
	function modificar(){
		$cadenaSQL="update firmaIngeniero set imgFirma='{$this->imgFirma}' where ide={$this->ide}";
		ConectorBD::ejecutarQuery($cadenaSQL,null);
	}

}
