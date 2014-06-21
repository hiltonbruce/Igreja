<table>
		<caption>
		<?php		
		if ($_GET['rec']=='7') {
			$mes = date('m'); // Mês desejado, pode ser por ser obtido por POST, GET, etc.
			$ano = date('Y'); // Ano atual
			$ultimo_dia = date("t", mktime(0,0,0,$mes,'01',$ano)); 
			$recLink = '14&dtBalac='.$ultimo_dia.'/'.$mes.'/'.$ano;
		}elseif ($_GET['rec']=='8') {
			$recLink = '15&tipo=1';
		}else {
			$recLink = '';
		}
		
		$linkImpressao ='tesouraria/receita.php/?rec=';
		if ($recLink!='') {
			echo '<a href="'.$linkImpressao.$recLink.'" ';
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
				<col id="Acesso">
				<col id="Descrição">
				<col id="Saldo Atual">
			</colgroup>
		<thead>
			<tr>
				<th scope="col">Conta</th>
				<th scope="col">Acesso</th>
				<th scope="col">Descri&ccedil;&atilde;o</th>
				<th scope="col" colspan="2" style="text-align: center;"> Saldo atual em Real </th>
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
				printf("<td colspan='2' id='moeda' >Total de Débitos: R$ %s D</td>",number_format($debito,2,',','.'));
				printf("<td colspan='2' id='moeda'>Total de Crédito: R$ %s C</td><td></td></tr>",number_format($credito,2,',','.'));
			?>
		</tfoot>
	</table>
	