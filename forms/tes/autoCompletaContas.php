<table class='table'>
	<tbody>
		<tr>
			<td colspan="3"><label>Conta:</label>
				<input type="text" name="conta" class="form-control"
				id="campo_estado" value="<?PHP echo $nomeCred;?>" tabindex="<?PHP echo ++$ind; ?>" />
			</td>
		</tr>
		<tr>
			<td>
				<label>C&oacute;digo/tipo:</label>
				<input type="text" id="estado_val" class="form-control"
				name="estado_val" disabled="disabled" value="" />
			</td>
			<td>
				<label>Saldo Atual:</label>
				<input type="text" id="id_val" name="id" class="form-control"
				disabled="disabled" value="" /></td>
			<td>
				<label>C&oacute;digo de acesso:</label>
				<input type="text" id="acesso" name="acessoDebitar" class="form-control"
				value="<?PHP echo $cred;?>" tabindex="<?PHP echo ++$ind; ?>" />
			</td>
		</tr>
		<tr>
			<td colspan="3">Descri&ccedil;&atilde;o:<br />  <input type="text" size="78%" id="detalhe" name="det"
				disabled="disabled" class="form-control" /></td>
		</tr>
	</tbody>
</table>
<script type="text/javascript">
	new Autocomplete("campo_estado", function() {
		this.setValue = function( rol, nome, celular,detalhe ) {
			$("#id_val").val(rol);
			$("#estado_val").val(nome);
			$("#acesso").val(celular);
			$("#detalhe").val(detalhe);
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick )
			return ;
		return "models/tes/autoCompletaContas.php?q=" + this.value;
	});
</script>
