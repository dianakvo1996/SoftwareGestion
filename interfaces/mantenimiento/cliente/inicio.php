<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
$cliente=new Cliente('usuario',"'".$_SESSION['usuario']."'");
$opciones='';
switch ($cliente->getSede()) {
    case 'S':
        $opciones.='<a href="principal.php?CONTENIDO=mantenimiento/cliente/seleccionSedeCorrectivo.php">Solicitar Correctivo</a>';
        $opciones.='<a href="principal.php?CONTENIDO=mantenimiento/cliente/seleccionSede.php">Consolidado Correctivos</a>';
        $opciones.='<a href="principal.php?CONTENIDO=mantenimiento/cliente/sedes.php">Inventario Mantenimiento</a>';
		$opciones.='<a href="principal.php?CONTENIDO=mantenimiento/cliente/sedesC.php">Inventario Calibracion</a>';
		$opciones.='<a href="principal.php?CONTENIDO=mantenimiento/cliente/documentosGestion.php">Documentos de Gestion</a>';        
        break;
    case 'N':
        $opciones.='<a href="principal.php?CONTENIDO=mantenimiento/cliente/seleccionarEquipoCliente.php">Solicitar Correctivo</a>';
        $opciones.='<a href="principal.php?CONTENIDO=mantenimiento/cliente/solicitudesCorrectivo.php">Consolidado Correctivos</a>';
        $opciones.='<a href="principal.php?CONTENIDO=mantenimiento/cliente/equiposCliente.php">Inventario Mantenimiento</a>';  
		$opciones.='<a href="principal.php?CONTENIDO=mantenimiento/cliente/equiposClienteC.php">Inventario Calibracion</a>';   
		$opciones.='<a href="principal.php?CONTENIDO=mantenimiento/cliente/documentosGestion.php">Documentos de Gestion</a>';
        break;

}
$nitCooemssanar = substr($cliente->getNit(), 0, 9);  // devuelve "900077584"
switch($nitCooemssanar){
	case '900077584':
		$imagenLogo='logoCooemssanar.png';
	break;
	default:
		$imagenLogo='logo_quality.png';
	break;
}
?>
<div class="saludoCliente">
    <h2>Bienvenido</h2>
    <h3><?=$cliente->getNombre()?></h3>
    <img src="../presentacion/iconos/<?=$imagenLogo?>" height="100px">
    <?=$opciones?>    
</div>


