<?php

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/TipoEquipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/RegistroApoyoTecnico.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/AdquisicionInstalacion.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/CaracteristicasFisicasTecnicas.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/ConectorBD.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$datosLista=TipoEquipo::getNombreArreglo(null,null);

date_default_timezone_set('America/Bogota');

$informacionGeneral=new Equipo('ide',$ideEquipo);
$adquisicion=new AdquisicionInstalacion('ideEquipo',$informacionGeneral->getIde());
$caracteristicas=new CaracteristicasFisicasTecnicas('ideEquipo',$informacionGeneral->getIde());
$tipoEquipo=new TipoEquipo('nombre',"'{$informacionGeneral->getNombreEquipo()}'");
$registro=new RegistroApoyoTecnico('ideEquipo',$informacionGeneral->getIde());
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/equiposCliente.php&nit=<?=$informacionGeneral->getNitCliente()?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="30px" style="float: left"></a>
<div class="hojaVida">
	<h2>HOJA DE VIDA DE EQUIPO BIOMEDICO</h2>
	<table>
		<tr>
			<th colspan="8" style="background:#5b959c;color:#fff;font-size:14px">INFORMACION GENERAL</th>
			<td rowspan="55">j</td>	
			<td rowspan="7" colspan="8"><img src="../presentacion/BASCULA_TALLIMETRO.jpg" height=140px"></td>		
		</tr>
		<tr>
			<th colspan="2">NOMBRE DEL EQUIPO</th><td colspan="6"><input type="text" name="nombreEquipo" class="awesomplete cajon" value="<?=$informacionGeneral->getNombreEquipo()?>" autocomplete="off" data-list="<?=$datosLista?>" data-minChars="1"></td>
		</tr>
		<tr>
			<th colspan="2">No. ACTIVO FIJO</th><td colspan="6"><input type="text" name="activoFijo" class="cajon" value="<?=$informacionGeneral->getActivoFijo()?>"></td>
		</tr>
		<tr>
			<th colspan="2">MARCA</th><td colspan="6"><input type="text" name="marca" class="cajon" value="<?=$informacionGeneral->getMarca()?>"></td>
		</tr>
		<tr>
			<th colspan="2">MODELO</th><td colspan="6"><input type="text" name="modelo" class="cajon" value="<?=$informacionGeneral->getModelo()?>"></td>
		</tr>
		<tr>
			<th colspan="2">SERIE</th><td colspan="6"><input type="text" name="serial" class="cajon" value="<?=$informacionGeneral->getSerial()?>"></td>
		</tr>
		<tr>
			<th colspan="2">REFERENCIA</th><td colspan="6"><input type="text" name="referencia" class="cajon" value="<?=$informacionGeneral->getReferencia()?>"></td>
		</tr>
		<tr>
			<th colspan="2">REGISTRO INVIMA</th><td colspan="6"><input type="text" name="registroInvima" class="cajon" value="<?=$informacionGeneral->getRegistroInvima()?>"></td>
			<td colspan="8"><input type="file"></td>		
</tr>
<tr>
<td colspan="16">l</td>
</tr>
		<tr>
			<th colspan="8" style="background:#5b959c;color:#fff;font-size:14px">LOCALIZACION</th><th colspan ="8" style="background:#5b959c;color:#fff;font-size:14px">DESCRIPCION FUNCIONAL</th>			
		</tr>
		<tr>
			<th colspan="2">DEPARTAMENTO</th><td colspan="6"><?=strtoupper($informacionGeneral->getCliente()->getCiudad()->getDepartamento()->getNombre())?></td>
			<td rowspan="3" colspan ="8"><textarea></textarea></td>
		</tr>
		<tr>
			<th colspan="2">MUNICIPIO</th><td colspan="6"><?=strtoupper($informacionGeneral->getCliente()->getCiudad()->getNombre())?></td>
		</tr>
		<tr>
			<th colspan="2">SEDE</th><td colspan="6"><?=$informacionGeneral->getCliente()->getNombre().' - '.$informacionGeneral->getUbicacion()?></td>
		</tr>
<tr>
<td colspan="16">l</td>
</tr>

		<tr>
			<th colspan="8" style="background:#5b959c;color:#fff;font-size:14px">ADQUISICION E INSTALACION</th><th colspan ="8" style="background:#5b959c;color:#fff;font-size:14px">COMPONENTES DEL EQUIPO</th>	
		</tr>
		<tr>
			<th colspan="2">FABRICANTE</th><td colspan="2"><input type="text" name="fabricante" class="cajon" value="<?=$adquisicion->getFabricante()?>"></td>
			<th colspan="2">FORMA DE ADQUISICION</th><td colspan="2"><input type="text" name="formaAdquisicion"  class="cajon" value="<?=$adquisicion->getFormaAquisicion()?>"></td>
			<th colspan="3">PARTES O ELEMENTOS</th><th colspan="2">REFERENCIA</th><th colspan="3">ACCESORIOS</th>
		</tr>
		<tr>
			<th colspan="2">TELEFONO</th><td colspan="2"><input type="tel" name="telefonoF" class="cajon" value="<?=$adquisicion->getTelefonoF()?>"></td>
			<th colspan="2">COSTO DE ADQUISICION</th><td colspan="2"><input type="number" name="costoAdquisicion" class="cajon" value="<?=$adquisicion->getCostoAquisicion()?>"></td>
			<td colspan="3"><input type=text name="partes1" class="cajon" value=""></td><td colspan="2"><input type=text name="referencia1" class="cajon" value=""></td><td colspan="3"><input type=text name="accesorios1" class="cajon" value=""></td>
		</tr>
		<tr>
			<th  colspan="2">DIRECCION</th><td colspan="2"><input type="text" name="direccionF" class="cajon" value="<?=$adquisicion->getDireccionF()?>"></td>
			<th  colspan="2">FECHA DE COMPRA</th><td colspan="2"><input type="date" name="fechaCompra"  class="cajon" value="<?=$adquisicion->getFechaCompra()?>"></td>
<td colspan="3"><input type=text name="partes2" class="cajon" value=""></td><td colspan="2"><input type=text name="referencia2" class="cajon" value=""></td><td colspan="3"><input type=text name="accesorios2" class="cajon" value=""></td>
		</tr>
		<tr>
			<th colspan="2">LUGAR DE ORIGEN</th><td colspan="2"><input type="text" name="lugarOrigen" class="cajon" value="<?=$adquisicion->getLugarOrigen()?>"></td>
			<th colspan="2">FECHA DE INSTALACION</th><td colspan="2"><input type="date" name="fechaInstalacion" class="cajon" value="<?=$adquisicion->getFechaInstalacion()?>"></td>
<td colspan="3"><input type=text name="partes3" class="cajon" value=""></td><td colspan="2"><input type=text name="referencia3" class="cajon" value=""></td><td colspan="3"><input type=text name="accesorios3" class="cajon" value=""></td>
		</tr>
		<tr>
			<th  colspan="2">PROVEEDOR</th><td colspan="2"><input type="text" name="proveedor" class="cajon" value="<?=$adquisicion->getProveedor()?>"></td>
			<th  colspan="2">INICIO DE GARANTIA</th><td colspan="2"><input type="date" name="inicioGarantia" class="cajon"  value="<?=$adquisicion->getInicioGarantia()?>"></td>
<td colspan="3"><input type=text name="partes4" class="cajon" value=""></td><td colspan="2"><input type=text name="referencia4" class="cajon" value=""></td><td colspan="3"><input type=text name="accesorios4" class="cajon" value=""></td>
		</tr>
		<tr>
			<th colspan="2">TELEFONO</th><td colspan="2"><input type="tel" name="telefonoP"  class="cajon" value="<?=$adquisicion->getTelefonoP()?>"></td>
			<th colspan="2">FINALIZACION GARANTIA</th><td colspan="2"><input type="date" name="finalizacionGarantia" class="cajon"  value="<?=$adquisicion->getFinalizacionGarantia()?>"></td>
			<th colspan="4" style="background:#5b959c;color:#fff;font-size:14px">CLASE DE TECNOLOGIA PREDOMINANTE</th><th colspan="4" style="background:#5b959c;color:#fff;font-size:14px">CLASIFICACION BIOMEDICA</th>
		</tr>
		<tr>
			<th colspan="2">DIRECCION</th><td colspan="2"><input type="text" name="direccionP"  class="cajon" value="<?=$adquisicion->getDireccionP()?>"></td>
			<th colspan="2">FECHA PUESTA SERVICIO</th><td colspan="2"><input type="date" name="fechaPruestaServicio"  class="cajon" value="<?=$adquisicion->getFechaPuestaServicio()?>"></td>
			<td rowspan="6" colspan="4"><select size="8" name="tecnologiaPredominante" class="seleccion"><?=$tipoEquipo->getTecnologiaPredomienanteOption()?></select></td><td rowspan="6" colspan="4"><select size="8" name="clasificacionBiomedica" class="seleccion"><?=$tipoEquipo->getClasificacionBiomedicaOptions()?></select></td>
		</tr>
		<tr>
			<th colspan="2">E-MAIL</th><td colspan="2"><input type="email" name="email"  class="cajon"  value="<?=$adquisicion->getEmail()?>"></td>
<th colspan="4"></th>
		</tr>
<tr>
<td colspan="8">l</td>
</tr>

		<tr>
			<th colspan="8" style="background:#5b959c;color:#fff;font-size:14px">CARACTERISTICAS FISICAS Y TECNICAS DEL EQUIPO</th>			
		</tr>
		<tr>
			<th colspan="2">VOLTAJE OPERACION [V]</th><td colspan="2"><input type="text" name="voltajeOperacion"  class="cajon" value="<?=$caracteristicas->getVoltajeOperacion()?>"></td>
			<th colspan="2">PESO [Kg]</th><td colspan="2"><input type="text" name="peso" class="cajon"  value="<?=$caracteristicas->getPeso()?>"></td>
		</tr>
		<tr>
			<th colspan="2">VOLTAJE MAXIMA OPERACION [V]</th><td colspan="2"><input type="text" name="voltajeMaxOperacion"  class="cajon" value="<?=$caracteristicas->getVoltajeMaxOperacion()?>"></td>
			<th colspan="2">CAPACIDAD</th><td colspan="2"><input type="text" name="capacidad" class="cajon"  value="<?=$caracteristicas->getCapacidad()?>"></td>
		</tr>
		<tr>
			<th colspan="2">CORRIENTE MAXIMA OPERACION [A]</th><td colspan="2"><input type="text" name="corrienteMaxOperacion"  class="cajon" value="<?=$caracteristicas->getCorrienteMaxOperacion()?>"></td>
			<th colspan="2">DIMENSIONES</th><td colspan="2"><input type="text" name="dimensiones" class="cajon"  value="<?=$caracteristicas->getCorrienteMaxOperacion()?>"></td>
		</tr>
		<tr>
			<th colspan="2">CORRIENTE MINIMA OPERACION [A]</th><td colspan="2"><input type="text" name="corrienteMinOperacion"  class="cajon" value="<?=$caracteristicas->getCorrienteMinOperacion()?>"></td>
			<th colspan="2">AÑOS DE VIDA</th><td colspan="2"><input type="text" name="aniosVida" class="cajon"  value="<?=$caracteristicas->getAniosVida()?>"></td>
			<th colspan="8" style="background:#5b959c;color:#fff;font-size:14px">CLASIFICACION ELECTRICA</th>

		</tr>
		<tr>
			<th colspan="2">POTENCIA CONSUMIDA [W]</th><td colspan="2"><input type="text" name="potenciaConsumida"  class="cajon" value="<?=$caracteristicas->getPotenciaConsumida()?>"></td>
			<th colspan="2">REQUIERE AGUA</th><td colspan="2"><?=$caracteristicas->getRequiereAguaOptions()[0]?></td>
			<td colspan="2">TIPO</td><td colspan="2"><input type="text" name="tipoClasificacionE" class="cajon"></td>
			<td colspan="2">CLASE</td><td colspan="2"><input type="text" name="claseClasificacionE" class="cajon"></td>

		</tr>
		<tr>
			<th colspan="2">FRECUENCIA [Hz]</th><td colspan="2"><input type="text" name="frecuencia"  class="cajon" value="<?=$caracteristicas->getFrecuencia()?>"></td>
			<th colspan="2">REQUIERE GAS PROPANO</th><td colspan="2"><?=$caracteristicas->getRequiereGasPropanoOptions()[0]?></td>
			<th colspan="8" style="background:#5b959c;color:#fff;font-size:14px">MANTENIMIENTO</th>
		</tr>
		<tr>
			<th colspan="2">PRESION [Bar]</th><td colspan="2"><input type="text" name="presion"  class="cajon" value="<?=$caracteristicas->getPresion()?>"></td>
			<th colspan="2">REQUIERE COMBUSTIBLE</th><td colspan="2"><?=$caracteristicas->getRequiereCombustibleOptions()[0]?></td>
			<td colspan="2">PREVENTIVO</td><td colspan="2">Cuatrimestral, orientado al riesgo</td>
			<td colspan="2">CORRECTIVO</td><td colspan="2">Por Llamado</td>
		</tr>
		<tr>
			<th colspan="2">VELOCIDAD [W]</th><td colspan="2"><input type="text" name="velocidad"  class="cajon" value="<?=$caracteristicas->getVelocidad()?>"></td>
			<th colspan="2">REQUIERE GASES MEDICINALES</th><td colspan="2"><?=$caracteristicas->getRequiereGasMedicinalOptions()[0]?></td>
			<th colspan="8" style="background:#5b959c;color:#fff;font-size:14px">CALIBRACION</th>
		</tr>
<tr>
<td colspan="8">l</td>
</tr>

		<tr>
			<th colspan="8" style="background:#5b959c;color:#fff;font-size:14px">RIESGO DE APOYO TECNICO</th>
			<th colspan="2">REQUIERE CALIBRACION</th><td colspan="6"><input type="text" class="cajon"></td>			
		</tr>
		<tr>
			<th colspan="2">MANUALES</th><th colspan="2">PLANOS</th><th colspan="2">USOS</th><th colspan="2">RIESGO</th>
			<th colspan="8" style="background:#5b959c;color:#fff;font-size:14px">VARIABLES SUSCEPTIBLES A CALIBRACION</th>
		</tr>
		<tr>
			<td colspan="2"><ol class="btnManual"><?=$registro->getManualesOption()?></ol></td>
			<td colspan="2"><?=$registro->getPlanosOption()?></td>
			<td colspan="2"><?=$registro->getUsosOption()?></td>
			<td colspan="2"><?=$tipoEquipo->getClasificacionRiesgoRadio()?></td>
			<th><label for="presion">PRESION</label></th><td><input type="checkbox" name="presion" id="presion"></td>
			<th><label for="respiracion">RESPIRACION</label></th><td><input type="checkbox" name="respiracion" id="respiracion"></td>
			<th><label for="tiempo">TIEMPO</label></th><td><input type="checkbox" name="tiempo" id="tiempo"></td>		
			<th><label for="flujo">FLUJO</label></th><td><input type="checkbox" name="flujo" id="flujo"></td>
		</tr>
<tr>
<td colspan="8">l</td>
</tr>

		<tr>
			<td></td><th colspan="6" style="background:#5b959c;color:#fff;font-size:14px">CODIGO DE USO DEL EQUIPO</th><td></td>
			<th><label for="temperatura">TEMPERATURA</label></th><td><input type="checkbox" name="temperatura" id="temperatura"></td>
			<th><label for="gcardiaco">G. CARDIACO</label></th><td><input type="checkbox" name="gcardiaco" id="gcardiaco"></td>
			<th><label for="co2">Co2</label></th><td><input type="checkbox" name="co2" id="co2"></td>
			<th><label for="fc">FC</label></th><td><input type="checkbox" name="fc" id="fc"></td>		
		</tr>
		<tr>
			<td></td><th>SERVICIO</th><td><input type="text" name="servicioUso"></td>
			<th>UNIDAD</th><td><input type="text"></td>
			<th>AMBIENTE</th><td><input type="text"></td><td></td>
			<th><label for="volumen">VOLUMEN</label></th><td><input type="checkbox" name="volumen" id="volumen"></td>
			<th><label for="ibp">IBP</label></th><td><input type="checkbox" name="ibp" id="ibp"></td>
			<th><label for="co">Co</label></th><td><input type="checkbox" name="co" id="co"></td>
			<th><label for="ecg">ECG</label></th><td><input type="checkbox" name="ecg" id="ecg"></td>
		</tr>
		<tr>
			<td colspan="8"></td>
			<th><label for="impendancia">IMPENDANCIA</label></th><td><input type="checkbox" name="impendancia" id="impendancia"></td>
			<th><label for="energia">ENERGIA</label></th><td><input type="checkbox" name="energia" id="energia"></td>
			<th><label for="rpm">RPM</label></th><td><input type="checkbox" name="rpm" id="rpm"></td>
			<th><label for="spo2">SpO2</label></th><td><input type="checkbox" name="spo2" id="spo2"></td>
		</tr>
		<tr>
			<td colspan="8"></td>
			<th><label for="marcapasos">MARCAPASOS</label></th><td><input type="checkbox" name="marcapasos" id="marcapasos"></td>
			<th><label for="nibp">NIBP</label></th><td><input type="checkbox" name="nibp" id="nibp"></td>
			<th><label for="hr">HR</label></th><td><input type="checkbox" name="hr" id="hr"></td>
			<th><label for="peso">PESO</label></th><td><input type="checkbox" name="peso" id="peso"></td>
		</tr>
			<td colspan="8"></td>
			<th colspan="3">PERIORICIDAD DE CALIBRACION</th><td colspan="5">SEGÚN PLAN DE ASEGURAMIENTO METROLÓGICO</td>
		</tr>

	</table>
</div>