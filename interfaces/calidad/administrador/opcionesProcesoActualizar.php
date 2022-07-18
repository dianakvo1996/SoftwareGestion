<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/OpcionesProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/SubMenuProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/RegistroActividad.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/ConectorBD.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable => $Valor)${$Variable} = $Valor;

$datosProceso=new Proceso("ide", $ideProceso);
// registrar Actividad
date_default_timezone_set("America/Bogota");
$fechaActual= date('d-m-Y H:i:s');
$registrarActividad=new RegistroActividad(null, null);
// fin registrar Actividad
switch ($accion) {
    case 'Adicionar':
        $opcionesProceso=new OpcionesProceso(null, null);
        $opcionesProceso->setNombre($nombre);
        $opcionesProceso->setIdeProceso($ideProceso);
        $opcionesProceso->grabar();
        
        //grabar opciones submenu
        $ideOpcion= ConectorBD::ejecutarQuery("select max(ide) from opcionesproceso", null)[0][0];
        for ($i = 1; $i < 7 ; $i++) {
            if (isset($_POST["sub$i"])) {
                $subMenuProceso=new SubMenuProceso(null, null);
                $subMenuProceso->setIdeOpcion($ideOpcion);
                $subMenuProceso->setMenu($_POST["sub$i"]);
                $subMenuProceso->grabar();    
            }
        }
        //grabar opciones submenu

        break;
    case 'Modificar':
        $opcionesProceso=new OpcionesProceso("ide", $ideOpcion);
        
        //grabar registro historial
        $registrarActividad->setTabla('Subproceso');
        $registrarActividad->setAccion('Modificar');
        $registrarActividad->setRegistroAnterior($opcionesProceso->getNombre());
        
        $registrarActividad->setIdeOpcion($ideOpcion);
        $registrarActividad->setIdeProceso($ideProceso);
        $registrarActividad->setUsuario($usuarioActual);
        $registrarActividad->setFechaRealizacion($fechaActual);
        
        // fin grabar historial
        $opcionesProceso->setIdeProceso($ideProceso);
        $opcionesProceso->setNombre($nombre);
        $opcionesProceso->modificar();
        
        //grabar opciones submenu
        $subMenu=new SubMenuProceso("ideOpcion", $ideOpcion);
        $subMenu->eliminar();
        $registrarSubMenu='';
        for ($i = 1; $i < 7 ; $i++) {
            if (isset($_POST["sub$i"])) {
                $subMenuProceso=new SubMenuProceso(null, null);
                $registrarSubMenu.=",{$_POST["sub$i"]}";
                $subMenuProceso->setIdeOpcion($ideOpcion);
                $subMenuProceso->setMenu($_POST["sub$i"]);
                $subMenuProceso->grabar();    
            }
        }
        $registrarActividad->setRegistroNuevo($nombre.":".$registrarSubMenu);
        $registrarActividad->grabar();
        //fin grabar opciones submenu 
        break;
    case 'Eliminar':
        $subMenu=new SubMenuProceso("ideOpcion", $ideOpcion);
        
        $subMenu->eliminar();
        $opcionesProceso=new OpcionesProceso('ide', $ideOpcion);
        //grabar registro historial
        $registrarActividad->setTabla('Subproceso');
        $registrarActividad->setAccion('Eliminar');
        $registrarActividad->setRegistroAnterior($opcionesProceso->getNombre().', y todas las opciones');
        $registrarActividad->setIdeOpcion($ideOpcion);
        $registrarActividad->setIdeProceso($ideProceso);
        $registrarActividad->setUsuario($usuarioActual);
        $registrarActividad->setFechaRealizacion($fechaActual);
        $registrarActividad->grabar();
        // fin grabar historial
        $opcionesProceso->eliminar();
        
        break;         
}
header("Location: ../../principal.php?CONTENIDO=calidad/administrador/opcionesProceso.php&ideProceso=$ideProceso");