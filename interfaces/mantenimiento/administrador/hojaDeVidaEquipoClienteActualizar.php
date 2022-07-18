<?php

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/EquipoHV.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/InformacionEquipos.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/AdquisicionInstalacion.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/CaracteristicasFisicasTecnicas.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/RegistroApoyoTecnico.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/CodigoUsoEquipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ClasificacionElectrica.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/VariablesSuceptiblesCalibracion.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/InformacionExtra.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

date_default_timezone_set('America/Bogota');

$nombreValidar = InformacionEquipos::sanearCadena($nombreEquipo);
$infoEquipo = new InformacionEquipos('nombre',"'{$nombreValidar}'");

if($infoEquipo->getIde()==null){
	$origen = $_FILES['fotografiaEquipo']['tmp_name'];
	list($fotografiaEquipo, $extension) = explode('.', $_FILES['fotografiaEquipo']['name']);

	$nombreArchivo=$fotografiaEquipo. date('YmdHis') . '.' . $extension;
	$destino = '/var/www/html/SoftwareGestion/FotografiasEquipos/' . $nombreArchivo;

	move_uploaded_file($origen, $destino);

	$infoEquipo->setNombre($nombreValidar);
	$infoEquipo->setCalibrable($calibrable);
	$infoEquipo->setRutina($rutina);
	$infoEquipo->setTipo('EB');
	if(isset($manuales))$manual='SI';
	else $manual='NO';
	$infoEquipo->setManual($manual);
	$infoEquipo->setTecnologiaPredominante($tecnologiaPredominante);
	$infoEquipo->setFotografia($nombreArchivo);
	$infoEquipo->setClasificacionBiomedica($clasificacionBiomedica);
	$infoEquipo->setClasificacionRiesgo($clasificacionRiesgo);
	$infoEquipo->setDescripcionFuncional($descripcionFuncional);
	$infoEquipo->adicionar();
}
switch($accion){
	case 'ADICIONAR':
//guardar informacion Equipo
		$equipo=new EquipoHV(null,null);
		$equipo->setActivoFijo($activoFijo);
		$equipo->setNombreEquipo($nombreValidar);
		$equipo->setMarca($marca);
		$equipo->setModelo($modelo);
		$equipo->setSerial($serial);
		$equipo->setUbicacion($ubicacion);
		$equipo->setRegistroInvima($registroInvima);
		$equipo->setReferencia($referencia);
		$equipo->setNitCliente($nitCliente);
		$equipo->adicionarNitCliente();

//guardar informacion adquisicion e instalacion
		$ideEquipoHV=ConectorBD::ejecutarQuery("select max(ide) from equipohv where nitCliente='{$nitCliente}'", null)[0][0];
		$adquisicion=new AdquisicionInstalacion(null,null);	
		$adquisicion->setIdeEquipo($ideEquipoHV);
		$adquisicion->setFabricante($fabricante);
		$adquisicion->setTelefonoF($telefonoF);
		$adquisicion->setDireccionF($direccionF);
		$adquisicion->setLugarOrigen($lugarOrigen);
		$adquisicion->setProveedor($proveedor);
		$adquisicion->setTelefonoP($telefonoP);
		$adquisicion->setDireccionP($direccionP);
		$adquisicion->setEmail($email);
		$adquisicion->setFormaAquisicion($formaAdquisicion);
		$adquisicion->setCostoAquisicion($costoAdquisicion);
		$adquisicion->setFechaCompra($fechaCompra);
		$adquisicion->setFechaInstalacion($fechaInstalacion);
		$adquisicion->setInicioGarantia($inicioGarantia);
		$adquisicion->setFinalizacionGarantia($finalizacionGarantia);
		$adquisicion->setFechaPuestaServicio($fechaPuestaServicio);
		$adquisicion->adicionar();

// guardar caracteristicas fisicas y tecnicas del equipo

		$caracteristicas=new CaracteristicasFisicasTecnicas(null,null);
		$caracteristicas->setIdeEquipo($ideEquipoHV);
		$caracteristicas->setVoltajeOperacion($voltajeOperacion);
		$caracteristicas->setVoltajeMaxOperacion($voltajeMaxOperacion);
		$caracteristicas->setCorrienteMaxOperacion($corrienteMaxOperacion);
		$caracteristicas->setCorrienteMinOperacion($corrienteMinOperacion);
		$caracteristicas->setPotenciaConsumida($potenciaConsumida);
		$caracteristicas->setFrecuencia($frecuencia);
		$caracteristicas->setPresion($presion);
		$caracteristicas->setVelocidad($velocidad);
		$caracteristicas->setPeso($peso);
		$caracteristicas->setCapacidad($capacidad);
		$caracteristicas->setDimensiones($dimensiones);
		$caracteristicas->setAniosVida($aniosVida);
		$caracteristicas->setRequiereAgua($requiereAgua);
		$caracteristicas->setRequiereGasPropano($requiereGasPropano);
		$caracteristicas->setRequiereCombustible($requiereCombustible);
		$caracteristicas->setRequiereGasMedicinal($requiereGasMedicinal);
		$caracteristicas->adicionar();

//guardar registro apoyo tecnico
		$registro=new RegistroApoyoTecnico(null,null);
		$registro->setIdeEquipo($ideEquipoHV);
		$registro->setManuales($manuales);
		$registro->setPlanos($planos);
		$registro->setUsos($usos);
		$registro->adicionar();

// guardar codigo uso de equipo
		$codigo=new CodigoUsoEquipo(null,null);
		$codigo->setIdeEquipo($ideEquipoHV);
		$codigo->setServicio($servicio);
		$codigo->setUnidad($unidad);
		$codigo->setAmbiente($ambiente);
		$codigo->adicionar();

// guardar clasificacion electrica
		$clasificacion=new ClasificacionElectrica(null,null);
		$clasificacion->setIdeEquipo($ideEquipoHV);
		$clasificacion->setTipo($tipoClasificacion);
		$clasificacion->setClase($claseClasificacion);
		$clasificacion->adicionar();

//guardar Variables Suceptibles Calibracion
		$variables=new VariablesSuceptiblesCalibracion(null, null);
		$variables->setIdeEquipo($ideEquipoHV);
		if(isset($presionVC))$variables->setPresion('S');
		else $variables->setPresion('N');
		if(isset($temperatura))$variables->setTemperatura('S');
		else $variables->setTemperatura('N');
		if(isset($volumen))$variables->setVolumen('S');
		else $variables->setVolumen('N');
		if(isset($impendancia))$variables->setImpendancia('S');
		else $variables->setImpendancia('N');
		if(isset($marcapasos))$variables->setMarcapasos('S');
		else $variables->setMarcapasos('N');
		if(isset($respiracion))$variables->setRespiracion('S');
		else $variables->setRespiracion('N');
		if(isset($gcardiaco))$variables->setGCardiaco('S');
		else $variables->setGCardiaco('N');
		if(isset($ibp))$variables->setIBP('S');
		else $variables->setIBP('N');
		if(isset($energia))$variables->setEnergia('S');
		else $variables->setEnergia('N');
		if(isset($nibp))$variables->setNIBP('S');
		else $variables->setNIBP('N');
		if(isset($tiempo))$variables->setTiempo('S');
		else $variables->setTiempo('N');
		if(isset($co2))$variables->setCo2('S');
		else $variables->setCo2('N');
		if(isset($co))$variables->setCo('S');
		else $variables->setCo('N');
		if(isset($rpm))$variables->setRPM('S');
		else $variables->setRPM('N');
		if(isset($hr))$variables->setHR('S');
		else $variables->setHR('N');
		if(isset($flujo))$variables->setFlujo('S');
		else $variables->setflujo('N');
		if(isset($fc))$variables->setFC('S');
		else $variables->setFC('N');
		if(isset($ecg))$variables->setECG('S');
		else $variables->setECG('N');
		if(isset($spo2))$variables->setSpO2('S');
		else $variables->setSpO2('N');
		if(isset($pesoVC))$variables->setPeso('S');
		else $variables->setPeso('N');
		$variables->adicionar();

// guardar informacion extra
		$informacionE=new InformacionExtra(null,null);
		$informacionE->setIdeEquipo($ideEquipoHV);
		$informacionE->setRecomendacionesFabricante($recomendacionesFabricante);
		$informacionE->adicionar();
		break;
}

?>