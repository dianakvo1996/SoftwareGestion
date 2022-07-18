<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
$cliente=new Cliente('usuario', "'".$_SESSION['usuario']."'");
$datos= Equipo::getDatosEnObjetos("nitCliente='{$cliente->getNit()}'", 'nombreequipo');
$lista='';
$item=1;
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td style='font-weight: bold'>{$item}.</td>";
    $lista.="<td>{$objeto->getActivoFijo()}</td>";
    $lista.="<td>{$objeto->getNombreEquipo()}</td>";
    $lista.="<td>{$objeto->getMarca()}</td>";
    $lista.="<td>{$objeto->getModelo()}</td>";
    $lista.="<td>{$objeto->getSerial()}</td>";    
    $lista.="<td>{$objeto->getUbicacion()}</td>";
    $lista.="<td>{$objeto->getRegistroInvima()}</td>";
    $lista.="<td>{$objeto->getTipoEquipo()->getTipoLista()}</td>";
    $lista.="<td>{$objeto->getTipoEquipo()->clasificacionBiomedicaLista()}</td>";
    $lista.="<td>{$objeto->getTipoEquipo()->clasificacionRiesgoLista()}</td>";
    $lista.="<td>{$objeto->getTipoEquipo()->getManualLista()}</td>";
    $lista.='</tr>';
    $item++;
}
?>
<!--<a href="principal.php?CONTENIDO=mantenimiento/cliente/inicio.php" style=""><img src="../presentacion/iconos/atras.png" title="Volver" height="40px"></a>-->
<div id="listados">
    <h2>
        INVENTARIO EQUIPOS</h2><br>
        <h3>
        <?=$cliente->getNombre()?>
        </h3>
        <br>
        <table>
            <tr>
                <th><a href="principal.php?CONTENIDO=mantenimiento/cliente/cronogramaCliente.php" class="enlace">Cronograma de Mantenimiento</a></th>
                <th><a href="principal.php?CONTENIDO=mantenimiento/cliente/cronogramaCalibracionCliente.php&nitCliente=<?=$cliente->getNit()?>" class="enlace">Cronograma de Calibración</a></th>
                <th><a href="principal.php?CONTENIDO=mantenimiento/cliente/equiposDeBajaCliente.php" class="enlace">Equipos de baja</a></th>
            </tr>
        </table>

    <table>
        <tr>
            <th colspan="2">ACTIVO FÍJO</th>
            <th >EQUIPO</th>
            <th>MARCA</th>
            <th>MODELO</th>
            <th>SERIE</th>     
            <th>UBICACIÓN</th>
			<th>REGISTRO INVIMA</th>
			<th>TIPO</th>
			<th>CLASIFICACION BIOMEDICA</th>
			<th>CLASIFICACION DEL RIESGO</th>
			<th>MANUAL</th>        
        </tr>
        <?=$lista?>
    </table>
</div>
