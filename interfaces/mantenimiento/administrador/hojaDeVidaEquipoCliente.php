<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
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
require_once dirname(__FILE__) . '/../../../clasesGenericas/ConectorBD.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$datosLista=InformacionEquipos::getNombreArreglo(null,null);

date_default_timezone_set('America/Bogota');

$cliente=new Cliente('nit',"'$nit'");
$codDepartamento=$cliente->getCiudad()->getCodDepartamento();
if($accion=='ACTUALIZAR'){
	$informacionGeneral=new EquipoHV('ide',$ideEquipo);
	$adquisicion=new AdquisicionInstalacion('ideEquipo',$informacionGeneral->getIde());
	$caracteristicas=new CaracteristicasFisicasTecnicas('ideEquipo',$informacionGeneral->getIde());
	if(isset($NE)){
		$tipoEquipo=new InformacionEquipos('nombre',"'{$NE}'");
		$nombreEquiponuevo=$NE;
	}else{
		$tipoEquipo=new InformacionEquipos('nombre',"'{$informacionGeneral->getNombreEquipo()}'");	
		$nombreEquiponuevo=$informacionGeneral->getNombreEquipo();
	}
	$registro=new RegistroApoyoTecnico('ideEquipo',$informacionGeneral->getIde());
	$codDepartamento=$informacionGeneral->getCliente()->getCiudad()->getCodDepartamento();
	$codigo=new CodigoUsoEquipo('ideEquipo',$informacionGeneral->getIde());
	$componentes=new ComponentesEquipo('ideEquipo',$informacionGeneral->getIde());
	$clasificacion=new ClasificacionElectrica('ideEquipo',$informacionGeneral->getIde());
	$variables=new VariablesSuceptiblesCalibracion('ideEquipo',$informacionGeneral->getIde());
	$informacionE=new InformacionExtra('ideEquipo',$informacionGeneral->getIde());
}else{
	$informacionGeneral=new EquipoHV(null,null);
	$adquisicion=new AdquisicionInstalacion(null,null);
	$caracteristicas=new CaracteristicasFisicasTecnicas(null,null);

	if(isset($NE)){
		$tipoEquipo=new InformacionEquipos('nombre',"'{$NE}'");
		$nombreEquiponuevo=$NE;
	}else{
		$tipoEquipo=new InformacionEquipos(null,null);
		$nombreEquiponuevo=$informacionGeneral->getNombreEquipo();
	}
	$registro=new RegistroApoyoTecnico(null,null);
	$codigo=new CodigoUsoEquipo(null,null);
	$componentes=new ComponentesEquipo(null,null);
	$clasificacion=new ClasificacionElectrica(null,null);
	$variables=new VariablesSuceptiblesCalibracion(null,null);
	$informacionE=new InformacionExtra(null,null);
}

if($tipoEquipo->getFotografia()!=null)$ruta="<img src='../FotografiasEquipos/{$tipoEquipo->getFotografia()}' height='120px' id='imagenEquipo'>";
else $ruta="<img src='../FotografiasEquipos/SN.png' height='120px' id='imagenEquipo'>";
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/equiposHVC.php&nitCliente=<?=$cliente->getNit()?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="30px" style="float: left"></a>
<form name="formulario" method="POST" action="mantenimiento/administrador/hojaDeVidaEquipoClienteActualizar.php" enctype="multipart/form-data">
<div class="accionHV">
	<input type="submit" name="accion" value="<?=$accion?>">
</div>
<div class="hojaVida">
<h2>HOJA DE VIDA DE EQUIPO BIOMEDICO</h2>
	<section class="izquierda">
	<table class="informacionGeneral" border="1">
		<tr>
			<th colspan="2" class="titulos">INFORMACION GENERAL</th>
		</tr>
		<tr>
			<th class="subTitulos">NOMBRE DEL EQUIPO</th><td><input type="text" name="nombreEquipo" id="nombreEquipo" class="awesomplete cajon" onkeydown="recargarInformacion(event)" value="<?=$nombreEquiponuevo?>" autocomplete="off" data-list="<?=$datosLista?>" data-minChars="1" required></td>
		</tr>
		<tr>
			<th class="subTitulos">No. ACTIVO FIJO</th><td><input type="text" name="activoFijo" class="cajon" value="<?=$informacionGeneral->getActivoFijo()?>" required></td>
		</tr>
		<tr>
			<th class="subTitulos">MARCA</th><td><input type="text" name="marca" class="cajon" value="<?=$informacionGeneral->getMarca()?>" required></td>
		</tr>
		<tr>
			<th class="subTitulos">MODELO</th><td><input type="text" name="modelo" class="cajon" value="<?=$informacionGeneral->getModelo()?>" required></td>
		</tr>
		<tr>
			<th class="subTitulos">SERIE</th><td><input type="text" name="serial" class="cajon" value="<?=$informacionGeneral->getSerial()?>" required></td>
		</tr>
		<tr>
			<th class="subTitulos">REFERENCIA</th><td><input type="text" name="referencia" class="cajon" value="<?=$informacionGeneral->getReferencia()?>" required></td>
		</tr>
		<tr>
			<th class="subTitulos">REGISTRO INVIMA</th><td><input type="text" name="registroInvima" class="cajon" value="<?=$informacionGeneral->getRegistroInvima()?>" required></td>				
		</tr>
	</table>

	<table border="1" class="localizacion">
		<tr>
			<th colspan="2" class="titulos">LOCALIZACION</th>
		</tr>
		<tr>
			<th class="subTitulos">DEPARTAMENTO</th>
			<td>
			</td>
		</tr>
		<tr>
			<th class="subTitulos">MUNICIPIO</th>
			<td>
				
			</td>
		</tr>
		<tr>
			<th class="subTitulos">SEDE</th><td><?=$cliente->getNombre().' - '?><input type='text' value="<?=$informacionGeneral->getUbicacion()?>" name="ubicacion" class="cajon" placeholder="Ubicacion" style="width:45%" required></td>
		</tr>
	</table>

	<table border="1" class="adquisicion">
		<tr>
			<th colspan="4" class="titulos">ADQUISICION E INSTALACION</th>
		</tr>
		<tr>
			<th class="subTitulos">FABRICANTE</th><td><input type="text" name="fabricante" class="cajon" value="<?=$adquisicion->getFabricante()?>"></td>
			<th class="subTitulos">FORMA DE ADQUISICION</th><td><input type="text" name="formaAdquisicion"  class="cajon" value="<?=$adquisicion->getFormaAquisicion()?>"></td>
		</tr>
		<tr>
			<th class="subTitulos">TELEFONO</th><td><input type="tel" name="telefonoF" class="cajon" value="<?=$adquisicion->getTelefonoF()?>" required></td>
			<th class="subTitulos">COSTO DE ADQUISICION</th><td><input type="number" step="any" name="costoAdquisicion" class="cajon" value="<?=$adquisicion->getCostoAquisicion()?>"></td>
		</tr>
		<tr>
			<th class="subTitulos">DIRECCION</th><td><input type="text" name="direccionF" class="cajon" value="<?=$adquisicion->getDireccionF()?>"></td>
			<th class="subTitulos">FECHA DE COMPRA</th><td><input type="date" name="fechaCompra"  class="cajon" value="<?=$adquisicion->getFechaCompra()?>"></td>
		</tr>
		<tr>
			<th class="subTitulos">LUGAR DE ORIGEN</th><td><input type="text" name="lugarOrigen" class="cajon" value="<?=$adquisicion->getLugarOrigen()?>"></td>
			<th class="subTitulos">FECHA DE INSTALACION</th><td><input type="date" name="fechaInstalacion" class="cajon" value="<?=$adquisicion->getFechaInstalacion()?>"></td>
		</tr>
		<tr>
			<th class="subTitulos">PROVEEDOR</th><td><input type="text" name="proveedor" class="cajon" value="<?=$adquisicion->getProveedor()?>"></td>
			<th class="subTitulos">INICIO DE GARANTIA</th><td><input type="date" name="inicioGarantia" class="cajon"  value="<?=$adquisicion->getInicioGarantia()?>"></td>
		</tr>
		<tr>
			<th class="subTitulos">TELEFONO</th><td><input type="tel" name="telefonoP"  class="cajon" value="<?=$adquisicion->getTelefonoP()?>"></td>
			<th class="subTitulos">FINALIZACION GARANTIA</th><td><input type="date" name="finalizacionGarantia" class="cajon"  value="<?=$adquisicion->getFinalizacionGarantia()?>"></td>
		</tr>
		<tr>
			<th class="subTitulos">DIRECCION</th><td><input type="text" name="direccionP"  class="cajon" value="<?=$adquisicion->getDireccionP()?>"></td>
			<th class="subTitulos">FECHA PUESTA SERVICIO</th><td><input type="date" name="fechaPuestaServicio"  class="cajon" value="<?=$adquisicion->getFechaPuestaServicio()?>"></td>
		</tr>
		<tr>
			<th class="subTitulos">E-MAIL</th><td colspan="2"><input type="email" name="email"  class="cajon"  value="<?=$adquisicion->getEmail()?>"></td>
		</tr>
	</table>
	<table class="caracteristicasFisicasTecnicas">
		<tr>
			<th colspan="4" class="titulos">CARACTERISTICAS FISICAS Y TECNICAS DEL EQUIPO</th>			
		</tr>
		<tr>
			<th class="subTitulos">VOLTAJE OPERACION [V]</th><td><input type="text" name="voltajeOperacion"  class="cajon" value="<?=$caracteristicas->getVoltajeOperacion()?>"></td>
			<th class="subTitulos">PESO [Kg]</th><td ><input type="text" name="peso" class="cajon"  value="<?=$caracteristicas->getPeso()?>"></td>
		</tr>
		<tr>
			<th class="subTitulos">VOLTAJE MAXIMA OPERACION [V]</th><td ><input type="text" name="voltajeMaxOperacion"  class="cajon" value="<?=$caracteristicas->getVoltajeMaxOperacion()?>"></td>
			<th class="subTitulos">CAPACIDAD</th><td ><input type="text" name="capacidad" class="cajon"  value="<?=$caracteristicas->getCapacidad()?>"></td>
		</tr>
		<tr>
			<th class="subTitulos">CORRIENTE MAXIMA OPERACION [A]</th><td ><input type="text" name="corrienteMaxOperacion"  class="cajon" value="<?=$caracteristicas->getCorrienteMaxOperacion()?>"></td>
			<th class="subTitulos">DIMENSIONES</th><td ><input type="text" name="dimensiones" class="cajon"  value="<?=$caracteristicas->getCorrienteMaxOperacion()?>"></td>
		</tr>
		<tr>
			<th class="subTitulos">CORRIENTE MINIMA OPERACION [A]</th><td ><input type="text" name="corrienteMinOperacion"  class="cajon" value="<?=$caracteristicas->getCorrienteMinOperacion()?>"></td>
			<th class="subTitulos">AÑOS DE VIDA</th><td><input type="text" name="aniosVida" class="cajon"  value="<?=$caracteristicas->getAniosVida()?>"></td>
		</tr>
		<tr>
			<th class="subTitulos">POTENCIA CONSUMIDA [W]</th><td><input type="text" name="potenciaConsumida"  class="cajon" value="<?=$caracteristicas->getPotenciaConsumida()?>"></td>
			<th class="subTitulos">REQUIERE AGUA</th><td ><?=$caracteristicas->getRequiereAguaOptions()[0]?></td>
		</tr>
		<tr>
			<th class="subTitulos">FRECUENCIA [Hz]</th><td ><input type="text" name="frecuencia"  class="cajon" value="<?=$caracteristicas->getFrecuencia()?>"></td>
			<th class="subTitulos">REQUIERE GAS PROPANO</th><td><?=$caracteristicas->getRequiereGasPropanoOptions()[0]?></td>
		</tr>
		<tr>
			<th class="subTitulos">PRESION [Bar]</th><td><input type="text" name="presion"  class="cajon" value="<?=$caracteristicas->getPresion()?>"></td>
			<th class="subTitulos">REQUIERE COMBUSTIBLE</th><td><?=$caracteristicas->getRequiereCombustibleOptions()[0]?></td>
		</tr>
		<tr>
			<th class="subTitulos">VELOCIDAD [W]</th><td><input type="text" name="velocidad"  class="cajon" value="<?=$caracteristicas->getVelocidad()?>"></td>
			<th class="subTitulos">REQUIERE GASES MEDICINALES</th><td ><?=$caracteristicas->getRequiereGasMedicinalOptions()[0]?></td>
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
			<td class="tds"><?=$registro->getManualesOption()?></td>
			<td class="tds"><?=$registro->getPlanosOption()?></td>
			<td class="tds"><?=$registro->getUsosOption()?></td>
			<td class="tds"><?=$tipoEquipo->getClasificacionRiesgoRadio()?></td>
		</tr>
	</table>
	<table class="apoyotecnico">
		<tr>
			<th colspan="6" class="titulos">CODIGO DE USO DEL EQUIPO</th>
		</tr>
		<tr>
			<th class="subTitulos">SERVICIO</th><td><input type="text" class=" cajon" name="servicio" value="<?=$codigo->getServicio()?>" maxlength="5"></td>
			<th class="subTitulos">UNIDAD</th><td><input type="text" class=cajon" name="unidad" value="<?=$codigo->getUnidad()?>" maxlength="5"></td>
			<th class="subTitulos">AMBIENTE</th><td><input type="text" class="cajon" name="ambiente" value="<?=$codigo->getAmbiente()?>" maxlength="5"></td>
		</tr>
	</table>
</section>

<section class="derecha">
	<table class="fotografiaEquipo">
		<tr>
			<td class="subTitulos"><?=$ruta?></td>
		</tr>
		<tr>
			<th><input type="file" name="fotografiaEquipo"></th>
		</tr>
	</table>	
	<table class="descripcionFunacional">
		<tr>
			<th class="titulos">DESCRIPCION FUNCIONAL</th>
		</tr>
		<tr>
			<td><textarea name="descripcionFuncional"><?=$tipoEquipo->getDescripcionFuncional()?></textarea></td>
		</tr>
	</table>
	<table class="componentesEquipos" border="1">
		<tr>
			<th colspan="3" class="titulos">COMPONENTES DEL EQUIPO</th>
		</tr>
		<tr>
			<th class="subTitulos">PARTES O ELEMENTOS</th><th class="subTitulos">REFERECIA</th><th class="subTitulos">ACCESORIOS</th>
		</tr>
		<tr>
			<td><input type="text" class="cajon" name="partes1"></td><td><input type="text" class="cajon" name="referencia1"></td><td><input type="text" class="cajon" name="accesorios1"></td>
		</tr>
		<tr>
			<td><input type="text" class="cajon" name="partes2"></td><td><input type="text" class="cajon" name="referencia2"></td><td><input type="text" class="cajon" name="accesorios2"></td>
		</tr>
		<tr>
			<td><input type="text" class="cajon" name="partes3"></td><td><input type="text" class="cajon" name="referencia3"></td><td><input type="text" class="cajon" name="accesorios3"></td>
		</tr>
		<tr>
			<td><input type="text" class="cajon" name="partes4"></td><td><input type="text" class="cajon" name="referencia4"></td><td><input type="text" class="cajon" name="accesorios4"></td>
		</tr>
	</table>
	<table class="tecPredominante" border="1">
		<tr>
			<th colspan="2"  class="titulos">CLASE DE TECNOLOGIA PREDOMIENANTE</th>
			<th colspan="2"  class="titulos">CLASIFICACION BIOMEDICA</th>
		</tr>
		<tr>
			<td colspan="2"><select size="8" name="tecnologiaPredominante" class="seleccion" required><?=$tipoEquipo->getTecnologiaPredomienanteOption()?></select></td><td colspan="2"><select size="8" name="clasificacionBiomedica" class="seleccion" required><?=$tipoEquipo->getClasificacionBiomedicaOptions()?></select></td>
		</tr>
		<tr>
			<th colspan="4" class="titulos">CLASIFICACION ELECTRICA</th>
		<tr>
		<tr>
			<th class="subTitulos">TIPO</th><td><input type="text" name="tipoClasificacion" class="cajon" value="<?=$clasificacion->getTipo()?>"></td>
			<th class="subTitulos">CLASE</th><td><input type="text" name="claseClasificacion" class="cajon" value="<?=$clasificacion->getClase()?>"></td>
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
			<th colspan="2" class="subTitulos">REQUIERE CALIBRACION</th><td colspan="6"><?=$tipoEquipo->getCalibrableRadio()?></td>	
		</tr>
		<tr>
			<th colspan="8" class="titulos">VARIABLES SUSCEPTIBLES A CALIBRACION</th>
		</tr>
		<tr>
			<th class="subTitulos"><label for="presion">PRESION</label></th><td><input type="checkbox" name="presionVC" id="presion" <?=$variables->getPresion()?>></td>
			<th class="subTitulos"><label for="respiracion">RESPIRACION</label></th><td><input type="checkbox" name="respiracion" id="respiracion" <?=$variables->getRespiracion()?>></td>
			<th class="subTitulos"><label for="tiempo">TIEMPO</label></th><td><input type="checkbox" name="tiempo" id="tiempo" <?=$variables->getTiempo()?>></td>		
			<th class="subTitulos"><label for="flujo">FLUJO</label></th><td><input type="checkbox" name="flujo" id="flujo" <?=$variables->getFlujo()?>></td>
		</tr>
		<tr>
			<th class="subTitulos"><label for="temperatura">TEMPERATURA</label></th><td><input type="checkbox" name="temperatura" id="temperatura" <?=$variables->getTemperatura()?>></td>
			<th class="subTitulos"><label for="gcardiaco">G. CARDIACO</label></th><td><input type="checkbox" name="gcardiaco" id="gcardiaco" <?=$variables->getGCardiaco()?>></td>
			<th class="subTitulos"><label for="co2">Co2</label></th><td><input type="checkbox" name="co2" id="co2" <?=$variables->getCo2()?>></td>
			<th class="subTitulos"><label for="fc">FC</label></th><td><input type="checkbox" name="fc" id="fc" <?=$variables->getFC()?>></td>
		</tr>
		<tr>
			<th class="subTitulos"><label for="volumen">VOLUMEN</label></th><td><input type="checkbox" name="volumen" id="volumen" <?=$variables->getVolumen()?>></td>
			<th class="subTitulos"><label for="ibp">IBP</label></th><td><input type="checkbox" name="ibp" id="ibp" <?=$variables->getIBP()?>></td>
			<th class="subTitulos"><label for="co">Co</label></th><td><input type="checkbox" name="co" id="co" <?=$variables->getCo()?>></td>
			<th class="subTitulos"><label for="ecg">ECG</label></th><td><input type="checkbox" name="ecg" id="ecg" <?=$variables->getECG()?>></td>
		</tr>
		<tr>
			<th class="subTitulos"><label for="impendancia">IMPENDANCIA</label></th><td><input type="checkbox" name="impendancia" id="impendancia" <?=$variables->getImpendancia()?>></td>
			<th class="subTitulos"><label for="energia">ENERGIA</label></th><td><input type="checkbox" name="energia" id="energia" <?=$variables->getEnergia()?>></td>
			<th class="subTitulos"><label for="rpm">RPM</label></th><td><input type="checkbox" name="rpm" id="rpm" <?=$variables->getRPM()?>></td>
			<th class="subTitulos"><label for="spo2">SpO2</label></th><td><input type="checkbox" name="spo2" id="spo2" <?=$variables->getSpO2()?>></td>
		</tr>
		<tr>
			<th class="subTitulos"><label for="marcapasos">MARCAPASOS</label></th><td><input type="checkbox" name="marcapasos" id="marcapasos" <?=$variables->getMarcapasos()?>></td>
			<th class="subTitulos"><label for="nibp">NIBP</label></th><td><input type="checkbox" name="nibp" id="nibp" <?=$variables->getNIBP()?>></td>
			<th class="subTitulos"><label for="hr">HR</label></th><td><input type="checkbox" name="hr" id="hr" <?=$variables->getHR()?>></td>
			<th class="subTitulos"><label for="peso">PESO</label></th><td><input type="checkbox" name="pesoVC" id="peso" <?=$variables->getPeso()?>></td>
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
			<td><textarea name="recomendacionesFabricante"><?=$informacionE->getRecomendacionesFabricante()?></textarea></td>
		</tr>
	</table>
	<table class="recomendacionFabricante">
		<tr>
			<th class="titulos">RUTINA DE MANTENIMIENTO</th>
		</tr>
		<tr>
			<th class="titulos">ACTIVIDADES</th>
		</tr>
		<tr>
			<td><textarea name="rutina" required><?=$tipoEquipo->getRutina()?></textarea>
			<input type="hidden" name="nitCliente" value="<?=$nit?>">
			</td>
			
		</tr>
	</table>
</section>
</div>
</form>

<script>
<?=InformacionEquipos::getInformacionArregloJS()?>
	function recargarInformacion(event){
		const key = event.key;
		if(key==='Tab'){
			var nuevoNombreEquipo = null;
			var nombreEquipo = document.getElementById('nombreEquipo').value; 
			for (var i = 0; i < informaciones.length; i++) {
            	if (nombreEquipo === informaciones[i][0]) {
					nuevoNombreEquipo = informaciones[i][0];
            	}
			}
		//document.getElementById('nombreEquipo').value = nuevoNombreEquipo;
		window.location.href=window.location.href + "&NE=" + nuevoNombreEquipo
		//alert(nuevoNombreEquipo);
		}
	}
</script>
