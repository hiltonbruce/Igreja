<?php
while ($contas = mysql_fetch_array($lista)) {

	$mesr 		= $contas['mesrefer'];
	$anor 		= $contas['anorefer'];
	if ($menorAno>$anor || $menorAno == 0) {
		$menorAno=$anor;
	}
	if ($maiorAno<$anor || $maiorAno ==0) {
		$maiorAno=$anor;
	}
	$periodo	= "$mesr$anor";
	$dz 		= 'dizimos'."$mesr$anor";
	$ofc 		='ofertaCultos'."$mesr$anor";
	$ofCampanha ='ofertaCampanha'."$mesr$anor";
	$ofm 		='ofertaMissoes'."$mesr$anor";
	$ofs 		='ofertaSenhoras'."$mesr$anor";
	$ofe 		='ofertaEnsino'."$mesr$anor";
	$ofmoc 		='ofertaMocidade'."$mesr$anor";
	$ofi 		='ofertaInfantil'."$mesr$anor";
	$dev 		= (int)$contas['devedora'];
	$valor 		= $contas['valor'];

	  switch ($dev) {
	  	case 1:
	  		//Dizimos e ofertas
	  	if ($contas['credito']=='700') {
				$$dz 		+= $valor;
				$totDizimo 	+= $valor;
	  		}elseif ($contas['credito']>'729' && $contas['credito']<'800') {
				$$ofCampanha += $valor;
				$totOfertaCampanha += $valor;
			}else {
				$$ofc += $valor;
				$totOfertaCultos += $valor;
			}
	  	break;
	  	case 2:
	  		//Oferta Missoes
			$$ofm 		+= $valor;
			$totMissoes += $valor;
	  	break;
	  	case 3:
	  		//Oferta Senhoras
			$$ofs 		 += $valor;
			$totSenhoras += $valor;
	  	break;
	  	case 4:
	  		//Oferta Ensino
			$$ofe 		+= $valor;
			$totEnsino 	+= $valor;
	  	break;
	  	case 5:
	  		//Oferta Infantil
			$$ofi			+= $valor;
			$totInfantil 	+= $valor;
	  		
	  	break;
	  	case 8:
	  		//Oferta Mocidade
			$$ofmoc 			+= $valor;
			$totMocidade 	+= $valor;	  		
	  	break;
	  	default:
	  		$linhaCargo = 'Falha';
	  	break;
	  }

				//echo '<h2> contas[valor] = R$ '.$contas['valor'].'<h2>';
				//echo $dz.'   ** '.$$dz.'   ** '.$dev.' -->';
}

?>