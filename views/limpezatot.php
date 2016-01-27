<?php
$tbodytab = new limplista($mesref);
if ($_GET['limpeza']!='4') {
?>
<table class='table table-striped table-hover' >
	<caption>Relação do Material de Limpeza Total - <?php echo $periodo['0'];?></caption>
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
			echo $tbodytab->TotMaterial();
		?>
	</tbody>
</table>
	<?PHP
	/*
		echo $saltoPagina;
	?>
<table class='table table-striped table-hover' >
	<caption>Relação do Material de Limpeza Total para Entrega - <?php echo $mesref;?></caption>
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
			echo $tbodytab->TotMatEntregar();
		?>
	</tbody>
</table>
	<?PHP
		echo $saltoPagina;
	?>
<table class='table table-striped table-hover' >
	<caption>Material de Limpeza Total Adquirido no Mercado Autorizado  - <?php echo $mesref;?></caption>
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
			echo $tbodytab->TotMatPegar();
		?>
	</tbody>
</table>
	<?PHP
	*/
		echo $saltoPagina;
}
	require_once $todascongreg;
	$dadosCidade = new DBRecord('cidade',$dadoscong->cidade(), 'id');
	if ($dadoscong->matlimpeza()!='0') {
		//Assinatura do tesoureiro(a) e elador(a)
		//$dadoscong vem do script controller/limpeza.php
	?>
	<div id="added-div-2">
      <h2><?PHP  print $dadosCidade->nome()." - ".$dadoscong->uf().", ".data_extenso (date('d/m/Y'));?></h2>
      <p>&nbsp;</p>
      <p class="bottom">&nbsp;</p>
	  <div id="pastor"><?PHP echo 'Joseilton Costa Bruce';?><br />Tesoureiro </div>
	</div>
	<?php
	}
	?>
