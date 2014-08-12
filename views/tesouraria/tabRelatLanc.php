<?php

	$tabMembros = new membro();
	//tabela com a lista p confirmar lanï¿½amento
	
	$lancContabil = new tes_relatorioLanc();
	$resultado = $lancContabil->histLancamentos($roligreja,$mes,$ano);
	$tabLancamento= $resultado['0'];
			
	$statusLancamento = 'Lan&ccedil;amentos Contábeis';
?>
<table style="width: 95%;">
		<caption class="text-left">
			<?php
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
				echo $fonIni.$statusLancamento.$fonFim.$fonIni.'Igreja: '.$igrejaSelecionada->razao().$fonFim.$fonIni
						.$dirigenteIgreja.', 1&ordm; Tesoureiro: '.$tesIgreja.$fonFim;	
			
		
			?></caption>
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
				$linkResumo  = 'rec='.$_GET['rec'].'&igreja='.$_GET['igreja'].'&ano='.$_GET['ano'].'&mes='.$_GET['mes'];
				$linkResumo .='&rol='.$_GET['rol'].'&nome='.$_GET['nome'].'&dia='.$_GET['dia'];
				$linkResumo .= '&credito='.$_GET['credito'];
			?>
</table>
<?php
//print_r($tabMembros->nomes());
	if (!empty($_GET['escolha'])) {
		echo '<a href="controller/modeloPrint.php/?tipo=1&'.$linkResumo.' " target="_blank" >';
		echo '<button class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-print">';
		echo '</span> Imprimir ...</button> </a>';
	}else {
?>
		<span id="text-right">Conferido por:</span>
	<table>
			<colgroup>
				<col id="Data">
				<col id="albumCol"/>
			</colgroup>
		<thead>
			<tr>
				<th scope="col">Data</th>
				<th scope="col">Assinatura</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td rowspan="4">&nbsp;</td>
				<td width="85%">&nbsp;</td>
			</tr>
			<tr>
				<td class='odd'>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td class='odd'>&nbsp;</td>
			</tr>		
		</tbody>
		<tfoot>
		<tr id='total'><td colspan="5"></td>
		</tr>
		</tfoot>
	</table>
<?php 
}
?>