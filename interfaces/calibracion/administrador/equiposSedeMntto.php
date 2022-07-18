<?php

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';

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
//Fin Bisqueda

$falta='';
$sede=new Sede('ide', $ideSede);
$datos=Equipo::getDatosEnObjetos("ideSede={$ideSede}".$filtro, 'ubicacion,nombreequipo asc');
$lista='';
$item=1;
$numRegistros=count($datos);
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $indice=$item+1;
    $direccion="document.location='principal.php?CONTENIDO=mantenimiento/administrador/detallesEquipo.php&ideEquipo={$objeto->getIde()}'";
    $lista.="<tr>";
    $lista.="<td>{$item}</td>";
    $lista.="<td><label for='{$objeto->getIde()}'>{$objeto->getActivoFijo()}</label></td>";
    $lista.="<td><label for='{$objeto->getIde()}'>{$objeto->getNombreEquipo()}</label></td>";
    $lista.="<td><label for='{$objeto->getIde()}'>{$objeto->getMarca()}</label></td>";
    $lista.="<td><label for='{$objeto->getIde()}'>{$objeto->getModelo()}</label></td>";
    $lista.="<td><label for='{$objeto->getIde()}'>{$objeto->getSerial()}</label></td>";    
    $lista.="<td><label for='{$objeto->getIde()}'>{$objeto->getUbicacion()}</label></td>";
    $lista.="<td>{$objeto->getRegistroInvima()}</td>";
    $lista.="<td>{$objeto->getTipoEquipo()->getTipoLista()}</td>";
    $lista.="<td>{$objeto->getTipoEquipo()->clasificacionBiomedicaLista()}</td>";
    $lista.="<td>{$objeto->getTipoEquipo()->clasificacionRiesgoLista()}</td>";
    $lista.="<td>{$objeto->getTipoEquipo()->getManualLista()}</td>";
    $lista.="<td><a href='principal.php?CONTENIDO=calibracion/administrador/reportesCalibracionPDF.php&ideEquipo={$objeto->getIde()}' class='enlace'>Reportes</a></td>";
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
<a href="principal.php?CONTENIDO=calibracion/administrador/sedesMantenimiento.php&nit=<?=$sede->getNitCliente()?>" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="listados">
    <table>
		<tr>
			<th colspan="4" class="tituloSuperior">EQUIPOS MANTENIMIENTO</th>
		</tr>
        <tr>
            <th>Cliente</th><td class="encabezado"><?=$sede->getCliente()->getNombre()?></td>
            <th>Sede</th><td class="encabezado"><?=$sede->getNombre()?></td>
        </tr>
    </table>
    <center>
    <form method="POST">
        <table>
            <tr>
                <th>Buesqueda</th>
                <td>
                    <select name="campo" class="busqueda" id="campo" onclick="deshabilitar()">
                        <option value="C" selected>--Seleccione Filtro--</option>
                        <option value="N">Equipo</option>
                        <option value="AF">Activo Fijo</option>
                        <option value="S">Serie</option>
                        <option value="U">Ubicacion</option>
                        <option value="M">Marca</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="valor" id="valor" required class="busqueda" placeholder="Buscar" disabled="true">              
                    <button type="submit" class="iconBusqueda" id="buscar" name="buscar" disabled="true"><img src="../presentacion/iconos/buscar.png" height="20px" title="Buscar"></button>
                    <a href="principal.php?CONTENIDO=calibracion/administrador/equiposSedeMntto.php&nit=<?=$sede->getide()?>"><img src="../presentacion/iconos/restaurar.png"  title="Restaurar PÃ¡gina" height="20px"></a>
                </td>
            </tr>
        </table>
    </form>
    </center>
</div>
<div id="listados">
    <table id="TableA">
        <tr>
            <th colspan="2">ACTIVO FIJO</th>
            <th >EQUIPO</th>
            <th>MARCA</th>
            <th>MODELO</th>
            <th>SERIE</th>         
            <th>UBICACION</th>     
			<th>REGISTRO INVIMA</th>
			<th>TIPO</th>
			<th>CLASIFICACION BIOMEDICA</th>
			<th>CLASIFICACION DEL RIESGO</th>
			<th>MANUAL</th>            
            <th></th>
        </tr>
        <?=$lista?>
    </table>
    <?=$falta?>
</div>
<script>
function deshabilitar() {
    var valor=document.getElementById('campo').value;
    if (valor!='C') {
        document.getElementById('buscar').disabled = false;
        document.getElementById('valor').disabled = false;
    }else{
        document.getElementById('buscar').disabled = true;
        document.getElementById('valor').disabled = true;
    }
};

</script>



