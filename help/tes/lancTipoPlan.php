<?php
$ctaDespesa = new tes_despesas();
$dia1 ='';$listDesp = '';
$cor=true;
//print_r($ctaDespesa->dadosArray());
foreach ($ctaDespesa->dadosArray() as $chave => $valor) {
if ($codigo5!=$valor['codigo'] && strlen($valor['codigo'])=='9') {
	$listDesp .= $cabDespesa.$dia1.'</tbody>';
	$dia1='';$cabDespesa='';
}
	if (strlen($valor['codigo'])=='13') {
		$bgcolor = $cor ? 'class="dados"' : 'class="odd"';
		//Lista das despesas disponíveis
		$dia1 .='<tr '.$bgcolor.'><td>'.$valor['codigo'].'</td><td title="'.$valor['descricao'].'">
		'.$valor['titulo'].'</td><td>'.$campoIgreja.
		'</td><td id="moeda">'.$campoValor.'</td></tr>';
		$cor = !$cor;
	} elseif (strlen($valor['codigo'])=='9') {
		$cabDespesa = '<tbody><tr id="subtotal" class="sub"><th><strong>'.$valor['codigo'].'</strong></th>
		<td colspan="3">'.$valor['titulo'].'</td></tr>';
	}/*elseif (strlen($valor['codigo'])=='5') {
		$codigo5 = $valor['codigo'];
	}
echo($valor['codigo']).' **-> '.strlen($valor['codigo']).' === ';*/
}
//Título geral (Cabeçalho) do form para cada despesas
$dia1 = '<tbody><tr id="subtotal" class="sub"><th><strong>Ministério</strong></th><td></td><td></td><td id="moeda">'
		.number_format($totMinisterio,2,',','.').'</td></tr>'.$dia1.'</tbody>';

$nivel1 = $listDesp;
