<?php
	if ($_GET['limpeza']=='4') {
		//$dadoscong vem do script controller/limpeza.php
		$todacongr 	 = 'SELECT * FROM igreja WHERE rol="'.$dadoscong->rol().'" ORDER BY razao';
	}elseif ($_GET['limpeza']=='1') {
		//$dadoscong vem do script controller/limpeza.php
		$todacongr 	 = 'SELECT * FROM igreja WHERE status="1" ORDER BY razao';
	}else {
		$todacongr 	 = 'SELECT * FROM igreja ORDER BY razao';
	}
	$todacongrLimp = mysql_query($todacongr);
	$incrrc=0; //indece p/ zebrar tabela
	$todacongrtbody = ''; //Limpa vari�vel para receber os dados da tabela
	if ($_GET['limpeza'] !='4' && $_GET['limpeza'] !='1') {
		$tabtodas = '<div style="page-break-before: always;"> </div>';
	}else{
		$tabtodas = '';
	}
	if (!empty($_GET['div'])) {
		$resEntrega = '';
		// Acrescenta rodape e salto de p�gina
		$tabtodas .= $saltoPagina;
		if (!empty($_GET['name'])) {
			$resEntrega  .= '<strong>'.strip_tags($_GET['name']).'</strong>';
		}

		if (!empty($_GET['phone'])) {
			$resEntrega .= ' &bull;<span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span>';
			$resEntrega .= ' <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> '.strip_tags($_GET['phone']);
		}

		if (!empty($_GET['obs'])) {
			$resEntrega .= '<p class="text-center">OBS.: '.strip_tags($_GET['obs']).'</p>';
		}
		$rodResp = '<tfoot><tr>';
		$rodResp .= '<th colspan="5" class="primary text-center">';
		$rodResp .= '<h4>Respons&aacute;vel pela entrega: '.$resEntrega.'</h4>';
		$rodResp .= '</th>';
		$rodResp .= '</tr></tfoot>';
	} else {
		$saltoPagina = '';
		$rodResp = '';
	}

	while($roligreja = mysql_fetch_array($todacongrLimp)){
	$tabtodas .= '<table class="table table-striped table-hover" >
		<caption>Material de Limpeza - '.$roligreja['razao'].',  para os meses de '.$periodo['0'].'</caption>
			<colgroup>
				<col id="item">
				<col id="Unidade">
				<col id="Discriminacao">
				<col id="Solicitado">
				<col id="albumCol"/>
			</colgroup>
		<thead>
			<tr>
				<th scope="col">item</th>
				<th scope="col">Unidade</th>
				<th scope="col">Discrimina&ccedil;&atilde;o</th>
				<th scope="col">Solicitado</th>
				<th scope="col">Entregue</th>
			</tr>
		</thead>
		<tbody>';
		$tabtodas .= $tbodytab->tabLimp ($roligreja['rol']);//$tbodytab->tabelaLimp($roligreja['rol']) -> vem do script que o chama /views/limpezatot.php
		$tabtodas .= '</tbody>'.$rodResp.'</table>';
		if ($roligreja['matlimpeza']=='1') {
			$endEntrega ='Situada: '.$roligreja['rua'].', N&ordm;: '.$roligreja['numero'].
									', bairro: '.$roligreja['bairro'].', '.$roligreja['cidade'].'-'.$roligreja['uf'];
			$tabtodas .= '<fieldset><legend>Obs.:</legend> As congrega&ccedil;&otilde;es ';
			$tabtodas .= 'que n&atilde;o enviarem a lista de material de limpeza ';
			$tabtodas .= 'no pr&ocute;ximo bimestre n&atilde;o ser&atilde;o relacionadas para entrega!</fieldset>';
			$tabtodas .= '<fieldset><legend>Ender�o para entrega.:</legend>'.$endEntrega.'</fieldset>';
		}

			$tabtodas .= $saltoPagina;

	}
	echo  $tabtodas;
?>
