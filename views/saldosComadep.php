<table class='table table-striped table-hover'>
		<caption><h6>
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
	</h6></caption>
		<colgroup>
				<col id="Conta">
				<col id="Descricao">
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
			</tr>
		</thead>
		<tbody>
			<?php
			if ($_GET['tipo']==1) {
				//exibi plano de contas
				echo $nivel1;
			}else {
				echo $nivel2;
			}
			?>
		</tbody>
		<tfoot>
			<?php
				echo '<tr id="total">';
				echo '<tdid="moeda" ></td>';
				echo '<td colspan="3" class="text-right">Movimento do per&iacute;odo <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>';
				echo 'R$ '.number_format($debito,2,',','.').'</td>';
				echo '<td colspan="2" id="moeda" ></td></tr>';
			?>
		</tfoot>
	</table>
	<?php
		echo $assinatura;
				//echo $grupoFora.'<br />';
				//echo $sldFora.' *** ';
		echo $imprimir;
	?>
