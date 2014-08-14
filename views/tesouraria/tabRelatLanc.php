<?php

	$tabMembros = new membro();
	//tabela com a lista p confirmar lanï¿½amento
	
	$lancContabil = new tes_relatorioLanc();
	$resultado = $lancContabil->histLancamentos($roligreja,$mes,$ano);
	$tabLancamento= $resultado['0'];
			
	$statusLancamento = 'Lan&ccedil;amentos Contábeis';
	
	$linkResumo  = 'rec=15&igreja='.$_GET['igreja'].'&ano='.$_GET['ano'].'&mes='.$_GET['mes'];
	$linkResumo .='&rol='.$_GET['rol'].'&nome='.$_GET['nome'].'&dia='.$_GET['dia'];
	$linkResumo .= '&credito='.$_GET['credito'];
	
	if (!empty($_GET['escolha'])) {
		$imprimir  = '<a href="tesouraria/receita.php/?tipo=1&'.$linkResumo.' " target="_blank" >';
		$imprimir .= '<button class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-print">';
		$imprimir .= '</span> Imprimir ...</button> </a>';
		
		$titulo='';
	}else {
		$imprimir='';
		$dirigenteIgreja = $igrejaSelecionada->pastor();
			
			
		if ($idIgreja>'1') {
			$dirCong = new DBRecord('membro',$igrejaSelecionada->pastor(),'rol');
			$dirigenteIgreja = 'Dirigente: '.$dirCong->nome();
			$cargoIgreja = new tes_cargo;
			//print_r($cargoIgreja->dadosArray());
		
			$tesArray = $cargoIgreja->dadosArray()['8'][$idIgreja]['1'];
			$tesIgreja = $tesArray['nome'];
			//reset($tesIgreja);
			//print_r($tesIgreja );
		}else {
			$tesIgreja = $tabMembros->nomes()['4037']['0'];
		}
			
			
		if ($_GET['escolha']=='') {
			$fonIni = '<p style="font-size: 80%;padding: 0 0 0 0;margin-bottom: 0;">';
			$fonFim = '</p>';
		}else {
			$fonIni = '<h2>';
			$fonFim = '</h2>';
		}
		$titulo  =  $fonIni.$statusLancamento.$fonFim.$fonIni;
		if ($_GET['igreja']>'0') {
			$titulo .=  'Igreja: '.$igrejaSelecionada->razao().$fonFim.$fonIni;
			$titulo .=  'Direção Atual: '.$dirigenteIgreja;
			$titulo .=  ', 1&ordm; Tesoureiro:'.$tesIgreja.$fonFim;//Tesoureiro
		}
		
	}
	
	echo($imprimir);
	
?>
<table style="width: 95%;">
		<caption class="text-left">
			<?php echo $titulo;?></caption>
			<colgroup>
				<col id="descrição">
				<col id="albumCol"/>
			</colgroup>
		<thead>
			<tr>
				<th scope="col">Descrição</th>
				<th scope="col"><?php echo $tituloColuna5;?></th>
			</tr>
		</thead>
			<?php
				echo $tabLancamento;
			?>
			<tfoot><tr><th>Rubricar:</th><th>Data:</th></tr></tfoot>
</table>
<?php
//print_r($tabMembros->nomes());

echo($imprimir);
?>