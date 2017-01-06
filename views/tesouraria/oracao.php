<?PHP
/**
 * Joseilton Costa Bruce
 *
 * LICENÇA
 *
 * Please send an email
 * to hiltonbruce@gmail.com so we can send you a copy immediately.
 *
 * @category   Pessoal
 * @package
 * @subpackage
 * @copyright  Copyright (c) 2008-2009 Joseilton Costa Bruce (http://)
 * @license    http://
 * Insere dados no banco do forms/autodizimo.php na tabela:usuario
 */
controle ("tes");
$idIgreja = $roligreja;
$igrejaSelecionada = new DBRecord('igreja', $idIgreja, 'rol');
$vlr = false;
//$igreja = ($_POST['igreja']>'0') ?  $_POST['igreja']: false ;
$exibLancCab  = '<table class="table table-striped"><thead><tr><th colspan="3">';
$exibLancCab .= 'Data do Registro: </th><th colspan="1">'.date('d/m/Y');
$exibLancCab .= '</th></tr>';
$exibLancCab .= '<tr><th>Data do Lan&ccedil;amento:</th><th>Oferta</th><th>';
$exibLancCab .= 'Voto</th><th>Semana</th></tr></thead><tbody>';
$ctaIdCaixa = $_POST['conta'];
$ofeLanc = intval($_POST['ctaReceita']);
$votoLan = intval($_POST['ctaVoto']);
$ctaCaixa = intval($_POST['conta']);
/*
switch ($ctaIdCaixa) {
	case '6':
	#Miss�es
		$ctaCaixa = 2;
		break;
	case '7':
	#Orações adulto
		$ctaCaixa = 3;
		break;
	case '8':
	#Ensino
		$ctaCaixa = 4;
		break;
	case '9':
	#Infantil
		$ctaCaixa = 5;
		break;
	case '482':
	#Mocidade
		$ctaCaixa = 8;
		break;
	case '504':
	#setor I
		$ctaCaixa = 9;
		break;
	case '505':
	#setor II
		$ctaCaixa = 10;
		break;
	case '506':
	#setor III
		$ctaCaixa = 11;
		break;
	case '507':
	#setor IV
		$ctaCaixa = 12;
		break;
		default:
	#Caixa Central
		$ctaCaixa = 1;
		break;
}*/
for ($i=1; $i < 6; $i++) {
	$ofOr = 'of'.$i;//Variável para o post of?
	$votOr = 'voto'.$i;//Variável para o post voto?
	$dataOr = 'data'.$i;//Variável para o post data?
	$semOr = 'entra'.$i;//Variável para o post entra? (ref a semana)
	//verificando se há valor e data que possibilite o lançamento
	$ofertaOr = ($_POST[$ofOr]>'0') ?  $_POST[$ofOr]: false ;
	$votoOr = ($_POST[$votOr]>'0') ?  $_POST[$votOr]: false ;
	$datalanc = condatabrus ($_POST[$dataOr]);
	list($ano,$mes,$dia) = explode('-', $datalanc);
	//echo '<H1>Data do lançamento: '.$_POST[$dataOr].' *** </h1>';
	if (($ofertaOr || $votoOr) && $datalanc) {
		//Verifica se há valor em oferta ou voto e se data foi enviada
		$sem = $_POST["$semOr"];
		$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];
		$ofertaOr = formataNumBanco ($ofertaOr);
		if ($ofertaOr>0) {
			$conta = "'$ofeLanc','$ctaCaixa','7'";//Oração Adulto
			$value  = "'','',$conta,'".$roligreja."','','','$ofertaOr',";
			$value .= "'$datalanc','$sem','$mes','$ano','$roligreja','{$_SESSION['valid_user']}',";
			$value .= "'".$_SESSION['setor']."','{$_POST["obs"]}',NOW(),'$hist'";
			$dados = new insert ($value,"dizimooferta");
			$dados->inserir();
		}
		$votoOr = formataNumBanco ($votoOr) ;
		if ($votoOr>0) {
			$conta = "'$votoLan','$ctaCaixa','7'";//Voto em Circ. de Oração
			$value  = "'','',$conta,'".$roligreja."','','','$votoOr',";
			$value .= "'$datalanc','$sem','$mes','$ano','$roligreja','{$_SESSION['valid_user']}',";
			$value .= "'".$_SESSION['setor']."','{$_POST["obs"]}',NOW(),'$hist'";
			$dados = new insert ($value,"dizimooferta");
			$dados->inserir();
		}
		//echo "<script>location.href='./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec={$_POST["tipo"]}&igreja={$_POST["igreja"]}'; </script>";
		//echo "<a href='./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec={$_POST["tipo"]}&igreja={$_POST["igreja"]}'>Continuar0...<a>";
	}
		//echo  ' Oferta - '.$ofertaOr.' - Voto '.$votoOr.' -Data '.$datalanc.' -Semana '.$sem;
		//echo  '<br /> Var_OFerta - '.$ofOr.' - Var_Voto '.$votOr.' -Var_Data '.$dataOr.' -Var_Semana '.$semOr;
		if ($datalanc!='') {
			$exibLanc .= '<tr><td class="text-left">'.conv_valor_br ($datalanc).'</td>';
			$dtlanca = conv_valor_br($datalanc);
		} elseif ($ofertaOr>'0' || $votoOr>'0') {
			$exibLanc .= '<tr class="danger"><td class="text-left">Lan&ccedil;mento c/ data inv&aacute;lida!</td>';
		}
		if ($ofertaOr>'0' || $votoOr>'0') {
			$exibLanc .= '<td class="text-center">'.number_format($ofertaOr,2,',','.').'</td>';
			$exibLanc .= '<td class="text-center">'.number_format($votoOr,2,',','.').'</td>';
			$exibLanc .= '<td class="text-center">'.$sem.'&ordf;</td></tr>';
		}
}
$exibLancFim .='</tbody></table>';
echo $exibLancCab.$exibLanc.$exibLancFim;
require_once 'forms/concluirdiz.php';
$linkLancamento  = './?escolha=tesouraria/receita.php&menu=top_tesouraria';
$linkLancamento .= '&igreja='.$roligreja.'&rec=24';
?>
