<?php
$dia = $_GET['dia'];
$mes = $_GET['mes'];
$ano = $_GET['ano'];
$apagarEntrada	= '?escolha=models/tes/excluir.php&tabela=dizimooferta&id=';
$alterarEntrada	= '?escolha=tesouraria/receita.php&menu=top_tesouraria&rec=1&tabela=dizimooferta&id=';
if ($_GET['idDizOf']>'0' && $_GET['rec']=='9') {
?>
<table class='table table-condensed'>
	<tbody>
		<tr>
			<td><label>Igreja: </label>
				<select name="igreja" id="igreja" onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>" ><?php
				$listaIgreja = $bsccredor->List_Selec_pop($linkAcesso,$_GET['igreja']);
				//echo $listaIgreja;
				?></select>
			</td>
			<td>
				Ou <a href="<?php echo $apagarEntrada;?>" ><button>Apagar</button></a> esta entrada!
			</td>
		</tr>
	</tbody>

</table>
<?PHP
}

	//require_once 'forms/concluirdiz.php';
	if ($_GET['idDizOf']>0) {
	//Incluir form para alterar ou excluir pre-lançamento de Dízimos e Ofertas
	require_once 'forms/tes/editDizOferta.php';
		}

$tabMembros = new membro();
	if ($_POST['concluir']=='1') {
			$tabLancamento = $dizmista->concluir($idIgreja);
		} else {
			//tabela com a lista p confirmar lanï¿½amento
			$roligreja = (empty($_GET['igreja'])) ? '':$_GET['igreja'];
			$resultado = $dizmista->dizimistas($roligreja,$apagarEntrada,$dia,
												$mes,$ano,$_GET['rec'],$_GET['credito'],
												$_GET['debito'],$alterarEntrada);
			$tabLancamento= $resultado['1'];

			if ($resultado['2']) {
				$statusLancamento = 'Lan&ccedil;amentos Confirmado';
			}elseif ($resultado['0']!=0) {
				$statusLancamento = 'Aguardando confima&ccedil;&atilde;o!';
			}else {
				$statusLancamento = '';
			}

			$statusLancamento .= $msg;
		}


		if (!empty($_GET['escolha'])) {

			$linkResumo  = 'rec='.$_GET['rec'].'&igreja='.$_GET['igreja'].'&ano='.$_GET['ano'].'&mes='.$_GET['mes'];
			$linkResumo .='&rol='.$_GET['rol'].'&nome='.$_GET['nome'].'&dia='.$_GET['dia'];
			$linkResumo .= '&credito='.$_GET['credito'];

			echo '<a href="controller/modeloPrint.php/?tipo=1&'.$linkResumo.' " target="_blank" >';
			echo '<button class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-print">';
			echo '</span>&nbsp;&nbsp;&nbsp;Imprimir a tabela abaixo...</button> </a>';
		}
?>
<table class='table'>
		<caption class="text-left">
			<?php
			$dirigenteIgreja = $igrejaSelecionada->pastor();


			if ($idIgreja>'1') {
				$dirCong = new DBRecord('membro',$igrejaSelecionada->pastor(),'rol');
				$dirigenteIgreja = 'Dirigente: '.$dirCong->nome();
				$cargoIgreja = new tes_cargo;
				//print_r($cargoIgreja->dadosArray());

				$tesArray = $cargoIgreja->dadosArray();
				$tesIgreja = $tesArray['8'][$idIgreja]['1']['nome'];
				//reset($tesIgreja);
				//print_r($tesArray );
			}else {
				$tesSede = $tabMembros->nomes();
				$tesIgreja = $tesSede ['4037']['0'];
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

			$sldPendente = $dizmista->outrosdizimos($_GET['rolIgreja']);

			if ($sldPendente>0) {
				printf("$fonIni Lan&ccedil;amentos de outros respons&aacute;veis: R$: %'.45s
			  $fonFim",number_format($sldPendente,2,',','.'));
			}
			?></caption>
			<colgroup>
				<col id="Data">
				<col id="Rol/Nome">
				<col id="Tipo">
				<col id="Valor">
				<col id="albumCol"/>
			</colgroup>
		<thead>
			<tr>
				<th scope="col">Data Lan&ccedil;.</th>
				<th scope="col">Rol/Nome</th>
				<th scope="col">Tipo</th>
				<th scope="col">Valor(R$)</th>
				<th scope="col"><?php echo $tituloColuna5;?></th>
			</tr>
		</thead>
			<?php
				echo $tabLancamento;
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
	<table class='table table-condensed table-striped'>
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
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
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
