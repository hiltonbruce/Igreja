<?php
	date_default_timezone_set('America/Recife');
	error_reporting(E_ALL);
	ini_set('display_errors', 'off');
	//imprimir entradas de todas as congrega��es - mensal
	require "../func_class/funcoes.php";
	require "../func_class/classes.php";
	function __autoload ($classe) {

		list($dir,$nomeClasse) = explode('_', $classe);
		if (file_exists("../models/$dir/$classe.class.php")){
			require_once ("../models/$dir/$classe.class.php");
		}elseif (file_exists("../models/$classe.class.php")){
			require_once ("../models/$classe.class.php");
		}
	}
	$igSede = new DBRecord('igreja', '1', 'rol');
	$igreja=$igSede;
?>
