<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/Permiso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/Persona.php';

foreach ($_GET as $Variable=> $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$persona=new Persona("usuario", "'".$usuario."'");
$datosPermiso= Permiso::getDatosEnObjeto("usuario='".$usuario."'", "ide");
$lista='';
for ($i = 0; $i < count($datosPermiso); $i++) {
    $objeto= $datosPermiso[$i];
    $permiso=$objeto->getPermiso();
    $lista.='<tr>';
    $lista.="<td>{$objeto->getProceso()->getNombre()}</td>";
    switch ($permiso) {
        case 'D':
            $lista.="<th><form method='POST' action='calidad/administrador/permisosActualizar.php?ide={$objeto->getIde()}&usuario={$usuario}'>"
                . "<input type='submit' style='background-color:rgba(15,157,15,0.3); border-radius: 5px;font-size: 17px;font-family: Cambria' id='boton' value='Descarga'></form></th>";
        break;
        case 'SL':
            $lista.="<th><form method='POST' action='calidad/administrador/permisosActualizar.php?ide={$objeto->getIde()}&usuario={$usuario}'>"
                . "<input type='submit' style='background-color:rgba(255,0,0,0.3); border-radius: 5px;font-size: 17px;font-family: Cambria' id='boton' value='Solo Lectura'></form></th>";
        break;       
    }
    $lista.='</tr>';
}
?>
<a href="principal.php?CONTENIDO=calidad/administrador/usuarios.php"><img src="../presentacion/iconos/atras.png" title="Atras" height="40px"></a>
<div id="listados">
<h3 style="text-align: center">GESTION DE PERMISOS</h3>
<h3 style="text-align: center"><?=$persona->getNombresCompletos()?></h3>
<table>
    <tr>
        <th>PROCESO</th>
        <th>PERMISO</th>
    </tr>
    <?=$lista?>
</table>
</div>

