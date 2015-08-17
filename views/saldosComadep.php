<table class='table-hover'>
		<caption>
		<?php
		if ($recLink!='' && !empty($recLink)) {
			echo '<a href="'.$linkImpressao.'" ';
			echo 'target="_black" title="Imprimir demonstrativo">';
			echo '<button class="btn btn-default glyphicon glyphicon-print"> </button></a>&nbsp;';
			$imprimir = '';
		}else {
			$imprimir = '<script type="text/javascript">window.print();</script>';
		}
		echo $titTabela;
		?>
		</caption>
		<colgroup>
				<col id="Conta">
				<col id="Descrição">
				<col id="Movimento">
				<col id="Saldo Anterior">
				<col id="Saldo Atual">
			</colgroup>
		<thead>
			<tr>
				<th scope="col">Conta</th>
				<th scope="col">Descri&ccedil;&atilde;o</th>
				<th scope="col" style="text-align: center;">Movimento</th>
				<th scope="col" style="text-align: center;">Saldo Atual</th>
				<th scope="col" style="text-align: center;">Saldo Anterior</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if ($_GET['tipo']==1) {
				//exibi plano de contas
				echo $nivel1;//Valor veio do script /models/saldos.php
			}else {
				echo $nivel2;//Valor veio do script /models/saldos.php
			}
			?>
		</tbody>
		<tfoot>
			<?php
				echo '<tr id="total" style="font-size:130%;">';
				printf("<td colspan='2' id='moeda' >Total de Débitos: R$ %s D</td>",number_format($debito,2,',','.'));
				printf("<td colspan='3' id='moeda'>Total de Crédito: R$ %s C</td></tr>",number_format($credito,2,',','.'));
			?>
		</tfoot>
	</table>
	<?php
		echo $imprimir;
	?>
