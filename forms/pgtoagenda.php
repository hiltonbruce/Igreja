<?php
	if (!empty($_GET['id'])) {
		$regID = intval($_GET['id']);
	} elseif (!empty($_GET['atualizar'])) {
		$regID = intval($_GET['atualizar']);
	} else {
		$regID = '';
	}
	$itemagenda = new DBRecord('agenda',$regID, 'id');
	if ($itemagenda->idlanc()>'0') {
		$lancConfirmado  = '<p><kbd>Lan&ccedil;amento confirmado, N&ordm;: '.$itemagenda->idlanc().'</kbd></p>';
		$lancConfirmado .= '<p class="text-danger">Ap&oacute;s confirma&ccedil;&atilde;o de ';
		$lancConfirmado .= 'pagamento n&atilde;o &eacute; permitido atualiza&ccedil;&atilde;o das ';
		$lancConfirmado .= 'contas de pagto e despesas! </p>';
		$lancConfirmado .= '<p>A op&ccedil;&atilde;o para altera&ccedil;&atilde;o das ';
		$lancConfirmado .= 'contas &eacute; extorna o lan&ccedil;amento e retificar, ';
		$lancConfirmado .= 'e mesmo assim aqui ficarar constando a falha, por&eacute;m ';
		$lancConfirmado .= 'no relatorio constara a falha e a corre&ccedil;&atilde;o. O que &eacute; ';
		$lancConfirmado .= 'correto do ponto de vista cont&aacute;bil</p>';
		$desCampoCta = 'disabled="disabled"'; #desativa campos da fonte pgto e despesa
	} else {
		$desCampoCta = '';
	}
	if (strstr($itemagenda->credor(),'r')) {
		$rolMembro = intval($itemagenda->credor());
		$credAgenda = new DBRecord('membro',$rolMembro, 'rol');
		$nomeMembro = $credAgenda->nome();
		$credorCompl = true;//Para o caso de membros da igreja
		$mudaTipo = '<div class="bs-callout bs-callout-warning">
		    <p><label><input type="checkbox" id="status" name="paraCredor" value="1">
			&nbsp;Mudar este compromisso para credor <strong>N&Aatilde;O</strong>-Membro da Igreja!</label></p>
		  </div>';
	}else {
		$credAgenda = new DBRecord('credores', $itemagenda->credor(), 'id');
		$nomecredor = $credAgenda->alias();
		$credorCompl = false;
		$mudaTipo = '<div class="bs-callout bs-callout-warning">
		    <p><label><input type="checkbox" id="status" name="paraMembro"
		value="1" tabindex="<?php echo ++$ind; ?>">
		&nbsp;Mudar este compromisso para credor Membro da Igreja!</label></p>
		  </div>';
	}
	if ($itemagenda->datapgto() != '0000-00-00') {
		$datapgto = conv_valor_br ($itemagenda->datapgto());
	} else {
		$datapgto = '';
	}
	$pendende = '';
 	$pago= '';
	$enviado = '';
	switch ($itemagenda->status()) {
		//Marca o op��o do status atual no formul�rio
		case 3:
			$quitado = 'checked="checked" autofocus="autofocus"';
			break;
		case 2:
			$pago = 'checked="checked" autofocus="autofocus"';
			break;
		case 1:
			$enviado = 'checked="checked" autofocus="autofocus"';
			break;
		case 3:
		 $pago= 'checked="checked" autofocus="autofocus"';
		 break;
		default:
			$pendende = 'checked="checked" autofocus="autofocus"';
			break;
	}
	//concluir a migra��o dos dados da tabela fatura para a de fonecedores
	//fazer verifica��o no campo credor da tabela agenda se refere a rol ou CPF e CNPJ
	//No campo da tabela est� definida da seguinte forma tabela@numero ou tabela@cnpj/cpf
	if ($itemagenda->igreja()<'1') {
		$igreja_pgto = 'Templo Sede';
	}else {
		$igreja_array = new DBRecord('igreja',$itemagenda->igreja(), 'rol');
		$igreja_pgto = $igreja_array->razao();
	}
?>
<fieldset>
	<legend>Lan&ccedil;ar Pagamentos</legend>
	<form action="" method="post" name="recibos">
		<table class='table'>
			<tbody>
				<tr>
					<td><label>Igreja</label>
						 <?PHP
						 	$congr = new List_sele ("igreja","razao","rolIgreja");
						 	echo $congr->List_Selec (++$ind,$itemagenda->igreja(),' class="form-control" ');
						 ?>
					</td>
					<td colspan="2" rowspan="3">
						<label>Hist&oacute;rico:</label>
						<textarea rows="6" cols="" name="referente" required="required"
						 tabindex="<?PHP echo ++$ind; ?>" class="form-control"
						 ><?php echo $itemagenda->motivo();?></textarea>
					</td>
				</tr>
				<tr>
					<td>
						 <?PHP
						 	if ($credorCompl) {
						 		require_once 'forms/completaNomeRol.php';
						 	}else {
						 		echo '<label>Credor:</label>';
								$congr = new tes_listCredor ("credores","alias","nome");
								echo $congr->List_Selec (++$ind,$itemagenda->credor(),' class="form-control" required="required" ');
						 	}
						 ?>
					</td>
				</tr>
					<td>
						<label><strong>Pagamento realizado pela fonte:</strong></label>
						<select name="acessoCreditar" id="caixa" class="form-control"
						tabindex="<?PHP echo ++$ind; ?>" <?PHP echo $desCampoCta; ?> >
							<?php
								$bsccredor = new tes_listDisponivel();
								$listaIgreja = $bsccredor->List_Selec($itemagenda->creditar());
								echo $listaIgreja;
							?>
						</select>
					</td>
				</tr>
				<tr>
					<?PHP
						$ctaDespesa = new DBRecord ('contas',$itemagenda->debitar(),'acesso');
					?>
					<td colspan="3">Despesas com:<br /> <input type="text" name="cta" class="form-control"
						id="campo_estado" size="78%" tabindex="<?PHP echo ++$ind; ?>"
						placeholder="Qual a Despesa?" value='<?php echo $ctaDespesa->titulo();?>'
						 <?PHP echo $desCampoCta; ?> />
					</td>
				</tr>
				<tr>
					<td>C&oacute;digo/tipo:<br /> <input type="text" id="estado_val" class="form-control"
						name="estado_val" disabled="disabled"
						value="<?php echo $ctaDespesa->codigo().', Tipo: '.$ctaDespesa->tipo();?>" />
					</td>
					<td>Saldo Atual: <br /> <input type="text" id="id_val" name="id" class="form-control"
						disabled="disabled" value="<?php echo $ctaDespesa->saldo();?>" /></td>
					<td>Acesso:<br /> <input type="text" id="acesso" name="acessoDebitar" class="form-control"
						value="<?php echo $itemagenda->debitar();?>" required="required"
						 <?PHP echo $desCampoCta; ?> tabindex="<?PHP echo ++$ind; ?>" /></td>
				</tr>
				<tr>
					<td colspan="3">Descri&ccedil;&atilde;o:<br />  <input type="text" size="78%" id="detalhe" name="det"
						disabled="disabled" class="form-control" value="<?php echo $ctaDespesa->descricao();?>" /></td>
				</tr>
				<tr>
					<td colspan="4">
					</td>
				</tr>
				<tr>
					<td><label><input type="radio" id="status" <?php echo $pago;?>
						name="status" value="2" tabindex="<?php echo ++$ind; ?>"> Pago (Efetua lan&ccedil;amento cont&aacute;bil)</label>
					</td>
					<td><label> <input type="radio"
						id="status" name="status" value="1" <?php echo $enviado;?>
						tabindex="<?php echo ++$ind; ?>"> Enviado para pagamento</label>
					</td>
					<td><label><input type="radio" id="status"
						name="status" value="0"
						tabindex="<?php echo ++$ind; ?>" <?php echo $pendende;?>>
						Pendente</label>
					</td>
					<td><label> <input type="radio" id="status"
						required="required" name="status" value="3"
						tabindex="<?php echo ++$ind; ?>" <?php echo $quitado;?>>
						Quitado</label>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="row">
	  <div class="col-xs-3"><label>Valor:</label> <input type="text" name="valor"
			class="form-control money" tabindex="<?PHP echo ++$ind; ?>"
			required="required" value="<?php echo $itemagenda->valor();?>">
		  </div>
		  <div class="col-xs-3"><label>Juros e Multas:</label> <input type="text" name="multa"
				class="form-control money" tabindex="<?PHP echo ++$ind; ?>"
				value="<?php echo $itemagenda->multa();?>">
		  </div>
			<?php
				$datapgto = ($datapgto=='') ? '' : '(Atual->'.$datapgto.')' ;
				$detVenc = ($itemagenda->vencimento()=='') ? 'Data Venc.:' : 'Venc. Atual->
				 '.conv_valor_br($itemagenda->vencimento());
			?>
		  <div class="col-xs-3"><label>Data Pgto:<?php echo $datapgto;?></label> <input type="text" name="data"
				id="data" class="form-control" tabindex="<?PHP echo ++$ind; ?>" maxlength="10"
				value="<?php echo $datapgto;?>">
		  </div>
		  <div class="col-xs-3"><label><?php echo $detVenc;?></label><input type="text" name="vencimento"
				id="venc" class="form-control" tabindex="<?PHP echo ++$ind; ?>"
				required="required" value="<?php echo conv_valor_br($itemagenda->vencimento());?>">
		  </div>
		  <div class="col-xs-3"><label>Resp.Pagamento:</label> <input type="text"
				name="resppgto" id="resppgto" class="form-control" tabindex="<?PHP echo ++$ind; ?>"
				value="<?php echo $itemagenda->resppgto();?>">
		  </div>
		  <div class="col-xs-3"><label>&nbsp;</label> <input type="hidden" name="atualizar"
				value="<?php echo $_GET['id'];?>"> <input type="submit"
				name="Submit" class="btn btn-primary" value="Atualizar..."
				tabindex="<?php echo ++$ind; ?>">
		  </div>
		  <div class="col-xs-3"><label>Id Lan&ccedil;amento</label>
				<?php
					$idlanc = ($itemagenda->idlanc()=='0') ? 'name="idlanc" ' : 'disabled' ;
				?>
				<input type="text" class="form-control" tabindex="<?PHP echo ++$ind; ?>"
				<?php echo 'value="'.$itemagenda->idlanc().'" '.$idlanc;?>>
		  </div>
		  <div class="col-xs-6">
				<?php echo $mudaTipo;?>
		  </div>
		</div>
	</form>
	<?php
	$vencimento = $itemagenda->vencimento();
	$dataAtual = new DateTime('NOW');
	$dataVenc  = new DateTime($vencimento);
	/*
	$diferenca = $dataVenc->diff($dataAtual);
	print_r($diferenca);
	echo '<br/>'.$dataAtual->format('Y-m').' FormatoAtual<br/>';
	echo $diferenca->m.' meses<br/>';
	echo $dataVenc->format('Y-m').' FormatoVenc<br/>';
	*/
	$dataget = date ('d/M/Y H:i');
	if (date ('Y-m-d') == $itemagenda->vencimento() && $itemagenda->datapgto()=='0000-00-00') {
		?>
		<div class="alert alert-success alert-dismissible" role="alert">
	      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	       <strong>HOJE!</strong> Conta com vencimento nesta data! <strong>Situa&ccedil;&atilde;o em: <?php echo $dataget;?></strong>
	      <?php echo $lancConfirmado;?>
	    </div>
		<?php
	}elseif ($dataAtual->format('U') > $dataVenc->format('U') && $itemagenda->datapgto()=='0000-00-00') {
		?>
		<div class="alert alert-danger alert-dismissible" role="alert">
	      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&otimes;</span><span class="sr-only">Close</span></button>
	      CONTA <strong>VENCIDA</strong>! Ainda n&atilde;o foi paga! <strong>Situa&ccedil;&atilde;o em: <?php echo $dataget;?></strong>
	      <?php echo $lancConfirmado;?>
	    </div>
		<?php
	}elseif ($dataAtual->format('U') < $dataVenc->format('U') && $itemagenda->datapgto()=='0000-00-00') {
		?>
		<div class="alert alert-warning alert-dismissible" role="alert">
	      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&otimes;</span><span class="sr-only">Close</span></button>
	      Conta ainda dentro do prazo para pagamento! <strong>Situa&ccedil;&atilde;o em: <?php echo $dataget;?></strong>
	      <?php echo $lancConfirmado;?>
	    </div>
		<?php
	}else {
		?>
		<div class="alert alert-info alert-dismissible" role="alert">
	      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&otimes;</span><span class="sr-only">Close</span></button>
	      Conta PAGA, Obrigado! <strong>Situa&ccedil;&atilde;o em: <?php echo $dataget;?></strong>
	      <?php echo $lancConfirmado;?>
	    </div>
		<?php
	}
	?>
</fieldset>
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
		if ( this.value.length < 2 && this.isNotClick )
			return ;
		return "models/tes/autoCompletaContas.php?q=" + this.value;
	});
  new Autocomplete("campo_nome", function() {
    this.setValue = function( rol, nome, celular, congr ) {
        $("#fone_membro").val(rol);
        $("#rol_membro").val(nome);
        $("#sigla_val").val(celular);
        $("#rol").val(fone);
        $("#cong").val(congr);
    }
      if ( this.value.length < 2 && this.isNotClick )
          return ;
      return "models/autodizimo.php?q=" + this.value + "&igreja=<?php echo $_GET['igreja'];?>" ;
  });
</script>
