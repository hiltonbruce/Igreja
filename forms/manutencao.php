<link rel="stylesheet" type="text/css" media="screen, projection" href="tabs.css" />
 <table id="Adminitração" summary="Manutenção do sistema." style="text-align: left; width: 100%;">
    <caption>
      Manutenção - Inserção, alteração e exclusão
    </caption>
    <thead>
      <tr>
        <th scope="col" colspan="3"></th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="3">Tabela de manutenção para administração do sistema </td>
      </tr>
    </tfoot>
    <tbody>
    <tr><td colspan="3" class='odd'>Igreja</td></tr>
    <tr>
    	<td>
			<form method="get" action="">
				<input name="escolha" type="hidden" value="tab_auxiliar/cadastro_igreja.php" />
				<input name="uf" type="hidden" value="PB" />
				<input name="uf_end" type="hidden" value="PB" />
				<input type="submit" name="Submit" value="Cadastrar Igreja" tabindex="<?PHP echo ++$ind;?>" />
			</form>
    	</td>
    	<td>
    		<form method="get" action="">
				<input name="escolha" type="hidden" value="tab_auxiliar/altexclui_igreja.php" />
				<input name="uf" type="hidden" value="PB" />
				<input type="submit" name="Submit" value="Alterar Excluir Igreja" tabindex="<?PHP echo ++$ind;?>" />
			</form>
    	</td>
    	<td>
    		<form method="get" action="">
				<input name="escolha" type="hidden" value="tab_auxiliar/cadastro_bairro.php" />
				<input name="uf" type="hidden" value="PB" />
				<input type="submit" name="Submit" value="Funções..." tabindex="<?PHP echo ++$ind;?>" />
			</form>
    	</td>
    </tr>
    <tr><td colspan="3" class='odd'>Endereçamento</td></tr>
      <tr>
        <td>
		    <form method="get" action="">
				<input name="escolha" type="hidden" value="tab_auxiliar/cadastro_cidade.php" />
				<input name="uf" type="hidden" value="PB" />
				<input type="submit" name="Submit" value="Cidade" tabindex="<?PHP echo ++$ind;?>" />
			</form>
		</td>
        <td>
		    <form method="get" action="">
				<input name="escolha" type="hidden" value="tab_auxiliar/cadastro_bairro.php" />
				<input name="uf" type="hidden" value="PB" />
				<input type="submit" name="Submit" value="Bairro" tabindex="<?PHP echo ++$ind;?>" />
			</form>
        </td>
        <td>
        	
        </td>
      </tr>
    <tr><td colspan="3" class='odd'>Cadastro de Usuários para acesso ao Sistema</td></tr>
      <tr>
    	<td>
    		<form method="get" action="">
				<input name="escolha" type="hidden" value="tab_auxiliar/cad_usuario.php" />
				<input name="menu" type="hidden" value="top_admusuario" />
				<input type="submit" name="Submit" value="usuários" tabindex="<?PHP echo ++$ind;?>" />
			</form>
    	</td>
      	
      </tr>
    </tbody>
  </table>