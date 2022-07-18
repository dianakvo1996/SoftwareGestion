<?php

require_once dirname(__FILE__) . '/../../../clasesGenericas/Ciudad.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/Departamento.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';

$datos= Cliente::getDatosEnObjetos(null, 'nombre');
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
        $lista.="<th><a href='principal.php?CONTENIDO=calibracion/administrador/sedesMantenimiento.php&nit={$objeto->getNit()}' title='Sedes' class='enlace'>Sedes</a></th>";
    }else{
        $lista.='<th>';
        $lista.="<a href='principal.php?CONTENIDO=calibracion/administrador/equiposClienteMntto.php&nit={$objeto->getNit()}' title='Equipos' class='enlace'>Equipos</a>"; 
        $lista.='</th>';
    }    
    $lista.='</tr>';
}
if ($lista=='') {
   $falta='<h3>No hay clientes '.$extra.'</h3>';
}else{
   $falta='' ;
}

?>
<div id="listados">
    <table>
		<tr>
			<th colspan="7" class="tituloSuperior">CLIENTES MANTENIMIENTO</th>
		</tr>
        <tr>
            <th>NIT</th>
            <th>NOMBRE</th>
            <th>DIRECCION</th>
            <th>RESPONSABLE</th>
            <th>TELEFONO</th>
            <th>CIUDAD</th>
            <th colspan="2">
            </th>
        </tr>
            <?=$lista?>
    </table>
    <?=$falta?>
</div>

