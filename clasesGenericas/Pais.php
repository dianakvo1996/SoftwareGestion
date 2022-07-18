<?php
require_once dirname(__FILE__). '/ConectorBD.php';

class Pais {
    private $codigo;
    private $nombre;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))$this->cargarAtributos($campo);
            else{
                $cadenaSQL="select * from pais where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0) 
                    $this->cargarAtributos($resultado[0]);
            }
        }
    }
    
    private function cargarAtributos($datos) {
        $this->codigo=$datos['codigo'];
        $this->nombre=$datos['nombre'];
    }
    
    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    

    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from pais ";
        if ($filtro!=null)$cadenaSQL." where $filtro";
        if ($orden!=null)$cadenaSQL." order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= Pais::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $pais=new Pais($datos[$i], null);
            $lista[$i]=$pais;
        }
        return $lista;
    }
    public static function getPaisEnOptions($predeterminado) {
        $paises= Pais::getDatosEnObjetos(null, 'nombre');
        $lista='<option>--Selecccione--</option>';
        for ($i = 0; $i < count($paises); $i++) {
            $pais=$paises[$i];
            if ($predeterminado==$pais->getCodigo()) $auxiliar="selected";
            else $auxiliar='';
            $lista.="<option value='{$pais->getCodigo()}' {$auxiliar}>{$pais->getNombre()}</option>";
        }
        return $lista;
    }
}
