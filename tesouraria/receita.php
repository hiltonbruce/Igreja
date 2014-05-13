<?php
$ind=1; 
if ($_SESSION["setor"]=="2" || $_SESSION["setor"]>"50"){
$_SESSION['lancar']=true;
$linkLancamento  = './?escolha=tesouraria/receita.php&menu=top_tesouraria';
$linkLancamento .= '&igreja='.$_GET['igreja'];
?> 
<div id="tabs">
	<ul>
	  <li><a <?PHP link_ativo($_GET["rec"], "0"); ?> href="<?php echo $linkLancamento;?>&rec=0"><span>Busca</span></a></li>
	  <li><a <?PHP link_ativo($_GET["rec"], "1"); ?> href="<?php echo $linkLancamento;?>&rec=1"><span>Entradas</span></a></li>
	  <li><a <?PHP link_ativo($_GET["rec"], "3"); ?> href="<?php echo $linkLancamento;?>&rec=3"><span>Esc. Bíblica</span></a></li>
	  <li><a <?PHP link_ativo($_GET["rec"], "2"); ?> href="<?php echo $linkLancamento;?>&rec=2"><span>Diversos</span></a></li>
	  <li><a <?PHP link_ativo($_GET["rec"], "9"); ?> href="<?php echo $linkLancamento;?>&rec=9"><span>Resumo</span></a></li>
	  <li><a <?PHP link_ativo($_GET["rec"], "7"); ?> href="<?php echo $linkLancamento;?>&rec=7"><span>Saldos</span></a></li>
	  <li><a <?PHP link_ativo($_GET["rec"], "8"); ?> href="<?php echo $linkLancamento;?>&rec=8&tipo=1" title="Plano de Contas" ><span>Plano de Contas</span></a></li>
	</ul>
</div>&nbsp;
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
			
			$linkAcesso 	= 'escolha=tesouraria/receita.php&menu=top_tesouraria&rec='.$_GET['rec'].'&idDizOf='.$idDizOf.'&igreja=';
			
			if ($_GET['rec']=='1') {
				//Form fechar caixa
				require_once 'forms/concluirdiz.php';
			}
			
			$fin = ($_GET['fin']<'1') ? '2':$_GET['fin'];
			
			switch ($_GET['rec']) {
				case '0':
					$rec = (empty($_GET['rec'])) ? 0:$_GET['rec'];
					require_once ('forms/tes/busca.php');
					//require_once 'forms/tes/histResumo.php';
					break;
				case '1':
					require_once ('forms/autodizimo.php');
					break;
				case '2':
					require_once ('forms/lancar.php');
					break;
				case '3':
					require_once ('forms/ofertaEBD.php');
					break;
				case '7':
					require_once 'forms/tes/histFinanceiro.php';
					require_once 'models/saldos.php';
					require_once ('views/saldos.php');
					break;
				case '8':
					require_once 'forms/tes/histFinanceiro.php';
					require_once 'models/saldos.php';
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
					require_once 'views/tesouraria/saldoIgrejas.php';
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
		require_once 'views/tesouraria/tabDizimosOfertas.php';
	
?>
