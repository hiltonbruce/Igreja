<?php
$totInfantil = 0;
//print_r($descCta);
while ($contas = mysql_fetch_array($lista)) {
	$mesr 		= $contas['mes'];
	$anor 		= $contas['ano'];
	$semana 	= $contas['semana'];
	$igreja		= $contas['igreja'];
	if ($menorAno>$anor || $menorAno == 0) {
		$menorAno=$anor;
	}
	if ($maiorAno<$anor || $maiorAno ==0) {
		$maiorAno=$anor;
	}
	$periodo	= "$igreja$anor";
	$dz 		= 'dizimos'.$periodo;//dizimos do mês
	$dizSem 	= $dz.$semana;//Dizimos do mês separando a semana
	$ofExtra	= 'ofertaExtra'.$periodo;//Ofertas do mês
	$ofExtraSem	= $ofExtra.$semana;//Ofertas do mês separando a semana
	$ofc 		= 'ofertaCultos'.$periodo;//Ofertas do mês
	$ofcSem 	= $ofc.$semana;//Ofertas do mês separando a semana
	$ofNaoOp 		= 'ofertaNaoOp'.$periodo;//Ofertas do mês
	$ofNaoOpSem 	= $ofNaoOp.$semana;//Ofertas do mês separando a semana
	$ofCampanha = 'ofertaCampanha'.$periodo;//Ofertas das Campanhas do mês
	$ofCampSem  = $ofCampanha.$semana;//Ofertas das Campanhas do mês separando a semana
	$ofm 		= 'ofertaMissoes'.$periodo;//Ofertas de missões do mês
	$ofmSem 	= $ofm.$semana;//Ofertas de missões do mês separando a semana
	$ofs 		= 'ofertaSenhoras'.$periodo;//Ofertas de Senhoras do mês
	$ofsSem		= $ofs.$semana;//Ofertas de Senhoras do mês separando a semana
	$ofe 		= 'ofertaEnsino'.$periodo;//Ofertas de Escola Bíblica do mês
	$ofeSem 	= $ofe.$semana;
	$ofmoc 		= 'ofertaMocidade'.$periodo;
	$ofmocSem 	= $ofmoc.$semana;
	$ofi 		= 'ofertaInfantil'.$periodo;
	$ofiSem 	= $ofi.$semana;
	$demEntr	= 'outrasEntr'.$periodo;
	$demEntrSem	= $demEntr.$semana;
	$dev 		= intval($contas['devedora']);
	$cre 		= intval($contas['credito']);//Fazer a remoção da parte credora
	$valor 	= $contas['valor'];

//	echo $descCta['840']['nivel2'].' -- '.$cre.' ++ ';

	if ($descCta[$cre]['nivel2']=='4.2') {
		#Receitas n�o operacionais
		$$ofNaoOp += $valor;
		$$ofNaoOpSem += $valor;
		$totOfertaNaoOpAno += $valor;
	} else {
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
				#Receitas n�o operacionais
				$$ofNaoOp += $valor;
				$$ofNaoOpSem += $valor;
				$totOfertaNaoOpAno += $valor;
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
			  #Receitas n�o operacionais
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
			  #Receitas n�o operacionais
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
			#Receitas n�o operacionais
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
				#Receitas n�o operacionais
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
				#Receitas n�o operacionais
				$$ofNaoOp += $valor;
				$$ofNaoOpSem += $valor;
				$totOfertaNaoOpAno += $valor;
			}
			break;
	  	case 5:
			if ($contas['credito']>'949' && $contas['credito']<'980') {
				//Oferta Infantil
			$$ofi			+= $valor;
			$$ofiSem		+= $valor;
			$totInfantil 	+= $valor;
			}else{
				#Receitas n�o operacionais
				$$ofNaoOp += $valor;
				$$ofNaoOpSem += $valor;
				$totOfertaNaoOpAno += $valor;
			}
			break;
	  	default:

		if ($contas['credito']>'899' && $contas['credito']<'950') {
			if ($dev>7 && $dev<13) {
				//Oferta Mocidade
			  $$ofmoc 		+= $valor;
			  $$ofmocSem 		+= $valor;
			  $totMocidade 	+= $valor;
			} else {
			$linhaCargo = 'definir cta script histFinaceiroIgreja.php';
				//Outras entradas não classificadas
				  #Receitas n�o operacionais
				  $$ofNaoOp += $valor;
				  $$ofNaoOpSem += $valor;
				  $totOfertaNaoOpAno += $valor;
		  }
		}else{
			#Receitas n�o operacionais
			$$ofNaoOp += $valor;
			$$ofNaoOpSem += $valor;
			$totOfertaNaoOpAno += $valor;
		}
	  	break;
	  }
	}
				//echo '<h2> contas[valor] = R$ '.$contas['valor'].'<h2>';
				//echo $dz.'   ** '.$$dz.'   ** '.$dev.' -->';
}

?>
