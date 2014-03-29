<?php
$mes = $_GET['mes'];
$ano = $_GET['ano'];
$apagarEntrada	= '?escolha=models/tes/excluir.php&tabela=dizimooferta&id='.$idDizOf;
if ($mes>0 && $mes<12 && $ano>2000 && $ano<2050) {
	$statusLancamento = 'Lançamento Confirmado';
}else {
	$statusLancamento = 'Lançamento Pendente';
}
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
?>
<table  style="width: 95%;">
		<caption>
			<?php
			$dirigenteIgreja = $igrejaSelecionada->pastor();
			
			if ($idIgreja>'1') {
				$dirCong = new DBRecord('membro',$igrejaSelecionada->pastor(),'rol');
				$dirigenteIgreja = $dirCong->nome();
			}
				echo $statusLancamento.'<h2>Igreja: '.$igrejaSelecionada->razao().' - Dirigente: '.$dirigenteIgreja.',
			 1&ordm; Tesoureiro: Não informado! </h2>';			
			
			printf("<h2>Lan&ccedil;amentos de outros respons&aacute;veis: R$: %'.45s 
			 </h2>",number_format($dizmista->outrosdizimos($_GET['rolIgreja']),2,',','.'));?>
			<?php printf(' Resp. pelo lan&ccedil;amento: %s',$_SESSION {'nome'});?></caption>
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
				<th scope="col">Valor &agrave; lan&ccedil;ar (R$)</th>
				<th scope="col"><?php echo $tituloColuna5;?></th>
			</tr>
		</thead>
			<?php 
				if ($_POST['concluir']=='1') {
					$dizmista->concluir($idIgreja);
					//echo '<h1>Teste1</h1>';
				} else {
					$roligreja = (empty($_GET['igreja'])) ? '':$_GET['igreja'];
					$dizmista->dizimistas($roligreja,$apagarEntrada,$mes,$ano,$_GET['rec']);
					//echo '<h1>Teste2</h1>';
				}
				$linkResumo = '&igreja='.$_GET['igreja'].'&ano='.$_GET['ano'].'&mes='.$_GET['mes'];
			?>
</table>
<a href="controller/modeloPrint.php/?rec=9&tipo=1<?php echo $linkResumo;?>"><button>Imprimir ...</button> </a>
