<script type="text/javascript" src="js/autocomplete.js"></script>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/autocomplete.css">

<!-- Desenvolvido por Wellington Ribeiro -->
<table class="table">
	<tbody>
		<tr>
			<td colspan="3"><label>Nome:</label>
				<input type="text" name="nome" id="campo_estado" size="40%" class="form-control" autofocus="autofocus" />
				<input type="hidden" name="escolha" value="adm/rest_busca.php">
			</td><td> <label>Rol:</label> <input type="text" id="rol" name="rol"
						value="" class="form-control" placeholder="N&ordm; do membro na igreja" /> 
			</td>
		</tr>
		<tr>
			<td colspan="4"><label>Endereço:</label>
			<input type="text" id="estado_val" class="form-control" name="estado" disabled="disabled" value="" />
			</td>
		</tr>
	</tbody>
</table>
<script type="text/javascript">
	new Autocomplete("campo_estado", function() {
		this.setValue = function( fone, nome, celular, igreja, rol,cpf,rg ) {
			$("#id_val").val(fone);
			$("#estado_val").val(nome);
			$("#cel").val(celular);
			$("#igreja_val").val(igreja);
			$("#rol").val(rol);
			$("#cpf").val(cpf);
			$("#rg").val(rg);
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick )
			return ;
		return "models/autoMembroCargos.php?q=" + this.value;
	});
</script>

	
	
	
