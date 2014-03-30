<fieldset>
	<legend>Lançar Pagamento</legend>
	<p style="background: white; color: blue; font-size: 14px;">
	<?php

	$itemagenda = new DBRecord('agenda',$_GET['id'], 'id');
	if (strstr($itemagenda->credor(),'r')) {
		$credor = new DBRecord('membro', (int)$itemagenda->credor(), 'rol');
		$nomecredor = 'Rol: '.$credor->rol().'-'.$credor->nome();
	}else {
		$credor = new DBRecord('credores', $itemagenda->credor(), 'id');
		$nomecredor = $credor->alias();
	}

	
	$vencimento = $itemagenda->vencimento();
	$dataAtual = new DateTime('NOW');
	$dataVenc  = new DateTime($vencimento);
	/*
	$diferenca = $dataVenc->diff($dataAtual);
	print_r($dataVenc);
	echo '<br/>'.$dataAtual->format('Y-m').' FormatoAtual<br/>';
	echo $diferenca->m.' meses<br/>';
	echo $dataVenc->format('Y-m').' FormatoVenc<br/>';
	*/
	if ($dataAtual->format('U') > $dataVenc->format('U')) {
		echo 'Conta Vencida<br/>';
	}else {
		echo 'Conta OK<br/>';
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
	echo 'Igreja: '.$igreja_pgto.' - credor --> '.$nomecredor;
	echo '<br /> Motivo: '.$itemagenda->motivo().' --> Valor: R$ '.$itemagenda->valor();
	echo '<br /> Vencimento: '.conv_valor_br($itemagenda->vencimento());
	?>
	</p>
	<form action="" method="post" name="cadastro_igreja">
		<h3>Situação: <?php echo $dataget;?></h3>
		<table style="text-align: left; width: 100%;">
			<tbody>
				<tr>
					<td><label><input type="radio" id="status" <?php echo $pago;?>
						name="status" value="2" tabindex="<?php echo ++$ind; ?>">Pago</label> 
					</td>
					<td><label> <input type="radio"
						id="status" name="status" value="1" <?php echo $enviado;?>
						tabindex="<?php echo ++$ind; ?>">Enviado para pagamento</label>
					</td>
					<td><label><input type="radio" id="status"
						name="status" autofocus="autofocus" value="0"
						tabindex="<?php echo ++$ind; ?>" <?php echo $pendende;?>>
						Pendente</label> 
					</td>
					<td><label> <input type="radio" id="status"
						name="status" value="3"
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
						id="valor" tabindex="<?PHP echo ++$ind; ?>"
						value="<?php echo $itemagenda->valor();?>"></td>
					<td><label>Juros e Multas:</label> <input type="text" name="multa"
						id="multa" tabindex="<?PHP echo ++$ind; ?>"
						value="<?php echo $itemagenda->multa();?>"></td>
					<td><label>Pago em:</label> <input type="text" name="data"
						id="data" tabindex="<?PHP echo ++$ind; ?>" maxlength="10"
						value="<?php echo $dataget;?>"></td>
				</tr>
				<tr>
					<td><label>Vencimento:</label> <input type="text" name="vencimento"
						id="data" tabindex="<?PHP echo ++$ind; ?>"
						value="<?php echo conv_valor_br($itemagenda->vencimento());?>"></td>
					<td><label>Resp.Pagamento:</label> <input type="text"
						name="resppgto" id="resppgto" tabindex="<?PHP echo ++$ind; ?>"
						value="<?php echo $itemagenda->resppgto();?>"></td>
					<td><label></label> <input type="hidden" name="atualizar"
						value="<?php echo $_GET['id'];?>"> <input type="submit"
						name="Submit" value="Registrar..."
						tabindex="<?php echo ++$ind; ?>"></td>
				</tr>
			</tbody>
		</table>

	</form>
</fieldset>
