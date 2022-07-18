<?php
/*

*/
class Servicio{
	private $codigo;
	private $nombre;
	
	function __construct($campo,$valor) {
		if($campo!=null){
			if(is_array($campo))$this->cargarAtributos($campo);
			else{
				$cadenaSQL="select * from servicio where $campo=$valor";
				$resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
				if(count($resultado)>0)$this->cargarAtributos($resultado[0]);
			}
		}
	}
    private function cargarAtributos($datos) {
        $this->nombre=$datos['nombre'];
        $this->codigo=$datos['codigo'];
    }
	// Funciones get	
	function getCodigo() {
        return $this->codigo;
    }
	
	function getNombre() {
        return $this->nombre;
    }
	//Funciones Set	
	function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

	function setNombre($nombre) {
        $this->nombre = $nombre;
    }
	// Funciones de Scrum
	
	public static function getDatos($filtro,$orden){
		$cadenaSQL="select * from servicio";
		if($filtro!=null)$cadenaSQL.=" where $filtro";
		if($orden!=null)$cadenaSQL.=" order by $orden";
		return ConectorBD::ejecutarQuery($cadenaSQL,null);
	}
	
	public static function getDatosEnObjetos($filtro,$orden){
		$datos=Servicio::getDatos($filtro,$orden);
		$lista=array();
		for($i = 0; $i < count($datos); $i++){
			$servicio=new Servicio($datos[$i], null);
			$lista[$i]=$servicio;
		}
		return $lista;
	}
	
	public static function getServicioEnOptions($predeterminado) {
        $servicios= Servicio::getDatosEnObjetos(null, 'codigo');
        $lista='<option>--Selecccione--</option>';
        for ($i = 0; $i < count($servicios); $i++) {
            $servicio=$servicios[$i];
            if ($predeterminado==$servicio->getCodigo()) $auxiliar="selected";
            else $auxiliar='';
            $lista.="<option value='{$servicio->getCodigo()}' {$auxiliar}>{$servicio->getNombre()}</option>";
        }
        return $lista;
    }

    public  static function getServiciosEnArreglosJS(){
        $datos="var servicios=new Array();\n";
        $servicios= Servicio::getDatosEnObjetos(null, "nombre");
        for ($i = 0; $i < count($servicios); $i++) {
            $servicio=$servicios[$i];
            $datos.="servicios[$i]=new Array();\n";
            $datos.="\tservicios[$i][0]='{$servicio->getCodigo()}'\n";
            $datos.="\tservicios[$i][1]='{$servicio->getNombre()}'\n";

        }
        return $datos;
    }


}