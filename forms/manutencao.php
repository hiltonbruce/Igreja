<link rel="stylesheet" type="text/css" media="screen, projection" href="tabs.css" />
 <table id="Adminitração" summary="Manutenção do sistema." style="text-align: left; width: 100%;">
    <caption>
      Manutenção - Cadastro, alteração e exclusão
    </caption>
    <thead>
      <tr>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
    <tr><td class='odd'>Igreja</td>
      </tr>
    </tbody>
  </table>
  <ul class="list-inline">
  	<li>
			<form method="get" class="form-horizontal" action="">
				<input name="escolha" type="hidden" value="tab_auxiliar/cadastro_igreja.php" />
				<input name="uf" type="hidden" value="PB" />
				<input name="uf_end" type="hidden" value="PB" />
				<input type="submit" name="Submit" class="btn btn-primary btn-sm" value="Cadastrar Igreja" tabindex="<?PHP echo ++$ind;?>" />
			</form></li>
  	<li><form method="get" class="form-horizontal" action="">
				<input name="escolha" type="hidden" value="tab_auxiliar/altexclui_igreja.php" />
				<input name="uf" type="hidden" value="PB" />
				<input type="submit" name="Submit" class="btn btn-primary btn-sm" value="Alterar Excluir Igreja" tabindex="<?PHP echo ++$ind;?>" />
			</form></li>
  	<li><form method="get" class="form-horizontal" action="">
				<input name="escolha" type="hidden" value="tab_auxiliar/cadastro_bairro.php" />
				<input name="uf" type="hidden" value="PB" />
				<input type="submit" name="Submit" class="btn btn-primary btn-sm" value="Funções..." tabindex="<?PHP echo ++$ind;?>" />
			</form></li>
  	<li><form method="get" class="form-horizontal" action="">
				<input name="escolha" type="hidden" value="tab_auxiliar/cadastro_cidade.php" />
				<input name="uf" type="hidden" value="PB" />
				<input type="submit" name="Submit" class="btn btn-primary btn-sm" value="Cidade" tabindex="<?PHP echo ++$ind;?>" />
			</form></li>
  	<li><form method="get" class="form-horizontal" action="">
				<input name="escolha" type="hidden" value="tab_auxiliar/cadastro_bairro.php" />
				<input name="uf" type="hidden" value="PB" />
				<input type="submit" name="Submit" class="btn btn-primary btn-sm" value="Bairro" tabindex="<?PHP echo ++$ind;?>" />
			</form></li>
  	<li><form method="get" class="form-horizontal" action="">
				<input name="escolha" type="hidden" value="tab_auxiliar/cad_usuario.php" />
				<input name="menu" type="hidden" value="top_admusuario" />
				<input type="submit" name="Submit" class="btn btn-primary btn-sm" value="usuários" tabindex="<?PHP echo ++$ind;?>" />
			</form></li>
</ul>
      	Tabela de manutenção para administração do sistema 