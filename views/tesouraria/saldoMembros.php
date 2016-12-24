<?php
controle ("tes");
if ($_GET['fin']=='' || $_GET['fin']<2) {
	require_once ("views/secretaria/menuTopDados.php");
	$hisFinanceiro = 1;
	$cong = '';
}elseif (empty($_GET['igreja'])) {
	$igreja = '';
	$hisFinanceiro = 3;
	$cong = 'Todas as Igrejas<br />';
	require_once 'forms/tes/histFinanceiro.php';
}else {
	$igreja = (int)$_GET['igreja'];
	$ingSeleciona = new DBRecord('igreja', $igreja, 'rol');
	$cong = 'Igreja - '.$ingSeleciona->razao().'<br />';
	$hisFinanceiro = 2;
	require_once 'forms/tes/histFinanceiro.php';
}
require_once 'models/tes/histFinMembro.php';
?>
<table id="horario" class='table table-hover table-condensed'>
		<caption><?php echo $cong;?>Hist&oacute;rico Financeiro de D&iacute;zimos e Ofertas - Ano de refer&ecirc;ncia:&nbsp;
		<?php echo $ano;?> - Valores em Real(R$)</caption>
		<colgroup>
				<col id="Mes">
				<col id="Dizimos">
				<col id="Ofertas Extras">
				<col id="Ofertas">
				<col id="Sub-Total">
				<col id="Senhoras">
				<col id="Mocidade">
				<col id="Infantil">
				<col id="Ensino">
				<col id="Tot.&nbsp;Operac.">
				<col id="Campanhas">
				<col id="Missoes">
				<col id="Total">
			</colgroup>
		<thead>
			<tr class="success">
				<th scope="col" class='text-center'>M&ecirc;s</th>
				<th scope="col">D&iacute;zimos</th>
				<th scope="col">Extras</th>
				<th scope="col">Ofertas</th>
				<th scope="col">Sub-Total</th>
				<th scope="col">Senhoras</th>
				<th scope="col">Mocidade</th>
				<th scope="col">Infantil</th>
				<th scope="col">Ensino</th>
				<th scope="col">Tot.&nbsp;Operac.</th>
				<th scope="col">Campanhas</th>
				<th scope="col">Miss&otilde;es</th>
				<th scope="col" class='text-center'>Total</th>
			</tr>
		</thead>
			<?php
			if ($_GET['tipo']==1) {
				echo $nivel1;//Valor veio do script /models/saldos.php
			}else {
				echo $nivel1;//Valor veio do script /models/saldos.php
			}
			?>
		<tfoot>
			<?php
			$totSubTotalAno = $totDizAno+$totOfertaExtraAno+$totOfertaAno;
			$totOpAno = $totSubTotalAno +$totSenhorasAno + $totMocidadeAno +$totInfantilAno+$totEnsinoAno;
				echo '<tr class="success">';
				echo '<td>Total&nbsp;em&nbsp;'.$ano.':</td>
					<td id="moeda">'.number_format($totDizAno,2,',','.').'</td>
					<td id="moeda">'.number_format($totOfertaExtraAno,2,',','.').'
					<td id="moeda">'.number_format($totOfertaAno,2,',','.').
					'<td id="moeda">'.number_format($totSubTotalAno,2,',','.').'</td>';
				echo '<td id="moeda">'.number_format($totSenhorasAno,2,',','.').'</td>
					<td id="moeda">'.number_format($totMocidadeAno,2,',','.').'</td>
					<td id="moeda">'.number_format($totInfantilAno,2,',','.').'</td>';
				echo '<td id="moeda">'.number_format($totEnsinoAno,2,',','.').'</td>'.
					'<td id="moeda">'.number_format($totOpAno,2,',','.').'</td>'.
					'<td id="moeda">'.number_format($totCampanhaAno,2,',','.').'</td>'.
					'<td id="moeda">'.number_format($totMissoesAno,2,',','.').'</td>';
				echo '<td id="moeda">'.number_format($totTotal,2,',','.').'</td></tr>';

				printf("<tr id='total'>");
				$totSubTotal = $totDizimo+$totOfertaExtra+$totOfertaCultos;
				$totOp = $totSubTotal +$totSenhoras + $totMocidade +$totInfantil+$totEnsino;
				$totGeral = $totOp+$totOfertaCampanha+$totMissoes;
				echo '<td>Acumulado&nbsp;at&eacute:&nbsp'.date('d/m/Y').'</td><td id="moeda">'.number_format($totDizimo,2,',','.').'</td>
					<td id="moeda">'.number_format($totOfertaExtra,2,',','.').'</td>
					<td id="moeda">'.number_format($totOfertaCultos,2,',','.').'</td>
					<td id="moeda">'.number_format($totSubTotal,2,',','.').'</td>';
				echo '<td id="moeda">'.number_format($totSenhoras,2,',','.').'</td>'.
					'<td id="moeda">'.number_format($totMocidade,2,',','.').'</td>'.
					'<td id="moeda">'.number_format($totInfantil,2,',','.').'</td>'.
					'<td id="moeda">'.number_format($totEnsino,2,',','.').'</td>'.
					'<td id="moeda">'.number_format($totOp,2,',','.').'</td>
					<td id="moeda">'.number_format($totOfertaCampanha,2,',','.').'</td>';
				echo '<td id="moeda">'.number_format($totOp,2,',','.').'</td>';
				echo '<td id="moeda">'.number_format($totGeral,2,',','.').'</td></tr>';
			?>
		</tfoot>
	</table>
	<h4>Total geral: <?php echo 'R$ '.number_format($totGeral,2,',','.');?></h4>
	Em: <?php echo date('d/m/Y').'</br>Ano inicial de contribui&ccedil;&atilde;o: '.$menorAno.' ** Ultimo ano de contribui&ccedil;&atilde;o: '.$maiorAno;?>
