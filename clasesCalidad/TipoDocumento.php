<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoDocumento
 *
 * @author BIOMETRICAL
 */

require_once dirname(__FILE__) . '/../clasesCalidad/DocumentoGestion.php';
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';

class TipoDocumento {
    private $ide;
    private $nombre;
    private $tipo;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))$this->cargarAtributos($campo);
            else{
                $cadenaSQL="select * from tipoDocumento where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)
					$this->cargarAtributos($resultado[0]);
            }
        }
    }
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->nombre=$datos['nombre'];
        $this->tipo=$datos['tipo'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    
    function adicionar() {
       $cadenaSQL="insert into tipoDocumento(nombre,tipo)values('{$this->nombre}','{$this->tipo}')";
echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificar() {
        $cadenaSQL="update tipoDocumetno set nombre'{$this->nombre}', tipo='{$this->tipo}' where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function elimirar() {
        $cadenaSQL="delete from tipoDocumento where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from tipoDocumento";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= TipoDocumento::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $tipo=new TipoDocumento($datos[$i], null);
            $lista[$i]=$tipo;
        }
        return $lista;
    }

	function getRutaDocumento($nitCliente,$ideTipo){
		$cadenaSQL="select ruta from documentoGestion where ideTipo={$ideTipo} and nitCliente='{$nitCliente}'";
		$resultado=ConectorBD::ejecutarQuery($cadenaSQL, null);
		$ruta='';
		if ($resultado!=null){
			return $ruta=$resultado[0][0];
			echo $ruta;
		}
		else{
 			return $ruta=null;
		} 
	}
//llaves foraneas
	function getDocumentoGestion(){
		return new DocumentoGestion('ideTipo',$this->ide);
	}
}
