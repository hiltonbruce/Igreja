<fieldset>
<legend>Cadastro de Usu&aacute;rios de Acesso ao Sistema</legend>
<form method="post" action="">
<table class="table">
	<tbody>
		<tr>
		<td colspan="2">
			<label>Nome:</label>
			<input name="nome" type="text" id="nome" required="required" class="form-control"
			value="<?PHP echo $_POST["nome"];?>" tabindex="<?PHP echo ++$ind; ?>" size="40" />
		</td>
			<td>
				<label>CPF:</label>
				<input name="cpf" type="text" id="cpf" tabindex="<?PHP echo ++$ind; ?>"
				required="required" class="form-control" value="<?PHP echo $_POST["cpf"];?>" />
			</td>
		</tr>
		<tr>
			<td>
				<label>Cargo:</label>
				<input name="cargo" type="text" required="required" class="form-control" id="cargo" value="<?PHP echo $_POST["cargo"];?>" tabindex="<?PHP echo ++$ind; ?>"/>
			</td>
			<td>
				<label>Senha:</label>
				<input name="senha" type="password"  required="required" class="form-control" id="senha" tabindex="<?PHP echo ++$ind; ?>" /></td>
			<td>
				<label>Confirme a Senha:</label>
				<input name="senha1" type="password"  required="required" class="form-control" id="senha1" tabindex="<?PHP echo ++$ind; ?>" />
			</td>
		</tr>
  	<tr>
	  	<td>
				<label>Setor de atua&ccedil;&atilde;o</label>
				<?php
					$setor = new List_setores();
					echo $setor->List_Setor(++$ind,'class="form-control"',$_SESSION['setor']);
				 ?>
			</td>
  		<td>
				<label>&nbsp;</label><input type="submit" required="required"
				 class="btn btn-primary" name="Submit" value="Cadastrar..."
				 tabindex="<?PHP echo ++$ind; ?>"/>
				<input name="escolha" type="hidden" value="tab_auxiliar/cad_usuario.php" />
				<input type="hidden" id="semana" name="nivel" value="10">
			</td>
  		<td>
			</td>
  		</tr>
	  </tbody>
	</table>
</form>
</fieldset>
