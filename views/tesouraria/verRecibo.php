<fieldset>
	<div class="btn-group">
		 <a href="./?escolha=tesouraria/rec_alterar.php&menu=top_tesouraria&id=<?php echo $id-1;?>">
		 	<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">
				<span class="glyphicon glyphicon-step-backward" aria-hidden="true"></span> Recibo Anterior</button>
	 	 </a>
		 	 <a href="./?escolha=tesouraria/rec_alterar.php&menu=top_tesouraria&id=<?php echo $id+1;?>">
		 	 	<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Pr&oacute;ximo Recibo
				<span class="glyphicon glyphicon-step-forward" aria-hidden="true"></span></button>
		 	</a>
			<form>
			</form>
	</div>
	<?php
	if (!$testLanc) {
		echo '<h4><p class="text-danger" >';
		echo 'O recibo j&aacute; teve seu lan&ccedil;amento confirmado e n&atilde;o poder&aacute; ser alterado!!</p>';
		echo '<span class="small">Voc&ecirc; poder&aacute criar um novo ou re-imprimir como est&aacute;.</span></h4>';
	}
	 ?>
	<div id="lst_cad">
		<table class='table table-condensed'>
	      <tr>
			<td colspan='2'><label>Nome do Beneficiado:</label>
				<?PHP
					switch ($rec_alterar->tipo)
					{
						case 1:
							$beneficiado = new DBRecord("membro", $rec_alterar->recebeu(), "rol");
							$recebeu = $beneficiado->nome();
							$form = new formmembro("recebeu",$recebeu,$tab,$tab_edit);
							$form->formcab();
							$form->getMostrar($rec_alterar->recebeu());
							break;
						case 2:
							$beneficiado = new DBRecord("credores", $rec_alterar->recebeu(), "id");
							$recebeu = $beneficiado->razao();
							$recebeu_CNPJ = $beneficiado->cnpj_cpf();
							$nome = new editar_form("recebeu",$recebeu,$tab,$tab_edit);
							$nome->getMostrar();
							if ($_GET["campo"]=='recebeu'){
								?>
									<form name="fornec" id="fornec" action="" method="post">
									<?php
									$for_num = new list_fornecedor("credores", "alias", "recebeu");
									echo $for_num->List_sel($ind++);
									?>
									<input name="escolha" type="hidden" id="escolha" value="sistema/atualizar_sistema.php">
									<input name="campo" id="campo" type="hidden" value="recebeu">
									<input name="tabela" id="tabela" type="hidden" value="tes_recibo">
									<input name="id" id="id" type="hidden" value="<?php echo $id;?>">
									<input name="Submit" type="submit" class="btn btn-primary" value="Alterar..." >
									</form>
								<?php
							}
							break;
						default:
							$recebeu = $rec_alterar->recebeu();
							$nome = new editar_form("recebeu",$recebeu,$tab,$tab_edit);
							$nome->getMostrar();$nome->getEditar();
							break;
					}
				?>
			</td>
	        <td><label>Recibo N&uacute;mero:</label>
			<?PHP
			printf ("<p> %'05u</p>",$id);
			?>
			</td>
		</tr>
		<tr>
	        <td colspan='3'><label>Motivo do pagamento:</label>
			<?PHP
			$nome = new editar_form("motivo",$rec_alterar->motivo(),$tab,$tab_edit);
			$nome->getMostrar();$nome->getEditar();
			?>
			</td>
	      </tr>
	      <tr>
	      		<td colspan='2'>Fonte do Recurso:
	          <?PHP
				$nome = new editar_form("fonte",$rec_alterar->fonte(),$tab,$tab_edit);
				$fonte = new DBRecord("contas", $rec_alterar->fonte(), "acesso");
				echo "<p><a href='./?escolha={$tab_edit}fonte&fonte={$rec_alterar->fonte()}'>".$fonte->titulo()."</a></p>";
				if ($_GET["campo"]=="fonte"){
					?>
					<form name="fornec" id="fornec" action="" method="post">
					<?php
						echo '<select name="fonte" id="caixa" class="form-control"';
						echo 'tabindex="'.++$ind.'" >';
								$bsccredor = new tes_listDisponivel();
								$caixas = $bsccredor->List_Selec($rec_alterar->fonte());
								echo $caixas;
						echo '</select>';
					?>
					<input name="escolha" type="hidden" id="escolha" value="sistema/atualizar_sistema.php">
					<input name="campo" id="campo" type="hidden" value="fonte">
					<input name="tabela" id="tabela" type="hidden" value="tes_recibo">
					<input name="id" id="id" type="hidden" value="<?php echo $id;?>">
					<input name="Submit" type="submit" class="btn btn-primary" value="Alterar..." >
					</form>
				<?php
				}
				?>
				</td>
	      		<td>
	      			Despesa:
	      			<?PHP
					$conta = new DBRecord("contas", $rec_alterar->conta(), "acesso");
					$nome = new editar_form("conta",$conta->titulo(),$tab,$tab_edit);
					$nome->getMostrar();
					if ($_GET["campo"]=="conta"){
					$acesso = $rec_alterar->conta();
					echo '<form name="fornec" id="fornec" action="" method="post">';
					require_once 'forms/tes/autoCompletaDespesas.php';
					echo '<input name="escolha" type="hidden" id="escolha" value="sistema/atualizar_sistema.php">';
					echo '<input name="campo" id="campo" type="hidden" value="conta">';
					echo '<input name="tabela" id="tabela" type="hidden" value="tes_recibo">';
					echo '<input name="id" id="id" type="hidden" value="'.$id.'">';
					echo '<input name="Submit" type="submit" class="btn btn-primary" value="Alterar..." >';
					echo '</form>';
					}
					?>
	      		</td>
	      </tr>
	      <tr>
	        <td><label>Lan&ccedil;amento:</label>
	        <?PHP
						$nome = new editar_form("lancamento",$rec_alterar->lancamento(),$tab,$tab_edit);
						$nome->getMostrar();$nome->getEditar();
					?>
			</td>
	        <td>Data da emiss&atilde;o:
	        <?PHP
			$nome = new editar_form("data",$rec_alterar->data(),$tab,$tab_edit);
			echo "<p>".conv_valor_br ($rec_alterar->data())."</p>";
			?>
			</td>
			<td>Valor:
	        <?PHP
			$nome = new editar_form("valor",$rec_alterar->valor(),$tab,$tab_edit);
			echo "<p><a href='./?escolha={$tab_edit}valor'>R$ ".number_format($rec_alterar->valor(),2,",",".")."</a></p>";
			$nome->getEditar();
			?>
			</td>
	      </tr>
	      <tr>
	        <td colspan='2'>Para Igreja:
				<?PHP
				if ($rec_alterar->igreja()<'1') {
					echo "<p><a href='./?escolha={$tab_edit}igreja'>Templo Sede</a></p>";
						$rec_igreja = new DBRecord('igreja',1,'rol');
				}else {
					$rec_igreja = new DBRecord('igreja',$rec_alterar->igreja(),'rol');
					echo "<p><a href='./?escolha={$tab_edit}igreja&igreja={$rec_igreja->rol()}'>".$rec_igreja->razao()."</a></p>";}

				if ($_GET["campo"]=="igreja"){
				?>
				  <form id="form1" name="form1" method="post" action="">
		         <?PHP
				 	$congr = new List_sele ("igreja","razao","igreja");
				 	echo $congr->List_Selec ($ind++,$_GET['igreja'],'class="form-control"');
				 ?>
					<input name="escolha" type="hidden" id="escolha" value="sistema/atualizar_sistema.php">
					<input name="campo" id="campo" type="hidden" value="igreja">
					<input name="tabela" id="tabela" type="hidden" value="tes_recibo">
					<input name="id" id="id" type="hidden" value="<?php echo $id;?>">
					<input name="Submit" type="submit" class="btn btn-primary" value="Alterar..." >
				  </form>
				  <?php
					 }
				  ?>
			</td>
			<td >Recibo emitido por:
			<?PHP
				echo "<p>".$rec_alterar->hist()."</p>";
			?>
			</td>
	      </tr>
	    </table>
	    <table>
	      <tr style="background-color: transparent;">
			<?PHP
				require_once 'forms/alt_rec.php';
			?>
		</tr>
	    </table>
	   </div>
</fieldset>
