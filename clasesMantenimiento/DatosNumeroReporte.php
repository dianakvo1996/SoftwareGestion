<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DatosNumeroReporte
 *
 * @author Adriana
 */
class DatosNumeroReporte {
    private $ide;
    private $anioActual;
    
    function __construct($campo, $valor) {
        if ($campo!=null) {
            if (is_array($campo)) {
                $this->cargarAtributos($campo);
            }
            else {
                $cadenaSQL="select * from datosNumeroReporte where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0){
                    $this->cargarAtributos($resultado[0]);
                }
            }
        }
    }
    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->anioActual=$datos['anioactual'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getAnioActual() {
        return $this->anioActual;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setAnioActual($anioActual) {
        $this->anioActual = $anioActual;
    }

    function modificar() {
        $cadenaSQL="update datosNumeroReporte set anioActual='{$this->anioActual}'";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from datosNumeroReporte";
        if ($filtro!=null) $cadenaSQL.=" where $filtro";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos = DatosNumeroReporte::getDatos($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($datos); $i++) {
            $datosNumeroReporte=new DatosNumeroReporte($datos[$i], null);
            $lista[$i]=$datosNumeroReporte;
        }
        return $lista;
    }
//revisar funcion 
    public static function generarNumeroReporte($ultimoNumeroReporte) {
        date_default_timezone_set('America/Bogota');
        $datos=new DatosNumeroReporte('ide', '1');
        $anioGuardado=$datos->getAnioActual();
        $anioActual= date('y');
        
        $numeroConsecutivo = substr($ultimoNumeroReporte, 2); 
        $numeroReporte=$numeroConsecutivo+1;
        if ($anioGuardado!=$anioActual) {
            ConectorBD::ejecutarQuery("update datosNumeroReporte set anioActual={$anioActual}", null);
            $numeroReporte='1';
        }       
        switch (strlen($numeroReporte)) {
            case 1:
                $nuevoNumeroReporte='00'.$numeroReporte;
                break;
            case 2:
                $nuevoNumeroReporte='0'.$numeroReporte;
                break;
            
            default:
                $nuevoNumeroReporte=$numeroReporte;
                break;
        }
        return $anioActual.$nuevoNumeroReporte;
    }
    //revisar funcion
}
