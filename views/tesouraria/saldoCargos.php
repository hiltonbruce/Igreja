<table class='table table-bordered'>
	<caption>
		<?php
		//Cabeçalho da tabela
		//Oculta o botao imprimir para não sair na impressão
		$linkImpressao ='tesouraria/receita.php/?rec=13';
		if ($_GET['rec']!='13') {
			echo '<a href="'.$linkImpressao.'" ';
			echo 'target="_black" title="Imprimir demonstrativo">';
			echo '<button class="btn btn-default glyphicon glyphicon-print"> </button></a>&nbsp;';
			$imprimir = '';
		}else {
			$imprimir = '<script type="text/javascript">window.print();</script>';
		}
		if (empty($titulo)) {
			echo $cong.'Histórico Financeiro - Ano de referência: '.$ano;
		} else {
			echo $titulo;
		}

		echo ' - Valores em Real (R$)';?>
	</caption>
	<colgroup>
		<?php echo $colgroup;?>
	</colgroup>
	<thead>
		<tr>
			<?php echo $tabThead;?>
		</tr>
	</thead>
	<tbody id="periodo">
			<?php echo $linha;?>
	</tbody>
	<tfoot>
			<?php echo $tabFoot;?>
	</tfoot>
</table>
<div class="bs-example bs-example-bg-classes">
    <p class="bg-info">Esta consulta gerou um total de <kbd><?PHP echo $totalLinhas;?></kbd> ocorr&ecirc;ncias.</p>
  </div>
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
	<?php }
	echo $imprimir;
	?>
