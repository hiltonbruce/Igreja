<?php
$dia1 ='';$dia15 ='';$diaOutros ='';
$cor=true;$cor1=true;$cor2=true;
foreach ($listaPgto as $chave => $valor) {
	
	$bgcolor = $cor ? 'class="dados"' : 'class="odd"';
	$bgcolor1 = $cor1 ? 'class="dados"' : 'class="odd"';
	$bgcolor2 = $cor2 ? 'class="dados"' : 'class="odd"';
	$vlrPgto = ($valor['pgto']>'0') ? true:false;
	
	$momeMembro = ($valor['nome']=='') ? $valor['naoMembro']:$valor['nome'];
	$nomeDiaPgto = ($valor['diapgto']=='661') ? 'Sexta':$valor['diapgto'];
	
	if (($valor['descricao']=='1' || $valor['descricao']=='17' )&& $vlrPgto) {
		$dia1 .='<tr '.$bgcolor.'><td>'.$momeMembro.'</td><td>'.$valor['nomeFunc'].
		'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.number_format($valor['pgto'],2,',','.').'</td>
				<td class="text-center">'.$nomeDiaPgto.'</td></tr>';
		$cor = !$cor;
		$totMinisterio += $valor['pgto'];
	}elseif ($valor['descricao']=='8' && $vlrPgto){
		$dia15 .='<tr '.$bgcolor1.'><td>'.$momeMembro.'</td><td>'.$valor['nomeFunc'].
		'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.number_format($valor['pgto'],2,',','.').'</td>
				<td class="text-center">'.$nomeDiaPgto.'</td></tr>';
		$cor1 = !$cor1;
		$totTesoureiro += $valor['pgto'];
	}elseif ($valor['descricao']=='12' && $vlrPgto) {
		$diaZelador .='<tr '.$bgcolor2.'><td>'.$momeMembro.'</td><td>'.$valor['nomeFunc'].
		'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.number_format($valor['pgto'],2,',','.').'</td>
				<td class="text-center">'.$nomeDiaPgto.'</td></tr>';
		$cor2 = !$cor2;
		$totZelador += $valor['pgto'];
	}elseif ($valor['descricao']=='14' && $vlrPgto) {
		$diaAux .='<tr '.$bgcolor2.'><td>'.$momeMembro.'</td><td>'.$valor['nomeFunc'].
		'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.number_format($valor['pgto'],2,',','.').'</td>
				<td class="text-center">'.$nomeDiaPgto.'</td></tr>';
		$cor2 = !$cor2;
		$totAuxilio += $valor['pgto'];
	}elseif ($vlrPgto) {
		$diaOutros .='<tr '.$bgcolor2.'><td>'.$momeMembro.'</td><td>'.$valor['nomeFunc'].
		'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.number_format($valor['pgto'],2,',','.').'</td>
				<td class="text-center">'.$nomeDiaPgto.'</td></tr>';
		$cor2 = !$cor2;
		$totOutros += $valor['pgto'];
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