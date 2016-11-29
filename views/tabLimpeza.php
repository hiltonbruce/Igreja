<?php
$congregcao = new DBRecord('igreja', $igreja, 'rol'); // $igreja vem do script q chamar este
?>
<table class='table table-striped table-hover' >
	<caption>Material de Limpeza - <?php echo $congregcao->razao().', para: '.$periodo['0'];?></caption>
		<colgroup>
			<col id="item">
			<col id="Unidade">
			<col id="Discriminação">
			<col id="Solicitado">
			<col id="anterior">
			<col id="albumCol"/>
		</colgroup>
	<thead>
		<tr>
			<th scope="col">item</th>
			<th scope="col"><?php echo $periodo['2'];?></th>
			<th scope="col"><?php echo $periodo['1'];?></th>
			<th scope="col">Unidade</th>
			<th scope="col">Discrimina&ccedil;&atilde;o</th>
			<th scope="col">Atual</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$tbodytab = new limplista($mesref,$periodo['1'],$periodo['2']);
			require_once 'help/tes/tabLimpeza.php';
		?>
	</tbody>
</table>
<a href="./controller/limpeza.php?limpeza=4&igreja=<?php echo $igreja;?>">
<button type="button" class="btn btn-primary">Imprimir <?php echo $congregcao->razao();?></button></a>
<?php
	//print_r($tbodytab->tabelaLimp($congregcao->rol()));

?>
