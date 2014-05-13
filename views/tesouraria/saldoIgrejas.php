<?php

	require_once 'help/tes/saldoIgrejas.php';	
?>
<table>
	<caption>
		<?php echo $cong;?>
		Histórico Financeiro de Dízimos e Ofertas - Ano de referência:
		<?php echo $ano;?>
		- Valores em Real(R$)
	</caption>
	<colgroup>
		<?php echo $colgroup;?>
	</colgroup>
	<thead>
		<tr>
			<?php echo $tabThead;?>
		</tr>
	</thead>
	<tbody>
			<?php echo $linha;?>
	</tbody>
	<tfoot>
			<?php echo $tabFoot;?>
	</tfoot>
</table>