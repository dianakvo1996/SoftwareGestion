<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
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
$cronograma=new Cronograma('ideSede', $ideSede);

$sede=new Sede('ide',$ideSede);
$cliente=new Cliente('nit',"'".$sede->getNitCliente()."'");
$datos=Equipo::getDatosEnObjetos("ideSede=$ideSede".$filtro, 'ubicacion,nombreEquipo asc');
$lista='';
$item=1;
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];

    $direccion="document.location='principal.php?CONTENIDO=mantenimiento/administrador/detallesEquipo.php&ideEquipo={$objeto->getIde()}'";
    $lista.="<tr onclick={$direccion}>";
    $lista.="<td>{$item}.</td>";
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
    $lista.="<td><a href='principal.php?CONTENIDO=mantenimiento/administrador/equipoSedeFormulario.php&accion=Modificar&ideSede={$sede->getIde()}&ide={$objeto->getIde()}'><img src='../presentacion/iconos/modificar.png' height='30px' title='Modificar'></a>";
    $lista.="<a href='principal.php?CONTENIDO=mantenimiento/administrador/equiposSede.php&ideSede={$objeto->getIdeSede()}&ide={$objeto->getIde()}#eleccion'><img src='../presentacion/iconos/eleccion.png' height='30px' title='Mover o Eliminar'></a>";
    $lista.="<a href='principal.php?CONTENIDO=mantenimiento/administrador/equiposSede.php&ideSede={$objeto->getIdeSede()}&ide={$objeto->getIde()}#darBaja'><img src='../presentacion/iconos/darDeBaja.png' height='30px' title='Dar de Baja'></a></td>";
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
<a href="principal.php?CONTENIDO=mantenimiento/administrador/sedes.php&nit=<?=$cliente->getNit()?>" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="listados">
    <table>
	<tr>
		<th colspan="5" class="tituloSuperior">EQUIPOS</th>
	</tr>
        <tr>
            <th>Cliente</th><td><?=$cliente->getNombre()?></td>
            <th>Sede</th><td colspan="2"><?=$sede->getNombre()?></td>
        </tr>
        <tr>
            <th>Perioricidad Mantenimiento:</th>
            <td><?=$cronograma->getPerioricidadLista()?></td>
            <th>Próximo Mantenimiento:</th>
            <td><?=$cronograma->getMesLista()?></td>
            <th colspan="2">
                <a href="principal.php?CONTENIDO=mantenimiento/administrador/cronogramaSede.php&ideSede=<?=$sede->getIde()?>" class="enlace">VER CRONOGRAMA</a>
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
                    <a href="principal.php?CONTENIDO=mantenimiento/administrador/equiposSede.php&ideSede=<?=$sede->getIde()?>"><img src="../presentacion/iconos/restaurar.png"  title="Restaurar Página" height="20px"></a>
                </td>
                <th>
                    <a href="mantenimiento/administrador/exportarEquiposSedeExcel.php?ideSede=<?=$sede->getIde()?>"><img src="../presentacion/iconos/exportarExcel.png" height="35px" title="Exportar Excel"></a> 
                    <a href="mantenimiento/administrador/exportarEquiposSedePDF.php?ideSede=<?=$sede->getIde()?>"><img src="../presentacion/iconos/exportarPDF.png" height="35px" title="Exportar PDF"></a> 
                </th>
	</tr>
	<tr>
		<th colspan="4"><a href="principal.php?CONTENIDO=mantenimiento/administrador/mantenimientoPreventivoSede.php&ideSede=<?=$sede->getIde()?>" class="enlace">MANTENIMIENTO PREVENTIVO</a></th>				
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
            <th><a href="principal.php?CONTENIDO=mantenimiento/administrador/equipoSedeFormulario.php&accion=Adicionar&ideSede=<?=$sede->getIde()?>"><img src="../presentacion/iconos/adicionar.png" title="Adicionar Equipo" height="30px"></a></th>
        </tr>
        <?=$lista?>
    </table>
    <?=$falta?>
</div>
<div id="importacion">
    <form method="POST" action="mantenimiento/administrador/importarEquiposSede.php" enctype="multipart/form-data">
        <strong>IMPORTAR EQUIPOS: &nbsp;&nbsp; </strong>
        <input type="file" required="true" accept=".xls" name="equipos" class="file">
        <input type="hidden" name="ideSede" value="<?=$sede->getIde()?>">
        <input type="submit" name="importar" value="Importar" class="boton">&nbsp;&nbsp;&nbsp;&nbsp;<strong style="font-size: 12px">*Archivo excel no mayor a 2MG*</strong>
    </form>
</div>
<div id="opcion">
    <a href="principal.php?CONTENIDO=mantenimiento/administrador/equiposDeBajaSede.php&ideSede=<?=$sede->getIde()?>" class="enlace">EQUIPOS DE BAJA</a>
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
                        <input type="hidden" name="ideSede" value="<?=$sede->getIde()?>">
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
<div id="eleccion" class="modalDialog">
    <div>
    <a href="#close" title="Cerrar" class="close">x</a>
    <center>
        <h2>¿QUE DESEA HACER?</h2>
        <?php $equipo2=new Equipo('ide',$_GET['ide']);?>
        <br>
        <img src="../presentacion/iconos/eliminar2.png" height="100px" style="padding-right: 20px" onclick="eliminar(<?=$equipo2->getIde()?>,<?=$ideSede?>)" title="Eliminar">
        <a href="principal.php?CONTENIDO=mantenimiento/administrador/moverEquipo.php&ide=<?=$equipo2->getIde()?>"><img src="../presentacion/iconos/mover.png" height="100px" style="padding-left: 20px" title="Mover"></a>
        <table id="listados">
            <tr>
                <th>EQUIPO</th><th style="background: rgba(180,180,180,0.1);font-weight: lighter"><?=$equipo2->getNombreEquipo()?></th>
            </tr>
            <tr>
                <th>ACTIVO FIJO</th><th style="background: rgba(180,180,180,0.1);font-weight: lighter"><?=$equipo2->getActivoFijo()?></th>
            </tr>
            <tr>
                <th>MARCA</th><th style="background: rgba(180,180,180,0.1);font-weight: lighter"><?=$equipo2->getMarca()?></th>
            </tr>
            <tr>
                <th>MODELO</th><th style="background: rgba(180,180,180,0.1);font-weight: lighter"><?=$equipo2->getModelo()?></th>
            </tr>
            <tr>
                <th>SERIE</th><th style="background: rgba(180,180,180,0.1);font-weight: lighter"><?=$equipo2->getSerial()?></th>
            </tr>
            <tr>
                <th>UBICACION</th><th style="background: rgba(180,180,180,0.1);font-weight: lighter"><?=$equipo2->getUbicacion()?></th>
            </tr>
        </table>
    </center>
    </div>
</div>
<!-- fin modales-->
<script>
    function eliminar(ide,ideSede) {
        if(confirm("¿Realmente desea eliminar este registro?")){
            location = 'mantenimiento/administrador/equipoSedeActualizar.php?accion=Eliminar&ide='+ide+'&ideSede='+ideSede;
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
