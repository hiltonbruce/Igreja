<div class="bs-docs-sidebar">
<div class='text-center' style="overflow: auto;width: 132%;height: 900px;">
<table class='table table-bordered table-hover table-condensed table-striped'>
	<caption>
		<?php
		//Cabe�alho da tabela
		//Oculta o botao imprimir para n�o sair na impress�o
		$linkImpressao ='tesouraria/receita.php/?rec=13';
		if ($_GET['rec']!='13') {
			echo '<a href="'.$linkImpressao.'&ano='.$ano.'" ';
			echo 'target="_black" title="Imprimir demonstrativo">';
			echo '<button class="btn btn-success "> <i class="glyphicon glyphicon-print"></i> Imprimir </button> </a>&nbsp;';
			$imprimir = '';
		}else {
			$imprimir = '<script type="text/javascript">window.print();</script>';
		}
		echo $cong.'Hist&oacute;rico Financeiro - <strong>Entradas</strong> - Ano de refer&ecirc;ncia: '.$ano;
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
</div>
