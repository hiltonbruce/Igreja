<?php
if ($_SESSION["setor"]!='2' && $_SESSION["setor"]!='99' ) {
	exit;//Nï¿½o exibe em setor sem autorizaï¿½ï¿½o
}
//Opï¿½ï¿½es de  impressï¿½es para o script /tesouraria/receita.php
switch ($rec) {
	case '13':
		//imprimir entradas de todas as congregaï¿½ï¿½es - mensal
		require_once '../help/tes/saldoIgrejas.php';
		$nomeArquivo='../views/tesouraria/saldoIgrejas.php';
		break;
	case '14':
		//imprimir
		if (!empty($_GET['dtBalac'])) {
			$titTabela = 'Balancete - Saldo em: '.$_GET['dtBalac'];
		}
		require_once '../models/saldos.php';
		$nomeArquivo='../views/saldos.php';
		// require_once '../views/modeloPrint.php';
		break;
	case '15':
		require_once '../help/tes/varRelatorio.php';
		$titTabela = 'Relat&oacute;rio de Lan&ccedil;amentos';
		$linkImpressao ='tesouraria/receita.php/?rec=15';
		//require_once '../models/saldos.php';
		$nomeArquivo='../views/tesouraria/tabRelatLanc.php';
		// require_once '../views/modeloPrint.php';
		break;
	case '16':
		//Relatorio COMADEP
		$idIgreja = intval($_GET['igreja']);
		require_once '../help/tes/relatorioComadep.php';//Cabeçalho e informaï¿½ï¿½es da consulta
		//$mesRelatorio .=$rolIgreja;
		$dtRelatorio = data_extenso ($d.'/'.$m.'/'.$a);
		require_once '../models/tes/relComadep.php';
		require_once '../help/tes/relComadepLin.php';
		$nomeArquivo='../views/saldosComadep.php';
		$assinatura .= '<h6><div class="row text-center">';
		$assinatura .= '<div class="col-xs-6 col-sm-5">';
		$assinatura .= $igreja->pastor();
		$assinatura .= '</div>';
		$assinatura .= '<div class="col-xs-6 col-sm-5">';
		$cargoIgreja = new tes_cargo;
		$tesArray = $cargoIgreja->dadosArray();
		$assinatura .= '1&ordm; Tesoureiro Geral: '.$tesArray['22']['1']['1']['nome'];
		$assinatura .= '</div></div></h6>';
		$titTabela = $congRelatorio.' &bull; Fluxo das Contas - '.$dtRelatorio;
		// require_once '../views/modeloPrint.php';
		break;
	case '17':
		//Relatorio COMADEP
		$idIgreja = intval($_GET['igreja']);
		require_once '../help/tes/relatorioComadep.php';//Cabeï¿½alho e informaï¿½ï¿½es da consulta
		// $tesIgreja = ', 1&ordm; Tesoureiro Geral: <ins>'.$tesArray['22']['1']['1']['nome'];
		//$mesRelatorio .=$rolIgreja;
		$dtRelatorio = data_extenso ($d.'/'.$m.'/'.$a);
		require_once '../help/tes/dizimistasPrint.php';
		$nomeArquivo='../views/tesouraria/tableDizimistas.php';
		$assinatura .= '<h6><div class="row text-center">';
		$assinatura .= '<div class="col-xs-6 col-sm-5">';
		$assinatura .= $igreja->pastor();
		$assinatura .= '</div>';
		$assinatura .= '<div class="col-xs-6 col-sm-5">';
		$cargoIgreja = new tes_cargo;
		$tesArray = $cargoIgreja->dadosArray();
		$assinatura .= '1&ordm; Tesoureiro Geral: '.$tesArray['22']['1']['1']['nome'];
		$assinatura .= '</div></div></h6>';
		$titTabela = $congRelatorio.' &bull; Dizimistas - '.$dtRelatorio;
		// require_once '../views/modeloPrint.php';
		break;
	case '18':
		#Imprimir tabela de saldos
		$dContas = new tes_contas();
		$descCta = $dContas->ativosArray();
		$colUm = '';//Primeira coluna do cabecalho
		// require_once '../views/modeloPrint.php';
		if (!empty($_GET['mes']) && empty($_GET['igreja'])) {
			require_once '../views/tesouraria/cabTabFinPrint.php';//Cabeï¿½alho da tabela
			//Lista financeira de todas as igreja com mï¿½s especï¿½fico
			$nomeArquivo = '../views/tesouraria/saldoMesFinPrint.php';
			$tabThead = $nivelSem;
			//require_once 'views/tesouraria/saldoIgrejas.php';
		} else {
			//Lista financeira da igreja com todos os  meses
		require_once '../views/tesouraria/cabTabFin.php';//Cabeï¿½alho da tabela
			$colUm = 'Per&iacute;odo';//Primeira coluna do cabecalho
			// echo "<h1>$colUm</h1>";
			$nomeArquivo =  '../views/tesouraria/saldoMembrosPrint.php';
		}
		break;
	default:
		//imprimir plano de contas
		$titTabela = 'Plano de Contas em: '.date('d/m/Y');
		require_once '../models/saldos.php';
		$nomeArquivo='../views/saldos.php';
		break;
}
require_once '../views/modeloPrint.php';
?>
