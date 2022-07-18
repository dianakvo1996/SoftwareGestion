<?php
require_once dirname(__FILE__) . '/../../../clasesCalibracion/SedeC.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/ClienteC.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$cliente=new ClienteC('usuario', "'".$_SESSION['usuario']."'");
$datos= SedeC::getDatosEnObjetos("nitCliente='{$cliente->getNit()}'", 'nombre asc');
$lista='';
$item=1;

for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$item}</td>";
    $lista.="<td>{$objeto->getNombre()}</td>";
    $lista.="<td>{$objeto->getCiudad()->getNombre()}</td>";
    $lista.="<td><a href='principal.php?CONTENIDO=mantenimiento/cliente/equiposSedeC.php&ideSede={$objeto->getIde()}' class='enlace'>Seleccionar</a>";
    $lista.='</tr>';
    $item++;
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/cliente/inicio.php" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="40px"></a>
<div id="listados">
    <br>
    <h2>SELECCIONE SEDE</h2> 
    <br>
    <table>
        <tr>
            <th style="width: 5%">ITEM</th>
            <th style="width: 60%">NOMBRE</th>
            <th style="width: 30%">CIUDAD</th>
            <th colspan="2" ></th>
        </tr>
        <?=$lista?>
    </table> 
</div>