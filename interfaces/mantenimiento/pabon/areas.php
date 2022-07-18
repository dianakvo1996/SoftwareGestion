<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$usuario=new Usuario('usuario', "'".$_SESSION['usuario']."'");

$cliente=new Cliente('nit', "'900597845-3'");
$datos= Sede::getConsultaCombinada("nitCliente='900597845-3' ".$condicionExtra, 'nombre');
$lista='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$objeto->getNombre()}</td>";
    $lista.="<td>{$objeto->getCiudad()->getNombre()}</td>";
    $lista.="<td><a href='principal.php?CONTENIDO=mantenimiento/administrador/equiposSede.php&ideSede={$objeto->getIde()}' class='enlace'>Equipos</a>";
    $lista.="<a href='principal.php?CONTENIDO=mantenimiento/administrador/cronogramaSede.php&ideSede={$objeto->getIde()}' class='enlace'>Cronograma</a></td>";
    $lista.="<th><a href='principal.php?CONTENIDO=mantenimiento/administrador/sedeFormulario.php&accion=Modificar&nit={$cliente->getNit()}&ide={$objeto->getIde()}'><img src='../presentacion/iconos/modificar.png' height='40px' title='Modificar'></a>";
    $lista.="<img src='../presentacion/iconos/eliminar.png' onclick='eliminar({$objeto->getIde()}," . '"' . "{$cliente->getNit()}" . '"' . ")' height='40px' title='Eliminar'></th>";
    $lista.='</tr>';
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/clientes.php" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="listados">
<h1>AREAS</h1>
    <table>
        <tr>
            <th>Cliente</th><td><?=$cliente->getNombre()?></td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <th>NOMBRE</th>
            <th>CIUDAD</th>
            <th colspan="2"><a href="principal.php?CONTENIDO=mantenimiento/administrador/sedeFormulario.php&accion=Adicionar&nit=<?=$cliente->getNit()?>"><img src="../presentacion/iconos/addSede.png" height="60px" title="Adicionar"></a></th>
        </tr>
        <?=$lista?>
    </table> 
</div>
<script>
    function eliminar(ide,nitCliente) {
        if(confirm("¿Realmente desea eliminar esta Area?")){
            location = 'mantenimiento/administrador/sedeActualizar.php?accion=Eliminar&ide='+ide+'&nitCliente='+nitCliente;
         }
    }
</script>