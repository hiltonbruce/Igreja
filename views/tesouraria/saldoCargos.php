<?PHP
				//Cabeçalho da tabela
				//Oculta o botao imprimir para não sair na impressão
				$linkImpressao ='tesouraria/receita.php/?rec=23';
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

				echo ' - Valores em Real (R$)';
			?>
<table>
	<tr>
		<td>
			<?PHP
				$_urlLi  ='?escolha=tesouraria/receita.php&menu=top_tesouraria&direita=1&';
				$_urlLi .='rec=23&ano=&cargo='.$_GET["cargo"].'&pagina='.$_GET["pagina"];
				$_urlLi .='&igreja='.$_GET["igreja"];//Montando o Link para ser passada a classe

				//Classe que monta o rodape
				$nmpp="20"; //Número de mensagens por párginas
				$paginas = ceil ($totalLinhas/$nmpp); //Retorna o total de páginas
					if ($_GET["pagina"]<1) {
						$_GET["pagina"] = 1;
					} elseif ($_GET["pagina"]>$paginas) {
						$_GET["pagina"] = $paginas;
					}

					$pagina = $_GET["pagina"]-1;

					if ($pagina<0) {$pagina=0;} //Especifica um valor p variável página caso ela esteja setada
				$_rod = new rodape($paginas,$_GET["pagina"],"pagina",$_urlLi,8);//(Quantidade de páginas,$_GET["pag_rodape"],mesmo nome dado ao parametro do $_GET anterior  ,"$_urlLi",links por página)
				$_rod->getRodape();
			?>
		</td>
		<td>
			<?php
			 $_rod->form_rodape ("Ir para P&aacute;gina: ");
				//$_rod->getDados();
			?>
	</td>
	</tr>
</table>

<table class='table table-bordered'>
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
<table>
	<tr>
		<td>
			<?PHP
				$_rod->getRodape();
			?>
		</td>
		<td>
			<?php
			 $_rod->form_rodape ("Ir para P&aacute;gina: ");
				//$_rod->getDados();
			 if ($paginas>1)
					echo "<br><span class='style4'>Total de $paginas p&aacute;ginas";
					else
					echo "<br><span class='style4'>Total de $paginas p&aacute;gina";

				echo "<br />";
				if ($totalLinhas>"1")
				{
					printf("Com %s Membros!",number_format($totalLinhas, 0, ',', '.'));

				}elseif ($totalLinhas=="1"){
					echo "Com apenas um Membro!";
				}else{
					echo "Nenhum resultado!";
				}
			?>
	</td>
	</tr>
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
	<?php }
	echo $imprimir;
	?>
