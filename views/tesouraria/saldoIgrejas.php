</div>
<table style="width:100%">
	<caption>
		<?php echo $cong;?>
		Histórico Financeiro das Entradas - Ano de referência:
		<?php echo $ano;?>
		- Valores em Real(R$) 
		<?php
			//Oculta o botao imprimir para não sair na impressão
			$linkImpressao ='tesouraria/receita.php/?rec=13';
			if ($_GET['rec']!='13') {
				echo '<a href="'.$linkImpressao.'" target="_black" title="Imprimir demonstrativo"><button class="btn btn-default glyphicon glyphicon-print"> </button></a>';
			}
		?>
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