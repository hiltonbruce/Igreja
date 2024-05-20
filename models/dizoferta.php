<?PHP
if (empty($_POST['confirma']) && ($_SESSION['setor']=='2' || $_SESSION['setor']=='99' )) {
	$confirma='2';// O 99 � desenvolvedor, super usu�rio
} elseif (empty($_POST['confirma'])) {
	$confirma=$_SESSION['setor'];
} else {
	$confirma = intval($_POST['confirma']);
}
require_once 'views/tesouraria/dizoferta.php';
$dta = explode("/",$_POST["data"]);
$d=$dta[0];
$m=$dta[1];
$y=$dta[2];
$res = checkdate($m,$d,$y);

$dataHoje = new DateTime("now");
$dataLanc = new DateTime("$y-$m-$d");

//echo $dataHoje->format('Y-m-d\TH:i:s.u');
//echo '<br> Lan�.'.$dataLanc->format('Y-m-d\TH:i:s.u');

$datalanc = sprintf("%s-%s-%s",$y,$m,$d);
$rolIgreja = (empty($_POST["rolIgreja"])) ? false:intval($_POST['rolIgreja']);
$sqlUltiReg  = 'SELECT data FROM dizimooferta WHERE ';
$sqlUltiReg .= 'lancamento="0" AND igreja="'.$rolIgreja.'" ';
$sqlUltiReg .= 'AND (confirma="" || confirma="'.$confirma.'") ';
$sqlUltiReg .= 'ORDER BY id DESC LIMIT 1';
$ultregistro = mysql_query ($sqlUltiReg);
$vlrregistro = mysql_fetch_row($ultregistro);
//print_r($vlrregistro);
//$msgErro  = "<script>location.href='./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec={$_POST["tipo"]}&igreja={$rolIgreja}'; </script>";
$msgErro = "<a href='./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec={$_POST["tipo"]}&
		igreja={$rolIgreja}'><button class='btn btn-primary' tabindex='1' autofocus='autofocus' >Continuar...</button><a>";
$msgAlert  = '<div class="alert alert-danger" role="alert">';
$msgAlert .= '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
$msgAlert .= '<span class="sr-only">Error:</span> ';
if (($vlr && ($vlrregistro[0] == $datalanc || $_POST['tipo']=='4')) || ($vlr && $vlrregistro[0] =='') && $rolIgreja ) {
	$igrejaSelecionada = new DBRecord('igreja', $rolIgreja, 'rol');
	//Verifica se o caixa do ultimo culto foi encerrado e se h� algum valor em dizimo, oferta ou oferta extra
	$sem = semana($_POST["data"]);
	$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];
	switch ($_POST['tipo']) {
		case '1':
			//Dizimos, ofertas, miss�es, ora��es
			require_once 'help/tes/tipo1DizOferta.php'; //Aplica formata��es e atualiza o banco
			$linkreturn  = "./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec={$_POST["tipo"]}&igreja=$rolIgreja";
		break;
		case '2':
			require_once 'help/tes/tipo2DizOferta.php';
			$linkreturn  = "./?escolha=tesouraria/receita.php&menu=top_tesouraria&igreja=$rolIgreja";
		break;
		case '3':
			require_once 'help/tes/tipo3DizOferta.php';
			$linkreturn  = "./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec=0&igreja=$rolIgreja";
		break;
		case '4':
			//EBD
			require_once 'help/tes/tipo4DizOferta.php';
			$linkreturn  = "./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec=3&igreja=$rolIgreja";
		break;
		default:
			echo 'N�o foi definido o tipo do grupo de lan�amento!';
			$linkreturn  = "./?escolha=tesouraria/receita.php&menu=top_tesouraria&igreja=$rolIgreja";
		break;
	}
	echo $mostraLanc;
	//echo "<h1>".mysql_insert_id()."</h>";//recupera o id do �ltimo insert no mysql
		$linr = "./?escolha={$_POST['escolha']}&menu={$_POST['menu']}&";
		$linr .= "rec={$_POST['rec']}&igreja=$rolIgreja&";
		$linr .= "data={$_POST['data']}&mes={$_POST['mes']}&ano={$_POST['ano']}";
		$linkreturn .= "&data=".$_POST["data"]."&mes=$m&ano=$y";
		$linkreturn .= "&acescamp=".$_POST["acescamp"];
		//echo '<meta http-equiv="refresh" content="2; '.$linkreturn.'">';
		//echo "<script>location.href='$linkreturn';</script>";
?>
	<table>
		<tbody>
			<tr>
				<td>
					<?php
					if ($vlrregistro[0]!='') {
					echo '<H4>Data do �ltimo registo: '.conv_valor_br ($vlrregistro[0]).'</h4>';
					}
					?>
				</td>
				<td>
				<?php echo '<H4>Data do lan�amento: '.conv_valor_br ($datalanc).'</h4>';?>
				</td>
				<td rowspan="2">
						<?PHP
							//Exibe a foto do contribuinte
								if ($_POST["rol"]>'0') {
									print mostra_foto($_POST["rol"],75,57);
								}
							?>
				</td>
			</tr>
			<tr>
				<td>
					<?PHP
					echo "<a href='$linkreturn' ><button class='btn btn-primary' tabindex='1' autofocus='autofocus'>Continuar...</button><a>";
					?>
				</td>
				<td>
					<H4>Cong. de lan�.: <?PHP
					echo $igreja->razao();
					?></H4>
				</td>
			</tr>
		</tbody>
	</table>
<?php
	require 'forms/concluirdiz.php';//Formul�rio para fecha o caixa
	}elseif (!$rolIgreja) {//Se n�o foneceu o n�mero da igreja
		echo "<script>alert('Voc� n�o informou a Igreja! Fa�a agora para continuar...');</script>";
		$msgErro .= $msgAlert.'Voc&ecirc; n&atilde;o informou a Igreja!';
		$msgErro .= ' <u>O lan&ccedil;mento <b>N&Atilde;O</b> foi confirmado!</u></div>';
		echo $msgErro;
	}elseif ($vlrregistro[0] <> $datalanc && $vlrregistro[0]<>'') {
		echo "<script>alert('Voc� n�o encerrou o caixa do �ltimo culto! Fa�a agora para continuar...');</script>";
		$msgErro .= $msgAlert.'Voc&ecirc; n&atilde;o encerrou o caixa do &uacute;ltimo culto!';
		$msgErro .= ' <u>O lan&ccedil;mento <b>N&Atilde;O</b> foi confirmado!</u></div>';
		echo $msgErro;
	} else {
		echo "<script>alert('Valor n�o Informado!');</script>";
		$msgErro .= $msgAlert.'&nbsp;Voc&ecirc; n&atilde;o informou o valor!';
		$msgErro .= ' <u>O lan&ccedil;mento <b>N&Atilde;O</b> ser&aacute; realizado com valor zero (R$ 0,00)!</u></div>';
		echo $msgErro;
	}
		/*
		$eclesiastico = new insert ("$value","eclesiastico");
		$eclesiastico->inserir();
		*/
?>
