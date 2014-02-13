<?php 
if ($_GET['fin']=='' || $_GET['fin']<2) {
	require_once ("views/secretaria/menuTopDados.php");
	$hisFinanceiro = 1;
	$cong = '';
}elseif ((int)$_GET['igreja']=='') {
	$igreja = (int)$_GET['igreja'];
	$hisFinanceiro = 3;
	$cong = 'Todas as Igrejas<br />';
	require_once 'forms/tes/histFinanceiro.php';
}else {
	$igreja = (int)$_GET['igreja'];
	$ingSeleciona = new DBRecord('igreja', $igreja, 'rol');
	$cong = 'Igrejas - '.$ingSeleciona->razao().'<br />';
	$hisFinanceiro = 2;
	require_once 'forms/tes/histFinanceiro.php';
}

require_once 'models/tes/histFinMembro.php';
?>
<table>
		<caption><?php echo $cong;?>Histórico Financeiro de Dízimos e Ofertas - Ano de referência: 
		<?php echo $ano;?> - Valores em Real(R$)</caption>
		<colgroup>
				<col id="Mes">
				<col id="Dízimos">
				<col id="Ofertas">
				<col id="Campanhas">
				<col id="Missões">
				<col id="Senhoras">
				<col id="Mocidade">
				<col id="Infantil">
				<col id="Ensino">
			</colgroup>
		<thead>
			<tr>
				<th scope="col">Mês</th>
				<th scope="col">Dízimos</th>
				<th scope="col">Ofertas</th>
				<th scope="col">Campanhas</th>
				<th scope="col">Missões</th>
				<th scope="col">Senhoras</th>
				<th scope="col">Mocidade</th>
				<th scope="col">Infantil</th>
				<th scope="col">Ensino</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if ($_GET['tipo']==1) {
				echo $nivel1;//Valor veio do script /models/saldos.php
			}else {
				echo $nivel1;//Valor veio do script /models/saldos.php
			}				
			?>
		</tbody>
		<tfoot>
			<?php  
				printf("<tr id='subtotal'>"); 
				echo ('<td>Total em '.$ano.':</td><td id="moeda">'.number_format($totDizAno,2,',','.').'</td>
						<td id="moeda">'.number_format($totOfertaAno,2,',','.').
						'</td><td id="moeda">'.number_format($totCampanhaAno,2,',','.').'</td>'.
						'</td><td id="moeda">'.number_format($totMissoesAno,2,',','.').'</td>');
				echo ('<td id="moeda">'.number_format($totSenhorasAno,2,',','.').'</td><td id="moeda">'.number_format($totMocidadeAno,2,',','.').'</td>
				<td id="moeda">'.number_format($totInfantilAno,2,',','.').'</td><td id="moeda">'.number_format($totEnsinoAno,2,',','.').'</td></tr>');
				printf("<tr id='total'>"); 
				echo ('<td>Saldo até '.$maiorAno.'</td><td id="moeda">'.number_format($totDizimo,2,',','.').'</td>
					<td id="moeda">'.number_format($totOfertaCultos,2,',','.').'</td><td id="moeda">'.number_format($totOfertaCampanha,2,',','.').'</td>'.
						'</td><td id="moeda">'.number_format($totMissoes,2,',','.').'</td>');
				echo ('<td id="moeda">'.number_format($totSenhoras,2,',','.').'</td><td id="moeda">'.number_format($totMocidade,2,',','.').'</td>
				<td id="moeda">'.number_format($totInfantil,2,',','.').'</td><td id="moeda">'.number_format($totEnsino,2,',','.').'</td></tr>');
			?>
		</tfoot>
	</table>
	Em: <?php echo date('d/m/Y').'</br>Ano inicial de contribuição: '.$menorAno.' ** Ultimo ano de contribuição: '.$maiorAno;?>