<?php
require_once dirname(__FILE__). '/ConectorBD.php';
require_once dirname(__FILE__). '/Pais.php';

class Departamento {
    private $codigo;
    private $nombre;
    private $codPais;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))$this->cargarAtributos ($campo);
            else{
                $cadenaSQL="select * from departamento where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)$this->cargarAtributos ($resultado[0]);
            }
        }
    }
    
    private function cargarAtributos($datos) {
        $this->codigo=$datos['codigo'];
        $this->nombre=$datos['nombre'];
        $this->codPais=$datos['codpais'];
    }
    
    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getCodPais() {
        return $this->codPais;
    }
    
    function getPais() {
        return new Pais('codigo',"'".$this->codPais."'");
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setCodPais($codPais) {
        $this->codPais = $codPais;
    }

    public static function getDatos($filtro, $orden) {
        $cadenaSQL="select * from departamento ";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= Departamento::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $departamento=new Departamento($datos[$i], null);
            $lista[$i]=$departamento;
        }
        return $lista;
    }
    
    public static function getDepartamentosEnOptions($predeterminado) {
        $departamentos= Departamento::getDatosEnObjetos(null, 'nombre');
        $lista='<option>--Selecccione--</option>';
        for ($i = 0; $i < count($departamentos); $i++) {
            $departamento=$departamentos[$i];
            if ($predeterminado==$departamento->getCodigo()) $auxiliar="selected";
            else $auxiliar='';
            $lista.="<option value='{$departamento->getCodigo()}' {$auxiliar}>{$departamento->getNombre()}</option>";
        }
        return $lista;
    }
    
    public  static function getDatosEnArreglosJS(){
        $datos="var departamentos=new Array();\n";
        $departamentos= Departamento::getDatosEnObjetos(null, "nombre");
        for ($i = 0; $i < count($departamentos); $i++) {
            $departamento=$departamentos[$i];
            $datos.="departamentos[$i]=new Array();\n";
            $datos.="\tdepartamentos[$i][0]='{$departamento->getCodigo()}'\n";
            $datos.="\tdepartamentos[$i][1]='{$departamento->getNombre()}'\n";
            $datos.="\tdepartamentos[$i][2]='{$departamento->getcodPais()}'\n";
        }
        return $datos;
    }
}
