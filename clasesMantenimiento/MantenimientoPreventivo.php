<?php
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/TipoEquipo.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/Sede.php';

class MantenimientoPreventivo {
    private $ide;
    private $fecha;
    private $nitCliente;
    private $ideSede;
    private $validar;
    private $generar;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))
                $this->cargarAtributos ($campo);
            else {
                $cadenaSQL="select * from mantenimientoPreventivo where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)
                    $this->cargarAtributos ($resultado[0]);
            }
        }
    }
    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->fecha=$datos['fecha'];
        $this->nitCliente=$datos['nitcliente'];
        $this->ideSede=$datos['idesede'];
        $this->validar=$datos['validar'];
        $this->generar=$datos['generar'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getFecha() {
        return $this->fecha;
    }
    function getMostarFecha() {
        $fecha= explode(' ', $this->fecha)[0];
        return $fecha;
    }

	function getAño(){
		$fecha = explode('-', $this->fecha)[0];
 		return $fecha;
	}

    function getNitCliente() {
        return $this->nitCliente;
    }
    
    function getCliente() {
        return new Cliente('nit',"'{$this->nitCliente}'");
    }
    
    function getIdeSede() {
        return $this->ideSede;
    }
    function getSede() {
        return new Sede('ide', $this->ideSede);
    }
    
    function getValidar() {
        return $this->validar;
    }

    function getGenerar() {
        return $this->generar;
    }

    function setValidar($validar) {
        $this->validar = $validar;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setNitCliente($nitCliente) {
        $this->nitCliente = $nitCliente;
    }

    function setIdeSede($ideSede) {
        $this->ideSede = $ideSede;
    }

    function setGenerar($generar) {
        $this->generar= $generar;
    }
// funciones
	function getGenerarRadio(){
		$lista='';
		switch($this->generar){
			case 'S':
				$lista.="<label><input type='radio' name='generar' value='S' checked>Generar</label>";
				$lista.="<label><input type='radio' name='generar' value='N'>Subir</label>";
			break;
			case 'N':
				$lista.="<label><input type='radio' name='generar' value='S'>Generar</label>";
				$lista.="<label><input type='radio' name='generar' value='N' checked>Subir</label>";
			break;
			default:
				$lista.="<label><input type='radio' name='generar' value='S'>Generar</label>";
				$lista.="<label><input type='radio' name='generar' value='N'>Subir</label>";
			break;
		}
	return $lista;
	}

//laves foraneas
	function getSedeClase(){
		return new Sede('ide',$this->ideSede);
	}
    function adicionarCliente() {
        $cadenaSQL="insert into mantenimientoPreventivo(fecha,nitCliente,validar,generar)values('{$this->fecha}','{$this->nitCliente}','{$this->validar}','{$this->generar}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function adicionarSede() {
        $cadenaSQL="insert into mantenimientoPreventivo(fecha,ideSede,validar,generar)values('{$this->fecha}',{$this->ideSede},'{$this->validar}','{$this->generar}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificar() {
       $cadenaSQL="update mantenimientoPreventivo set fecha='{$this->fecha}', validar='{$this->validar}', generar='{$this->generar}' where ide={$this->ide}";
       ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminar() {
       $cadenaSQL="delete from mantenimientoPreventivo where ide={$this->ide}";
       ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from mantenimientoPreventivo";
        if ($filtro!=null) $cadenaSQL.=" where $filtro";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= MantenimientoPreventivo::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $mantenimiento=new MantenimientoPreventivo($datos[$i],null);
            $lista[$i]=$mantenimiento;
        }
    return $lista;        
    }

}
