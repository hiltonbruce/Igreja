<fieldset>
	<legend>Lançar Pagamento</legend>
	<p style="background: white; color: blue; font-size: 14px;">
	<?php

	$itemagenda = new DBRecord('agenda',$_GET['id'], 'id');
	if (strstr($itemagenda->credor(),'r')) {
		$credor = new DBRecord('membro', (int)$itemagenda->credor(), 'rol');
		$nomecredor = 'Rol: '.$credor->rol().'-'.$credor->nome();
		$credor = '<input type="text" name="credor" class="form-control" 
		 required="required" value="'.$nomecredor ;
		$credorCompl = true;//Para o caso de membros da igreja
		
	}else {
		$credor = new DBRecord('credores', $itemagenda->credor(), 'id');
		$nomecredor = $credor->alias();
		$credorCompl = false;
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
		<div class="alert alert-info alert-dismissible" role="alert">
	      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
	      Conta com vencimento hoje!
	    </div>
		<?php
	}elseif ($dataAtual->format('U') > $dataVenc->format('U') && $itemagenda->datapgto()=='0000-00-00') {
		?>	
		<div class="alert alert-danger alert-dismissible" role="alert">
	      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
	      Vencida! Esta conta ainda não foi paga!
	    </div>
		<?php 
	}elseif ($dataAtual->format('U') < $dataVenc->format('U') && $itemagenda->datapgto()=='0000-00-00') {
		?>	
		<div class="alert alert-warning alert-dismissible" role="alert">
	      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
	      Conta ainda dentro do prazo para pagamento!
	    </div>
		<?php 
	}else {
		?>
		<div class="alert alert-success alert-dismissible" role="alert">
	      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
	      Conta Paga, Obrigado!
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
		<h3>Situação: <?php echo $dataget;?></h3>
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
					<td><label>Credor:</label>
						 <?PHP
						 	if ($credorCompl) {
						 		echo $credor.'tabindex="'.++$ind.'" placeholder="Rol do Memdro"';
						 	}else {
								$congr = new List_sele ("credores","alias","credor");
								echo $congr->List_Selec (++$ind,$itemagenda->credor(),' class="form-control" required="required" ');
						 	}
						 
						 ?>
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
					<td><label>Pago em:</label> <input type="text" name="data"
						id="data" class="form-control" tabindex="<?PHP echo ++$ind; ?>" maxlength="10"
						value="<?php echo $dataget;?>"></td>
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
						name="Submit" class="btn btn-primary" value="Registrar..."
						tabindex="<?php echo ++$ind; ?>"></td>
				</tr>
			</tbody>
		</table>

	</form>
</fieldset>
