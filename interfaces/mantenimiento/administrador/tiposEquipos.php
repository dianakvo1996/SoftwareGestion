<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/TipoEquipo.php';

//Inicio Busqueda
$filtro=null;
$valor='';
if (isset($_POST['buscar'])){
    $valor=$_POST['nombreEquipo'];
$restocadena="";
    //$filtro=" nombre ilike '%{$valor}%'";
    $filtro="TRANSLATE(nombre,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ilike translate('%{$valor}%','ÁÉÍÓÚáéíóú','AEIOUaeiou')";
}
//Fin Busqueda
$datos= TipoEquipo::getDatosEnObjetos($filtro, 'nombre');
$lista='';
$prueba='';
$item=1;
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
	$numeroEquipo=ConectorBD::ejecutarQuery("select count(ide) from equipo where nombreEquipo='{$objeto->getNombre()}'",null)[0][0];
    $lista.='<tr>';
    //$lista.="<td>{$objeto->getIde()}</td>";
    $lista.="<td>{$item}</td>";
    $lista.="<td>{$objeto->getNombre()}</td>";
    $lista.="<td>{$objeto->getCalibrableLista()}</td>";
    $lista.="<td>{$objeto->getTipoLista()}</td>";
    $lista.="<td style='text-align:left'>".$objeto->getRutinaLista()."</td>";
    $lista.="<td><a href='principal.php?CONTENIDO=mantenimiento/administrador/rutinaExtra.php&ideTipoEquipo={$objeto->getIde()}'><img src='../presentacion/iconos/rutinaExtra.png' height='30px' title='Rutina Extra'></a>";
	$lista.="<a href='principal.php?CONTENIDO=mantenimiento/administrador/recomendaciones.php&ideTipoEquipo={$objeto->getIde()}'><img src='../presentacion/iconos/recomendacionesFabircante.png' height='30px' title='Recomendaciones Fabricante'></a>";
    $lista.="<a href='principal.php?CONTENIDO=mantenimiento/administrador/tipoEquipoFormulario.php&accion=Modificar&ide={$objeto->getIde()}'><img src='../presentacion/iconos/modificar.png' height='30px'></a>";
    $lista.="<img src='../presentacion/iconos/eliminar.png' height='30px' onclick='eliminar({$objeto->getIde()})'></td>";
    $lista.='</tr>';
    $item++;
}
?>
<div id="listados">
    <img src="../presentacion/iconos/Rutina2.png" title="Clientes" height="100px">
    <form method="POST">
        <table>
            <tr>
                <th>Búsqueda</th>
                <td>
                    <input type="text" placeholder="Nombre Equipo" name="nombreEquipo" required class="busqueda">
                    <button type="submit" class="iconBusqueda" id="buscar" name="buscar" ><img src="../presentacion/iconos/buscar.png" height="20px" title="Buscar"></button>
                    <a href=""><img src="../presentacion/iconos/restaurar.png"  title="Restaurar Página" height="20px"></a>
		</td>
		<td>
		    <a href="mantenimiento/administrador/exportarRutinaWord.php"><img src="../presentacion/iconos/descargarWord.png"  title="Descargar Rutinas" height="40px"></a>
		</td>
                
            </tr>
        </table>
    </form>
    <table>
        <tr>
            <th style="width: 15px"></th>
            <th style="width: 95px">Nombre</th>
            <th style="width: 95px">Calibrable</th>
            <th style="width: 180px">Tipo</th>
            <th>Rutinas</th>            
            <th colspan="2"><a href="principal.php?CONTENIDO=mantenimiento/administrador/tipoEquipoFormulario.php&accion=Adicionar"><img src="../presentacion/iconos/adicionar.png" height="40px"></a></th>
        </tr>
        <?=$lista?>
    </table>
</div>
<div id="importacion">
    <form method="POST" action="mantenimiento/administrador/importarRutina.php" enctype="multipart/form-data">
        <strong>IMPORTAR RUTINAS: &nbsp;&nbsp; </strong>
        <input type="file" required="true" accept=".xls" name="rutina" class="file">
        <input type="hidden" name="ideSede" value="">
        <input type="submit" name="importar" value="Importar" class="boton">&nbsp;&nbsp;&nbsp;&nbsp;<strong style="font-size: 12px">*Archivo excel no mayor a 2MG*</strong>
    </form>
</div>
<script>
    function eliminar(ide) {
    if(confirm('¿Realmente desea eliminar?')){
        location = 'mantenimiento/administrador/tipoEquipoActualizar.php?accion=Eliminar&ide='+ide;
    }
}
</script>
