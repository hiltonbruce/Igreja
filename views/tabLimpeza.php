<?php 
$congregcao = new DBRecord('igreja', $igreja, 'rol'); // $igreja vem do script q chamar este
?>
<table id="listTable" >
	<caption>Relação do Material de Limpeza para: <?php echo $congregcao->razao().' - '.$mesref;?></caption>
	
		<colgroup>
			<col id="item">
			<col id="Unidade">
			<col id="Discriminação">
			<col id="Solicitado">
			<col id="albumCol"/>
		</colgroup>
	<thead>
		<tr>
			<th scope="col">item</th>
			<th scope="col">Unidade</th>
			<th scope="col">Discriminação</th>
			<th scope="col">Solicitado</th>
			<th scope="col">Entregue</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$tbodytab = new limplista($mesref);
			echo $tbodytab->tabelaLimp($congregcao->rol());
		?>
	</tbody>
</table>
<a href="./controller/limpeza.php?limpeza=4&igreja=<?php echo $igreja;?>">
<button type="button">Imprimir <?php echo $congregcao->razao();?></button></a>