<?php
switch ($_GET['vencidas']) {
	case '2':
		$titulo ='Busca por contas Vencida e Motivo: <span style="font-weight:normal;font-style:italic;">'.$_GET['motivo'].'</span>';
		$corpoTabela = $lista->vencidasMotivo($_GET['motivo'], $_GET['credor']);
		break;
	case '3':
		$titulo ='Busca por Motivo: <span style="font-weight:normal;font-style:italic;">'.$_GET['motivo'].'</span>';
		$corpoTabela = $lista->motivo($_GET['motivo'], $_GET['credor']);
		break;
	default:
		$titulo ='Contas Vencidas';
		$corpoTabela = $lista->listavencidas($dataget);
		break;
}
?>
<table id="Contas do per&iacute;odo" class='table table-condensed' >
	<caption>
	<?php echo $titulo;?>
	</caption>
	<colgroup>
		<col id="dia">
		<col id="Evento">
		<col id="Data Pgto">
		<col id="albumCol" />
	</colgroup>
	<thead>
		<tr>
			<th scope="col">Vencimento</th>
			<th scope="col">Fatura</th>
			<th scope="col">Data&nbsp;Pgto</th>
			<th scope="col"> -- R$ --</th>
		</tr>
	</thead>
	<tbody id="periodo">

	<?php
	echo $corpoTabela;
	?>

	</tbody>
</table>
<br />