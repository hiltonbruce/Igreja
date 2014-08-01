<?php
$tbodytab = new limplista($mesref);
if ($_GET['limpeza']!='4') {
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
			echo $tbodytab->TotMaterial();
		?>
	</tbody>
</table>
	<?PHP 
		echo $saltoPagina;
	?>
<table id="listTable" >
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
<table id="listTable" >
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
		echo $saltoPagina;
}
	require_once $todascongreg;
	if ($dadoscong->matlimpeza()!='0') {
		//Assinatura do tesoureiro(a) e elador(a)
		//$dadoscong vem do script controller/limpeza.php
	?>
	<div id="added-div-2">
      <h2><?PHP  print $dadoscong->cidade()." - ".$dadoscong->uf().", ".data_extenso (date('d/m/Y'));?></h2>
      <p>&nbsp;</p>
      <p class="bottom">&nbsp;</p>
	  <div id="pastor"><?PHP echo 'Joseilton Costa Bruce';?><br />Tesoureiro </div>
	  <div id="secretario"><?PHP echo '_____________________';?><br />Zelador(a)</div>
	</div>
	<?php 
	}
	?>
