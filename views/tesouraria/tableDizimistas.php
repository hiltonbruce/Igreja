<?PHP
//Sede
$sede	= new DBRecord ("igreja",'1',"rol");
$dircon		= 'Pastor: '.$sede->pastor();
$templo		= '<b>Templo Sede </b> ';
?>
<table>
	<tr>
		<td>
			<?PHP
        echo $igrejaDados['razao'];
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
			?>
		</td>
		<td>
			<?php
			 	echo $titulo.' - Valores em Real (R$)';
			?>
	</td>
	</tr>
</table>
    <p class="bg-success">
 <?PHP

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
  </div>
		</p>
	<p>
	<?PHP
		echo $dircon.' -'.$templo;
		echo " : {$sede->rua()}, N&ordm; {$sede->numero()} <br /> {$sede->cidade()} - {$sede->uf()} - CNPJ: {$sede->cnpj()} -
	CEP: {$sede->cep()} - Fone: {$sede->fone()}";?>
	 <a rel="nofollow" href="http://<?PHP echo "{$sede->site()}";?>/" title="Copyright information">Site&nbsp;</a>
     - Email: <a href="mailto: <?PHP echo "{$sede->email()}";?>">Secretaria Executiva&nbsp;</a>
	</p>
