<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NombreEquipo
 *
 * @author BIOMETRICAL
 */
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';
class NombreEquipo {
    private $ide;
    private $nombre;
    private $tipo;
    private $clasificacionBiomedica;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))$this->cargarAtributos($campo);
            else{
                $cadenaSQL="select * from nombreEquipos where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0)$this->cargarAtributos($resultado[0]);
            }
        }        
    }
    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->nombre=$datos['nombre'];
		$this->tipo=$datos['tipo'];
		$this->clasificacionBiomedica=$datos['clasificacionbiomedica'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getNombre() {
        return $this->nombre;
    }

	function getTipo() {
        return $this->tipo;
    }

    function getClasificacionBiomedica() {
        return $this->clasificacionBiomedica;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setTipo($tipo) {
        $this->tipo= $tipo;
    }

    function setClasificacionBiomedica($clasificacionBiomedica) {
        $this->clasificacionBiomedica = $clasificacionBiomedica;
    }

    function adicionar() {
        $cadenaSQL="insert into nombreEquipos(nombre,tipo,clasificacionBiomedica) values('{$this->nombre}','{$this->tipo}','{$this->clasificacionBiomedica}')";
        ConectorBD::ejecutarQuery($cadenaSQL,null);
    }

    function modificar() {
        $cadenaSQL="update nombreEquipos set nombre='{$this->nombre}', tipo='{$this->tipo}',clasificacionBiomedica='{$this->clasificacionBiomedica}' where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL,null);
    }

    function eliminar() {
        $cadenaSQL="delete from nombreEquipos where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL,null);
    }

    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from nombreEquipos ";
        if ($filtro != null)$cadenaSQL.=" where $filtro";
        if ($orden != null)$cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL,null);;
    }
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos = NombreEquipo::getDatos($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($datos); $i++) {
            $nombreEquipo = new NombreEquipo($datos[$i], null);
            $lista[$i] = $nombreEquipo;
        }
        return $lista;
    }

    public static function getNombreArreglo($filtro,$orden) {
        $nombres = NombreEquipo::getDatosEnObjetos($filtro, $orden);
        $arreglo = '';
        for ($i = 0; $i < count($nombres); $i++) {
            $nombre=$nombres[$i];
            $arreglo.="{$nombre->getNombre()},";
        }
        return $arreglo;
    }

	function getClasificacionBiomedicaLista() {
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
                $clasificacion='No aplica';                
                break;
            default :
                $clasificacion='Sin Especificar';                
                break;
        }
        return $clasificacion;
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
	function getTipoLista(){
		$tipo='';
		switch ($this->tipo) {
            case 'EB':
                $tipo='Equipo Biomédico';
                break;
            case 'EI':
                $tipo='Equipo Industrial';
                break;
            case 'EC':
                $tipo='Equipo de Computo';
                break;
            default :
                $tipo='Sin Especificar';
                break;
        }
        return $tipo;
	}

	function getTipoOptions(){
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

}
