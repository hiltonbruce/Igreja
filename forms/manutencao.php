<ul class="list-inline">
	<li>
		<form method="get" class="form-horizontal" action="">
			<input name="escolha" type="hidden" value="tab_auxiliar/cadastro_igreja.php" />
			<input name="uf" type="hidden" value="PB" />
			<input name="uf_end" type="hidden" value="PB" />
			<input type="submit" name="Submit" class="btn btn-info btn-sm" value="Cadastrar Igreja" tabindex="<?PHP echo ++$ind;?>" />
		</form></li>
	<li><form method="get" class="form-horizontal" action="">
			<input name="escolha" type="hidden" value="tab_auxiliar/altexclui_igreja.php" />
			<input name="uf" type="hidden" value="PB" />
			<input type="submit" name="Submit" class="btn btn-info btn-sm" value="Alterar Excluir Igreja" tabindex="<?PHP echo ++$ind;?>" />
		</form></li>
	<li><form method="get" class="form-horizontal" action="">
			<input name="escolha" type="hidden" value="controller/administracao.php" />
			<input name="cad" type="hidden" value="1" />
			<input type="submit" name="Submit" class="btn btn-info btn-sm" value="Fun&ccedil;&otilde;es..." tabindex="<?PHP echo ++$ind;?>" />
		</form></li>
	<li><form method="get" class="form-horizontal" action="">
			<input name="escolha" type="hidden" value="tab_auxiliar/cadastro_cidade.php" />
			<input name="uf" type="hidden" value="PB" />
			<input type="submit" name="Submit" class="btn btn-info btn-sm" value="Cidade" tabindex="<?PHP echo ++$ind;?>" />
		</form></li>
	<li><form method="get" class="form-horizontal" action="">
			<input name="escolha" type="hidden" value="tab_auxiliar/cadastro_bairro.php" />
			<input name="uf" type="hidden" value="PB" />
			<input type="submit" name="Submit" class="btn btn-info btn-sm" value="Bairro" tabindex="<?PHP echo ++$ind;?>" />
		</form></li>
	<li><form method="get" class="form-horizontal" action="">
			<input name="escolha" type="hidden" value="tab_auxiliar/cad_usuario.php" />
			<input name="menu" type="hidden" value="top_admusuario" />
			<input type="submit" name="Submit" class="btn btn-info btn-sm" value="usu&aacute;rios" tabindex="<?PHP echo ++$ind;?>" />
		</form></li>
</ul>
