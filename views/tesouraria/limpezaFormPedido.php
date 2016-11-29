<?php
if ($_GET['limpeza']!='4') {
?>
<table class="table table-striped" >
	<caption>Material de limpeza: <?php echo $nomeIgreja;?> - Período: </caption>

		<colgroup>
			<col id="item">
			<col id="Quant">
			<col id="item">
			<col id="albumCol"/>
		</colgroup>
	<thead>
		<tr>
			<th scope="col">item</th>
			<th scope="col">Quant</th>
			<th scope="col">item</th>
			<th scope="col">Quant</th>
		</tr>
	</thead>
	<tbody>
		<?php
			echo $tabMaterial;
		?>
	</tbody>
</table>
	<?php
	}
	?>
