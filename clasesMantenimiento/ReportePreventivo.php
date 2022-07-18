<?php
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/MantenimientoPreventivo.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../clasesCalidad/Persona.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/UnidadMedida.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/RutinaExtra.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/Mes.php';

class ReportePreventivo {
    private $numeroReporte;
    private $consecutivo;
    private $ciudad;
    private $tipoFalla;
    private $otraFalla;
    private $idePersona;
    private $ideMantenimientoPreventivo;
    private $ideEquipo;
    private $problemaPresentado;
    private $funcionamiento;
    private $observaciones;
    private $aspectoFisico;
    private $condicionaAmbiental;
    private $limpiezaInterna;
    private $limpiezaExterna;
    private $pruebasFuncionamiento;
    private $lubricacionPartes;
    private $pruebaInicial;
    private $sistemaElectronico;
    private $sistemaHidraulico;
    private $sistemaNeumatico;
    private $sistemaMecanico;
    private $sistemaElectrico;
    private $sistemaOptico;
    private $sistemaOperativo;
    private $sistemaElectromecanico;
    private $sistemaVapor;
    private $fecha;
    private $tipoMantenimiento;
    private $ideRutinaExtra;
	private $ideUnidadMedida1;
	private $valorMedido1;
	private $valorNominal1;
	private $ideUnidadMedida2;
	private $valorMedido2;
	private $valorNominal2;
	private $ideUnidadMedida3;
	private $valorMedido3;
	private $valorNominal3;
	private $ideUnidadMedida4;
	private $valorMedido4;
	private $valorNominal4;
	private $ideUnidadMedida5;
	private $valorMedido5;
	private $valorNominal5;
	private $ideUnidadMedida6;
	private $valorMedido6;
	private $valorNominal6;
    
    function __construct($campo, $valor) {
        if ($campo!=null) {
            if (is_array($campo))
                $this->cargarAtributos($campo);
            else {
                $cadenaSQL="select * from reportePreventivo where $campo = $valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)
                    $this->cargarAtributos($resultado[0]);
            }
        }
    }    
    private function cargarAtributos($datos) {
        $this->numeroReporte=$datos['numeroreporte'];
        $this->consecutivo=$datos['consecutivo'];
        $this->ciudad=$datos['ciudad'];
        $this->tipoFalla=$datos['tipofalla'];
        $this->otraFalla=$datos['otrafalla'];
        $this->idePersona=$datos['idepersona'];
        $this->ideMantenimientoPreventivo=$datos['idemantenimientopreventivo'];
        $this->ideEquipo=$datos['ideequipo'];
        $this->problemaPresentado=$datos['problemapresentado'];
        $this->funcionamiento=$datos['funcionamiento'];
        $this->observaciones=$datos['observaciones'];
        $this->aspectoFisico=$datos['aspectofisico'];
        $this->condicionaAmbiental=$datos['condicionambiental'];
        $this->limpiezaInterna=$datos['limpiezainterna'];
        $this->limpiezaExterna=$datos['limpiezaexterna'];
        $this->pruebasFuncionamiento=$datos['pruebasfuncionamiento'];
        $this->lubricacionPartes=$datos['lubricacionpartes'];
        $this->pruebaInicial=$datos['pruebainicial'];
        $this->sistemaElectronico=$datos['sistemaelectronico'];
        $this->sistemaHidraulico=$datos['sistemahidraulico'];
        $this->sistemaNeumatico=$datos['sistemaneumatico'];
        $this->sistemaMecanico=$datos['sistemamecanico'];
        $this->sistemaElectrico=$datos['sistemaelectrico'];
        $this->sistemaOptico=$datos['sistemaoptico'];
        $this->sistemaOperativo=$datos['sistemaoperativo'];
        $this->sistemaElectromecanico=$datos['sistemaelectromecanico'];
        $this->sistemaVapor=$datos['sistemavapor'];
        $this->fecha=$datos['fecha'];
        $this->tipoMantenimiento=$datos['tipomantenimiento'];
        $this->ideRutinaExtra=$datos['iderutinaextra'];
		$this->ideUnidadMedida1=$datos['ideunidadmedida1'];
		$this->valorMedido1=$datos['valormedido1'];
		$this->valorNominal1=$datos['valornominal1'];
		$this->ideUnidadMedida2=$datos['ideunidadmedida2'];
		$this->valorMedido2=$datos['valormedido2'];
		$this->valorNominal2=$datos['valornominal2'];
		$this->ideUnidadMedida3=$datos['ideunidadmedida3'];
		$this->valorMedido3=$datos['valormedido3'];
		$this->valorNominal3=$datos['valornominal3'];
		$this->ideUnidadMedida4=$datos['ideunidadmedida4'];
		$this->valorMedido4=$datos['valormedido4'];
		$this->valorNominal4=$datos['valornominal4'];
		$this->ideUnidadMedida5=$datos['ideunidadmedida5'];
		$this->valorMedido5=$datos['valormedido5'];
		$this->valorNominal5=$datos['valornominal5'];
		$this->ideUnidadMedida6=$datos['ideunidadmedida6'];
		$this->valorMedido6=$datos['valormedido6'];
		$this->valorNominal6=$datos['valornominal6'];

    }    
// inicio getter
    function getNumeroReporte() {
        return $this->numeroReporte;
    }

    function getConsecutivo() {
        return $this->consecutivo;
    }

    function getCiudad() {
        return $this->ciudad;
    }

    function getTipoFalla() {
        return $this->tipoFalla;
    }

    function getOtraFalla() {
        return $this->otraFalla;
    }

    function getIdePersona() {
        return $this->idePersona;
    }

    function getIdeMantenimientoPreventivo() {
        return $this->ideMantenimientoPreventivo;
    }

    function getIdeEquipo() {
        return $this->ideEquipo;
    }

    function getProblemaPresentado() {
        return $this->problemaPresentado;
    }

    function getFuncionamiento() {
        return $this->funcionamiento;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getAspectoFisico() {
        return $this->aspectoFisico;
    }

    function getCondicionaAmbiental() {
        return $this->condicionaAmbiental;
    }

    function getLimpiezaInterna() {
        return $this->limpiezaInterna;
    }

    function getLimpiezaExterna() {
        return $this->limpiezaExterna;
    }

    function getPruebasFuncionamiento() {
        return $this->pruebasFuncionamiento;
    }

    function getLubricacionPartes() {
        return $this->lubricacionPartes;
    }

    function getPruebaInicial() {
        return $this->pruebaInicial;
    }

    function getSistemaElectronico() {
        return $this->sistemaElectronico;
    }

    function getSistemaHidraulico() {
        return $this->sistemaHidraulico;
    }

    function getSistemaNeumatico() {
        return $this->sistemaNeumatico;
    }

    function getSistemaMecanico() {
        return $this->sistemaMecanico;
    }

    function getSistemaElectrico() {
        return $this->sistemaElectrico;
    }

    function getSistemaOptico() {
        return $this->sistemaOptico;
    }

    function getSistemaOperativo() {
        return $this->sistemaOperativo;
    }

    function getSistemaElectromecanico() {
        return $this->sistemaElectromecanico;
    }

    function getSistemaVapor() {
        return $this->sistemaVapor;
    }

    function getFecha() {
        return $this->fecha;
    }
    function getAnio(){
	$fecha= date_create($this->fecha);
	return date_format($fecha,'Y');
    }
    function getFechaLista(){
		$fecha= date_create($this->fecha);
		$mes=new Mes('ide',date_format($fecha,'n'));
		$dia=date_format($fecha,'j');
		$año=date_format($fecha,'Y');
	return $dia.' de '.$mes->getNombre().' de '.$año;
	}
    function getTipoMantenimiento() {
        return $this->tipoMantenimiento;
    }
    function getIdeRutinaExtra() {
        return $this->ideRutinaExtra;
    }
   function getIdeUnidadMedida1() {
        return $this->ideUnidadMedida1;
    }
    function getIdeUnidadMedida2() {
        return $this->ideUnidadMedida2;
    }
	function getValorMedido1() {
        return $this->valorMedido1;
    }
	function getValorMedido2() {
        return $this->valorMedido2;
    }
	function getValorNominal1() {
        return $this->valorNominal1;
    }
	function getValorNominal2() {
        return $this->valorNominal2;
    }
    function getIdeUnidadMedida3() {
        return $this->ideUnidadMedida3;
    }

    function getValorMedido3() {
        return $this->valorMedido3;
    }

    function getValorNominal3() {
        return $this->valorNominal3;
    }

    function getIdeUnidadMedida4() {
        return $this->ideUnidadMedida4;
    }

    function getValorMedido4() {
        return $this->valorMedido4;
    }

    function getValorNominal4() {
        return $this->valorNominal4;
    }

    function getIdeUnidadMedida5() {
        return $this->ideUnidadMedida5;
    }

    function getValorMedido5() {
        return $this->valorMedido5;
    }

    function getValorNominal5() {
        return $this->valorNominal5;
    }

    function getIdeUnidadMedida6() {
        return $this->ideUnidadMedida6;
    }

    function getValorMedido6() {
        return $this->valorMedido6;
    }

    function getValorNominal6() {
        return $this->valorNominal6;
    }
// fin getter
//inicio setter
    function setNumeroReporte($numeroReporte) {
        $this->numeroReporte = $numeroReporte;
    }

    function setConsecutivo($consecutivo) {
        $this->consecutivo = $consecutivo;
    }

    function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    function setTipoFalla($tipoFalla) {
        $this->tipoFalla = $tipoFalla;
    }

    function setOtraFalla($otraFalla) {
        $this->otraFalla = $otraFalla;
    }

    function setIdePersona($idePersona) {
        $this->idePersona = $idePersona;
    }

    function setIdeMantenimientoPreventivo($ideMantenimientoPreventivo) {
        $this->ideMantenimientoPreventivo = $ideMantenimientoPreventivo;
    }
    
    function setIdeEquipo($ideEquipo) {
        $this->ideEquipo = $ideEquipo;
    }

    function setProblemaPresentado($problemaPresentado) {
        $this->problemaPresentado = $problemaPresentado;
    }

    function setFuncionamiento($funcionamiento) {
        $this->funcionamiento = $funcionamiento;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setAspectoFisico($aspectoFisico) {
        $this->aspectoFisico = $aspectoFisico;
    }

    function setCondicionaAmbiental($condicionaAmbiental) {
        $this->condicionaAmbiental = $condicionaAmbiental;
    }

    function setLimpiezaInterna($limpiezaInterna) {
        $this->limpiezaInterna = $limpiezaInterna;
    }

    function setLimpiezaExterna($limpiezaExterna) {
        $this->limpiezaExterna = $limpiezaExterna;
    }

    function setPruebasFuncionamiento($pruebasFuncionamiento) {
        $this->pruebasFuncionamiento = $pruebasFuncionamiento;
    }

    function setLubricacionPartes($lubricacionPartes) {
        $this->lubricacionPartes = $lubricacionPartes;
    }

    function setPruebaInicial($pruebaInicial) {
        $this->pruebaInicial = $pruebaInicial;
    }

    function setSistemaElectronico($sistemaElectronico) {
        $this->sistemaElectronico = $sistemaElectronico;
    }

    function setSistemaHidraulico($sistemaHidraulico) {
        $this->sistemaHidraulico = $sistemaHidraulico;
    }

    function setSistemaNeumatico($sistemaNeumatico) {
        $this->sistemaNeumatico = $sistemaNeumatico;
    }

    function setSistemaMecanico($sistemaMecanico) {
        $this->sistemaMecanico = $sistemaMecanico;
    }

    function setSistemaElectrico($sistemaElectrico) {
        $this->sistemaElectrico = $sistemaElectrico;
    }

    function setSistemaOptico($sistemaOptico) {
        $this->sistemaOptico = $sistemaOptico;
    }

    function setSistemaOperativo($sistemaOperativo) {
        $this->sistemaOperativo = $sistemaOperativo;
    }

    function setSistemaElectromecanico($sistemaElectromecanico) {
        $this->sistemaElectromecanico = $sistemaElectromecanico;
    }

    function setSistemaVapor($sistemaVapor) {
        $this->sistemaVapor = $sistemaVapor;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    function setTipoMantenimiento($tipoMantenimiento) {
        $this->tipoMantenimiento = $tipoMantenimiento;
    }
    function setIdeRutinaExtra($ideRutinaExtra) {
        $this->ideRutinaExtra = $ideRutinaExtra;
    }
	function setIdeUnidadMedida1($ideUnidadMedida1) {
        $this->ideUnidadMedida1=$ideUnidadMedida1;
    }
	function setIdeUnidadMedida2($ideUnidadMedida2) {
        return $this->ideUnidadMedida2=$ideUnidadMedida2;
    }
	function setValorMedido1($valorMedido1) {
		if($valorMedido1=='')$valorMedido1='null';
        return $this->valorMedido1=$valorMedido1;
    }
	function setValorMedido2($valorMedido2) {
		if($valorMedido2=='')$valorMedido2='null';
        return $this->valorMedido2=$valorMedido2;
    }
	function setValorNominal1($valorNominal1) {
		if($valorNominal1=='')$valorNominal1='null';
        return $this->valorNominal1=$valorNominal1;
    }
	function setValorNominal2($valorNominal2) {
		if($valorNominal2=='')$valorNominal2='null';
        return $this->valorNominal2=$valorNominal2;
    }
    function setIdeUnidadMedida3($ideUnidadMedida3) {
        $this->ideUnidadMedida3 = $ideUnidadMedida3;
    }

    function setValorMedido3($valorMedido3) {
		if($valorMedido3=='')$valorMedido3='null';
        $this->valorMedido3 = $valorMedido3;
    }

    function setValorNominal3($valorNominal3) {
		if($valorNominal3=='')$valorNominal3='null';
        $this->valorNominal3 = $valorNominal3;
    }

    function setIdeUnidadMedida4($ideUnidadMedida4) {
        $this->ideUnidadMedida4 = $ideUnidadMedida4;
    }

    function setValorMedido4($valorMedido4) {
		if($valorMedido4=='')$valorMedido4='null';
        $this->valorMedido4 = $valorMedido4;
    }

    function setValorNominal4($valorNominal4) {
		if($valorNominal4=='')$valorNominal4='null';
        $this->valorNominal4 = $valorNominal4;
    }

    function setIdeUnidadMedida5($ideUnidadMedida5) {
        $this->ideUnidadMedida5 = $ideUnidadMedida5;
    }

    function setValorMedido5($valorMedido5) {
		if($valorMedido5=='')$valorMedido5='null';
        $this->valorMedido5 = $valorMedido5;
    }

    function setValorNominal5($valorNominal5) {
		if($valorNominal5=='')$valorNominal5='null';
        $this->valorNominal5 = $valorNominal5;
    }

    function setIdeUnidadMedida6($ideUnidadMedida6) {
        $this->ideUnidadMedida6 = $ideUnidadMedida6;
    }

    function setValorMedido6($valorMedido6) {
		if($valorMedido6=='')$valorMedido6='null';
        $this->valorMedido6 = $valorMedido6;
    }

    function setValorNominal6($valorNominal6) {
		if($valorNominal6=='')$valorNominal6='null';
        $this->valorNominal6 = $valorNominal6;
    }
//fin setter 
//Inicio llaves foraneas
    function getPersona() {
        return new Persona('identificacion',"'".$this->idePersona."'");
    }    
    function getMantenimientoPreventivo() {
        return new MantenimientoPreventivo('ide',$this->ideMantenimientoPreventivo);
    }
    function getEquipo() {
        return new Equipo('ide',$this->ideEquipo);
    }
    function getRutinaExtra() {
        return new RutinaExtra('ide', $this->ideRutinaExtra);
    }
	function getUnidadMedida1(){
		return new UnidadMedida('ide',$this->ideUnidadMedida1);
	}
	function getUnidadMedida2(){
		return new UnidadMedida('ide',$this->ideUnidadMedida2);
	}
	function getUnidadMedida3(){
		return new UnidadMedida('ide',$this->ideUnidadMedida3);
	}
	function getUnidadMedida4(){
		return new UnidadMedida('ide',$this->ideUnidadMedida4);
	}
	function getUnidadMedida5(){
		return new UnidadMedida('ide',$this->ideUnidadMedida5);
	}
	function getUnidadMedida6(){
		return new UnidadMedida('ide',$this->ideUnidadMedida6);
	}


//Fin llaves foraneas
    
    public static function getDatos($filtro, $orden) {
        $cadenaSQL="select * from reportePreventivo";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro, $orden) {
        $datos= ReportePreventivo::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $reporte=new ReportePreventivo($datos[$i], null);
            $lista[$i]=$reporte;
        }
    return $lista;
    }
    public static function getBuscarReporte($ideMantenimiento, $ideEquipo) {
        $cadenaSQL="select numeroReporte from reportePreventivo where ideMantenimientoPreventivo=$ideMantenimiento and ideEquipo=$ideEquipo";
        $numeroReporte='';
        $resultado = ConectorBD::ejecutarQuery($cadenaSQL, null);
        if ($resultado!=null) {
            $numeroReporte=$resultado[0][0];
        }    
        return $numeroReporte;
    }
    //inicio metodos
    function getTipoFallaLista() {
        $falla='';
        switch ($this->tipoFalla) {
            case '0':
                $falla.='Ninguno';
                break;
            case 'MU':
                $falla.='Mal Uso';
                break;
            case 'C':
                $falla.='Consumible';
                break;
            case 'M':
                $falla.='Mecánica';
                break;
            case 'H':
                $falla.='Hidráulica';
                break;
            case 'O':
                $falla.='Operativa';
                break;
            case 'E':
                $falla.='Electronica';
                break;
            case 'S':
                $falla.='Software';
                break;
            case 'A':
                $falla.='Accesorio';
                break;
            case 'N':
                $falla.='Neumatica';
                break;
            case 'OP':
                $falla.='Optica';
                break;
            case 'EL':
                $falla.='Electrica';
                break;
            case 'D':
                $falla.='Deterioro';
                break;
            case 'OT':
                $falla.= $this->otraFalla;
                break;
        }
        return $falla;
    }  
    function getAspectoFisicoChk() {
        $lista='';
        switch ($this->aspectoFisico) {
            case 'S':
                $lista.="<li><input type='checkbox' id='chk2' name='aspectoFisico' checked class='checkBoton'><label for='chk2'>Revisión Aspecto Físico.</label><span></span></li>";
                break;
            default:
                $lista.="<li><input type='checkbox' id='chk2' name='aspectoFisico' class='checkBoton'><label for='chk2'>Revisión Aspecto Físico.</label><span></span></li>";
                break;
        }
        return $lista;
    }
    
    function getCondicionAmbientalChk(){
        $lista='';
        switch ($this->condicionaAmbiental) {
            case 'S':
                $lista.='<li><input type="checkbox" id="chk3" name="condicionAmbiental" checked class="checkBoton"><label for="chk3">Revisión Condiciones Ambientales.</label><span></span></li>';
                break;
            default:
                $lista.='<li><input type="checkbox" id="chk3" name="condicionAmbiental" class="checkBoton"><label for="chk3">Revisión Condiciones Ambientales.</label><span></span></li>';
                break;
        }
        return $lista;
    }
    function getLimpiezaInternaChk(){
        $lista='';
        switch ($this->limpiezaInterna) {
            case 'S':
                $lista.='<li><input type="checkbox" name="limpiezaInterna" id="chk13" checked class="checkBoton"><label for="chk13">Limpieza Interna del Equipo</label><span></span></li>';
                break;
            default:
                $lista.='<li><input type="checkbox" name="limpiezaInterna" id="chk13" class="checkBoton"><label for="chk13">Limpieza Interna del Equipo</label><span></span></li>';
                break;
        }
        return $lista;
    }
    function getLimpiezaExternaChk(){
        $lista='';
        switch ($this->limpiezaExterna) {
            case 'S':
                $lista.='<li><input type="checkbox" name="limpiezaExterna" id="chk14" checked class="checkBoton"><label for="chk14">Limpieza Externa del Equipo</label><span></span></li>';
                break;
            default:
                $lista.='<li><input type="checkbox" name="limpiezaExterna" id="chk14" class="checkBoton"><label for="chk14">Limpieza Externa del Equipo</label><span></span></li>';
                break;
        }
        return $lista;
    }
    function getPruebasFuncionamientoChk(){
        $lista='';
        switch ($this->pruebasFuncionamiento) {
            case 'S':
                $lista.='<li><input type="checkbox" name="pruebasFuncionamiento" id="chk16" checked class="checkBoton"><label for="chk16">Pruebas de Funcionamiento</label><span></span></li>';
                break;
            default:
                $lista.='<li><input type="checkbox" name="pruebasFuncionamiento" id="chk16" class="checkBoton"><label for="chk16">Pruebas de Funcionamiento</label><span></span></li>';
                break;
        }
        return $lista;
    }
    function getLubricacionPartesChk(){
        $lista='';
        switch ($this->lubricacionPartes) {
            case 'S':
                $lista.='<li><input type="checkbox" name="lubricacionPartes" id="chk15" checked class="checkBoton"><label for="chk15">Lubricacion Partes</label><span></span></li>';
                break;
            default:
                $lista.='<li><input type="checkbox" name="lubricacionPartes" id="chk15" class="checkBoton"><label for="chk15">Lubricacion Partes</label><span></span></li>';
                break;
        }
        return $lista;
    }
    function getPruebaInicialChk(){
        $lista='';
        switch ($this->pruebaInicial) {
            case 'S':
                $lista.='<li><input type="checkbox" id="chk1" name="pruebaInicial" class="checkBoton" checked><label for="chk1">Prueba Funcional Inicial</label><span></span></li>';
                break;
            default:
                $lista.='<li><input type="checkbox" id="chk1" name="pruebaInicial" class="checkBoton"><label for="chk1">Prueba Funcional Inicial</label><span></span></li>';
                break;
        }
        return $lista;
    }
    
    function getSistemaElectronicoChk(){
        $lista='';
        switch ($this->sistemaElectronico) {
            case 'S':
                $lista.='<li><input type="checkbox" id="chk4" name="sistemaElectronico" checked class="checkBoton"><label for="chk4">Verificación Sistema Electrónico</label><span></span></li>';
                break;
            default:
                $lista.='<li><input type="checkbox" id="chk4" name="sistemaElectronico" class="checkBoton"><label for="chk4">Verificación Sistema Electrónico</label><span></span></li>';
                break;
        }
        return $lista;
    }
    function getSistemaHidraulicoChk(){
        $lista='';
        switch ($this->sistemaHidraulico) {
            case 'S':
                $lista.='<li><input type="checkbox" id="chk5" name="sistemaHidraulico" checked class="checkBoton"><label for="chk5">Verificación Sistema Hidráulico</label><span></span></li>';
                break;
            default:
                $lista.='<li><input type="checkbox" id="chk5" name="sistemaHidraulico" class="checkBoton"><label for="chk5">Verificación Sistema Hidráulico</label><span></span></li>';
                break;
        }
        return $lista;
    }
    function getSistemaNeumaticoChk(){
        $lista='';
        switch ($this->sistemaNeumatico) {
            case 'S':
                $lista.='<li><input type="checkbox" id="chk6" name="sistemaNeumatico" checked class="checkBoton"><label for="chk6">Verificación Sistema Neumático</label><span></span></li>';
                break;
            default:
                $lista.='<li><input type="checkbox" id="chk6" name="sistemaNeumatico" class="checkBoton"><label for="chk6">Verificación Sistema Neumático</label><span></span></li>';
                break;
        }
        return $lista;
    }
    function getSistemaMecanicoChk(){
        $lista='';
        switch ($this->sistemaMecanico) {
            case 'S':
                $lista.='<li><input type="checkbox" id="chk7" name="sistemaMecanico" checked class="checkBoton"><label for="chk7">Verificación Sistema Mecánico</label><span></span></li>';
                break;
            default:
                $lista.='<li><input type="checkbox" id="chk7" name="sistemaMecanico" class="checkBoton"><label for="chk7">Verificación Sistema Mecánico</label><span></span></li>';
                break;
        }
        return $lista;
    }
    function getSistemaElectricoChk(){
        $lista='';
        switch ($this->sistemaElectrico) {
            case 'S':
                $lista.='<li><input type="checkbox" id="chk8" name="sistemaElectrico" checked class="checkBoton"><label for="chk8">Verificación Sistema Eléctrico</label><span></span></li>';
                break;
            default:
                $lista.='<li><input type="checkbox" id="chk8" name="sistemaElectrico" class="checkBoton"><label for="chk8">Verificación Sistema Eléctrico</label><span></span></li>';
                break;
        }
        return $lista;
    }
    function getSistemaOpticoChk(){
        $lista='';
        switch ($this->sistemaOptico) {
            case 'S':
                $lista.='<li><input type="checkbox" name="sistemaOptico" id="chk9" checked class="checkBoton"><label for="chk9">Verificación Sistema Óptico</label><span></span></li>';
                break;
            default:
                $lista.='<li><input type="checkbox" name="sistemaOptico" id="chk9" class="checkBoton"><label for="chk9">Verificación Sistema Óptico</label><span></span></li>';
                break;
        }
        return $lista;
    }
    function getSistemaOperativoChk(){
        $lista='';
        switch ($this->sistemaOperativo) {
            case 'S':
                $lista.='<li><input type="checkbox" name="sistemaOperativo" id="chk12" checked class="checkBoton"><label for="chk12">Verificación Sistema Operativo</label><span></span></li>';
                break;
            default:
                $lista.='<li><input type="checkbox" name="sistemaOperativo" id="chk12" class="checkBoton"><label for="chk12">Verificación Sistema Operativo</label><span></span></li>';
                break;
        }
        return $lista;
    }
    function getSistemaElectromecanicoChk(){
        $lista='';
        switch ($this->sistemaElectromecanico) {
            case 'S':
                $lista.='<li><input type="checkbox" name="sistemaElectromecanico" id="chk10" checked class="checkBoton"><label for="chk10">Verificación Sistema Electromecánico</label><span></span></li>';
                break;
            default:
                $lista.='<li><input type="checkbox" name="sistemaElectromecanico" id="chk10" class="checkBoton"><label for="chk10">Verificación Sistema Electromecánico</label><span></span></li>';
                break;
        }
        return $lista;
    }
    function getSistemaVaporChk(){
        $lista='';
        switch ($this->sistemaVapor) {
            case 'S':
                $lista.='<li><input type="checkbox" name="sistemaVapor" id="chk11" checked class="checkBoton"><label for="chk11">Verificación Sistema a Vapor</label><span></span></li>';
                break;
            default:
                $lista.='<li><input type="checkbox" name="sistemaVapor" id="chk11" class="checkBoton"><label for="chk11">Verificación Sistema a Vapor</label><span></span></li>';
                break;
        }
        return $lista;
    }
    //fin metodos
    function getTipoFallaChk() {
        $falla='';
        switch ($this->tipoFalla) {
            case '0':
                $falla.="<li>
                                <input type='radio' id='radio1' name='tipoFalla' value='0' class='botonRadio' required='true' checked>
                                <span></span>
                                <label for='radio1'>Ninguno</label>
                            </li>
                            <li>
                                <input type='radio' id='radio2' name='tipoFalla' value='MU' class='botonRadio'>
                                <span></span>
                                <label for='radio2'>Mal Uso</label>
                            </li>
                            <li>
                                <input type='radio' id='radio3' name='tipoFalla' value='C' class='botonRadio'>
                                <span></span>
                                <label for='radio3'>Consumible</label>
                            </li>
                            <li>
                                <input type='radio' id='radio4' name='tipoFalla' value='M' class='botonRadio'>
                                <span></span>
                                <label for='radio4'>Mecánica</label>
                            </li>
                            <li>
                                <input type='radio' id='radio5' name='tipoFalla' value='H' class='botonRadio'>
                                <span></span>
                                <label for='radio5'>Hidráulica</label>
                            </li>
                            <li>
                                <input type='radio' id='radio6' name='tipoFalla' value='O' class='botonRadio'>
                                <span></span>
                                <label for='radio6'>Operativa</label>
                            </li>
                            <li>
                                <input type='radio' id='radio7' name='tipoFalla' value='E' class='botonRadio'>
                                <span></span>
                                <label for='radio7'>Electrónica</label>
                            </li>
                            <li>
                                <input type='radio' id='radio8' name='tipoFalla' value='S' class='botonRadio'>
                                <span></span>
                                <label for='radio8'>Software</label>
                            </li>
                            <li>
                                <input type='radio' id='radio9' name='tipoFalla' value='A' class='botonRadio'>
                                <span></span>
                                <label for='radio9'>Accesorio</label>
                            </li>
                            <li>
                                <input type='radio' id='radio10' name='tipoFalla' value='N' class='botonRadio'>
                                <span></span>
                                <label for='radio10'>Neumática</label>
                            </li>
                            <li>
                                <input type='radio' id='radio11' name='tipoFalla' value='OP' class='botonRadio'>
                                <span></span>
                                <label for='radio11'>Optica</label>
                            </li>
                            <li>
                                <input type='radio' id='radio12' name='tipoFalla' value='EL' class='botonRadio'>
                                <span></span>
                                <label for='radio12'>Eléctrica</label>
                            </li>
                            <li>
                                <input type='radio' id='radio13' name='tipoFalla' value='D' class='botonRadio'>
                                <span></span>
                                <label for='radio13'>Deterioro</label>
                            </li>
                            <li>
                                <input type='radio' id='radio14' name='tipoFalla' value='OT' class='botonRadio'>
                                <span></span>
                                <label for='radio14'>Otra</label>
                            </li>";
                break;
            case 'MU':
                $falla.='<li>
                            <input type="radio" id="radio1" name="tipoFalla" value="0" class="botonRadio" required="true" checked>
                            <span></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <input type="radio" id="radio2" name="tipoFalla" value="MU" class="botonRadio">
                            <span></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <input type="radio" id="radio3" name="tipoFalla" value="C" class="botonRadio">
                            <span></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <input type="radio" id="radio4" name="tipoFalla" value="M" class="botonRadio">
                            <span></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio5" name="tipoFalla" value="H" class="botonRadio">
                            <span></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio6" name="tipoFalla" value="O" class="botonRadio">
                            <span></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <input type="radio" id="radio7" name="tipoFalla" value="E" class="botonRadio">
                            <span></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio8" name="tipoFalla" value="S" class="botonRadio">
                            <span></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <input type="radio" id="radio9" name="tipoFalla" value="A" class="botonRadio">
                            <span></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <input type="radio" id="radio10" name="tipoFalla" value="N" class="botonRadio">
                            <span></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <input type="radio" id="radio11" name="tipoFalla" value="OP" class="botonRadio">
                            <span></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio12" name="tipoFalla" value="EL" class="botonRadio">
                            <span></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio13" name="tipoFalla" value="D" class="botonRadio">
                            <span></span>
                            <label for="radio13">Deterioro</label>
                        </li>
                        <li>
                            <input type="radio" id="radio14" name="tipoFalla" value="OT" class="botonRadio">
                            <span></span>
                            <label for="radio14">Otra</label>
                        </li>';
                break;
            case 'C':
                $falla.='<li>
                            <input type="radio" id="radio1" name="tipoFalla" value="0" class="botonRadio" required="true">
                            <span></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <input type="radio" id="radio2" name="tipoFalla" value="MU" class="botonRadio">
                            <span></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <input type="radio" id="radio3" name="tipoFalla" value="C" class="botonRadio" checked>
                            <span></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <input type="radio" id="radio4" name="tipoFalla" value="M" class="botonRadio">
                            <span></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio5" name="tipoFalla" value="H" class="botonRadio">
                            <span></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio6" name="tipoFalla" value="O" class="botonRadio">
                            <span></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <input type="radio" id="radio7" name="tipoFalla" value="E" class="botonRadio">
                            <span></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio8" name="tipoFalla" value="S" class="botonRadio">
                            <span></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <input type="radio" id="radio9" name="tipoFalla" value="A" class="botonRadio">
                            <span></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <input type="radio" id="radio10" name="tipoFalla" value="N" class="botonRadio">
                            <span></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <input type="radio" id="radio11" name="tipoFalla" value="OP" class="botonRadio">
                            <span></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio12" name="tipoFalla" value="EL" class="botonRadio">
                            <span></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio13" name="tipoFalla" value="D" class="botonRadio">
                            <span></span>
                            <label for="radio13">Deterioro</label>
                        </li>
                        <li>
                            <input type="radio" id="radio14" name="tipoFalla" value="OT" class="botonRadio">
                            <span></span>
                            <label for="radio14">Otra</label>
                        </li>';
                break;
            case 'M':
                $falla.='<li>
                            <input type="radio" id="radio1" name="tipoFalla" value="0" class="botonRadio" required="true">
                            <span></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <input type="radio" id="radio2" name="tipoFalla" value="MU" class="botonRadio">
                            <span></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <input type="radio" id="radio3" name="tipoFalla" value="C" class="botonRadio">
                            <span></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <input type="radio" id="radio4" name="tipoFalla" value="M" class="botonRadio" checked>
                            <span></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio5" name="tipoFalla" value="H" class="botonRadio">
                            <span></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio6" name="tipoFalla" value="O" class="botonRadio">
                            <span></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <input type="radio" id="radio7" name="tipoFalla" value="E" class="botonRadio">
                            <span></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio8" name="tipoFalla" value="S" class="botonRadio">
                            <span></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <input type="radio" id="radio9" name="tipoFalla" value="A" class="botonRadio">
                            <span></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <input type="radio" id="radio10" name="tipoFalla" value="N" class="botonRadio">
                            <span></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <input type="radio" id="radio11" name="tipoFalla" value="OP" class="botonRadio">
                            <span></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio12" name="tipoFalla" value="EL" class="botonRadio">
                            <span></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio13" name="tipoFalla" value="D" class="botonRadio">
                            <span></span>
                            <label for="radio13">Deterioro</label>
                        </li>
                        <li>
                            <input type="radio" id="radio14" name="tipoFalla" value="OT" class="botonRadio">
                            <span></span>
                            <label for="radio14">Otra</label>
                        </li>';
                break;
            case 'H':
                $falla.='<li>
                            <input type="radio" id="radio1" name="tipoFalla" value="0" class="botonRadio" required="true">
                            <span></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <input type="radio" id="radio2" name="tipoFalla" value="MU" class="botonRadio">
                            <span></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <input type="radio" id="radio3" name="tipoFalla" value="C" class="botonRadio">
                            <span></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <input type="radio" id="radio4" name="tipoFalla" value="M" class="botonRadio">
                            <span></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio5" name="tipoFalla" value="H" class="botonRadio" checked>
                            <span></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio6" name="tipoFalla" value="O" class="botonRadio">
                            <span></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <input type="radio" id="radio7" name="tipoFalla" value="E" class="botonRadio">
                            <span></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio8" name="tipoFalla" value="S" class="botonRadio">
                            <span></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <input type="radio" id="radio9" name="tipoFalla" value="A" class="botonRadio">
                            <span></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <input type="radio" id="radio10" name="tipoFalla" value="N" class="botonRadio">
                            <span></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <input type="radio" id="radio11" name="tipoFalla" value="OP" class="botonRadio">
                            <span></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio12" name="tipoFalla" value="EL" class="botonRadio">
                            <span></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio13" name="tipoFalla" value="D" class="botonRadio">
                            <span></span>
                            <label for="radio13">Deterioro</label>
                        </li>
                        <li>
                            <input type="radio" id="radio14" name="tipoFalla" value="OT" class="botonRadio">
                            <span></span>
                            <label for="radio14">Otra</label>
                        </li>';
                break;
            case 'O':
                $falla.='<li>
                            <input type="radio" id="radio1" name="tipoFalla" value="0" class="botonRadio" required="true">
                            <span></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <input type="radio" id="radio2" name="tipoFalla" value="MU" class="botonRadio">
                            <span></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <input type="radio" id="radio3" name="tipoFalla" value="C" class="botonRadio">
                            <span></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <input type="radio" id="radio4" name="tipoFalla" value="M" class="botonRadio">
                            <span></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio5" name="tipoFalla" value="H" class="botonRadio">
                            <span></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio6" name="tipoFalla" value="O" class="botonRadio" checked>
                            <span></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <input type="radio" id="radio7" name="tipoFalla" value="E" class="botonRadio">
                            <span></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio8" name="tipoFalla" value="S" class="botonRadio">
                            <span></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <input type="radio" id="radio9" name="tipoFalla" value="A" class="botonRadio">
                            <span></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <input type="radio" id="radio10" name="tipoFalla" value="N" class="botonRadio">
                            <span></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <input type="radio" id="radio11" name="tipoFalla" value="OP" class="botonRadio">
                            <span></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio12" name="tipoFalla" value="EL" class="botonRadio">
                            <span></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio13" name="tipoFalla" value="D" class="botonRadio">
                            <span></span>
                            <label for="radio13">Deterioro</label>
                        </li>
                        <li>
                            <input type="radio" id="radio14" name="tipoFalla" value="OT" class="botonRadio">
                            <span></span>
                            <label for="radio14">Otra</label>
                        </li>';
                break;
            case 'E':
                $falla.='<li>
                            <input type="radio" id="radio1" name="tipoFalla" value="0" class="botonRadio" required="true">
                            <span></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <input type="radio" id="radio2" name="tipoFalla" value="MU" class="botonRadio">
                            <span></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <input type="radio" id="radio3" name="tipoFalla" value="C" class="botonRadio">
                            <span></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <input type="radio" id="radio4" name="tipoFalla" value="M" class="botonRadio">
                            <span></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio5" name="tipoFalla" value="H" class="botonRadio">
                            <span></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio6" name="tipoFalla" value="O" class="botonRadio">
                            <span></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <input type="radio" id="radio7" name="tipoFalla" value="E" class="botonRadio" checked>
                            <span></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio8" name="tipoFalla" value="S" class="botonRadio">
                            <span></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <input type="radio" id="radio9" name="tipoFalla" value="A" class="botonRadio">
                            <span></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <input type="radio" id="radio10" name="tipoFalla" value="N" class="botonRadio">
                            <span></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <input type="radio" id="radio11" name="tipoFalla" value="OP" class="botonRadio">
                            <span></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio12" name="tipoFalla" value="EL" class="botonRadio">
                            <span></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio13" name="tipoFalla" value="D" class="botonRadio">
                            <span></span>
                            <label for="radio13">Deterioro</label>
                        </li>
                        <li>
                            <input type="radio" id="radio14" name="tipoFalla" value="OT" class="botonRadio">
                            <span></span>
                            <label for="radio14">Otra</label>
                        </li>';
                break;
            case 'S':
                $falla.='<li>
                            <input type="radio" id="radio1" name="tipoFalla" value="0" class="botonRadio" required="true">
                            <span></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <input type="radio" id="radio2" name="tipoFalla" value="MU" class="botonRadio">
                            <span></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <input type="radio" id="radio3" name="tipoFalla" value="C" class="botonRadio">
                            <span></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <input type="radio" id="radio4" name="tipoFalla" value="M" class="botonRadio">
                            <span></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio5" name="tipoFalla" value="H" class="botonRadio">
                            <span></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio6" name="tipoFalla" value="O" class="botonRadio">
                            <span></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <input type="radio" id="radio7" name="tipoFalla" value="E" class="botonRadio">
                            <span></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio8" name="tipoFalla" value="S" class="botonRadio" checked>
                            <span></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <input type="radio" id="radio9" name="tipoFalla" value="A" class="botonRadio">
                            <span></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <input type="radio" id="radio10" name="tipoFalla" value="N" class="botonRadio">
                            <span></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <input type="radio" id="radio11" name="tipoFalla" value="OP" class="botonRadio">
                            <span></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio12" name="tipoFalla" value="EL" class="botonRadio">
                            <span></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio13" name="tipoFalla" value="D" class="botonRadio">
                            <span></span>
                            <label for="radio13">Deterioro</label>
                        </li>
                        <li>
                            <input type="radio" id="radio14" name="tipoFalla" value="OT" class="botonRadio">
                            <span></span>
                            <label for="radio14">Otra</label>
                        </li>';
                break;
            case 'A':
                $falla.='<li>
                            <input type="radio" id="radio1" name="tipoFalla" value="0" class="botonRadio" required="true">
                            <span></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <input type="radio" id="radio2" name="tipoFalla" value="MU" class="botonRadio">
                            <span></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <input type="radio" id="radio3" name="tipoFalla" value="C" class="botonRadio">
                            <span></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <input type="radio" id="radio4" name="tipoFalla" value="M" class="botonRadio">
                            <span></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio5" name="tipoFalla" value="H" class="botonRadio">
                            <span></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio6" name="tipoFalla" value="O" class="botonRadio">
                            <span></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <input type="radio" id="radio7" name="tipoFalla" value="E" class="botonRadio">
                            <span></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio8" name="tipoFalla" value="S" class="botonRadio">
                            <span></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <input type="radio" id="radio9" name="tipoFalla" value="A" class="botonRadio" checked>
                            <span></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <input type="radio" id="radio10" name="tipoFalla" value="N" class="botonRadio">
                            <span></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <input type="radio" id="radio11" name="tipoFalla" value="OP" class="botonRadio">
                            <span></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio12" name="tipoFalla" value="EL" class="botonRadio">
                            <span></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio13" name="tipoFalla" value="D" class="botonRadio">
                            <span></span>
                            <label for="radio13">Deterioro</label>
                        </li>
                        <li>
                            <input type="radio" id="radio14" name="tipoFalla" value="OT" class="botonRadio">
                            <span></span>
                            <label for="radio14">Otra</label>
                        </li>';
                break;
            case 'N':
                $falla.='<li>
                            <input type="radio" id="radio1" name="tipoFalla" value="0" class="botonRadio" required="true">
                            <span></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <input type="radio" id="radio2" name="tipoFalla" value="MU" class="botonRadio">
                            <span></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <input type="radio" id="radio3" name="tipoFalla" value="C" class="botonRadio">
                            <span></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <input type="radio" id="radio4" name="tipoFalla" value="M" class="botonRadio">
                            <span></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio5" name="tipoFalla" value="H" class="botonRadio">
                            <span></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio6" name="tipoFalla" value="O" class="botonRadio">
                            <span></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <input type="radio" id="radio7" name="tipoFalla" value="E" class="botonRadio">
                            <span></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio8" name="tipoFalla" value="S" class="botonRadio">
                            <span></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <input type="radio" id="radio9" name="tipoFalla" value="A" class="botonRadio">
                            <span></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <input type="radio" id="radio10" name="tipoFalla" value="N" class="botonRadio" checked>
                            <span></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <input type="radio" id="radio11" name="tipoFalla" value="OP" class="botonRadio">
                            <span></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio12" name="tipoFalla" value="EL" class="botonRadio">
                            <span></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio13" name="tipoFalla" value="D" class="botonRadio">
                            <span></span>
                            <label for="radio13">Deterioro</label>
                        </li>
                        <li>
                            <input type="radio" id="radio14" name="tipoFalla" value="OT" class="botonRadio">
                            <span></span>
                            <label for="radio14">Otra</label>
                        </li>';
                break;
            case 'OP':
                $falla.='<li>
                            <input type="radio" id="radio1" name="tipoFalla" value="0" class="botonRadio" required="true">
                            <span></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <input type="radio" id="radio2" name="tipoFalla" value="MU" class="botonRadio">
                            <span></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <input type="radio" id="radio3" name="tipoFalla" value="C" class="botonRadio">
                            <span></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <input type="radio" id="radio4" name="tipoFalla" value="M" class="botonRadio">
                            <span></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio5" name="tipoFalla" value="H" class="botonRadio">
                            <span></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio6" name="tipoFalla" value="O" class="botonRadio">
                            <span></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <input type="radio" id="radio7" name="tipoFalla" value="E" class="botonRadio">
                            <span></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio8" name="tipoFalla" value="S" class="botonRadio">
                            <span></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <input type="radio" id="radio9" name="tipoFalla" value="A" class="botonRadio">
                            <span></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <input type="radio" id="radio10" name="tipoFalla" value="N" class="botonRadio">
                            <span></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <input type="radio" id="radio11" name="tipoFalla" value="OP" class="botonRadio" checked>
                            <span></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio12" name="tipoFalla" value="EL" class="botonRadio">
                            <span></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio13" name="tipoFalla" value="D" class="botonRadio">
                            <span></span>
                            <label for="radio13">Deterioro</label>
                        </li>
                        <li>
                            <input type="radio" id="radio14" name="tipoFalla" value="OT" class="botonRadio">
                            <span></span>
                            <label for="radio14">Otra</label>
                        </li>';
                break;
            case 'EL':
                $falla.='<li>
                            <input type="radio" id="radio1" name="tipoFalla" value="0" class="botonRadio" required="true">
                            <span></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <input type="radio" id="radio2" name="tipoFalla" value="MU" class="botonRadio">
                            <span></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <input type="radio" id="radio3" name="tipoFalla" value="C" class="botonRadio">
                            <span></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <input type="radio" id="radio4" name="tipoFalla" value="M" class="botonRadio">
                            <span></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio5" name="tipoFalla" value="H" class="botonRadio">
                            <span></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio6" name="tipoFalla" value="O" class="botonRadio">
                            <span></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <input type="radio" id="radio7" name="tipoFalla" value="E" class="botonRadio">
                            <span></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio8" name="tipoFalla" value="S" class="botonRadio">
                            <span></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <input type="radio" id="radio9" name="tipoFalla" value="A" class="botonRadio">
                            <span></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <input type="radio" id="radio10" name="tipoFalla" value="N" class="botonRadio">
                            <span></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <input type="radio" id="radio11" name="tipoFalla" value="OP" class="botonRadio">
                            <span></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio12" name="tipoFalla" value="EL" class="botonRadio" checked>
                            <span></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio13" name="tipoFalla" value="D" class="botonRadio">
                            <span></span>
                            <label for="radio13">Deterioro</label>
                        </li>
                        <li>
                            <input type="radio" id="radio14" name="tipoFalla" value="OT" class="botonRadio">
                            <span></span>
                            <label for="radio14">Otra</label>
                        </li>';
                break;
            case 'D':
                $falla.='<li>
                            <input type="radio" id="radio1" name="tipoFalla" value="0" class="botonRadio" required="true">
                            <span></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <input type="radio" id="radio2" name="tipoFalla" value="MU" class="botonRadio">
                            <span></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <input type="radio" id="radio3" name="tipoFalla" value="C" class="botonRadio">
                            <span></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <input type="radio" id="radio4" name="tipoFalla" value="M" class="botonRadio">
                            <span></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio5" name="tipoFalla" value="H" class="botonRadio">
                            <span></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio6" name="tipoFalla" value="O" class="botonRadio">
                            <span></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <input type="radio" id="radio7" name="tipoFalla" value="E" class="botonRadio">
                            <span></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio8" name="tipoFalla" value="S" class="botonRadio">
                            <span></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <input type="radio" id="radio9" name="tipoFalla" value="A" class="botonRadio">
                            <span></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <input type="radio" id="radio10" name="tipoFalla" value="N" class="botonRadio">
                            <span></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <input type="radio" id="radio11" name="tipoFalla" value="OP" class="botonRadio">
                            <span></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio12" name="tipoFalla" value="EL" class="botonRadio">
                            <span></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio13" name="tipoFalla" value="D" class="botonRadio" checked>
                            <span></span>
                            <label for="radio13">Deterioro</label>
                        </li>
                        <li>
                            <input type="radio" id="radio14" name="tipoFalla" value="OT" class="botonRadio">
                            <span></span>
                            <label for="radio14">Otra</label>
                        </li>';
                break;
            case 'OT':
                $falla.= '<li>
                            <input type="radio" id="radio1" name="tipoFalla" value="0" class="botonRadio" required="true">
                            <span></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <input type="radio" id="radio2" name="tipoFalla" value="MU" class="botonRadio">
                            <span></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <input type="radio" id="radio3" name="tipoFalla" value="C" class="botonRadio">
                            <span></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <input type="radio" id="radio4" name="tipoFalla" value="M" class="botonRadio">
                            <span></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio5" name="tipoFalla" value="H" class="botonRadio">
                            <span></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio6" name="tipoFalla" value="O" class="botonRadio">
                            <span></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <input type="radio" id="radio7" name="tipoFalla" value="E" class="botonRadio">
                            <span></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio8" name="tipoFalla" value="S" class="botonRadio">
                            <span></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <input type="radio" id="radio9" name="tipoFalla" value="A" class="botonRadio">
                            <span></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <input type="radio" id="radio10" name="tipoFalla" value="N" class="botonRadio">
                            <span></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <input type="radio" id="radio11" name="tipoFalla" value="OP" class="botonRadio">
                            <span></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio12" name="tipoFalla" value="EL" class="botonRadio">
                            <span></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio13" name="tipoFalla" value="D" class="botonRadio">
                            <span></span>
                            <label for="radio13">Deterioro</label>
                        </li>
                        <li>
                            <input type="radio" id="radio14" name="tipoFalla" value="OT" class="botonRadio" checked>
                            <span></span>
                            <label for="radio14">Otra</label>
                        </li>';
                break;
            default :
                $falla.='<li>
                            <input type="radio" id="radio1" name="tipoFalla" value="0" class="botonRadio" required="true">
                            <span></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <input type="radio" id="radio2" name="tipoFalla" value="MU" class="botonRadio">
                            <span></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <input type="radio" id="radio3" name="tipoFalla" value="C" class="botonRadio">
                            <span></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <input type="radio" id="radio4" name="tipoFalla" value="M" class="botonRadio">
                            <span></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio5" name="tipoFalla" value="H" class="botonRadio">
                            <span></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio6" name="tipoFalla" value="O" class="botonRadio">
                            <span></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <input type="radio" id="radio7" name="tipoFalla" value="E" class="botonRadio">
                            <span></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio8" name="tipoFalla" value="S" class="botonRadio">
                            <span></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <input type="radio" id="radio9" name="tipoFalla" value="A" class="botonRadio">
                            <span></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <input type="radio" id="radio10" name="tipoFalla" value="N" class="botonRadio">
                            <span></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <input type="radio" id="radio11" name="tipoFalla" value="OP" class="botonRadio">
                            <span></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio12" name="tipoFalla" value="EL" class="botonRadio">
                            <span></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <input type="radio" id="radio13" name="tipoFalla" value="D" class="botonRadio">
                            <span></span>
                            <label for="radio13">Deterioro</label>
                        </li>
                        <li>
                            <input type="radio" id="radio14" name="tipoFalla" value="OT" class="botonRadio">
                            <span></span>
                            <label for="radio14">Otra</label>
                        </li>';
                break;
        }
        return $falla;
    }
    function getTipoFallaListaReporte($cambio) {
		$ruta='../../../';
		if($cambio!=null)$ruta='../';
        $falla='';
        switch ($this->tipoFalla) {
            case '0':
                $falla.='<li>                                
                            <span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                                <label for="radio3">Consumible</label>
                            </li>
                            <li>
                                <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                                <label for="radio4">Mecánica</label>
                            </li>
                            <li>
                                <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                                <label for="radio5">Hidráulica</label>
                            </li>
                            <li>
                                <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                                <label for="radio6">Operativa</label>
                            </li>
                            <li>
                                <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                                <label for="radio7">Electrónica</label>
                            </li>
                            <li>
                                <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                                <label for="radio8">Software</label>
                            </li>
                            <li>
                                <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                                <label for="radio9">Accesorio</label>
                            </li>                            
                            <li>
                                <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                                <label for="radio14">Otra</label>
                            </li>
                            <li>
                                <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                                <label for="radio10">Neumática</label>
                            </li>
                            <li>
                                <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                                <label for="radio11">Optica</label>
                            </li>
                            <li>
                                <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                                <label for="radio12">Eléctrica</label>
                            </li>
                            <li>
                                <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                                <label for="radio13">Deterioro</label>
                            </li>';
                break;
            case 'MU':
                $falla.='<li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'C':
                $falla.='<li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'M':
                $falla.='<li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'H':
                $falla.='<li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'O':
                $falla.='<li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'E':
                $falla.='<li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'S':
                $falla.='<li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'A':
                $falla.='<li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'N':
                $falla.='<li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'OP':
                $falla.='<li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'EL':
                $falla.='<li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'D':
                $falla.='<li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'OT':
                $falla.= '<li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
        }
        return $falla;
    }
    
    function getFuncionamientoEquipoRadio() {
        $funcionamiento= $this->funcionamiento;
        $lista='';
        switch ($funcionamiento) {
            case 'S':
                $lista.='<input type="radio" name="funcionamiento" value="S" required checked><label>Si</label><span></span>';
                $lista.='<input type="radio" name="funcionamiento" value="N"><label>No</label><span></span>';
                break;
            case 'N':
                $lista.='<input type="radio" name="funcionamiento" value="S" required><label>Si</label><span></span>';
                $lista.='<input type="radio" name="funcionamiento" value="N" checked><label>No</label><span></span>';
                break;
            default:
                $lista.='<input type="radio" name="funcionamiento" value="S" required><label>Si</label><span></span>';
                $lista.='<input type="radio" name="funcionamiento" value="N"><label>No</label><span></span>';
                break;
        }
        return $lista;
    }
    function getTipoMantenimientoRadio($tipoMantenimiento) {
        $lista='';
        switch ($tipoMantenimiento) {
            case 'P':
                $lista.='<li><input type="radio" id="mantenimiento1" name="tipoMantenimiento" value="P" class="botonRadio" required="true" checked><span></span><label for="mantenimiento1">Preventivo</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento2" name="tipoMantenimiento" value="C" class="botonRadio"><span></span><label for="mantenimiento2">Correctivo</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento3" name="tipoMantenimiento" value="D" class="botonRadio"><span></span><label for="mantenimiento3">Diagnóstico</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento4" name="tipoMantenimiento" value="I" class="botonRadio"><span></span><label for="mantenimiento4">Instalación</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento5" name="tipoMantenimiento" value="G" class="botonRadio"><span></span><label for="mantenimiento5">Garantía</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento6" name="tipoMantenimiento" value="A" class="botonRadio"><span></span><label for="mantenimiento6">Alistamiento</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento7" name="tipoMantenimiento" value="O" class="botonRadio"><span></span><label for="mantenimiento7">Otro</label></li>';
                break;
            case 'C':
                $lista.='<li><input type="radio" id="mantenimiento1" name="tipoMantenimiento" value="P" class="botonRadio" required="true" ><span></span><label for="mantenimiento1">Preventivo</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento2" name="tipoMantenimiento" value="C" class="botonRadio" checked><span></span><label for="mantenimiento2">Correctivo</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento3" name="tipoMantenimiento" value="D" class="botonRadio"><span></span><label for="mantenimiento3">Diagnóstico</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento4" name="tipoMantenimiento" value="I" class="botonRadio"><span></span><label for="mantenimiento4">Instalación</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento5" name="tipoMantenimiento" value="G" class="botonRadio"><span></span><label for="mantenimiento5">Garantía</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento6" name="tipoMantenimiento" value="A" class="botonRadio"><span></span><label for="mantenimiento6">Alistamiento</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento7" name="tipoMantenimiento" value="O" class="botonRadio"><span></span><label for="mantenimiento7">Otro</label></li>';
                break;
            case 'D':
                $lista.='<li><input type="radio" id="mantenimiento1" name="tipoMantenimiento" value="P" class="botonRadio" required="true"><span></span><label for="mantenimiento1">Preventivo</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento2" name="tipoMantenimiento" value="C" class="botonRadio"><span></span><label for="mantenimiento2">Correctivo</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento3" name="tipoMantenimiento" value="D" class="botonRadio" checked><span></span><label for="mantenimiento3">Diagnóstico</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento4" name="tipoMantenimiento" value="I" class="botonRadio"><span></span><label for="mantenimiento4">Instalación</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento5" name="tipoMantenimiento" value="G" class="botonRadio"><span></span><label for="mantenimiento5">Garantía</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento6" name="tipoMantenimiento" value="A" class="botonRadio"><span></span><label for="mantenimiento6">Alistamiento</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento7" name="tipoMantenimiento" value="O" class="botonRadio"><span></span><label for="mantenimiento7">Otro</label></li>';
                break;
            case 'I':
                $lista.='<li><input type="radio" id="mantenimiento1" name="tipoMantenimiento" value="P" class="botonRadio" required="true"><span></span><label for="mantenimiento1">Preventivo</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento2" name="tipoMantenimiento" value="C" class="botonRadio"><span></span><label for="mantenimiento2">Correctivo</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento3" name="tipoMantenimiento" value="D" class="botonRadio"><span></span><label for="mantenimiento3">Diagnóstico</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento4" name="tipoMantenimiento" value="I" class="botonRadio" checked><span></span><label for="mantenimiento4">Instalación</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento5" name="tipoMantenimiento" value="G" class="botonRadio"><span></span><label for="mantenimiento5">Garantía</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento6" name="tipoMantenimiento" value="A" class="botonRadio"><span></span><label for="mantenimiento6">Alistamiento</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento7" name="tipoMantenimiento" value="O" class="botonRadio"><span></span><label for="mantenimiento7">Otro</label></li>';
                break;
            case 'G':
                $lista.='<li><input type="radio" id="mantenimiento1" name="tipoMantenimiento" value="P" class="botonRadio" required="true"><span></span><label for="mantenimiento1">Preventivo</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento2" name="tipoMantenimiento" value="C" class="botonRadio"><span></span><label for="mantenimiento2">Correctivo</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento3" name="tipoMantenimiento" value="D" class="botonRadio"><span></span><label for="mantenimiento3">Diagnóstico</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento4" name="tipoMantenimiento" value="I" class="botonRadio"><span></span><label for="mantenimiento4">Instalación</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento5" name="tipoMantenimiento" value="G" class="botonRadio" checked><span></span><label for="mantenimiento5">Garantía</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento6" name="tipoMantenimiento" value="A" class="botonRadio"><span></span><label for="mantenimiento6">Alistamiento</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento7" name="tipoMantenimiento" value="O" class="botonRadio"><span></span><label for="mantenimiento7">Otro</label></li>';
                break;
            case 'A':
                $lista.='<li><input type="radio" id="mantenimiento1" name="tipoMantenimiento" value="P" class="botonRadio" required="true"><span></span><label for="mantenimiento1">Preventivo</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento2" name="tipoMantenimiento" value="C" class="botonRadio"><span></span><label for="mantenimiento2">Correctivo</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento3" name="tipoMantenimiento" value="D" class="botonRadio"><span></span><label for="mantenimiento3">Diagnóstico</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento4" name="tipoMantenimiento" value="I" class="botonRadio"><span></span><label for="mantenimiento4">Instalación</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento5" name="tipoMantenimiento" value="G" class="botonRadio"><span></span><label for="mantenimiento5">Garantía</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento6" name="tipoMantenimiento" value="A" class="botonRadio" checked><span></span><label for="mantenimiento6">Alistamiento</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento7" name="tipoMantenimiento" value="O" class="botonRadio"><span></span><label for="mantenimiento7">Otro</label></li>';
                break;
            case 'O':
                $lista.='<li><input type="radio" id="mantenimiento1" name="tipoMantenimiento" value="P" class="botonRadio" required="true"><span></span><label for="mantenimiento1">Preventivo</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento2" name="tipoMantenimiento" value="C" class="botonRadio"><span></span><label for="mantenimiento2">Correctivo</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento3" name="tipoMantenimiento" value="D" class="botonRadio"><span></span><label for="mantenimiento3">Diagnóstico</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento4" name="tipoMantenimiento" value="I" class="botonRadio"><span></span><label for="mantenimiento4">Instalación</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento5" name="tipoMantenimiento" value="G" class="botonRadio"><span></span><label for="mantenimiento5">Garantía</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento6" name="tipoMantenimiento" value="A" class="botonRadio"><span></span><label for="mantenimiento6">Alistamiento</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento7" name="tipoMantenimiento" value="O" class="botonRadio" checked><span></span><label for="mantenimiento7">Otro</label></li>';
                break;
            default:
                $lista.='<li><input type="radio" id="mantenimiento1" name="tipoMantenimiento" value="P" class="botonRadio" required="true"><span></span><label for="mantenimiento1">Preventivo</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento2" name="tipoMantenimiento" value="C" class="botonRadio"><span></span><label for="mantenimiento2">Correctivo</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento3" name="tipoMantenimiento" value="D" class="botonRadio"><span></span><label for="mantenimiento3">Diagnóstico</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento4" name="tipoMantenimiento" value="I" class="botonRadio"><span></span><label for="mantenimiento4">Instalación</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento5" name="tipoMantenimiento" value="G" class="botonRadio"><span></span><label for="mantenimiento5">Garantía</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento6" name="tipoMantenimiento" value="A" class="botonRadio"><span></span><label for="mantenimiento6">Alistamiento</label></li>';
                $lista.='<li><input type="radio" id="mantenimiento7" name="tipoMantenimiento" value="O" class="botonRadio"><span></span><label for="mantenimiento7">Otro</label></li>';
                break;
        }
        return $lista;
    }
    public static function generarNumeroReporte() {
        date_default_timezone_set('America/Bogota');
        $consecutivo= ConectorBD::ejecutarQuery('select max(consecutivo) from reportePreventivo', null)[0][0];
        if ($consecutivo!=null) $reporte=new ReportePreventivo('consecutivo', $consecutivo);
        else $reporte=new ReportePreventivo(null, null);
            if ($reporte->getNumeroReporte()!=null){
                $nuevoNumero=$reporte->getNumeroReporte()+1;
            }else{
                $nuevoNumero='207201';
            }
        return $nuevoNumero;
    }
// Inicio Generar Numero de Reporte

	public static function getGenerarNumeroReporte(){
		$ultimoGuardado=ConectorBD::ejecutarQuery('select max(numeroreporte) from reportePreventivo', null)[0][0];
		$consecutivo=$ultimoGuardado+1;
	return $consecutivo;
	}
// Fin Generar Numero de Reporte

//Inicio metodos de gestion
    function grabar() {
        $columnas="ciudad,tipoFalla,otraFalla,idePersona,ideMantenimientoPreventivo,ideEquipo,problemaPresentado,funcionamiento, observaciones, aspectoFisico, condicionAmbiental, limpiezaInterna, limpiezaExterna, pruebasFuncionamiento, lubricacionPartes, pruebaInicial, sistemaElectronico, sistemaHidraulico, sistemaNeumatico,sistemaMecanico, sistemaElectrico,sistemaOptico, sistemaOperativo, sistemaElectromecanico, sistemaVapor,fecha,tipoMantenimiento,ideRutinaExtra,ideunidadmedida1,valormedido1,valornominal1,ideunidadmedida2,valormedido2,valornominal2,ideunidadmedida3,valormedido3,valornominal3,ideunidadmedida4,valormedido4,valornominal4,ideunidadmedida5,valormedido5,valornominal5,ideunidadmedida6,valormedido6,valornominal6";
        
		$valores="'{$this->ciudad}','{$this->tipoFalla}','{$this->otraFalla}','{$this->idePersona}',{$this->ideMantenimientoPreventivo},{$this->ideEquipo},'{$this->problemaPresentado}','{$this->funcionamiento}','{$this->observaciones}','{$this->aspectoFisico}','{$this->condicionaAmbiental}','{$this->limpiezaInterna}','{$this->limpiezaExterna}','{$this->pruebasFuncionamiento}','{$this->lubricacionPartes}','{$this->pruebaInicial}','{$this->sistemaElectronico}','{$this->sistemaHidraulico}','{$this->sistemaNeumatico}','{$this->sistemaMecanico}','{$this->sistemaElectrico}','{$this->sistemaOptico}','{$this->sistemaOperativo}','{$this->sistemaElectromecanico}','{$this->sistemaVapor}','{$this->fecha}','{$this->tipoMantenimiento}',{$this->ideRutinaExtra},{$this->ideUnidadMedida1},{$this->valorMedido1},{$this->valorNominal1},{$this->ideUnidadMedida2},{$this->valorMedido2},{$this->valorNominal2},{$this->ideUnidadMedida3},{$this->valorMedido3},{$this->valorNominal3},{$this->ideUnidadMedida4},{$this->valorMedido4},{$this->valorNominal4},{$this->ideUnidadMedida5},{$this->valorMedido5},{$this->valorNominal5},{$this->ideUnidadMedida6},{$this->valorMedido6},{$this->valorNominal6}";
        
		$cadenaSQL="insert into reportePreventivo ($columnas) values($valores)";
		$numeroAleatorio=rand(5, 3000000);
		usleep($numeroAleatorio);

        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    function modificar() {     
        $valores="idePersona='{$this->idePersona}', ciudad='{$this->ciudad}', tipoFalla='{$this->tipoFalla}',otraFalla='{$this->otraFalla}', ideMantenimientoPreventivo={$this->ideMantenimientoPreventivo}, ideEquipo={$this->ideEquipo},problemaPresentado='{$this->problemaPresentado}', funcionamiento='{$this->funcionamiento}',observaciones='{$this->observaciones}',aspectoFisico='{$this->aspectoFisico}',condicionAmbiental='{$this->condicionaAmbiental}',limpiezaInterna='{$this->limpiezaInterna}',limpiezaExterna='{$this->limpiezaExterna}',pruebasFuncionamiento='{$this->pruebasFuncionamiento}',lubricacionPartes='{$this->lubricacionPartes}', pruebaInicial='{$this->pruebaInicial}', sistemaElectronico='{$this->sistemaElectronico}',sistemaHidraulico='{$this->sistemaHidraulico}', sistemaNeumatico='{$this->sistemaNeumatico}', sistemaMecanico='{$this->sistemaMecanico}', sistemaElectrico='{$this->sistemaElectrico}',sistemaOptico='{$this->sistemaOptico}', sistemaOperativo='{$this->sistemaOperativo}',sistemaElectromecanico='{$this->sistemaElectromecanico}', sistemaVapor='{$this->sistemaVapor}',fecha='{$this->fecha}',tipoMantenimiento='{$this->tipoMantenimiento}', ideRutinaExtra={$this->ideRutinaExtra},ideUnidadMedida1={$this->ideUnidadMedida1}, valorMedido1={$this->valorMedido1},valorNominal1={$this->valorNominal1},ideUnidadMedida2={$this->ideUnidadMedida2},valorMedido2={$this->valorMedido2},valorNominal2={$this->valorNominal2},ideUnidadMedida3={$this->ideUnidadMedida3},valorMedido3={$this->valorMedido3},valorNominal3={$this->valorNominal3},ideUnidadMedida4={$this->ideUnidadMedida4},valorMedido4={$this->valorMedido4},valorNominal4={$this->valorNominal4},ideUnidadMedida5={$this->ideUnidadMedida5},valorMedido5={$this->valorMedido5},valorNominal5={$this->valorNominal5},ideUnidadMedida6={$this->ideUnidadMedida6},valorMedido6={$this->valorMedido6},valorNominal6={$this->valorNominal6} where numeroReporte='{$this->numeroReporte}'";
        
		$cadenaSQL="update reportePreventivo set $valores";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    //Fin metodos de gestion
    
    function getAspectoFisicoReporte($cambio) {
		$ruta='../../../';
		if($cambio!=null) $ruta='../';
        switch ($this->getAspectoFisico()) {
            case 'S':
                $lista = '<span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label> Revisión Aspecto Físico del Equipo.</label>';
                break;
            default:
                $lista = '<span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label> Revisión Aspecto Físico del Equipo.</label>';
                break;
        }
        return $lista;
    }
    function getPruebaInicialReporte($cambio) {
		$ruta='../../../';
		if($cambio!=null) $ruta='../';
        $lista="";
        switch ($this->pruebaInicial) {
            case 'S':
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label> Prueba Funcional Inicial.</label>';
                break;
            case 'N':
                $lista='<span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label> Prueba Funcional Inicial.</label>';
                break;
        }
            return $lista;
        }
    function getCondicionAmbientalReporte($cambio) {
		$ruta='../../../';
		if($cambio!=null) $ruta='../';
        $lista="";
        switch ($this->condicionaAmbiental) {
            case 'S':
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label> Revisión Condiciones Ambientales.</label>';
                break;
            default:
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label> Revisión Condiciones Ambientales.</label>';
                break;
            }
            return $lista;
        }
    function getSistemaElectronicoReporte($cambio) {
		$ruta='../../../';
		if($cambio!=null) $ruta='../';
        $lista="";
        switch ($this->sistemaElectronico) {
            case 'S':
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label> Verificación Sistema Electrónico.</label>';
                break;
            default:
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label> Verificación Sistema Electrónico.</label>';
                break;
            }
            return $lista;
        }
    function getSistemaHidraulicoReporte($cambio) {
		$ruta='../../../';
		if($cambio!=null) $ruta='../';
        $lista="";
        switch ($this->sistemaHidraulico) {
            case 'S':
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label> Verificación Sistema Hidráulico.</label>';
                break;
            default:
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label> Verificación Sistema Hidráulico.</label>';
                break;
            }
            return $lista;
        }
    function getSistemaNeumaticoReporte($cambio) {
		$ruta='../../../';
		if($cambio!=null) $ruta='../';
        $lista="";
        switch ($this->sistemaNeumatico) {
            case 'S':
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label> Verificación Sistema Neumático.</label>';
                break;
            default:
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label> Verificación Sistema Neumático.</label>';
                break;
            }
            return $lista;
        }
    function getSistemaMecanicoReporte($cambio) {
		$ruta='../../../';
		if($cambio!=null) $ruta='../';
        $lista="";
        switch ($this->sistemaMecanico) {
            case 'S':
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label> Verificación Sistema Mecánico.</label>';
                break;
            default:
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label> Verificación Sistema Mecánico.</label>';
                break;
            }
            return $lista;
        }
    function getSistemaElectricoReporte($cambio) {
        $ruta='../../../';
		if($cambio!=null) $ruta='../';
		$lista="";
        switch ($this->sistemaElectrico) {
            case 'S':
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label> Verificación Sistema Eléctrico.</label>';
                break;
            default:
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label> Verificación Sistema Eléctrico.</label>';
                break;
            }
            return $lista;
        }
    function getSistemaOpticoReporte($cambio) {
		$ruta='../../../';
		if($cambio!=null) $ruta='../';
        $lista="";
        switch ($this->sistemaOptico) {
            case 'S':
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label> Verificación Sistema Óptico.</label>';
                break;
            default:
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label> Verificación Sistema Óptico.</label>';
                break;
            }
            return $lista;
        }
    function getSistemaElectromecanicoReporte($cambio) {
		$ruta='../../../';
		if($cambio!=null) $ruta='../';
        $lista="";
        switch ($this->sistemaElectromecanico) {
            case 'S':
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label> Verificación Sistema Electromecánico.</label>';
                break;
            default:
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label> Verificación Sistema Electromecánico.</label>';
                break;
            }
            return $lista;
        }
    function getSistemaVaporReporte($cambio) {
		$ruta='../../../';
		if($cambio!=null) $ruta='../';
        $lista="";
        switch ($this->sistemaVapor) {
            case 'S':
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label> Verificación Sistema Vapor.</label>';
                break;
            default:
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label> Verificación Sistema Vapor.</label>';
                break;
            }
            return $lista;
        }
    function getSistemaOperativoReporte($cambio) {
		$ruta='../../../';
		if($cambio!=null) $ruta='../';
        $lista="";
        switch ($this->sistemaOperativo) {
            case 'S':
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label> Verificación Sistema Operativo.</label>';
                break;
            default:
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label> Verificación Sistema Operativo.</label>';
                break;
            }
            return $lista;
        }
    function getLimpiezaInternaReporte($cambio) {
		$ruta='../../../';
		if($cambio!=null) $ruta='../';
        $lista="";
        switch ($this->limpiezaInterna) {
            case 'S':
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label> Limpieza Interna del Equipo.</label>';
                break;
            default:
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label> Limpieza Interna del Equipo.</label>';
                break;
            }
            return $lista;
        }
    function getLimpiezaExternaReporte($cambio) {
		$ruta='../../../';
		if($cambio!=null) $ruta='../';
        $lista="";
        switch ($this->limpiezaExterna) {
            case 'S':
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label> Limpieza Externa del Equipo.</label>';
                break;
            default:
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label> Limpieza Externa del Equipo.</label>';
                break;
            }
            return $lista;
        }
    function getLubricacionPartesReporte($cambio) {
		$ruta='../../../';
		if($cambio!=null) $ruta='../';
        $lista="";
        switch ($this->lubricacionPartes) {
            case 'S':
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label> Lubricación Partes.</label>';
                break;
            default:
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label> Lubricación Partes.</label>';
                break;
            }
            return $lista;
        }
    function getPruebasFuncionamientoReporte($cambio) {
		$ruta='../../../';
		if($cambio!=null) $ruta='../';
        $lista="";
        switch ($this->pruebasFuncionamiento) {
            case 'S':
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label> Pruebas de Funcionamiento.</label>';
                break;
            default:
                $lista.='<span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label> Pruebas de Funcionamiento.</label>';
                break;
            }
            return $lista;
        }

        function getTipoMantenimientoReporte($cambio) {
		$ruta='../../../';
		if($cambio!=null)$ruta='../';
        $lista='';
        switch ($this->tipoMantenimiento) {
            case 'P':
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label>Preventivo</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Correctivo</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Diagnóstico</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Otro</label></li>';   
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Instalación</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Garantía</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Alistamiento</label></li>';              
                
                break;
            case 'C':
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Preventivo</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label>Correctivo</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Diagnóstico</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Otro</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Instalación</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Garantía</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Alistamiento</label></li>';
                
                break;
            case 'D':
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Preventivo</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Correctivo</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label>Diagnóstico</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Otro</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Instalación</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Garantía</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Alistamiento</label></li>';
                
                break;
            case 'I':
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Preventivo</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Correctivo</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Diagnóstico</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Otro</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label>Instalación</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Garantía</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Alistamiento</label></li>';
                
                break;
            case 'G':
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Preventivo</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Correctivo</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Diagnóstico</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Otro</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Instalación</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label>Garantía</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Alistamiento</label></li>';
                
                break;
            case 'A':
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Preventivo</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Correctivo</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Diagnóstico</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Otro</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Instalación</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Garantía</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label>Alistamiento</label></li>';
                
                break;
            case 'O':
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Preventivo</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Correctivo</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Diagnóstico</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="10px"></span><label>Otro</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Instalación</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Garantía</label></li>';
                $lista.='<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="10px"></span><label>Alistamiento</label></li>';
                
                break;
        }
        return $lista;
    }
        function getFuncionamientoCorrectoReporte($cambio) {
			$ruta='../../../';
			if($cambio!=null) $ruta='../';
            switch ($this->funcionamiento) {
                case 'S':
                    $lista = '<li><span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="12px"></span><label>Si</label></li><li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="12px"></span><label>No</label></li>';
                    break;
                case 'N':
                    $lista = '<li><span><img src="'.$ruta.'presentacion/imagenes/vacio.png" height="12px"></span><label>Si</label></li><li><span><img src="'.$ruta.'presentacion/imagenes/visto.png" height="12px"></span><label>No</label></li>';
                    break;
            }
            return $lista;
        }
    //Fin Lista de Reportes Actividades
	function getRedireccionamiento($ideMantenimiento,$ideEquipo){
		$cadenaSQL="select numeroReporte from reportepreventivo where idemantenimientopreventivo={$ideMantenimiento} and ideEquipo={$ideEquipo}";
		$numeroReporte=ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
		return $numeroReporte;
	}

	public static function getDatosArregloJS($filtro){
		$datos="var reportes=new Array();\n";
		$reportes= ReportePreventivo::getDatosEnObjetos($filtro, 'fecha desc');
        	for ($i = 0; $i < count($reportes); $i++) {
            		$reporte= $reportes[$i];
            		$datos .= "reportes[$i]=new Array();\n";
            		$datos .= "\treportes[$i][0]='{$reporte->getFecha()}'\n";
            		$datos .= "\treportes[$i][1]='{$reporte->getNumeroReporte()}'\n";
	    		$datos .= "\treportes[$i][2]='{$reporte->getFechaLista()}'\n";
	    		$datos .= "\treportes[$i][3]='{$reporte->getAnio()}'\n";
        	}
        	return $datos;
	}
}