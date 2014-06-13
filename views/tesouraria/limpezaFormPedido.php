<?php
if ($_GET['limpeza']!='4') {
?>
<table id="listTable" >
	<caption>Pedido de Material de limpeza: <?php echo $nomeIgreja;?></caption>
	
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
