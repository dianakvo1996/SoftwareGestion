<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__) . '/../../../clasesCalidad/HojaDeVida.php';

$datos = HojaDeVida::getDatosEnObjetos(null, 'area,nombre asc');
$lista='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$objeto->getNombre()}</td>";
    $lista.="<td>{$objeto->getCargo()}</td>";
    $lista.="<td>{$objeto->getAreaLista()}</td>";
    $lista.="<td>{$objeto->getCiudad()->getNombre()}</td>";
    $lista.="<td><a href='../HojasDeVidaPersonal/{$objeto->getRuta()}' class='enlace' target='_blank'>Visualizar</a></td>";
    $lista.="<td><a href='principal.php?CONTENIDO=calidad/administrador/hojaDeVidaFormulario.php&accion=Modificar&ide={$objeto->getIde()}'><img src='../presentacion/iconos/modificar.png' height='30px'></a><img src='../presentacion/iconos/eliminar.png' height='30px' onclick='eliminar({$objeto->getIde()})'></td>";
    $lista.='</tr>';
}

?>
<a href="principal.php?CONTENIDO=calidad/administrador/clientes.php"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="listados">
    <h2>HOJAS DE VIDA PERSONAL BIOMÉDICO</h2>
<br>
    <table>
        <tr>
            <th>NOMBRE</th>
            <th>CARGO</th>
            <th>PROCESO</th>
            <th>CIUDAD</th>
			<th></th>
            <th><a href="principal.php?CONTENIDO=calidad/administrador/hojaDeVidaFormulario.php&accion=Adicionar"><img src="../presentacion/iconos/adicionar.png" height="40px"></a></th>
        </tr>
        <?=$lista?>
    </table>
</div>
<script>
    function eliminar(ide) {
        if(confirm("¿Realmente desea eliminar este registro?")){
            location = 'calidad/administrador/hojaDeVidaActualizar.php?accion=Eliminar&ide='+ide;
         }
    }

</script>