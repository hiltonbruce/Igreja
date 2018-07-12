<?php
error_reporting(E_ALL);
ini_set('display_errors', 'off');

$cont_lin=0;
session_start();
if (empty($_SESSION['valid_user'])) {
	exit;
}
require_once ("../func_class/funcoes.php");
require_once ("../func_class/classes.php");
date_default_timezone_set('America/Recife');
function __autoload ($classe) {

	list($dir,$nomeClasse) = explode('_', $classe);
	//$dir = strtr( $classe, '_','/' );
	if (file_exists("../models/$dir/$classe.class.php")){
		require_once ("../models/$dir/$classe.class.php");
	}elseif (file_exists("../models/$classe.class.php")){
		require_once ("../models/$classe.class.php");
	}
}
$idIgreja = (empty($_GET['igreja'])) ? '':$_GET['igreja'];
if (intval($_POST['rolIgreja']>0)) {
	$idIgreja=$_POST['rolIgreja'];
}
$igrejaSelecionada = new DBRecord('igreja', $idIgreja, 'rol');
$igSede = new DBRecord('igreja', '1', 'rol');
$tipo = intval($_GET['tipo']);
switch ($tipo) {
	case '1':
	controle('tes');
	$dizmista = new dizresp($_SESSION['valid_user'],true/*impressao*/);
	$tituloColuna5 = ($idIgreja>'1') ? 'Congrega&ccedil;o':'Igreja';
	$titTabela = 'Hist&oacute;rico Lan&ccedil;amentos - '.NOMESYS;
	$nomeArquivo = '../views/tesouraria/tabDizimosOfertas.php';
	break;
	case '2':
	//Imprime agenda
	$tituloColuna5 = ($idIgreja>'1') ? 'Congrega&ccedil;o':'Igreja';
	$titTabela = 'Agenda de Eventos - '.NOMESYS;
	require_once '../agendaSec/lang/lang.admin.pt.php';
	require_once '../agendaSec/lang/lang.pt.php';
	$nomeArquivo = '../views/secretaria/agendaPrint.php';
	break;
	case '3':
		# Novos convertidos
		$titTabela = 'Lista de Dirigentes';
		$nomeArquivo = '../views/secretaria/dirigentes.php';
	break;
case '4':
	//Lista recibos por periodo

	require_once '../help/tes/getRec.php';
	$recBuscas = new menutes();//Lista buscas de recibos
	$mesSel = arrayMeses();
	$mesPerido = $mesSel[$mesPer];
		if ($diaPer=='' && $mesPerido=='' && $anoPer<'2000') {
			$perLista = 'Todos os Recibos';
		} elseif ($diaPer!='' && $mesPerido=='' && $anoPer<'2000') {
			$perLista = 'Recibos do dia '.$diaPer;
		} elseif ($diaPer=='' && $mesPerido=='' && $anoPer!=''){
			$perLista = 'Recibos ano de '.$anoPer;
		} elseif ($diaPer=='' && $mesPerido!='' && $anoPer<'2000') {
			$perLista = 'Recibos do m&ecirc;s de '.$mesPerido;
		}elseif ($diaPer=='' && $mesPerido!='' && $anoPer!='') {
			$perLista = 'Recibos de '.$mesPerido.' de '.$anoPer;
		} elseif ($diaPer!='' && $mesPerido=='' && $anoPer!='') {
			$perLista = 'Recibos do dia '.$diaPer.' e do ano '.$anoPer;
		} else {
			$perLista = 'Recibos da data: '.$diaPer.' de '.$mesPerido.' de '.$anoPer ;
		}
	$igNome = (empty($_GET['igreja'])) ? null : ', '.$igrejaSelecionada->razao();
	$titTable = '<h4>'.$perLista.$igNome.'<h4><h5>';
	$tagFimTable = '</h5>';
	require_once '../help/tes/listaRecPeriodoPrint.php';
	//Recibos para pgto
	$nomeArquivo='../help/tes/listRec.php';
	require_once '../views/modeloPrint.php';
break;
	default:
		;
	break;
}

require_once '../views/modeloPrint.php';
