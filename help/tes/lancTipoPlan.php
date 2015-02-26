<?php
$ctaDespesa = new tes_despesas();
$dia1 ='';$listDesp = '';
$cor=true;
//print_r($ctaDespesa->dadosArray());
foreach ($ctaDespesa->dadosArray() as $chave => $valor) {
	//Variéveis para montagem do form
	$campoHist = '<label>Hit&oacute;rico</label><textarea name="hist'.$chave.'" class="form-control"></textarea>';
	$bsccredor = new List_sele('igreja', 'razao','rolIgreja'.$chave);
	$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],'class="form-control" required="required" autofocus="autofocus" ');
	$campoValor = '<label>Valor</label><input name="valor'.$chave.'" class="form-control"/>';

if ($codigo5!=$valor['codigo'] && strlen($valor['codigo'])=='9') {
	$listDesp .= $cabDespesa.$dia1.'</tbody>';
	$dia1='';$cabDespesa='';
}
	if (strlen($valor['codigo'])=='13') {
		$bgcolor = $cor ? 'class="dados"' : 'class="odd"';
		//Lista das despesas disponíveis
		$dia1 .='<tr '.$bgcolor.'><td>'.$valor['codigo'].'-<abbr title="'.$valor['descricao'].'">'
		.$valor['titulo'].'</abbr></td>	<td>'.$campoHist.'</td>
		<td><label>Igreja</label>'.$listaIgreja.
		'</td><td>'.$campoValor.'</td></tr>';
		$cor = !$cor;
	} elseif (strlen($valor['codigo'])=='9') {
		$cabDespesa = '<tbody><tr id="subtotal" class="sub">
		<th colspan="4"><strong>'.$valor['codigo'].'</strong> - '.$valor['titulo'].'</th>
		</tr>';
	}/*elseif (strlen($valor['codigo'])=='5') {
		$codigo5 = $valor['codigo'];
	}
echo($valor['codigo']).' **-> '.strlen($valor['codigo']).' === ';*/
}

$nivel1 = $listDesp;
