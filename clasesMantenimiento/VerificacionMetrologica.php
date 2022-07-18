<?php
class VerificacionMetrologica {
    private $ide;
    private $valorNominal;
    private $valorMedido;
    private $ideUnidadMedida;
    private $numeroPreventivo;
    private $numeroCorrectivo;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo)){
                $this->cargarAtributos($campo);            
            }
            else {
                $cadenaSQL="select * from verificacionMetrologica where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)
                    $this->cargarAtributos($resultado[0]);
            }
        }
    }    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->valorNominal=$datos['valornominal'];
        $this->valorMedido=$datos['valormedido'];
        $this->ideUnidadMedida=$datos['ideunidadmedida'];
        $this->numeroCorrectivo=$datos['numerocorrectivo'];
        $this->numeroPreventivo=$datos['numeropreventivo'];
    }
    function getIde() {
        return $this->ide;
    }

    function getValorNominal() {
        return $this->valorNominal;
    }

    function getValorMedido() {
        return $this->valorMedido;
    }

    function getIdeUnidadMedida() {
        return $this->ideUnidadMedida;
    }
    function getNumeroPreventivo() {
        return $this->numeroPreventivo;
    }

    function getNumeroCorrectivo() {
        return $this->numeroCorrectivo;
    }

    function setNumeroPreventivo($numeroPreventivo) {
        $this->numeroPreventivo = $numeroPreventivo;
    }

    function setNumeroCorrectivo($numeroCorrectivo) {
        $this->numeroCorrectivo = $numeroCorrectivo;
    }

    
    function setIde($ide) {
        $this->ide = $ide;
    }

    function setValorNominal($valorNominal) {
        $this->valorNominal = $valorNominal;
    }

    function setValorMedido($valorMedido) {
        $this->valorMedido = $valorMedido;
    }

    function setIdeUnidadMedida($ideUnidadMedida) {
        $this->ideUnidadMedida = $ideUnidadMedida;
    }
//Inicio llaves foraneas
    function getUnidadMedida() {
        return new UnidadMedida('ide', $this->ideUnidadMedida);
    }
    function getReportePreventivo() {
        return new ReportePreventivo('numeroReporte',"'".$this->numeroReporte."'");
    }
    function getReporteCorrectivo() {
        return new ReporteCorrectivo('numeroReporte',"'".$this->numeroReporte."'");
    }
//fin llaves foraneas
    function adicionarPreventivo() {
        $cadenaSQL="insert into verificacionMetrologica(ideUnidadMedida, valorNominal, valorMedido, numeroPreventivo) values("
                . "{$this->ideUnidadMedida},{$this->valorNominal},{$this->valorMedido},{$this->numeroPreventivo})";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
        echo $cadenaSQL;
    }
    function adicionarCorrectivo() {
        $cadenaSQL="insert into verificacionMetrologica(ideUnidadMedida, valorNominal, valorMedido, numeroCorrectivo) values("
                . "{$this->ideUnidadMedida},{$this->valorNominal},{$this->valorMedido},{$this->numeroCorrectivo})";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificar() {
        $cadenaSQL="update verificacionMetrologica set ideUnidadMedida={$this->ideUnidadMedida},valorNominal={$this->valorNominal},valorMedido={$this->valorMedido} where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatos($filtro, $orden) {
        $cadenaSQL="select * from verificacionMetrologica ";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }  
    public static function getDatosEnObjetos($filtro, $orden) {
        $datos = VerificacionMetrologica::getDatos($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($datos); $i++) {
            $verificacion = new VerificacionMetrologica($datos[$i], null);
            $lista[$i] = $verificacion;
        }
        return $lista;
    }
}