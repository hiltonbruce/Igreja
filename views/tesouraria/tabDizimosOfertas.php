<?php
$dia = $_GET['dia'];
$mes = $_GET['mes'];
$ano = $_GET['ano'];
$apagarEntrada	= '?escolha=models/tes/excluir.php&tabela=dizimooferta&id='.$idDizOf;
if ($_GET['idDizOf']>'0' && $_GET['rec']=='9') {
?>
<table>
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
		
		
	if ($_POST['concluir']=='1') {
			$tabLancamento = $dizmista->concluir($idIgreja);
		} else {
			//tabela com a lista p confirmar lanï¿½amento
			$roligreja = (empty($_GET['igreja'])) ? '':$_GET['igreja'];
			$resultado = $dizmista->dizimistas($roligreja,$apagarEntrada,$dia,$mes,$ano,$_GET['rec']);
			$tabLancamento= $resultado['1'];
			
			if ($resultado['2']) {
				$statusLancamento = 'Lan&ccedil;amentos Confirmado';
			}elseif ($resultado['0']!=0) {
				$statusLancamento = 'Aguardando confima&ccedil;&atilde;o!';
			}else {
				$statusLancamento = '';
			}
		}
?>
<table style="width: 95%;">
		<caption class="text-left">
			<?php
			$dirigenteIgreja = ' - '.$igrejaSelecionada->pastor();
			
			if ($idIgreja>'1') {
				$dirCong = new DBRecord('membro',$igrejaSelecionada->pastor(),'rol');
				$dirigenteIgreja = ' - Dirigente: '.$dirCong->nome();
			}
			
				echo $statusLancamento.'<h2>Igreja: '.$igrejaSelecionada->razao().$dirigenteIgreja.',
			 1&ordm; Tesoureiro: N&atilde;o informado!</h2>';			
			
			$sldPendente = $dizmista->outrosdizimos($_GET['rolIgreja']);
			
			if ($sldPendente>0) {
				printf("<h2>Lan&ccedil;amentos de outros respons&aacute;veis: R$: %'.45s 
			 </h2>",number_format($sldPendente,2,',','.'));
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
				$linkResumo  = 'rec='.$_GET['rec'].'&igreja='.$_GET['igreja'].'&ano='.$_GET['ano'].'&mes='.$_GET['mes'];
				$linkResumo .='&rol='.$_GET['rol'].'&nome='.$_GET['nome'].'&dia='.$_GET['dia'];
			?>
</table>
<?php 
	if (!empty($_GET['escolha'])) {
		echo '<a href="controller/modeloPrint.php/?tipo=1&'.$linkResumo.' " target="_blank" >';
		echo '<button class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-print">';
		echo '</span> Imprimir ...</button> </a>';
	}
?>
