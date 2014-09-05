<?php
//Limpa as variáveis
$ministerio = '';$tesoureiro = '';$auxilio = '';$zeladores = '';$demaisPgto = '';$rec_tipo=false;

if ($_POST['referente']!='' && $_POST['grupo']>'0' && $_POST['grupo']<'6') {
	//Verifica click duplo no form de criar recibos
	if ((check_transid($_POST["transid"]) || $_POST["transid"]<1)) {
		//houve click duplo no form
		$gerarPgto = true;
	}else {
		//Não houve click duplo no form
		$gerarPgto = false;
		//Grava no banco codigo de autorização para o novo recibo
		add_transid($_POST["transid"]);
		//script que orienta a criação dos recibos
		$gerar = 'help/tes/gerarRecGrupo.php';
		require_once 'help/tes/definirRecGrupo.php';
	}
}
$dia1 ='';$dia15 ='';$diaOutros ='';
$cor=true;$cor1=true;$cor2=true;
foreach ($listaPgto as $chave => $valor) {
	
	$bgcolor = $cor ? 'class="dados"' : 'class="odd"';
	$bgcolor1 = $cor1 ? 'class="dados"' : 'class="odd"';
	$bgcolor2 = $cor2 ? 'class="dados"' : 'class="odd"';
	$bgcolor3 = $cor3 ? 'class="dados"' : 'class="odd"';
	$bgcolor4 = $cor4 ? 'class="dados"' : 'class="odd"';
	$vlrPgto = ($valor['pgto']>'0') ? true:false;
	
	$nomeMembro = ($valor['nome']=='') ? $valor['naoMembro']:$valor['nome'];
	$nomeDiaPgto = ($valor['diapgto']=='661') ? 'Sexta':$valor['diapgto'];
	
	$remove = '<a href="./?#" title="Remover!"> <span class="glyphicon glyphicon-remove"> </span></a>';
	$nomeMembro = sprintf ("% %'05u - %s ",$remove,$valor['rolMembro'],$nomeMembro);
	
	if (($valor['descricao']=='1' || $valor['descricao']=='17' )&& $vlrPgto) {
		//Lista do Ministério
		$dia1 .='<tr '.$bgcolor.'><td>'.$nomeMembro.'</td><td>'.$valor['nomeFunc'].
		'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.number_format($valor['pgto'],2,',','.').'</td>
				<td class="text-center">'.$nomeDiaPgto.'</td></tr>';
		$cor = !$cor;
		$totMinisterio += $valor['pgto'];
		//Cadastra o recibo
		if ($ministerio!='') {
			require $gerar;
			require $ministerio;
		}
	}elseif ($valor['descricao']=='8' && $vlrPgto){
		//Lista dos Tesoureiros
		$dia15 .='<tr '.$bgcolor1.'><td>'.$nomeMembro.'</td><td>'.$valor['nomeFunc'].
		'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.number_format($valor['pgto'],2,',','.').'</td>
				<td class="text-center">'.$nomeDiaPgto.'</td></tr>';
		$cor1 = !$cor1;
		$totTesoureiro += $valor['pgto'];
		//Cadastra o recibo
		if ($tesoureiro!='') {
			require $gerar;
			require $tesoureiro;
		}
	}elseif ($valor['descricao']=='12' && $vlrPgto) {
		//Lista dos Zeladores
		$diaZelador .='<tr '.$bgcolor2.'><td>'.$nomeMembro.'</td><td>'.$valor['nomeFunc'].
		'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.number_format($valor['pgto'],2,',','.').'</td>
				<td class="text-center">'.$nomeDiaPgto.'</td></tr>';
		$cor2 = !$cor2;
		$totZelador += $valor['pgto'];
		//Cadastra o recibo
		if ($zeladores!='') {
			require $gerar;
			require $zeladores;
		}
	}elseif ($valor['descricao']=='14' && $vlrPgto) {
		//Lista dos Auxilios
		$diaAux .='<tr '.$bgcolor3.'><td>'.$nomeMembro.'</td><td>'.$valor['nomeFunc'].
		'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.number_format($valor['pgto'],2,',','.').'</td>
				<td class="text-center">'.$nomeDiaPgto.'</td></tr>';
		$cor3 = !$cor3;
		$totAuxilio += $valor['pgto'];
		//Cadastra o recibo
		if ($auxilio!='') {
			require $gerar;
			require $auxilio;
		}
	}elseif ($vlrPgto) {
		//Lista dos Demais Pgto
		$diaOutros .='<tr '.$bgcolor4.'><td>'.$nomeMembro.'</td><td>'.$valor['nomeFunc'].
		'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.number_format($valor['pgto'],2,',','.').'</td>
				<td class="text-center">'.$nomeDiaPgto.'</td></tr>';
		$cor4 = !$cor4;
		$totOutros += $valor['pgto'];
		//Cadastra o recibo
		if ($demaisPgto!='') {
			require $gerar;
			require $demaisPgto;
		}
	}
	
//echo '<br />'.$indice.' -- > ';
//print_r($valor);
}

if ($totMinisterio>'0') {
	$dia1 = '<tr id="subtotal"><td colspan="3">Total para o Ministério:</td><td id="moeda">'
		.number_format($totMinisterio,2,',','.').'</td><td></td></tr>'.$dia1.'<tr id="total"><td colspan="5" >&nbsp;</td></tr>';
}else {
	$dia1='';
}

if ($totTesoureiro>'0') {
$dia15 = '<tr id="subtotal"><td colspan="3">Total para o Tesoureiro:</td><td id="moeda">'
		.number_format($totTesoureiro,2,',','.').'</td><td></td></tr>'.$dia15.'<tr id="total"><td colspan="5" >&nbsp;</td></tr>';
}else {
	$dia15='';
}

if ($totAuxilio>'0') {
	$diaAux = '<tr id="subtotal"><td colspan="3">Total em Auxílio:</td><td id="moeda">'
	.number_format($totAuxilio,2,',','.').'</td><td></td></tr>'.$diaAux.'<tr id="total"><td colspan="5">&nbsp;</td></tr>';
}else {
	$diaAux='';
}
if ($totZelador>'0') {
	$diaZelador = '<tr id="subtotal"><td colspan="3">Total para Zelador:</td><td id="moeda">'
	.number_format($totZelador,2,',','.').'</td><td></td></tr>'.$diaZelador.'<tr id="total"><td colspan="5">&nbsp;</td></tr>';
}else {
	$diaAux='';
}
if ($totOutros>'0') {
$diaOutros = '<tr id="subtotal"><td colspan="3">Total dos demais Pgto&prime;s:</td><td id="moeda">'
		.number_format($totOutros,2,',','.').'</td><td></td></tr>'.$diaOutros;
}else {
	$Outros='';
}
$nivel1 = $dia1.$dia15.$diaAux.$diaZelador.$diaOutros;
$debito = $totMinisterio+$totTesoureiro+$totAuxilio+$totZelador+$totOutros;