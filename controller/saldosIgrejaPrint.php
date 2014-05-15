<?php
if ($_GET['rec']=='13') {
	session_start();
	if ($_SESSION["setor"]=="2" || $_SESSION["setor"]>"50"){


		//imprimir entradas de todas as congregações - mensal
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
		require_once '../help/tes/saldoIgrejas.php';
		$nomeArquivo='../views/tesouraria/saldoIgrejas.php';
		require_once '../views/modeloPrint.php';
	}
}
?>