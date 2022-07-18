<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegistroApoyoTecnico
 *
 * @author BIOMETRICAL
 */
class RegistroApoyoTecnico {
    private $ide;
    private $ideEquipo;
    private $manuales;
    private $planos;
    private $usos;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))$this->cargarAtributos($campo);
            else{
                $cadenaSQL="select * from registroApoyoTecnico where $campo = $valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)$this->cargarAtributos ($resultado[0]);
            }
        }
    }
    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->ideEquipo=$datos['ideequipo'];
        $this->manuales=$datos['manuales'];
        $this->planos=$datos['planos'];
        $this->usos=$datos['usos'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getIdeEquipo() {
        return $this->ideEquipo;
    }

    function getManuales() {
        return $this->manuales;
    }

    function getPlanos() {
        return $this->planos;
    }

    function getUsos() {
        return $this->usos;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setIdeEquipo($ideEquipo) {
        $this->ideEquipo = $ideEquipo;
    }

    function setManuales($manuales) {
        $this->manuales = $manuales;
    }

    function setPlanos($planos) {
        $this->planos = $planos;
    }

    function setUsos($usos) {
        $this->usos = $usos;
    }

    public static function getDatos($filtro, $orden) {
        $cadenaSQL="select * from registroApoyoTecnico";
        if ($filtro!=null)$cadenaSQL." where $filtro";
        if ($orden!=null)$cadenaSQL." order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos = RegistroApoyoTecnico::getDatos($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($datos); $i++) {
            $registro=new RegistroApoyoTecnico($datos[$i], null);
            $lista[$i]=$registro;
        }
        return $lista;
    }
    
    // funciones checks, options, listas
    function getManualesOption() {
        $check="";
        switch ($this->manuales) {
            case 'O'://Operaciones
                $check.="<section><label><input type='radio' name='manuales' value='O' id='operacion' required checked>OPERACION</label></section>";
                $check.="<section><label><input type='radio' name='manuales' value='S' id='servicio'>SERVICIO</label></section>";
                $check.="<section><label><input type='radio' name='manuales' value='P' id='partes'>PARTES</label></section>";
                $check.="<section><label><input type='radio' name='manuales' value='D' id='despieces'>DESPIECES</label></section>";
                break;
            case 'S'://Servicio
                $check.="<section><label><input type='radio' name='manuales' value='O' id='operacion' required>OPERACION</label></section>";
                $check.="<section><label><input type='radio' name='manuales' value='S' id='servicio' checked>SERVICIO</label></section>";
                $check.="<section><label><input type='radio' name='manuales' value='P' id='partes'>PARTES</label></section>";
                $check.="<section><label><input type='radio' name='manuales' value='D' id='despieces'>DESPIECES</label></section>";
                break;
            case 'P'://Partes
                $check.="<section><label><input type='radio' name='manuales' value='O' id='operacion' required>OPERACION</label></section>";
                $check.="<section><label><input type='radio' name='manuales' value='S' id='servicio'>SERVICIO</label></section>";
                $check.="<section><label><input type='radio' name='manuales' value='P' id='partes' checked>PARTES</label></section>";
                $check.="<section><label><input type='radio' name='manuales' value='D' id='despieces'>DESPIECES</label></section>";
                break;
            case 'D'://Despieces
                $check.="<section><label><input type='radio' name='manuales' value='O' id='operacion' required>OPERACION</label></section>";
                $check.="<section><label><input type='radio' name='manuales' value='S' id='servicio'>SERVICIO</label></section>";
                $check.="<section><label><input type='radio' name='manuales' value='P' id='partes'>PARTES</label></section>";
                $check.="<section><label><input type='radio' name='manuales' value='D' id='despieces' checked>DESPIECES</label></section>";
                break;
            default:
                $check.="<section><label><input type='radio' name='manuales' value='O' id='operacion' required>OPERACION</label></section>";
                $check.="<section><label><input type='radio' name='manuales' value='S' id='servicio'>SERVICIO</label></section>";
                $check.="<section><label><input type='radio' name='manuales' value='P' id='partes'>PARTES</label></section>";
                $check.="<section><label><input type='radio' name='manuales' value='D' id='despieces'>DESPIECES</label></section>";
                break;
        }
        return $check;
    }
    
    function getPlanosOption() {
        $option="";
        switch ($this->planos) {
            case 'EL'://electricos
                $option.="<section><label><input type='radio' name='planos' value='EL' checked>ELECTRICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='EC'>ELECTRONICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='H'>HIDRAULICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='N'>NEUMATICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='M'>MECANICOS</label></section>";
                break;
            case 'EC'://electronicos
                $option.="<section><label><input type='radio' name='planos' value='EL'>ELECTRICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='EC' checked>ELECTRONICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='H'>HIDRAULICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='N'>NEUMATICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='M'>MECANICOS</label></section>";
                break;
            case 'H'://Hidraulicos
                $option.="<section><label><input type='radio' name='planos' value='EL'>ELECTRICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='EC'>ELECTRONICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='H' checked>HIDRAULICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='N'>NEUMATICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='M'>MECANICOS</label></section>";
                break;
            case 'N'://Neumaticos
                $option.="<section><label><input type='radio' name='planos' value='EL'>ELECTRICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='EC'>ELECTRONICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='H'>HIDRAULICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='N' checked>NEUMATICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='M'>MECANICOS</label></section>";
                break;
            case 'M'://Mecanicos
                $option.="<section><label><input type='radio' name='planos' value='EL'>ELECTRICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='EC'>ELECTRONICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='H'>HIDRAULICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='N'>NEUMATICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='M' checked>MECANICOS</label></section>";
                break;
            default:
                $option.="<section><label><input type='radio' name='planos' value='EL'>ELECTRICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='EC'>ELECTRONICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='H'>HIDRAULICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='N'>NEUMATICOS</label></section>";
                $option.="<section><label><input type='radio' name='planos' value='M'>MECANICOS</label></section>";
                break;
        }
        return $option;
    }
    
    function getUsosOption() {
        $option="";
        switch ($this->usos) {
            case 'M'://Medio
                $option.="<section><label><input type='radio' name='usos' value='M' checked>MEDICO</label></section>";
                $option.="<section><label><input type='radio' name='usos' value='B'>BASICO</label></section>";
                $option.="<section><label><input type='radio' name='usos' value='A'>APOYO</label></section>";
                break;
            case 'B'://Basico
                $option.="<section><label><input type='radio' name='usos' value='M'>MEDICO</label></section>";
                $option.="<section><label><input type='radio' name='usos' value='B' checked>BASICO</label></section>";
                $option.="<section><label><input type='radio' name='usos' value='A'>APOYO</label></section>";
                break;
            case 'A'://Apoyo
                $option.="<section><label><input type='radio' name='usos' value='M'>MEDICO</label></section>";
                $option.="<section><label><input type='radio' name='usos' value='B'>BASICO</label></section>";
                $option.="<section><label><input type='radio' name='usos' value='A' checked>APOYO</label></section>";
                break;
            default:
                $option.="<section><label><input type='radio' name='usos' value='M'>MEDICO</label></section>";
                $option.="<section><label><input type='radio' name='usos' value='B'>BASICO</label></section>";
                $option.="<section><label><input type='radio' name='usos' value='A'>APOYO</label></section>";
                break;
        }
        return $option;
    }

	function getManualesLista(){
        $check="";
        switch ($this->manuales) {
            case 'O'://Operaciones
                $check.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> OPERACION</label></section>";
                $check.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> SERVICIO</label></section>";
                $check.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> PARTES</label></section>";
                $check.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> DESPIECES</label></section>";
                break;
            case 'S'://Servicio
                $check.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> OPERACION</label></section>";
                $check.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> SERVICIO</label></section>";
                $check.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> PARTES</label></section>";
                $check.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> DESPIECES</label></section>";
				break;
            case 'P'://Partes
                $check.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> OPERACION</label></section>";
                $check.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> SERVICIO</label></section>";
                $check.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> PARTES</label></section>";
                $check.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> DESPIECES</label></section>";
                break;
            case 'D'://Despieces
                $check.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> OPERACION</label></section>";
                $check.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> SERVICIO</label></section>";
                $check.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> PARTES</label></section>";
                $check.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> DESPIECES</label></section>";
                break;
            default:
                $check.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> OPERACION</label></section>";
                $check.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> SERVICIO</label></section>";
                $check.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> PARTES</label></section>";
                $check.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> DESPIECES</label></section>";
                break;
        }
        return $check;

	}
	function getPlanosLista() {
        $option="";
        switch ($this->planos) {
            case 'EL'://electricos
                $option.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> ELECTRICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRONICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> HIDRAULICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NEUMATICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> MECANICOS</label></section>";
                break;
            case 'EC'://electronicos
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> ELECTRONICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> HIDRAULICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NEUMATICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> MECANICOS</label></section>";
                break;
            case 'H'://Hidraulicos
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRONICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> HIDRAULICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NEUMATICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> MECANICOS</label></section>";
                break;
            case 'N'://Neumaticos
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRONICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> HIDRAULICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> NEUMATICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> MECANICOS</label></section>";
                break;
            case 'M'://Mecanicos
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRONICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> HIDRAULICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NEUMATICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> MECANICOS</label></section>";
                break;
            default:
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRONICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> HIDRAULICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NEUMATICOS</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> MECANICOS</label></section>";
                break;
        }
        return $option;
    }


    function getUsoslista() {
        $option="";
        switch ($this->usos) {
            case 'M'://Medio
                $option.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> MEDICO</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> BASICO</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> APOYO</label></section>";
                break;
            case 'B'://Basico
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> MEDICO</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> BASICO</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> APOYO</label></section>";
                break;
            case 'A'://Apoyo
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> MEDICO</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> BASICO</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> APOYO</label></section>";
                break;
            default:
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> MEDICO</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> BASICO</label></section>";
                $option.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> APOYO</label></section>";
                break;
        }
        return $option;
    }

    function adicionar() {
        $cadenaSQL="insert into registroApoyoTecnico(ideEquipo,manuales,planos,usos)values({$this->ideEquipo},'{$this->manuales}','{$this->planos}','{$this->usos}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificar() {
        $cadenaSQL="update registroApoyoTecnico set ideEquipo={$this->ideEquipo}, manuales='{$this->manuales}', planos='{$this->planos}',usos='{$this->usos}' where ideEquipo={$this->ideEquipo}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminar() {
        $cadenaSQL="delete from registroApoyoTecnico where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
}
