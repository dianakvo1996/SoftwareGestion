<?php

require_once dirname(__FILE__) . '/../clasesMantenimiento/ReportePreventivo.php';
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';

class FirmaSatisfaccion{
	private $ide;
	private $numReporte;
	private $imgFirma;

	function __construct($campo,$valor) {
		if($campo!=null){
			if(is_array($campo)) {
				$this->cargarAtributos($campo);
				}else{
				$cadenaSQL="select * from firmaSatisfaccion where $campo=$valor";
				$resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
				if(count($resultado)>0)
					$this->cargarAtributos($resultado[0]);
			}
		}
	}

	private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->numReporte=$datos['numreporte'];
		$this->imgFirma=$datos['imgfirma'];
    }
//get
	function getIde() {
        return $this->ide;
    }

	function getNumReporte() {
        return $this->numReporte;
    }

	function getImgFirma() {
        return $this->imgFirma;
    }
//set
	function setIde($ide) {
        $this->ide = $ide;
    }
	
	function setNumReporte($numReporte) {
        $this->numReporte = $numReporte;
    }
	function setImgFirma($imgFirma) {
        $this->imgFirma= $imgFirma;
    }
//foraneas	
	function getReportePreventivo(){
		return new ReportePreventivo('numeroReporte',"'{$this->numReporte}'");
	}
// crud
	public static function getDatos($filtro,$orden){
		$cadenaSQL="select * from  firmaSatistaccion";
		if($filtro!=null)$cadenaSQL.=" where $filtro";
		if($orden!=null)$cadenaSQL.=" order by $orden";
		return ConectorBD::ejecutarQuery($cadenaSQL,null);
	}
	
	public static function getDatosEnObjetos($filtro,$orden){
		$datos=FirmaSatisfaccion::getDatos($filtro,$orden);
		$lista=array();
		for($i = 0; $i < count($datos); $i++){
			$firma=new FirmaSatisfaccion($datos[$i],null);
			$lista[$i]=$firma;
		}
		return $lista;
	}

	function adicionar(){
		$cadenaSQL="insert into firmaSatisfaccion(numReporte,imgFirma)values({$this->numReporte},'{$this->imgFirma}')";
		ConectorBD::ejecutarQuery($cadenaSQL,null);
	}
	function modificar(){
		$cadenaSQL="update firmaSatissfaccion set imgFirma='{$this->imgFirma}' where ide={$this->ide}";
		ConectorBD::ejecutarQuery($cadenaSQL,null);
	}

}