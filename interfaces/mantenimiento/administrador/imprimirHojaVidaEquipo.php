<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/EquipoHV.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/InformacionEquipos.php';
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

$informacionGeneral=new EquipoHV('ide',$ideEquipo);
$adquisicion=new AdquisicionInstalacion('ideEquipo',$informacionGeneral->getIde());
$caracteristicas=new CaracteristicasFisicasTecnicas('ideEquipo',$informacionGeneral->getIde());
$registro=new RegistroApoyoTecnico('ideEquipo',$informacionGeneral->getIde());
$tipoEquipo=new InformacionEquipos('nombre',"'{$informacionGeneral->getNombreEquipo()}'");
$codigo=new CodigoUsoEquipo('ideEquipo',$informacionGeneral->getIde());
$clasificacion=new ClasificacionElectrica('ideEquipo',$informacionGeneral->getIde());
$datosComponentes=ComponentesEquipo::getDatosEnObjetos("ideEquipo={$informacionGeneral->getIde()}","ide");
$variables=new VariablesSuceptiblesCalibracion('ideEquipo',$informacionGeneral->getIde());
$informacionE=new InformacionExtra('ideEquipo',$informacionGeneral->getIde());

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
?>

<style>
*{
	margin:0;
}
h3{
	font-family:Helvetica;
}
table{
	font-family:Helvetica;
    border-collapse: collapse;
    border-spacing: 0 0;
}
.izquierda{
	float:left;
	width:50%;
}
.derecha{
	float:right;
	width:50%;
}

.infoGeneral{
	width:97%;
	margin:10 auto;
	font-size:10px;
	border:1px solid #3E3E3E;
}
.localizacion{
	width:97%;
	margin:5 auto;
	font-size:10px;
}
.adquisicion{
	font-size:10px;	
	width:97%;
	margin:5 auto;
}
.caracteristicasFisicas{
	font-size:10px;	
	width:97%;
	margin:5 auto;
}
.registroApoyo{
	font-size:10px;	
	width:97%;
	margin:5 auto;
}
.fotografia{
	font-size:10px;	
	width:97%;
	margin:5 auto;
}
.descripcion{
	font-size:10px;	
	width:97%;
	margin:5 auto;
}
.componentes{
	font-size:10px;	
	width:97%;
	margin:5 auto;
}
.tecPredominante{
	font-size:10px;	
	width:97%;
	margin:5 auto;
}

.mantenimiento{
	font-size:10px;	
	width:97%;
	margin:5 auto;
}

.recomendacionFabricante{
	font-size:10px;	
	width:97%;
	margin:5 auto;
}
.rutinaMantenimiento{
	font-size:10px;	
	width:97%;
	margin:5 auto;
}
.titulos{
	background:#03477E;
	color:#fff;
}
.subTitulos{
	color:#000;
	background:#D0D0D0;
	border-bottom:1px solid #fff;
}
</style>

<div>
<center>
	<h3>HOJA DE VIDA DE EQUIPO BIOMÉDICO</h3>
</center>
<section class="izquierda">
<table class="infoGeneral">
		<tr>
			<th colspan="2" class="titulos">INFORMACION GENERAL</th>
		</tr>
		<tr>
			<th class="subTitulos">NOMBRE DEL EQUIPO</th><td><?=$informacionGeneral->getNombreEquipo()?></td>
		</tr>
		<tr>
			<th class="subTitulos">No. ACTIVO FIJO</th><td><?=$informacionGeneral->getActivoFijo()?></td>
		</tr>
		<tr>
			<th class="subTitulos">MARCA</th><td><?=$informacionGeneral->getMarca()?></td>
		</tr>
		<tr>
			<th class="subTitulos">MODELO</th><td><?=$informacionGeneral->getModelo()?></td>
		</tr>
		<tr>
			<th class="subTitulos">SERIE</th><td><?=$informacionGeneral->getSerial()?></td>
		</tr>
		<tr>
			<th class="subTitulos">REFERENCIA</th><td><?=$informacionGeneral->getReferencia()?></td>
		</tr>
		<tr>
			<th class="subTitulos">REGISTRO INVIMA</th><td><?=$informacionGeneral->getRegistroInvima()?></td>				
		</tr>
	</table>

	<table border="1" class="localizacion">
		<tr>
			<th colspan="2" class="titulos">LOCALIZACION</th>
		</tr>
		<tr>
			<th class="subTitulos">DEPARTAMENTO</th>
			<td>
				<?=$departamento?>
			</td>
		</tr>
		<tr>
			<th class="subTitulos">MUNICIPIO</th>
			<td>
				<?=$municipio?>
			</td>
		</tr>
		<tr>
			<th class="subTitulos">SEDE</th><td><?=$informacionGeneral->getSede()->getNombre().' - '.$informacionGeneral->getUbicacion()?></td>
		</tr>
	</table>

<table border="1" class="adquisicion">
		<tr>
			<th colspan="4" class="titulos">ADQUISICION E INSTALACION</th>
		</tr>
		<tr>
			<th class="subTitulos">FABRICANTE</th><td><?=$adquisicion->getFabricante()?></td>
			<th class="subTitulos">FORMA DE ADQUISICION</th><td><?=$adquisicion->getFormaAquisicion()?></td>
		</tr>
		<tr>
			<th class="subTitulos">TELEFONO</th><td><?=$adquisicion->getTelefonoF()?></td>
			<th class="subTitulos">COSTO DE ADQUISICION</th><td><?=$adquisicion->getCostoAquisicion()?></td>
		</tr>
		<tr>
			<th class="subTitulos">DIRECCION</th><td><?=$adquisicion->getDireccionF()?></td>
			<th class="subTitulos">FECHA DE COMPRA</th><td><?=$adquisicion->getFechaCompra()?></td>
		</tr>
		<tr>
			<th class="subTitulos">LUGAR DE ORIGEN</th><td><?=$adquisicion->getLugarOrigen()?></td>
			<th class="subTitulos">FECHA DE INSTALACION</th><td><?=$adquisicion->getFechaInstalacion()?></td>
		</tr>
		<tr>
			<th class="subTitulos">PROVEEDOR</th><td><?=$adquisicion->getProveedor()?></td>
			<th class="subTitulos">INICIO DE GARANTIA</th><td><?=$adquisicion->getInicioGarantia()?></td>
		</tr>
		<tr>
			<th class="subTitulos">TELEFONO</th><td><?=$adquisicion->getTelefonoP()?></td>
			<th class="subTitulos">FINALIZACION GARANTIA</th><td><?=$adquisicion->getFinalizacionGarantia()?></td>
		</tr>
		<tr>
			<th class="subTitulos">DIRECCION</th><td><?=$adquisicion->getDireccionP()?></td>
			<th class="subTitulos">FECHA PUESTA SERVICIO</th><td><?=$adquisicion->getFechaPuestaServicio()?></td>
		</tr>
		<tr>
			<th class="subTitulos">E-MAIL</th><td colspan="2"><?=$adquisicion->getEmail()?></td>
		</tr>
	</table>

	<table border="1" class="caracteristicasFisicas">
		<tr>
			<th colspan="4" class="titulos">CARACTERISTICAS FISICAS Y TECNICAS DEL EQUIPO</th>			
		</tr>
		<tr>
			<th class="subTitulos">VOLTAJE OPERACION [V]</th><td><?=$caracteristicas->getVoltajeOperacion()?></td>
			<th class="subTitulos">PESO [Kg]</th><td ><?=$caracteristicas->getPeso()?></td>
		</tr>
		<tr>
			<th class="subTitulos">VOLTAJE MAXIMA OPERACION [V]</th><td ><?=$caracteristicas->getVoltajeMaxOperacion()?></td>
			<th class="subTitulos">CAPACIDAD</th><td ><?=$caracteristicas->getCapacidad()?></td>
		</tr>
		<tr>
			<th class="subTitulos">CORRIENTE MAXIMA OPERACION [A]</th><td ><?=$caracteristicas->getCorrienteMaxOperacion()?></td>
			<th class="subTitulos">DIMENSIONES</th><td ><?=$caracteristicas->getCorrienteMaxOperacion()?></td>
		</tr>
		<tr>
			<th class="subTitulos">CORRIENTE MINIMA OPERACION [A]</th><td><?=$caracteristicas->getCorrienteMinOperacion()?></td>
			<th class="subTitulos">AÑOS DE VIDA</th><td><?=$caracteristicas->getAniosVida()?></td>
		</tr>
		<tr>
			<th class="subTitulos">POTENCIA CONSUMIDA [W]</th><td><?=$caracteristicas->getPotenciaConsumida()?></td>
			<th class="subTitulos">REQUIERE AGUA</th><td><?=$caracteristicas->getRequiereAguaOptions()[1]?></td>
		</tr>
		<tr>
			<th class="subTitulos">FRECUENCIA [Hz]</th><td><?=$caracteristicas->getFrecuencia()?></td>
			<th class="subTitulos">REQUIERE GAS PROPANO</th><td><?=$caracteristicas->getRequiereGasPropanoOptions()[1]?></td>
		</tr>
		<tr>
			<th class="subTitulos">PRESION [Bar]</th><td><?=$caracteristicas->getPresion()?></td>
			<th class="subTitulos">REQUIERE COMBUSTIBLE</th><td><?=$caracteristicas->getRequiereCombustibleOptions()[1]?></td>
		</tr>
		<tr>
			<th class="subTitulos">VELOCIDAD [W]</th><td><?=$caracteristicas->getVelocidad()?></td>
			<th class="subTitulos">REQUIERE GASES MEDICINALES</th><td ><?=$caracteristicas->getRequiereGasMedicinalOptions()[1]?></td>
		</tr>
	</table>
	<table border="1" class="registroApoyo">
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
			<td class="tds"><?=$tipoEquipo->getClasificacionRiesgoLista()?></td>
		</tr>
	</table>

	<table border="1" class="registroApoyo">
		<tr>
			<th colspan="6" class="titulos">CODIGO DE USO DEL EQUIPO</th>
		</tr>
		<tr>
			<th class="subTitulos">SERVICIO</th><td><?=$codigo->getServicio()?></td>
			<th class="subTitulos">UNIDAD</th><td><?=$codigo->getUnidad()?></td>
			<th class="subTitulos">AMBIENTE</th><td><?=$codigo->getAmbiente()?></td>
		</tr>
	</table>
</section>
<section class="derecha">
	<table class="fotografia">
		<tr>
			<td class="subTitulos">
				<center>
					<img src="/var/www/html/SoftwareGestion/FotografiasEquipos/<?=$tipoEquipo->getFotografia()?>" height="110px" id="imagenEquipo">
				</center>
			</td>
		</tr>
	</table>

	<table class="descripcion">
		<tr>
			<th class="titulos">DESCRIPCION FUNCIONAL</th>
		</tr>
		<tr>
			<td><?=$tipoEquipo->getDescripcionFuncional()?></td>
		</tr>
	</table>

	<table class="componentes">
		<tr>
			<th colspan="3" class="titulos">COMPONENTES DEL EQUIPO</th>
		</tr>
		<tr>
			<th class="subTitulos">PARTES O ELEMENTOS</th><th class="subTitulos">REFERECIA</th><th class="subTitulos">ACCESORIOS</th>
		</tr>
		<?=$componentes?>
	</table>

	<table class="tecPredominante">
		<tr>
			<th colspan="2"  class="titulos">CLASE DE TECNOLOGIA PREDOMIENANTE</th>
			<th colspan="2"  class="titulos">CLASIFICACION BIOMEDICA</th>
		</tr>
		<tr>
			<td colspan="2">
				<div  class="intro">
					<?=$tipoEquipo->getTecnologiaPredomienanteLista()?>
				</div>
			</td>
			<td colspan="2">
				<div  class="intro2">
					<?=$tipoEquipo->getClasificacionBiomedicaLista()?>
				</div>	
			</td>
		</tr>
		<tr>
			<th colspan="4" class="titulos">CLASIFICACION ELECTRICA</th>
		</tr>
		<tr>
			<th class="subTitulos">TIPO</th><td><?=$clasificacion->getTipo()?></td>
			<th class="subTitulos">CLASE</th><td><?=$clasificacion->getClase()?></td>
		</tr>
	</table>

	<table class="mantenimiento">
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
	<table class="rutinaMantenimiento">
		<tr>
			<th class="titulos">RUTINA DE MANTENIMIENTO</th>
		</tr>
		<tr>
			<th class="titulos">ACTIVIDADES</th>
		</tr>
		<tr>
			<td><?=$tipoEquipo->getRutinaListaOrdenada()?>
			<input type="hidden" name="ideSede" value="<?=$ideSede?>">
			<input type="hidden" name="ideEquipo" value="<?=$informacionGeneral->getIde()?>">
			</td>
			
		</tr>
	</table>

</section>
</div>