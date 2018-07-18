<table>
	<tr>
	<?PHP
		$mes = (empty($_GET['mes'])) ? '' : $_GET['mes'];
		$ano = (empty($_GET['ano'])) ? '' : $_GET['ano'];
		$ord = (empty($_GET['ord'])) ? '' : intval($_GET['ord']);
		$_urlLi  ='?escolha=tesouraria/receita.php&menu=top_tesouraria&direita=1&';
		$_urlLi .='rec=23&ano='.$ano.'&id='.$_GET['id'].'&mes='.$mes.'&ord=';
		$link 	 = $_urlLi;
		$_urlLi .= $_GET["ord"].'&id='.$_GET["id"];//Montando o Link para ser passada a classe
		$idIgreja = (empty($_GET['id']) || $_GET['id']<0 ) ? 0 : $_GET['id'] ;
		//Cabeçalho da tabela
		//Oculta o botao imprimir para não sair na impressão
			$linkImpressao ='tesouraria/receita.php/?rec=17&mes='.$mes.'&ano='.$ano.'&id='.$idIgreja.'&ord='.$ord ;
			if (empty($titulo)) {
				echo '<td>'.$cong.'Histórico Financeiro - Ano de refer&ecirc;ncia: '.$ano.'</td>';
			} else {
			  switch ($ord) {
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
			  	case 7:
			  		$linhaCargo = '<option value="'.$link.'7">Mulheres</option>';
			  	break;
			  	case 8:
			  		$linhaCargo = '<option value="'.$link.'8">Homens</option>';
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
				    <option value="<?PHP echo $link;?>0">Membros Cadastrados</option>
					<option value="<?PHP echo $link;?>1">Auxiliar de Trabalho</option>
					<option value="<?PHP echo $link;?>2">Di&aacute;cono</option>
					<option value="<?PHP echo $link;?>3">Presb&iacute;tero</option>
					<option value="<?PHP echo $link;?>4">Evangelista</option>
					<option value="<?PHP echo $link;?>5">Pastor</option>
					<option value="<?PHP echo $link;?>6">Dirigente de Congrega&ccedil;&atilde;o</option>
					<option value="<?PHP echo $link;?>7">Mulheres</option>
					<option value="<?PHP echo $link;?>8">Homens</option>
				</select>
			</td>
			<form action='' method='get'>
			<td>
					<label>M&ecirc;s para estatistica:</label>
					<select name="mes" tabindex="<?PHP echo ++$ind; ?>" class="form-control" >
					      <?php
					      $mesEstatisca = (empty($_GET['mes']) || $_GET['mes']>12) ? 1 : $_GET['mes'] ;
					      	$linha1 = '<option value="0">Selecione o mês...</option>';
						      foreach(arrayMeses() as $mes => $meses) {
								 $linha2 .= '<option value='.(int)$mes.'>'.$meses.'</options>';
								 if ($mesEstatisca==$mes) {
								 	$linha1 = '<option value='.(int)$mes.'>'.$meses.'</options>'.$linha1;
								 	$mesPesquisa = $meses;
								 }
						      }
						      echo $linha1.$linha2;
					      ?>
				      </select>
				</td>
				<td>
					<label>Igreja</label>
					<?php
					$bsccredor = new List_sele('igreja', 'razao', 'id');
					$listaIgreja = $bsccredor->List_Selec(++$ind,$idIgreja,'class="form-control" ');
					echo $listaIgreja;
					?>
				</td>
				<td>
					<label>Ano</label>
					<input type="text" name="ano" value="<?php echo $anoForm;?>"
					tabindex="<?PHP echo ++$ind; ?>" size="5"  class="form-control" placeholder="Ano" />
					<input type="hidden" name="direita"	value="1" />
					<input type="hidden" name="ord" value="<?php echo $ord;?>" />
				</td><td>
					<input name="escolha" type="hidden" value="tesouraria/receita.php" /><br />
					<input type="hidden" name="rec"	value="<?php echo $rec;?>" />
					<input type="submit" class="btn btn-primary" name="Submit" value="Listar..."
					tabindex="<?PHP echo ++$ind; ?>" />
					<input name="menu" type="hidden" value="top_tesouraria" />
				</td>
	</tr>
</form>
</table>
<table>
	<tr>
		<td>
			<?PHP

				//Classe que monta o rodape
				$nmpp=$linhas; //Número de mensagens por párginas
				$paginas = ceil ($totalLinhas/$nmpp); //Retorna o total de páginas
					if ($_GET["pagina"]<1) {
						$_GET["pagina"] = 1;
					} elseif ($_GET["pagina"]>$paginas) {
						$_GET["pagina"] = $paginas;
					}

					$pagina = $_GET["pagina"]-1;

					if ($pagina<0) {$pagina=0;} //Especifica um valor p variável página caso ela esteja setada
				$_rod = new rodape($paginas,$_GET["pagina"],"pagina",$_urlLi,12);
				//(Quantidade de páginas,$_GET["pag_rodape"],mesmo nome dado ao parametro do $_GET anterior  ,"$_urlLi",links por página)
				$_rod->getRodape();
			?>
		</td>
		<td>
			<?php
			 $_rod->form_rodape ("Ir para P&aacute;gina: ");
			 	echo $titulo.' - Valores em Real (R$)';
				//$_rod->getDados();
			?>
	</td>
	</tr>
</table>
    <p class="bg-success">
 <?PHP
					}
					if ($_GET['rec']!='13') {
						echo '<a href="'.$linkImpressao.'" ';
						echo 'target="_black" title="Imprimir demonstrativo">';
						echo '<button class="btn btn-default glyphicon glyphicon-print"> </button></a>&nbsp;';
						$imprimir = '';
					}else {
						$imprimir = '<script type="text/javascript">window.print();</script>';
					}

		echo 'Esta consulta gerou um total de <kbd>'.$totalLinhas.'</kbd> ocorr&ecirc;ncias';

    	if ($totalLinhas>"1")
				{
					printf("( %s ).",$titulo);

				}elseif ($totalLinhas=="1"){
					echo " com apenas um $titulo,";
				}else{
					echo " nenhum resultado";
				}
				$percentual = ($totDizimistas*100)/$totalLinhas;
				echo ' Tendo '.$totDizimistas.' dizimistas no m&ecirc;s de '.$mesPesquisa.'/'.$ano.' ( <u>'.round($percentual,2).'%</u> )';
		?>
		</p>

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
    <p class="bg-info">Esta consulta gerou um total de <kbd><?PHP echo $totalLinhas;?></kbd> ocorr&ecirc;ncias
    	<?PHP
    	if ($totalLinhas>"1")
				{
					printf("( %s ).",$titulo);

				}elseif ($totalLinhas=="1"){
					echo "Com apenas um $titulo,";
				}else{
					echo "Nenhum resultado";
				}
				$percentual = ($totDizimistas*100)/$totalLinhas;
				echo ' Tendo '.$totDizimistas.' dizimistas no m&ecirc;s de '.$mesPesquisa.'/'.$ano.' ( <u>'.round($percentual,2).'%</u> )';
		?>
		</p>
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
					echo "<span class='style4'>Total de $paginas p&aacute;ginas";
					else
					echo "<span class='style4'>Total de $paginas p&aacute;gina";
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
