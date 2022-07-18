<?php

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/TipoDocumento.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/DocumentoGestion.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/PermisoHojaVida.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$cliente=new Cliente('nit',"'{$nitCliente}'");

$rutaActual="principal.php?CONTENIDO=calidad/administrador/documentosGestion.php&nitCliente=".$nitCliente;
$permisoHV=new PermisoHojaVida('nitCliente',"'{$nitCliente}'");

$datos=TipoDocumento::getDatosEnObjetos(null,null);
$lista='';
$item=1;
for ($i = 0; $i < count($datos); $i++) {
	$objeto=$datos[$i];
	$lista.='<tr>';
	$lista.="<td>{$objeto->getNombre()}</td>";
	$rutaDoc=$objeto->getRutaDocumento($nitCliente,$objeto->getIde());
	if($rutaDoc!=null){
		$lista.="<td><a href='../Documento_Gestion/{$rutaDoc}' target='_blank'><img src='../presentacion/imagenes/PDF_D.png' height='30px'></a></td>";
		$lista.="<td><a href='{$rutaActual}&ideTipo={$objeto->getIde()}&accion=Actualizar&ideDocumento={$objeto->getDocumentoGestion()->getIde()}#forDocumentoG' class='enlace'>ACTUALIZAR</a></td>";
	} else {
		$lista.='<td>NO DISPONIBLE</td>';
		$lista.="<td><a href='{$rutaActual}&ideTipo={$objeto->getIde()}&accion=Agregar#forDocumentoG' class='enlace'>AGREGAR</a></td>";
	}	
	$lista.='</tr>';
$item++;
}

?>
<a href="principal.php?CONTENIDO=calidad/administrador/clientes.php"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="listados">
    <h2>DOCUMENTOS DE GESTION</h2>
	<table>
		<tr>
			<th>CLIENTE</th><td><?=$cliente->getNombre()?></td>
		</tr>
	</table>
    <table>
        <tr>
            <th>NOMBRE</th>
            <th>DOCUMENTO</th>
			<th><a href="#forTipo"><img src="../presentacion/iconos/adicionar.png" height="40px"></a></th>
        </tr>
		<?=$lista?>
		<tr>
			<td>PERMISO <a href="principal.php?CONTENIDO=calidad/administrador/hojasDeVida.php">HOJAS DE VIDA PERSONAL BIOMÉDICO</a></td><td colspan="2"><?=$permisoHV->getPermisosLista($nitCliente)?></td>
		</tr>
    </table>
</div>

<!--Inicio modales-->

<div id="forTipo" class="modalDialog">
    <div>
    <a href="#close" title="Cerrar" class="close">x</a>
		<div id="formulario" style="margin:0 auto">
		<form method="POST" action="calidad/administrador/tipoDocumentoActualizar.php">
			<table style="margin:0 auto;width:94%">
				<tr>
					<th colspan="2">ADICIONAR TIPO</th>
				</tr>
				<tr>
					<th>NOMBRE:</th><td><input type="text" name="nombre" onkeyup="javascript:this.value=this.value.toUpperCase();" required></td>
				</tr>
				<tr>
					<th>SIGLA:</th><td><input type="text" name="tipoD" maxlength="5" onkeyup="javascript:this.value=this.value.toUpperCase();" required></td>
				</tr>
				<tr>
					<th colspan="2">
						<input type="submit" name="accion" value="Adicionar">
						<input type="hidden" name="nitCliente" value="<?=$nitCliente?>">
					</th>
				</tr>

			</table>
		</form>
		</div>        
    </div>
</div>
<div id="forDocumentoG" class="modalDialog">
    <div>
    <a href="#close" title="Cerrar" class="close">x</a>
		<div id="formulario" style="margin:0 auto">
		<?php $tipoDocumento=new TipoDocumento('ide',$ideTipo)?>
		<form method="POST" action="calidad/administrador/documentoActualizar.php" enctype="multipart/form-data">
			<table style="margin:0 auto;width:94%">
				<tr>
					<th colspan="2"><?=strtoupper($accion).' '.$tipoDocumento->getNombre()?></th>
				</tr>
				<tr>
					<th>ARCHIVO:</th><td><input type="file" name="archivo" accept=".pdf" required></td>
				</tr>
				<tr>
					<th colspan="2">
						<input type="submit" name="accion" value="<?=$accion?>">
						<input type="hidden" name="nitCliente" value="<?=$nitCliente?>">
						<input type="hidden" name="ideTipo" value="<?=$ideTipo?>">
						<input type="hidden" name="ideDocumento" value="<?=$ideDocumento?>">
					</th>
				</tr>
			</table>
		</form>
		</div>        
    </div>
</div>

<script>
 function addPermiso(valor,nitCliente) {
		var cadena;
		switch (valor) {
  			case '1':
    			cadena = 'MANTENIMIENTO';
    			break;
  			case '2':
    			cadena = 'CALIBRACION';
    			break;
  			case '3':
    			cadena = 'MANTENIMIENTO Y CALIBRACION';
    			break;
		}
        if(confirm("Permiso Hojas de Vida Personal "+cadena)){
			 location = 'calidad/administrador/permisoHojaVidaActualizar.php?accion=Add&permiso='+valor+'&nitCliente='+nitCliente;
		}
    }

 function upPermiso(valor,nitCliente) {
		var cadena;
		switch (valor) {
  			case '1':
    			cadena = 'MANTENIMIENTO';
    			break;
  			case '2':
    			cadena = 'CALIBRACION';
    			break;
  			case '3':
    			cadena = 'MANTENIMIENTO Y CALIBRACION';
    			break;
		}

        if(confirm("Permiso Hojas de Vida Personal "+cadena)){
			 location = 'calidad/administrador/permisoHojaVidaActualizar.php?accion=Up&permiso='+valor+'&nitCliente='+nitCliente;
		}
    }

</script>
