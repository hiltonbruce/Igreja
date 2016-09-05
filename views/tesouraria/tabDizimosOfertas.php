<?php
$statusLancamento='';
$debitoGet = (empty($_GET['debito'])) ? false : $_GET['debito'] ;
$creditoGet = (empty($_GET['credito'])) ? false : $_GET['credito'] ;
$recGet = (empty($_GET['rec'])) ? false : $_GET['rec'] ;
$rolGet = (empty($_GET['rol'])) ? false : $_GET['rol'] ;
$igrejaGet = (empty($_GET['igreja'])) ? false : $_GET['igreja'] ;
$ano = (empty($_GET['ano'])) ? '' : $_GET['ano'] ;
$mes = (empty($_GET['mes'])) ? '' : $_GET['mes'] ;
$nomeGet = (empty($_GET['nome'])) ? '' : $_GET['nome'] ;
$dia= (empty($_GET['dia'])) ? '' : $_GET['dia'] ;
$idDizOfGET = (empty($_GET['idDizOf'])) ? '' : $_GET['idDizOf'] ;

$apagarEntrada	= '?escolha=models/tes/excluir.php&tabela=dizimooferta&id=';
$alterarEntrada	= '?escolha=tesouraria/receita.php&menu=top_tesouraria&rec=1&tabela=dizimooferta&id=';

if ($idDizOfGET>'0' && $recGet=='9') {
?>
<table class='table table-condensed'>
	<tbody>
		<tr>
			<td><label>Igreja: </label>
				<select name="igreja" id="igreja" onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>" ><?php
				$listaIgreja = $bsccredor->List_Selec_pop($linkAcesso,$igrejaGet );
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
	//Incluir form para alterar ou excluir pre-lan�amento de D�zimos e Ofertas
	require_once 'forms/tes/editDizOferta.php';
		}

$tabMembros = new membro();
	if ($_POST['concluir']=='1') {
			$tabLancamento = $dizmista->concluir($igrejaGet);
		} else {
			//tabela com a lista p confirmar lan�amento
			$roligreja = $igrejaGet;
			$resultado = $dizmista->dizimistas($roligreja,$apagarEntrada,$dia,
												$mes,$ano,$recGet,$creditoGet,
												$_GET['debito'],$alterarEntrada);

			$tabLancamento= $resultado['1'];

			if ($resultado['2']) {
				$statusLancamento = 'Lan&ccedil;amentos Confirmado';
			}elseif ($resultado['0']!=0) {
				$statusLancamento = '<span class="text-danger">Aguardando confima&ccedil;&atilde;o!</span>';
			}else {
				$statusLancamento = '';
			}

			$statusLancamento .= (empty($msg)) ? '':$msg;
		}
		//print_r($tabLancamento);

		$cabPrint = false;

		if (!empty($_GET['escolha'])) {

			$linkResumo  = '&rec='.$recGet.'&igreja='.$igrejaGet.'&ano='.$ano .'&mes='.$mes;
			$linkResumo .='&rol='.$rolGet.'&nome='.$nomeGet.'&dia='.$dia;
			$linkResumo .= '&credito='.$creditoGet;
			$linkResumo .= '&debito='.$debitoGet;
			echo '<div class="row"><div class="col-xs-1">';
			echo '<label>&nbsp;</label>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$linkLancamento.$linkResumo.'" >';
		  	echo '<button type="button" class="btn btn-primary btn-sm" tabindex="'.++$ind.'">';
		  	echo '<span class="glyphicon glyphicon-backward"></span> Voltar...</button>';
			echo '</a></div></div>';
			echo '<form target="_blank" action="controller/modeloPrint.php/" >';
			echo '<div class="row">';
			echo '<div class="col-xs-2">';
			echo '<input name="rec" type="hidden" value="'.$recGet.'" />';
			echo '<input name="igreja" type="hidden" value="'.$igrejaGet.'" />';
			echo '<input name="ano" type="hidden" value="'.$ano .'" />';
			echo '<input name="mes" type="hidden" value="'.$mes.'" />';
			echo '<input name="nome" type="hidden" value="'.$nomeGet.'" />';
			echo '<input name="dia" type="hidden" value="'.$dia.'" />';
			echo '<input name="credito" type="hidden" value="'.$creditoGet.'" />';
			echo '<input name="debito" type="hidden" value="'.$debitoGet.'" />';
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

			$cabPrint = true;

		}

			$dirigenteIgreja = $igSede->pastor();
			$nomIgreja = '<br />Igreja: <strong>'.$igSede->razao();
			$tesSede = $tabMembros->nomes();
			$tesIgreja = ', 1&ordm; Tesoureiro Geral: <ins>'.$tesSede ['4037']['0'];

			if ($idIgreja>'1') {
				$dirCong = new DBRecord('membro',$igrejaSelecionada->pastor(),'rol');
				$nomIgreja = '<br />Igreja: <strong>'.$igrejaSelecionada->razao();
				$dirigenteIgreja = 'Dirigente: <ins>'.$dirCong->nome().'</ins>';
				$cargoIgreja = new tes_cargo;
				//print_r($cargoIgreja->dadosArray());

				$tesArray = $cargoIgreja->dadosArray();
				$tesIgreja = ', 1&ordm; Tesoureiro da Congre&ccedil;&atilde;o: <ins>'.$tesArray['8'][$idIgreja]['1']['nome'];
				//reset($tesIgreja);
				//print_r($tesArray );
			}elseif ($idIgreja=='0' || $idIgreja=='') {
				$nomIgreja = '<br /><strong>Todas as Igrejas de Bayeux';
			}

			if (!$cabPrint) {
				echo '<h5 class="text-left">'.$statusLancamento.$nomIgreja.' &bull; </strong>'
					.$dirigenteIgreja.$tesIgreja.'</ins></h5>';
			} else {
				echo '<br /><div class="alert alert-info">';
				echo '<h4>'.$statusLancamento.' &bull; Igreja: '.$igrejaSelecionada->razao().'<br />'
					.$dirigenteIgreja.', 1&ordm; Tesoureiro: '.$tesIgreja.'</h4>';

				$sldPendente = (empty($_GET['rolIgreja'])) ? '' : $dizmista->outrosdizimos($igrejaGet);

				if ($sldPendente>0) {
					printf("<h4> Lan&ccedil;amentos de outros respons&aacute;veis:
						R$: %'.45s </h4>",number_format($sldPendente,2,',','.'));
				}
				echo '</div>';
			}

			?>
		<table class='table table-striped table-hover'>
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
	<table class='table table-condensed table-striped table-hover'>
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
