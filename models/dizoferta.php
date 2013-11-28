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
	
for ($i = 0; $i < 13; $i++) {
	//verifica se há algum campo algum campo com valor
		$campo = 'oferta'.$i;
		printf ("$campo: %s",$_POST["$campo"]);
		
		$vlrPost = strtr($_POST["$campo"], ', .','.,,' );
		
		if ($vlrPost>'0') {
			$vlr = true;
			break;
		}
	}
		
$dta = explode("/",$_POST["data"]);
		$d=$dta[0];
		$m=$dta[1];
		$y=$dta[2];
		$res = checkdate($m,$d,$y);
		
$datalanc = sprintf("%s-%s-%s",$y,$m,$d);
$rolIgreja = (empty($_POST['rolIgreja'])) ? false:(int)$_POST['rolIgreja'];
$ultregistro = mysql_query ('SELECT data FROM dizimooferta WHERE lancamento="0" AND igreja="'.$rolIgreja.'" ORDER BY id DESC LIMIT 1');
$vlrregistro = mysql_fetch_row($ultregistro);

echo '<H1>Data do registo: '.$vlrregistro[0].'</h1>';
echo '<H1>Data do lançamento: '.$datalanc.'</h1>';
$msgErro  = "<script>location.href='./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec={$_POST["tipo"]}&igreja={$rolIgreja}'; </script>";
$msgErro .= "<a href='./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec={$_POST["tipo"]}&igreja={$rolIgreja}'>Continuar...<a>";
	
if (($vlr && $vlrregistro[0] == $datalanc) || ($vlr && $vlrregistro[0] =='') && $rolIgreja ) {
	//Verifica se o caixa do ultimo culto foi encerrado e se há algum valor em dizimo, oferta ou oferta extra
		
	$sem = semana($_POST["data"]);
	
	$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];
	
switch ($_POST['tipo']) {
	case '1':
		require_once 'help/tes/tipo1DizOferta.php'; //Aplica formatações e atualiza o banco
		$linkreturn  = "./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec={$_POST["tipo"]}&igreja={$_POST["rolIgreja"]}";
	break;
	case '2':
		require_once 'help/tes/tipo2DizOferta.php';
		$linkreturn  = "./?escolha=tesouraria/receita.php&menu=top_tesouraria&igreja={$_POST["rolIgreja"]}";
	break;
	case '3':
		require_once 'help/tes/tipo3DizOferta.php';
		$linkreturn  = "./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec=0&igreja={$_POST["rolIgreja"]}";
	break;
	case '4':
		require_once 'help/tes/tipo4DizOferta.php';
		$linkreturn  = "./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec=0&igreja={$_POST["rolIgreja"]}";
	break;
	default:
		echo 'Não foi definidade o tipo do grupo de lançamento!';
		$linkreturn  = "./?escolha=tesouraria/receita.php&menu=top_tesouraria&igreja={$_POST["rolIgreja"]}";
	break;
}

	//echo "<h1>".mysql_insert_id()."</h>";//recupera o id do último insert no mysql
		$linr = "./?escolha={$_POST['escolha']}&menu={$_POST['menu']}&";
		$linr .= "rec={$_POST['rec']}&igreja={$_POST["rolIgreja"]}&";
		$linr .= "data={$_POST['data']}&mes={$_POST['mes']}&ano={$_POST['ano']}";
		$linkreturn .= "&data=".$_POST["data"]."&mes=$m&ano=$y";
		echo '<meta http-equiv="refresh" content="2; '.$linkreturn.'">';
		//echo "<script>location.href='$linkreturn';</script>";
		echo "<a href='$linkreturn' autofofus='autofofus' ><button>Continuar...</button><a>";
}elseif (!$rolIgreja) {//Se não foneceu o número da igreja
	echo "<script>alert('Você não informou a Igreja! Faça agora para continuar...');</script>";
	echo $msgErro;
}elseif ($vlrregistro[0] <> $datalanc) {
	echo "<script>alert('Você não encerrou o caixa do último culto! Faça agora para continuar...');</script>";
	echo $msgErro;
} else {
	echo "<script>alert('Valor não Informado!');</script>";
	echo $msgErro;
}
	/*
	$value="'{$_SESSION["rol"]}','','','','','','','','','','','','','','','','','','','','','','','',''";
	$eclesiastico = new insert ("$value","eclesiastico");
	$eclesiastico->inserir();
	*/

?>