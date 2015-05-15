<?php
//Opções de  impressões para o script /tesouraria/receita.php
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
	case '15':

		$roligreja = ($_GET['igreja']>0) ? (int)$_GET['igreja'] : 1 ;
		$igrejaSelecionada = new DBRecord('igreja', $roligreja, 'rol');
		$titTabela = 'Relatório de Lançamentos';
		$linkImpressao ='tesouraria/receita.php/?rec=15';
		$mes = empty($_GET['mes']) ? '':$_GET['mes'] ;
		$ano = empty($_GET['ano']) ? '':$_GET['ano'];
		$tituloColuna5 = 'Valor(R$)';
		require_once '../models/saldos.php';
		$nomeArquivo='../views/tesouraria/tabRelatLanc.php';
		require_once '../views/modeloPrint.php';
		break;
	case '16':
		//Relatorio COMADEP
		require_once '../help/tes/relatorioComadep.php';
		$mesRelatorio .=$rolIgreja;
		$dtRelatorio = data_extenso ($d.'/'.$m.'/'.$a);
		$titTabela = 'Fluxo das Contas - '.$dtRelatorio.'<h3>'.$congRelatorio.'<h3>';
		require_once '../models/tes/relatorioComadep.php';
		$nomeArquivo='../views/saldosComadep.php';
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
?>
