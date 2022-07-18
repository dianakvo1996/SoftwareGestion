<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalibracion/ClienteC.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/SedeC.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Mes.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/CronogramaC.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/Ciudad.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/Departamento.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$cliente=new ClienteC('nit', "'".$nitCliente."'");
$codDepartamento='';

if ($accion=='Modificar') {
    $sede=new SedeC('ide', $ide);
    $cronograma=new CronogramaC('ideSede',$sede->getIde());
    $codDepartamento= $sede->getCiudad()->getCodDepartamento();
}else{
     $sede=new SedeC(null, null);
     $cronograma=new CronogramaC(null,null);
}

?>
<a href="principal.php?CONTENIDO=calibracion/administrador/sedes.php&nitCliente=<?=$cliente->getNit()?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="formulario">
    <center>
        <form method="POST" name="formulario" action="calibracion/administrador/sedeActualizar.php">
            <table>
                <tr>
                    <th colspan="2"><?= strtoupper($accion)?> SEDE</th>
                </tr>
                <tr>
                    <th colspan="2"><?= strtoupper($cliente->getNombre())?></th>
                </tr>            
                <tr>
                    <th>NOMBRE</th>
                    <td><input type="text" name="nombre" value="<?=$sede->getNombre()?>" required="true"></td>
                </tr>
                <tr>
                    <th>DEPARTAMENTO</th>
                    <td>
                        <select id="mySelect" class="cajon" name="codDepartamento" onchange="cargarCiudades(this.value)" required>                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>CIUDAD</th>
                    <td>
                        <select id="mySelect" class="cajon" name="codCiudad">
                            
                        </select>
                    </td>
                </tr>
                <tr>
                <th colspan="2">DATOS CRONOGRAMA</th>
            </tr>
            <tr>
                <th>Mes Calibracion</th>
                <td>
                    <select name="mes" id="mes" class="cajon" required>
                    <?=Mes::mesEnOptions($cronograma->getMes())?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Perioricidad</th>
                <td>
                    <select name="perioricidad" id="periodo" class="cajon" required>
                    <?=$cronograma->getPerioricidadOptions()?>
                    </select>
                </td>
            </tr>
                <tr>
                    <th colspan="2">
                        <input type="hidden" name="ideCronograma" value="<?=$cronograma->getIde()?>">
                        <input type="hidden" name="nitCliente"value="<?=$cliente->getNit()?>">
                        <input type="hidden" name="ide"value="<?=$sede->getIde()?>">
                        <input type="submit" name="accion" value="<?=$accion?>">
                    </th>
                </tr>
            </table>
        </form>
    </center>   
</div>
<script>
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
        document.formulario.codCiudad.length++;//aumentas mos una fila para adicionar una registro

        if (document.formulario.codDepartamento.selectedIndex === 0) {
            document.formulario.codCiudad.options[document.formulario.codCiudad.length - 1].value = '';
            document.formulario.codCiudad.options[document.formulario.codCiudad.length - 1].text = 'Seleccione Departamento';
        } else {
            document.formulario.codCiudad.options[document.formulario.codCiudad.length - 1].value = '';
            document.formulario.codCiudad.options[document.formulario.codCiudad.length - 1].text = 'Seleccione Ciudad';
        }

        for (var i = 0; i < ciudades.length; i++) {
            if (codDepartamento === ciudades[i][2]) {
                document.formulario.codCiudad.length++;//aumentas mos una fila para adicionar una registro
                document.formulario.codCiudad.options[document.formulario.codCiudad.length - 1].value = ciudades[i][0];
                document.formulario.codCiudad.options[document.formulario.codCiudad.length - 1].text = ciudades[i][1];
                if (ciudades[i][0] === '<?= $sede->getCodCiudad() ?>') {
                    document.formulario.codCiudad.options[document.formulario.codCiudad.length - 1].selected = true;
                }
            }
        }
    }
    
</script>