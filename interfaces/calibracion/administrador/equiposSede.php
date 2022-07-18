<?php

require_once dirname(__FILE__) . '/../../../clasesCalibracion/ClienteC.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/EquipoC.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/CronogramaC.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/SedeC.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

date_default_timezone_set('America/Bogota');

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
$cronograma=new CronogramaC('ideSede', $ideSede);

$sede=new SedeC('ide',$ideSede);
$cliente=new ClienteC('nit',"'".$sede->getNitCliente()."'");
$datos=EquipoC::getDatosEnObjetos("ideSede=$ideSede".$filtro, 'ubicacion,nombreEquipo asc');
$lista='';
$item=1;
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$item}.</td>";
    $lista.="<td>{$objeto->getActivoFijo()}</td>";
    $lista.="<td>{$objeto->getNombreEquipo()}</td>";
    $lista.="<td>{$objeto->getMarca()}</td>";
    $lista.="<td>{$objeto->getModelo()}</td>";
    $lista.="<td>{$objeto->getSerial()}</td>";  
    $lista.="<td>{$objeto->getUbicacion()}</td>";
    $lista.="<td><a href='principal.php?CONTENIDO=calibracion/administrador/equipoSedeFormulario.php&accion=Modificar&ideSede={$sede->getIde()}&ide={$objeto->getIde()}'><img src='../presentacion/iconos/modificar.png' height='30px' title='Modificar'></a>";
    $lista.="<img src='../presentacion/iconos/eliminar.png' onclick='eliminar({$objeto->getIde()}," . '"' . "{$sede->getIde()}" . '"' . ")' height='30px' title='eliminar'><a href='principal.php?CONTENIDO=calibracion/administrador/equiposSede.php&ideSede={$sede->getIde()}&ideEquipo={$objeto->getIde()}#visor'><img src='../presentacion/iconos/detalles.png' height='30px' title='Detalles Equipo'></a></td>";
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
<a href="principal.php?CONTENIDO=calibracion/administrador/sedes.php&nitCliente=<?=$cliente->getNit()?>" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="listados">
     <h2>EQUIPOS</h2>
    <table>
        <tr>
            <th>Cliente</th><td><?=$cliente->getNombre()?></td>
            <th>Sede</th><td colspan="2"><?=$sede->getNombre()?></td>
        </tr>
        <tr>
            <th>Perioricidad Calibracion:</th>
            <td><?=$cronograma->getPerioricidadLista()?></td>
            <th>Próxima Calibración:</th>
            <td><?=$cronograma->getMesLista()?></td>
            <th colspan="2">
                <a href="principal.php?CONTENIDO=calibracion/administrador/cronogramaSede.php&ideSede=<?=$sede->getIde()?>" class="enlace">VER CRONOGRAMA</a>
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
                    <a href="principal.php?CONTENIDO=calibracion/administrador/equiposSede.php&ideSede=<?=$sede->getIde()?>"><img src="../presentacion/iconos/restaurar.png"  title="Restaurar Página" height="20px"></a>
                </td>
                <th>
                    <a href="calibracion/administrador/exportarEquiposSedeExcel.php?ideSede=<?=$sede->getIde()?>"><img src="../presentacion/iconos/exportarExcel.png" height="35px" title="Exportar Excel"></a> 
                    <a href="calibracion/administrador/exportarEquiposSedePDF.php?ideSede=<?=$sede->getIde()?>"><img src="../presentacion/iconos/exportarPDF.png" height="35px" title="Exportar PDF"></a> 
                </th>
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
            <th><a href="principal.php?CONTENIDO=calibracion/administrador/equipoSedeFormulario.php&accion=Adicionar&ideSede=<?=$sede->getIde()?>"><img src="../presentacion/iconos/adicionar.png" title="Clientes" height="30px"></a></th>
        </tr>
        <?=$lista?>
    </table>
    <?=$falta?>
</div>
<div id="importacion">
    <form method="POST" action="calibracion/administrador/importarEquiposSede.php" enctype="multipart/form-data">
        <strong>IMPORTAR EQUIPOS: &nbsp;&nbsp; </strong>
        <input type="file" required="true" accept=".xls,.xlsx" name="equipos" class="file">
        <input type="hidden" name="ideSede" value="<?=$sede->getIde()?>">
        <input type="submit" name="importar" value="Importar" class="boton">&nbsp;&nbsp;&nbsp;&nbsp;<strong style="font-size: 12px">*Archivo excel no mayor a 2MG*</strong>
    </form>
</div>

<div id="visor" class="modalDialog">
    <div>
        <a href="#close" title="Cerrar" class="close">X</a>
			<div id="visor">        		
				<div id="formulario">
					<center>
					<table>						
						<?=EquipoC::getModal($_GET['ideEquipo'])?>
					</table>
					</center>
				</div>
				
			</div>
    </div>
</div>

<script>
    function eliminar(ide,ideSede) {
        if(confirm("¿Realmente desea eliminar este registro?")){
            location = 'calibracion/administrador/equipoSedeActualizar.php?accion=Eliminar&ide='+ide+'&ideSede='+ideSede;
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
</script>


