<script type="text/javascript" src="js/autocomplete.js"></script>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/autocomplete.css">
<?php 
	if (empty($formCampos)) {
		$formCampos='';
	}
?>
<!-- Desenvolvido por Wellington Ribeiro -->
<form method="get" name="autocompletar" action="">
<table style="background-color:#D3D3D3;">
	<caption style="text-align: left; font-weight:bold">Busca por nome do Membro</caption>
	<tbody>
		<tr>
			<td colspan="3"><label>Nome:</label>
				<input type="text" name="nome" id="campo_estado" size="40%" class="form-control" />
				<input type="hidden" name="escolha" value="adm/rest_busca.php">
			</td><td><label>&nbsp;</label>
			<input type="submit" class="btn btn-primary btn-sm" name="listar" value="Listar dados...">
			</td>
		</tr>
		<tr>
			<td colspan="2"><label>Endereço:</label> 
			<input type="text" id="estado_val" class="form-control" name="estado" value="" size="30%" />
			</td>
			<td><label>Fone:</label>
			<input type="text" id="id_val" name="id" class="form-control" value="" /></td>
			<td><label>Celular:</label>
			<input type="text" id="sigla_val" class="form-control" name="sigla" value="" /></td>
		</tr>
		<?php 
			echo $formCampos;
		?>
	</tbody>
</table>
</form>

<script type="text/javascript">
	new Autocomplete("campo_estado", function() {
		this.setValue = function( rol, nome, celular ) {
			$("#id_val").val(rol);
			$("#estado_val").val(nome);
			$("#sigla_val").val(celular);
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick )
			return ;
		return "models/autocomplete.php?q=" + this.value;
	});
</script>
	
	
	
