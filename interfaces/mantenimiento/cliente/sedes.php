<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$cliente=new Cliente('usuario', "'".$_SESSION['usuario']."'");
$datos= Sede::getDatosEnObjetos("nitCliente='{$cliente->getNit()}'", 'nombre');
$lista='';
$item=1;
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
if($objeto->getBaja()!='SI'){
    $lista.='<tr>';
    $lista.="<td>{$item}</td>";
    $lista.="<td>{$objeto->getNombre()}</td>";
    $lista.="<td>{$objeto->getCiudad()->getNombre()}</td>";
    $lista.="<th><a href='principal.php?CONTENIDO=mantenimiento/cliente/equiposSede.php&ideSede={$objeto->getIde()}' class='enlace'>INVENTARIO</a></th>";
    $lista.='</tr>';
    $item++;
}
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/cliente/inicio.php" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="30px"></a>
<div id="listados">
    <br>
    <h2>SELECCIONE SEDE</h2> 
    <br>
    <table>
        <tr>
            <th style="width: 5%">ITEM</th>
            <th style="">NOMBRE</th>
            <th style="">CIUDAD</th>
            <th style="width:25%"></th>
        </tr>
        <?=$lista?>
    </table> 
</div>