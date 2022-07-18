<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalibracion/ClienteC.php';

$datos= ClienteC::getDatosEnObjetos(null, 'nombre');
$lista='';

for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$objeto->getNit()}</td>";
    $lista.="<td>{$objeto->getNombre()}</td>";
    $lista.="<td>{$objeto->getDireccion()}</td>";
    $lista.="<td>{$objeto->getResponsable()}</td>";
    $lista.="<td>{$objeto->getTelefono()}</td>";
	$lista.="<td>{$objeto->getCiudad()->getNombre()}</td>";
	if ($objeto->getSede()=='S') {
        $lista.="<th><a href='principal.php?CONTENIDO=calibracion/administrador/sedes.php&nitCliente={$objeto->getNit()}' title='Sedes' class='enlace'>Sedes</a></th>";
    }else{
        $lista.='<th>';
        $lista.="<a href='principal.php?CONTENIDO=calibracion/administrador/equiposCliente.php&nitCliente={$objeto->getNit()}' title='Equipos' class='enlace'>Equipos</a>"; 
        $lista.='</th>';
    }
	$lista.="<td><a href='principal.php?CONTENIDO=calibracion/administrador/clienteFormulario.php&accion=Modificar&nit={$objeto->getNit()}'><img src='../presentacion/iconos/modificar.png' height='30px' title='Modificar'></a>";
    $lista.="<img src='../presentacion/iconos/eliminar.png' onclick='eliminar(" . '"' . "{$objeto->getNit()}" . '"' . ")' height='30px' title='Eliminar'></td>";    
    $lista.='</tr>';
}
?>
<div id="listados">
    <br>
    <h1>CLIENTES CALIBRACION</h1>
    <br>
    <table>
        <tr>
            <th>NIT</th>
            <th>NOMBRE</th>
            <th>DIRECCION</th>
            <th>RESPONSABLE</th>
            <th>TELEFONO</th>
			<th>CIUDAD</th>
            <th colspan="2">
                <a href="principal.php?CONTENIDO=calibracion/administrador/clienteFormulario.php&accion=Adicionar">
                    <img src="../presentacion/iconos/adicionar.png" height="30px" title="Adicionar">
                </a>
            </th>
        </tr>
            <?=$lista?>
    </table>
</div>
</div>
<script>
	 function eliminar(nit) {
        if(confirm("¿Realmente desea eliminar este cliente?")){
            location = 'calibracion/administrador/clienteActualizar.php?accion=Eliminar&nit='+nit;
         }
    }
</script>

