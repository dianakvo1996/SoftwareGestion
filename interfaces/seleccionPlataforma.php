<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * onclick="return false"
 *  */

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;
$opciones='';
switch ($_SESSION['tipo']) {
    case 'A':
        $opciones.='<section><a href="principal.php?CONTENIDO=calidad/administrador/inicio.php">Gestión de Calidad</a></section>';
        $opciones.='<section><a href="principal.php?CONTENIDO=mantenimiento/administrador/clientes.php">Mantenimiento</a></section>';
        $opciones.='<section><a href="principal.php?CONTENIDO=calibracion/administrador/clientes.php">Calibración</a></section>';
     break;
    case 'CC':
        $opciones.='<section><a href="principal.php?CONTENIDO=calidad/otro/inicio.php">Gestión de Calidad</a></section>';
        $opciones.='<section><a href="principal.php?CONTENIDO=calibracion/administrador/clientes.php">Calibración</a></section>';
     break;
    case 'CM':
        $opciones.='<section><a href="principal.php?CONTENIDO=calidad/otro/inicio.php">Gestión de Calidad</a></section>';
        $opciones.='<section><a href="principal.php?CONTENIDO=mantenimiento/administrador/clientes.php">Mantenimiento</a></section>';
     break;
     case 'IM':
        $opciones.='<section><a href="principal.php?CONTENIDO=calidad/otro/inicio.php">Gestión de Calidad</a></section>';
        $opciones.='<section><a href="principal.php?CONTENIDO=mantenimiento/administrador/clientes.php">Mantenimiento</a></section>';
     break;
	case 'IC':
        $opciones.='<section><a href="principal.php?CONTENIDO=calidad/otro/inicio.php">Gestión de Calidad</a></section>';
        $opciones.='<section><a href="principal.php?CONTENIDO=mantenimiento/administrador/clientes.php">Mantenimiento</a></section>';
     break;
	case 'M':
        $opciones.='<section><a href="principal.php?CONTENIDO=calidad/otro/inicio.php">Gestión de Calidad</a></section>';
        $opciones.='<section><a href="principal.php?CONTENIDO=calibracion/administrador/clientes.php">Calibracion</a></section>';
     break;


    case 'O':
        $direccionC='otro';
        $direccionM='otro/inicio.php';
        $direccionCA='administrador/clientes.php';
     break;

}
?>
<div class="seleccionPlataforma">
            <?=$opciones?>
</div>
<div class="marcaDeAgua">
    <img src="../presentacion/imagenes/logo_quality.png" title="Quality System Ingenieria Biomedica">   
</div>