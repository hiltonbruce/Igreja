<?php
$ind=1;
if ($_GET['rec']>'19' || $_POST['rec']>'19') {
	session_start();

	if ($_SESSION["setor"]=="2" || $_SESSION["setor"]>"50"){
		require "../help/impressao.php";//Include de func�es, classes e conex�es com o BD
		$igreja = new DBRecord ("igreja","1","rol");

		if ($_GET['igreja']>'1') {
			$igrejaRelatorio = new DBRecord ("igreja",$_GET['igreja'],"rol");
			$congRelatorio = $igrejaRelatorio->razao();
		}elseif ($_GET['igreja']==$igreja->rol()){
			$congRelatorio = $igreja->razao();
		}else {
			$congRelatorio = '';
		}

		$recMenu = (empty($_GET["rec"])) ? $_POST["rec"]:$_GET["rec"];
		switch ($recMenu) {
			case '20':
				//Recibos para pgto
				$pgtoDias = new tes_cargo();
				$listaPgto = $pgtoDias->dadosCargo();
				$recLink='';
				$titTabela = 'Listagem para Pagamento';
				require_once '../help/tes/reciboPgto.php';

				$nomeArquivo='../views/tesouraria/recPgto.php';
				require_once '../views/modeloPrint.php';

			break;

			case '21':
				//Impress�o de v�rios Reciboserror_reporting(E_ALL);
				error_reporting(E_ALL);
				ini_set('display_errors', 'off');

				$scriptCSS  = '<link rel="stylesheet" type="text/css" href="../css/bootstrap.print.css" />';
				$scriptCSS  .= '<link rel="stylesheet" type="text/css" href="../tesouraria/style.css" />';

				$saltoPagina = '<div style="page-break-before: always;"> </div>';
				if ($igreja->cidade()>0) {
					$cidOrigem = new DBRecord ("cidade",$igreja->cidade(),"id");
					$origem=$cidOrigem->nome();
				}else {
					$origem = $igreja->cidade();
				}
				require_once '../help/tes/reciboImpr.php';
				break;
			default:
				;
			break;
		}


	}

}else {
	require_once 'help/tes/cabRecPgto.php';//Link's dos recibo
}

if ($_SESSION["setor"]=="2" || $_SESSION["setor"]>"50"){

$recMenu = (empty($_POST["rec"])) ? intval($_GET["rec"]):intval($_POST["rec"]);

switch ($recMenu){
	case 2:
		//Recibos Pessoa Jur�dica
		require_once 'forms/tes/recInicio.php';
		require_once 'forms/tes/recPesJuridica.php';
		require_once 'forms/tes/recFinal.php';
		break;
	case 3:
		//Recibos para n�o Membros
		require_once 'forms/tes/recInicio.php';
		require_once 'forms/tes/recNaoMembro.php';
		require_once 'forms/tes/recFinal.php';
		break;
	case 4:
		//Recibos para de pgto
		$pgtoDias = new tes_cargo();
		$listaPgto = $pgtoDias->dadosCargo();
		//print_r($listaPgto);
		$recLink='escolha=controller/despesa.php&menu=top_tesouraria&id=';
		$titTabela = 'Listagem para Pagamento';
		require_once 'help/tes/reciboPgto.php';
		require_once 'forms/tes/gerarRecFolha.php';
		require_once 'views/tesouraria/recPgto.php';
		//print_r($listaPgto);
		break;
	case 5:
		//Form para impress�o de v�rios Recibos
		require_once 'forms/tes/recImprVarios.php';
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
	echo "<script> alert('Sem permiss�o de acesso! Entre em contato com o Tesoureiro!');";
	echo "location.href='../?escolha=adm/cadastro_membro.php&uf=PB';</script>";
	$_SESSION = array();
	session_destroy();
	header("Location: ./assembleia");
	exit;
}
?>
