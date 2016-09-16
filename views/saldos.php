<table class='table table-hover table-striped'>
		<caption>
		<?php
		if (empty($recLink)) {
			$recLink = '';
		}

		if ($recLink!='') {
			echo '<a href="'.$linkImpressao.'" ';
			echo 'target="_black" title="Imprimir demonstrativo">';
			echo '<button class="btn btn-default glyphicon glyphicon-print"> </button></a>&nbsp;';
			$imprimir = '';
		}else {
			$imprimir = '<script type="text/javascript">window.print();</script>';
		}
		echo '<h5>'.$titTabela.'<h5>';
		?>
		</caption>
		<colgroup>
				<col id="Conta">
				<col id="Acesso">
				<col id="Descri��o">
				<col id="Saldo Atual">
			</colgroup>
		<thead>
			<tr>
				<th scope="col">Conta</th>
				<th scope="col">C&oacute;d.</th>
				<th scope="col">Descri&ccedil;&atilde;o</th>
				<th scope="col" colspan="2" class='text-center'> Saldo atual (R$) </th>
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
				printf("<tr id='total'>");
				printf("<td colspan='2' id='moeda' >D&eacute;bitos: R$ %s D</td>",number_format($debito,2,',','.'));
				printf("<td colspan='2' id='moeda'>Cr&eacute;dito: R$ %s C</td><td></td></tr>",number_format($credito,2,',','.'));
			?>
		</tfoot>
	</table>
	<?php
		echo $imprimir;
	?>
