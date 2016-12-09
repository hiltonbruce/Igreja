<div id="lst_cad">
	<?PHP
		if ($arr_dad->rol()!='') {
	?>
	<table class='table'>
	  <tr>
	    <td>Profiss&atilde;o:
				<?PHP
				$nome = new editar_form("profissao",$arr_dad->profissao(),$tab,$tab_edit);
				$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
				?>
			</td>
	    <td>CPF:
				<?PHP
				$nome = new editar_form("cpf",$arr_dad->cpf(),$tab,$tab_edit);
				$nome->getMostrar();
				if ($_GET["campo"]=="cpf") { ?>
				<script language="JavaScript" type="text/javascript">
				alert("Cuidado! O sistema atualizará o CPF, mesmo se o número for considerado INVÁLIDO...");
				</script>
					<form method="post" action="">
					<div class="row">
					  <div class="col-xs-5">
							<input name='cpf' id='cpf' class="form-control" autofocus="autofocus"
							value="<?PHP echo $arr_dad->cpf();?>" tabindex="<?PHP echo $ind++;?>" />
				  	</div>
					  <div class="col-xs-2">
							<input type="hidden" name="tabela" value="profissional" />
							<input type="hidden" name="campo" value="cpf" />
							<input type="hidden" name="cpf_atual" value="<?PHP echo $arr_dad->cpf();?>" />
							<input type="hidden" name="escolha" value="adm/atualizar_dados.php" />
							<input name="bsc_rol" type="hidden" id="campo" value="<?PHP echo $bsc_rol;?>" />
							<input type="hidden" name="menu" value="top_dados" />
							<input type="submit" class="btn btn-primary btn-sm" name="submit"
							value="Alterar CPF ..." tabindex="<?PHP echo $ind++;?>"/>
					  </div>
				</div>
					<div class="alert alert-danger alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
						<span class="glyphicon glyphicon-alert" aria-hidden="true"></span><strong> Cuidado!</strong>
						<br /> Voc&ecirc; ser&aacute; avisado, porem, o sistema atualizar&aacute; o CPF,
						 mesmo se o n&uacute;mero for considerado INV&Aacute;LIDO...
					</div>
				</div>
			</form>
			<?PHP
			}
			?>
		</td>
    <td>Identidade:
		<?PHP
		$nome = new editar_form("rg",$arr_dad->rg(),$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
		?>
		</td>
  </tr>
  <tr>
    <td>Org&atilde;o expedidor:
		<?PHP
		$nome = new editar_form("orgao_expedidor",$arr_dad->orgao_expedidor(),$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
		?>
		</td>
		<td colspan="2">Empresa onde Trabalha:
		<?PHP
		$nome = new editar_form("onde_trabalha",$arr_dad->onde_trabalha(),$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
		?>
		</td>
  </tr>
  <tr>
    <td colspan="3">Observa&ccedil;&otilde;es
		<?PHP
		$nome = new editar_form("obs",$arr_dad->obs(),$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
		?>
		</td>
	</tr>
</table>
		<div class="alert alert-info" role="alert">
		<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
		Cadastro realizado por: <?php echo $arr_dad->hist().' em: '.$arr_dad->dt_cadastro(); ?>
		</div>
	<?PHP
	}//Fim do if !empty($arr_dad["rol"]) quando não existe cadastro para este rol é aberto um form para preenchimento
	else {
		require_once ("adm/form_profis.php");
	}
	
	?>
</div>
