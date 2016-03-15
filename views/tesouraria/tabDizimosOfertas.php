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
			$linkResumo .= '&debito='.$_GET['debito'];
			echo '<div class="row"><div class="col-xs-2">';
			echo '<br />';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$linkLancamento.'" >';
		  	echo '<button type="button" class="btn btn-primary btn-sm" tabindex="'.++$ind.'">';
		  	echo '<span class="glyphicon glyphicon-backward"></span> Voltar...</button>';
			echo '</a></div></div>';
			echo '<form target="_blank" action="controller/modeloPrint.php/" >';
			echo '<div class="row">';
			echo '<div class="col-xs-2">';
			echo '<input name="rec" type="hidden" value="'.$_GET['rec'].'" />';
			echo '<input name="igreja" type="hidden" value="'.$_GET['igreja'].'" />';
			echo '<input name="ano" type="hidden" value="'.$_GET['ano'].'" />';
			echo '<input name="mes" type="hidden" value="'.$_GET['mes'].'" />';
			echo '<input name="nome" type="hidden" value="'.$_GET['nome'].'" />';
			echo '<input name="dia" type="hidden" value="'.$_GET['dia'].'" />';
			echo '<input name="credito" type="hidden" value="'.$_GET['credito'].'" />';
			echo '<input name="debito" type="hidden" value="'.$_GET['debito'].'" />';
			echo '<input name="tipo" type="hidden" value="1" />';
			echo '<label>Rol 1&ordf; Assin:</label>';
			echo '<input name="r1" type="text" value="4037" class="form-control"/>';
			echo '</div>';
			echo '<div class="col-xs-2"><label>Rol 2&ordf; Assin:</label>';
			echo '<input name="r2" type="text" class="form-control" />';
			echo '</div>';
			echo '<div class="col-xs-2"><label>Rol 3&ordf; Assin:</label>';
			echo '<input name="r3" type="text" value="72" class="form-control" />';
			echo '</div>';
			echo '<div class="col-xs-2"><label>Rol 4&ordf; Assin:</label>';
			echo '<input name="r4" type="text" class="form-control" />';
			echo '</div>';
			echo '<div class="col-xs-2"><label>&nbsp;</label>';
			echo '<input name="submit" type="submit" class="btn btn-primary btn-sm form-control" value="Imprimir a tabela"/>';
			echo '</div>';
			echo '</form></div>';

		}
?>
<table class='table table-striped'>
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

	$dadosMembros = new membro();
	$dados = $dadosMembros->nomes();
?>
		<span id="text-right">Conferido por:</span>
	<table class='table table-condensed table-striped'>
			<colgroup>
				<col id="Data">
				<col id="albumCol"/>
			</colgroup>
		<thead>
			<tr>
				<th scope="col">Nome Leg&eacute;vel</th>
				<th scope="col">Assinatura</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td width="30%"><?php echo $dados[$_GET['r1']]['6'].$dados[$_GET['r1']]['5'];?></td>
				<td width="700%">&nbsp;</td>
			</tr>
			<tr>
				<td><?php echo $dados[$_GET['r2']]['6'].$dados[$_GET['r2']]['5'];?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><?php echo $dados[$_GET['r3']]['6'].$dados[$_GET['r3']]['5'];?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><?php echo $dados[$_GET['r4']]['6'].$dados[$_GET['r4']]['5'];?></td>
				<td>&nbsp;</td>
			</tr>
		</tbody>
		<tfoot>
		<tr>
				<th scope="col" colspan='2'>Data: </th>
		</tr>
		</tfoot>
	</table>
<?php
}
?>
