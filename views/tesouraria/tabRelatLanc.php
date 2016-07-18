<?php
	$tabMembros = new membro();
	$tesSede = $tabMembros->nomes();

	$cargoIgreja = new tes_cargo;
	$tesArray = $cargoIgreja->dadosArray();

	//tabela com a lista p confirmar lançamento

	$lancContabil = new tes_relatLanc();
	$resultado = $lancContabil->histLancamentos($roligreja,$mes,$ano,$dia,$cta,$debValor,$credValor,$refer,$numLanc,$vlrLanc);

	$tabLancamento = $resultado['0'];

	$statusLancamento = 'Lan&ccedil;amentos Contábeis';

	$linkResumo  = 'rec=15&igreja='.$_GET['igreja'].'&dia='.$_GET['dia'].'&ano='.$_GET['ano'].'&mes='.$_GET['mes'];
	$linkResumo .='&rol='.$_GET['rol'].'&nome='.$_GET['nome'];
	$linkResumo .= '&credito='.$_GET['credito'].'&conta='.$_GET['conta'];

	if (!empty($_GET['escolha'])) {
		$imprimir  = '<a href="tesouraria/receita.php/?tipo=1&'.$linkResumo.' " target="_blank" >';
		$imprimir .= '<button class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-print">';
		$imprimir .= '</span> Imprimir ...</button> </a>';
		$titulo='';
		$rodape  = '<tfoot><tr class="info"><th>Total lan&ccedil;ado:</th><th class="text-right">';
		$rodape .= number_format($resultado['2'],2,',','.').'</th></tr></tfoot>';
	}else {
		$imprimir='';
		$rodape = '<tfoot><tr><th>Rubricar:</th><th>Data:</th></tr></tfoot>';
		$dirigenteIgreja = $igrejaSelecionada->pastor();

		if ($igrejaSelecionada->rol()>'1') {
			$dirCong = new DBRecord('membro',$igrejaSelecionada->pastor(),'rol');
			$dirigenteIgreja = $dirCong->nome();
			$tesIgreja = $tesArray['8'][$igrejaSelecionada->rol()]['1']['nome'];//Tesoureiro das congregações
		}else {
			$tesIgreja = $tesArray['22']['1']['1']['nome'];//Tesoureiro Geral - Central
		}

		if ($_GET['escolha']=='') {
			$fonIni = '<p style="font-size: 80%;padding: 0 0 0 0;margin-bottom: 0;">';
			$fonFim = '</p>';
		}else {
			$fonIni = '<h2>';
			$fonFim = '</h2>';
		}

		$titulo  =  $fonIni.$statusLancamento.$fonFim.$fonIni;
		$titulo .=  'Igreja: '.$igrejaSelecionada->razao().$fonFim.$fonIni;
		$titulo .=  'Direção Atual: '.$dirigenteIgreja;
		$titulo .=  ', 1&ordm; Tesoureiro: '.$tesIgreja.$fonFim;//Tesoureiro
		$titulo .=  'Data de Emiss&atilde;o: '.date('d/m/Y H:i:s');//Tesoureiro

	}

if (empty($descricoo) && $tabLancamento!='') {
	$descricao='Descrição';

	echo($imprimir);

?>
<table class='table table-hover table-bordered'>
		<caption class="text-left">
			<?php echo $titulo;?></caption>
			<colgroup>
				<col id="albumCol">
				<col id="valor"/>
			</colgroup>
		<thead>
			<tr>
				<th scope="col"><?php echo $descricao;?></th>
				<th scope="col" class="centro"><?php echo $tituloColuna5;?></th>
			</tr>
		</thead>
			<?php
				echo $tabLancamento.$rodape;
			?>
</table>
<?php
	//print_r($tabMembros->nomes());

	//print_r ($resultado['1']);

	echo($imprimir);
}
?>
