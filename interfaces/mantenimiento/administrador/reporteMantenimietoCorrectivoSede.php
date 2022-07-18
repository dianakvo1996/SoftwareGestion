<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/Persona.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Repuesto.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ReporteCorrectivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/UnidadMedida.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/DatosNumeroReporte.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/VerificacionMetrologica.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;
date_default_timezone_set('America/Bogota');
//Inicio datos Ingeniero o tecnico
$datosIngeniero=new Persona('usuario', "'".$_SESSION['usuario']."'");
//Fin datos Ingeniero o tecnico
if ($accion==='Modificar') {
    $reporteMantenimiento=new ReporteCorrectivo('numeroReporte',"'$numeroReporte'");
    $ingeniero=$reporteMantenimiento->getPersona()->getNombresCompletos();
    $equipo=new Equipo('ide', $reporteMantenimiento->getIdeEquipo());
    $numeroReporte = $reporteMantenimiento->getNumeroReporte();
    $fecha=$reporteMantenimiento->getFecha();
    $tipoMantenimiento=$reporteMantenimiento->getTipoMantenimiento();
    //Inicio datos metrologicos
    $datosMetrologica = VerificacionMetrologica::getDatosEnObjetos("numeroCorrectivo='".$numeroReporte."'",null);
    $listaMetrologica = '';
    $item=1;
    for ($j = 0; $j < count($datosMetrologica); $j++) {
        $objMetrologia=$datosMetrologica[$j];
        $listaMetrologica.= '<tr>';
        $listaMetrologica.= '<td><select name=udMedida'.$item.'>'.UnidadMedida::getUnidadesOptions($objMetrologia->getIdeUnidadMedida()).'</select></td>';
        $listaMetrologica.= '<td><input type="number" step="any" value="'.$objMetrologia->getValorNominal().'" name="valorNominal'.$item.'" required><input type="hidden" step="any" value="'.$objMetrologia->getIde().'" name="ideValor'.$item.'"></td>';
        $listaMetrologica.= '<td><input type="number" step="any" value="'.$objMetrologia->getValorMedido().'" name="valorMedido'.$item.'" required></td>';
        $listaMetrologica.= '</tr>';
        $item++;
    }
    //Fin datos metrologicos
}else{
    $reporteMantenimiento=new ReporteCorrectivo(null, null);
    $equipo=new Equipo('ide', $ideEquipo);
    $ingeniero=$datosIngeniero->getNombresCompletos();
    $numeroReporte = ReporteCorrectivo::generarNumeroReporte();
    $fecha= date('Y-m-d');
    $tipoMantenimiento='C';
    //Inicio datos Metrologicos
    $listaMetrologica='<tr>';
    $listaMetrologica.= '<td><select name="udMedida1">'.UnidadMedida::getUnidadesOptions(null).'</select></td>';
    $listaMetrologica.= '<td><input type="number" step="any" name="valorNominal1" required></td>';
    $listaMetrologica.= '<td><input type="number" step="any"  name="valorMedido1" required></td>';
    $listaMetrologica.= '</tr>';
    $listaMetrologica.= '<tr>';
    $listaMetrologica.= '<td><select name="udMedida2">'.UnidadMedida::getUnidadesOptions(null).'</select></td>';
    $listaMetrologica.= '<td><input type="number" step="any" name="valorNominal2" required></td>';
    $listaMetrologica.= '<td><input type="number" step="any"  name="valorMedido2" required></td>';
    $listaMetrologica.= '</tr>';
//Fin datos Metrologicos       
}
//Inicio datos repuestos
    $datosRepuestos=Repuesto::getDatosEnObjetos("numeroCorrectivo='{$numeroReporte}'", null);
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
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/mantenimientoCorrectivoSede.php&ideSede=<?=$equipo->getIdeSede()?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="40px" style="float: left"></a>
<div class="reporteMantenimiento">
    <form method="POST" action="mantenimiento/administrador/reporteCorrectivoSedeActualizar.php" onsubmit="return contadorFilas()" onchange="javascript:habilitarProblemaPresentado()">
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
                            <input type="text" class="ciudad" name="ciudad" placeholder="CIUDAD" value="<?=$reporteMantenimiento->getCiudad()?>">
                        </td>
                        <td>
                            <input type="date" class="fecha" name="fecha" value="<?=$fecha?>">
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
                <td>&nbsp;&nbsp;<?=$equipo->getSede()->getCliente()->getNombre()?></td>
            </tr>
            <tr>
                <th class="bordeInferiorIzquierdo">&nbsp;&nbsp;SEDE:</th>
                <td class="bordeInferiorDerecho">&nbsp;&nbsp;<?=$equipo->getSede()->getNombre()?></td>
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
                <td><input type="text" name="problemaPresentado" value="<?=$reporteMantenimiento->getProblemaPresentado()?>" id="problema" required></td>
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
                    <?=$equipo->getTipoEquipo()->getRutinaLista()?>
                </td>
            </tr>
        </table>
                <div class="subTitulo">VERIFICACIÓN METROLÓGICA</div>
        <table class="datosMetrologicos">
            <tr>
                <th class="bordeSuperiorIzquierdo">Ud. Medida</th>
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
            <input type="hidden" name="nitCliente" value="<?=$equipo->getNitCliente()?>">
            <input type="hidden" name="ideSede" value="<?=$equipo->getIdeSede()?>">
            <input type="hidden" name="numeroFilas" id="numeroFilas" value="">
            <input type="submit" name="accion" value="<?=$accion?>" >
        </div>
    </form>
</div>
<script>
    function agregarFila(){
        var table = document.getElementById("tablaRepuestos");
        var rowCount = table.rows.length;
	document.getElementById("tablaRepuestos").insertRow(-1).innerHTML = '<td><input type="text" name="detalle'+rowCount+'" required></td><td><input type="text" name="referencia'+rowCount+'" required></td><td><input type="number" name="cantidad'+rowCount+'" required class="cantidad"></td>';
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
</script>


