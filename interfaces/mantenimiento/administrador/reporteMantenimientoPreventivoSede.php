<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/Persona.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Repuesto.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/MantenimientoPreventivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ReportePreventivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/RutinaExtra.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/UnidadMedida.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/DatosNumeroReporte.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/VerificacionMetrologica.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;
$mantenimientoPreventivo=new MantenimientoPreventivo('ide', $ideMantenimiento);
$direccion='';
$seleccionado='';
//Inicio Datos Ingeniero
$datosIngeniero=new Persona('usuario', "'".$_SESSION['usuario']."'");
if ($mantenimientoPreventivo->getIdeSede()!=null){
    $empresa=$mantenimientoPreventivo->getSede()->getCliente()->getNombre();
    $sede=$mantenimientoPreventivo->getSede()->getNombre(); 
    $direccion="mantenimiento/administrador/equiposMantenimientoSede.php&ide={$mantenimientoPreventivo->getIde()}";
}else{
    $empresa=$mantenimientoPreventivo->getCliente()->getNombre();
    $sede=$mantenimientoPreventivo->getCliente()->getNombre();
    $direccion="mantenimiento/administrador/equiposMantenimientoCliente.php&ide={$mantenimientoPreventivo->getIde()}";
}
if ($accion==='Modificar') {    
    $reporteMantenimiento=new ReportePreventivo('numeroReporte',"'".$numeroReporte."'");
    if ($reporteMantenimiento->getIdeRutinaExtra()==null)$seleccionado='checked';
    else $seleccionado='';
//    $ingeniero=$reporteMantenimiento->getPersona()->getNombresCompletos();
    $ingeniero=$datosIngeniero->getNombresCompletos();;
    $equipo=new Equipo('ide', $reporteMantenimiento->getIdeEquipo());
    $numeroReporte = $reporteMantenimiento->getNumeroReporte();
    $tipoMantenimiento=$reporteMantenimiento->getTipoMantenimiento();
    //Inicio datos metrologicos
    $datosMetrologica = VerificacionMetrologica::getDatosEnObjetos("numeroPreventivo='".$numeroReporte."'",null);
    $listaMetrologica = '';
    $item=1;
    for ($j = 0; $j < count($datosMetrologica); $j++) {
        $objMetrologia=$datosMetrologica[$j];
        $listaMetrologica.= '<tr>';
        $listaMetrologica.= '<td><select name=udMedida'.$item.'>'.UnidadMedida::getUnidadesOptions($objMetrologia->getIdeUnidadMedida()).'</select></td>';
        $listaMetrologica.= '<td><input type="number" step="any" value="'.$objMetrologia->getValorNominal().'" name="valorNominal'.$item.'" ><input type="hidden" step="any" value="'.$objMetrologia->getIde().'" name="ideValor'.$item.'"></td>';
        $listaMetrologica.= '<td><input type="number" step="any" value="'.$objMetrologia->getValorMedido().'" name="valorMedido'.$item.'" ></td>';
        $listaMetrologica.= '</tr>';
        $item++;
    }
    //Fin datos metrologicos
}else{
    $reporteMantenimiento=new ReportePreventivo(null, null);
    $equipo=new Equipo('ide', $ideEquipo);
    $ingeniero=$datosIngeniero->getNombresCompletos();
    $numeroReporte = ReportePreventivo::generarNumeroReporte();  
    $tipoMantenimiento='P';
//Inicio datos Metrologicos
    $listaMetrologica='<tr>';
    $listaMetrologica.= '<td><select name="udMedida1">'.UnidadMedida::getUnidadesOptions(null).'</select></td>';
    $listaMetrologica.= '<td><input type="number" step="any" name="valorNominal1" ></td>';
    $listaMetrologica.= '<td><input type="number" step="any"  name="valorMedido1" ></td>';
    $listaMetrologica.= '</tr>';
    $listaMetrologica.= '<tr>';
    $listaMetrologica.= '<td><select name="udMedida2">'.UnidadMedida::getUnidadesOptions(null).'</select></td>';
    $listaMetrologica.= '<td><input type="number" step="any" name="valorNominal2" ></td>';
    $listaMetrologica.= '<td><input type="number" step="any"  name="valorMedido2" ></td>';
    $listaMetrologica.= '</tr>';
//Fin datos Metrologicos   
}
//Inicio datos repuestos
    $datosRepuestos=Repuesto::getDatosEnObjetos("numeroPreventivo='{$numeroReporte}'", null);
    $listaRepuestos='';
    $item=1;
    for ($h = 0; $h < count($datosRepuestos); $h++) {
        $objRepuesto=$datosRepuestos[$h];
        $listaRepuestos.='<tr>';
        $listaRepuestos.='<td><input type="text" name="detalle'.$item.'" value="'.$objRepuesto->getDetalle().'"><input type="hidden" name="ideRepuesto'.$item.'" value="'.$objRepuesto->getIde().'"></td>';
        $listaRepuestos.='<td><input type="text" name="referencia'.$item.'" value="'.$objRepuesto->getReferencia().'"></td>';
        $listaRepuestos.='<td><input type="number" class="cantidad" name="cantidad'.$item.'" value="'.$objRepuesto->getCantidad().'"></td>';
        $listaRepuestos.='</tr>';
        $item++;
    }
    //Fin datos repuestos
    if ($listaMetrologica=='') {
        $listaMetrologica='<tr>';
        $listaMetrologica.= '<td><select name="udMedida1">'.UnidadMedida::getUnidadesOptions(null).'</select></td>';
        $listaMetrologica.= '<td><input type="number" step="any" name="valorNominal1" ><input type="hidden" step="any" name="ideValor1"></td>';
        $listaMetrologica.= '<td><input type="number" step="any"  name="valorMedido1" ></td>';
        $listaMetrologica.= '</tr>';
        $listaMetrologica.= '<tr>';
        $listaMetrologica.= '<td><select name="udMedida2">'.UnidadMedida::getUnidadesOptions(null).'</select></td>';
        $listaMetrologica.= '<td><input type="number" step="any" name="valorNominal2" ><input type="hidden" step="any" name="ideValor2"></td>';
        $listaMetrologica.= '<td><input type="number" step="any"  name="valorMedido2" ></td>';
        $listaMetrologica.= '</tr>';
}
?>
<a href="principal.php?CONTENIDO=<?=$direccion?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px" style="float: left"></a>
<div class="reporteMantenimiento">
    <form method="POST" action="mantenimiento/administrador/reportePreventivoActualizar.php" onsubmit="return contadorFilas()" onchange="javascript:habilitarProblemaPresentado()">
        <div class="encabezado">
            <div class="izquierda">
                <label>REPORTE DE SERVICIO</label>
                <article class="numeroReporte"><?=$numeroReporte?></article>
                <table>
                    <tr>
                        <th colspan="2">FECHA</th>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="ciudad" name="ciudad" placeholder="CIUDAD" value="<?=$reporteMantenimiento->getCiudad()?>" required>
                        </td>
                        <td>
                            <input type="date" class="fecha" name="fecha" value="<?=$mantenimientoPreventivo->getMostarFecha()?>">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="imagenes">
                <img src="../presentacion/imagenes/logoPixelado.png" height="60px" style="margin-bottom:35px;margin-left: 10px">
                <img src="../presentacion/imagenes/CerificacionIcontec.png" height="140px" style="margin-left: 20px">
            </div>
        </div>
        <div class="titulo">REPORTE DE MANTENIMIENTO</div>
        <table class="datosCliente">
            <tr>
                <th class="bordeSuperiorIzquierdo">&nbsp;&nbsp;NOMBRE INGENIERO O TÉCNICO:</th>
                <td class="bordeSuperiorDerecho">&nbsp;&nbsp;<?=$ingeniero?></td>
            </tr>
            <tr>
                <th>&nbsp;&nbsp;EMPRESA:</th>
                <td>&nbsp;&nbsp;<?=$empresa?></td>
            </tr>
            <tr>
                <th class="bordeInferiorIzquierdo">&nbsp;&nbsp;SEDE:</th>
                <td class="bordeInferiorDerecho">&nbsp;&nbsp;<?=$sede?></td>
            </tr>
        </table>
        <div class="subTitulo">INFORMACIÓN DEL EQUIPO</div>
        <table class="datosEquipo">
            <tr>
                <th class="bordeSuperiorIzquierdo">&nbsp;&nbsp;NOMBRE DEL EQUIPO:</th>
                <td colspan="3" class="bordeSuperiorDerecho">&nbsp;&nbsp;<?=$equipo->getNombreEquipo()?></td>
            </tr>
            <tr>
                <th>&nbsp;&nbsp;MARCA:</th>
                <td colspan="3">&nbsp;&nbsp;<?=$equipo->getMarca()?></td>
            </tr>
            <tr>
                <th>&nbsp;&nbsp;MODELO:</th>
                <td>&nbsp;&nbsp;<?=$equipo->getModelo()?></td>
                <th>&nbsp;&nbsp;SERIE:</th>
                <td>&nbsp;&nbsp;<?=$equipo->getSerial()?></td>
            </tr>
            <tr>
                <th class="bordeInferiorIzquierdo">&nbsp;&nbsp;UBICACIÓN:</th>
                <td>&nbsp;&nbsp;<?=$equipo->getUbicacion()?></td>
                <th>&nbsp;&nbsp;CÓDIGO:</th>
                <td class="bordeInferiorDerecho">&nbsp;&nbsp;<?=$equipo->getActivoFijo()?></td>
            </tr>
        </table>
        <table class="tipoEquipo">
            <tr>
                <th>&nbsp;&nbsp;TIPO EQUIPO:</th>
                <td>&nbsp;&nbsp;<?=$equipo->getTipoEquipo()->getTipoLista()?></td>
            </tr>
        </table>
        <table class="tipoMantenimiento">
            <tr>
                <th>&nbsp;&nbsp;TIPO DE SERVICIO:</th>
                <td>
                    <ul class="botones">
                        <?= $reporteMantenimiento->getTipoMantenimientoRadio($tipoMantenimiento)?>
                        <li>
                            <input type="text" id="otroMantenimiento" placeholder="....." style="margin-top: 5px;" value="">
                        </li>
                    </ul>                    
                </td>
            </tr>
        </table>
        <div class="subTitulo">TIPO DE FALLA</div>
        <table class="datosFalla">
            <tr>
                <td>
                    <div class="inputFila">
                        <ul class="botones">
                            <?=$reporteMantenimiento->getTipoFallaChk()?>
                            <li>
                                <input type="text" id="otraFalla" name="otraFalla" placeholder="....." style="margin-top: 10px;" value="<?=$reporteMantenimiento->getOtraFalla()?>">
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        </table>
        <table class="datosProblema">
            <tr>
                <th>&nbsp;&nbsp;PROBLEMA PRESENTADO:</th>
                <td><input type="text" name="problemaPresentado" value="<?=$reporteMantenimiento->getProblemaPresentado()?>" id="problema"></td>
            </tr>
        </table>
        <div class="subTitulo">ACTIVIDADES</div>
        <table class="datosActividades">
            <tr>
                <td rowspan="2" style="border-top-left-radius: 8px;border-bottom-left-radius: 8px;">
                    <ul class="botones">
                       <?=$reporteMantenimiento->getPruebaInicialChk()?>
                        <?=$reporteMantenimiento->getAspectoFisicoChk()?>
                        <?=$reporteMantenimiento->getCondicionAmbientalChk()?>
                        <?=$reporteMantenimiento->getSistemaElectronicoChk()?>
                        <?=$reporteMantenimiento->getSistemaHidraulicoChk()?>
                        <?=$reporteMantenimiento->getSistemaNeumaticoChk()?>
                        <?=$reporteMantenimiento->getSistemaMecanicoChk()?>
                        <?=$reporteMantenimiento->getSistemaElectricoChk()?>
                    </ul>
                    <ul class="botones">
                        <?=$reporteMantenimiento->getSistemaOpticoChk()?>
                        <?=$reporteMantenimiento->getSistemaElectromecanicoChk()?>
                        <?=$reporteMantenimiento->getSistemaVaporChk()?>
                        <?=$reporteMantenimiento->getSistemaOperativoChk()?>
                        <?=$reporteMantenimiento->getLimpiezaInternaChk()?>
                        <?=$reporteMantenimiento->getLimpiezaExternaChk()?>
                        <?=$reporteMantenimiento->getLubricacionPartesChk()?>
                        <?=$reporteMantenimiento->getPruebasFuncionamientoChk()?>
                    </ul>
                </td>
                <th class="bordeSuperiorDerecho">Rutina de Mantenimiento</th>
            </tr>
            <tr>
                <td class="bordeInferiorDerecho" style="font-size: 17px; max-width: 300px;" valign="top">                    
                    <input type="radio" name="ideRutinaExtra" value="0" id="0" required="true" <?=$seleccionado?>><?=$equipo->getTipoEquipo()->getRutinaLista()?>
                    <?= RutinaExtra::rutinaExtraEnRadio($reporteMantenimiento->getIdeRutinaExtra(), $equipo->getTipoEquipo()->getIde())?> 
                </td>
            </tr>
        </table>
        <div class="subTitulo">VERIFICACIÓN METROLÓGICA</div>
        <table class="datosMetrologicos">
            <tr>
                <th class="bordeSuperiorIzquierdo">Ud. Medida<a href="principal.php?CONTENIDO=mantenimiento/administrador/reporteMantenimientoPreventivo.php&ideMantenimiento=<?=$ideMantenimiento?>&ideEquipo=<?=$ideEquipo?>&accion=<?=$accion?>#openModal" id="abrir">+</a></th>
                <th>Valor Nominal</th>
                <th class="bordeSuperiorDerecho">Valor Medido</th>
            </tr>
            <?=$listaMetrologica?>
        </table>
        <div class="subTitulo">REPUESTOS UTILIZADOS</div>
        <table class="datosRepuestos" id="tablaRepuestos">
            <tr>
                <th class="bordeSuperiorIzquierdo">Detalle</th>
                <th>Referencia</th>
                <th class="bordeSuperiorDerecho">Cantidad</th>
            </tr>
            <?=$listaRepuestos?>
        </table>
        <div class="buttons">
            <button type="button" onclick="agregarFila()">Agregar Fila</button>
            <button type="button" onclick="eliminarFila()">Eliminar Fila</button>
        </div>
        <div class="subTitulo">OBSERVACIONES</div>
        <table class="datosObservaciones">
            <tr>
                <th>&nbsp;&nbsp;EL EQUIPO FUNCIONA CORRECTAMENTE:<?=$reporteMantenimiento->getFuncionamientoEquipoRadio()?></th>
            </tr>
            <tr>
                <td>
                    <div class="contenedor">
                        <textarea name="observaciones" rows="3"><?=$reporteMantenimiento->getObservaciones()?></textarea>
                    </div>                    
                </td>
            </tr>
        </table>
        <div class="accion">
            <input type="hidden" name="numeroReporte" value="<?=$numeroReporte?>">
            <input type="hidden" name="idePersona" value="<?=$datosIngeniero->getIdentificacion()?>">
            <input type="hidden" name="ideEquipo" value="<?=$equipo->getIde()?>">
            <input type="hidden" name="ideMantenimientoPreventivo" value="<?=$mantenimientoPreventivo->getIde()?>">
            <input type="hidden" name="numeroFilas" id="numeroFilas" value="">
            <input type="submit" name="accion" value="<?=$accion?>" >
        </div>
    </form>
</div>
<div id="openModal" class="modalDialog">
    <div>
	<a href="#close" title="Cerrar" class="close">x</a>
        <div id="formulario" style="margin: 20px 30px" >
            <form method="POST" action="mantenimiento/administrador/unidadMedidaActualizar.php">
                <table>
                    <tr>
                        <th colspan="2">ADICIONAR UNIDAD MEDIDA</th>
                    </tr>
                    <tr>
                        <th>SIMBOLO UNIDAD:</th>
                        <td><input type="text" name="unidad" required="true"></td>
                    </tr>
                    <tr>
                        <th colspan="2">
                            <input type="hidden" name="ideMantenimiento" value="<?=$ideMantenimiento?>">
                            <input type="hidden" name="ideEquipo" value="<?=$ideEquipo?>">
                            <input type="hidden" name="accion" value="<?=$accion?>">
                            <input type="submit" value="Guardar">
                        </th>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<div id="openModal2" class="modalDialog">
    <div>
	<a href="#close" title="Cerrar" class="close">x</a>
        <div id="formulario" style="margin: 20px 30px" >
            
        </div>
    </div>
</div>
<script>
    function printDiv(nombreDiv) {
     var contenido= document.getElementById(nombreDiv).innerHTML;
     var contenidoOriginal= document.body.innerHTML;

     document.body.innerHTML = contenido;

     window.print();

     document.body.innerHTML = contenidoOriginal;
}
    function agregarFila(){
        var table = document.getElementById("tablaRepuestos");
        var rowCount = table.rows.length;
	document.getElementById("tablaRepuestos").insertRow(-1).innerHTML = '<td><input type="text" name="detalle'+rowCount+'"></td><td><input type="text" name="referencia'+rowCount+'"></td><td><input type="number" name="cantidad'+rowCount+'" class="cantidad"></td>';
    }
    function eliminarFila(){
	var table = document.getElementById("tablaRepuestos");
	var rowCount = table.rows.length;
	//console.log(rowCount);
	if(rowCount <= 1)
            alert('No se puede eliminar el encabezado');
	else
            table.deleteRow(rowCount -1);
	}
    function contadorFilas() {
    	var table = document.getElementById("tablaRepuestos");
        var rowCount = table.rows.length;
        document.getElementById("numeroFilas").value = rowCount;
    }
        function habilitarProblemaPresentado() {
            var formulario=document.forms[0];
            for (var i = 0; i < formulario.tipo.length; i++) {
                if(formulario.tipo[i].checked){
                    var valor=formulario.tipo.value;
                    if (valor!=='0') {
                        document.getElementById('problema').disabled = true;
                    }
                }
            }
        }
</script>