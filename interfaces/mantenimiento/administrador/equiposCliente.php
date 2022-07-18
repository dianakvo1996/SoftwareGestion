<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cronograma.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;
//Busqueda
$filtro='';
$campo='';
$valor='';
if (isset($_POST['buscar'])) {
    switch ($_POST['campo']) {
        case 'N':
                $campo='nombreEquipo';
        break;
        case 'AF':
                $campo='activoFijo';
        break;
        case 'S':
                $campo='serial';
        break;
        case 'U':
                $campo='ubicacion';
        break;
        case 'M':
                $campo='marca';
        break;
    }
    if ($_POST['valor']!='') {
        $valor=$_POST['valor'];
    }
    $filtro=" and $campo ilike '%{$valor}%'";
}
//Fin Busqueda

$falta='';
$cronograma=new Cronograma('nitCliente', "'".$nit."'");

$cliente=new Cliente('nit',"'".$nit."'");
$datos=Equipo::getDatosEnObjetos("nitCliente='{$nit}'".$filtro, 'ubicacion,nombreEquipo asc');
$lista='';
$item=1;
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];

    $direccion="document.location='principal.php?CONTENIDO=mantenimiento/administrador/detallesEquipo.php&ideEquipo={$objeto->getIde()}'";
    $lista.="<tr>";
    $lista.="<td onclick={$direccion}>{$item}.</td>";
    $lista.="<td onclick={$direccion}>{$objeto->getActivoFijo()}</td>";
    $lista.="<td onclick={$direccion}>{$objeto->getNombreEquipo()}</td>";
    $lista.="<td onclick={$direccion}>{$objeto->getMarca()}</td>";
    $lista.="<td onclick={$direccion}>{$objeto->getModelo()}</td>";
    $lista.="<td onclick={$direccion}>{$objeto->getSerial()}</td>";  
    $lista.="<td onclick={$direccion}>{$objeto->getUbicacion()}</td>";
    $lista.="<td onclick={$direccion}>{$objeto->getRegistroInvima()}</td>";
    $lista.="<td onclick={$direccion}>{$objeto->getTipoEquipo()->getTipoLista()}</td>";
    $lista.="<td onclick={$direccion}>{$objeto->getTipoEquipo()->clasificacionBiomedicaLista()}</td>";
    $lista.="<td onclick={$direccion}>{$objeto->getTipoEquipo()->clasificacionRiesgoLista()}</td>";
    $lista.="<td onclick={$direccion}>{$objeto->getTipoEquipo()->getManualLista()}</td>";
    $lista.="<td><a href='principal.php?CONTENIDO=mantenimiento/administrador/equipoClienteFormulario.php&accion=Modificar&nit={$cliente->getNit()}&ide={$objeto->getIde()}'><img src='../presentacion/iconos/modificar.png' height='30px' title='Modificar'></a>";
    $lista.="<img src='../presentacion/iconos/eliminar.png' height='30px' onclick='eliminar({$objeto->getIde()}," . '"' . "{$nit}" . '"' . ")' title='Eliminar'>";
    $lista.="<a href='principal.php?CONTENIDO=mantenimiento/administrador/equiposCliente.php&nit={$objeto->getNitCliente()}&ide={$objeto->getIde()}#darBaja'><img src='../presentacion/iconos/darDeBaja.png' height='30px' title='Dar de Baja'></a></td>";
    $lista.='</tr>';
    $item++;
}
$more='';
if ($lista=='') {
    if (isset($_POST['valor'])) {
       $more="que coincidan  con ".$_POST['valor'];
    }
    $falta="<h3>No hay equipos $more</h3>";
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/clientes.php" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="listados">
    <table>
	<tr>
		<th colspan="5" class="tituloSuperior">EQUIPOS</th>
	</tr>
        <tr>
            <th colspan="2">Cliente</th><td colspan="3"><?=$cliente->getNombre()?></td>
        </tr>
        <tr>
            <th>Perioricidad Mantenimiento:</th>
            <td><?=$cronograma->getPerioricidadLista()?></td>
            <th>Próximo Mantenimiento:</th>
            <td><?=$cronograma->getMesLista()?></td>
            <th colspan="2">
                <a href="principal.php?CONTENIDO=mantenimiento/administrador/cronogramaCliente.php&nit=<?=$cliente->getNit()?>" class="enlace">VER CRONOGRAMA</a>
            </th>
        </tr>
    </table>
<center>
    <form method="POST">
        <table>
            <tr>
                <th>Búsqueda</th>
                <td>
                    <select name="campo" class="busqueda" id="campo" onclick="deshabilitar()">
                        <option value="C" selected>--Seleccione Filtro--</option>
                        <option value="N">Equipo</option>
                        <option value="AF">Activo Fijo</option>
                        <option value="S">Serial</option>
                        <option value="U">Ubicacion</option>
                        <option value="M">Marca</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="valor" id="valor" required class="busqueda" placeholder="Buscar" disabled="true">              
                    <button type="submit" class="iconBusqueda" id="buscar" name="buscar" disabled="true"><img src="../presentacion/iconos/buscar.png" height="20px" title="Buscar"></button>
                    <a href="principal.php?CONTENIDO=mantenimiento/administrador/equiposCliente.php&nit=<?=$cliente->getNit()?>"><img src="../presentacion/iconos/restaurar.png"  title="Restaurar Página" height="20px"></a>
                </td>
                <th>
                    <a href="mantenimiento/administrador/exportarEquiposClienteExcel.php?nit=<?=$cliente->getNit()?>"><img src="../presentacion/iconos/exportarExcel.png" height="35px" title="Exportar Excel"></a> 
                    <a href="mantenimiento/administrador/exportarEquiposClientePDF.php?nit=<?=$cliente->getNit()?>"><img src="../presentacion/iconos/exportarPDF.png" height="35px" title="Exportar PDF"></a> 
                </th>
	</tr>
	<tr>
		<th colspan="4"><a href="principal.php?CONTENIDO=mantenimiento/administrador/mantenimientoPreventivoCliente.php&nitCliente=<?=$cliente->getNit()?>" class="enlace">MANTENIMIENTO PREVENTIVO</a></th>				
	</tr>
        </table>
    </form>
</center>
</div>
<div id="listados">
    <table>
        <tr>
            <th colspan="2">ACTIVO FIJO</th>
            <th>NOMBRE</th>
            <th>MARCA</th>
            <th>MODELO</th>
            <th>SERIAL</th>
            <th>UBICACIÓN</th>  
			<th>REGISTRO INVIMA</th>
			<th>TIPO</th>
			<th>CLASIFICACION BIOMEDICA</th>
			<th>CLASIFICACION DEL RIESGO</th>
			<th>MANUAL</th>  
            <th><a href="principal.php?CONTENIDO=mantenimiento/administrador/equipoClienteFormulario.php&accion=Adicionar&nit=<?=$cliente->getNit()?>"><img src="../presentacion/iconos/adicionar.png" title="Adicionar Equipo" height="30px"></a></th>
        </tr>
        <?=$lista?>
    </table>
    <?=$falta?>
</div>
<div id="importacion">
    <form method="POST" action="mantenimiento/administrador/importarEquiposCliente.php" enctype="multipart/form-data">
        <strong>IMPORTAR EQUIPOS: &nbsp;&nbsp; </strong>
        <input type="file" required="true" accept=".xls" name="equipos" class="file">
        <input type="hidden" name="nitCliente" value="<?=$cliente->getNit()?>">
        <input type="submit" name="importar" value="Importar" class="boton">&nbsp;&nbsp;&nbsp;&nbsp;<strong style="font-size: 12px">*Archivo excel no mayor a 2MG*</strong>
    </form>
</div>
<div id="opcion">
    <a href="principal.php?CONTENIDO=mantenimiento/administrador/equiposDeBaja.php&nitCliente=<?=$cliente->getNit()?>" class="enlace">EQUIPOS DE BAJA</a>
</div>
<!--inicio modales-->
<div id="darBaja" class="modalDialog">
    <div>
    <a href="#close" title="Cerrar" class="close">x</a>
    <br>
    <center>
        <form method="POST" action="mantenimiento/administrador/darDeBajaActualizar.php" onsubmit="return confirmarDarBaja()">
            <table id="formulario">
            <?php $equipo=new Equipo('ide', $_GET['ide']);?>
                <tr>
                    <th colspan="2">EQUIPO A DAR DE BAJA </th>
                </tr>
                 <tr>
                    <th>Equipo</th>
                    <td><?=$equipo->getNombreEquipo()?></td>
                </tr>
                <tr>
                    <th>Activo Fijo</th>
                    <td><?=$equipo->getActivoFijo()?></td>
                </tr>
                <tr>
                    <th>Marca</th>
                    <td><?=$equipo->getMarca()?></td>
                </tr>
                <tr>
                    <th>Modelo</th>
                    <td><?=$equipo->getModelo()?></td>
                </tr>
                <tr>
                    <th>Serie</th>
                    <td><?=$equipo->getSerial()?></td>
                </tr>
                <tr>
                    <th>Ubicacion</th>
                    <td><?=$equipo->getUbicacion()?></td>
                </tr>
                <tr>
                    <th>Fecha Realización</th>
                    <td><input type="date" name="fechaRealizacion" value="<?= date('Y-m-d')?>" max="<?= date('Y-m-d')?>"></td>
                </tr>
                <tr>
                    <th>Justificacion</th>
                    <td>
                        <textarea class="textarea" cols="30" rows="3" name="justificacion" minlength="20" required></textarea>
                    </td>
                </tr>
                <tr>
                    <th colspan="2">
                        <input type="hidden" name="nitCliente" value="<?=$cliente->getNit()?>">
                    <input type="hidden" name="ide" value="<?=$equipo->getIde()?>">
                    <input type="submit" value="Aceptar" name="accion">
                    </th>
                </tr>
            </table>
        </form>
        </center>
        <br>
    </div>
</div>
<!-- fin modales-->
<script>
    function eliminar(ide,nitCliente) {
        if(confirm("¿Realmente desea eliminar este registro?")){
            location = 'mantenimiento/administrador/equipoClienteActualizar.php?accion=Eliminar&ide='+ide+'&nitCliente='+nitCliente;
         }
    }
function deshabilitar() {
    var valor=document.getElementById('campo').value;
    if (valor!='C') {
        document.getElementById('buscar').disabled = false;
        document.getElementById('valor').disabled = false;
    }else{
        document.getElementById('buscar').disabled = true;
        document.getElementById('valor').disabled = true;
    }
}
function confirmarDarBaja(){
        var valido=false;
        if (confirm('¿Esta seguro?')){
            valido=true;
        }
        return valido;
    }
</script>