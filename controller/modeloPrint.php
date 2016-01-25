<?php
error_reporting(E_ALL);
ini_set('display_errors', 'off');

$cont_lin=0;
session_start();
require_once ("../func_class/funcoes.php");
controle('tes');
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

$dizmista = new dizresp($_SESSION['valid_user'],true/*impressao*/);
$idIgreja = (empty($_GET['igreja'])) ? 1:$_GET['igreja'];
if ((int)$_POST['rolIgreja']>0) {
	$idIgreja=$_POST['rolIgreja'];
}
$igrejaSelecionada = new DBRecord('igreja', $idIgreja, 'rol');
$igreja = new DBRecord('igreja', '1', 'rol');

$tipo = $_GET['tipo'];
switch ($tipo) {
	case '1':
	$tituloColuna5 = ($idIgreja>'1') ? 'Congrega&ccedil;o':'Igreja';
	$nomeArquivo = '../views/tesouraria/tabDizimosOfertas.php';
	require_once '../views/modeloPrint.php';
	break;

	default:
		;
	break;
}
