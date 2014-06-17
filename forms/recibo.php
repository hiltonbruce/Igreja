<?php
session_start();
$ind=1; 
if ($_SESSION["setor"]==2 || $_SESSION["setor"]>50){
	
$recMenu = (empty($_POST["rec"])) ? $_GET["rec"]:$_POST["rec"];

switch ($recMenu){
	case 2:
		//Recibos Pessoa Jurídica
		require_once 'forms/tes/recInicio.php';
		require_once 'forms/tes/recPesJuridica.php';
		require_once 'forms/tes/recFinal.php';
		break;
	case 3:
		//Recibos para não Membros
		require_once 'forms/tes/recInicio.php';
		require_once 'forms/tes/recNaoMembro.php';
		require_once 'forms/tes/recFinal.php';
		break;
	case 5:  
		//Form para impressão de vários Recibos
		require_once 'forms/tes/recImprVarios.php';
		break;
	case 6:  
		//Impressão de vários Reciboserror_reporting(E_ALL);
		error_reporting(E_ALL);
		ini_set('display_errors', 'off');
		
		$scriptCSS  = '<link rel="stylesheet" type="text/css" href="../views/limpeza.css" />';
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
		$saltoPagina = '<div style="page-break-before: always;"> </div>';
		
		$igreja = new DBRecord ("igreja","1","rol");
		
		if ($igreja->cidade()>0) {
			$cidOrigem = new DBRecord ("cidade",$igreja->cidade(),"id");
			$origem=$cidOrigem->nome();
		}else {
			$origem = $igreja->cidade();
		}
		require_once '../help/tes/reciboImpr.php';
		break;
	default:
		//Recibos de Membros
		require_once 'forms/tes/recInicio.php';
		require_once 'forms/tes/recMembro.php';
		require_once 'forms/tes/recFinal.php';
		break;
}
 
} else {
	echo "<script> alert('Sem permissão de acesso! Entre em contato com o Tesoureiro!');location.href='../?escolha=adm/cadastro_membro.php&uf=PB';</script>";
	$_SESSION = array();
	session_destroy();
	header("Location: ./");
}
?>
