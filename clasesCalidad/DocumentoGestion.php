<?php
require_once dirname(__FILE__) . '/../clasesCalidad/TipoDocumento.php';
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';


class DocumentoGestion {
    private $ide;
    private $nitCliente;
    private $ideTipo;
    private $ruta;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))$this->cargarAtributos($campo);
            else {
                $cadenaSQL="select * from documentoGestion where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)$this->cargarAtributos($resultado[0]);
            }
        }
    }
    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->nitCliente=$datos['nitcliente'];
        $this->ideTipo=$datos['idetipo'];
        $this->ruta=$datos['ruta'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getNitCliente() {
        return $this->nitCliente;
    }

    function getIdeTipo() {
        return $this->ideTipo;
    }

    function getRuta() {
        return $this->ruta;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setNitCliente($nitCliente) {
        $this->nitCliente = $nitCliente;
    }

    function setIdeTipo($ideTipo) {
        $this->ideTipo = $ideTipo;
    }

    function setRuta($ruta) {
        $this->ruta = $ruta;
    }

	function getTipoDocumento(){
		return new TipoDocumento('ide',$this->ideTipo);
	}

    function adicionar() {
        $cadenaSQL="insert into documentoGestion(nitCliente,ideTipo,ruta)values('{$this->nitCliente}',{$this->ideTipo},'{$this->ruta}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    function modificar() {
        $cadenaSQL="update documentoGestion set ruta='{$this->ruta}' where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminar() {
        $cadenaSQL="delete from documentoGestion where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from documentoGestion";
        if ($filtro!=null)$cadenaSQL=" where $filtro";
        if ($orden!=null)$cadenaSQL=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos = DocumentoGestion::getDatos($filtro, $orden);
        $lista =array();
        for ($i = 0; $i < count($datos); $i++) {
            $documento=new DocumentoGestion($datos[$i], null);
            $lista[$i]=$documento;
        }
        return $lista;
    }
}
