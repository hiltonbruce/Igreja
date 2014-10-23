<fieldset>
	<legend>Lançar Pagamento</legend>
	<p style="background: white; color: blue; font-size: 14px;">
	<?php

	$itemagenda = new DBRecord('agenda',$_GET['id'], 'id');
	$datapgto = conv_valor_br ($itemagenda->datapgto());
	
	$dtParaPgto = ($datapgto=='00/00/0000') ? $dtPgto:$datapgto;
	
	if (strstr($itemagenda->credor(),'r')) {
		$rolMembro = ltrim ($itemagenda->credor(),'r');
		$credorAgenda = new DBRecord('membro', (int)$rolMembro, 'rol');
		$nomeMembro = $credorAgenda->nome();
		$credorCompl = true;//Para o caso de membros da igreja
		
		$mudaTipo = '<div class="bs-callout bs-callout-warning">
		    <p><label><input type="checkbox" id="status" name="paraCredor" value="1">
			&nbsp;Mudar este compromisso para credor <strong>NÃO</strong>-Membro da Igreja!</label></p>
		  </div>';
		
	}else {
		$credorAgenda = new DBRecord('credores', $itemagenda->credor(), 'id');
		$nomecredor = $credorAgenda->alias();
		$credorCompl = false;
		$mudaTipo = '<div class="bs-callout bs-callout-warning">
		    <p><label><input type="checkbox" id="status" name="paraMembro"
		value="1" tabindex="<?php echo ++$ind; ?>">
		&nbsp;Mudar este compromisso para credor Membro da Igreja!</label></p>
		  </div>';
	}

	
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
	if (date ('Y-m-d') == $itemagenda->vencimento() && $itemagenda->datapgto()=='0000-00-00') {
		?>
		<div class="alert alert-success alert-dismissible" role="alert">
	      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
	       <strong>HOJE!</strong> Conta com vencimento nesta data! <strong>Situação em: <?php echo $dataget;?></strong>
	    </div>
		<?php
	}elseif ($dataAtual->format('U') > $dataVenc->format('U') && $itemagenda->datapgto()=='0000-00-00') {
		?>	
		<div class="alert alert-danger alert-dismissible" role="alert">
	      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
	      CONTA <strong>VENCIDA</strong>! Ainda não foi paga! <strong>Situação em: <?php echo $dataget;?></strong>
	    </div>
		<?php 
	}elseif ($dataAtual->format('U') < $dataVenc->format('U') && $itemagenda->datapgto()=='0000-00-00') {
		?>	
		<div class="alert alert-warning alert-dismissible" role="alert">
	      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
	      Conta ainda dentro do prazo para pagamento! <strong>Situação em: <?php echo $dataget;?></strong>
	    </div>
		<?php 
	}else {
		?>
		<div class="alert alert-info alert-dismissible" role="alert">
	      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
	      Conta PAGA, Obrigado! <strong>Situação em: <?php echo $dataget;?></strong>
	    </div>
		<?php
	}
		
	$pendende = '';
 	$pago= '';
	$enviado = '';
	switch ($itemagenda->status()) {
		//Marca o opção do status atual no formulário
		case 3:
			$quitado = 'checked="checked"';
			break;
		case 2:
			$pago = 'checked="checked"';
			break;
		case 1:
			$enviado = 'checked="checked"';
			break;
		case 3:
		 $pago= 'checked="checked"';
		 break;
		default:
			$pendende = 'checked="checked"';
			break;
	}
	//concluir a migração dos dados da tabela fatura para a de fonecedores
	//fazer verificação no campo credor da tabela agenda se refere a rol ou CPF e CNPJ
	//No campo da tabela está definida da seguinte forma tabela@numero ou tabela@cnpj/cpf

	if ($itemagenda->igreja()<'1') {
		$igreja_pgto = 'Templo Sede';
	}else {
		$igreja_array = new DBRecord('igreja',$itemagenda->igreja(), 'rol');
		$igreja_pgto = $igreja_array->razao();
	}
	?>
	</p>
	<form action="" method="post" name="cadastro_igreja">
		<table style="text-align: left; width: 100%;">
			<tbody>
				<tr>
					<td><label>Igreja</label>
						 <?PHP
						 	$congr = new List_sele ("igreja","razao","igreja");
						 	echo $congr->List_Selec (++$ind,$itemagenda->igreja(),' class="form-control" ');
						 ?>
					</td>
					<td colspan="3" rowspan="2">
						<label>Motivo</label>
						<textarea rows="" cols="" name="motivo" required="required" 
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
								$congr = new List_sele ("credores","alias","credor");
								echo $congr->List_Selec (++$ind,$itemagenda->credor(),' class="form-control" required="required" ');
						 	}
						 
						 ?>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<?php echo $mudaTipo;?>						
					</td>
				</tr>
				<tr>
					<td><label><input type="radio" id="status" <?php echo $pago;?>
						name="status" value="2" tabindex="<?php echo ++$ind; ?>"> Pago</label> 
					</td>
					<td><label> <input type="radio"
						id="status" name="status" value="1" <?php echo $enviado;?>
						tabindex="<?php echo ++$ind; ?>"> Enviado para pagamento</label>
					</td>
					<td><label><input type="radio" id="status"
						name="status" autofocus="autofocus" value="0"
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
		<table style="text-align: left; width: 100%;">
			<tbody>
				<tr>
					<td><label>Valor:</label> <input type="text" name="valor"
						id="valor" class="form-control" tabindex="<?PHP echo ++$ind; ?>"
						required="required" value="<?php echo $itemagenda->valor();?>"></td>
					<td><label>Juros e Multas:</label> <input type="text" name="multa"
						id="multa" class="form-control" tabindex="<?PHP echo ++$ind; ?>"
						value="<?php echo $itemagenda->multa();?>"></td>
					<td><label>Pago em: (Atual -> <?php echo $datapgto;?>)</label> <input type="text" name="data"
						id="data" class="form-control" tabindex="<?PHP echo ++$ind; ?>" maxlength="10"
						value="<?php echo $dtPgto;?>"></td>
				</tr>
				<tr>
					<td><label>Vencimento: ( Atual -> <?php echo conv_valor_br($itemagenda->vencimento());?>)</label> <input type="text" name="vencimento"
						id="venc" class="form-control" tabindex="<?PHP echo ++$ind; ?>"
						required="required" value="<?php echo conv_valor_br($itemagenda->vencimento());?>"></td>
					<td><label>Resp.Pagamento:</label> <input type="text"
						name="resppgto" id="resppgto" class="form-control" tabindex="<?PHP echo ++$ind; ?>"
						value="<?php echo $itemagenda->resppgto();?>"></td>
					<td><label></label> <label>&nbsp;</label> <input type="hidden" name="atualizar"
						value="<?php echo $_GET['id'];?>"> <input type="submit"
						name="Submit" class="btn btn-primary" value="Atualizar..."
						tabindex="<?php echo ++$ind; ?>"></td>
				</tr>
			</tbody>
		</table>

	</form>
</fieldset>
