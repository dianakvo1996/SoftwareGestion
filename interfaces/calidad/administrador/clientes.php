<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';

$datos = Cliente::getDatosEnObjetos(null, 'nombre asc');
$lista = '';
$item=1;
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$item}</td>";
    $lista.="<td>{$objeto->getNit()}</td>";
    $lista.="<td>{$objeto->getNombre()}</td>";
    $lista.="<td>{$objeto->getDireccion()}</td>";
    $lista.="<td>{$objeto->getResponsable()}</td>";
    $lista.="<td>{$objeto->getTelefono()}</td>";
    $lista.="<td><a href='principal.php?CONTENIDO=calidad/administrador/documentosGestion.php&nitCliente={$objeto->getNit()}' class='enlace'>Documentos</a></td>";
    $lista.='</tr>';
    $item++;
}
?>
<div id="listados">
    <h2>SELECCIONAR CLIENTE</h2>
    <table>
		<tr>
			<th colspan="7"><a href="principal.php?CONTENIDO=calidad/administrador/hojasDeVida.php" class="enlace">HOJAS DE VIDA PERSONAL BIOMEDICO</a></th>
		</tr>

        <tr>
            <th colspan="2">NIT</th>
            <th>NOMBRE</th>
            <th>DIRECCION</th>
            <th>RESPONSABLE</th>
            <th>TELEFONO</th>
			<th></th>
        </tr>
        <?=$lista?>
    </table>

</div>

