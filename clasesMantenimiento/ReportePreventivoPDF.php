<?php

require_once dirname(__FILE__) . '/../clasesMantenimiento/MantenimientoPreventivo.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/Mes.php';


class ReportePreventivoPDF {

	private $ide;
	private $archivo;
	private $ideMantenimientoPreventivo;
	private $ideEquipo;
	private $fecha;

	function __construct($campo,$valor) {
		if ($campo!=null) {
            if (is_array($campo))
                $this->cargarAtributos ($campo);
            else {
                $cadenaSQL="select * from reportePreventivoPDF where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado)>0)
                    $this->cargarAtributos ($resultado[0]);
            }
        }	
	}
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->archivo=$datos['archivo'];
        $this->ideMantenimientoPreventivo=$datos['idemantenimientopreventivo'];
        $this->ideEquipo=$datos['ideequipo'];
        $this->fecha=$datos['fecha'];
    }
//get
	function getIde(){
		return $this->ide;
	}

	function getArchivo(){
		return $this->archivo;
	}

	function getIdeMantenimientoPreventivo(){
		return $this->ideMantenimientoPreventivo;
	}

	function getIdeEquipo(){
		return $this->ideEquipo;
	}
	function getFecha(){
		return $this->fecha;
	}
	function getAnio(){
		$fecha = date_create($this->fecha);
		return date_format($fecha,'Y');
	}
//set
	function setIde($ide){
		$this->ide = $ide;
	}

	function setArchivo($archivo){
		$this->archivo = $archivo;
	}

	function setIdeMantenimientoPreventivo($ideMantenimientoPreventivo){
		$this->ideMantenimientoPreventivo = $ideMantenimientoPreventivo;
	}

	function setIdeEquipo($ideEquipo){
		$this->ideEquipo = $ideEquipo;
	}
	
	function setFecha($fecha){
		$this->fecha=$fecha;

	}
//funciones extras
    function getFechaLista(){
		$fecha= date_create($this->fecha);
		$mes=new Mes('ide',date_format($fecha,'n'));
		$dia=date_format($fecha,'j');
		$año=date_format($fecha,'Y');
	return $dia.' de '.$mes->getNombre().' de '.$año;
	}

//llaves foraneas
	function getMantenimientoPreventivo(){
		return new MantenimientoPreventivo('ide',$this->ideMantenimientoPreventivo);
	}

	function getEquipo(){
		return new Equipo('ide',$this->ideEquipo);
	}
	
	function adicionar(){
		$cadenaSQL="insert into reportePreventivoPDF(archivo,ideMantenimientoPreventivo,ideEquipo,fecha)values('{$this->archivo}',{$this->ideMantenimientoPreventivo},{$this->ideEquipo},'{$this->fecha}')";
		ConectorBD::ejecutarQuery($cadenaSQL,null);
	}
	
	function modificar(){
		$cadenaSQL="update reportePreventivo set archivo='{$this->archivo}' where ide={$this->ide}";
		ConectorBD::ejecutarQuery($cadenaSQL,null);
	}
	
	function getBuscarReporte($ideMantenimientoPreventivo,$ideEquipo){
		$cadenaSQL="select ide from reportePreventivoPDF where ideMantenimientoPreventivo={$ideMantenimientoPreventivo} and ideEquipo={$ideEquipo}";
		$ideReporte='';
		$resultado=ConectorBD::ejecutarQuery($cadenaSQL, null);
		if($resultado!=null) $ideReporte=$resultado[0][0];
	return $ideReporte;
	}

    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from reportePreventivoPDF";
        if ($filtro!=null) $cadenaSQL.=" where $filtro";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= ReportePreventivoPDF::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $reporte=new ReportePreventivoPDF($datos[$i],null);
            $lista[$i]=$reporte;
        }
    return $lista;        
    }
	
	public static function getDatosArregloJS($filtro){
		$datos="var reportesPDF=new Array();\n";
		$reportes= ReportePreventivoPDF::getDatosEnObjetos($filtro, 'fecha desc');
        	for ($i = 0; $i < count($reportes); $i++) {
            	$reporte= $reportes[$i];
            	$datos .= "reportesPDF[$i]=new Array();\n";
            	$datos .= "\treportesPDF[$i][0]='{$reporte->getFecha()}'\n";
	    		$datos .= "\treportesPDF[$i][1]='{$reporte->getAnio()}'\n";
	    		$datos .= "\treportesPDF[$i][2]='{$reporte->getArchivo()}'\n";
	    		$datos .= "\treportesPDF[$i][3]='{$reporte->getFechaLista()}'\n";
        	}
        	return $datos;
	}
}