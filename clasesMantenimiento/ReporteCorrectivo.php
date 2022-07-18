<?php
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../clasesCalidad/Persona.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/UnidadMedida.php';

class ReporteCorrectivo {
    private $numeroReporte;
    private $consecutivo;
    private $ciudad;
    private $tipoFalla;
    private $otraFalla;
    private $idePersona;
    private $ideEquipo;
    private $problemaPresentado;
    private $funcionamiento;
    private $observaciones;
    private $aspectoFisico;
    private $condicionAmbiental;
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
    private $nitCliente;
    private $ideSede;
    private $ideRutinaExtra;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))$this->cargarAtributos($campo);
            else {
                $cadenaSQL="select * from reporteCorrectivo where $campo=$valor";
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
        $this->ideEquipo=$datos['ideequipo'];
        $this->problemaPresentado=$datos['problemapresentado'];
        $this->funcionamiento=$datos['funcionamiento'];
        $this->observaciones=$datos['observaciones'];
        $this->aspectoFisico=$datos['aspectofisico'];
        $this->condicionAmbiental=$datos['condicionambiental'];
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
        $this->nitCliente=$datos['nitcliente'];
        $this->ideSede=$datos['idesede'];
        $this->ideRutinaExtra=$datos['iderutinaextra'];
    }
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
    function getTipoLista() {
        $lista='';
        switch ($this->tipo) {
            case 'I':
                $lista='INFRAESTRUCTURA';
                break;
            case 'EI':
                $lista='EQUIPO INDUSTRIAL';
                break;
            case 'EC':
                $lista='EQUIPO DE CÓMPUTO';
                break;
            case 'EB':
                $lista='EQUIPO BIOMÉDICO';
                break;
            case 'O':
                $lista= $this->otro;
                break;
        }
        return $lista;
    }

    function getOtraFalla() {
        return $this->otraFalla;
    }

    function getIdePersona() {
        return $this->idePersona;
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

    function getCondicionAmbiental() {
        return $this->condicionAmbiental;
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
        $fechaSalida= explode(' ', $this->fecha)[0];
        return $fechaSalida;
    }

    function getTipoMantenimiento() {
        return $this->tipoMantenimiento;
    }

    function getNitCliente() {
        return $this->nitCliente;
    }

    function getIdeSede() {
        return $this->ideSede;
    }
    
    function getIdeRutinaExtra() {
        return $this->ideRutinaExtra;
    }

    function setIdeRutinaExtra($ideRutinaExtra) {
        $this->ideRutinaExtra = $ideRutinaExtra;
    }

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

    function setCondicionAmbiental($condicionAmbiental) {
        $this->condicionAmbiental = $condicionAmbiental;
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

    function setNitCliente($nitCliente) {
        $this->nitCliente = $nitCliente;
    }

    function setIdeSede($ideSede) {
        $this->ideSede = $ideSede;
    }
    //Inicio Llaves Foraneas
    function getEquipo() {
        return new Equipo('ide', $this->ideEquipo);
    }
    function getPersona() {
        return new Persona('identificacion',"'".$this->idePersona."'");
    }
    function getSede() {
        return new Sede('ide', $this->ideSede);
    }
    function getCliente() {
        return new Cliente('nit', "'".$this->nitCliente."'");
    }
    //Fin Llaves Foraneas
    //Inicio funciones de gestion
    function grabarCliente() {
        $campos="numeroReporte,ciudad,tipoFalla,otraFalla,idePersona,ideEquipo,problemaPresentado, funcionamiento, observaciones, aspectoFisico, condicionAmbiental, limpiezaInterna, limpiezaExterna, pruebasFuncionamiento, lubricacionPartes,pruebaInicial, sistemaElectronico,sistemaHidraulico,sistemaNeumatico, sistemaMecanico, sistemaElectrico, sistemaOptico, sistemaOperativo, sistemaElectromecanico, sistemaVapor, fecha, tipoMantenimiento, nitCliente, ideRutinaExtra";
        $valores="'{$this->numeroReporte}','{$this->ciudad}','{$this->tipoFalla}','{$this->otraFalla}','{$this->idePersona}',{$this->ideEquipo},'{$this->problemaPresentado}','{$this->funcionamiento}','{$this->observaciones}','{$this->aspectoFisico}','{$this->condicionAmbiental}','{$this->limpiezaInterna}','{$this->limpiezaExterna}','{$this->pruebasFuncionamiento}','{$this->lubricacionPartes}','{$this->pruebaInicial}','{$this->sistemaElectronico}','{$this->sistemaHidraulico}','{$this->sistemaNeumatico}','{$this->sistemaMecanico}','{$this->sistemaElectrico}','{$this->sistemaOptico}','{$this->sistemaOperativo}','{$this->sistemaElectromecanico}','{$this->sistemaVapor}','{$this->fecha}','{$this->tipoMantenimiento}','{$this->nitCliente}',{$this->ideRutinaExtra}";
        $cadenaSQL="insert into reporteCorrectivo($campos)values($valores)";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function grabarSede() {
        $campos="numeroReporte,ciudad,tipoFalla,otraFalla,idePersona,ideEquipo,problemaPresentado, funcionamiento, observaciones, aspectoFisico, condicionAmbiental, limpiezaInterna, limpiezaExterna, pruebasFuncionamiento, lubricacionPartes,pruebaInicial, sistemaElectronico,sistemaHidraulico,sistemaNeumatico, sistemaMecanico, sistemaElectrico, sistemaOptico, sistemaOperativo, sistemaElectromecanico, sistemaVapor, fecha, tipoMantenimiento, ideSede, ideRutinaExtra";
        $valores="'{$this->numeroReporte}','{$this->ciudad}','{$this->tipoFalla}','{$this->otraFalla}','{$this->idePersona}',{$this->ideEquipo},'{$this->problemaPresentado}','{$this->funcionamiento}','{$this->observaciones}','{$this->aspectoFisico}','{$this->condicionAmbiental}','{$this->limpiezaInterna}','{$this->limpiezaExterna}','{$this->pruebasFuncionamiento}','{$this->lubricacionPartes}','{$this->pruebaInicial}','{$this->sistemaElectronico}','{$this->sistemaHidraulico}','{$this->sistemaNeumatico}','{$this->sistemaMecanico}','{$this->sistemaElectrico}','{$this->sistemaOptico}','{$this->sistemaOperativo}','{$this->sistemaElectromecanico}','{$this->sistemaVapor}','{$this->fecha}','{$this->tipoMantenimiento}',{$this->ideSede},{$this->ideRutinaExtra}";
        $cadenaSQL="insert into reporteCorrectivo($campos)values($valores)";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificarCliente() {
        $cadenaSQL="update reporteCorrectivo set ciudad='{$this->ciudad}', tipoFalla='{$this->tipoFalla}',otraFalla='{$this->otraFalla}', idePersona='{$this->idePersona}',ideEquipo={$this->ideEquipo},problemaPresentado='{$this->problemaPresentado}', funcionamiento='{$this->funcionamiento}', observaciones='{$this->observaciones}',aspectoFisico='{$this->aspectoFisico}', condicionAmbiental='{$this->condicionAmbiental}',limpiezaInterna='{$this->limpiezaInterna}', limpiezaExterna='{$this->limpiezaExterna}',pruebasFuncionamiento='{$this->pruebasFuncionamiento}', lubricacionPartes='{$this->lubricacionPartes}', pruebaInicial='{$this->pruebaInicial}',sistemaElectronico='{$this->sistemaElectronico}',sistemaHidraulico='{$this->sistemaHidraulico}',sistemaNeumatico='{$this->sistemaNeumatico}',sistemaMecanico='{$this->sistemaMecanico}',sistemaElectrico='{$this->sistemaElectrico}', sistemaOptico='{$this->sistemaOptico}',sistemaOperativo='{$this->sistemaOperativo}',sistemaElectromecanico='{$this->sistemaElectromecanico}', sistemaVapor='{$this->sistemaVapor}',Fecha='{$this->fecha}',tipoMantenimiento='{$this->tipoMantenimiento}',ideRutinaExtra={$this->ideRutinaExtra} where numeroReporte='{$this->numeroReporte}'";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificarSede() {
        $cadenaSQL="update reporteCorrectivo set ciudad='{$this->ciudad}', tipoFalla='{$this->tipoFalla}',otraFalla='{$this->otraFalla}', idePersona='{$this->idePersona}',ideEquipo={$this->ideEquipo},problemaPresentado='{$this->problemaPresentado}', funcionamiento='{$this->funcionamiento}', observaciones='{$this->observaciones}',aspectoFisico='{$this->aspectoFisico}', condicionAmbiental='{$this->condicionAmbiental}',limpiezaInterna='{$this->limpiezaInterna}', limpiezaExterna='{$this->limpiezaExterna}',pruebasFuncionamiento='{$this->pruebasFuncionamiento}', lubricacionPartes='{$this->lubricacionPartes}', pruebaInicial='{$this->pruebaInicial}',sistemaElectronico='{$this->sistemaElectronico}',sistemaHidraulico='{$this->sistemaHidraulico}',sistemaNeumatico='{$this->sistemaNeumatico}',sistemaMecanico='{$this->sistemaMecanico}',sistemaElectrico='{$this->sistemaElectrico}', sistemaOptico='{$this->sistemaOptico}',sistemaOperativo='{$this->sistemaOperativo}',sistemaElectromecanico='{$this->sistemaElectromecanico}', sistemaVapor='{$this->sistemaVapor}',Fecha='{$this->fecha}',tipoMantenimiento='{$this->tipoMantenimiento}',ideSede='{$this->ideSede}',ideRutinaExtra={$this->ideRutinaExtra} where numeroReporte='{$this->numeroReporte}'";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    //Fin funciones de gestion
    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from reporteCorrectivo";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";    
        return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= ReporteCorrectivo::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $reporte=new ReporteCorrectivo($datos[$i], null);
            $lista[$i]=$reporte;
        }
        return $lista;
    }
    //metodos
    function getTipoMantenimientoRadio($tipoMantenimento) {
        $lista='';
        switch ($tipoMantenimento) {
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
    function getTipoFallaChk() {
        $falla='';
        switch ($this->tipoFalla) {
            case '0':
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
    function getAspectoFisicoChk() {
        $lista='';
        switch ($this->aspectoFisico) {
            case 'S':
                $lista.='<li><input type="checkbox" id="chk2" name="aspectoFisico" checked class="checkBoton"><label for="chk2">Revisión Aspecto Físico.</label><span></span></li>';
                break;
            default:
                $lista.='<li><input type="checkbox" id="chk2" name="aspectoFisico" class="checkBoton"><label for="chk2">Revisión Aspecto Físico.</label><span></span></li>';
                break;
        }
        return $lista;
    }
    
    function getCondicionAmbientalChk(){
        $lista='';
        switch ($this->condicionAmbiental) {
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
    public static function generarNumeroReporte() {
        date_default_timezone_set('America/Bogota');
        $nuevoNumero='';
        $anioGuardado = ConectorBD::ejecutarQuery('select anioActual from datosNumeroReporte', null)[0][0];
        $consecutivo= ConectorBD::ejecutarQuery('select max(consecutivo) from reporteCorrectivo', null)[0][0];
        if ($consecutivo!=null) $reporte=new ReporteCorrectivo('consecutivo', $consecutivo);
        else $reporte=new ReporteCorrectivo(null, null);        
        if ($reporte->getNumeroReporte()!=null) {
            if ($anioGuardado===date('y')){
                $numeroConsecutivo = substr($reporte->getNumeroReporte(), 2);
                $nuevoNumero=$numeroConsecutivo+1;
            }else{
                ConectorBD::ejecutarQuery("update datosNumeroReporte set anioActual=". date('y'), null);
                $nuevoNumero='1';
            }
        }else{
            $nuevoNumero='1';
        }
        switch (strlen($nuevoNumero)) {
            case 1:
                $adicional='00';
                break;
            case 2:
                $adicional='0';
                break;
            
            default:
                $adicional=$nuevoNumero;
                break;
        }
        return date('y').$adicional.$nuevoNumero;
    }
    //metodos
        //Fin metodos de gestion
        function getTipoFallaListaReporte() {
        $falla='';
        switch ($this->tipoFalla) {
            case '0':
                $falla.='<li>                                
                            <span><img src="../../../presentacion/imagenes/visto.png" height="13px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                                <label for="radio3">Consumible</label>
                            </li>
                            <li>
                                <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                                <label for="radio4">Mecánica</label>
                            </li>
                            <li>
                                <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                                <label for="radio5">Hidráulica</label>
                            </li>
                            <li>
                                <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                                <label for="radio6">Operativa</label>
                            </li>
                            <li>
                                <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                                <label for="radio7">Electrónica</label>
                            </li>
                            <li>
                                <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                                <label for="radio8">Software</label>
                            </li>
                            <li>
                                <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                                <label for="radio9">Accesorio</label>
                            </li>                            
                            <li>
                                <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                                <label for="radio14">Otra</label>
                            </li>
                            <li>
                                <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                                <label for="radio10">Neumática</label>
                            </li>
                            <li>
                                <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                                <label for="radio11">Optica</label>
                            </li>
                            <li>
                                <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                                <label for="radio12">Eléctrica</label>
                            </li>
                            <li>
                                <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                                <label for="radio13">Deterioro</label>
                            </li>';
                break;
            case 'MU':
                $falla.='<li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/visto.png" height="13px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'C':
                $falla.='<li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/visto.png" height="13px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'M':
                $falla.='<li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/visto.png" height="13px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'H':
                $falla.='<li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/visto.png" height="13px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'O':
                $falla.='<li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/visto.png" height="13px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'E':
                $falla.='<li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/visto.png" height="13px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'S':
                $falla.='<li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/visto.png" height="13px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'A':
                $falla.='<li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/visto.png" height="13px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'N':
                $falla.='<li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/visto.png" height="13px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'OP':
                $falla.='<li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/visto.png" height="13px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'EL':
                $falla.='<li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/visto.png" height="13px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'D':
                $falla.='<li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/visto.png" height="13px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
            case 'OT':
                $falla.= '<li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio1">Ninguno</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio2">Mal Uso</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio3">Consumible</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio4">Mecánica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio5">Hidráulica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio6">Operativa</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio7">Electrónica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio8">Software</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio9">Accesorio</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/visto.png" height="13px"></span>
                            <label for="radio14">Otra</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio10">Neumática</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio11">Optica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio12">Eléctrica</label>
                        </li>
                        <li>
                            <span><img src="../../../presentacion/imagenes/vacio.png" height="13px"></span>
                            <label for="radio13">Deterioro</label>
                        </li>';
                break;
        }
        return $falla;
    }
    function getAspectoFisicoReporte() {
        switch ($this->getAspectoFisico()) {
            case 'S':
                $lista = '<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Revision Aspecto Físico del Equipo.</label></li>';
                break;
            default:
                $lista = '<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Revision Aspecto Físico del Equipo.</label></li>';
                break;
        }
        return $lista;
    }
    function getPruebaInicialReporte() {
        $lista="";
        switch ($this->getPruebaInicial()) {
            case 'S':
                $lista.='<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Prueba Funcional Inicial.</label></li>';
                break;
            case 'N':
                $lista='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Prueba Funcional Inicial.</label></li>';
                break;
            }
            return $lista;
        }
    function getCondicionAmbientalReporte() {
        $lista="";
        switch ($this->condicionAmbiental) {
            case 'S':
                $lista.='<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Revisión Condicciones Ambientales.</label></li>';
                break;
            default:
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Revisión Condicciones Ambientales.</label></li>';
                break;
            }
            return $lista;
        }
    function getSistemaElectronicoReporte() {
        $lista="";
        switch ($this->sistemaElectronico) {
            case 'S':
                $lista.='<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Verificación Sistema Electrónico.</label></li>';
                break;
            default:
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Verificación Sistema Electrónico.</label></li>';
                break;
            }
            return $lista;
        }
    function getSistemaHidraulicoReporte() {
        $lista="";
        switch ($this->sistemaHidraulico) {
            case 'S':
                $lista.='<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Verificación Sistema Hidráulico.</label></li>';
                break;
            default:
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Verificación Sistema Hidráulico.</label></li>';
                break;
            }
            return $lista;
        }
    function getSistemaNeumaticoReporte() {
        $lista="";
        switch ($this->sistemaNeumatico) {
            case 'S':
                $lista.='<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Verificación Sistema Neumático.</label></li>';
                break;
            default:
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Verificación Sistema Neumático.</label></li>';
                break;
            }
            return $lista;
        }
    function getSistemaMecanicoReporte() {
        $lista="";
        switch ($this->sistemaMecanico) {
            case 'S':
                $lista.='<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Verificación Sistema Mecánico.</label></li>';
                break;
            default:
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Verificación Sistema Mecánico.</label></li>';
                break;
            }
            return $lista;
        }
    function getSistemaElectricoReporte() {
        $lista="";
        switch ($this->sistemaElectrico) {
            case 'S':
                $lista.='<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Verificación Sistema Eléctrico.</label></li>';
                break;
            default:
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Verificación Sistema Eléctrico.</label></li>';
                break;
            }
            return $lista;
        }
    function getSistemaOpticoReporte() {
        $lista="";
        switch ($this->sistemaOptico) {
            case 'S':
                $lista.='<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Verificación Sistema Óptico.</label></li>';
                break;
            default:
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Verificación Sistema Óptico.</label></li>';
                break;
            }
            return $lista;
        }
    function getSistemaElectromecanicoReporte() {
        $lista="";
        switch ($this->sistemaElectromecanico) {
            case 'S':
                $lista.='<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Verificación Sistema Electromecánico.</label></li>';
                break;
            default:
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Verificación Sistema Electromecánico.</label></li>';
                break;
            }
            return $lista;
        }
    function getSistemaVaporReporte() {
        $lista="";
        switch ($this->sistemaVapor) {
            case 'S':
                $lista.='<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Verificación Sistema Vapor.</label></li>';
                break;
            default:
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Verificación Sistema Vapor.</label></li>';
                break;
            }
            return $lista;
        }
    function getSistemaOperativoReporte() {
        $lista="";
        switch ($this->sistemaOperativo) {
            case 'S':
                $lista.='<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Verificación Sistema Operativo.</label></li>';
                break;
            default:
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Verificación Sistema Operativo.</label></li>';
                break;
            }
            return $lista;
        }
    function getLimpiezaInternaReporte() {
        $lista="";
        switch ($this->limpiezaInterna) {
            case 'S':
                $lista.='<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Limpieza Interna del Equipo.</label></li>';
                break;
            default:
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Limpieza Interna del Equipo.</label></li>';
                break;
            }
            return $lista;
        }
    function getLimpiezaExternaReporte() {
        $lista="";
        switch ($this->limpiezaInterna) {
            case 'S':
                $lista.='<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Limpieza Externa del Equipo.</label></li>';
                break;
            default:
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Limpieza Externa del Equipo.</label></li>';
                break;
            }
            return $lista;
        }
    function getLubricacionPartesReporte() {
        $lista="";
        switch ($this->lubricacionPartes) {
            case 'S':
                $lista.='<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Lubricación Partes.</label></li>';
                break;
            default:
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Lubricación Partes.</label></li>';
                break;
            }
            return $lista;
        }
    function getPruebasFuncionamientoReporte() {
        $lista="";
        switch ($this->pruebasFuncionamiento) {
            case 'S':
                $lista.='<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Pruebas de Funcionamiento.</label></li>';
                break;
            default:
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Pruebas de Funcionamiento.</label></li>';
                break;
            }
            return $lista;
        }
        function getTipoMantenimientoReporte() {
        $lista='';
        switch ($this->tipoMantenimiento) {
            case 'P':
                $lista.='<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Preventivo</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Correctivo</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Diagnóstico</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Otro</label></li>';   
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Instalación</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Garantía</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Alistamiento</label></li>';              
                
                break;
            case 'C':
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Preventivo</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Correctivo</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Diagnóstico</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Otro</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Instalación</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Garantía</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Alistamiento</label></li>';
                
                break;
            case 'D':
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Preventivo</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Correctivo</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Diagnóstico</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Otro</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Instalación</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Garantía</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Alistamiento</label></li>';
                
                break;
            case 'I':
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Preventivo</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Correctivo</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Diagnóstico</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Otro</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Instalación</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Garantía</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Alistamiento</label></li>';
                
                break;
            case 'G':
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Preventivo</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Correctivo</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Diagnóstico</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Otro</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Instalación</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Garantía</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Alistamiento</label></li>';
                
                break;
            case 'A':
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Preventivo</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Correctivo</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Diagnóstico</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Otro</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Instalación</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Garantía</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Alistamiento</label></li>';
                
                break;
            case 'O':
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Preventivo</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Correctivo</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Diagnóstico</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/visto.png" height="10px"></span><label>Otro</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Instalación</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Garantía</label></li>';
                $lista.='<li><span><img src="../../../presentacion/imagenes/vacio.png" height="10px"></span><label>Alistamiento</label></li>';
                
                break;
        }
        return $lista;
    }
        function getFuncionamientoCorrectoReporte() {
            switch ($this->funcionamiento) {
                case 'S':
                    $lista = '<li><span><img src="../../../presentacion/imagenes/visto.png" height="12px"></span><label>Si</label></li><li><span><img src="../../../presentacion/imagenes/vacio.png" height="12px"></span><label>No</label></li>';
                    break;
                case 'N':
                    $lista = '<li><span><img src="../../../presentacion/imagenes/vacio.png" height="12px"></span><label>Si</label></li><li><span><img src="../../../presentacion/imagenes/visto.png" height="12px"></span><label>No</label></li>';
                    break;
            }
            return $lista;
        }
}
