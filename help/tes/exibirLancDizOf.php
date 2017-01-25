<?php
//Formatando valores para exibição
//$caixaOutros = ($caixaOutros=='') ? '- o -' : number_format(abs($caixaOutros),2,',','.') ;
$cxDeb = 'cxDeb'.$debitar;
$cxFmt = 'cxFmt'.$debitar;
$$cxDeb +=$valor;
$cxSaldo = number_format(abs($caixa['saldo'] + $$cxDeb),2,',','.') ;
$$cxFmt = number_format(abs($$cxDeb),2,',','.');
$sldCxAnt = number_format(abs($caixa['saldo']),2,',','.');
//$sldAntDev = number_format($caixa['saldo'],2,',','.');
//Monta linha da tabela para exibição
$tabLinha  = '<tr><td>'.$caixa['codigo'].' - '.$caixa['titulo'].'</td>';
$tabLinha .= '<td class="text-right">'.$$cxFmt.'</td>';
$tabLinha .= '<td>&nbsp;</td>';
$tabLinha .= '<td class="text-right">'.$cxSaldo.'&nbsp;'.$tipoDC.'</td>';
$tabLinha .= '<td class="text-right">'.$sldCxAnt.'&nbsp;'.$tipoDC.'</td></tr>';
//Distribui as linhas para cada caixa específico
switch ($debitar) {
	case '1':
	 	$exibiCentral = $tabLinha;
	break;
	case '2':
	 	$exibiMissoes  = $tabLinha;
	break;
	case '3':
	 	$exibiSenhoras  = $tabLinha;
	break;
	case '4':
	 	$exibiEnsino  = $tabLinha;
	break;
	case '5':
	 	$exibiInfantil = $tabLinha;
	break;
	case '8':
	 	$exibiMocidade = $tabLinha;
	break;
	default:
		$exibi  = $tabLinha;
	break;
}
