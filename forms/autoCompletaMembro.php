<script type="text/javascript" src="js/autocomplete.js"></script>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/autocomplete.css">

<!-- Desenvolvido por Wellington Ribeiro -->
<table class="table">
	<tbody>
		<tr>
			<td colspan="3"><label>Nome:</label>
				<input type="text" name="nome" id="campo_estado" size="40%"
				class="form-control" autofocus="autofocus"
				value='<?PHP echo $nome;?>' tabindex="<?PHP echo $ind++;?>" />
			</td><td> <label>Rol:</label> <input type="text" id="rol" name="rol"
				tabindex="<?PHP echo $ind++;?>" class="form-control"
				placeholder="N&ordm; do membro na igreja" value='<?PHP echo $rol;?>' />
			</td>
		</tr>
		<tr>
			<td colspan="4"><label>Endere&ccedil;o:</label>
			<input type="text" id="estado_val" class="form-control" name="estado"
			disabled="disabled" value='<?PHP echo $end;?>' />
			</td>
		</tr>
	</tbody>
</table>




