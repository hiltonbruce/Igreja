<?php
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
?>
