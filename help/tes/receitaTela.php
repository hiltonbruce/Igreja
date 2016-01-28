<?php
//Opções de exibir na tela para o script /tesouraria/receita.php
$dtlanc = ($_GET['data']=='') ? date('d/m/Y'):$_GET['data'];

$rec = (empty($_GET['rec'])) ? 0 : $_GET['rec'] ;

switch ($rec) {
	case '1':
		require_once 'forms/concluirdiz.php';#Form fecha caixa
		if (!empty($_GET['id'])) {
			require_once ('forms/tes/alteraPreLanc.php');#Edita dizimo e ofertas pre-Lançamento
		}else{
			require_once ('forms/autodizimo.php');#Form lançar dizimos e ofertas
		}
		break;
	case '2':
	    $form = 'forms/tes/lancarContabil.php';
		require_once ('forms/lancar.php');
		break;
	case '3':
		require_once 'forms/concluirdiz.php';
		require_once ('forms/ofertaEBD.php');#Form lançar ofertas Esc Bíblica
		break;
	case '5':
	    $form = 'forms/tes/autoLancarDespesas.php';
		require_once ('forms/tes/lancarTipoPlan.php');#Form lançar despesas tipo planilha
		break;
	case '6'://Relatório COMADEP
		require_once 'help/tes/relatorioComadep.php';
		//$mesRelatorio .=$rolIgreja;
		$dtRelatorio = data_extenso ($d.'/'.$m.'/'.$a);
		$titTabela = $congRelatorio.' &bull; Fluxo das Contas - COMADEP - '.$dtRelatorio;
		$recLink = '16&dia='.$d.'&mes='.$m.'&ano='.$a;
		$linkImpressao ='tesouraria/receita.php/?rec='.$recLink.'&igreja='.$_GET['igreja'];
		$linkImpressao .='&tipo='.$_GET['tipo'];
		require_once 'models/tes/relatorioComadep.php';
		require_once 'forms/tes/mesComadep.php';
		require_once ('views/saldosComadep.php');
		break;
	case '7':
		$rec = 12;
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
		require_once 'forms/tes/filtroContas.php';
		$titTabela = 'Plano de Contas em: '.date('d/m/Y');
		require_once 'models/saldos.php';
		$recLink = '15&tipo=1';
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
		if (!empty($_GET['mes']) && empty($_GET['igreja'])) {
			//Lista financeira de todas as igreja com mês específico
			$colUm = 'Igrejas';//Primeira coluna do cabecalho
			require_once 'views/tesouraria/cabTabFin.php';//Cabeçalho da tabela
			require_once 'views/tesouraria/saldoMesFin.php';
			$tabThead = $nivelSem;
			//require_once 'views/tesouraria/saldoIgrejas.php';
		} else {
			//Lista financeira da igreja com todos os  meses
			$colUm = 'Per&iacute;odo';//Primeira coluna do cabecalho
			require_once 'views/tesouraria/cabTabFin.php';//Cabeçalho da tabela
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
		require_once 'forms/concluirdiz.php';
		require_once ('forms/tes/oracao.php');
		break;
	default:
		require_once ('forms/tes/busca.php');
                //require_once 'forms/tes/histResumo.php';
                //require_once 'forms/receita.php';
		break;
}
?>
