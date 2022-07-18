<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/solicitudCorrectivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/RespuestaSolicitud.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

date_default_timezone_set('America/Bogota');

$solicitud=new solicitudCorrectivo('ide', $ideSolicitud);

 if ($solicitud->getNitCliente()!=null) {
        $sede=$solicitud->getCliente()->getNombre();
        $cliente=$solicitud->getCliente()->getNombre();
    }else{
        $sede=$solicitud->getSede()->getNombre();
        $cliente=$solicitud->getSede()->getCliente()->getNombre();
    }
    if ($solicitud->getFotografia()!='')
        $fotografia="<img src='../FotografiasCorrectivos/{$solicitud->getFotografia()}' height='200px'  >";
    else 
        $fotografia='No Adjuntada';
$respuestaSolicitud=new RespuestaSolicitud('ideSolicitud', $solicitud->getIde());
$texto='';
switch ($respuestaSolicitud->getEstado()) {
    case 'R':
        $respuesta=$respuestaSolicitud->getRespuesta();
		$requerido="required='true'";
        break;
    case 'P':
        $respuesta="<textarea name='respuesta' class='textarea' required>{$respuestaSolicitud->getRespuesta()}</textarea>";
		$requerido="";
        break;
	case 'E':
        $respuesta="<textarea name='respuesta' class='textarea' required>{$respuestaSolicitud->getRespuesta()}</textarea>";
		$requerido="";
        break;
    default:    
        
        break;
}

$NOTA='';
if($solicitud->getIdeEquipo()!=null){
	$activoFijo=$solicitud->getEquipo()->getActivoFijo();
    $nombreEquipo=$solicitud->getEquipo()->getNombreEquipo();
	$marca=$solicitud->getEquipo()->getMarca();
	$modelo=$solicitud->getEquipo()->getModelo();
	$ubicacion=$solicitud->getEquipo()->getUbicacion();
	$serie=$solicitud->getEquipo()->getSerial();
}else{
	$activoFijo=$solicitud->getEquipoDeBaja()->getActivoFijo();
	$nombreEquipo=$solicitud->getEquipoDeBaja()->getNombreEquipo();
	$marca=$solicitud->getEquipoDeBaja()->getMarca();
	$modelo=$solicitud->getEquipoDeBaja()->getModelo();
	$ubicacion=$solicitud->getEquipoDeBaja()->getUbicacion();
	$serie=$solicitud->getEquipoDeBaja()->getSerial();
$NOTA="<h4 style='color:red'>EQUIPO DE BAJA</h4>";

}

?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/bandejaEntrada.php" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="formulario">
    <center>
<?=$NOTA?>
        <form method="POST" action="mantenimiento/administrador/respuestaSolicitudActualizar.php" enctype="multipart/form-data" name="respuesta">
        <table>
            <tr>
                <th colspan="2">DETALLES DE SOLICITUD</th>
            </tr>
            <tr>
                <th style="">Fecha y Hora:</th>
                <td><?=$solicitud->getFecha()?></td>
            </tr>
            <tr>
                <th style="">Cliente:</th>
                <td><?=$cliente?></td>
            </tr>
            <tr>
                <th>Sede:</th>
                <td><?=$sede?></td>
            </tr>
            <tr>
                <th>Informacion Equipo:</th>
                <td>
                    <strong>Activo Fijo: </strong><?=$activoFijo?><br>
                    <strong>Equipo: </strong><?=$nombreEquipo?><br>
                    <strong>Marca: </strong><?=$marca?><br>
                    <strong>Modelo: </strong><?=$modelo?><br>
                    <strong>Ubicación: </strong><?=$ubicacion?><br>
                    <strong>Serie: </strong><?=$serie?>
                </td>
            </tr>
            <tr>
                <th>Solicitante:</th>
                <td><?=$solicitud->getSolicitante()?></td>
            </tr>
            <tr>
                <th>Cargo:</th>
                <td><?=$solicitud->getCargo()?></td>
            </tr>
            <tr>
                <th>Detalles de Daño:</th>
                <td><?=$solicitud->getDetalle()?></td>
            </tr>
            <tr>
                <th>Fotografia:</th>
                <td><?=$fotografia?></td>
            </tr>
            <tr>
                <th>Respuesta:</th>
                <td><?=$respuesta?></td>
            </tr>
<!--            <tr>
                <th>Fecha y Hora:</th>
                <td></td>
            </tr>-->
            <tr>
                <th>Estado:</th>
                <td>
                    <?=$respuestaSolicitud->getEstadoRadio()?>
                </td>
            </tr>
            <tr>
                <th>Evidencia:</th>
                <td><input type="file" name="evidencia" accept=".jpg,.jpeg,.pdf"  <?=$requerido?> id="evidencia"></td>
            </tr>
            <tr>
                <th colspan="2">
                    <input type="hidden" name="ideRespuesta" value="<?=$respuestaSolicitud->getIde()?>">
                    <input type="submit" value="Responder" name="accion">
                </th>
            </tr>
        </table>
        </form>
    </center>
</div>

<script>
	function validarEstado(){
		let estado=document.respuesta.estado
		for(i=0;i<estado.length;i++)
        if(estado[i].checked) 
			if(estado[i].value=='R') document.getElementById("evidencia").required = true;
			else document.getElementById("evidencia").required = false;

	}
</script>