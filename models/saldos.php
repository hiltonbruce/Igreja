<?php
$nivel1 	= '';
$nivel2 	= '';
$comSaldo	= '';
$lista = mysql_query('SELECT * FROM contas ORDER BY codigo ');
while ($contas = mysql_fetch_array($lista)) {

		if ($contas['saldo']<'0' && $contas['tipo']=='D') {
		   $tipoCta = 'C';
		}elseif ($contas['saldo']<'0' && $contas['tipo']=='C') {
		  $tipoCta = 'D';
		}else {
		 $tipoCta = $contas['tipo'];
		}
		$sldConta = (abs($contas['saldo']));
		
	$acesso = ($contas['acesso']>0) ? sprintf("[%04s]\n", $contas['acesso']):'';
	//Balancete de todas as contas
		$title = $contas['descricao'];
	if (strlen($contas['codigo'])<10) {
		//Grupo de contas
		$bgcolor = 'style="background:#C9DBF2;color:#000;border-bottom: 1px dashed #1e90ff;"';
		$nivel1 .='<tr '.$bgcolor.'><td>'.$contas['codigo'].'</td><td>'.$acesso.'</td><td title="'.$title.'">'.$contas['titulo'].
		'</td><td></td><td id="moeda">'.number_format($sldConta,2,',','.').$tipoCta.'</td></tr>';
		$cor= true;
	}else {
		//Contas
		$bgcolor = $cor ? 'class="dados"' : 'class="odd"';
		
		
		$nivel1 .='<tr '.$bgcolor.'><td>'.$contas['codigo'].'</td><td>'.$acesso.
				'</td><td title="'.$title.'">'.$contas['titulo'].'</td><td id="moeda">'
				.number_format($sldConta,2,',','.').$tipoCta.'</td><td></td></tr>';
		$cor = !$cor;
	}

	//Balancete de todas as contas com saldo
	if ($contas['saldo']!=0) {
		if (strlen($contas['codigo'])<10) {
			//Grupo de contas
			$bgcolor2 = 'style="background:#C9DBF2; color:#000;border-bottom: 1px dashed #000;border-top: 1px dashed #000;"';
			$nivel2 .='<tr '.$bgcolor2.'><td>'.$contas['codigo'].'</td><td>'.$acesso.'</td><td title="'.$title.'">'.$contas['titulo'].
			'</td><td id="moeda">'.number_format($sldConta,2,',','.').$tipoCta.'</td><td></td></tr>';
			$cor2 = true;
		}else {
			//Contas
			$bgcolor2 = $cor2 ? 'style="background:#ffffff;color:#000;"' : 'style="background:#d0d0d0;color:#000;"';
			$nivel2 .='<tr '.$bgcolor2.'><td>'.$contas['codigo'].'</td><td>'.$acesso.'</td>
					<td title="'.$title.'">'.$contas['titulo'].'</td><td></td><td id="moeda">'
					.number_format($sldConta,2,',','.').$tipoCta.'</td></tr>';
			$cor2 = !$cor2;
		}
	}
	if ($contas['tipo']=='D' && $contas['acesso']!='0') {
		$debito += $contas['saldo'];
	}elseif ($contas['tipo']=='C' && $contas['acesso']!='0') {
		$credito += $contas['saldo'];
	}
}