<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/TipoEquipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/RegistroApoyoTecnico.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/AdquisicionInstalacion.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/CaracteristicasFisicasTecnicas.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/CodigoUsoEquipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ComponentesEquipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ClasificacionElectrica.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/VariablesSuceptiblesCalibracion.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/InformacionExtra.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/Ciudad.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/Departamento.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$informacionGeneral=new Equipo('ide',$ideEquipo);
$adquisicion=new AdquisicionInstalacion('ideEquipo',$informacionGeneral->getIde());
$caracteristicas=new CaracteristicasFisicasTecnicas('ideEquipo',$informacionGeneral->getIde());
$registro=new RegistroApoyoTecnico('ideEquipo',$informacionGeneral->getIde());
$tipoEquipo=new TipoEquipo('nombre',"'{$informacionGeneral->getNombreEquipo()}'");
$codigo=new CodigoUsoEquipo('ideEquipo',$informacionGeneral->getIde());
$clasificacion=new ClasificacionElectrica('ideEquipo',$informacionGeneral->getIde());
$datosComponentes=ComponentesEquipo::getDatosEnObjetos("ideEquipo={$informacionGeneral->getIde()}","ide");
$variables=new VariablesSuceptiblesCalibracion('ideEquipo',$informacionGeneral->getIde());
$informacionE=new InformacionExtra('ideEquipo',$informacionGeneral->getIde());

$redireccion="&ideEquipo={$informacionGeneral->getIde()}&accion=ACTUALIZAR&ideSede={$informacionGeneral->getIdeSede()}";

$item=1;
$componentes='';
for($i = 0; $i < 4; $i++){
	if(isset($datosComponentes[$i])){
		$objeto=$datosComponentes[$i];
		$componentes.='<tr>';
		$componentes.="<td>{$objeto->getPartes()}</td><td>{$objeto->getReferencia()}</td><td>{$objeto->getAccesorios()}</td>";
		$componentes.='</tr>';
		$item++;
	}else{
		$componentes.='<tr>';
		$componentes.="<td>-</td><td>-</td><td>-</td>";
		$componentes.='</tr>';
		$item++;
	}
}
if ($informacionGeneral->getIdeSede()!=null){
	$direccion="equiposHVS.php&ideSede={$informacionGeneral->getIdeSede()}";
	$departamento=$informacionGeneral->getSede()->getCiudad()->getDepartamento()->getNombre();
	$municipio=$informacionGeneral->getSede()->getCiudad()->getNombre();
}else{
	$direccion="equiposHVC.php&nitCliente={$informacionGeneral->getNitCliente()}";
	$departamento=$informacionGeneral->getCliente()->getCiudad()->getDepartamento()->getNombre();
	$municipio=$informacionGeneral->getCliente()->getCiudad()->getNombre();
}
if($tipoEquipo->getFotografia()!=null)$ruta="<img src='../../../FotografiasEquipos/{$tipoEquipo->getFotografia()}' height='120px' id='imagenEquipo'>";
else $ruta="<img src='../../../FotografiasEquipos/SN.png' height='120px' id='imagenEquipo'>";

?>
<html>
<head>
	<title>Hoja de Vida Equipo Biomedico</title>
    <link href="../../../presentacion/css/estiloVista.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../../../presentacion/css/imprimirHojaVida.css" rel="stylesheet" type="text/css" media="print"/>
    <link rel="shortcut icon" type="image/x-icon" href="../../../presentacion/imagenes/logoIcono.ico" />
    <link href="https://fonts.googleapis.com/css?family=Cabin|Hepta+Slab&display=swap" rel="stylesheet" />
    <style>
    	@media print { html {zoom: 100%;} }
    </style>
</head>
<body>

<a href="../../principal.php?CONTENIDO=mantenimiento/administrador/<?=$direccion?>"><img src="../../../presentacion/iconos/atras.png" title="Volver" height="30px" style="float: left" class="volver"></a>
<div class="opciones">
	<a href="../../principal.php?CONTENIDO=mantenimiento/administrador/hojaDeVidaEquipoSede.php<?=$redireccion?>" class="boton">Modificar</a>
    <a onclick="imprimir()">Imprimir</a>
</div>
<div class="hojaVida">
<h5>FORMATO DE HOJA DE VIDA DE EQUIPO BIOMÉDICO</h5>
<table class="encabezado">
	<tr>
		<th rowspan="2"><img src="../../../presentacion/imagenes/isotipoBio.png" height="30px"></th>
		<th rowspan="2"><label>FORMATO DE HOJA DE VIDA DE EQUIPO BIOMÉDICO</label></th>
		<th>
			CODIGO<br><span>FO-M-MT-08</span>
		</th>
		<th>
			VERSION<br><span>02</span>
		</th>	
	</tr>
	<tr>
		<th colspan="2">FECHA VIGENCIA<br><span>21/01/2019</span></th>
	</tr>
</table>
<section class="izquierda">
	<table class="informacionGeneral" border="1">
		<tr>
			<th class="tituloNombre" colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$informacionGeneral->getNombreEquipo()?></th>
		</tr>
		<tr>
			<th colspan="2" class="subTitulos">FOTO EQUIPO BIOMÉDICO</th>
			<th colspan="2" class="subTitulos">DESCRIPCIÓN FUNCIONAL</th>
		</tr>
		<tr>
			<td colspan="2"><?=$ruta?></td>
			<td colspan="2"><p><?=strtoupper($tipoEquipo->getDescripcionFuncional())?></p></td>
		</tr>
		<tr>
			<th class="titulos" colspan="4">INFORMACIÓN GENERAL</th>
		</tr>
		<tr>
			<th class="subTitulos">&nbsp;No. ACTIVO FIJO</th><td><?=$informacionGeneral->getActivoFijo()?></td>
			<th class="subTitulos">&nbsp;SERIE</th><td><?=$informacionGeneral->getSerial()?></td>
		</tr>
		<tr>
			<th class="subTitulos">&nbsp;MARCA</th><td><?=$informacionGeneral->getMarca()?></td>
			<th class="subTitulos">&nbsp;REFERENCIA</th><td><?=$informacionGeneral->getReferencia()?></td>
		</tr>
		<tr>
			<th class="subTitulos">&nbsp;MODELO</th><td><?=$informacionGeneral->getModelo()?></td>
			<th class="subTitulos">&nbsp;REGISTRO INVIMA</th><td><?=$informacionGeneral->getRegistroInvima()?></td>
		</tr>
	</table>

	<table border="1" class="localizacion">
		<tr>
			<th colspan="2" class="titulos">LOCALIZACION</th>
		</tr>
		<tr>
			<th class="subTitulos">&nbsp;DEPARTAMENTO</th>
			<td>
				<?=$departamento?>
			</td>
		</tr>
		<tr>
			<th class="subTitulos">&nbsp;MUNICIPIO</th>
			<td>
				<?=$municipio?>
			</td>
		</tr>
		<tr>
			<th class="subTitulos">&nbsp;SEDE</th><td><?=$informacionGeneral->getSede()->getNombre().' - '.$informacionGeneral->getUbicacion()?></td>
		</tr>
	</table>

	<table border="1" class="adquisicion">
		<tr>
			<th colspan="4" class="titulos">ADQUISICION E INSTALACION</th>
		</tr>
		<tr>
			<th class="subTitulos">&nbsp;FABRICANTE</th><td><?=$adquisicion->getFabricante()?></td>
			<th class="subTitulos">&nbsp;FORMA DE ADQUISICION</th><td><?=$adquisicion->getFormaAquisicion()?></td>
		</tr>
		<tr>
			<th class="subTitulos">&nbsp;TELEFONO</th><td><?=$adquisicion->getTelefonoF()?></td>
			<th class="subTitulos">&nbsp;COSTO DE ADQUISICION</th><td><?=$adquisicion->getCostoAquisicion()?></td>
		</tr>
		<tr>
			<th class="subTitulos">&nbsp;DIRECCION</th><td><?=$adquisicion->getDireccionF()?></td>
			<th class="subTitulos">&nbsp;FECHA DE COMPRA</th><td><?=$adquisicion->getContenido($adquisicion->getFechaCompra())?></td>
		</tr>
		<tr>
			<th class="subTitulos">&nbsp;LUGAR DE ORIGEN</th><td><?=$adquisicion->getLugarOrigen()?></td>
			<th class="subTitulos">&nbsp;FECHA DE INSTALACION</th><td><?=$adquisicion->getContenido($adquisicion->getFechaInstalacion())?></td>
		</tr>
		<tr>
			<th class="subTitulos">&nbsp;PROVEEDOR</th><td><?=$adquisicion->getProveedor()?></td>
			<th class="subTitulos">&nbsp;INICIO DE GARANTIA</th><td><?=$adquisicion->getContenido($adquisicion->getInicioGarantia())?></td>
		</tr>
		<tr>
			<th class="subTitulos">&nbsp;TELEFONO</th><td><?=$adquisicion->getTelefonoP()?></td>
			<th class="subTitulos">&nbsp;FINALIZACION GARANTIA</th><td><?=$adquisicion->getContenido($adquisicion->getFinalizacionGarantia())?></td>
		</tr>
		<tr>
			<th class="subTitulos">&nbsp;DIRECCION</th><td><?=$adquisicion->getDireccionP()?></td>
			<th class="subTitulos">&nbsp;FECHA PUESTA SERVICIO</th><td><?=$adquisicion->getContenido($adquisicion->getFechaPuestaServicio())?></td>
		</tr>
		<tr>
			<th class="subTitulos">&nbsp;E-MAIL</th><td><?=$adquisicion->getEmail()?></td>
			<td style="background:#e1e1e1" colspan="2"></td>
		</tr>
	</table>

	<table class="caracteristicasFisicasTecnicas">
		<tr>
			<th colspan="4" class="titulos">CARACTERISTICAS FISICAS Y TECNICAS DEL EQUIPO</th>			
		</tr>
		<tr>
			<th class="subTitulos">&nbsp;VOLTAJE OPERACION [V]</th><td><?=$caracteristicas->getVoltajeOperacion()?></td>
			<th class="subTitulos">&nbsp;PESO [Kg]</th><td ><?=$caracteristicas->getPeso()?></td>
		</tr>
		<tr>
			<th class="subTitulos">&nbsp;VOLTAJE MAXIMA OPERACION [V]</th><td ><?=$caracteristicas->getVoltajeMaxOperacion()?></td>
			<th class="subTitulos">&nbsp;CAPACIDAD</th><td ><?=$caracteristicas->getCapacidad()?></td>
		</tr>
		<tr>
			<th class="subTitulos">&nbsp;CORRIENTE MAXIMA OPERACION [A]</th><td ><?=$caracteristicas->getCorrienteMaxOperacion()?></td>
			<th class="subTitulos">&nbsp;DIMENSIONES</th><td ><?=$caracteristicas->getCorrienteMaxOperacion()?></td>
		</tr>
		<tr>
			<th class="subTitulos">&nbsp;CORRIENTE MINIMA OPERACION [A]</th><td><?=$caracteristicas->getCorrienteMinOperacion()?></td>
			<th class="subTitulos">&nbsp;AÑOS DE VIDA</th><td><?=$caracteristicas->getAniosVida()?></td>
		</tr>
		<tr>
			<th class="subTitulos">&nbsp;POTENCIA CONSUMIDA [W]</th><td><?=$caracteristicas->getPotenciaConsumida()?></td>
			<th class="subTitulos">&nbsp;REQUIERE AGUA</th><td><?=$caracteristicas->getRequiereAguaOptions()[1]?></td>
		</tr>
		<tr>
			<th class="subTitulos">&nbsp;FRECUENCIA [Hz]</th><td><?=$caracteristicas->getFrecuencia()?></td>
			<th class="subTitulos">&nbsp;REQUIERE GAS PROPANO</th><td><?=$caracteristicas->getRequiereGasPropanoOptions()[1]?></td>
		</tr>
		<tr>
			<th class="subTitulos">&nbsp;PRESION [Bar]</th><td><?=$caracteristicas->getPresion()?></td>
			<th class="subTitulos">&nbsp;REQUIERE COMBUSTIBLE</th><td><?=$caracteristicas->getRequiereCombustibleOptions()[1]?></td>
		</tr>
		<tr>
			<th class="subTitulos">&nbsp;VELOCIDAD [W]</th><td><?=$caracteristicas->getVelocidad()?></td>
			<th class="subTitulos">&nbsp;REQUIERE GASES MEDICINALES</th><td ><?=$caracteristicas->getRequiereGasMedicinalOptions()[1]?></td>
		</tr>
	</table>

	<table class="apoyotecnico" border="1">
		<tr>
			<th colspan="4" class="titulos">REGISTRO DE APOYO TECNICO</th>
		</tr>
		<tr>
			<th class="subTitulos">MANUALES</th><th class="subTitulos">PLANOS</th><th class="subTitulos">USOS</th><th class="subTitulos">RIESGO</th>
		</tr>
		<tr>
			<td class="tds"><?=$registro->getManualesLista()?></td>
			<td class="tds"><?=$registro->getPlanosLista()?></td>
			<td class="tds"><?=$registro->getUsosLista()?></td>
			<td class="tds"><?=$tipoEquipo->getClasificacionRiesgoListaHV()?></td>
		</tr>
	</table>

</section>
<section class="derecha">
	<table class="apoyotecnico">
		<tr>
			<th colspan="6" class="titulos">CODIGO DE USO DEL EQUIPO</th>
		</tr>
		<tr>
			<th class="subTitulos">SERVICIO</th><td><?=$codigo->getServicio()?></td>
			<th class="subTitulos">UNIDAD</th><td><?=$codigo->getUnidad()?></td>
			<th class="subTitulos">AMBIENTE</th><td><?=$codigo->getAmbiente()?></td>
		</tr>
	</table>

	<table class="componentesEquipos" border="1">
		<tr>
			<th colspan="3" class="titulos">COMPONENTES DEL EQUIPO</th>
		</tr>
		<tr>
			<th class="subTitulos">PARTES O ELEMENTOS</th><th class="subTitulos">REFERECIA</th><th class="subTitulos">ACCESORIOS</th>
		</tr>
		<?=$componentes?>
	</table>
<div class="saltoPagina">
<table class="encabezado">
	<tr>
		<th rowspan="2"><img src="../../../presentacion/imagenes/isotipoBio.png" height="30px"></th>
		<th rowspan="2"><label>FORMATO DE HOJA DE VIDA DE EQUIPO BIOMÉDICO</label></th>
		<th>
			CODIGO<br><span>FO-M-MT-08</span>
		</th>
		<th>
			VERSION<br><span>02</span>
		</th>	
	</tr>
	<tr>
		<th colspan="2">FECHA VIGENCIA<br><span>21/01/2019</span></th>
	</tr>
</table>
	<table class="tecPredominante" border="1">
		<tr>
			<th colspan="2"  class="titulos">CLASE DE TECNOLOGIA PREDOMIENANTE</th>
			<th colspan="2"  class="titulos">CLASIFICACION BIOMEDICA</th>
		</tr>
		<tr>
			<td colspan="2">
				<div  class="intro">
					<?=$tipoEquipo->getTecnologiaPredomienanteListaHV()?>
				</div>
			</td>
			<td colspan="2">
				<div  class="intro2">
					<?=$tipoEquipo->getClasificacionBiomedicaListaHV()?>
				</div>	
			</td>
		</tr>
		<tr>
			<th colspan="4" class="titulos">CLASIFICACION ELECTRICA</th>
		<tr>
		<tr>
			<th class="subTitulos">TIPO</th><td><?=$clasificacion->getTipo()?></td>
			<th class="subTitulos">CLASE</th><td><?=$clasificacion->getClase()?></td>
		</tr>
	</table>

	<table class="mantenimientoCalibracion" border="1">
		<tr>
			<th colspan="8" class="titulos">MANTENIMIENTO</th>
		</tr>
		<tr>
			<th colspan="2" class="subTitulos">PREVENTIVO</th><td colspan="2">Cuatrimestral, orientado al riesgo</td>
			<th colspan="2" class="subTitulos">CORRECTIVO</th><td colspan="2">Por Llamado</td>
		</tr>
		<tr>
			<th colspan="8" class="titulos">CALIBRACION</th>
		</tr>
		<tr>
			<th colspan="2" class="subTitulos">REQUIERE CALIBRACION</th><td colspan="6"><?=$tipoEquipo->getCalibrableLista()?></td>	
		</tr>
		<tr>
			<th colspan="8" class="titulos">VARIABLES SUSCEPTIBLES A CALIBRACION</th>
		</tr>
		<tr>
			<th class="subTitulos"><label for="presion">PRESION</label></th><td><?=$variables->getVariablesLista($variables->getPresion())?></td>
			<th class="subTitulos"><label for="respiracion">RESPIRACION</label></th><td><?=$variables->getVariablesLista($variables->getRespiracion())?></td>
			<th class="subTitulos"><label for="tiempo">TIEMPO</label></th><td><?=$variables->getVariablesLista($variables->getTiempo())?></td>		
			<th class="subTitulos"><label for="flujo">FLUJO</label></th><td><?=$variables->getVariablesLista($variables->getFlujo())?></td>
		</tr>
		<tr>
			<th class="subTitulos"><label for="temperatura">TEMPERATURA</label></th><td><?=$variables->getVariablesLista($variables->getTemperatura())?></td>
			<th class="subTitulos"><label for="gcardiaco">G. CARDIACO</label></th><td><?=$variables->getVariablesLista($variables->getGCardiaco())?></td>
			<th class="subTitulos"><label for="co2">Co2</label></th><td><?=$variables->getVariablesLista($variables->getCo2())?></td>
			<th class="subTitulos"><label for="fc">FC</label></th><td><?=$variables->getVariablesLista($variables->getFC())?></td>
		</tr>
		<tr>
			<th class="subTitulos"><label for="volumen">VOLUMEN</label></th><td><?=$variables->getVariablesLista($variables->getVolumen())?></td>
			<th class="subTitulos"><label for="ibp">IBP</label></th><td><?=$variables->getVariablesLista($variables->getIBP())?></td>
			<th class="subTitulos"><label for="co">Co</label></th><td><?=$variables->getVariablesLista($variables->getCo())?></td>
			<th class="subTitulos"><label for="ecg">ECG</label></th><td><?=$variables->getVariablesLista($variables->getECG())?></td>
		</tr>
		<tr>
			<th class="subTitulos"><label for="impendancia">IMPENDANCIA</label></th><td><?=$variables->getVariablesLista($variables->getImpendancia())?></td>
			<th class="subTitulos"><label for="energia">ENERGIA</label></th><td><?=$variables->getVariablesLista($variables->getEnergia())?></td>
			<th class="subTitulos"><label for="rpm">RPM</label></th><td><?=$variables->getVariablesLista($variables->getRPM())?></td>
			<th class="subTitulos"><label for="spo2">SpO2</label></th><td><?=$variables->getVariablesLista($variables->getSpO2())?></td>
		</tr>
		<tr>
			<th class="subTitulos"><label for="marcapasos">MARCAPASOS</label></th><td><?=$variables->getVariablesLista($variables->getMarcapasos())?></td>
			<th class="subTitulos"><label for="nibp">NIBP</label></th><td><?=$variables->getVariablesLista($variables->getNIBP())?></td>
			<th class="subTitulos"><label for="hr">HR</label></th><td><?=$variables->getVariablesLista($variables->getHR())?></td>
			<th class="subTitulos"><label for="peso">PESO</label></th><td><?=$variables->getVariablesLista($variables->getPeso())?></td>
		</tr>
		<tr>
			<th colspan="2" class="titulos">PERIORICIDAD DE CALIBRACION</th><td colspan="6">SEGÚN PLAN DE ASEGURAMIENTO METROLÓGICO</td>
		</tr>
	</table>
	<table class="recomendacionFabricante">
		<tr>
			<th class="titulos">RECOMENDACIONES DEL FABICANTE</th>
		</tr>
		<tr>
			<td><?=$informacionE->getRecomendacionesFabricanteListaOrdenada()?></td>
		</tr>
	</table>
	<table class="recomendacionFabricante">
		<tr>
			<th class="titulos">RUTINA DE MANTENIMIENTO</th>
		</tr>
		<tr>
			<th class="subTitulos">ACTIVIDADES</th>
		</tr>
		<tr>
			<td><?=$tipoEquipo->getRutinaListaHV()?></td>
			
		</tr>
	</table>
</div>

</section>
</div>

</body>
</html>

<script>
    function imprimir(){
        window.print()
    }
</script>
