<?php
$ind=1;
if ($_GET['rec']>'19' || $_POST['rec']>'19') {
	session_start();
}else {
	require_once 'help/tes/cabRecPgto.php';//Link's dos recibo 
}

if ($_SESSION["setor"]=="2" || $_SESSION["setor"]>"50"){

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
	case 4:
		//Recibos para de pgto
		$pgtoDias = new tes_cargo();
		$listaPgto = $pgtoDias->dadosCargo();
		$recLink='#';
		$titTabela = 'Listagem para Pagamento';
		require_once 'help/tes/reciboPgto.php';
		require_once 'views/tesouraria/recPgto.php';
		//print_r($listaPgto);
		break;
	case 5:
		//Form para impressão de vários Recibos
		require_once 'forms/tes/recImprVarios.php';
		break;
	case 20:
		//Impressão de vários Reciboserror_reporting(E_ALL);
		error_reporting(E_ALL);
		ini_set('display_errors', 'off');

		$scriptCSS  = '<link rel="stylesheet" type="text/css" href="../tesouraria/style.css" />';
		
		require "../help/impressao.php";//Include de funcões, classes e conexões com o BD
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
/*
$valor = 5000.00;
$dim = extenso($valor);
$dim = ereg_replace(" E "," e ",ucwords($dim));

$valor = number_format($valor, 2, ",", ".");

echo "R$ $valor ( $dim )";
*/

} else {
	echo "<script> alert('Sem permissão de acesso! Entre em contato com o Tesoureiro!');";
	echo "location.href='../?escolha=adm/cadastro_membro.php&uf=PB';</script>";
	$_SESSION = array();
	session_destroy();
	header("Location: ./assembleia");
	exit;
}
?>
