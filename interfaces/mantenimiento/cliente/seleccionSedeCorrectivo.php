<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$datosCliente=new Cliente('usuario', "'".$_SESSION['usuario']."'");
$datos= Sede::getDatosEnObjetos("nitCliente='".$datosCliente->getNit()."'", 'nombre asc');
$lista='';
$item=1;
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
if($objeto->getBaja()!='SI'){

    $lista.='<tr>';
    $lista.="<td>{$item}</td>";
    $lista.="<td>{$objeto->getNombre()}</td>";
    $lista.="<td>{$objeto->getCiudad()->getNombre()}</td>";
    $lista.="<td><a href='principal.php?CONTENIDO=mantenimiento/cliente/seleccionarEquipoSede.php&ideSede={$objeto->getIde()}' class='enlace'>Selecccionar</a>";
    $lista.='</tr>';
    $item++;
}
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/cliente/inicio.php" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="25px"></a>
<div id="listados"> 
    <table>
	<tr>
		<th class="tituloSuperior" colspan="4">SELECCION DE SEDE</th>
	</tr>
        <tr>
            <th style="width: 5%">Item</th>
            <th>NOMBRE</th>
            <th>CIUDAD</th>
            <th></th>
        </tr>
        <?=$lista?>
    </table>
</div>
<script>
    function confirmarSeleccion(ideSede) {
        if(confirm('¿Está Seguro de su Selección?')){
            location = 'principal.php?CONTENIDO=mantenimiento/cliente/solicitudesCorrectivoSede.php&ideSede='+ideSede;
        }
    }
</script>