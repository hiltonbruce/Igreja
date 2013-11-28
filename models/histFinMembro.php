<?php
$nivel1 	= '';
$nivel2 	= '';
$comSaldo	= '';
$lista = mysql_query('SELECT * FROM dizimooferta WHERE lancamento=1 AND rol='.$bsc_rol.' ORDER BY anorefer,mesrefer ');
while ($contas = mysql_fetch_array($lista)) {

	$mesr = $contas['mesrefer'];
	$anor = $contas['anorefer'];
	$periodo = "$mesr$anor";
	$dz = 'dizimos'."$mesr$anor";
	
	switch ($contas['devedora']){
		case 1://Dizimo
			if ($contas['credora']=='700') {
				$$dz += $contas['valor'];
				$totDizimo += $contas['valor'];
			}else {
				$ofertaCultos.$contas['mesrefer'].$contas['anorefer'] += $contas['valor'];
				$totOfertaCultos += $contas['valor'];
			}
		;
		break;
		case 2://Oferta Missoes
			$ofertaMissoes.$contas['mesrefer'].$contas['anorefer'] += $contas['valor'];
				$totMissoes += $contas['valor'];
		break;
		case 3://Oferta Senhoras
			$ofertaSenhoras.$contas['mesrefer'].$contas['anorefer'] += $contas['valor'];
			$totSenhoras += $contas['valor'];
		break4;
		
		case 5://Oferta Ensino
			$ofertaEnsino.$contas['mesrefer'].$contas['anorefer'] += $contas['valor'];
			$totEnsino += $contas['valor'];
		break;
		case 6://Oferta Infantil
			$ofertaInfantil.$contas['mesrefer'].$contas['anorefer'] += $contas['valor'];
			$totInfantil += $contas['valor'];
		break;
		case 8://Oferta Mocidade
			$ofertaMocidade.$contas['mesrefer'].$contas['anorefer'] += $contas['valor'];
			$totMocidade += $contas['valor'];
		break;
		
		default:
			;
		break;
	}
}
	
	$ano = 2013;
	$cor= true;
	for ($cont=1; $cont<13 ; $cont++){
		$bgcolor = $cor ? 'style="background:#ffffff"' : 'style="background:#d0d0d0"';
		$dz = 'dizimos'."$cont$ano"; $of = $ofertaCultos."$cont$ano"; $om = $ofertaMissoes."$cont$ano";
		$os = $ofertaSenhoras."$cont$ano"; $om = $ofertaMocidade."$cont$ano"; $oi = $ofertaInfantil."$cont$ano";
		 $oe = $ofertaEnsino."$cont$ano";
		$nivel1 .= '<tr '.$bgcolor.'><td>'.$cont.'/'.$ano.'</td>';
		$nivel1 .= '<td id="moeda">'.$dz.$$dz.'</td>';
		$nivel1 .= '<td id="moeda">'.$of.'</td>';
		$nivel1 .= '<td id="moeda">'.$om.'</td>';
		$nivel1 .= '<td id="moeda">'.$os.'</td>';
		$nivel1 .= '<td id="moeda">'.$om.'</td>';
		$nivel1 .= '<td id="moeda">'.$oi.'</td>';
		$nivel1 .= '<td id="moeda">'.$oe.'</td>';
		$cor = !$cor;
	}