<?php

$cor = $corlinha ? 'class="odd"' : 'class="dados"';

switch ($debitar) {
	case '1':
	 	$caixaCentral +=$valor;
	 	$corCentral = (empty($corCentral)) ? $cor : $corCentral;
	 	$exibiCentral = sprintf("<tr $corCentral ><td>%s - %s</td><td id='moeda'>%s
	 					</td><td>&nbsp;</td><td id='moeda'>%s&nbsp;%s</td></tr>",$caixa->codigo(),
	 					$caixa->titulo(),number_format($caixaCentral,2,',','.'),
	 					number_format($caixa->saldo(),2,',','.'),$devedora->tipo());
	break;
	case '2':
	 	$caixaMissoes +=$valor;
	 	$corMissoes = (empty($corMissoes)) ? $cor : $corMissoes;
	 	$exibiMissoes = sprintf("<tr $corMissoes ><td>%s - %s</td><td id='moeda'>%s
	 					</td><td>&nbsp;</td><td id='moeda'>%s&nbsp;%s</td></tr>",$caixa->codigo(),
	 					$caixa->titulo(),number_format($caixaMissoes,2,',','.'),
	 					number_format($caixa->saldo(),2,',','.'),$devedora->tipo());
	break;
	case '3':
	 	$caixaSenhoras +=$valor;
	 	$corSenhoras = (empty($corSenhoras)) ? $cor : $corSenhoras;
	 	$exibiSenhoras = sprintf("<tr $corSenhoras ><td>%s - %s</td><td id='moeda'>%s
	 					</td><td>&nbsp;</td><td id='moeda'>%s&nbsp;%s</td></tr>",$caixa->codigo(),
	 					$caixa->titulo(),number_format($caixaSenhoras,2,',','.'),
	 					number_format($caixa->saldo(),2,',','.'),$devedora->tipo());
	break;
	case '4':
	 	$caixaEnsino +=$valor;
	 	$corEnsino = (empty($corEnsino)) ? $cor : $corEnsino;
	 	$exibiEnsino = sprintf("<tr $cor ><td>%s - %s</td><td id='moeda'>%s
	 					</td><td>&nbsp;</td><td id='moeda'>%s&nbsp;%s</td></tr>",$caixa->codigo(),
	 					$caixa->titulo(),number_format($caixaEnsino,2,',','.'),
	 					number_format($caixa->saldo(),2,',','.'),$devedora->tipo());
	break;
	case '5':
	 	$caixaInfantil +=$valor;
	 	$corInfantil = (empty($corInfantil)) ? $cor : $corInfantil;
	 	$exibiInfantil = sprintf("<tr $corInfantil ><td>%s - %s</td><td id='moeda'>%s
	 					</td><td>&nbsp;</td><td id='moeda'>%s&nbsp;%s</td></tr>",$caixa->codigo(),
	 					$caixa->titulo(),number_format($caixaInfantil,2,',','.'),
	 					number_format($caixa->saldo(),2,',','.'),$devedora->tipo());
	break;
	case '8':
	 	$caixaMocidade +=$valor;
	 	$corMocidade = (empty($corMocidade)) ? $cor : $corMocidade;
	 	$exibiMocidade = sprintf("<tr $corMocidade ><td>%s - %s</td><td id='moeda'>%s
	 					</td><td>&nbsp;</td><td id='moeda'>%s&nbsp;%s</td></tr>",$caixa->codigo(),
	 					$caixa->titulo(),number_format($caixaMocidade,2,',','.'),
	 					number_format($caixa->saldo(),2,',','.'),$devedora->tipo());
	break;
	default:
		$caixaOutros +=$valor;
 		$corOutros = (empty($corOutros)) ? $cor : $corOutros;
		$exibi = sprintf("<tr $corOutros ><td>%s - %s</td><td id='moeda'>%s
				</td><td>&nbsp;</td><td id='moeda'>%s&nbsp;%s</td></tr>",$caixa->codigo(),
				$caixa->titulo(),number_format($caixaOutros,2,',','.'),
				number_format($caixa->saldo(),2,',','.'),$devedora->tipo());
	break;
}
$corlinha = !$corlinha;
