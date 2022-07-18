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
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cronograma.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ClasificacionElectrica.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/VariablesSuceptiblesCalibracion.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/InformacionExtra.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Servicio.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Unidad.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Ambiente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/DatosFabricante.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/RutinaExtra.php';

require_once dirname(__FILE__) . '/../../../clasesGenericas/Ciudad.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/Departamento.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/ConectorBD.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$datosLista=TipoEquipo::getNombreArreglo(null,null);

date_default_timezone_set('America/Bogota');


$componentes='';
if($accion=='ACTUALIZAR'){
	$informacionGeneral=new Equipo('ide',$ideEquipo);
if($informacionGeneral->getIdeSede()!=null){
	$sedeNombre=$informacionGeneral->getSede()->getNombre();
	$cdepar=$informacionGeneral->getSede()->getCiudad()->getCodDepartamento();
	$departamento=$informacionGeneral->getSede()->getCiudad()->getDepartamento()->getNombre();
	$ciudad=$informacionGeneral->getSede()->getCiudad()->getNombre();
	$cronograma=new Cronograma('ideSede',$informacionGeneral->getIdeSede());
}else{
	$sedeNombre=$informacionGeneral->getCliente()->getNombre();
	$cdepar=$informacionGeneral->getCliente()->getCiudad()->getCodDepartamento();
	$departamento=$informacionGeneral->getCliente()->getCiudad()->getDepartamento()->getNombre();
	$ciudad=$informacionGeneral->getCliente()->getCiudad()->getNombre();
	$cronograma=new Cronograma('nitCliente',"'".$informacionGeneral->getNitCliente()."'");
}
	
	$adquisicion=new AdquisicionInstalacion('ideEquipo',$informacionGeneral->getIde());
	$caracteristicas=new CaracteristicasFisicasTecnicas('ideEquipo',$informacionGeneral->getIde());
	if(isset($NE)){
		$tipoEquipo=new TipoEquipo('nombre',"'{$NE}'");
		$nombreEquiponuevo=$NE;
	}else{
		$tipoEquipo=new TipoEquipo('nombre',"'{$informacionGeneral->getNombreEquipo()}'");	
		$nombreEquiponuevo=$informacionGeneral->getNombreEquipo();
	}
	$registro=new RegistroApoyoTecnico('ideEquipo',$informacionGeneral->getIde());
	$codDepartamento=$informacionGeneral->getCliente()->getCiudad()->getCodDepartamento();
	$codigo=new CodigoUsoEquipo('ideEquipo',$informacionGeneral->getIde());
	$clasificacion=new ClasificacionElectrica('ideEquipo',$informacionGeneral->getIde());
	$variables=new VariablesSuceptiblesCalibracion('ideEquipo',$informacionGeneral->getIde());
	$informacionE=new InformacionExtra('ideTipoEquipo',$informacionGeneral->getIde());
	$datosComponentes=ComponentesEquipo::getDatosEnObjetos("ideEquipo={$informacionGeneral->getIde()}","ide");
	$item=1;
	for($i = 0; $i < 4; $i++){
		if(isset($datosComponentes[$i])){
			$objeto=$datosComponentes[$i];
			$componentes.='<tr>';
			$componentes.="<td><input type='text' class='cajon' name='partes{$item}' value='{$objeto->getPartes()}'></td><td><input type='text' class='cajon' name='referencia{$item}' value='{$objeto->getReferencia()}'></td><td><input type='text' class='cajon' name='accesorios{$item}' value='{$objeto->getAccesorios()}'></td>";
			$componentes.='</tr>';
			$item++;
		}else{
			$componentes.='<tr>';
			$componentes.="<td><input type='text' class='cajon' name='partes{$item}'></td><td><input type='text' class='cajon' name='referencia{$item}'></td><td><input type='text' class='cajon' name='accesorios{$item}'></td>";
			$componentes.='</tr>';
			$item++;
		}
	}

}else{
	$informacionGeneral=new Equipo(null,null);
	$adquisicion=new AdquisicionInstalacion(null,null);
	$caracteristicas=new CaracteristicasFisicasTecnicas(null,null);

	if(isset($NE)){
		$tipoEquipo=new TipoEquipo('nombre',"'{$NE}'");
		$nombreEquiponuevo=$NE;
	}else{
		$tipoEquipo=new TipoEquipo(null,null);
		$nombreEquiponuevo=$informacionGeneral->getNombreEquipo();
	}
	$registro=new RegistroApoyoTecnico(null,null);
	$codigo=new CodigoUsoEquipo(null,null);
	$clasificacion=new ClasificacionElectrica(null,null);
	$variables=new VariablesSuceptiblesCalibracion(null,null);
	$informacionE=new InformacionExtra(null,null);
//inicio componentes equipo
for($i = 1; $i < 5; $i++){
	$componentes.='<tr>';
	$componentes.="<td><input type='text' class='cajon' name='partes{$i}'></td><td><input type='text' class='cajon' name='referencia{$i}'></td><td><input type='text' class='cajon' name='accesorios{$i}'></td>";
	$componentes.='</tr>';
}
}
$ideFabricante=$adquisicion->getIdeFabricante();
$ideProveedor=$adquisicion->getIdeProveedor();
$codServicio=$informacionGeneral->getAmbiente()->getUnidad()->getCodServicio();
$codUnidad=$informacionGeneral->getAmbiente()->getCodUnidad();
$codAmbiente =$informacionGeneral->getIdeAmbiente();
$codDepartamento=$cdepar;

if($tipoEquipo->getFotografia()!=null)$ruta="<img src='../FotografiasEquipos/{$tipoEquipo->getFotografia()}' height='120px' id='imagenEquipo'>";
else $ruta="<img src='../FotografiasEquipos/SN.png' height='120px' id='imagenEquipo'>"; 
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/detallesEquipo.php&ideEquipo=<?=$informacionGeneral->getIde()?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px" style="float: left"></a>
<form name="formulario" method="POST" action="mantenimiento/administrador/hojaDeVidaEquipoSedeActualizar.php" enctype="multipart/form-data">
<div class="accionHV">
	<input type="submit" name="accion" value="<?=$accion?>">
</div>
<div class="hojaVida">
<h2>HOJA DE VIDA DE EQUIPO BIOMEDICO</h2>
	<section class="izquierda">
	<table class="informacionGeneral" border="1">
		<tr>
			<th class="tituloNombre" colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$informacionGeneral->getNombreEquipo()?></th>
		</tr>
		<tr>
			<th class="subtitulos" colspan="2">FOTO EQUIPO BIOMÉDICO</th><th class="subtitulos" colspan="2">DESCRIPCIÓN FUNCIONAL</th>
		</tr>
		<tr>
			<td colspan="2"><?=$ruta?></td>
			<td colspan="2"><textarea name="descripcionFuncional" style="text-transform:uppercase;"><?=$tipoEquipo->getDescripcionFuncional()?></textarea></td>
		</tr>
		<tr>
			<td colspan="4"><input type="file" name="fotografiaEquipo"></td>
		</tr>
		<tr>
			<th colspan="4" class="titulos">INFORMACION GENERAL</th>
		</tr>
		<tr>
			<th class="subTitulos">No. ACTIVO FIJO</th><td><input type="text" name="activoFijo" class="cajon" value="<?=$informacionGeneral->getActivoFijo()?>" required onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
			<th class="subTitulos">SERIE</th><td><input type="text" name="serial" class="cajon" value="<?=$informacionGeneral->getSerial()?>" required onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
		</tr>
		<tr>
			<th class="subTitulos">MARCA</th><td><input type="text" name="marca" class="cajon" value="<?=$informacionGeneral->getMarca()?>" required onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
			<th class="subTitulos">REFERENCIA</th><td><input type="text" name="referencia" class="cajon" value="<?=$informacionGeneral->getReferencia()?>" required onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
		</tr>
		<tr>
			<th class="subTitulos">MODELO</th><td><input type="text" name="modelo" class="cajon" value="<?=$informacionGeneral->getModelo()?>" required onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
			<th class="subTitulos">REGISTRO INVIMA</th><td><input type="text" name="registroInvima" class="cajon" value="<?=$informacionGeneral->getRegistroInvima()?>" required onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
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
				<?=$ciudad?>
			</td>
		</tr>
		<tr>
			<th class="subTitulos">SEDE</th><td><?=$sedeNombre.' - '?><input type='text' value="<?=$informacionGeneral->getUbicacion()?>" name="ubicacion" class="cajon" placeholder="Ubicacion" style="width:45%" required onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
		</tr>
	</table>

	<table border="1" class="adquisicion">
		<tr>
			<th colspan="4" class="titulos">ADQUISICION E INSTALACION</th>
		</tr>
		<tr>
			<th class="subTitulos">FABRICANTE</th>
			<td>
				<select id="mySelect" class="cajon" name="ideFabricante" onchange="cargarDatosF(this.value)" required></select>
			</td>
			<th class="subTitulos">FORMA DE ADQUISICION</th><td><input type="text" name="formaAdquisicion" required class="cajon" value="<?=$adquisicion->getFormaAquisicion()?>" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
		</tr>
		<tr>
			<th class="subTitulos">TELEFONO</th><td><label id="telefonoF"></label></td>
			<th class="subTitulos">COSTO DE ADQUISICION</th><td><input type="text" name="costoAdquisicion" class="cajon" value="<?=$adquisicion->getCostoAquisicion()?>" onkeyup="javascript:this.value=this.value.toUpperCase();" required></td>
		</tr>
		<tr>
			<th class="subTitulos">DIRECCION</th><td><label id="direccionF"></label></td>
			<th class="subTitulos">FECHA DE COMPRA</th><td><input type="date" name="fechaCompra" class="cajon" value="<?=$adquisicion->getFechaCompra()?>"></td>
		</tr>
		<tr>
			<th class="subTitulos">LUGAR DE ORIGEN</th><td><label id="lugarOrigen"></label></td>
			<th class="subTitulos">FECHA DE INSTALACION</th><td><input type="date" name="fechaInstalacion" class="cajon" value="<?=$adquisicion->getFechaInstalacion()?>"></td>
		</tr>
		<tr>
			<th class="subTitulos">PROVEEDOR</th>
			<td>
				<select id="mySelect" class="cajon" name="idePreveedor" onchange="cargarDatosP(this.value)" required></select>
			</td>
			<th class="subTitulos">INICIO DE GARANTIA</th><td><input type="date" name="inicioGarantia" class="cajon"  value="<?=$adquisicion->getInicioGarantia()?>"></td>
		</tr>
		<tr>
			<th class="subTitulos">TELEFONO</th><td><label id="telefonoP"></label></td>
			<th class="subTitulos">FINALIZACION GARANTIA</th><td><input type="date" name="finalizacionGarantia" class="cajon"  value="<?=$adquisicion->getFinalizacionGarantia()?>"></td>
		</tr>
		<tr>
			<th class="subTitulos">DIRECCION</th><td><label id="direccionP"></label></td>
			<th class="subTitulos">FECHA PUESTA SERVICIO</th><td><input type="date" name="fechaPuestaServicio"  class="cajon" value="<?=$adquisicion->getFechaPuestaServicio()?>"></td>
		</tr>
		<tr>
			<th class="subTitulos">E-MAIL</th><td><label id="email"></label></td>
			<th class="subTitulos" class="subTitulos" colspan="2"></th>
		</tr>
	</table>
	<table class="caracteristicasFisicasTecnicas">
		<tr>
			<th colspan="4" class="titulos">CARACTERISTICAS FISICAS Y TECNICAS DEL EQUIPO</th>			
		</tr>
		<tr>
			<th class="subTitulos">VOLTAJE OPERACION [V]</th><td><input type="text" name="voltajeOperacion"  class="cajon" required value="<?=$caracteristicas->getVoltajeOperacion()?>" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
			<th class="subTitulos">PESO [Kg]</th><td ><input type="text" name="peso" class="cajon" required value="<?=$caracteristicas->getPeso()?>" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
		</tr>
		<tr>
			<th class="subTitulos">VOLTAJE MAXIMA OPERACION [V]</th><td ><input type="text" name="voltajeMaxOperacion"  class="cajon" required value="<?=$caracteristicas->getVoltajeMaxOperacion()?>" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
			<th class="subTitulos">CAPACIDAD</th><td ><input type="text" name="capacidad" class="cajon" required  value="<?=$caracteristicas->getCapacidad()?>" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
		</tr>
		<tr>
			<th class="subTitulos">CORRIENTE MAXIMA OPERACION [A]</th><td ><input type="text" name="corrienteMaxOperacion"  class="cajon" required value="<?=$caracteristicas->getCorrienteMaxOperacion()?>" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
			<th class="subTitulos">DIMENSIONES</th><td ><input type="text" name="dimensiones" class="cajon" required  value="<?=$caracteristicas->getCorrienteMaxOperacion()?>" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
		</tr>
		<tr>
			<th class="subTitulos">CORRIENTE MINIMA OPERACION [A]</th><td ><input type="text" name="corrienteMinOperacion"  class="cajon" required value="<?=$caracteristicas->getCorrienteMinOperacion()?>" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
			<th class="subTitulos">AÑOS DE VIDA</th><td><input type="text" name="aniosVida" class="cajon" required  value="<?=$caracteristicas->getAniosVida()?>" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
		</tr>
		<tr>
			<th class="subTitulos">POTENCIA CONSUMIDA [W]</th><td><input type="text" name="potenciaConsumida"  class="cajon" required value="<?=$caracteristicas->getPotenciaConsumida()?>" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
			<th class="subTitulos">REQUIERE AGUA</th><td ><?=$caracteristicas->getRequiereAguaOptions()[0]?></td>
		</tr>
		<tr>
			<th class="subTitulos">FRECUENCIA [Hz]</th><td ><input type="text" name="frecuencia"  class="cajon" required value="<?=$caracteristicas->getFrecuencia()?>" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
			<th class="subTitulos">REQUIERE GAS PROPANO</th><td><?=$caracteristicas->getRequiereGasPropanoOptions()[0]?></td>
		</tr>
		<tr>
			<th class="subTitulos">PRESION [Bar]</th><td><input type="text" name="presion"  class="cajon" required value="<?=$caracteristicas->getPresion()?>" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
			<th class="subTitulos">REQUIERE COMBUSTIBLE</th><td><?=$caracteristicas->getRequiereCombustibleOptions()[0]?></td>
		</tr>
		<tr>
			<th class="subTitulos">VELOCIDAD [W]</th><td><input type="text" name="velocidad"  class="cajon" required value="<?=$caracteristicas->getVelocidad()?>" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
			<th class="subTitulos">REQUIERE GASES MEDICINALES</th><td ><?=$caracteristicas->getRequiereGasMedicinalOptions()[0]?></td>
		</tr>
	</table>
</section>
<section class="derecha">
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
			<th class="subTitulos">SERVICIO</th>
			<td>
				<select id="mySelect" class="cajon" name="codServicio" onchange="cargarUnidades(this.value)" required></select>
			</td>
			<th class="subTitulos">UNIDAD</th>
			<td>
				<select id="mySelect" class="cajon" name="codUnidad" onchange="cargarAmbientes(this.value)"></select>
			</td>
			<th class="subTitulos">AMBIENTE</th>
			<td>
				<select id="mySelect" class="cajon" name="codAmbiente"></select>
			</td>
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
	<table class="tecPredominante" border="1">
		<tr>
			<th colspan="2"  class="titulos">CLASE DE TECNOLOGIA PREDOMIENANTE</th>
			<th colspan="2"  class="titulos">CLASIFICACION BIOMEDICA</th>
		</tr>
		<tr>
			<td colspan="2"><select size="8" name="tecnologiaPredominante" class="seleccion" required style="text-transform:uppercase;"><?=$tipoEquipo->getTecnologiaPredomienanteOption()?></select></td><td colspan="2"><select size="8" name="clasificacionBiomedica" class="seleccion" required><?=$tipoEquipo->getClasificacionBiomedicaOptions()?></select></td>
		</tr>
		<tr>
			<th colspan="4" class="titulos">CLASIFICACION ELECTRICA</th>
		<tr>
		<tr>
			<th class="subTitulos">TIPO</th><td><input type="text" name="tipoClasificacion" class="cajon" value="<?=$clasificacion->getTipo()?>" style="text-transform:uppercase;"></td>
			<th class="subTitulos">CLASE</th><td><input type="text" name="claseClasificacion" class="cajon" value="<?=$clasificacion->getClase()?>" style="text-transform:uppercase;"></td>
		</tr>
	</table>
	<table class="mantenimientoCalibracion" border="1">
		<tr>
			<th colspan="8" class="titulos">MANTENIMIENTO</th>
		</tr>
		<tr>
			<th colspan="2" class="subTitulos">PREVENTIVO</th><td colspan="2"><?=$cronograma->getPerioricidadLista()?>, orientado al riesgo</td>
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
			<td>
				<?=InformacionExtra::RecomendacionEnRadio($tipoEquipo->getIde())?>				
			</td>
		</tr>
	</table>
	<table class="rutinaMantenimiento">
		<tr>
			<th class="titulos">RUTINA DE MANTENIMIENTO</th>
		</tr>
		<tr>
			<th class="subTitulos">ACTIVIDADES</th>
		</tr>
		<tr>
			<td>
				<input type="radio" name="ideRutinaExtra" value="0" id="0" required="true"><label for="0"><?=$tipoEquipo->getRutinaLista()?></label>
				<?=RutinaExtra::rutinaExtraEnRadio($informacionGeneral->getIdeRutinaExtra(), $tipoEquipo->getIde())?>
				<input type="hidden" name="ideSede" value="<?=$ideSede?>">
				<input type="hidden" name="nombreValidar" value="<?=$informacionGeneral->getNombreEquipo()?>">
				<input type="hidden" name="fotoAnterior" value="<?=$tipoEquipo->getFotografia()?>">
				<input type="hidden" name="ideTipoEquipo" value="$tipoEquipo->getIde()">
				<input type="hidden" name="ideEquipo" value="<?=$informacionGeneral->getIde()?>">
			</td>
			
		</tr>
	</table>
</section>
</div>
</form>

<script>
//inicio carga de servicios
$("#mySelect").change(function (event) {
        if ($(this)[0].selectedIndex == 0)
        {
            $(this).prop('required', true);
            $("#txtFin").val('');
        } else
        {
            $(this).prop('required', false);
            $("#txtFin").val($("#mySelect option:selected").val());
        }
    });


    <?=DatosFabricante::getFabricantesJS()?>
	cargarFabricantes()
	function cargarFabricantes(){
	    document.formulario.ideFabricante.length = 0;
        document.formulario.ideFabricante.length++;

        document.formulario.ideFabricante.options[document.formulario.ideFabricante.length - 1].value = '';
        document.formulario.ideFabricante.options[document.formulario.ideFabricante.length - 1].text = 'Seleccione Fabricante';
		
        for (var i = 0; i < fabricantes.length; i++) {
                document.formulario.ideFabricante.length++;
                document.formulario.ideFabricante.options[document.formulario.ideFabricante.length - 1].value = fabricantes[i][0];
                document.formulario.ideFabricante.options[document.formulario.ideFabricante.length - 1].text = fabricantes[i][1];
                if (fabricantes[i][0] === '<?= $ideFabricante?>') {
                    document.formulario.ideFabricante.options[document.formulario.ideFabricante.length - 1].selected = true;
                }
        }
		cargarDatosF(document.formulario.ideFabricante.value)
	}	
	function cargarDatosF(ideFabricante){
		for (var i = 0; i < fabricantes.length; i++) {
                if (fabricantes[i][0] === ideFabricante) {
                	document.getElementById('telefonoF').innerHTML=fabricantes[i][2];
					document.getElementById('direccionF').innerHTML=fabricantes[i][3];
					document.getElementById('lugarOrigen').innerHTML=fabricantes[i][4];
                }
        }

	}

    <?=DatosFabricante::getProveedoresJS()?>
	cargarProveedores()
	function cargarProveedores(){
		document.formulario.idePreveedor.length = 0;
        document.formulario.idePreveedor.length++;
		
        document.formulario.idePreveedor.options[document.formulario.idePreveedor.length - 1].value = '';
        document.formulario.idePreveedor.options[document.formulario.idePreveedor.length - 1].text = 'Seleccione Proveedor';

        for (var i = 0; i < proveedores.length; i++) {
			 document.formulario.idePreveedor.length++;
			document.formulario.idePreveedor.options[document.formulario.idePreveedor.length - 1].value = proveedores[i][0];
            document.formulario.idePreveedor.options[document.formulario.idePreveedor.length - 1].text = proveedores[i][1];
			    if (proveedores[i][0] === '<?= $ideProveedor?>') {
                    document.formulario.idePreveedor.options[document.formulario.idePreveedor.length - 1].selected = true;
                }

        }
		cargarDatosP(document.formulario.idePreveedor.value)
	}	
	function cargarDatosP(ideProveedor){
		for (var i = 0; i < proveedores.length; i++) {
                if (proveedores[i][0] === ideProveedor) {
                	document.getElementById('telefonoP').innerHTML=proveedores[i][2];
					document.getElementById('direccionP').innerHTML=proveedores[i][3];
					document.getElementById('email').innerHTML=proveedores[i][4];
                }
        }

	}


    <?= Servicio::getServiciosEnArreglosJS()?>
	cargarServicios()
	function cargarServicios() {
        document.formulario.codServicio.length = 0;
        document.formulario.codServicio.length++;
        
        document.formulario.codServicio.options[document.formulario.codServicio.length - 1].value = '';
        document.formulario.codServicio.options[document.formulario.codServicio.length - 1].text = 'Seleccione Servicio';
        
        for (var i = 0; i < servicios.length; i++) {
                document.formulario.codServicio.length++;
                document.formulario.codServicio.options[document.formulario.codServicio.length - 1].value = servicios[i][0];
                document.formulario.codServicio.options[document.formulario.codServicio.length - 1].text = servicios[i][0];
                if (servicios[i][0] === '<?= $codServicio?>') {
                    document.formulario.codServicio.options[document.formulario.codServicio.length - 1].selected = true;
                }
        }
        cargarUnidades(document.formulario.codServicio.value);
    }  
	function cargarUnidades(codServicio) {
		<?= Unidad::getUnidadesEnArreglosJS() ?>
        document.formulario.codUnidad.length = 0;
        document.formulario.codUnidad.length++;//aumentamos una fila para adicionar un registro

        if (document.formulario.codUnidad.selectedIndex === 0) {
            document.formulario.codUnidad.options[document.formulario.codUnidad.length - 1].value = '';
            document.formulario.codUnidad.options[document.formulario.codUnidad.length - 1].text = 'Seleccione Unidad';
        } else {
            document.formulario.codUnidad.options[document.formulario.codUnidad.length - 1].value = '';
            document.formulario.codUnidad.options[document.formulario.codUnidad.length - 1].text = 'Selecione Unidad';
        }

        for (var i = 0; i < unidades.length; i++) {
            if (codServicio === unidades[i][2]) {
                document.formulario.codUnidad.length++;//aumentamos una fila para adicionar una registro
                document.formulario.codUnidad.options[document.formulario.codUnidad.length - 1].value = unidades[i][0];
                document.formulario.codUnidad.options[document.formulario.codUnidad.length - 1].text = unidades[i][0];
                if (unidades[i][0] === '<?= $codUnidad?>') {
                    document.formulario.codUnidad.options[document.formulario.codUnidad.length - 1].selected = true;
                }
            }
        }
		cargarAmbientes(document.formulario.codUnidad.value);
	}

	function cargarAmbientes(codUnidad) {
		<?=Ambiente::getAmbienteEnArreglosJS()?>
		document.formulario.codAmbiente.length = 0;
        document.formulario.codAmbiente.length++;//aumentamos una fila para adicionar un registro

        if (document.formulario.codAmbiente.selectedIndex === 0) {
            document.formulario.codAmbiente.options[document.formulario.codAmbiente.length - 1].value = '';
            document.formulario.codAmbiente.options[document.formulario.codAmbiente.length - 1].text = 'Seleccione Ambiente';
        } else {
            document.formulario.codAmbiente.options[document.formulario.codAmbiente.length - 1].value = '';
            document.formulario.codAmbiente.options[document.formulario.codAmbiente.length - 1].text = 'Selecione Ambiente';
        }

        for (var i = 0; i < ambientes.length; i++) {
            if (codUnidad=== ambientes[i][2]) {
                document.formulario.codAmbiente.length++;//aumentamos una fila para adicionar una registro
                document.formulario.codAmbiente.options[document.formulario.codAmbiente.length - 1].value = ambientes[i][3];
                document.formulario.codAmbiente.options[document.formulario.codAmbiente.length - 1].text = ambientes[i][0];
                if (ambientes[i][3] === '<?= $codAmbiente ?>') {
                    document.formulario.codAmbiente.options[document.formulario.codAmbiente.length - 1].selected = true;
                }
            }
        }

		
	}

</script>
