<?php
require_once dirname(__FILE__) . '/../../../clasesGenericas/Ciudad.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/Departamento.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/Persona.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cronograma.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/LugarIC.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Servicio.php';


$codDepartamento='';
$codciudad='';
$persona=new Persona('usuario', "'".$_SESSION['usuario']."'");
$extra='';
$estilo='';
$condicionLugar='';
$tipo=$persona->getUsuarioClase()->getTipo();
if ($tipo='IC'){
	$lugar=new LugarIC('ideIngeniero',"'".$persona->getIdentificacion()."'");
	switch($lugar->getNitCliente()){
		case'900597845-3'://Clínica Pabón
			$condicionLugar=" pabon='SI'";
			$estilo="style='display:none'";
			break;
		case'900077584RV'://Sede Valle
			$condicionLugar=" pabon='SI'";
			$estilo="style='display:none'";
			break;
		case'900077584-HC':// UCI Valle - Hospital San Juan de Dios 900077584-HC
			$condicionLugar=" nit='900077584-C'";
			$estilo="style='display:none'";
			break;
		case'900077584-HT'://Hospital San Jose Tuquerres 900077584-HT
			$condicionLugar=" nit='900077584-HT'";
			$estilo="style='display:none'";
			break;
	}
}


//Inicio Buscador
if (isset($_POST['codCiudad'])){
	$condicionExtra="codCiudad='".$_POST['codCiudad']."'";
        $ciudad=new Ciudad('codigo', "'".$_POST['codCiudad']."'");
        $extra='registrados en "'.$ciudad->getNombre().'"';
        $condicionExtra="ciudad.codDepartamento='".$_POST['codDepartamento']."'";
}else{
	$condicionExtra=null;
}
//Fin Buscador
        
$datos= Cliente::consultaCombinada($condicionExtra.$condicionLugar, 'nombre');
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
        $lista.="<th><a href='principal.php?CONTENIDO=mantenimiento/administrador/sedes.php&nit={$objeto->getNit()}' title='Sedes' class='enlace'>Sedes</a></th>";
    }else{
        $lista.='<th>';
        $lista.="<a href='principal.php?CONTENIDO=mantenimiento/administrador/equiposCliente.php&nit={$objeto->getNit()}' title='Equipos' class='enlace'>Equipos</a>"; 
        $lista.='</th>';
    }
    $lista.="<th><a href='principal.php?CONTENIDO=mantenimiento/administrador/clienteFormulario.php&accion=Modificar&nit={$objeto->getNit()}'><img src='../presentacion/iconos/modificar.png' height='30px' title='Modificar'></a>";
    $lista.="<img src='../presentacion/iconos/eliminar.png' onclick='eliminar(" . '"' . "{$objeto->getNit()}" . '"' . ")' height='30px' title='Eliminar'>";
 	$lista.="<img src='../presentacion/iconos/baja.png' onclick='darBaja(" . '"' . "{$objeto->getNombre()}" . '"' . ",{$objeto->getNit()})' height='30px' title='Dar de Baja Sede'></th>";    
    $lista.='</tr>';
}
if ($lista=='') {
   $falta='<h3>No hay clientes '.$extra.'</h3>';
}else{
   $falta='' ;
}

?>
<div id="listados">
    <form method="POST" name="formulario"> 
        <table <?=$estilo?>>
	<tr>
		<th colspan="4" class="tituloSuperior">CLIENTES</th>
	</tr>
            <tr>
                <th>Busqueda:</th>
                <td>
                    <select id="mySelect" class="cajon" name="codDepartamento" onchange="cargarCiudades(this.value)" required></select>
                </td>
                <td>                
                    <select id="mySelect" class="cajon" name="codCiudad"></select>
                </td>
                <th>
                    <button type="submit" class="iconBusqueda" id="buscar" name="buscar"><img src="../presentacion/iconos/buscar.png" height="20px" title="Buscar"></button>
                    <a href="principal.php?CONTENIDO=mantenimiento/administrador/clientes.php"><img src="../presentacion/iconos/restaurar.png"  title="Restaurar Página" height="20px"></a>
                </th>

            </tr>
        </table>
    </form>
    <table>
        <tr>
            <th>NIT</th>
            <th>NOMBRE</th>
            <th>DIRECCION</th>
            <th>RESPONSABLE</th>
            <th>TELEFONO</th>
            <th>CIUDAD</th>
            <th colspan="2">
                <a href="principal.php?CONTENIDO=mantenimiento/administrador/clienteFormulario.php&accion=Adicionar">
                    <img src="../presentacion/iconos/adicionar.png" height="30px" title="Adicionar">
                </a>
            </th>
        </tr>
            <?=$lista?>
    </table>
    <?=$falta?>
</div>

<div id="confirmacion" class="modalDialog">
    <div>
        <a href="#close" title="Cerrar" class="close">X</a>
			<div id="confirmacion">
        		<center>
				<h5 style='color:red'>NOTA: Recuerde al realizar esta accion eliminará; sedes, mantenimientos, cronogramas, equipos, reportes de mantenimentos y equipos de baja.</h5>
					<br>					
					<h3>Ingrese Contraseña</h3>
					<form >
					<input type="password" placeholder=""><br>
						<button>Confirmar</button>
					</form>
				</center>
			</div>
    </div>
</div>

<script src="http://pajhome.org.uk/crypt/md5/2.2/md5-min.js"></script>

<script>

    function eliminar(nit) {
		var contrasena = prompt("ADVERTENCIA: Recuerde al realizar esta accion eliminará; sedes, mantenimientos, cronogramas, equipos, reportes de mantenimentos y equipos de baja del cliente con NIT:"+nit);
		var cifrado = hex_md5(contrasena);		
		if (cifrado =="202cb962ac59075b964b07152d234b70"){
			location = 'mantenimiento/administrador/clienteActualizar.php?accion=Eliminar&nit='+nit;
		}else{
			alert("!Contraseña Incorrecta¡, Intente Nuevamente");
		}
		//if(confirm("¿Realmente desea eliminar este cliente?")){
        //    location = 'mantenimiento/administrador/clienteActualizar.php?accion=Eliminar&nit='+nit;
        //}
    }
//inicio carga de ciudades y departamentos
$("#mySelect").change(function (event) {
        if ($(this)[0].selectedIndex == 0)
        {
            $(this).prop('required', true);
            $("#txtFin").val('');
        } else
        {
            $(this).prop('required', false);
            $("#txtFin").val($("#mySelect option:selected").val());
        }
    });
    
    <?= Departamento::getDatosEnArreglosJS()?>
    cargarDepartamentos('57')
    function cargarDepartamentos(codPais) {

        document.formulario.codDepartamento.length = 0;
        document.formulario.codDepartamento.length++;
        
        document.formulario.codDepartamento.options[document.formulario.codDepartamento.length - 1].value = '';
        document.formulario.codDepartamento.options[document.formulario.codDepartamento.length - 1].text = 'Seleccione Departamento';
        
        for (var i = 0; i < departamentos.length; i++) {
            if (codPais === departamentos[i][2]) {

                document.formulario.codDepartamento.length++;
                document.formulario.codDepartamento.options[document.formulario.codDepartamento.length - 1].value = departamentos[i][0];
                document.formulario.codDepartamento.options[document.formulario.codDepartamento.length - 1].text = departamentos[i][1];
                if (departamentos[i][0] === '<?= $codDepartamento ?>') {
                    document.formulario.codDepartamento.options[document.formulario.codDepartamento.length - 1].selected = true;
                }
            }
        }
        cargarCiudades(document.formulario.codDepartamento.value);
    }  

    function cargarCiudades(codDepartamento) {
         <?= Ciudad::getDatosEnArreglosJS() ?>
        document.formulario.codCiudad.length = 0;
        document.formulario.codCiudad.length++;//aumentamos una fila para adicionar un registro

        if (document.formulario.codDepartamento.selectedIndex === 0) {
            document.formulario.codCiudad.options[document.formulario.codCiudad.length - 1].value = '';
            document.formulario.codCiudad.options[document.formulario.codCiudad.length - 1].text = 'Selecione Departamento';
        } else {
            document.formulario.codCiudad.options[document.formulario.codCiudad.length - 1].value = '';
            document.formulario.codCiudad.options[document.formulario.codCiudad.length - 1].text = 'Selecione Ciudad';
        }

        for (var i = 0; i < ciudades.length; i++) {
            if (codDepartamento === ciudades[i][2]) {
                document.formulario.codCiudad.length++;//aumentas mos una fila para adicionar una registro
                document.formulario.codCiudad.options[document.formulario.codCiudad.length - 1].value = ciudades[i][0];
                document.formulario.codCiudad.options[document.formulario.codCiudad.length - 1].text = ciudades[i][1];
                if (ciudades[i][0] === '<?= $codciudad?>') {
                    document.formulario.codCiudad.options[document.formulario.codCiudad.length - 1].selected = true;
                }
            }
        }
    }
//fin carga de ciudades y departamentos

	function darBaja(nombre,nit){
		if(confirm('¿Realmente desea dar de baja al Cliente, '+nombre+'?')){
			location = 'mantenimiento/administrador/bajaSedeActualizar.php?nit='+nit+'&accion=bajarC';
		}
	}

</script>