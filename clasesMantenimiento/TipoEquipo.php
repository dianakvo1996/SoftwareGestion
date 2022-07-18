<?php
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';

class TipoEquipo {
    	private $ide;
    	private $nombre;
    	private $calibrable;
    	private $rutina;
    	private $tipo;
    	private $clasificacionBiomedica;
    	private $clasificacionRiesgo;
    	private $manual;
	private $tecnologiaPredominante;
	private $fotografia;
	private $descripcionFuncional;
    
    function __construct($campo, $valor) {
        if ($campo!=null) {
            if (is_array($campo))
                $this->cargarAtributos ($campo);
            else{
                $cadenaSQL="select * from tipoEquipo where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)
                    $this->cargarAtributos ($resultado[0]);
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
        $this->clasificacionRiesgo=$datos['clasificacionriesgo'];
        $this->manual=$datos['manual'];
        $this->tecnologiaPredominante=$datos['tecnologiapredominante'];
        $this->fotografia=$datos['fotografia'];
        $this->descripcionFuncional=$datos['descripcionfuncional'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getRutina() {
        return $this->rutina;
    }
    
    function getRutinaLista() {
        $rutina1= explode('-', $this->rutina);
        $rutinas='<p>';
        $item=1;
        for ($i = 1; $i< count($rutina1); $i++) {
            $rutinas.='<strong>'.$item.'.</strong> '.$rutina1[$i].'</br>';
            $item++;
        }
        return $rutinas.'</p>';
    }

    function getRutinaListaReporte() {
        $rutina1= explode('-', $this->rutina);                   
        $rutinas='';
        for ($i = 1; $i< count($rutina1); $i++) {
            $rutinas.='<div>&nbsp;» '.$rutina1[$i].'</div><br>';
        }
        return $rutinas;
    }
    function getRutinaListaHV() {
        $rutina1= explode('-', $this->rutina);
        $rutinas='<p>';
        $item=1;
        for ($i = 1; $i< count($rutina1); $i++) {
            $rutinas.='<strong>'.$item.'.</strong> '.$rutina1[$i].'<br>';
            $item++;
        }
        return $rutinas.'</p>';

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

    
    function getNombre() {
        return $this->nombre;
    }
    function getCalibrable() {
        return $this->calibrable;
    }
    
    function getCalibrableLista() {
        switch ($this->calibrable) {
            case 'S':
                $calibrable='Si';
                break;

            case 'N':
                $calibrable='No';
                break;
        }
        return $calibrable;
    }
    
    function getTipo() {
        return $this->tipo;
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
    function getTipoLista() {
        $lista='';
        switch ($this->tipo) {
            case 'EI':
                $lista='INDUSTRIAL';
                break;
            case 'EC':
                $lista='CÓMPUTO';
                break;
            case 'EB':
                $lista='BIOMÉDICO';
                break;
			default:
				$lista='-';
				break;
        }
        return $lista;
    }
    function getClasificacionBiomedica() {
        return $this->clasificacionBiomedica;
    }

    function getClasificacionRiesgo() {
        return $this->clasificacionRiesgo;
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

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    
    function setCalibrable($calibrable) {
        $this->calibrable = $calibrable;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    function setRutina($rutina) {
        $this->rutina = $rutina;
    }
	function setClasificacionBiomedica($clasificacionBiomedica) {
        $this->clasificacionBiomedica = $clasificacionBiomedica;
    }

    function setClasificacionRiesgo($clasificacionRiesgo) {
        $this->clasificacionRiesgo = $clasificacionRiesgo;
    }

    function setManual($manual) {
        $this->manual = $manual;
    }

    function setTecnologiaPredominante($tecnologiaPredominante) {
        $this->tecnologiaPredominante = $tecnologiaPredominante;
    }

    function setDescripcionFuncional($descripcionFuncional) {
        $this->descripcionFuncional = $descripcionFuncional;
    }

    function setFotografia($fotografia) {
        $this->fotografia= $fotografia;
    }

    function clasificacionBiomedicaLista() {
        switch ($this->clasificacionBiomedica) {
            case 'AD':
                $clasificacion='Análisis y Diagnóstico';                
                break;
            case 'TM':
                $clasificacion='Tratamiento y Mantenimiento de la Vida';                
                break;
            case 'R':
                $clasificacion='Rehabilitación';                
                break;
            case 'AL':
                $clasificacion='Análisis de Laboratorio';                
                break;
            case 'P':
                $clasificacion='Prevención';                
                break;
            case 'NA':
                $clasificacion='No Aplica';                
                break;
            default :
                $clasificacion='-';                
                break;

        }
        return $clasificacion;
    }
    function getClasificacionBiomedicaOptions() {
        $lista='';
        switch ($this->clasificacionBiomedica) {
            case 'AD':
                $lista.="<option value='AD' selected>APOYO Y DIAGNÓSTICO</option>";
                $lista.="<option value='TM'>TRATAMIENTO Y MENTENIMIENTO DE LA VIDA</option>";
                $lista.="<option value='R'>REHABILITACIÓN</option>";
                $lista.="<option value='AL'>ANÁLISIS DE LABORATORIO</option>";
                $lista.="<option value='P'>PREVENCIÓN</option>";
                $lista.="<option value='NA'>NO APLICA</option>";
                break;
            case 'TM':
                $lista.="<option value='AD'>APOYO Y DIAGNÓSTICO</option>";
                $lista.="<option value='TM' selected>TRATAMIENTO Y MENTENIMIENTO DE LA VIDA</option>";
                $lista.="<option value='R'>REHABILITACIÓN</option>";
                $lista.="<option value='AL'>ANÁLISIS DE LABORATORIO</option>";
                $lista.="<option value='P'>PREVENCIÓN</option>";
                $lista.="<option value='NA'>NO APLICA</option>";
                break;
            case 'R':
                $lista.="<option value='AD'>APOYO Y DIAGNÓSTICO</option>";
                $lista.="<option value='TM'>TRATAMIENTO Y MENTENIMIENTO DE LA VIDA</option>";
                $lista.="<option value='R' selected>REHABILITACIÓN</option>";
                $lista.="<option value='AL'>ANÁLISIS DE LABORATORIO</option>";
                $lista.="<option value='P'>PREVENCIÓN</option>";
                $lista.="<option value='NA'>NO APLICA</option>";
                break;
            case 'AL':
                $lista.="<option value='AD'>APOYO Y DIAGNÓSTICO</option>";
                $lista.="<option value='TM'>TRATAMIENTO Y MENTENIMIENTO DE LA VIDA</option>";
                $lista.="<option value='R'>REHABILITACIÓN</option>";
                $lista.="<option value='AL' selected>ANÁLISIS DE LABORATORIO</option>";
                $lista.="<option value='P'>PREVENCIÓN</option>";
                $lista.="<option value='NA'>NO APLICA</option>";
                break;
            case 'P':
                $lista.="<option value='AD'>APOYO Y DIAGNÓSTICO</option>";
                $lista.="<option value='TM'>TRATAMIENTO Y MENTENIMIENTO DE LA VIDA</option>";
                $lista.="<option value='R'>REHABILITACIÓN</option>";
                $lista.="<option value='AL'>ANÁLISIS DE LABORATORIO</option>";
                $lista.="<option value='P' selected>PREVENCIÓN</option>";
                $lista.="<option value='NA'>NO APLICA</option>";
                break;
            case 'NA':
                $lista.="<option value='AD'>APOYO Y DIAGNÓSTICO</option>";
                $lista.="<option value='TM'>TRATAMIENTO Y MENTENIMIENTO DE LA VIDA</option>";
                $lista.="<option value='R'>REHABILITACIÓN</option>";
                $lista.="<option value='AL'>ANÁLISIS DE LABORATORIO</option>";
                $lista.="<option value='P'>PREVENCIÓN</option>";
                $lista.="<option value='NA' selected>NO APLICA</option>";
                break;
            default:
                $lista.="<option value='AD'>APOYO Y DIAGNÓSTICO</option>";
                $lista.="<option value='TM'>TRATAMIENTO Y MENTENIMIENTO DE LA VIDA</option>";
                $lista.="<option value='R'>REHABILITACIÓN</option>";
                $lista.="<option value='AL'>ANÁLISIS DE LABORATORIO</option>";
                $lista.="<option value='P'>PREVENCIÓN</option>";
                $lista.="<option value='NA'>NO APLICA</option>";
                break;
        }
        return $lista;
    }
    
    function clasificacionRiesgoLista() {
        switch ($this->clasificacionRiesgo) {
            case 'III':
                $clasificacion='Muy Alto (III)';                
                break;
            case 'IIB':
                $clasificacion='Alto (IIB)';                
                break;
            case 'IIA':
                $clasificacion='Medio (IIA)';                
                break;
            case 'I':
                $clasificacion='Bajo (I)';                
                break;
            default :
                $clasificacion='-';                
                break;
        }
        return $clasificacion;
    }
    function getClasificacionRiesgoOptions() {
        $lista='';
        switch ($this->clasificacionRiesgo) {
            case 'III':
                $lista.="<option value='III' selected>Muy Alto (III)</option>";                
                $lista.="<option value='IIB'>Alto (IIB)</option>";                
                $lista.="<option value='IIA'>Medio (IIA)</option>";                
                $lista.="<option value='I'>Bajo (I)</option>";                
                break;
            case 'IIB':
                $lista.="<option value='III'>Muy Alto (III)</option>";                
                $lista.="<option value='IIB' selected>Alto (IIB)</option>";                
                $lista.="<option value='IIA'>Medio (IIA)</option>";                
                $lista.="<option value='I'>Bajo (I)</option>";                  
                break;
            case 'IIA':
                $lista.="<option value='III'>Muy Alto (III)</option>";                
                $lista.="<option value='IIB'>Alto (IIB)</option>";                
                $lista.="<option value='IIA' selected>Medio (IIA)</option>";                
                $lista.="<option value='I'>Bajo (I)</option>";                 
                break;
            case 'I':
                $lista.="<option value='III'>Muy Alto (III)</option>";                
                $lista.="<option value='IIB'>Alto (IIB)</option>";                
                $lista.="<option value='IIA'>Medio (IIA)</option>";                
                $lista.="<option value='I' selected>Bajo (I)</option>";                 
                break;
            default :
                $lista.="<option value='III'>Muy Alto (III)</option>";                
                $lista.="<option value='IIB'>Alto (IIB)</option>";                
                $lista.="<option value='IIA'>Medio (IIA)</option>";                
                $lista.="<option value='I'>Bajo (I)</option>";                 
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
    

    function getManualLista() {
        switch ($this->manual) {
            case 'S':
                $lista='SI';
                break;
            case 'N':
                $lista='NO';
                break;
            default:
                $lista='-';
                break;
        }
        return $lista;
    }
    function getManualOptions() {
        $lista='';
        switch ($this->manual) {
            case 'S':
                $lista.="<option value='S' selected>SI</option>";
                $lista.="<option value='N'>NO</option>";
                break;
            case 'N':
                $lista.="<option value='S'>SI</option>";
                $lista.="<option value='N' selected>NO</option>";
                break;
            default:
                $lista.="<option value='S'>SI</option>";
                $lista.="<option value='N'>NO</option>";
                break;
        }
        return $lista;
    }

    function adicionar() {
        $cadenaSQL="insert into tipoEquipo(nombre,calibrable,rutina,tipo,clasificacionBiomedica,clasificacionRiesgo,manual,descripcionFuncional,fotografia,tecnologiaPredominante)values('{$this->nombre}','{$this->calibrable}','{$this->rutina}','{$this->tipo}','{$this->clasificacionBiomedica}','{$this->clasificacionRiesgo}','{$this->manual}','{$this->descripcionFuncional}','{$this->fotografia}','{$this->tecnologiaPredominante}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificar() {
        $cadenaSQL="update tipoEquipo set nombre='{$this->nombre}', calibrable='{$this->calibrable}', rutina='{$this->rutina}', tipo='{$this->tipo}', clasificacionBiomedica='{$this->clasificacionBiomedica}', clasificacionRiesgo='{$this->clasificacionRiesgo}', manual='{$this->manual}', descripcionFuncional='{$this->descripcionFuncional}', fotografia='{$this->fotografia}', tecnologiaPredominante='{$this->tecnologiaPredominante}' where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminar() {
        $cadenaSQL="delete from tipoEquipo where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from tipoequipo";
        if ($filtro!=null) $cadenaSQL.=" where $filtro";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos = TipoEquipo::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $tipoEquipo=new TipoEquipo($datos[$i], null);
            $lista[$i]=$tipoEquipo;
        }
        return $lista;
        
    }
    public static function getNombreArreglo($filtro,$orden) {
        $nombres = TipoEquipo::getDatosEnObjetos($filtro, $orden);
        $arreglo = '';
        for ($i = 0; $i < count($nombres); $i++) {
            $nombre=$nombres[$i];
            $arreglo.="{$nombre->getNombre()},";
        }
        return $arreglo;
    }

    public static function getEquiposLista($predeterminado) {
       $equipos= TipoEquipo::getDatosEnObjetos(null, 'nombre');
       $lista='<option>--Seleccione--</option>';
       for ($i = 0; $i < count($equipos); $i++) {
           $equipo=$equipos[$i];
           if ($predeterminado==$equipo->getNombre()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$equipo->getNombre()}' {$auxiliar}>{$equipo->getNombre()}</option>";
       }
       return $lista;
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

	function getClasificacionRiesgoListaHV() {
        $radio="";
        switch ($this->clasificacionRiesgo) {
            case 'I':
                $radio.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> CLASE I</label></section>";  
                $radio.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE IIA</label></section>";
                $radio.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE IIB</label></section>";                
                $radio.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE III</label></section>";
                break;
            case 'IIA':
                $radio.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE I</label></section>";  
                $radio.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> CLASE IIA</label></section>";
                $radio.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE IIB</label></section>";                
                $radio.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE III</label></section>";
                break;
            case 'IIB':
                $radio.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE I</label></section>";  
                $radio.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE IIA</label></section>";
                $radio.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> CLASE IIB</label></section>";                
                $radio.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE III</label></section>";
                break;
            case 'III':
                $radio.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE I</label></section>";  
                $radio.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE IIA</label></section>";
                $radio.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> CLASE IIB</label></section>";                
                $radio.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> CLASE III</label></section>";
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

function getTecnologiaPredomienanteListaHV() {
        $lista="";
        switch ($this->tecnologiaPredominante) {
            case 'EL'://electrico
                $lista.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> ELÉCTRICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRÓNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> MECÁNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTROMECÁNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> HIDRÁULICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NEUMÁTICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> VAPOR</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> SOLAR</label></section>";
                break;
            case 'EC'://electronico
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELÉCTRICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> ELECTRÓNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> MECÁNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTROMECÁNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> HIDRÁULICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NEUMÁTICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> VAPOR</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> SOLAR</label></section>";
                break;
            case 'M'://Mecanico
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELÉCTRICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRÓNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> MECÁNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTROMECÁNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> HIDRÁULICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NEUMÁTICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> VAPOR</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> SOLAR</label></section>";
                break;
            case 'EM'://electromecanico
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELÉCTRICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRÓNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> MECÁNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> ELECTROMECÁNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> HIDRÁULICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NEUMÁTICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> VAPOR</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> SOLAR</label></section>";
                break;
            case 'H'://Hidraulico
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELÉCTRICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRÓNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> MECÁNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTROMECÁNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> HIDRÁULICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NEUMÁTICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> VAPOR</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> SOLAR</label></section>";
                break;
            case 'N'://Neumatico
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELÉCTRICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRÓNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> MECÁNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTROMECÁNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> HIDRÁULICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> NEUMÁTICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> VAPOR</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> SOLAR</label></section>";
                break;
            case 'V'://Vapor
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELÉCTRICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRÓNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> MECÁNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTROMECÁNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> HIDRÁULICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NEUMÁTICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vaporBlue.png' width='15px'> VAPOR</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> SOLAR</label></section>";
                break;
            case 'S'://Solar
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELÉCTRICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRÓNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> MECÁNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTROMECÁNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> HIDRÁULICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NEUMÁTICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> VAPOR</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> SOLAR</label></section>";
                break;
            default:
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELÉCTRICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTRÓNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> MECÁNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ELECTROMECÁNICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> HIDRÁULICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NEUMÁTICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> VAPOR</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> SOLAR</label></section>";
                break;
        }
        return $lista;
    }
function getClasificacionBiomedicaListaHV() {
        $lista='';
        switch ($this->clasificacionBiomedica) {
            case 'AD':
                $lista.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> APOYO Y DIAGNOSTICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> TRATAMIENTO Y MANTENIMIENTO DE LA VIDA</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> REHABILITACIÓN</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ANÁLISIS DE LABORATORIO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> PREVENCIÓN</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NO APLICA</label></section>";
                break;
            case 'TM':
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> APOYO Y DIAGNOSTICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> TRATAMIENTO Y MANTENIMIENTO DE LA VIDA</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> REHABILITACIÓN</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ANÁLISIS DE LABORATORIO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> PREVENCIÓN</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NO APLICA</label></section>";
                break;
            case 'R':
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> APOYO Y DIAGNOSTICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> TRATAMIENTO Y MANTENIMIENTO DE LA VIDA</label></section>";
                $lista.="<section><label><img src=../presentacion/imagenes/vistoBlue.png' width='15px'> REHABILITACIÓN</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ANÁLISIS DE LABORATORIO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> PREVENCIÓN</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NO APLICA</label></section>";
                break;
            case 'AL':
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> APOYO Y DIAGNOSTICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> TRATAMIENTO Y MANTENIMIENTO DE LA VIDA</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> REHABILITACIÓN</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> ANÁLISIS DE LABORATORIO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> PREVENCIÓN</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NO APLICA</label></section>";
                break;
            case 'P':
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> APOYO Y DIAGNOSTICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> TRATAMIENTO Y MANTENIMIENTO DE LA VIDA</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> REHABILITACIÓN</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ANÁLISIS DE LABORATORIO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> PREVENCIÓN</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NO APLICA</label></section>";
                break;
            case 'NA':
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> APOYO Y DIAGNOSTICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> TRATAMIENTO Y MANTENIMIENTO DE LA VIDA</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> REHABILITACIÓN</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ANÁLISIS DE LABORATORIO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> PREVENCIÓN</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vistoBlue.png' width='15px'> NO APLICA</label></section>";
                break;
            default:
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> APOYO Y DIAGNOSTICO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> TRATAMIENTO Y MANTENIMIENTO DE LA VIDA</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> REHABILITACIÓN</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> ANÁLISIS DE LABORATORIO</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> PREVENCIÓN</label></section>";
                $lista.="<section><label><img src='../presentacion/imagenes/vacioBlue.png' width='15px'> NO APLICA</label></section>";
                break;
        }
        return $lista;
    }
	public static function getInformacionArregloJS(){
		$datos="var informaciones=new Array();\n";
		$informaciones = TipoEquipo::getDatosEnObjetos(null, "nombre");
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

	public static function getTipoDataList($predeterminado){
		$tipos= TipoEquipo::getDatosEnObjetos(null,'nombre');
		$lista="";
		for ($i = 0; $i < count($tipos); $i++){
			$tipo=$tipos[$i];
			if($predeterminado==$tipo->getNombre()) $auxiliar="selected";
			else $auxiliar="";
			$lista.="<option value='{$tipo->getNombre()}' {$auxiliar}>{$tipo->getNombre()}</option>";
		}
		return $lista;
	}

}
