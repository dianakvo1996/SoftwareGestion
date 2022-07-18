<?php
class Repuesto {
    private $ide;
    private $detalle;
    private $referencia;
    private $cantidad;
    private $numeroPreventivo;
    private $numeroCorrectivo;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))
                $this->cargarAtributos($campo);
            else {
                $cadenaSQL="select * from repuesto where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)
                    $this->cargarAtributos ($resultado[0]);
            }
        }
    }
   
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide']; 
        $this->detalle=$datos['detalle']; 
        $this->referencia=$datos['referencia']; 
        $this->cantidad=$datos['cantidad']; 
        $this->numeroPreventivo=$datos['numeropreventivo']; 
        $this->numeroCorrectivo=$datos['numerocorrectivo']; 
    }
    function getIde() {
        return $this->ide;
    }

    function getDetalle() {
        return $this->detalle;
    }

    function getReferencia() {
        return $this->referencia;
    }

    function getCantidad() {
        return $this->cantidad;
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

    function setDetalle($detalle) {
        $this->detalle = $detalle;
    }

    function setReferencia($referencia) {
        $this->referencia = $referencia;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }
    function adicionarPreventivo() {
        $cadenaSQL="insert into repuesto(detalle,referencia,cantidad,numeroPreventivo)values('{$this->detalle}','{$this->referencia}',{$this->cantidad},'{$this->numeroPreventivo}')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function adicionarCorrectivo() {
        $cadenaSQL="insert into repuesto(detalle,referencia,cantidad,numeroCorrectivo)values('{$this->detalle}','{$this->referencia}',{$this->cantidad},'{$this->numeroCorrectivo}')";
        echo $cadenaSQL;
        ConectorBD::ejecutarQuery($cadenaSQL, null);
        echo $cadenaSQL;
    }
    function modificar() {
        $cadenaSQL="update repuesto set detalle='{$this->detalle}', referencia='{$this->referencia}', cantidad='{$this->cantidad}' where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminar() {
        $cadenaSQL="delete from repuesto where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from repuesto";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= Repuesto::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $repuesto=new Repuesto($datos[$i], null);
            $lista[$i]=$repuesto;
        }
        return $lista;
    }
}