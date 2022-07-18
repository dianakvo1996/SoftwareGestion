<?php

require_once dirname(__FILE__) . '/../../../clasesCalidad/Persona.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/LugarIC.php';

$datos= Persona::getDatosEnObjetos(null,null);
$lista='';
$color='';
for ($i = 0; $i < count($datos); $i++) {    
    $objeto=$datos[$i];
    $tipo=$objeto->getUsuarioClase()->getTipo();
    $acceso=$objeto->getUsuarioClase()->getAcceso();
	if($acceso=='N'){
		$color="style='color:red'";
	}else{
		$color='';
	}
	if($tipo=='IM' or $tipo=='IC' or $tipo=='CM'){
		$lista.='<tr>';
    	$lista.="<td {$color}>{$objeto->getIdentificacion()}</td>";
    	$lista.="<td>{$objeto->getNombresCompletos()}</td>";    
    	$lista.="<td>{$objeto->getUsuario()}</td>";
    	$lista.="<td>".$objeto->getUsuarioClase()->getTipoLista($tipo)."</td>";
		$lista.="<td>".LugarIC::getLugarLista($objeto->getIdentificacion())."</td>";
    	$lista.="<td><a href='principal.php?CONTENIDO=mantenimiento/administrador/usuarioFormulario.php&accion=Modificar&identificacion={$objeto->getIdentificacion()}'><img src='../presentacion/iconos/modificar.png' title='Modificar' height='30px'></a>";
		$lista.="<a href='principal.php?CONTENIDO=mantenimiento/administrador/firmaIngForm.php&ideIng={$objeto->getIdentificacion()}'><img src='../presentacion/iconos/icoFirma.png' title='Firma' height='30px'></a>";
    $lista.="<img src='../presentacion/iconos/eliminar.png' height='30px' title='Eliminar' onclick='eliminar({$objeto->getIdentificacion()}," . '"' . "{$objeto->getUsuario()}" . '"' . ")'>";
    $lista.="<img src='../presentacion/iconos/acceso.png' height='30px' title='Restringir Acceso' onclick='quitarAcceso(" . '"' . "{$objeto->getUsuario()}" . '"' . ")'>";
    $lista.='</td>';
    $lista.='</tr>';	
	}
    
}
?>
<div id="listados">
    <h2>GESTION DE USUARIOS</h2>
<table>
    <tr>
	<th>IDENTIFICACIÓN</th>
	<th>NOMBRE COMPLETO</th>
	<th>USUARIO</th>
	<th>TIPO</th>
	<th>LUGAR</th>
	<th><a href="principal.php?CONTENIDO=mantenimiento/administrador/usuarioFormulario.php&accion=Adicionar" class="enlace">Adicionar</a></th>
    </tr>
<?=$lista?>
</table>
</div>
<script>
    function eliminar(identificacion,usuario) {
    	if (confirm('¿Realmente desea eliminar al usuario '+usuario+'?')){
        	location = 'mantenimiento/administrador/usuarioActualizar.php?accion=Eliminar&identificacion='+identificacion+'&usuario='+usuario;  
            
        }       
    }

	function quitarAcceso(usuario){
		if(confirm('Se restringira el acceso al usuario: '+usuario)){
			location = 'mantenimiento/administrador/accesoActualizar.php?accion=Quitar&usuario='+usuario;
		}
	}
</script>