<?php
class Mes {
    private $ide;
    private $nombre;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))
                $this->cargarAtributos($campo);
            else {
                $cadenaSQL="select ide, nombre from mes where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)
                    $this->cargarAtributos ($resultado[0]);
            }
        }
    }
 
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->nombre=$datos['nombre'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select ide, nombre from mes";
        if ($filtro!=null) $cadenaSQL.=" where $filtro";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= Mes::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $mes=new Mes($datos[$i], null);
            $lista[$i]=$mes;
        }
        return $lista;
    }
    public static function mesEnOptions($predeterminado) {
        $meses= Mes::getDatosEnObjetos(null, 'ide');
        $lista='<option>--Seleccione--</option>';
        for ($i = 0; $i < count($meses); $i++) {
            $mes=$meses[$i];
            if ($predeterminado==$mes->getIde()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$mes->getIde()}' {$auxiliar}>{$mes->getNombre()}</option>";
        }    
        return $lista;
    }
}