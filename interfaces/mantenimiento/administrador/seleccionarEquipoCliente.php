<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/MantenimientoPreventivo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$cliente=new Cliente('nit', "'{$nitCliente}'");
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
$datos= Equipo::getDatosEnObjetos("nitCliente='{$nitCliente}' $filtro", 'nombreEquipo');
$lista='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.="<tr>";
    $lista.="<td><input type='radio' onclick='confirmarSeleccion({$objeto->getIde()})' value='{$objeto->getIde()}' id='{$objeto->getIde()}' name='ideEquipo'></td>";    
    $lista.="<td><label for='{$objeto->getIde()}'>{$objeto->getActivoFijo()}</label></td>";    
    $lista.="<td><label for='{$objeto->getIde()}'>{$objeto->getNombreEquipo()}</label></td>";    
    $lista.="<td><label for='{$objeto->getIde()}'>{$objeto->getMarca()}</label></td>";    
    $lista.="<td><label for='{$objeto->getIde()}'>{$objeto->getModelo()}</label></td>";    
    $lista.="<td><label for='{$objeto->getIde()}'>{$objeto->getSerial()}</label></td>";    
    $lista.="<td><label for='{$objeto->getIde()}'>{$objeto->getUbicacion()}</label></td>";    
    $lista.='</tr>';
}
$more='';
$falta='';
if ($lista=='') {
    if (isset($_POST['valor'])) {
       $more="que coincidan  con '".$_POST['valor']."'";
    }
    $falta="<h3>No hay equipos $more</h3>";
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/mantenimientoCorrectivoCliente.php&nitCliente=<?=$cliente->getNit()?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="40px" style="float: left"></a>
<div id="listados">
    <h2>SELECCIONE EQUIPO</h2>
    <form method="POST">
        <table>
            <tr>
                <th>Búsqueda</th>
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
                </td>
                <th>
                    <button type="submit" class="iconBusqueda" id="buscar" name="buscar" disabled="true"><img src="../presentacion/iconos/buscar.png" height="20px" title="Buscar"></button>
                    <a href="principal.php?CONTENIDO=mantenimiento/administrador/seleccionarEquipoCliente.php&nitCliente=<?=$cliente->getNit()?>"><img src="../presentacion/iconos/restaurar.png"  title="Restaurar Página" height="20px"></a>
                </th>
            </tr>
        </table>
    </form>    
    <table>
        <tr>
            <th colspan="2">Activo Fijo</th>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Serial</th>
            <th>Ubicación</th>
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
    function confirmarSeleccion(ideEquipo) {
        if(confirm('¿Está Seguro de su Selección?')){
            location = 'principal.php?CONTENIDO=mantenimiento/administrador/reporteMantenimietoCorrectivo.php&ideEquipo='+ideEquipo+'&accion=Guardar';
        }
    }
</script>
