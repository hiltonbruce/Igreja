<?php
$tbodytab = new limplista($mesref);
if ($_GET['limpeza']!='4') {
?>
<table class='table table-striped'>
	<caption>Relação de Material de  Limpeza <u>PARA</u> pedido</caption>
		<colgroup>
			<col id="item">
			<col id="Unidade">
			<col id="Discriminação">
			<col id="albumCol"/>
		</colgroup>
	<thead>
		<tr>
			<th scope="col">item</th>
			<th scope="col">Unidade</th>
			<th scope="col">Discriminação</th>
			<th scope="col">Meses</th>
		</tr>
	</thead>
	<tbody>
		<?php
			echo $tbodytab->ListaMaterial();
		?>
	</tbody>
</table>
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
