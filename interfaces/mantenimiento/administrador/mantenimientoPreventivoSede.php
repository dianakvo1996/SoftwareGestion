<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cronograma.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/MantenimientoPreventivo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

date_default_timezone_set('UTC');
//$añoActual=date("Y");
$añoActual=2020;
$sede=new Sede('ide', $ideSede);
$numeroEquipos= ConectorBD::ejecutarQuery("select count(ide) from equipo where ideSede='{$sede->getIde()}'", null)[0][0];
$direccion="equiposMantenimientoSede.php";
$datos = MantenimientoPreventivo::getDatosEnObjetos("ideSede={$sede->getIde()}", 'fecha desc');
$lista = '';
for ($i = 0; $i < count($datos); $i++) {
    $objeto = $datos[$i];
    $lista.= '<tr>';
	if($objeto->getGenerar()!='S'){
		$direccion = "equiposMantenimientoSedePDF.php";
    	$numeroReportes=ConectorBD::ejecutarQuery("select count(ideEquipo) from reportePreventivoPDF where ideMantenimientoPreventivo={$objeto->getIde()}", null)[0][0];
	}else{
		$numeroReportes=ConectorBD::ejecutarQuery("select count(ideEquipo) from reportePreventivo where ideMantenimientoPreventivo={$objeto->getIde()}", null)[0][0];
	}
    $lista.= "<td>{$objeto->getMostarFecha()}</td>";
    $lista.= "<td>{$numeroReportes} Reportes / {$numeroEquipos} Equipos</td>";
    $porcentaje=($numeroReportes*100)/$numeroEquipos;
    $lista.= "<td>".substr($porcentaje, 0,4)."%</td>";
    $lista.= "<td><a href='principal.php?CONTENIDO=mantenimiento/administrador/{$direccion}&ide={$objeto->getIde()}' class='enlace'>Equipos</a></td>";
    $lista.= "<td><a href='principal.php?CONTENIDO=mantenimiento/administrador/mantenimientoPreventivoSede.php&ideSede={$sede->getIde()}&ideMantenimiento={$objeto->getIde()}&accion=Modificar#formulario'><img src='../presentacion/iconos/modificar.png' height='30px' title='Modificar'></a>";
    $lista.= "<img src='../presentacion/iconos/eliminar.png' onclick='eliminar({$objeto->getIde()}," . '"' . "{$sede->getIde()}" . '"' . ")' height='30px' title='Eliminar'></td>";
    $lista.= '</tr>'; 
}
//inicio caluculo siguiente calibracion
$cronogramaPreventivo=new Cronograma('ideSede',$sede->getIde());
$ultimoMantenimiento= ConectorBD::ejecutarQuery("select max(fecha) as ultimoMantenimeinto from mantenimientoPreventivo where ideSede={$sede->getIde()}", null);

$proximoMes=str_pad($cronogramaPreventivo->getMes(), 2,'0',STR_PAD_LEFT);
if ($ultimoMantenimiento[0][0]!=null) {
        $fecha= date_create($ultimoMantenimiento[0][0]);
        $mes = date_format($fecha,'m');
        $mesSiguiente=$mes+$cronogramaPreventivo->getPerioricidad();
    if ($mesSiguiente < 12) {  
        $proximoMes=str_pad($mesSiguiente, 2,'0',STR_PAD_LEFT);
    } else {
        $proximoMes=str_pad($cronogramaPreventivo->getMes(), 2,'0',STR_PAD_LEFT);
    }
} 
//fin caluculo siguiente calibracion
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/equiposSede.php&ideSede=<?=$sede->getIde()?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="25px"></a>
<div id="listados">
    <table>
	<tr>
		<th class="tituloSuperior" colspan="6">MANTENIMIENTOS PREVENTIVOS</th>
	</tr>
        <tr>
            <th>Cliente:</th>
            <td><?=$sede->getCliente()->getNombre()?></td>
            <th>Sede:</th>
            <td><?=$sede->getNombre()?></td>
            <th>Total Equipos</th>
            <td><?=$numeroEquipos?></td>
        </tr>
    </table>

    <table>
        <tr>
            <th>Fecha</th>
            <th colspan="2">Resumen</th>
            <th></th>
            <th><a href="principal.php?CONTENIDO=mantenimiento/administrador/mantenimientoPreventivoSede.php&ideSede=<?=$sede->getIde()?>&accion=Adicionar#formulario"><img src="../presentacion/iconos/adicionar.png" height="30px"></a></th>
        </tr>
        <?=$lista?>
    </table>
</div>
<div id="formulario" class="modalDialog">
    <div>
        <a href="#close" title="Cerrar" class="close">X</a>
        <div id="formulario">
            <?php
            if ($accion=='Modificar'){
                $mantenimiento=new MantenimientoPreventivo('ide', $ideMantenimiento);
                $fechaValor=$mantenimiento->getMostarFecha();
            } else {
                $mantenimiento=new MantenimientoPreventivo(null, null);
                $fechaValor=date('Y').'-'.$proximoMes.'-01';
            }
            ?>
            <form method="POST" action="mantenimiento/administrador/mantenimientoPreventivoSedeActualizar.php">
                <center>
                    <br>
                    <br>
                    <table>
                        <tr>
                            <th colspan="2"><?= strtoupper($accion)?> MANTENIMEINTO PREVENTIVO</th>
                        </tr>
                        <tr>
                            <th>FECHA</th>
                            <td><input type="date" name="fecha" required="true" value="<?=$fechaValor?>"></td>
                        </tr>
                        <tr>
                            <th>REPORTES</th>
                            <td><?=$mantenimiento->getGenerarRadio()?></td>
                        </tr>
                        <tr>
                            <th colspan="2">
                                <input type="hidden" value="<?=$mantenimiento->getIde()?>" name="ideAnterior">
                                <input type="hidden" value="<?=$sede->getIde()?>" name="ideSede">
                                <input type="submit" value="<?=$accion?>" name="accion">
                            </th>
                        </tr>
                    </table>
                </center>
            </form>
        </div>
    </div>
</div>
<script>
    function eliminar(ide,ideSede) {
        if (confirm('¿Esta seguro?')) {
                location = 'mantenimiento/administrador/mantenimientoPreventivoSedeActualizar.php?accion=Eliminar&ideAnterior='+ide+'&ideSede='+ideSede;
        }
    }
    
</script>