<?php 
//$mesref = $_GET['mesref'];
$mesref = '02/2013';//Remover quando terminar o script
?>

<table id="listTable" >
	<caption>Relação do Material de Limpeza Total para: <?php echo $mesref;?></caption>
	
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
			<th scope="col">Total</th>
			<th scope="col">Entregue</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$tbodytab = new limplista($mesref);
			echo $tbodytab->TotMaterial();
		?>
	</tbody>
</table>
<?php 
	require_once $todascongreg;
?>