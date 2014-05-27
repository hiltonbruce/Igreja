<?PHP
session_start();
ob_start ();

if ($_SESSION['nivel']>4)
{
require "../func_class/funcoes.php";
require "../func_class/classes.php";

	$rec_pessoais = new DBRecord ("membro","{$_SESSION["rol"]}","rol");
	$rec_ecl = new DBRecord ("eclesiastico","{$_SESSION["rol"]}","rol");
	$rec_prof = new DBRecord ("profissional","{$_SESSION["rol"]}","rol");
	$rec_civil = new DBRecord ("est_civil","{$_SESSION["rol"]}","rol");
	$igreja = new DBRecord ("igreja","1","rol");
	$cong = new DBRecord ("igreja",$rec_ecl->congregacao(),"rol");
	$cidade = new DBRecord ("cidade",$rec_pessoais->naturalidade(),"id");
	
	$rec_ecl->c_impresso  = date("Y-m-d"); //Aqui é atribuido a esta variável um valor para UpDate
	$rec_ecl->Update();
	
	$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];
	
	$atual = $rec_ecl -> hist ();
	$rec_ecl ->hist="@Impresso em: ". date ('d/m/Y H:i:s') .", por: $hist" . $atual ; //Aqui é atribuido a esta variável um valor para UpDate
	$rec_ecl ->quem_imprimiu = $_SESSION['valid_user'];
	$rec_ecl->Update(); //É feita a chamada do método q realiza a atualização no Banco
	
	//echo "Pastor em: ".$rec_ecl->pastor()." - Evangelista em: ".$rec_ecl->evangelista()." - Presb&iacute;tero em: ".$rec_ecl->presbiterio()." - Di&aacute;cono em:  ".$rec_ecl->diaconato()." - Batismo em águas ".$rec_ecl->batismo_em_aguas()." - Espiritual ".$rec_ecl->situacao_espiritual(); 
	
	if ($rec_ecl->situacao_espiritual()<>"1"){
		echo "<h1>Voc&ecirc; deve regularizar a situa&ccedil;&atilde;o espiritual deste membro antes de imprimir o cart&atilde;o!<br \> Use bot&atilde;o Eclesis&aacute;tico</h1>";
		exit;
	}elseif (cargo($_SESSION["rol"])=="Pastor") {
		$background_cartao = "pastor"; //Define a imagem de fundo do cartão
	}elseif (cargo($_SESSION["rol"])=="Evangelista") {
		$background_cartao = "evangelista";
	}elseif (cargo($_SESSION["rol"])=="Presb&iacute;tero") {
		$background_cartao = "presbitero";
	}elseif (cargo($_SESSION["rol"])=="Di&aacute;cono") {
		$background_cartao = "diacono";
	}elseif (cargo($_SESSION["rol"])=="Auxiliar"){
		$background_cartao = "auxiliar"; //Define a imagem de fundo do cartão
	}else {
		$background_cartao = "membro";
	}
	
	 if (file_exists("../img_membros/".$_SESSION["rol"].".jpg"))//Verifica se a imagem esta arquivada
		{
			$img=$_SESSION["rol"].".jpg";
		}
		else
		{
			$img="ver_foto.jpg";
		}

//echo "<h1> -- $background_cartao -- </h1>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>impress&atilde;o de requisi&ccedil;&atilde;o</title>
<link rel="stylesheet" type="text/css" href="../reset.css" />
<link rel="icon" type="image/gif" href="../img/br_igreja.gif">

<style type="text/css">
<!--
body {
	font-family:"Times New Roman", Times, serif;
}
#cartao {
	background:url(../img/cartao_<?PHP echo "$background_cartao";?>.jpg) no-repeat;
	position:absolute;
	left:12px;
	top:5px;
	width:1087px;
	height:342px;
	z-index:3;
}
#Endereco {
	position:absolute;
	left:151px;
	top:69px;
	width:360px;
	height:45px;
	z-index:4;
	font-size: 80%;
}
#Razao {
	position:absolute;
	left:153px;
	top:35px;
	width:360px;
	height:36px;
	z-index:5;
	font-size: 200%;
	text-align:center;
}
#foto {
	position:absolute;
	left:403px;
	top:167px;
	width:111px;
	height:143px;
	z-index:6;
}
#cargo {
	position:absolute;
	left:50px;
	top:171px;
	width:341px;
	height:35px;
	z-index:7;
	text-align:center;
	font-size: 150%;
}
#Nome {
	position:absolute;
	text-shadow: 1px 1px #FFFFFF;
	left:39px;
	top:249px;
	width:354px;
	height:33px;
	z-index:8;
	text-align:center;
	font-size: 120%;
	font-family:Arial, Helvetica, sans-serif;
}
#Layer7 {
	position:absolute;
	left:155px;
	top:116px;
	width:353px;
	height:29px;
	z-index:9;
	font-family:Arial, Helvetica, sans-serif;
	font-size: 75%;
}
#Rol {
	position:absolute;
	text-shadow: 1px 1px #FFFFFF;
	left:402px;
	top:141px;
	width:114px;
	height:23px;
	z-index:10;
	text-align:center;
}
#verso1 {
	position:absolute;
	text-shadow: 1px 1px #FFFFFF;
	left:573px;
	top:22px;
	width:216px;
	height:86px;
	z-index:11;
	font-size: 80%;
}

#verso2 {
	position:absolute;
	text-shadow: 1px 1px #FFFFFF;
	left:820px;
	top:20px;
	width:230px;
	height:86px;
	z-index:11;
	font-size: 80%;
}
#Pastor {
	position:absolute;
	left:643px;
	top:305px;
	width:376px;
	height:24px;
	z-index:12;
	text-align:center;
	font:bold;
	font-family:"Courier New", Courier, monospace;
	font-size: 80%;
}

-->
</style>
</head>

<body>
<div id="cartao"></div>
<div id="Endereco">
  <div align="center">&nbsp;
  </div>
</div>
<div id="Razao">
  &nbsp;
</div>
<div id="foto"><img src="../img_membros/<?PHP echo $img;?>" alt="Foto do Membro" width="109" height="141" border="1" /></div>
<div id="cargo">&nbsp;</div>
<div id="Nome">
 <?PHP print '<b>'.strtoupper(toUpper($rec_pessoais->nome())).'</b>';?></div>
<div id="Layer7">&nbsp;</div>
<div id="Rol"><?PHP printf ("<b>Rol: %'04u </b>",$_SESSION["rol"]);?></div>
<div id="verso1">
<?PHP
	print "Filia&ccedil;&atilde;o: <br />{$rec_pessoais->pai()}<br /> e {$rec_pessoais->mae()}<hr>";
	print "Data de Nascimento: ".conv_valor_br ($rec_pessoais->datanasc());
	print "<br />Nacionalidade: ".$rec_pessoais->nacionalidade();
	print "<br />Natural de: {$cidade->nome()} - {$cidade->coduf()}";
?>
</div>
<div id="verso2">
<?PHP
	print "CPF: ".$rec_prof->cpf();
	printf ("<br />Identidade:  %s - {$rec_prof->orgao_expedidor()}",number_format($rec_prof->rg(), 0, ',', '.'));
	print "<br />Estado Civil: ".$rec_civil->estado_civil();
	print "<br />Data do Batismo: ".conv_valor_br ($rec_ecl->batismo_em_aguas());
	print "<br />Congrega&ccedil;&atilde;o: ".$cong->razao();
?>
</div>
<div id="Pastor"><strong>&nbsp;</strong></div>

</body>
</html>
<?PHP
//fim do 
}else{
echo "Dados incorretos!";
}
?>
