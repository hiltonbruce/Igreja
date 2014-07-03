<?php
$dia1 ='';$dia15 ='';$diaOutros ='';
$cor=true;$cor1=true;$cor2=true;
foreach ($listaPgto as $chave => $valor) {
	
	$bgcolor = $cor ? 'class="dados"' : 'class="odd"';
	$bgcolor1 = $cor1 ? 'class="dados"' : 'class="odd"';
	$bgcolor2 = $cor2 ? 'class="dados"' : 'class="odd"';
	
	if ($valor['diapgto']=='1') {
		$dia1 .='<tr '.$bgcolor.'><td>'.$valor['nome'].'</td><td>'.$valor['nomeFunc'].'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.number_format($valor['pgto'],2,',','.').'</td><td>'.$valor['diapgto'].'</td></tr>';
		$cor = !$cor;
		$totDia1 += $valor['pgto'];
	}elseif ($valor['diapgto']=='15'){
		$dia15 .='<tr '.$bgcolor1.'><td>'.$valor['nome'].'</td><td>'.$valor['nomeFunc'].'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.number_format($valor['pgto'],2,',','.').'</td><td>'.$valor['diapgto'].'</td></tr>';
		$cor1 = !$cor1;
		$totDia15 += $valor['pgto'];
	}else {
		$diaOutros .='<tr '.$bgcolor2.'><td>'.$valor['nome'].'</td><td>'.$valor['nomeFunc'].'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.number_format($valor['pgto'],2,',','.').'</td><td>'.$valor['diapgto'].'</td></tr>';
		$cor2 = !$cor2;
		$totOutros += $valor['pgto'];
	}
	
//echo '<br />'.$indice.' -- > ';
//print_r($valor);
}
$dia1 = $dia1.'<tr id="subtotal"><td colspan="3">Total para o dia 01:</td><td id="moeda">'
		.number_format($totDia1,2,',','.').'</td><td></td></tr>';
$dia15 = $dia15.'<tr id="subtotal"><td colspan="3">Total para o dia 15:</td><td id="moeda">'
		.number_format($totDia15,2,',','.').'</td><td></td></tr>';
$diaOutros = $diaOutros.'<tr id="subtotal"><td colspan="3">Total para os demais dias:</td><td id="moeda">'
		.number_format($totOutros,2,',','.').'</td><td></td></tr>';
$nivel1 = $dia1.$dia15.$diaOutros;
$debito = $totDia1+$totDia15+$totOutros;