<?php
	date_default_timezone_set('America/Recife');
	setlocale( LC_ALL, 'pt_BR.ISO-8859-1', 'pt_BR', 'Portuguese_Brazil');
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
	error_reporting(E_ALL);
	ini_set('display_errors', 'off');
	//imprimir entradas de todas as congrega��es - mensal

	if (file_exists("../func_class/funcoes.php")){
			require_once ("../func_class/funcoes.php");
			require "../func_class/classes.php";
		}elseif (file_exists("../../func_class/funcoes.php")){
			require_once ("../../func_class/funcoes.php");
			require "../../func_class/classes.php";
		}

	function __autoload ($classe) {
		list($dir,$nomeClasse) = explode('_', $classe);
		if (file_exists("../models/$dir/$classe.class.php")){
			require_once ("../models/$dir/$classe.class.php");
		}elseif (file_exists("../models/$classe.class.php")){
			require_once ("../models/$classe.class.php");
		}elseif (file_exists("../../models/$dir/$classe.class.php")){
			require_once ("../../models/$dir/$classe.class.php");
		}elseif (file_exists("../../models/$classe.class.php")){
			require_once ("../../models/$classe.class.php");
		}
	}
	$igSede = new DBRecord('igreja', '1', 'rol');
	$igreja=$igSede;
?>
