<fieldset>
<legend>Cadastro de Usu&aacute;rios de Acesso ao Sistema</legend>
<form method="post" action="">
<table class="table">
	<tbody>
		<tr>
			<td colspan="2"><label>Nome:</label>
	<input name="nome" type="text" id="nome" required="required" class="form-control"
	value="<?PHP echo $_POST["nome"];?>" tabindex="<?PHP echo ++$ind; ?>" size="40" />
	</td>
			<td><label>CPF:</label>
	<input name="cpf" type="text" id="cpf" tabindex="<?PHP echo ++$ind; ?>" required="required" class="form-control" value="<?PHP echo $_POST["cpf"];?>" /></td>
		</tr>
		<tr>
			<td><label>Cargo que ocupa:</label>
	<input name="cargo" type="text"  required="required" class="form-control" id="cargo" value="<?PHP echo $_POST["cargo"];?>" tabindex="<?PHP echo ++$ind; ?>"/>
	</td>
			<td><label>Senha:</label>
	<input name="senha" type="password"  required="required" class="form-control" id="senha" tabindex="<?PHP echo ++$ind; ?>" /></td>
			<td>
	<label>Confirme a Senha:</label>
	<input name="senha1" type="password"  required="required" class="form-control" id="senha1" tabindex="<?PHP echo ++$ind; ?>" /></td>
		</tr>
			<tr>
				<td colspan="3" class="info"><b>Tipo de Acesso do Usu&aacute;rio</b></td>
			</tr>
				<tr>
			  		<td><label><input type="radio" id="nivel" name="nivel" value="5" tabindex = "<?php echo ++$ind; ?>" > N&iacute;vel 1 - Consulta</label></td>
			  		<td><label><input type="radio" id="nivel" name="nivel" value="7" tabindex = "<?php echo ++$ind; ?>" > N&iacute;vel 2 - Cadastrar</label></td>
			  		<td><label><input type="radio" id="nivel" name="nivel" value="8" tabindex = "<?php echo ++$ind; ?>" > N&iacute;vel 3 - Atualizar</label></td>
		  		</tr>
		  		<tr>
			  		<td><label><input type="radio" id="semana" name="nivel" value="9" tabindex = "<?php echo ++$ind; ?>" > N&iacute;vel 4 - Apagar Registros</label></td>
			  		<td><label><input type="radio" id="semana" name="nivel" value="10" tabindex = "<?php echo ++$ind; ?>" > N&iacute;vel 5 - Administra��o</label></td>
			  		<td></td>
		  		</tr>
		  		<tr>
			  		<td><label>Departamento em que Trabalha:</label>
		<select name='setor' class='form-control' tabindex='<?php echo ++$ind; ?>'>
			<option value=''></option>
			<option value='1'>Secretaria Executiva</option>
			<option value='3'>Secretaria Miss&otilde;es</option>
			<option value='2'>Tesouraria Templo Central</option>
		</select></td>
			  		<td><label>&nbsp;</label><input type="submit" required="required" class="btn btn-primary" name="Submit" value="Cadastrar..." tabindex="<?PHP echo ++$ind; ?>"/>
  <input name="escolha" type="hidden" value="tab_auxiliar/cad_usuario.php" /></td>
			  		<td></td>
		  		</tr>
	  		</tbody>
	</table>


</form>
</fieldset>
