<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cronograma.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/MantenimientoPreventivo.php';

$cliente = new Cliente('nit',"'{$nitCliente}'");
$numeroEquipos= ConectorBD::ejecutarQuery("select count(ide) from equipo where nitCliente='{$cliente->getNit()}'", null)[0][0];
$datos = MantenimientoPreventivo::getDatosEnObjetos("nitCliente='{$cliente->getNit()}'", 'fecha desc');
$lista = '';
for ($i = 0; $i < count($datos); $i++) {
    $objeto = $datos[$i];
    $lista.= '<tr>';
    $lista.= "<td>{$objeto->getMostarFecha()}</td>";
	if($objeto->getGenerar()=='S'){
		$direccion = "equiposMantenimientoCliente.php";
		$numeroReportes=ConectorBD::ejecutarQuery("select count(ideEquipo) from reportePreventivo where ideMantenimientoPreventivo={$objeto->getIde()}", null)[0][0];
	}else{
		$direccion = "equiposMantenimientoClientePDF.php";
    	$numeroReportes=ConectorBD::ejecutarQuery("select count(ideEquipo) from reportePreventivoPDF where ideMantenimientoPreventivo={$objeto->getIde()}", null)[0][0];

	}
    $lista.= "<td>{$numeroReportes} Reportes / {$numeroEquipos} Equipos</td>";
    $porcentaje=($numeroReportes*100)/$numeroEquipos;
    $lista.= "<td>".substr($porcentaje, 0,4)."%</td>";
    $lista.= "<td><a href='principal.php?CONTENIDO=mantenimiento/administrador/{$direccion}&ide={$objeto->getIde()}' class='enlace'>Equipos</a></td>";
    $lista.= "<td><a href='principal.php?CONTENIDO=mantenimiento/administrador/mantenimientoPreventivoCliente.php&nitCliente={$cliente->getNit()}&ideMantenimiento={$objeto->getIde()}&accion=Modificar#formulario'><img src='../presentacion/iconos/modificar.png' height='20px' title='Modificar'></a>";
    $lista.= "<img src='../presentacion/iconos/eliminar.png' onclick='eliminar({$objeto->getIde()}," . '"' . "{$cliente->getNit()}" . '"' . ")' height='20px' title='Eliminar'></td>";
    $lista.= '</tr>';
}
//inicio caluculo siguiente calibracion
$cronogramaPreventivo=new Cronograma('nitCliente', "'".$cliente->getNit()."'");
$ultimoMantenimiento= ConectorBD::ejecutarQuery("select max(fecha) as ultimoMantenimeinto from mantenimientoPreventivo where nitCliente='{$cliente->getNit()}'", null);

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
<a href="principal.php?CONTENIDO=mantenimiento/administrador/equiposCliente.php&nit=<?=$cliente->getNit()?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="listados">
    <h2>MANTENIMIENTOS PREVENTIVOS</h2>
    <table>
        <tr>
            <th>Cliente:</th>
            <td><?=$cliente->getNombre()?></td>
            <th>Total Equipos</th>
            <td><?=$numeroEquipos?></td>
        </tr>
    </table>
    <table>
        <tr>
            <th>Fecha</th>
            <th colspan="2">Resumen</th>
            <th></th>
            <th><a href="principal.php?CONTENIDO=mantenimiento/administrador/mantenimientoPreventivoCliente.php&nitCliente=<?=$cliente->getNit()?>&accion=Adicionar#formulario"><img src="../presentacion/iconos/adicionar.png" height="20px"></a></th>
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
            <form method="POST" action="mantenimiento/administrador/mantenimientoPreventivoClienteActualizar.php">
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
                                <input type="hidden" value="<?=$cliente->getNit()?>" name="nitCliente">
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
    function eliminar(ide,nitCliente) {
        if (confirm('¿Esta seguro?')) {
                location = 'mantenimiento/administrador/mantenimientoPreventivoClienteActualizar.php?accion=Eliminar&ideAnterior='+ide+'&nitCliente='+nitCliente;
        }
    }
    
</script>