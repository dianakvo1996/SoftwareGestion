<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VariablesSuceptiblesCalibracion
 *
 * @author Diana V
 */
class VariablesSuceptiblesCalibracion {
    private $ide;
    private $ideEquipo;
    private $presion;
    private $temperatura;
    private $volumen;
    private $impendancia;
    private $marcapasos;
    private $respiracion;
    private $gCardiaco;
    private $IBP;
    private $energia;
    private $NIBP;
    private $tiempo;
    private $Co2;
    private $Co;
    private $RPM;
    private $HR;
    private $flujo;
    private $FC;
    private $ECG;
    private $SpO2;
    private $peso;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))$this->cargarAtributos($campo);
                else{
                    $cadenaSQL = "select * from VariablesSuceptiblesCalibracion where $campo=$valor";
                    $resultado = ConectorBD::ejecutarQuery($cadenaSQL, null);
                    if (count($resultado)>0)$this->cargarAtributos ($resultado[0]);
                }
        }
    }    
    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->ideEquipo=$datos['ideequipo'];
        $this->presion=$datos['presion'];
        $this->temperatura=$datos['temperatura'];
        $this->volumen=$datos['volumen'];
        $this->impendancia=$datos['impendancia'];
        $this->marcapasos=$datos['marcapasos'];
        $this->respiracion=$datos['respiracion'];
        $this->gCardiaco=$datos['gcardiaco'];
        $this->IBP=$datos['ibp'];
        $this->energia=$datos['energia'];
        $this->NIBP=$datos['nibp'];
        $this->tiempo=$datos['tiempo'];
        $this->Co2=$datos['co2'];
        $this->Co=$datos['co'];
        $this->RPM=$datos['rpm'];
        $this->HR=$datos['hr'];
        $this->flujo=$datos['flujo'];
        $this->FC=$datos['fc'];
        $this->ECG=$datos['ecg'];
        $this->SpO2=$datos['spo2'];
        $this->peso=$datos['peso'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getIdeEquipo() {
        return $this->ideEquipo;
    }

    function getPresion() {
        if ($this->presion=='S')$this->presion='checked';
        else $this->presion='';
        return $this->presion;
    }

    function getTemperatura() {
        if ($this->temperatura=='S')$this->temperatura='checked';
        else $this->temperatura='';
        return $this->temperatura;
    }

    function getVolumen() {
        if ($this->volumen=='S')$this->volumen='checked';
        else $this->volumen='';
        return $this->volumen;
    }

    function getImpendancia() {
        if ($this->impendancia=='S')$this->impendancia='checked';
        else $this->impendancia='';
        return $this->impendancia;
    }

    function getMarcapasos() {
        if ($this->marcapasos=='S')$this->marcapasos='checked';
        else $this->marcapasos='';
        return $this->marcapasos;
    }

    function getRespiracion() {
        if ($this->respiracion=='S')$this->respiracion='checked';
        else $this->respiracion='';
        return $this->respiracion;
    }

    function getGCardiaco() {
        if ($this->gCardiaco=='S')$this->gCardiaco='checked';
        else $this->gCardiaco='';
        return $this->gCardiaco;
    }

    function getIBP() {
        if ($this->IBP=='S')$this->IBP='checked';
        else $this->IBP='';
        return $this->IBP;
    }

    function getEnergia() {
        if ($this->energia=='S')$this->energia='checked';
        else $this->energia='';
        return $this->energia;
    }

    function getNIBP() {
        if ($this->NIBP=='S')$this->NIBP='checked';
        else $this->NIBP='';
        return $this->NIBP;
    }

    function getTiempo() {
        if ($this->tiempo=='S')$this->tiempo='checked';
        else $this->tiempo='';
        return $this->tiempo;
    }

    function getCo2() {
        if ($this->Co2=='S')$this->Co2='checked';
        else $this->Co2='';
        return $this->Co2;
    }

    function getCo() {
        if ($this->Co=='S')$this->Co='checked';
        else $this->Co='';
        return $this->Co;
    }

    function getRPM() {
        if ($this->RPM=='S')$this->RPM='checked';
        else $this->RPM='';
        return $this->RPM;
    }

    function getHR() {
        if ($this->HR=='S')$this->HR='checked';
        else $this->HR='';
        return $this->HR;
    }

    function getFlujo() {
        if ($this->flujo=='S')$this->flujo='checked';
        else $this->flujo='';
        return $this->flujo;
    }

    function getFC() {
        if ($this->FC=='S')$this->FC='checked';
        else $this->FC='';
        return $this->FC;
    }

    function getECG() {
        if ($this->ECG=='S')$this->ECG='checked';
        else $this->ECG='';
        return $this->ECG;
    }

    function getSpO2() {
        if ($this->SpO2=='S')$this->SpO2='checked';
        else $this->SpO2='';
        return $this->SpO2;
    }

    function getPeso() {
        if ($this->peso=='S')$this->peso='checked';
        else $this->peso='';
        return $this->peso;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setIdeEquipo($ideEquipo) {
        $this->ideEquipo = $ideEquipo;
    }

    function setPresion($presion) {
        $this->presion = $presion;
    }

    function setTemperatura($temperatura) {
        $this->temperatura = $temperatura;
    }

    function setVolumen($volumen) {
        $this->volumen = $volumen;
    }

    function setImpendancia($impendancia) {
        $this->impendancia = $impendancia;
    }

    function setMarcapasos($marcapasos) {
        $this->marcapasos = $marcapasos;
    }

    function setRespiracion($respiracion) {
        $this->respiracion = $respiracion;
    }

    function setGCardiaco($gCardiaco) {
        $this->gCardiaco = $gCardiaco;
    }

    function setIBP($IBP) {
        $this->IBP = $IBP;
    }

    function setEnergia($energia) {
        $this->energia = $energia;
    }

    function setNIBP($NIBP) {
        $this->NIBP = $NIBP;
    }

    function setTiempo($tiempo) {
        $this->tiempo = $tiempo;
    }

    function setCo2($Co2) {
        $this->Co2 = $Co2;
    }

    function setCo($Co) {
        $this->Co = $Co;
    }

    function setRPM($RPM) {
        $this->RPM = $RPM;
    }

    function setHR($HR) {
        $this->HR = $HR;
    }

    function setFlujo($flujo) {
        $this->flujo = $flujo;
    }

    function setFC($FC) {
        $this->FC = $FC;
    }

    function setECG($ECG) {
        $this->ECG = $ECG;
    }

    function setSpO2($SpO2) {
        $this->SpO2 = $SpO2;
    }

    function setPeso($peso) {
        $this->peso = $peso;
    }
    
    function adicionar() {
        $columnas="ideEquipo,presion,temperatura, volumen,impendancia,marcapasos,respiracion,gCardiaco,ibp,energia,nibp,tiempo,co2,co,rpm,hr,flujo,fc,ecg,spo2,peso";
        $valores="{$this->ideEquipo},'{$this->presion}','{$this->temperatura}','{$this->volumen}','{$this->impendancia}','{$this->marcapasos}','{$this->respiracion}','{$this->gCardiaco}','{$this->IBP}','{$this->energia}','{$this->NIBP}','{$this->tiempo}','{$this->Co2}','{$this->Co}','{$this->RPM}','{$this->HR}','{$this->flujo}','{$this->FC}','{$this->ECG}','{$this->SpO2}','{$this->peso}'";
        $cadenaSQL="insert into variablesSuceptiblesCalibracion({$columnas})values($valores)";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificar() {
        $valores="presion='{$this->presion}',temperatura='{$this->temperatura}', volumen='{$this->volumen}',impendancia='{$this->impendancia}', marcapasos='{$this->marcapasos}', respiracion='{$this->respiracion}',gCardiaco='{$this->gCardiaco}',IBP='{$this->IBP}',energia='{$this->energia}',NIBP='{$this->NIBP}', tiempo='{$this->tiempo}',Co2='{$this->Co2}',Co='{$this->Co}',RPM='{$this->RPM}', HR='{$this->HR}', flujo='{$this->flujo}', FC='{$this->FC}', ECG='{$this->ECG}', SPo2='{$this->SpO2}', peso='{$this->peso}'";
        $cadenaSQL="update variablesSuceptiblesCalibracion set $valores where ideEquipo={$this->ideEquipo}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from variablesSuceptiblesCalibracion ";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= VariablesSuceptiblesCalibracion::getDatos($filtro, $orden);
        $lista=array();
        for ($h = 0; $h < count($datos); $h++) {
            $varables=new VariablesSuceptiblesCalibracion($datos[$h], null);
            $lista[$h]=$varables;
        }
        return $lista;
    }
    
	function getVariablesLista($variable){
		if ($variable=='checked') $visto="<img src='../presentacion/imagenes/vistoBlue.png' width='15px'>";
		else $visto="<img src='../presentacion/imagenes/vacioBlue.png' width='15px'>";
	return $visto;
	}
}
