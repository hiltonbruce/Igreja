<h1><img src="img/loading2.gif" width="30" height="30"></h1>
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

	$vlr = false;

echo '<H1>Data do registo: '.$vlrregistro[0].'</h1>';
$igreja = ($_POST['igreja']>'0') ?  $_POST['igreja']: false ;

for ($i=1; $i < 6; $i++) {
	$ofOr = 'of'.$i;//Variável para o post of?
	$votOr = 'voto'.$i;//Variável para o post voto?
	$dataOr = 'data'.$i;//Variável para o post data?
	$semOr = 'entra'.$i;//Variável para o post entra? (ref a semana)

	//verificando se há valor e data que possibilite o lançamento
	$ofertaOr = ($_POST[$ofOr]>'0') ?  $_POST[$ofOr]: false ;
	$votoOr = ($_POST[$votOr]>'0') ?  $_POST[$votOr]: false ;
	$datalanc = condatabrus ($_POST[$dataOr],$dataOr);
	list($ano,$mes,$dia) = explode('-', $datalanc);


	echo '<H1>Data do lançamento: '.$_POST[$dataOr].' *** </h1>';

	if (($ofertaOr || $votoOr) && $datalanc) {
		//Verifica se há valor em oferta ou voto e se data foi enviada

		$sem = $_POST["$semOr"];
		$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];

		if ($ofertaOr>0) {
			$conta = "'720','3','7'";//Oração Adulto
			$value  = "'','',$conta,'".$igreja."','','','$ofertaOr',";
			$value .= "'$datalanc','$sem','$mes','$ano','$igreja','{$_SESSION['valid_user']}',";
			$value .= "'$tesoureiro2','{$_POST["obs"]}',NOW(),'$hist'";
			$dados = new insert ($value,"dizimooferta");
			$dados->inserir();
		}

		if ($votoOr>0) {
			$conta = "'721','3','7'";//Voto em Circ. de Oração
			$value  = "'','',$conta,'".$igreja."','','','$votoOr',";
			$value .= "'$datalanc','$sem','$mes','$ano','$igreja','{$_SESSION['valid_user']}',";
			$value .= "'$tesoureiro2','{$_POST["obs"]}',NOW(),'$hist'";
			$dados = new insert ($value,"dizimooferta");
			$dados->inserir();
		}

		//echo "<script>location.href='./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec={$_POST["tipo"]}&igreja={$_POST["igreja"]}'; </script>";
		echo "<a href='./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec={$_POST["tipo"]}&igreja={$_POST["igreja"]}'>Continuar0...<a>";

	} else {
		echo "<script>alert('Valor não Informado!');</script>";
		//echo "<script>location.href='./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec={$_POST["tipo"]}&igreja={$_POST["igreja"]}'; </script>";
		echo "<a href='./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec={$_POST["tipo"]}&igreja={$_POST["igreja"]}'>Continuar2...<a>";

	}

		echo  ' OFerta - '.$ofertaOr.' - Voto '.$votoOr.' -Data '.$datalanc.' -Semana '.$sem;
		echo  '<br /> Var_OFerta - '.$ofOr.' - Var_Voto '.$votOr.' -Var_Data '.$dataOr.' -Var_Semana '.$semOr;

}

?>
