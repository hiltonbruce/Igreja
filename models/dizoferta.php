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
	
	$contribuinte = ($_POST['nome']=='') ? 'An&ocirc;nimo':$_POST['nome'];
	
echo '<fieldset><legend>Pre-Lançamento</legend>';
echo '<table>';
echo '<thead><tr><th colspan="2">Contibuinte: '.($_POST['nome']=='') ? 'An&ocirc;nimo':$_POST['nome'].'</th></tr>';
echo '<tbody><tr id="total"><td>Tipo de Entrada</td><td id="moeda">Valor</td></tr>';

for ($i = 0; $i < 13; $i++) {
	//verifica se há algum campo algum campo com valor
		$campo = 'oferta'.$i;
		
		$vlrPost = strtr( str_replace(array('.'),array(''),$_POST["$campo"]), ',.','.,' );

		$valorBR = number_format($vlrPost, 2, ',', ' ');
		
		switch ($i) {
			case '0':
				if ($vlrPost>0) 
					printf ("<tr id='lanc'><td>Dizimo:</td><td id='moeda'><button>R$ %s </button></td></tr>",$valorBR);
				
			break;
			case '1':
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Oferta:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
				break;
			case 2:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Oferta Extra:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
				break;
			case 3:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Voto:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
				break;
			case 4:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Campanha:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
			break;
			case 5:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Oferta p/ Missões:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
				break;
			case 6:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Envelope p/ Missões:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
				break;
			case 7:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Cofre p/ Missões:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
			break;
			case 8:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Carn&ecirc;s p/ Missões:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
			break;
			case 9:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Oferta Ora&ccedil;&atilde;o - Adulto:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
			break;
			case 10:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Oferta Ora&ccedil;&atilde;o - Mocidade:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
			break;
			case 11:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Oferta Ora&ccedil;&atilde;o - Infantil:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
			break;
			case 12:
				if ($vlrPost>0)
					printf ("<tr id='lanc'><td>Voto Ora&ccedil;&atilde;o:</td><td id='moeda'><button>R$ %s</button></td></tr>",$valorBR);
			
			break;
		}
		
		if ($vlrPost>'0') {
			$vlr = true;
		}
	}
	
echo '</tbody></table>';
echo '</fieldset>';
	
$dta = explode("/",$_POST["data"]);
		$d=$dta[0];
		$m=$dta[1];
		$y=$dta[2];
		$res = checkdate($m,$d,$y);
		
$datalanc = sprintf("%s-%s-%s",$y,$m,$d);
$rolIgreja = (empty($_POST['rolIgreja'])) ? false:(int)$_POST['rolIgreja'];
$ultregistro = mysql_query ('SELECT data FROM dizimooferta WHERE lancamento="0" AND igreja="'.$rolIgreja.'" ORDER BY id DESC LIMIT 1');
$vlrregistro = mysql_fetch_row($ultregistro);

echo '<H1>Data do último registo: '.$vlrregistro[0].'</h1>';
echo '<H1>Data do lançamento: '.$datalanc.'</h1>';
//$msgErro  = "<script>location.href='./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec={$_POST["tipo"]}&igreja={$rolIgreja}'; </script>";
$msgErro = "<a href='./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec={$_POST["tipo"]}&igreja={$rolIgreja}'><button>Continuar...</button><a>";
	
if (($vlr && $vlrregistro[0] == $datalanc) || ($vlr && $vlrregistro[0] =='') && $rolIgreja ) {
	//Verifica se o caixa do ultimo culto foi encerrado e se há algum valor em dizimo, oferta ou oferta extra
		
	$sem = semana($_POST["data"]);
	
	$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];
	
switch ($_POST['tipo']) {
	case '1':
		//Dizimos, ofertas, missões, orações
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
		//EBD
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
		$linkreturn .= "&acescamp=".$_POST["acescamp"];
		echo '<meta http-equiv="refresh" content="2; '.$linkreturn.'">';
		//echo "<script>location.href='$linkreturn';</script>";
		echo "<a href='$linkreturn' ><button autofofus='autofofus'>Continuar...</button><a>";
}elseif (!$rolIgreja) {//Se não foneceu o número da igreja
	echo "<script>alert('Você não informou a Igreja! Faça agora para continuar...');</script>";
	$msgErro .= '<div class="alert alert-error">Voc&ecirc; n&atilde;o informou a Igreja!';
	$msgErro .= ' <u>O lan&ccedil;mento <b>N&Atilde;O</b> foi confirmado!</u></div>';
	echo $msgErro;
}elseif ($vlrregistro[0] <> $datalanc && $vlrregistro[0]<>'') {
	echo "<script>alert('Você não encerrou o caixa do último culto! Faça agora para continuar...');</script>";
	$msgErro .= '<div class="alert alert-error">Voc&ecirc; n&atilde;o encerrou o caixa do &uacute;ltimo culto!';
	$msgErro .= ' <u>O lan&ccedil;mento <b>N&Atilde;O</b> foi confirmado!</u></div>';
	echo $msgErro;
} else {
	echo "<script>alert('Valor não Informado!');</script>";
	$msgErro .= '<div class="alert alert-error">Voc&ecirc; n&atilde;o informou o valor!';
	$msgErro .= ' <u>O lan&ccedil;mento <b>N&Atilde;O</b> ser&aacute; realizado com valor zero (R$ 0,00)!</u></div>';
	echo $msgErro;
}
	/*
	$value="'{$_SESSION["rol"]}','','','','','','','','','','','','','','','','','','','','','','','',''";
	$eclesiastico = new insert ("$value","eclesiastico");
	$eclesiastico->inserir();
	*/

?>