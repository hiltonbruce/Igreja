<?PHP
$query  = 'SELECT i.razao,i.setor,m.rol,m.nome,m.celular,m.fone_resid ';
$query .= 'FROM igreja AS i, membro AS m ';
$query .= 'WHERE i.status="1" AND i.pastor=m.rol ';
$query .= 'ORDER BY i.setor,m.nome,i.razao';
$sql3 = mysql_query($query) or die(mysql_error());
$total = mysql_num_rows($sql3);

while ($coluna = mysql_fetch_array($sql3)) {
	if ($coluna["nome"] != '') {
		$nome = cargo($coluna["rol"])['1'] . ' ' . $coluna["nome"];
	} else {
		$nome =  $igSede->pastor();
	}


	$cel = ($coluna['celular'] == '') ? '<strong>N&atildeo informado</strong>' : $coluna['celular'];
	$res = ($coluna['fone_resid'] == '') ? '<strong>N&atildeo informado</strong>' : $coluna['fone_resid'];
	$fones =  'Cel.: ' . $cel . '&nbsp;-&nbsp;Resid.:&nbsp;' . $res;


	$dados[$coluna['setor']][] = [
		'rol'  => sprintf("%'05u", intval($coluna["rol"])),
		'nome' => $nome,
		'congregacao' => $coluna["razao"],
		'dirig1' => null,
		'dirig2' => null,
		'fone' => $fones,
	];
}

echo '<h5>' . data_extenso(conv_valor_br(date("Y-m-d"))) . '</h5>';
foreach ($dados as $key => $value) {

	echo '
	<table class="table table-striped table-bordered" >
	<caption><h3>Dirigentes - Setor  ' . nRomano($key) . '</h3>
	  </caption>
		<thead class="navbar-inverse" style="color:#FFF;" >
			<tr>
			<th scope="col">Rol</th>
			<th scope="col">Dire&ccedil;&atilde;o - Atual</th>
			<th scope="col">Congre&ccedil;&atilde;o</th>
			<th scope="col" width="20%">1&ordm; Dirigente (Atualizar)</th>
			<th scope="col" width="20%">2&ordm; Dirigente (Atualizar)</th>
			<th scope="col">Fones</th>
			</tr>
		</thead>
		<tbody>';
	foreach ($value as $key => $linha) {
		echo '<tr/>';

		echo '<td>';
		echo $linha['rol'];
		echo '</td>';
		echo '<td>';
		echo $linha['nome'];
		echo '</td>';
		echo '<td>';
		echo $linha['congregacao'];
		echo '</td>';
		echo '<td>';
		echo '</td>';
		echo '<td>';
		echo '</td>';
		echo '<td>';
		echo $linha['fone'];
		echo '</td>';

		echo '<tr/>';
	}
	echo '
		</tbody>
		</table>
		';
}

// var_dump($dados[1]);

// exit;

if (!empty($_GET['ext']) && $_GET['ext'] == '1') {
	$group  = '<col id="1 Dirigente"><col id="2 Dirigente">';
	$tabTh  = '<th scope="col" width="20%">1&ordm; Dirigente (Atualizar)</th>';
	$tabTh  .= '<th scope="col" width="20%">2&ordm; Dirigente (Atualizar)</th>';
} else {
	$group = '';
	$tabTh = '';
}
?>
<h4>
	<?PHP
	if ($total > "1") {
		if ($total > "100")
			printf("Com %s dirigentes!", number_format($total, 0, ',', '.'));
		else
			printf("Com %s dirigentes!", number_format($total, 0, ',', '.'));
	} elseif ($total == "1") {
		echo "Com apenas um dirigente!";
	} else {
		echo "N&atilde;o obtivemos nenhum resultado!";
	}
	?>
</h4>