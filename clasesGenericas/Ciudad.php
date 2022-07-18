<?php
require_once dirname(__FILE__). '/ConectorBD.php';
require_once dirname(__FILE__). '/Departamento.php';

class Ciudad {
    private $codigo;
    private $nombre;
    private $codDepartamento;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))$this->cargarAtributos ($campo);
            else {
                $cadenaSQL="select * from ciudad where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)$this->cargarAtributos ($resultado[0]);
            }
        }
    }
    
    private function cargarAtributos($datos) {
        $this->codigo=$datos['codigo'];
        $this->nombre=$datos['nombre'];
        $this->codDepartamento=$datos['coddepartamento'];
    }
    
    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getCodDepartamento() {
        return $this->codDepartamento;
    }
    function getDepartamento() {
        return new Departamento('codigo',"'{$this->codDepartamento}'");
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setCodDepartamento($codDepartamento) {
        $this->codDepartamento = $codDepartamento;
    }

    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from ciudad ";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= Ciudad::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $ciudad=new Ciudad($datos[$i], null);
            $lista[$i]=$ciudad;
        }
        return $lista;
    }
    
    public static function getCiudadesEnOptions($predeterminado,$codDepartamento) {
        $ciudades= Ciudad::getDatosEnObjetos(null, 'nombre');
        $lista='<option>--Selecccione--</option>';
        for ($j = 0; $j < count($ciudades); $j++) {
            $ciudad=$ciudades[$j];
            if ($predeterminado==$ciudad->getCodigo())$auxiliar="selected";
            else $auxiliar='';
            $lista.="<option value='{$ciudad->getCodigo()}' {$auxiliar}>{$ciudad->getNombre()}</option>";
        }
        return $lista;
    }
    
    public static function getDatosEnArreglosJS() {
        $datos = "var ciudades=new Array();\n";
        $ciudades = Ciudad::getDatosEnObjetos(null, "nombre");
        for ($i = 0; $i < count($ciudades); $i++) {
            $ciudad = $ciudades[$i];
            $datos .= "ciudades[$i]=new Array();\n";
            $datos .= "\tciudades[$i][0]='{$ciudad->getCodigo()}'\n";
            $datos .= "\tciudades[$i][1]='{$ciudad->getNombre()}'\n";
            $datos .= "\tciudades[$i][2]='{$ciudad->getcodDepartamento()}'\n";
        }
        return $datos;
    }
}