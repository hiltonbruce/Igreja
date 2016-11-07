<table class='table table-hover table-condensed table-bordered'>
		<caption>Lan&ccedil;amento - Igreja: <?php 	echo $lanigreja->razao;?></caption>
		<colgroup>
				<col id="Conta">
				<col id="Descrição">
				<col id="Valor">
				<col id="C/D">
				<col id="Saldo Atual">
				<col id="albumCol"/>
			</colgroup>
		<thead>
			<tr>
				<th scope="col">Conta</th>
				<th scope="col">Descri&ccedil;&atilde;o</th>
				<th scope="col">D&eacute;bitar (R$)</th>
				<th scope="col">Cr&eacute;ditar (R$)</th>
				<th scope="col">Saldo atual (R$)</th>
				<th scope="col">Status</th>
			</tr>
		</thead>
		<tbody>
			<?php
				echo $exibirlanc;//Valor veio do script /forms/lancdizimo.php retirado da classe lancdizimo.class.php
			?>
		</tbody>
		<tfoot>
			<?php
				printf("<tr id='total'><td class='text-right' colspan='2'>");
				printf("%s %'.40s R$</td><td class='text-right' >",'Totais','.');
				printf(" %s</td><td class='text-right' > %s</td><td></td><td></td></tr>",number_format($_SESSION['debito'],2,',','.'),number_format($_SESSION['credito'],2,',','.'));
				unset($_SESSION['debito']);
				unset($_SESSION['credito']);
			?>
		</tfoot>
	</table><h1>
	<?php
	$histLancamento = array_keys(array_flip(array_unique($histLanca)));
	for ($i=0; $i < count($histLancamento)-1; $i++) {
		if ($i==0) {
			$hist = $histLancamento[$i];
		} else {
			$hist .=  ', '.$histLancamento[$i];
		}
	}
	if ($i==0) {
		$hist = $histLancamento[$i].' nesta data';
	} else {
		$hist .= ' e '.$histLancamento[$i].' nesta data';
	}
		$hist = ucfirst($hist);
		//echo($hist);
	?>
</h1>
