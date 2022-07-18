<?php
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../clasesGenericas/Ciudad.php';


class Cliente {
    private $nit;
    private $nombre;
    private $direccion;
    private $responsable;
    private $telefono;
    private $usuario;
    private $sede;
    private $codCiudad;
    private $pabon;
    private $baja;

            
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))
                $this->cargarAtributos ($campo);
            else{
                $cadenaSQL="select * from cliente where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0)
                    $this->cargarAtributos ($resultado[0]);
            }
        }
    } 
    private function cargarAtributos($datos) {
        $this->nit=$datos['nit'];
        $this->nombre=$datos['nombre'];
        $this->direccion=$datos['direccion'];
        $this->responsable=$datos['responsable'];
        $this->telefono=$datos['telefono'];
        $this->usuario=$datos['usuario'];
        $this->sede=$datos['sede'];
        $this->codCiudad=$datos['codciudad'];
		$this->pabon=$datos['pabon'];
		$this->baja=$datos['baja'];
    } 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
    function getNit() {
        return $this->nit;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getResponsable() {
        return $this->responsable;
    }

    function getTelefono() {
        return $this->telefono;
    }
    function getCronogramaCalibracion() {
        return new CronogramaCalibracion('nitCliente', "'".$this->nit."'");
    }
    function getSede() {
        return $this->sede;
    }
    function getPabon() {
        return $this->pabon;
    }

    function getBaja() {
        return $this->baja;
    }

    function getSedeRadio() {
        $radio='';
        switch ($this->sede) {
            case 'S':$radio.='<input type="radio" name="sede"  id="sede" value="S" onchange="habilitar()" checked>Si<input type="radio" id="sede" name="sede" value="N" onchange="habilitar()">No';
                break;
            case 'N':$radio.='<input type="radio" name="sede" id="sede" value="S" onchange="habilitar()">Si<input type="radio" id="sede" name="sede" value="N" onchange="habilitar()" checked>No';
                break;
            default:$radio.='<input type="radio" name="sede" id="sede" value="S" onchange="habilitar()">Si<input type="radio" id="sede" name="sede" value="N" onchange="habilitar()">No';
                break;
        }
        return $radio;
    }
    
    function getUsuario() {
        return $this->usuario;
    }
    function getCodCiudad() {
        return $this->codCiudad;
    }
    
    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setNit($nit) {
        $this->nit = $nit;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setResponsable($responsable) {
        $this->responsable = $responsable;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setSede($sede) {
        $this->sede = $sede;
    }
    function setCodCiudad($codCiudad) {
        $this->codCiudad = $codCiudad;
    }
    function setPabon($pabon) {
        $this->pabon = $pabon;
    }

    function setBaja($baja) {
        $this->baja= $baja;
    }
    
    function setBd($bd) {
        $this->bd = $bd;
    }
    //Llaves foraneas
    function getCiudad() {
        return new Ciudad('codigo', "'".$this->codCiudad."'");
    }
    //Inicio Llaves foraneas

    function grabar() {
        $cadenaSQL="insert into cliente(nit,nombre,direccion,responsable,telefono,sede,usuario,codCiudad,pabon) values('{$this->nit}','{$this->nombre}','{$this->direccion}','{$this->responsable}','{$this->telefono}','{$this->sede}','{$this->usuario}','{$this->codCiudad}','{$this->pabon}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificar($nitAnterior) {
        $cadenaSQL="update cliente set nit='{$this->nit}',nombre='{$this->nombre}', direccion='{$this->direccion}',responsable='{$this->responsable}',telefono='{$this->telefono}',sede='{$this->sede}', usuario='{$this->usuario}', codCiudad='{$this->codCiudad}', pabon='{$this->pabon}' where nit='{$nitAnterior}'";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminar() {
        $cadenaSQL="delete from cliente where nit='{$this->nit}'";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from cliente";
        if ($filtro!=null) $cadenaSQL.=" where $filtro";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= Cliente::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $cliente=new Cliente($datos[$i], null);
            $lista[$i]=$cliente;
        }
        return $lista;
    }
    public static function consultaCombinada($condicionExtra,$orden) {
        $cadenaSQL="select nit, cliente.nombre,direccion,responsable,telefono, sede,usuario,codCiudad,pabon,baja  from cliente,ciudad where codCiudad=ciudad.codigo ";
        if ($condicionExtra!=null)$cadenaSQL.=" and $condicionExtra";
        if ($orden!=null)$cadenaSQL.=" order by $orden";
        $datos= ConectorBD::ejecutarQuery($cadenaSQL, null);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $cliente=new Cliente($datos[$i], null);
            $lista[$i]=$cliente;
        }
        return $lista;
    }
}
