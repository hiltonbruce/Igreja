<?php
//Limpa as variáveis
$ministerio = '';$tesoureiro = '';$auxilio = '';$zeladores = '';$sexta = '';$demaisPgto = '';$rec_tipo=false;

$dia1 ='';$dia15 ='';$diaOutros ='';
$cor=true;$cor1=true;$cor2=true;
foreach ($listaPgto as $chave => $valor) {
	
	$bgcolor = $cor ? 'class="dados"' : 'class="odd"';
	
	$nomeMembro = ($valor['nome']=='') ? $valor['naoMembro']:$valor['nome'];
  	$nomeDiaPgto = $valor['diapgto'];
	
	$remove = '<a href="./?#" title="Remover!"> <span class="glyphicon glyphicon-remove"> </span></a>';
	$nomeMembro = sprintf ("%s %'05u - %s ",$remove,$valor['rolMembro'],$nomeMembro);
	
		//Lista do Ministério
		$dia1 .='<tr '.$bgcolor.'><td>'.$nomeMembro.'</td><td>'.$valor['nomeFunc'].
		'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.$pgto.'</td>
				<td class="text-center">'.$nomeDiaPgto.'</td></tr>';
		$cor = !$cor;
		$totMinisterio += $valor['pgto'];

}
$dia1 .='<tr '.$bgcolor.'><td>'.$nomeMembro.'</td><td>'.$valor['nomeFunc'].
		'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.$pgto.'</td>
		</tr>';

$dia1 = '<tbody><tr id="subtotal" class="sub"><th><strong>Ministério</strong></th><td></td><td></td><td id="moeda">'
		.number_format($totMinisterio,2,',','.').'</td></tr>'.$dia1.'</tbody>';

$nivel1 = $dia1;