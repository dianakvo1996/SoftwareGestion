<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InformacionEquipos
 *
 * @author Diana V
 */
class InformacionEquipos {
    private $ide;
    private $nombre;
    private $calibrable;
    private $rutina;
    private $tipo;
    private $clasificacionBiomedica;
    private $manual;
    private $tecnologiaPredominante;
    private $fotografia;
    private $descripcionFuncional;
    private $clasificacionRiesgo;
            
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))$this->cargarAtributos($campo);
            else{
             $cadenaSQL="select * from informacionEquipos where $campo=$valor";
             $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
             if (count($resultado)>0)$this->cargarAtributos($resultado[0]);
            }
        }
    }
    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->nombre=$datos['nombre'];
        $this->calibrable=$datos['calibrable'];
        $this->rutina=$datos['rutina'];
        $this->tipo=$datos['tipo'];
        $this->clasificacionBiomedica=$datos['clasificacionbiomedica'];
        $this->manual=$datos['manual'];
        $this->tecnologiaPredominante=$datos['tecnologiapredominante'];
        $this->fotografia=$datos['fotografia'];
        $this->descripcionFuncional=$datos['descripcionfuncional'];
        $this->clasificacionRiesgo=$datos['clasificacionriesgo'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getCalibrable() {
        return $this->calibrable;
    }

    function getRutina() {
        return $this->rutina;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getClasificacionBiomedica() {
        return $this->clasificacionBiomedica;
    }

    function getManual() {
        return $this->manual;
    }

    function getTecnologiaPredominante() {
        return $this->tecnologiaPredominante;
    }

    function getFotografia() {
        return $this->fotografia;
    }

    function getDescripcionFuncional() {
        return $this->descripcionFuncional;
    }
    function getClasificacionRiesgo() {
        return $this->clasificacionRiesgo;
    }
    function setIde($ide) {
        $this->ide = $ide;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setCalibrable($calibrable) {
        $this->calibrable = $calibrable;
    }

    function setRutina($rutina) {
		$cadenaSinSaltos = preg_replace("[\n|\r|\n\r]", "", $rutina);
        $this->rutina = $cadenaSinSaltos;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setClasificacionBiomedica($clasificacionBiomedica) {
        $this->clasificacionBiomedica = $clasificacionBiomedica;
    }

    function setManual($manual) {
        $this->manual = $manual;
    }

    function setTecnologiaPredominante($tecnologiaPredominante) {
        $this->tecnologiaPredominante = $tecnologiaPredominante;
    }

    function setFotografia($fotografia) {
        $this->fotografia = $fotografia;
    }

    function setDescripcionFuncional($descripcionFuncional) {
        $this->descripcionFuncional = $descripcionFuncional;
    }
    function setClasificacionRiesgo($clasificacionRiesgo) {
        $this->clasificacionRiesgo = $clasificacionRiesgo;
    }

	function adicionar(){
		$cadenaSQL="insert into informacionEquipos(nombre, calibrable, rutina, tipo, clasificacionBiomedica, manual, tecnologiaPredominante, fotografia, descripcionFuncional, clasificacionRiesgo)values('{$this->nombre}','{$this->calibrable}','{$this->rutina}','{$this->tipo}','{$this->clasificacionBiomedica}','{$this->manual}','{$this->tecnologiaPredominante}','{$this->fotografia}','{$this->descripcionFuncional}','{$this->clasificacionRiesgo}')";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
	}

	function modificar(){
		$cadenaSQL="update informacionEquipos set nombre='{$this->nombre}', calibrable='{$this->calibrable}', rutina='{$this->rutina}',tipo='{$this->tipo}',clasificacionBiomedica='{$this->clasificacionBiomedica}',manual='{$this->manual}',tecnologiaPredominante='{$this->tecnologiaPredominante}',fotografia='{$this->fotografia}', descripcionFuncional='{$this->descripcionFuncional}',clasificacionRiesgo='{$this->clasificacionRiesgo}' where nombre='{$this->nombre}'";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
	}
    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from informacionEquipos ";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";        
        return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos = InformacionEquipos::getDatos($filtro, $orden);
        $lista = array();        
        for ($i = 0; $i < count($datos); $i++) {
            $informacion=new InformacionEquipos($datos[$i], null);
            $lista[$i]=$informacion;
        }
        return $lista;
    }
    
    function getCalibrableRadio() {
        $option="";
        switch ($this->calibrable) {
            case 'S':
                $option.="<label><input type='radio' name='calibrable' value='S' checked required> SI  </label>";
                $option.="<label><input type='radio' name='calibrable' value='N'> NO</label>";
                break;
            case 'N':
                $option.="<label><input type='radio' name='calibrable' value='S' required> SI  </label>";
                $option.="<label><input type='radio' name='calibrable' value='N' checked>  NO</label>";
                break;
            default:
                $option.="<label><input type='radio' name='calibrable' value='S' required> SI  </label>";
                $option.="<label><input type='radio' name='calibrable' value='N'> NO</label>";
                break;
        }
	return $option;
    }
    
    function getTipoOptions() {
        $lista='';
        switch ($this->tipo) {
            case 'EB':
                $lista.="<option value='EB' selected>Equipo Biomédico</option>";
		$lista.="<option value='EI'>Equipo Industrial</option>";
		$lista.="<option value='EC'>Equipo de Cómputo</option>";
                break;
            case 'EI':
                $lista.="<option value='EB'>Equipo Biomédico</option>";
                $lista.="<option value='EI' selected>Equipo Industrial</option>";
                $lista.="<option value='EC'>Equipo de Cómputo</option>";                
                break;
            case 'EC':
                $lista.="<option value='EB'>Equipo Biomédico</option>";
		$lista.="<option value='EI'>Equipo Industrial</option>";
		$lista.="<option value='EC' selected>Equipo de Cómputo</option>";                
                break;
            default :
                $lista.="<option value='EB'>Equipo Biomédico</option>";
		$lista.="<option value='EI'>Equipo Industrial</option>";
		$lista.="<option value='EC'>Equipo de Cómputo</option>";  
                break;
        }
        return $lista;
    }
    
    function getRutinaListaOrdenada() {
        $rutina1= explode('-', $this->rutina);
        $rutinas='<p>';
        $item=1;
        for ($i = 1; $i< count($rutina1); $i++) {
            $rutinas.='<strong>'.$item.'.</strong> '.$rutina1[$i].'<br>';
            $item++;
        }
        return $rutinas.'</p>';

    }
    function getClasificacionBiomedicaOptions() {
        $lista='';
        switch ($this->clasificacionBiomedica) {
            case 'AD':
                $lista.="<option value='AD' selected>Apoyo y Diagnóstico</option>";
                $lista.="<option value='TM'>Tratamiento y Mantenimiento de la Vida</option>";
                $lista.="<option value='R'>Rehabilitación</option>";
                $lista.="<option value='AL'>Análisis de Laboratorio</option>";
                $lista.="<option value='P'>Prevención</option>";
                $lista.="<option value='NA'>No Aplica</option>";
                break;
            case 'TM':
                $lista.="<option value='AD'>Apoyo y Diagnóstico</option>";
                $lista.="<option value='TM' selected>Tratamiento y Mantenimiento de la Vida</option>";
                $lista.="<option value='R'>Rehabilitación</option>";
                $lista.="<option value='AL'>Análisis de Laboratorio</option>";
                $lista.="<option value='P'>Prevención</option>";
                $lista.="<option value='NA'>No Aplica</option>";
                break;
            case 'R':
                $lista.="<option value='AD'>Apoyo y Diagnóstico</option>";
                $lista.="<option value='TM'>Tratamiento y Mantenimiento de la Vida</option>";
                $lista.="<option value='R' selected>Rehabilitación</option>";
                $lista.="<option value='AL'>Análisis de Laboratorio</option>";
                $lista.="<option value='P'>Prevención</option>";
                $lista.="<option value='NA'>No Aplica</option>";
                break;
            case 'AL':
                $lista.="<option value='AD'>Apoyo y Diagnóstico</option>";
                $lista.="<option value='TM'>Tratamiento y Mantenimiento de la Vida</option>";
                $lista.="<option value='R'>Rehabilitación</option>";
                $lista.="<option value='AL' selected>Análisis de Laboratorio</option>";
                $lista.="<option value='P'>Prevención</option>";
                $lista.="<option value='NA'>No Aplica</option>";
                break;
            case 'P':
                $lista.="<option value='AD'>Apoyo y Diagnóstico</option>";
                $lista.="<option value='TM'>Tratamiento y Mantenimiento de la Vida</option>";
                $lista.="<option value='R'>Rehabilitación</option>";
                $lista.="<option value='AL'>Análisis de Laboratorio</option>";
                $lista.="<option value='P' selected>Prevención</option>";
                $lista.="<option value='NA'>No Aplica</option>";
                break;
            case 'NA':
                $lista.="<option value='AD'>Apoyo y Diagnóstico</option>";
                $lista.="<option value='TM'>Tratamiento y Mantenimiento de la Vida</option>";
                $lista.="<option value='R'>Rehabilitación</option>";
                $lista.="<option value='AL'>Análisis de Laboratorio</option>";
                $lista.="<option value='P'>Prevención</option>";
                $lista.="<option value='NA' selected>No Aplica</option>";
                break;
            default:
                $lista.="<option value='AD'>Apoyo y Diagnóstico</option>";
                $lista.="<option value='TM'>Tratamiento y Mantenimiento de la Vida</option>";
                $lista.="<option value='R'>Rehabilitación</option>";
                $lista.="<option value='AL'>Análisis de Laboratorio</option>";
                $lista.="<option value='P'>Prevención</option>";
                $lista.="<option value='NA'>No Aplica</option>";
                break;
        }
        return $lista;
    }

    function getClasificacionRiesgoRadio() {
        $radio="";
        switch ($this->clasificacionRiesgo) {
            case 'I':
                $radio.="<section><label><input type='radio' name='clasificacionRiesgo' value='I' checked>CLASE I</label></section>";  
                $radio.="<section><label><input type='radio' name='clasificacionRiesgo' value='IIA'>CLASE IIA</label></section>";
                $radio.="<section><label><input type='radio' name='clasificacionRiesgo' value='IIB'>CLASE IIB</label></section>";                
                $radio.="<section><label><input type='radio' name='clasificacionRiesgo' value='III'>CLASE III</label></section>";
                break;
            case 'IIA':
                $radio.="<section><label><input type='radio' name='clasificacionRiesgo' value='I'>CLASE I</label></section>";  
                $radio.="<section><label><input type='radio' name='clasificacionRiesgo' value='IIA' checked>CLASE IIA</label></section>";
                $radio.="<section><label><input type='radio' name='clasificacionRiesgo' value='IIB'>CLASE IIB</label></section>";                
                $radio.="<section><label><input type='radio' name='clasificacionRiesgo' value='III'>CLASE III</label></section>";
                break;
            case 'IIB':
                $radio.="<section><label><input type='radio' name='clasificacionRiesgo' value='I'>CLASE I</label></section>";  
                $radio.="<section><label><input type='radio' name='clasificacionRiesgo' value='IIA'>CLASE IIA</label></section>";
                $radio.="<section><label><input type='radio' name='clasificacionRiesgo' value='IIB' checked>CLASE IIB</label></section>";                
                $radio.="<section><label><input type='radio' name='clasificacionRiesgo' value='III'>CLASE III</label></section>";
                break;
            case 'III':
                $radio.="<section><label><input type='radio' name='clasificacionRiesgo' value='I'>CLASE I</label></section>";  
                $radio.="<section><label><input type='radio' name='clasificacionRiesgo' value='IIA'>CLASE IIA</label></section>";
                $radio.="<section><label><input type='radio' name='clasificacionRiesgo' value='IIB'>CLASE IIB</label></section>";                
                $radio.="<section><label><input type='radio' name='clasificacionRiesgo' value='III' checked>CLASE III</label></section>";
                break;
            default:
                $radio.="<section><label><input type='radio' name='clasificacionRiesgo' value='I'>CLASE I</label></section>";  
                $radio.="<section><label><input type='radio' name='clasificacionRiesgo' value='IIA'>CLASE IIA</label></section>";
                $radio.="<section><label><input type='radio' name='clasificacionRiesgo' value='IIB'>CLASE IIB</label></section>";                
                $radio.="<section><label><input type='radio' name='clasificacionRiesgo' value='III'>CLASE III</label></section>";
                break;
        }
		return $radio;
    }
    
    function getTecnologiaPredomienanteOption() {
        $lista="";
        switch ($this->tecnologiaPredominante) {
            case 'EL'://electrico
                $lista.="<option value='EL' selected>Eléctrico</option>";
                $lista.="<option value='EC'>Electrónico</option>";
                $lista.="<option value='M'>Mecanico</option>";
                $lista.="<option value='EM'>Electromecánico</option>";
                $lista.="<option value='H'>Hidraulico</option>";
                $lista.="<option value='N'>Neumatico</option>";
                $lista.="<option value='V'>Vapor</option>";
                $lista.="<option value='S'>Solar</option>";
                break;
            case 'EC'://electronico
                $lista.="<option value='EL'>Eléctrico</option>";
                $lista.="<option value='EC' selected>Electrónico</option>";
                $lista.="<option value='M'>Mecanico</option>";
                $lista.="<option value='EM'>Electromecánico</option>";
                $lista.="<option value='H'>Hidraulico</option>";
                $lista.="<option value='N'>Neumatico</option>";
                $lista.="<option value='V'>Vapor</option>";
                $lista.="<option value='S'>Solar</option>";
                break;
            case 'M'://Mecanico
                $lista.="<option value='EL'>Eléctrico</option>";
                $lista.="<option value='EC'>Electrónico</option>";
                $lista.="<option value='M' selected>Mecanico</option>";
                $lista.="<option value='EM'>Electromecánico</option>";
                $lista.="<option value='H'>Hidraulico</option>";
                $lista.="<option value='N'>Neumatico</option>";
                $lista.="<option value='V'>Vapor</option>";
                $lista.="<option value='S'>Solar</option>";
                break;
            case 'EM'://electromecanico
                $lista.="<option value='EL'>Eléctrico</option>";
                $lista.="<option value='EC'>Electrónico</option>";
                $lista.="<option value='M'>Mecanico</option>";
                $lista.="<option value='EM' selected>Electromecánico</option>";
                $lista.="<option value='H'>Hidraulico</option>";
                $lista.="<option value='N'>Neumatico</option>";
                $lista.="<option value='V'>Vapor</option>";
                $lista.="<option value='S'>Solar</option>";
                break;
            case 'H'://Hidraulico
                $lista.="<option value='EL'>Eléctrico</option>";
                $lista.="<option value='EC'>Electrónico</option>";
                $lista.="<option value='M'>Mecanico</option>";
                $lista.="<option value='EM'>Electromecánico</option>";
                $lista.="<option value='H' selected>Hidraulico</option>";
                $lista.="<option value='N'>Neumatico</option>";
                $lista.="<option value='V'>Vapor</option>";
                $lista.="<option value='S'>Solar</option>";
                break;
            case 'N'://Neumatico
                $lista.="<option value='EL'>Eléctrico</option>";
                $lista.="<option value='EC'>Electrónico</option>";
                $lista.="<option value='M'>Mecanico</option>";
                $lista.="<option value='EM'>Electromecánico</option>";
                $lista.="<option value='H'>Hidraulico</option>";
                $lista.="<option value='N' selected>Neumatico</option>";
                $lista.="<option value='V'>Vapor</option>";
                $lista.="<option value='S'>Solar</option>";
                break;
            case 'V'://Vapor
                $lista.="<option value='EL'>Eléctrico</option>";
                $lista.="<option value='EC'>Electrónico</option>";
                $lista.="<option value='M'>Mecanico</option>";
                $lista.="<option value='EM'>Electromecánico</option>";
                $lista.="<option value='H'>Hidraulico</option>";
                $lista.="<option value='N'>Neumatico</option>";
                $lista.="<option value='V' selected>Vapor</option>";
                $lista.="<option value='S'>Solar</option>";
                break;
            case 'S'://Solar
                $lista.="<option value='EL'>Eléctrico</option>";
                $lista.="<option value='EC'>Electrónico</option>";
                $lista.="<option value='M'>Mecanico</option>";
                $lista.="<option value='EM'>Electromecánico</option>";
                $lista.="<option value='H'>Hidraulico</option>";
                $lista.="<option value='N'>Neumatico</option>";
                $lista.="<option value='V'>Vapor</option>";
                $lista.="<option value='S' selected>Solar</option>";
                break;
            default:
                $lista.="<option value='EL'>Eléctrico</option>";
                $lista.="<option value='EC'>Electrónico</option>";
                $lista.="<option value='M'>Mecanico</option>";
                $lista.="<option value='EM'>Electromecánico</option>";
                $lista.="<option value='H'>Hidraulico</option>";
                $lista.="<option value='N'>Neumatico</option>";
                $lista.="<option value='V'>Vapor</option>";
                $lista.="<option value='S'>Solar</option>";
                break;
        }
        return $lista;
    }
    
    public static function getNombreArreglo($filtro,$orden) {
        $nombres = InformacionEquipos::getDatosEnObjetos($filtro, $orden);
        $arreglo = '';
        for ($i = 0; $i < count($nombres); $i++) {
            $nombre=$nombres[$i];
            $arreglo.="{$nombre->getNombre()},";
        }
        return $arreglo;
    }

    public static function sanearCadena($string){
       
		$string = trim($string);

        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
        );

        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );

        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );

        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
        );

        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );

        $string = str_replace(
            array('  ','ç', 'Ç'),
            array(' ','c', 'C',),
            $string
        );
 
    return $string;
    }
	
	public static function getInformacionArregloJS(){
		$datos="var informaciones=new Array();\n";
		$informaciones = InformacionEquipos::getDatosEnObjetos(null, "nombre");
        for ($i = 0; $i < count($informaciones); $i++) {
            $informacion = $informaciones[$i];
            $datos .= "informaciones[$i]=new Array();\n";
            $datos .= "informaciones[$i][0]='{$informacion->getNombre()}'\n";
            $datos .= "\tinformaciones[$i][1]='{$informacion->getCalibrable()}'\n";
            $datos .= "\tinformaciones[$i][2]='{$informacion->getRutina()}'\n";
            $datos .= "\tinformaciones[$i][3]='{$informacion->getTipo()}'\n";
            $datos .= "\tinformaciones[$i][4]='{$informacion->getClasificacionBiomedica()}'\n";
            $datos .= "\tinformaciones[$i][5]='{$informacion->getManual()}'\n";
            $datos .= "\tinformaciones[$i][6]='{$informacion->getTecnologiaPredominante()}'\n";
            $datos .= "\tinformaciones[$i][7]='{$informacion->getFotografia()}'\n";
            $datos .= "\tinformaciones[$i][8]='{$informacion->getDescripcionFuncional()}'\n";
            $datos .= "\tinformaciones[$i][9]='{$informacion->getClasificacionRiesgo()}'\n";
        }
        return $datos;
	}

    function getClasificacionRiesgoLista() {
        $radio="";
        switch ($this->clasificacionRiesgo) {
            case 'I':
                $radio.="<section><label><img src='../../../presentacion/imagenes/vistoBlue.png' width='15px'> CLASE I</label></section>";  
                $radio.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE IIA</label></section>";
                $radio.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE IIB</label></section>";                
                $radio.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE III</label></section>";
                break;
            case 'IIA':
                $radio.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE I</label></section>";  
                $radio.="<section><label><img src='../../../presentacion/imagenes/vistoBlue.png' width='15px'> CLASE IIA</label></section>";
                $radio.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE IIB</label></section>";                
                $radio.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE III</label></section>";
                break;
            case 'IIB':
                $radio.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE I</label></section>";  
                $radio.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE IIA</label></section>";
                $radio.="<section><label><img src='../../../presentacion/imagenes/vistoBlue.png' width='15px'> CLASE IIB</label></section>";                
                $radio.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE III</label></section>";
                break;
            case 'III':
                $radio.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE I</label></section>";  
                $radio.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE IIA</label></section>";
                $radio.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE IIB</label></section>";                
                $radio.="<section><label><img src='../../../presentacion/imagenes/vistoBlue.png' width='15px'> CLASE III</label></section>";
                break;
            default:
                $radio.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE I</label></section>";  
                $radio.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE IIA</label></section>";
                $radio.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE IIB</label></section>";                
                $radio.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE III</label></section>";
                break;
        }
		return $radio;
    }
function getTecnologiaPredomienanteLista() {
        $lista="";
        switch ($this->tecnologiaPredominante) {
            case 'EL'://electrico
                $lista.="<section><label><img src='../../../presentacion/imagenes/vistoBlue.png' width='15px'> ELÉCTRICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRÓNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> MECÁNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTROMECÁNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> HIDRÁULICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> NEUMÁTICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> VAPOR</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> SOLAR</label></section>";
                break;
            case 'EC'://electronico
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELÉCTRICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vistoBlue.png' width='15px'> ELECTRÓNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> MECÁNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTROMECÁNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> HIDRÁULICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> NEUMÁTICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> VAPOR</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> SOLAR</label></section>";
                break;
            case 'M'://Mecanico
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELÉCTRICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRÓNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vistoBlue.png' width='15px'> MECÁNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTROMECÁNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> HIDRÁULICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> NEUMÁTICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> VAPOR</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> SOLAR</label></section>";
                break;
            case 'EM'://electromecanico
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELÉCTRICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRÓNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> MECÁNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vistoBlue.png' width='15px'> ELECTROMECÁNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> HIDRÁULICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> NEUMÁTICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> VAPOR</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> SOLAR</label></section>";
                break;
            case 'H'://Hidraulico
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELÉCTRICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRÓNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> MECÁNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTROMECÁNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vistoBlue.png' width='15px'> HIDRÁULICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> NEUMÁTICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> VAPOR</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> SOLAR</label></section>";
                break;
            case 'N'://Neumatico
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELÉCTRICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRÓNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> MECÁNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTROMECÁNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> HIDRÁULICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vistoBlue.png' width='15px'> NEUMÁTICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> VAPOR</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> SOLAR</label></section>";
                break;
            case 'V'://Vapor
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELÉCTRICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRÓNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> MECÁNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTROMECÁNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> HIDRÁULICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> NEUMÁTICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vaporBlue.png' width='15px'> VAPOR</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> SOLAR</label></section>";
                break;
            case 'S'://Solar
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELÉCTRICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRÓNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> MECÁNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTROMECÁNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> HIDRÁULICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> NEUMÁTICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> VAPOR</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vistoBlue.png' width='15px'> SOLAR</label></section>";
                break;
            default:
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELÉCTRICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRÓNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> MECÁNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTROMECÁNICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> HIDRÁULICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> NEUMÁTICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> VAPOR</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> SOLAR</label></section>";
                break;
        }
        return $lista;
    }
function getClasificacionBiomedicaLista() {
        $lista='';
        switch ($this->clasificacionBiomedica) {
            case 'AD':
                $lista.="<section><label><img src='../../../presentacion/imagenes/vistoBlue.png' width='15px'> APOYO Y DIAGNOSTICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> TRATAMIENTO Y MANTENIMIENTO DE LA VIDA</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> REHABILITACIÓN</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ANÁLISIS DE LABORATORIO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> PREVENCIÓN</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> NO APLICA</label></section>";
                break;
            case 'TM':
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> APOYO Y DIAGNOSTICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vistoBlue.png' width='15px'> TRATAMIENTO Y MANTENIMIENTO DE LA VIDA</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> REHABILITACIÓN</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ANÁLISIS DE LABORATORIO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> PREVENCIÓN</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> NO APLICA</label></section>";
                break;
            case 'R':
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> APOYO Y DIAGNOSTICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> TRATAMIENTO Y MANTENIMIENTO DE LA VIDA</label></section>";
                $lista.="<section><label><img src=../../'../presentacion/imagenes/vistoBlue.png' width='15px'> REHABILITACIÓN</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ANÁLISIS DE LABORATORIO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> PREVENCIÓN</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> NO APLICA</label></section>";
                break;
            case 'AL':
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> APOYO Y DIAGNOSTICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> TRATAMIENTO Y MANTENIMIENTO DE LA VIDA</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> REHABILITACIÓN</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vistoBlue.png' width='15px'> ANÁLISIS DE LABORATORIO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> PREVENCIÓN</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> NO APLICA</label></section>";
                break;
            case 'P':
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> APOYO Y DIAGNOSTICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> TRATAMIENTO Y MANTENIMIENTO DE LA VIDA</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> REHABILITACIÓN</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ANÁLISIS DE LABORATORIO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vistoBlue.png' width='15px'> PREVENCIÓN</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> NO APLICA</label></section>";
                break;
            case 'NA':
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> APOYO Y DIAGNOSTICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> TRATAMIENTO Y MANTENIMIENTO DE LA VIDA</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> REHABILITACIÓN</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ANÁLISIS DE LABORATORIO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> PREVENCIÓN</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vistoBlue.png' width='15px'> NO APLICA</label></section>";
                break;
            default:
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> APOYO Y DIAGNOSTICO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> TRATAMIENTO Y MANTENIMIENTO DE LA VIDA</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> REHABILITACIÓN</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> ANÁLISIS DE LABORATORIO</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> PREVENCIÓN</label></section>";
                $lista.="<section><label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> NO APLICA</label></section>";
                break;
        }
        return $lista;
    }
    function getCalibrableLista() {
        $option="";
        switch ($this->calibrable) {
            case 'S':
                $option.="<label><img src='../../../presentacion/imagenes/vistoBlue.png' width='15px'> SI </label>";
                $option.="<label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> NO </label>";
                break;
            case 'N':
                $option.="<label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> SI </label>";
                $option.="<label><img src='../../../presentacion/imagenes/vistoBlue.png' width='15px'> NO </label>";
                break;
            default:
                $option.="<label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> SI </label>";
                $option.="<label><img src='../../../presentacion/imagenes/vacioBlue.png' width='15px'> NO </label>";
                break;
        }
	return $option;
    }

}
