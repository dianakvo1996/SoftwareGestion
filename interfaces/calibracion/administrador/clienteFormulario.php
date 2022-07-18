<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalibracion/ClienteC.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/CronogramaC.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Mes.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/Ciudad.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/Departamento.php';


foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$auxiliar='';
$codDepartamento='';

if ($accion=='Modificar') {
    $cliente=new ClienteC("nit","'".$nit."'");
    $cronograma=new CronogramaC('nitCliente',"'".$nit."'");
	$codDepartamento=$cliente->getCiudad()->getCodDepartamento();
	echo $codDepartamento;
    if ($cliente->getSede()=='S') $auxiliar='checked';
}else{
    $cliente=new ClienteC(null,null);
    $cronograma=new CronogramaC(null,null);
}
?>
<a href="principal.php?CONTENIDO=calibracion/administrador/clientes.php"><img src="../presentacion/iconos/atras.png" title="Volver" height="30px"></a>
<div id="formulario">
    <center>
        <form method="POST" name="formulario" action="calibracion/administrador/clienteActualizar.php" onclick="habilitar()">
        
        <table>
            <tr>
                <th  colspan="3"><?= strtoupper($accion)?> CLIENTE</th>
            </tr>
            <tr>
                <th>NIT:</th>
                <td colspan="2"><input type="text" autofocus name="nit" onchange="datosAcceso()" id="nit" value="<?=$cliente->getNit()?>" required="true"></td>
            </tr>
            <tr>
                <th>NOMBRE:</th>
                <td colspan="2"><input type="text" name="nombre" onchange="datosAcceso()" id="razon" value="<?=$cliente->getNombre()?>" required="true"></td>
            </tr>
            <tr>
                <th>DIRECCION:</th>
                <td colspan="2"><input type="text" name="direccion" value="<?=$cliente->getDireccion()?>" required="true"></td>
            </tr>
            <tr>
            <tr>
                <th>DEPARTAMENTO:</th>
                <td>
                    <select id="mySelect" class="cajon" name="codDepartamento" onchange="cargarCiudades(this.value)" required>                            
                    </select>
                </td>
            </tr>
            <tr>
                <th>CIUDAD:</th>
                <td>
                    <select id="mySelect" class="cajon" name="codCiudad"></select>
                </td>
            </tr>

                <th>RESPONSABLE:</th>
                <td colspan="2"><input type="text" name="responsable" value="<?=$cliente->getResponsable()?>" required="true"></td>
            </tr>
            <tr>
                <th>TELEFONO:</th>
                <td colspan="2"><input type="tel" name="telefono"  value="<?=$cliente->getTelefono()?>" required="true"></td>
            </tr>
            <tr>
                <th>SEDES:</th>
                <td><input type="checkbox" class="check" id="sede" onclick="habilitar()" <?=$auxiliar?> name="sede" value="S"></td>
            </tr>
            <tr>
                <th colspan="2">DATOS CRONOGRAMA</th>
            </tr>
            <tr>
                <th>Mes de Calibración</th>
                <td>
                    <select name="mes" id="mes" class="cajon">
                    <?= Mes::mesEnOptions($cronograma->getMes())?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Perioricidad</th>
                <td>
                    <select name="perioricidad" id="periodo" class="cajon">
                    <?=$cronograma->getPerioricidadOptions()?>
                    </select>
                </td>
            </tr>
            <tr>
                <th colspan="3">
                    <input type="hidden" name="usuarioAnterior" value="<?=$cliente->getUsuario()?>">
                    <input type="hidden" name="ideCronograma" value="<?=$cronograma->getIde()?>">
                    <input type="hidden" name="nitAnterior" value="<?=$cliente->getNit()?>">
                    <input type="submit" name="accion" value="<?=$accion?>">
                </th>
            </tr>
        </table>
    </form>
        <h3>Datos de Acceso:</h3>
        <label><strong>Usuario: </strong><span id="usuario"></span></label><br>
        <label><strong>Contraseña: </strong><span id="clave"></span></label>
    </center>
</div>
<script>
    function habilitar(){
        if (document.getElementById('sede').checked) {
            document.getElementById('mes').disabled = true;
            document.getElementById('periodo').disabled = true;
        }else{
            document.getElementById('mes').disabled = false;
            document.getElementById('periodo').disabled = false;
        }   
    }
    function datosAcceso() {
    var usuario=document.getElementById('razon').value;
    var clave=document.getElementById('nit').value;
    document.getElementById('usuario').innerHTML = usuario
    document.getElementById('clave').innerHTML = clave
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
                if (ciudades[i][0] === '<?= $cliente->getCodCiudad() ?>') {
                    document.formulario.codCiudad.options[document.formulario.codCiudad.length - 1].selected = true;
                }
            }
        }
    }
//fin carga de ciudades y departamentos

</script>