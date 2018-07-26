<?PHP
//Sede
$sede	= new DBRecord ("igreja",'1',"rol");
$dircon		= 'Pastor: '.$sede->pastor();
$templo		= '<b>Templo Sede </b> ';
?>
<table class="table">
	<tr>
		<td><h3>
			<?PHP
        echo $igrejaDados['razao'];
			?>
		</h3>
		</td>
		<td><h3>
			<?php
			 	echo $titulo.' - Valores em Real (R$)';
			?>
		</h3>
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

				echo ' Tendo '.$totDizimistas.' dizimistas no m&ecirc;s de '.ucwords(strftime("%B/%G",strtotime("$mesDiz/01/$ano"))).' ( <u>'.round($percentual,2).'%</u> )';
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
				echo ' Tendo '.$totDizimistas.' dizimistas no m&ecirc;s de '.ucwords(strftime("%B/%G",strtotime("$mesDiz/01/$ano"))).' ( <u>'.round($percentual,2).'%</u> )';

		echo '<br />'.$dircon;
	?>
	</p>
</div>
