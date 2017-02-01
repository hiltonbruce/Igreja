<?php
		$caixaOutros = $caixa['saldo']+$valorDeb+$valorCred;
		//Formatando valores para exibição
		$caixaOutros = ($caixaOutros=='') ? '- o -' : number_format(abs($caixaOutros),2,',','.') ;
		$valorDeb = ($valorDeb=='') ? '' : number_format(abs($valorDeb),2,',','.') ;
		$valorCred = ($valorCred=='') ? '' : number_format(abs($valorCred),2,',','.') ;
		$sldAntDev = number_format($caixa['saldo'],2,',','.');

		$exibi  ='<tr><td>'.$caixa['codigo'].' - '.$caixa['titulo'].'</td>';
		$exibi .='<td class="text-right">'.$valorDeb.'</td>';
		$exibi .='<td class="text-right">'.$valorCred.'</td>';
		$exibi .='<td class="text-right">&nbsp;'.$caixaOutros.'&nbsp;<strong>'.$tipoDC;
		$exibi .='</strong></td><td class="text-right">'.$sldAntDev.'&nbsp;<strong>'.$tipoDC;
		$exibi .='</strong></td></tr>';
//$corlinha = !$corlinha;
