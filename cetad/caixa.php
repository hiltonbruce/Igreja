	<link rel="stylesheet" type="text/css" media="screen, projection" href="tabs.css" />

<table>
	<colgroup>
		<col id="Item">
		<col id="Nome">
		<col id="Jan">
		<col id="Fev">
		<col id="Mar">
		<col id="Abr">
		<col id="Mai">
		<col id="Jun">
		<col id="Jul">
		<col id="Ago">
		<col id="Set">
		<col id="Out">
		<col id="Nov">	
		<col id="albumCol"/>
	</colgroup>
	
	<thead>
		<tr>
			<th scope="col">&nbsp;</th>
			<th scope="col">Nome</th>
			<th scope="col">Jan</th>
			<th scope="col">Fev</th>
			<th scope="col">Mar</th>
			<th scope="col">Abr</th>
			<th scope="col">Mai</th>
			<th scope="col">Jun</th>
			<th scope="col">Jul</th>
			<th scope="col">Ago</th>
			<th scope="col">Set</th>
			<th scope="col">Out</th>
			<th scope="col">Nov</th>
			<th scope="col">Dez</th>
		</tr>
	</thead>
	<tbody>
	  <?PHP
		$pago = new cetad ();
		$pago -> caixa();
	  ?>
    </tbody>
</table>