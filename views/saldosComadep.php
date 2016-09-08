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
				<col id="Descri��o">
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
				echo '<td colspan="2" id="moeda">Movimento do per&iacute;odo <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></td>';
				echo '<td id="moeda" >R$ '.number_format($debito,2,',','.').'</td>';
				echo '<td colspan="2" id="moeda" ></td></tr>';
			?>
		</tfoot>
	</table>
	<?php
				//echo $grupoFora.'<br />';
				//echo $sldFora.' *** ';
		echo $imprimir;
	?>
