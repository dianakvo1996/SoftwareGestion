<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/Persona.php';

$MENSAJE='';
if (isset($_GET['MENSAJE']))
    $MENSAJE = $_GET['MENSAJE'];

$datos= Persona::getDatosEnObjetos(null,"nombres");
$lista='';

for ($i = 0; $i < count($datos); $i++) {
    
    $objeto=$datos[$i];
    $tipo=$objeto->getUsuarioClase()->getTipo();
    $lista.='<tr>';
    $lista.="<td>{$objeto->getNombresCompletos()}</td>";
    //$lista.="<td>{$objeto->getCargo()}</td>";
    $lista.="<td>{$objeto->getUsuarioClase()->getTipoLista($tipo)}</td>";
    $lista.="<td>{$objeto->getIdentificacion()}</td>";
    $lista.="<td>{$objeto->getUsuario()}</td>";
    $lista.="<td><a href='principal.php?CONTENIDO=calidad/administrador/formularioUsuario.php&accion=Modificar&identificacion={$objeto->getIdentificacion()}'><img src='../presentacion/iconos/modificar.png' title='Modificar' height='50px'></a>";
    $lista.="<img src='../presentacion/iconos/eliminar.png' height='50px' title='Eliminar' onclick='eliminar({$objeto->getIdentificacion()}," . '"' . "{$objeto->getUsuario()}" . '"' . ")'>";
    if ($tipo=='A') {
        $lista.='';
    }else{
        $lista.="<a href='principal.php?CONTENIDO=calidad/administrador/permisos.php&usuario={$objeto->getUsuario()}'><img src='../presentacion/iconos/permisos.png' height='50px' title='Permisos'></a>";
    }
    $lista.='</td>';
    $lista.='</tr>';
    
}
?>
<input type="hidden" id="usuarioActual" value="<?=$_SESSION['usuario']?>">
    <div id="listados">
        <h3><?=$MENSAJE?></h3>
        <br>
        <img src="../presentacion/iconos/usuarioGestion.png" height="100px" style="opacity: 0.8" title="Usuarios">
        <h3>GESTIÓN DE USUARIOS</h3>
        <table>
            <tr>
                <th>NOMBRE COMPLETO</th>
                <th>CARGO</th>
                <th>IDENTIFICACIÓN</th>
                <th>USUARIO</th>
                <th colspan="3">
                    <a href="principal.php?CONTENIDO=calidad/administrador/formularioUsuario.php&accion=Adicionar">
                        <img src="../presentacion/iconos/addUsuario.png" height="60px" title="Adicionar">
                    </a>
                </th>
            </tr>
            <?=$lista?>
        </table>
    </div>

<script>
    function eliminar(identificacion,usuario) {
        var usuarioActual=document.getElementById('usuarioActual').value;        
        if(usuarioActual===usuario){
            alert('Este usuario no se puede eliminar mientras tenga sesion iniciada.')
        }else{
            if (confirm('¿Realmente desea eliminar al usuario '+usuario+'?')){
               location = 'calidad/administrador/actualizarUsuario.php?accion=Eliminar&identificacion='+identificacion+'&usuario='+usuario;  
            }
        }       
    }
</script>