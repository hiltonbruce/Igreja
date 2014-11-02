<?php
	if (empty($_GET['ano'])) {
		$ano = date ('Y	');
	}else {
		$ano = (int)$_GET['ano'];
	}
	
	//Loops para o corpo da tabela
	$igrejas = new igreja();$linha='';
	
	$cor= true;
	foreach ($igrejas->ArrayIgrejaDados() as $igrejaDados) {
		$saldos = new tes_igreja ($igrejaDados['rol'],$ano);
		$valores = $saldos->ArraySaldos();
		$bgcolor = $cor ? 'class="dados"' : 'class="odd"';
		
		//Monta link para detalhar a igreja
		if ($_GET['rec']=='13') {
			$linkIgreja = $igrejaDados['razao'];
		}else {
			$linkIgreja  = '<a href="./?escolha=tesouraria/receita.php&menu=top_tesouraria';
			$linkIgreja .= '&igreja='.$igrejaDados['rol'].'&ano='.$_GET['ano'].'&fin=2&';
			$linkIgreja .= 'rec=11&direita=1" title="Detalhar entradas">'.$igrejaDados['razao'].'</a>';
		}
		
		$linha .= '<tr '.$bgcolor.'><td>'.$linkIgreja.'</td>';
		//print_r( $saldos->ArraySaldos());echo '<br />';
		for ($i = 1; $i < 13; $i++) {
			$entrada =($valores[$i]>0) ? number_format($valores[$i],2,',','.'):'---';
			$linha .= '<td id="moeda">'.$entrada.'</td>';
			$total += $valores[$i];
			$totalMes[$i] += $valores[$i];
		}
		
		$linha .= '<td id="moeda">'.number_format($total,2,',','.').'</td></tr>';
		$totalGeral += $total;
		$total = 0;
		$cor = !$cor;
	}
	
	
	//Cabeçalho da tabela
	$colgroup = '<col id="igreja">';
	$tabThead = '<tr><th scope="col">Igrejas</th>';
	$tabFoot = '<tr id="total"><td>Totais</td>';
	
	foreach(arrayMeses() as $mes => $meses) {
		$colgroup .= '<col id="'.substr($meses, 0, 3).'">';
		$tabThead .= '<th scope="col" class="centro">'.substr($meses, 0, 3).'</th>';
		$tabFoot  .= '<td id="moeda">'.number_format($totalMes[(int)$mes],2,',','.').'</td>';
	}
	$colgroup .= '<col id="Total">';
	$tabThead .= '<th scope="col"  class="centro">Total</th></tr>';
	$tabFoot  .= '<td id="moeda">'.number_format($totalGeral,2,',','.').'</td></tr>';
		
?>