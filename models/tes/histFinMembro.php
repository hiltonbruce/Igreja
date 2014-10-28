<?php
$nivel1 	= '';
$nivel2 	= '';
$comSaldo	= '';$menorAno = 0;$maiorAno=0;
switch ($hisFinanceiro) {
	case 1:
		$lista = mysql_query('SELECT * FROM dizimooferta WHERE lancamento<>"0" AND rol="'.$bsc_rol.'" AND credito!="803" AND credito!="803" ORDER BY anorefer,mesrefer ');
	break;
	case 2:
		$lista = mysql_query('SELECT * FROM dizimooferta WHERE lancamento<>"0" AND igreja="'.$igreja.'" ORDER BY anorefer,mesrefer ');
	break;
	case 4:
		$lista = mysql_query('SELECT * FROM dizimooferta WHERE lancamento<>"0" AND igreja="'.$igreja.'" AND DATE_FORMAT(data,"%m%Y")="'.$mesAno.'" ORDER BY anorefer,mesrefer ');
	break;
	default:
		$lista = mysql_query('SELECT * FROM dizimooferta WHERE lancamento<>"0" ORDER BY anorefer,mesrefer ');
	break;
}


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
	if ($_GET['ano']=='') {
		$ano = date('Y');
	}elseif ($_GET['ano']<$menorAno){
		$ano = $menorAno;
	}elseif ($_GET['ano']>$maiorAno){
		$ano = $maiorAno;
	}else {
		$ano = $_GET['ano'];
	}
	 
	$ano = ($ano=='') ? date('Y'):$ano;
	
	$cor= true;
	for ($cont=1; $cont<13 ; $cont++){
		$bgcolor = $cor ? 'style="background:#ffffff"' : 'style="background:#d0d0d0"';
		$dz = 'dizimos'."$cont$ano"; $of = 'ofertaCultos'."$cont$ano"; $ofm = 'ofertaMissoes'."$cont$ano";
		$ofs = 'ofertaSenhoras'."$cont$ano"; $ofmoc = 'ofertaMocidade'."$cont$ano"; $ofi = 'ofertaInfantil'."$cont$ano";
		$ofe = 'ofertaEnsino'."$cont$ano";$ofCampanha = 'ofertaCampanha'."$cont$ano";
		$totDizAno  += $$dz;$totOfertaAno  += $$of;$totMissoesAno  += $$ofm;$totSenhorasAno  += $$ofs;
		$totMocidadeAno  += $$ofmoc;$totInfantilAno  += $$ofi;$totEnsinoAno  += $$ofe;
		$totCampanhaAno += $$ofCampanha;
		
		$nivel1 .= '<tr '.$bgcolor.'><td>'.sprintf("%02u",$cont ).'/'.$ano.'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$dz,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$of,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofCampanha,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofm,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofs,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofmoc,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofi,2,',','.').'</td>';
		$nivel1 .= '<td id="moeda">'.number_format($$ofe,2,',','.').'</td>';
		$cor = !$cor;
	}