<table style="width:100%">
	<caption>
		<?php echo $cong;?>
		Histórico Financeiro - Ano de referência:
		<?php echo $ano;?>
		- Valores em Real (R$) 
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
<?PHP

	if ($_GET['rec']=='13') {
	//Sede
	$sede	= new DBRecord ("igreja",'1',"rol");
	$dircon		= 'Pastor: '.$sede->pastor();
	$templo		= '<b>Templo Sede </b> ';
	?>
	<p>
	<?PHP
		echo $dircon.' -'.$templo;
		echo " : {$sede->rua()}, N&ordm; {$sede->numero()} <br /> {$sede->cidade()} - {$sede->uf()} - CNPJ: {$sede->cnpj()} -
	CEP: {$sede->cep()} - Fone: {$sede->fone()}";?>
	 <a rel="nofollow" href="http://<?PHP echo "{$sede->site()}";?>/" title="Copyright information">Site&nbsp;</a>
     - Email: <a href="mailto: <?PHP echo "{$sede->email()}";?>">Secretaria Executiva&nbsp;</a>
	</p>
	<?php } ?>