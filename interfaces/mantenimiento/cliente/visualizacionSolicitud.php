<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/solicitudCorrectivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/RespuestaSolicitud.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$solicitud=new solicitudCorrectivo('ide', $ideSolicitud);
$respuestaSolicitud=new RespuestaSolicitud('ideSolicitud', $solicitud->getIde());
switch ($respuestaSolicitud->getEstado()) {
    case 'R':
        $estado='<label style="color:#008C09">Ejecutado</label>';
        break;
    case 'P':
        $estado='<label style="color:#FF5733">Pendiente</label>';
        break;
    case 'E':
        $estado='<label style="color:#3230C4">En Proceso</label>';
        break;

}

if ($solicitud->getNitCliente()!=null){
    $cliente=$solicitud->getCliente()->getNombre();
    $sede=$solicitud->getCliente()->getNombre();    
}else{
    $cliente=$solicitud->getSede()->getCliente()->getNombre();
    $sede=$solicitud->getSede()->getNombre();
}
$ruta='No Adjuntada';
if ($solicitud->getFotografia()!='') {
    $ruta="<img src='../FotografiasCorrectivos/{$solicitud->getFotografia()}' height='200px'>";
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/cliente/solicitudesCorrectivo.php" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="formulario">
    <center>
    <table>
        <tr>
            <th colspan="2">DETALLES SOLICITUD MANTENIMIENTO CORRECTIVO</th>
            <th colspan="2">DETALLES RESPUESTA</th>
        </tr>
        <tr>
            <th>FECHA</th>
            <td><?=$solicitud->getMostrarFecha()?></td>
            <th>FECHA REALIZACIÓN</th>
            <td><?=$respuestaSolicitud->getMostrarFecha()?></td>            
        </tr>
        <tr>
            <th>CLIENTE</th>
            <td><?=$cliente?></td>
            <th>ESTADO</th>
            <td><?=$estado?><td>
        </tr>
        <tr>
            <th>SEDE</th>
            <td><?=$sede?></td>
            
            <th>RESPUESTA</th>
            <td><?=$respuestaSolicitud->getRespuesta()?><td>
        </tr>
        <tr>
            <th>INFORMACIONE EQUIPO</th>
            <td>
                <strong>Activo Fijo: </strong><?=$solicitud->getEquipo()->getActivoFijo()?><br>
                <strong>Equipo: </strong><?=$solicitud->getEquipo()->getNombreEquipo()?><br>
                <strong>Marca: </strong><?=$solicitud->getEquipo()->getMarca()?><br>
                <strong>Modelo: </strong><?=$solicitud->getEquipo()->getModelo()?><br>
                <strong>Ubicación: </strong><?=$solicitud->getEquipo()->getUbicacion()?><br>
                <strong>Serie: </strong><?=$solicitud->getEquipo()->getSerial()?>
            </td>
            <th>EVIDENCIA</th>
            <td><img src="../EvidenciasCorrectivos/<?=$respuestaSolicitud->getEvidencia()?>" height="200px"></td>
        </tr>
        <tr>
            <th>SOLICITANTE</th>
            <td><?=$solicitud->getSolicitante()?></td>
        </tr>
        <tr>
            <th>CARGO</th>
            <td><?=$solicitud->getCargo()?></td>
        </tr>
        <tr>
            <th>DETALLES DE DAÑO</th>
            <td><?=$solicitud->getDetalle()?></td>
        </tr>
        <tr>
            <th>FOTOGRAFIA</th>
            <td><?=$ruta?><td>
        </tr>
    </table>
    </center>
</div>