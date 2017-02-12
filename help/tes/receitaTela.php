<?php
//Opï¿½ï¿½es de exibir na tela para o script /tesouraria/receita.php
//$dtlanc = (empty($dtlanc)) ? date('d/m/Y'):$_GET['data'];
$assinatura = '';
if (empty($_GET['ano'])) {
	$ano = date('Y');
	$anoForm = '';
}elseif (!empty($_GET['ano']) && $_GET['ano']>'2000' ) {
	$ano = $_GET['ano'];
	$anoForm = $ano;
}else {
	$ano = 0;
	$anoForm = '';
}
if (!empty($_GET['igreja'])) {
	$roligreja = $_GET['igreja'];
} elseif (!empty($_POST['igreja'])) {
	$roligreja = $_POST['igreja'];
}elseif (empty($roligreja))  {
	$roligreja = '';
}
switch ($rec) {
	case '1':
		require_once 'forms/concluirdiz.php';#Form fecha caixa
		if (!empty($_GET['id'])) {
			require_once ('forms/tes/alteraPreLanc.php');#Edita dizimo e ofertas pre-Lanï¿½amento
		}else{
			require_once ('forms/autodizimo.php');#Form lanï¿½ar dizimos e ofertas
		}
		break;
	case '2':
	  $form = 'forms/tes/lancarContabil.php';
		$tabRelatorio='forms/lancar.php';
		break;
	case '3':
		require_once 'forms/concluirdiz.php';
		require_once ('forms/ofertaEBD.php');#Form lançaar ofertas Esc Bíblica
		break;
	case '4':
		require_once ('forms/tes/lancarRec.php');
		break;
	case '5':
	    //$form = 'forms/tes/autoLancarDespesas.php';
			$tabRelatorio='forms/tes/lancarTipoPlan.php';#Form lançar despesas tipo planilha
		break;
	case '6'://Relatório COMADEP
		require_once 'help/tes/relatorioComadep.php';
		//$mesRelatorio .=$rolIgreja;
		$dtRelatorio = data_extenso ($d.'/'.$m.'/'.$a);
		$titTabela = $congRelatorio.' &bull; Fluxo das Contas - COMADEP - '.$dtRelatorio;
		$recLink = '16&dia='.$d.'&mes='.$m.'&ano='.$a;
		$linkImpressao ='tesouraria/receita.php/?rec='.$recLink.'&igreja='.$_GET['igreja'];
		$linkImpressao .='&tipo='.$_GET['tipo'];
		//Busca do movimento no mï¿½s
		require_once 'models/tes/relComadep.php';
		require_once 'help/tes/relComadepLin.php';
		require_once 'forms/tes/mesComadep.php';
		require_once ('views/saldosComadep.php');
		break;
	case '7':
		$rec = 12;
		require_once 'forms/tes/histFinanceiro.php';
		require_once 'models/saldos.php';
		break;
	case '8':
		require_once 'forms/tes/filtroContas.php';
		$titTabela = 'Plano de Contas em: '.date('d/m/Y');
		require_once 'models/saldos.php';
		$recLink = '19&tipo=1';
		$linkImpressao ='tesouraria/receita.php/?rec='.$recLink;
		require_once ('views/saldos.php');
		break;
	case '9':
		$idDizOf = $_GET['idDizOf'];
		//$rec = (empty($_GET['rec'])) ? 9:$_GET['rec'];
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
		$colUm = '';//Primeira coluna do cabecalho
		require_once 'views/tesouraria/cabTabFin.php';//Cabeï¿½alho da tabela
		if (!empty($_GET['mes']) && empty($_GET['igreja'])) {
			//Lista financeira de todas as igreja com mï¿½s especï¿½fico
			require_once 'views/tesouraria/saldoMesFin.php';
			$tabThead = $nivelSem;
			//require_once 'views/tesouraria/saldoIgrejas.php';
		} else {
			//Lista financeira da igreja com todos os  meses
			$colUm = 'Per&iacute;odo';//Primeira coluna do cabecalho
			require_once 'views/tesouraria/saldoMembros.php';
		}
		break;
	case '12':
		require_once 'forms/tes/histFinanceiro.php';
		require_once 'help/tes/saldoIgrejas.php';
		require_once 'views/tesouraria/saldoIgrejas.php';
		break;
	case '21':
		require_once 'help/tes/varRelatorio.php';
		require_once ('forms/tes/relatorioLanc.php');
		$tabRelatorio = 'views/tesouraria/tabRelatLanc.php';
		break;
	case '22':
		require_once ('forms/tes/busca.php');
		break;
	case '23':
		//require_once 'forms/tes/histFinanceiro.php';
		require_once 'help/tes/saldoCargos.php';
		require_once 'views/tesouraria/saldoCargos.php';
		break;
	case '24':
		$cta = (empty($_GET['cta'])) ? 7 : intval($_GET['cta']);
		if (!empty($_POST['cad']) && $roligreja>'0') {
			require_once ('views/tesouraria/oracao.php');
			require_once 'forms/concluirdiz.php';
		} else {
			if ($idIgreja<'1' && $_POST['conta']>'0') {
				echo '<script> alert("Lan&ccedil;amento cancelado! N&atilde;o foi definida a igreja!");</script>';
			}
			require_once 'forms/concluirdiz.php';
			$linkAcesso  = 'escolha='.$escolha.'&menu='.$menu.'&igreja='.$idIgreja;
			$linkAcesso .= '&rec='.$rec.'&cta=';
			require_once ('forms/tes/oracao.php');
		}
		break;
	case '25':
		require_once ('models/bkpBanco.php');
		break;
	case '26':
		require_once ('views/backup.php');
		break;
	default:
		require_once ('forms/tes/busca.php');
                //require_once 'forms/tes/histResumo.php';
                //require_once 'forms/receita.php';
		break;
}
