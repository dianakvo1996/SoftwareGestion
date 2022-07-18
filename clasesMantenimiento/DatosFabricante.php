<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DatosFabricante
 *
 * @author Diana Valencia
 */

require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';

class DatosFabricante {
	private $ide;
	private $tipo;
	private $nombre;
	private $telefono;
	private $direccion;
	private $email;
	private $lugarOrigen;
	
    function __construct($campo,$valor) {
        if ($campo!= null) {
            if (is_array($campo))
                $this->cargarAtributos($campo);
            else{
                $cadenaSQL="select * from datosFabricante where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0)
                    $this->cargarAtributos($resultado[0]);
            }         
        }
    }
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->tipo=$datos['tipo'];
        $this->nombre=$datos['nombre'];
        $this->telefono=$datos['telefono'];
        $this->direccion=$datos['direccion'];
        $this->email=$datos['email'];
        $this->lugarOrigen=$datos['lugarorigen'];
    }
	
    function getIde() {
        return $this->ide;
    }	
	
    function getTipo() {
        return $this->tipo;
    }
	
    function getNombre() {
        return $this->nombre;
    }
	
    function getTelefono() {
        return $this->telefono;
    }
	
    function getDireccion() {
        return $this->direccion;
    }	
	
    function getEmail() {
        return $this->email;
    }

    function getLugarOrigen() {
        return $this->lugarOrigen;
    }

    function getSede() {
        return $this->sede;
    }
    
    function setIde($ide) {
        $this->ide = $ide;
    }
	
    function setTipo($tipo) {
        $this->tipo = $tipo;
    }
	
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
	
    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
	
    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }
	
    function setEmail($email) {
        $this->email = $email;
    }
	
    function setLugarOrigen($lugarOrigen) {
        $this->lugarOrigen = $lugarOrigen;
    }
	
	function getTipoLista(){
		if($this->tipo=='F')
			$lista='FABRICANTE';
		else
			$lista='PROVEEDOR';

	return $lista;
	}
	function getTipoRadio(){
		$lista='';
		switch($this->tipo){
			case 'F':
				$lista.="<label><input type='radio' name='tipo' value='F' class='radio' title='tipo' onchange='MostrarOpciones()' required checked>FABRICANTE</label>";
				$lista.="<label><input type='radio' name='tipo' value='P' class='radio' title='tipo' onchange='MostrarOpciones()'>PROVEEDOR</label>";
				break;
			case 'P':
				$lista.='<label><input type="radio" name="tipo" value="F" class="radio" title="tipo" onchange="MostrarOpciones()" required>FABRICANTE</label>';
				$lista.='<label><input type="radio" name="tipo" value="P" class="radio" title="tipo" onchange="MostrarOpciones()" checked>PROVEEDOR</label>';
				break;
			default:
				$lista.='<label><input type="radio" name="tipo" value="F" class="radio" title="tipo" onchange="MostrarOpciones()" required>FABRICANTE</label>';
				$lista.='<label><input type="radio" name="tipo" value="P" class="radio" title="tipo" onchange="MostrarOpciones()">PROVEEDOR</label>';
				break;

		}
	return $lista;
	}

    function grabar() {
        $cadenaSQL="insert into datosFabricante(tipo,nombre,telefono,direccion,email,lugarOrigen) values('{$this->tipo}','{$this->nombre}','{$this->telefono}','{$this->direccion}',{$this->email},{$this->lugarOrigen})";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificar() {
        $cadenaSQL="update datosFabricante set tipo='{$this->tipo}', nombre='{$this->nombre}', telefono='{$this->telefono}',  direccion='{$this->direccion}', email={$this->email}, lugarOrigen={$this->lugarOrigen} where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminar() {
        $cadenaSQL="delete from datosFabricante where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from datosFabricante";
        if ($filtro!=null) $cadenaSQL.=" where $filtro";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= DatosFabricante::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $fabricante=new DatosFabricante($datos[$i], null);
            $lista[$i]=$fabricante;
        }
        return $lista;
    }

	public static function getProveedoresJS(){
		$datos="var proveedores=new Array();\n";
		$proveedores = DatosFabricante::getDatosEnObjetos("tipo='P'","nombre");
        for ($i = 0; $i < count($proveedores); $i++) {
			$proveedor=$proveedores[$i];
			$datos.="proveedores[$i]=new Array();\n";
			$datos.="\tproveedores[$i][0]='{$proveedor->getIde()}'\n";
			$datos.="\tproveedores[$i][1]='{$proveedor->getNombre()}'\n";
			$datos.="\tproveedores[$i][2]='{$proveedor->getTelefono()}'\n";
			$datos.="\tproveedores[$i][3]='{$proveedor->getDireccion()}'\n";
			$datos.="\tproveedores[$i][4]='{$proveedor->getEmail()}'\n";		
		}
		return $datos;
	}

	public static function getFabricantesJS(){
		$datos="var fabricantes=new Array();\n";
		$fabricantes = DatosFabricante::getDatosEnObjetos("tipo='F'","nombre");
        for ($i = 0; $i < count($fabricantes); $i++) {
			$fabricante=$fabricantes[$i];
			$datos.="fabricantes[$i]=new Array();\n";
			$datos.="\tfabricantes[$i][0]='{$fabricante->getIde()}'\n";
			$datos.="\tfabricantes[$i][1]='{$fabricante->getNombre()}'\n";
			$datos.="\tfabricantes[$i][2]='{$fabricante->getTelefono()}'\n";
			$datos.="\tfabricantes[$i][3]='{$fabricante->getDireccion()}'\n";
			$datos.="\tfabricantes[$i][4]='{$fabricante->getLugarOrigen()}'\n";
		}
		return $datos;
	}

}