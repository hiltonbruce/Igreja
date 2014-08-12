<?php
$titTabela = 'Balancete - Saldo em: '.date('d/m/Y');
if ($_GET['rec']>'12' && $_GET['rec']<'20') {
	session_start();
	if ($_SESSION["setor"]=="2" || $_SESSION["setor"]>"50"){
	require "../help/impressao.php";//Include de funcões, classes e conexões com o BD
	
	$igreja = new DBRecord ("igreja","1","rol");
	
	if ($igreja->cidade()>0) {
		$cidSede = new DBRecord('cidade', $igreja->cidade(), 'id');
		$origem = $cidSede->nome();
	}else {
		$origem = $igreja->cidade();
	}
	
	switch ($_GET['rec']) {
		case '13':
			//imprimir entradas de todas as congregações - mensal
			require_once '../help/tes/saldoIgrejas.php';
			$nomeArquivo='../views/tesouraria/saldoIgrejas.php';
			require_once '../views/modeloPrint.php';
			break;
		case '14':
			//imprimir
			if (!empty($_GET['dtBalac'])) {
				$titTabela = 'Balancete - Saldo em: '.$_GET['dtBalac'];
			}
			
			require_once '../models/saldos.php';
			$nomeArquivo='../views/saldos.php';
			require_once '../views/modeloPrint.php';
			break;
		
		default:
			//imprimir plano de contas
			$titTabela = 'Plano de Contas em: '.date('d/m/Y');
			require_once '../models/saldos.php';
			$nomeArquivo='../views/saldos.php';
			require_once '../views/modeloPrint.php';
			break;
	}
		
	}
}else {
$ind=1;
$tabRelatorio = 'views/tesouraria/tabDizimosOfertas.php';
if ($_SESSION["setor"]=="2" || $_SESSION["setor"]>"50"){
$_SESSION['lancar']=true;
$linkLancamento  = './?escolha=tesouraria/receita.php&menu=top_tesouraria';
$linkLancamento .= '&igreja='.$_GET['igreja'];
?> 
	<p>
	  <a <?PHP $b=link_ativo($_GET["rec"], "0"); ?> href="<?php echo $linkLancamento;?>&rec=0">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Busca</button></a>
	  
	  <a <?PHP $b=link_ativo($_GET["rec"], "1"); ?> href="<?php echo $linkLancamento;?>&rec=1">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Entradas</button></a>
	  
	  <a <?PHP $b=link_ativo($_GET["rec"], "3"); ?> href="<?php echo $linkLancamento;?>&rec=3">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Esc. Bíblica</button></a>
	  
	  <a <?PHP $b=link_ativo($_GET["rec"], "2"); ?> href="<?php echo $linkLancamento;?>&rec=2">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Lan&ccedil;amentos</button></a>
	  
	  <a <?PHP $b=link_ativo($_GET["rec"], "21"); ?> href="<?php echo $linkLancamento;?>&rec=21" title="Relatório de Lançamentos" >
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Lançamentos Relatório</button></a>
	  
	  <a <?PHP $b=link_ativo($_GET["rec"], "4"); ?> href="<?php echo $linkLancamento;?>&rec=4">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Lan&ccedil;ar Recibo</button></a>
	  
	  <a <?PHP $b=link_ativo($_GET["rec"], "5"); ?> href="<?php echo $linkLancamento;?>&rec=5">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Lan&ccedil;ar Despesa</button></a>
	  
	  <a <?PHP $b=link_ativo($_GET["rec"], "9"); ?> href="<?php echo $linkLancamento;?>&rec=9">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Resumo</button></a>
	  
	  <a <?PHP $b=link_ativo($_GET["rec"], "7"); ?> href="<?php echo $linkLancamento;?>&rec=7">
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Saldos</button></a>
	  
	  <a <?PHP $b=link_ativo($_GET["rec"], "8"); ?> href="<?php echo $linkLancamento;?>&rec=8&tipo=1" title="Plano de Contas" >
	  <button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Plano de Contas</button></a>
	  
	</p>

<?php
$dizmista = new dizresp($_SESSION['valid_user']);
$idIgreja = (empty($_GET['igreja'])) ? 1:$_GET['igreja'];
if ((int)$_POST['rolIgreja']>0) {
	$idIgreja=$_POST['rolIgreja'];
}
$igrejaSelecionada = new DBRecord('igreja', $idIgreja, 'rol');

	// verifica se há valor a ser lançado e libera os forms
	//printf('<h1> teste %s</h1>',$teste);
	$tituloColuna5 = ($idIgreja>'1') ? 'Congregação':'Igreja';
	if ($_POST['concluir']=='1') {
			$tituloColuna5 = 'Status';
			require_once 'forms/lancdizimo.php';
		} elseif ($_POST['lancar']=='1') {
			require_once 'models/feccaixaculto.php';
		} else {
			
			$linkAcesso  = 'escolha=tesouraria/receita.php&menu=top_tesouraria';
			$linkAcesso .= '&rec='.$_GET['rec'].'&idDizOf='.$idDizOf.'&igreja=';
			
			$fin = ($_GET['fin']<'1') ? '2':$_GET['fin'];
					$rec = (empty($_GET['rec'])) ? 0:$_GET['rec'];
			
			switch ($_GET['rec']) {
				case '0':
					require_once ('forms/tes/busca.php');
					//require_once 'forms/tes/histResumo.php';
					break;
				case '1':
					require_once 'forms/concluirdiz.php';
					require_once ('forms/autodizimo.php');
					break;
				case '2':
				    $form = 'forms/tes/autoCompletaContas.php';
					require_once ('forms/lancar.php');
					break;
				case '3':
					require_once ('forms/ofertaEBD.php');
					require_once 'forms/concluirdiz.php';
					break;
				case '5':
				    $form = 'forms/tes/autoLancarDespesas.php';
					require_once ('forms/lancar.php');
					break;
				case '7':
					require_once 'forms/tes/histFinanceiro.php';
					require_once 'models/saldos.php';
					$mes = date('m'); // Mês desejado, pode ser por ser obtido por POST, GET, etc.
					$ano = date('Y'); // Ano atual
					$ultimo_dia = date("t", mktime(0,0,0,$mes,'01',$ano)); 
					$recLink = '14&dtBalac='.$ultimo_dia.'/'.$mes.'/'.$ano;
					$linkImpressao ='tesouraria/receita.php/?rec='.$recLink;
					require_once ('views/saldos.php');
					break;
				case '8':
					require_once 'forms/tes/histFinanceiro.php';
					$titTabela = 'Plano de Contas em: '.date('d/m/Y');
					require_once 'models/saldos.php';
					$recLink = '15&tipo=1';
					$linkImpressao ='tesouraria/receita.php/?rec='.$recLink;
					require_once ('views/saldos.php');
					break;
				case '9':
					$idDizOf = $_GET['idDizOf'];
					$rec = (empty($_GET['rec'])) ? 9:$_GET['rec'];
					require_once 'forms/tes/histResumo.php';
					break;
				case '10':
					$id = (int)$_GET["idDizOf"];
					$tabela = 'dizimooferta';
					$campo 	= 'id';
					require_once 'models/tes/excluir.php';
					break;
				case '11':
					require_once 'forms/tes/histFinanceiro.php';
					require_once 'views/tesouraria/saldoMembros.php';
					break;
				case '12':
					require_once 'forms/tes/histFinanceiro.php';
					require_once 'help/tes/saldoIgrejas.php';
					require_once 'views/tesouraria/saldoIgrejas.php';
					break;
				case '21':
					
					require_once ('forms/tes/relatorioLanc.php');
					
					$mes = empty($_GET['mes']) ? '':$_GET['mes'] ;
					$ano = empty($_GET['ano']) ? '':$_GET['ano'];
					$roligreja = (empty($_GET['igreja'])) ? '1':$_GET['igreja'];
					
					$tituloColuna5 = 'Valor(R$)';
					$tabRelatorio = 'views/tesouraria/tabRelatLanc.php';
					break;
				default:
					require_once 'forms/receita.php';
				break;
			}
	}


} else {
	echo "<script> alert('Sem permissão de acesso! Entre em contato com o Tesoureiro!');location.href='../?escolha=adm/cadastro_membro.php&uf=PB';</script>";
	$_SESSION = array();
	session_destroy();
	header("Location: ./");
}
	unset($_SESSION['lancar']);
	
	require_once $tabRelatorio;
}
?>
