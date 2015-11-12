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
	$todacongrtbody = ''; //Limpa variável para receber os dados da tabela

	if ($_GET['limpeza'] !='4' && $_GET['limpeza'] !='1') {
		$tabtodas = '<div style="page-break-before: always;"> </div>';
	}else{
		$tabtodas = '';
	}

	while($roligreja = mysql_fetch_array($todacongrLimp)){

	$tabtodas .= '<table class="table table-striped table-hover" >
					<caption>Relação do Material de Limpeza para: '.$roligreja['razao'].' - '.$mesref.'</caption>

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
							<th scope="col">Solicitado</th>
							<th scope="col">Entregue</th>
						</tr>
					</thead>
					<tbody>';
		$tabtodas .= $tbodytab->tabLimp ($roligreja['rol']);//$tbodytab->tabelaLimp($roligreja['rol']) -> vem do script que o chama /views/limpezatot.php

		$tabtodas .= '</tbody></table>';
		if ($roligreja['matlimpeza']=='1') {
			$endEntrega ='Situada: '.$roligreja['rua'].', N&ordm;: '.$roligreja['numero'].
									', bairro: '.$roligreja['bairro'].', '.$roligreja['cidade'].'-'.$roligreja['uf'];

			$tabtodas .= '<fieldset><legend>Obs.:</legend> As congregações que não enviarem a lista de material de limpeza
		no próximo bimestre não serão relacionadas para entrega!</fieldset>';
			$tabtodas .= '<fieldset><legend>Enderço para entrega.:</legend>'.$endEntrega.'</fieldset>';
		}
		//$tabtodas .= $saltoPagina;
	}
	echo  $tabtodas;
?>
