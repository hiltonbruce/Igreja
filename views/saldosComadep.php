<table class='table table-hover table-bordered table-striped'>
		<caption>
		<?php
		if ($recLink!='' && !empty($recLink)) {
			echo '<a href="'.$linkImpressao.'" ';
			echo 'target="_black" title="Imprimir demonstrativo">';
			echo '<button class="btn btn-default glyphicon glyphicon-print"> </button></a>&nbsp;';
			$imprimir = '';
		}else {
			//$imprimir = '<script type="text/javascript">window.print();</script>';
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
				<th scope="col" style="text-align: center;">Sld Atual</th>
				<th scope="col" style="text-align: center;">Sld Ant.</th>
			</tr3
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
				echo '<tr id="total">';
				printf("<td colspan='3' id='moeda'>Movimento do per&iacute;odo: R$ %s </td>",number_format($debito,2,',','.'));
				echo '<td colspan="2" id="moeda" ></td>';
			?>
		</tfoot>
	</table>
	<?php
				//echo $grupoFora.'<br />';
				//echo $sldFora.' *** ';
		echo $imprimir;
	?>
