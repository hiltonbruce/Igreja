<table>
	<tr>
	<?PHP

		$_urlLi  ='?escolha=tesouraria/receita.php&menu=top_tesouraria&direita=1&';
		$_urlLi .='rec=23&ano='.$_GET['ano'].'&mes='.$_GET['mes'].'&ord=';
		$link 	 = $_urlLi;
		$_urlLi .= $_GET["ord"].'&id='.$_GET["id"];//Montando o Link para ser passada a classe

					//Cabeçalho da tabela
					//Oculta o botao imprimir para não sair na impressão
					$linkImpressao ='tesouraria/receita.php/?rec=23';
					
			if (empty($titulo)) {
				echo '<td>'.$cong.'Histórico Financeiro - Ano de referência: '.$ano.'</td>';
			} else {
			  switch ($_GET['ord']) {
			  	//Define a 1ª linha do proximo form
			  	case 1:
			  		$linhaCargo = '<option value="'.$link.'1">Auxiliar de Trabalho</option>';
			  	break;
			  	case 2:
			  		$linhaCargo = '<option value="'.$link.'2">Di&aacute;cono</option>';
			  	break;
			  	case 3:
			  		$linhaCargo = '<option value="'.$link.'3">Presb&iacute;tero</option>';
			  	break;
			  	case 4:
			  		$linhaCargo = '<option value="'.$link.'4">Evangelista</option>';
			  	break;
			  	case 5:
			  		$linhaCargo = '<option value="'.$link.'5">Pastor</option>';
			  	break;
			  	case 6:
			  		$linhaCargo = '<option value="'.$link.'6">Dirigente de Congrega&ccedil;&atilde;o</option>';
			  	break;
			  	default:
			  		$linhaCargo = '';
			  		$titulo = 'Membros';
			  	break;
		  }
		  ?>
			<td>
				<label>Cargo</label>
				<select name="cargo" onchange="MM_jumpMenu('parent',this,0)" class="form-control">
				  <?php echo $linhaCargo;?>
				    <option value="<?PHP echo $link;?>0">--&gt;&gt;Listar todos&lt;&lt;--</option>
					<option value="<?PHP echo $link;?>1">Auxiliar de Trabalho</option>
					<option value="<?PHP echo $link;?>2">Di&aacute;cono</option>
					<option value="<?PHP echo $link;?>3">Presb&iacute;tero</option>
					<option value="<?PHP echo $link;?>4">Evangelista</option>
					<option value="<?PHP echo $link;?>5">Pastor</option>
					<option value="<?PHP echo $link;?>6">Dirigente de Congrega&ccedil;&atilde;o</option>
				</select>
			</td>

		  <?PHP

		}
		if ($_GET['rec']!='13') {
			echo '<td><br><a href="'.$linkImpressao.'" ';
			echo 'target="_black" title="Imprimir demonstrativo">';
			echo '<button class="btn btn-default glyphicon glyphicon-print"> </button></a>&nbsp;';
			$imprimir = '';
		}else {
			$imprimir = '<script type="text/javascript">window.print();</script>';
		}
		echo $titulo.' - Valores em Real (R$)</td>';
	?>
	</tr>
	<tr>
		<td>
			<?PHP

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
				$_rod = new rodape($paginas,$_GET["pagina"],"pagina",$_urlLi,8);
				//(Quantidade de páginas,$_GET["pag_rodape"],mesmo nome dado ao parametro do $_GET anterior  ,"$_urlLi",links por página)
				$_rod->getRodape();
			?>
		</td>
		<td><br>
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
					printf("Com %s %ss,",number_format($totalLinhas, 0, ',', '.'),$titulo);

				}elseif ($totalLinhas=="1"){
					echo "Com apenas um $titulo,";
				}else{
					echo "Nenhum resultado";
				}

				echo ' Tendo '.$totDizimistas.' dizimados no mês '.$mesDiz.'/'.$ano;
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
