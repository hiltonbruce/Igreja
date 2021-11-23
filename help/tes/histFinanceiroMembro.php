<?php
while ($contas = mysql_fetch_array($lista)) {

	$mesr 		= $contas['mes'];
	$anor 		= $contas['ano'];
	$semana 	= $contas['semana'];

	if ($menorAno>$anor || $menorAno == 0) {
		$menorAno=$anor;
	}
	if ($maiorAno<$anor || $maiorAno ==0) {
		$maiorAno=$anor;
	}

	$periodo	= "$mesr$anor";
	$dz 		= 'dizimos'.$periodo;//dizimos do mês
	$dizSem 	= $dz.$semana;//Dizimos do mÃªs separando a semana

	$ofExtra	= 'ofertaExtra'.$periodo;//Ofertas do mÃªs
	$ofExtraSem	= $ofExtra.$semana;//Ofertas do mÃªs separando a semana

	$ofc 		= 'ofertaCultos'.$periodo;//Ofertas do mÃªs
	$ofcSem 	= $ofc.$semana;//Ofertas do mÃªs separando a semana

	$ofCampanha = 'ofertaCampanha'.$periodo;//Ofertas das Campanhas do mÃªs
	$ofCampSem  = $ofCampanha.$semana;//Ofertas das Campanhas do mÃªs separando a semana

	$ofm 		= 'ofertaMissoes'.$periodo;//Ofertas de missÃµes do mÃªs
	$ofmSem 	= $ofm.$semana;//Ofertas de missÃµes do mÃªs separando a semana

	$ofs 		= 'ofertaSenhoras'.$periodo;//Ofertas de Senhoras do mÃªs
	$ofsSem		= $ofs.$semana;//Ofertas de Senhoras do mÃªs separando a semana

	$ofe 		= 'ofertaEnsino'.$periodo;//Ofertas de Escola BÃ­blica do mÃªs
	$ofeSem 	= $ofe.$semana;

	$ofmoc 		= 'ofertaMocidade'.$periodo;
	$ofmocSem 	= $ofmoc.$semana;

	$ofi 		= 'ofertaInfantil'.$periodo;
	$ofiSem 	= $ofi.$semana;

	$dev 		= intval($contas['devedora']);
	$valor 		= $contas['valor'];

	  switch ($dev) {
	  	case 1:
	  		//Dizimos e ofertas
	  	if ($contas['credito']=='700' || $contas['credito']=='704') {
				$$dz 		+= $valor;
				$$dizSem 	+= $valor;
				$totDizimo 	+= $valor;
	  		}elseif ($contas['credito']>'729' && $contas['credito']<'800') {
				$$ofCampanha += $valor;
				$$ofCampSem   += $valor;
				$totOfertaCampanha += $valor;
			}elseif ($contas['credito']=='704') {
				//ofertas extra
				$$ofExtra 		+= $valor;
				$$ofExtraSem   	+= $valor;
				$totOfertaExtra += $valor;
			}else {
				$$ofc += $valor;
				$$ofcSem += $valor;
				$totOfertaCultos += $valor;
			}
	  	break;
	  	case 20:
			//Dizimos e ofertas
		if ($contas['credito']=='700' || $contas['credito']=='704') {
			  $$dz 		+= $valor;
			  $$dizSem 	+= $valor;
			  $totDizimo 	+= $valor;
		}elseif ($contas['credito']>'729' && $contas['credito']<'800') {
			  $$ofCampanha += $valor;
			  $$ofCampSem   += $valor;
			  $totOfertaCampanha += $valor;
		  }elseif ($contas['credito']=='702') {
			  //ofertas extra
			  $$ofExtra 		+= $valor;
			  $$ofExtraSem   	+= $valor;
			  $totOfertaExtra += $valor;
		  }elseif ($contas['credito']=='701') {
			  $$ofc += $valor;
			  $$ofcSem += $valor;
			  $totOfertaCultos += $valor;
		  }else {
			  #Receitas não operacionais
			  $$ofNaoOp += $valor;
			  $$ofNaoOpSem += $valor;
			  $totOfertaNaoOpAno += $valor;
		  }
		break;

		case 30:
			//Dizimos e ofertas
		if ($contas['credito']=='700' || $contas['credito']=='704') {
			  $$dz 		+= $valor;
			  $$dizSem 	+= $valor;
			  $totDizimo 	+= $valor;
		}elseif ($contas['credito']>'729' && $contas['credito']<'800') {
			  $$ofCampanha += $valor;
			  $$ofCampSem   += $valor;
			  $totOfertaCampanha += $valor;
		  }elseif ($contas['credito']=='702') {
			  //ofertas extra
			  $$ofExtra 		+= $valor;
			  $$ofExtraSem   	+= $valor;
			  $totOfertaExtra += $valor;
		  }elseif ($contas['credito']=='701') {
			  $$ofc += $valor;
			  $$ofcSem += $valor;
			  $totOfertaCultos += $valor;
		  }else {
			  #Receitas não operacionais
			  $$ofNaoOp += $valor;
			  $$ofNaoOpSem += $valor;
			  $totOfertaNaoOpAno += $valor;
		  }
		break;
	  	case 2:
			if ($contas['credito']>'819' && $contas['credito']<'840') {
				//Oferta Missoes
			  $$ofm 	+= $valor;
			  $$ofmSem	+= $valor;
			  $totMissoes += $valor;
			}else{
				#Receitas não operacionais
				$$ofNaoOp += $valor;
				$$ofNaoOpSem += $valor;
				$totOfertaNaoOpAno += $valor;
			}
	  	break;
	  	case 3:
			if ($contas['credito']>'719' && $contas['credito']<'730') {
				//Oferta Senhoras
				$$ofs 		 += $valor;
				$$ofsSem	 += $valor;
				$totSenhoras += $valor;
			}else{
				#Receitas não operacionais
				$$ofNaoOp += $valor;
				$$ofNaoOpSem += $valor;
				$totOfertaNaoOpAno += $valor;
			}
	  	break;
	  	case 4:
			if ($contas['credito']>'799' && $contas['credito']<'820') {
				//Oferta Ensino
			$$ofe 		+= $valor;
			$$ofeSem	+= $valor;
			$totEnsino 	+= $valor;
			}else{
				#Receitas não operacionais
				$$ofNaoOp += $valor;
				$$ofNaoOpSem += $valor;
				$totOfertaNaoOpAno += $valor;
			}
	  	break;
	  	case 5:
			if ($contas['credito']>'979' && $contas['credito']<'1000') {
				//Oferta Infantil
			$$ofi			+= $valor;
			$$ofiSem		+= $valor;
			$totInfantil 	+= $valor;
			}else{
				#Receitas não operacionais
				$$ofNaoOp += $valor;
				$$ofNaoOpSem += $valor;
				$totOfertaNaoOpAno += $valor;
			}
	  	break;
	  	case 8:
			if ($contas['credito']>'429' && $contas['credito']<'440') {
				if ($dev>7 && $dev<13) {
					//Oferta Mocidade
				  $$ofmoc 		+= $valor;
				  $$ofmocSem 		+= $valor;
				  $totMocidade 	+= $valor;
				} else {
				$linhaCargo = 'definir cta script histFinaceiroIgreja.php';
					//Outras entradas nÃ£o classificadas
					  #Receitas não operacionais
					  $$ofNaoOp += $valor;
					  $$ofNaoOpSem += $valor;
					  $totOfertaNaoOpAno += $valor;
			  }
			}else{
				#Receitas não operacionais
				$$ofNaoOp += $valor;
				$$ofNaoOpSem += $valor;
				$totOfertaNaoOpAno += $valor;
			}
	  	break;
	  	default:
	  		$linhaCargo = 'Falha';
	  	break;
	  }

				//echo '<h2> contas[valor] = R$ '.$contas['valor'].'<h2>';
				//echo $dz.'   ** '.$$dz.'   ** '.$dev.' -->';
}

?>
