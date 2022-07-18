<?php

require_once dirname(__FILE__) . '/../clasesGenericas/Ciudad.php';
class Sede {
    private $ide;
    private $nombre;
    private $nitCliente;
    private $codCiudad;
	private $baja;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))
                $this->cargarAtributos($campo);
            else{
                $cadenaSQL="select * from sede where $campo=$valor";
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
		$this->baja=$datos['baja'];
    }
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
	function getBaja() {
        return $this->baja;
    }

    function setCodCiudad($codCiudad) {
        $this->codCiudad = $codCiudad;
    }
    
    function getCiudad() {
        return new Ciudad('codigo', "'{$this->codCiudad}'");
    }
    
    function getCliente() {
        return new Cliente('nit',"'".$this->nitCliente."'");
    }
    function getCronogramaCalibracion() {
        return new CronogramaCalibracion('ideSede', $this->ide);
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
	function setBaja($baja) {
        $this->baja= $baja;
    }
    

    function adicionar() {
        $cadenaSQL="insert into sede(nombre,nitCliente,codCiudad) values ('{$this->nombre}','{$this->nitCliente}','{$this->codCiudad}');";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    function modificar() {
        $cadenaSQL="update sede set nombre='{$this->nombre}', nitCliente='{$this->nitCliente}', codCiudad='{$this->codCiudad}' where ide=$this->ide";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    function eliminar() {
        $cadenaSQL="delete from sede where ide=$this->ide";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from sede";
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
    public static function getSedesOptions($filtro) {
        $sedes= Sede::getDatosEnObjetos($filtro, 'nombre');
        $lista='';
        for ($i = 0; $i < count($sedes); $i++) {
            $sede=$sedes[$i];
            $lista.="<option value='{$sede->getIde()}'>{$sede->getNombre()}</option>";
        }
        return $lista;
    }
    
    public static function getConsultaCombinada($condicionExtra,$orden) {
        $cadenaSQL="select ide,sede.nombre,nitCliente,codCiudad,baja from sede,ciudad where codCiudad=ciudad.codigo ";
        if ($condicionExtra!=null)$cadenaSQL.=" and $condicionExtra";
        if ($orden!=null)$cadenaSQL.=" order by $orden";

        $datos= ConectorBD::ejecutarQuery($cadenaSQL, null);
        $lista=array();
        for ($h = 0; $h < count($datos); $h++) {
            $sede=new Sede($datos[$h], null);
            $lista[$h]=$sede;
        }
        return $lista;        
    }
}
