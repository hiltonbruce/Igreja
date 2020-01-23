<?php
$tbodytab = new limplista($mesref);
?>
<table class='table table-striped'>
	<caption class="text-left">Formul&aacute;rio Edi&ccedil;&atilde;o Material de  Limpeza Pedido</caption>
	<colgroup>
		<col id="item">
		<col id="Unidade">
		<col id="Discriminacao">
		<col id="Tempo">
		<col id="Quant">
		<col id="Tipo 1">
		<col id="Tipo 2">
		<col id="Tipo 3">
		<col id="Tipo 4">
		<col id="Tipo 5">
		<col id="Valor">
		<col id="albumCol"/>
	</colgroup>
	<thead>
		<tr>
			<th scope="col">item</th>
			<th scope="col">Quant</th>
			<th scope="col" data-toggle="tooltip" data-placement="top" title="Unidade de medida">Unid</th>
			<th scope="col">Discrimina&ccedil;&atilde;o</th>
			<th scope="col" data-toggle="tooltip" data-placement="top" title="Tempo de uso em m&ecirc;s">Tempo</th>
			<th scope="col">Tipo 1</th>
			<th scope="col">Tipo 2</th>
			<th scope="col">Tipo 3</th>
			<th scope="col">Tipo 4</th>
			<th scope="col">Tipo 5</th>
			<th scope="col">Valor</th>
			<th scope="col">Status</th>
		</tr>
	</thead>
	<tbody>
		<?php
		echo $tbodytab->FormMaterial(intval($_GET['id']));
		?>
	</tbody>
</table>
