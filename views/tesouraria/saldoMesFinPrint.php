<?php
//	require_once ("views/secretaria/menuTopDados.php");
	$igreja = '';
	$hisFinanceiro = 3;
	$cong = 'Todas as Igrejas';

	//require_once 'forms/tes/histFinanceiro.php';
$mes = intval($_GET['mes']);
require_once '../models/tes/histFinIgreja.php';//Tabela com saldos por igreja e semanal

$tabThead = $nivelSem; //Cabe�alho da tabela
$mesPeriodo = sprintf('%02s',$mes);//M�s por extenso
$mesExt = arrayMeses ();
$mesPorExt = $mesExt[$mesPeriodo];
$totSubTotal = $totDizimo+$totOfertaExtra+$totOfertaCultos;
$totGeral = $totSubTotal+$totOfertaCampanha+$totMissoes+$totSenhoras+$totMocidade+$totInfantil+$totEnsino+$totOfertaNaoOpAno;
$totOperacAno = $totSubTotalAno+$totEnsinoAno+$totInfantilAno+$totMocidadeAno+$totSenhorasAno;
$totTotal = $totOperacAno + $totNaoOpAno + $totCampanhaAno + $totMissoesAno;
$totalCong = '<tbody><tr class="active" >';
$totalCong .= '<td class="text-left"> <strong>Congrega&ccedil;&otilde;es:</strong> </td><td id="moeda">'.number_format($totDizAno,2,',','.').'</td>';
$totalCong .= '<td id="moeda">'.number_format($totOfertaExtraAno,2,',','.').'</td>';
$totalCong .= '<td id="moeda">'.number_format($totOfertaAno,2,',','.').'</td>';
$totalCong .= '<td id="moeda">'.number_format($totSubTotalAno,2,',','.').'</td>';
$totalCong .= '<td id="moeda">'.number_format($totSenhorasAno,2,',','.').'</td>';
$totalCong .= '<td id="moeda">'.number_format($totMocidadeAno,2,',','.').'</td>';
$totalCong .= '<td id="moeda">'.number_format($totInfantilAno,2,',','.').'</td>';
$totalCong .= '<td id="moeda">'.number_format($totEnsinoAno,2,',','.').'</td>';
$totalCong .= '<td id="moeda">'.number_format($totOperacAno,2,',','.').'</td>';
$totalCong .= '<td id="moeda">'.number_format($totNaoOpAno,2,',','.').'</td>';
$totalCong .= '<td id="moeda">'.number_format($totCampanhaAno,2,',','.').'</td>';
$totalCong .= '<td id="moeda">'.number_format($totMissoesAno,2,',','.').'</td>';
$totalCong .= '<td id="moeda">'.number_format($totTotal,2,',','.').'</td></tr></tbody>';

$totOperac = $totSubTotal+$totSenhoras+$totMocidade+$totInfantil+$totEnsino;
$totalGeral =  '<tr id="total" class="sub" >';
$totalGeral .= '<td class="text-left">Totais&nbsp;</td><td id="moeda">'.number_format($totDizimo,2,',','.').'</td>';
$totalGeral .= '<td id="moeda">'.number_format($totOfertaExtra,2,',','.').'</td>';
$totalGeral .= '<td id="moeda">'.number_format($totOfertaCultos,2,',','.').'</td>';
$totalGeral .= '<td id="moeda">'.number_format($totSubTotal,2,',','.').'</td>';
$totalGeral .= '<td id="moeda">'.number_format($totSenhoras,2,',','.').'</td>';
$totalGeral .= '<td id="moeda">'.number_format($totMocidade,2,',','.').'</td>';
$totalGeral .= '<td id="moeda">'.number_format($totInfantil,2,',','.').'</td>';
$totalGeral .= '<td id="moeda">'.number_format($totEnsino,2,',','.').'</td>';
$totalGeral .= '<td id="moeda">'.number_format($totOperac,2,',','.').'</td>';
$totalGeral .= '<td id="moeda">'.number_format($totOfertaNaoOpAno,2,',','.').'</td>';
$totalGeral .= '<td id="moeda">'.number_format($totOfertaCampanha,2,',','.').'</td>';
$totalGeral .= '</td><td id="moeda">'.number_format($totMissoes,2,',','.').'</td>';
$totalGeral .= '<td id="moeda">'.number_format($totGeral,2,',','.').'</td></tr>';
?>
<div class='text-center'><h5>
    <strong>Hist&oacute;rico Financeiro por m&ecirc;s de d&iacute;zimos, ofertas e campanhas&nbsp;-&nbsp;Valores em Real(R$)</strong>
		<?php printf('%s - Per&iacute;odo:&nbsp;&nbsp;%02s de %s',$cong,$mesPorExt,$ano);?></h5>
</div>
<!-- <div class='text-center' style="overflow: auto;width: 132%;height: 900px;"> -->
<table class='table table-bordered table-condensed'>
	<thead>
		<?PHP
			echo $nivelSem;
			echo $totalGeral;
		?>
	</thead>
		<?php
			echo $totalCong;
			echo $nivel1;//Valor veio do script /models/saldos.php
			echo $totalCong;
		?>
	<tfoot>
		<?PHP
			echo $totalGeral;
		?>
	</tfoot>
</table>
<!-- </div> -->
<h4>Total geral: <?php echo 'R$ '.number_format($totGeral,2,',','.');?></h4>
Em: <?php echo date('d/m/Y').'</br>Ano inicial de contribui&ccedil;&atilde;o: '.$menorAno.' ** Ultimo ano de contribui&ccedil;&atilde;o: '.$maiorAno;?>
</fieldset>
