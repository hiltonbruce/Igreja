<?PHP
$query  = 'SELECT i.razao,i.setor,m.rol,m.nome,m.celular,m.fone_resid ';
$query .= 'FROM igreja AS i, membro AS m ';
$query .= 'WHERE i.status="1" AND i.pastor=m.rol ';
$query .= 'ORDER BY i.setor,m.nome,i.razao';
$sql3 = mysql_query ($query) or die (mysql_error());
$total = mysql_num_rows($sql3);
if (!empty($_GET['ext']) && $_GET['ext']=='1') {
	$group  = '<col id="1 Dirigente"><col id="2 Dirigente">';
	$tabTh  = '<th scope="col" width="20%">1&ordm; Dirigente (Atualizar)</th>';
	$tabTh  .= '<th scope="col" width="20%">2&ordm; Dirigente (Atualizar)</th>';
} else {
	$group = '';
	$tabTh = '';
}
?>
<h5>
	<table class='table table-striped table-bordered' >
		<caption>Lista de Dirigentes - <?PHP  print data_extenso (conv_valor_br(date("Y-m-d")));?>
      	</caption>
			<colgroup>
				<col id="Rol">
				<col id="Nome">
				<col id="Dirigente Atual">
				<?php
					echo $group;
				?>
				<col id="Setor">
				<col id="albumCol"/>
			</colgroup>
			<thead class='navbar-inverse' style='color:#FFF;'>
				<tr>
				<th scope="col">Rol</th>
				<th scope="col">Dire&ccedil;&atilde;o - Atual</th>
				<th scope="col">Congre&ccedil;&atilde;o</th>
				<?php
					echo $tabTh;
				?>
				<th scope="col">Setor</th>
				<th scope="col">Fones</th>
				</tr>
			</thead>
			<tbody>
		<?PHP
			while($coluna = mysql_fetch_array($sql3))
			{
			?>
      <tr>
				<td><?php printf("%'05u",intval($coluna["rol"]));?></td>
				<td>
					<?php
				 		echo cargo ($coluna["rol"]).' '.$coluna["nome"];
				 	?>
				</td>
				<td><?php echo $coluna["razao"];?></td>
				<?php
				if ($group!='') {
					?>
					<td></td>
					<td></td>
					<?php
				}
				?>
				<td class='text-center'>
					<?php
	         echo nRomano($coluna['setor']);
	        ?>
				</td>
				<td>
					<?php
					$cel = ($coluna['celular']=='') ? '<strong>N&atildeo informado</strong>' : $coluna['celular'] ;
					$res = ($coluna['fone_resid']=='') ? '<strong>N&atildeo informado</strong>' : $coluna['fone_resid'] ;
	         echo 'Cel.: '.$cel.'&nbsp;-&nbsp;';
 	         echo 'Resid.:&nbsp;'.$res;
	        ?>
				</td>
			<?PHP
			}//loop while produtos
	?>
		</tbody>
		</table>
	</h5>
	<h4>
	<?PHP
	if ($total>"1")
	{
		if ($total>"100")
			printf("Com %s dirigentes!",number_format($total, 0, ',', '.'));
		else
			printf("Com %s dirigentes!",number_format($total, 0, ',', '.'));

	}elseif ($total=="1"){
		echo "Com apenas um dirigente!";
	}else{
		echo "N&atilde;o obtivemos nenhum resultado!";
	}
?>
</h4>
