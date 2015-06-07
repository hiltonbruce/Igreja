<?php
$ctaDespesa = new tes_despesas();
$bsccredor = new tes_listDisponivel();
$listaFonte = $bsccredor->List_Selec($_GET['acesso']);
$dia1 ='';$listDesp = '';
$cor=true;
$lancar = '<br /><br /><button class="btn btn-primary">Lan&ccedil;ar!</button>';

//print_r($ctaDespesa->dadosArray());
foreach ($ctaDespesa->dadosArray() as $chave => $valor) {
	//Variéveis para montagem do form

	$dataLan = '<label>Data do lan&ccedil;amento</label>'.
			'<input name="data'.$chave.'" class="form-control dataclass" value="'.date('d/m/Y').'"';
	$campoHist = '<label>Hit&oacute;rico</label><textarea name="hist'.$chave.'" class="form-control"></textarea>';
	$bsccredor = new List_sele('igreja', 'razao','rolIgreja'.$chave);
	$listaIgreja = $bsccredor->List_Selec('',$_GET['igreja'],'class="form-control" required="required" autofocus="autofocus" ');
	$campoValor = '<label>Valor</label><input name="valor'.$chave.'" class="form-control"/>';
	$conta ='<input name="acesso'.$chave.'" type="hidden" value="'.$valor['acesso'].'">';

if ($codigo5!=$valor['codigo'] && strlen($valor['codigo'])=='9') {
	$listDesp .= $cabDespesa.$dia1.'</tbody></table></form>';
	$dia1='';$cabDespesa='';
}
	if (strlen($valor['codigo'])=='13') {
		$bgcolor = $cor ? 'class="dados"' : 'class="odd"';
		//lista dos caixas disponíveis para pgto
		$fontesPgto  = '<label>Caixas c/ Saldo:</label>';
		$fontesPgto .= '<select name="disponivel'.$chave.'" class="form-control" >';
		$fontesPgto .= $listaFonte;
		$fontesPgto .= '</select>';
		//Lista das despesas disponíveis
		$dia1 .='<tr '.$bgcolor.'><td rowspan="2">'.$valor['codigo'].'-<abbr title="'.$valor['descricao'].'">'
		.$valor['titulo'].$conta.'</abbr><p>'.$fontesPgto.'</p>'.$campoHist.'</td></tr><tr '.$bgcolor.'><td>'.$dataLan.
		'<br /><br /><label><strong>Igreja</strong></label>'.$listaIgreja.
		'</td><td>'.$campoValor.$lancar.'</td></tr>';
		$cor = !$cor;
	} elseif (strlen($valor['codigo'])=='9') {
		$cabDespesa = '<form  method="post"><table id="horario"><tbody><tr id="subtotal" class="sub">
		<th colspan="4"><strong>'.$valor['codigo'].'</strong> - '.$valor['titulo'].'</th>
		</tr>';
	}/*elseif (strlen($valor['codigo'])=='5') {
		$codigo5 = $valor['codigo'];
	}
echo($valor['codigo']).' **-> '.strlen($valor['codigo']).' === ';*/
}

$nivel1 = $listDesp;
