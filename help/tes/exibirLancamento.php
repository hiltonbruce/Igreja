<?php
switch ($debitar) {
	case '1':
	 	$caixaCentral +=$valor;
	 	$exibiCentral = sprintf("<tr><td>%s - %s</td><td id='moeda'>%s
	 					</td><td>&nbsp;</td><td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",$caixa->codigo(),
	 					$caixa->titulo(),number_format($caixaCentral,2,',','.'),
	 					number_format($caixa->saldo(),2,',','.'),$devedora->tipo()
	 					,$sldAntDev);
	break;
	case '2':
	 	$caixaMissoes +=$valor;
	 	$exibiMissoes = sprintf("<tr><td>%s - %s</td><td id='moeda'>%s
	 					</td><td>&nbsp;</td><td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",$caixa->codigo(),
	 					$caixa->titulo(),number_format($caixaMissoes,2,',','.'),
	 					number_format($caixa->saldo(),2,',','.'),$devedora->tipo()
	 					,$sldAntDev);
	break;
	case '3':
	 	$caixaSenhoras +=$valor;
	 	$exibiSenhoras = sprintf("<tr><td>%s - %s</td><td id='moeda'>%s
	 					</td><td>&nbsp;</td><td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",$caixa->codigo(),
	 					$caixa->titulo(),number_format($caixaSenhoras,2,',','.'),
	 					number_format($caixa->saldo(),2,',','.'),$devedora->tipo()
	 					,$sldAntDev);
	break;
	case '4':
	 	$caixaEnsino +=$valor;
	 	$exibiEnsino = sprintf("<tr><td>%s - %s</td><td id='moeda'>%s
	 					</td><td>&nbsp;</td><td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",$caixa->codigo(),
	 					$caixa->titulo(),number_format($caixaEnsino,2,',','.'),
	 					number_format($caixa->saldo(),2,',','.'),$devedora->tipo()
	 					,$sldAntDev);
	break;
	case '5':
	 	$caixaInfantil +=$valor;
	 	$exibiInfantil = sprintf("<tr><td>%s - %s</td><td id='moeda'>%s
	 					</td><td>&nbsp;</td><td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",$caixa->codigo(),
	 					$caixa->titulo(),number_format($caixaInfantil,2,',','.'),
	 					number_format($caixa->saldo(),2,',','.'),$devedora->tipo()
	 					,$sldAntDev);
	break;
	case '8':
	 	$caixaMocidade +=$valor;
	 	$exibiMocidade = sprintf("<tr><td>%s - %s</td><td id='moeda'>%s
	 					</td><td>&nbsp;</td><td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",$caixa->codigo(),
	 					$caixa->titulo(),number_format($caixaMocidade,2,',','.'),
	 					number_format($caixa->saldo(),2,',','.'),$devedora->tipo()
	 					,$sldAntDev);
	break;
	default:
		$caixaOutros +=$valor;
		$exibi = sprintf("<tr><td>%s - %s</td><td id='moeda'>%s
				</td><td>&nbsp;</td><td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",$caixa->codigo(),
				$caixa->titulo(),number_format($caixaOutros,2,',','.'),
				number_format($caixa->saldo(),2,',','.'),$devedora->tipo()
				,$sldAntDev);
	break;
}
$corlinha = !$corlinha;
