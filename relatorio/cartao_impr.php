<?PHP
session_start();
ob_start ();
$rolConsuta = $_GET['bsc_rol'];
if ($_SESSION['nivel']>4)
{
require "../func_class/funcoes.php";
require "../func_class/classes.php";
	$rec_pessoais = new DBRecord ("membro",$rolConsuta,"rol");
	$rec_ecl = new DBRecord ("eclesiastico",$rolConsuta,"rol");
	$rec_prof = new DBRecord ("profissional",$rolConsuta,"rol");
	$rec_civil = new DBRecord ("est_civil",$rolConsuta,"rol");
	$igreja = new DBRecord ("igreja","1","rol");
	$cong = new DBRecord ("igreja",$rec_ecl->congregacao(),"rol");
	$cidade = new DBRecord ("cidade",$rec_pessoais->naturalidade(),"id");
	$rec_ecl->c_impresso  = date("Y-m-d"); //Aqui é atribuido a esta variável um valor para UpDate
	//$rec_ecl->Update();
	$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];
	$atual = $rec_ecl -> hist ();
	$rec_ecl->hist="@Impresso em: ". date ('d/m/Y H:i:s') .", por: $hist" . $atual ; //Aqui é atribuido a esta variável um valor para UpDate
	$rec_ecl->quem_imprimiu = $_SESSION['valid_user'];
	$rec_ecl->Update(); //É feita a chamada do método q realiza a atualização no Banco
	//echo "Pastor em: ".$rec_ecl->pastor()." - Evangelista em: ".$rec_ecl->evangelista()." - Presb&iacute;tero em: ".$rec_ecl->presbiterio()." - Di&aacute;cono em:  ".$rec_ecl->diaconato()." - Batismo em águas ".$rec_ecl->batismo_em_aguas()." - Espiritual ".$rec_ecl->situacao_espiritual();
	if ($rec_ecl->situacao_espiritual()<>"1"){
		echo "<h1>Voc&ecirc; deve regularizar a situa&ccedil;&atilde;o espiritual deste membro antes de imprimir o cart&atilde;o!<br \> Use bot&atilde;o Eclesis&aacute;tico</h1>";
		exit;
	}elseif ($rec_pessoais->sexo()=='F' && file_exists("../img/cartao_feminino.jpg")) {
		$background_cartao = "feminino"; //Define a imagem de fundo do cartão
	}elseif (cargo($rolConsuta)['0']=="Pastor") {
		$background_cartao = "pastor"; //Define a imagem de fundo do cartão
	}elseif (cargo($rolConsuta)['0']=="Evangelista") {
		$background_cartao = "evangelista";
	}elseif (cargo($rolConsuta)['0']=="Presb&iacute;tero") {
		$background_cartao = "presbitero";
	}elseif (cargo($rolConsuta)['0']=="Di&aacute;cono") {
		$background_cartao = "diacono";
	}elseif (cargo($rolConsuta)['0']=="Auxiliar"){
		$background_cartao = "auxiliar"; //Define a imagem de fundo do cartão
	}else {
		$background_cartao = "membro";
	}
 if (file_exists("../img_membros/".$rolConsuta.".jpg"))//Verifica se a imagem esta arquivada
	{
		$img=$rolConsuta.".jpg";
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
	left:240px;
	top:60px;
	width:260px;
	height:45px;
	z-index:4;
	font-size: 80%;
	text-align: right;
}
#Razao {
	position:absolute;
	left:140px;
	top:25px;
	width:360px;
	height:36px;
	z-index:5;
	font-size: 200%;
	text-align:right;
}
#marca {
	position:absolute;
  	background: url(../img/marca.png) no-repeat;
  	background-size: 203px 71px;
	left:30px;
	top:40px;
	width:211px;
	height:143px;
	z-index:6;
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
	text-shadow: 1px 1px 1px #FFFFFF;
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
#mensargem {
	position:absolute;
	text-align: right;
	left:100px;
	top:116px;
	width:400px;
	height:29px;
	z-index:9;
	font-family:Arial, Helvetica, sans-serif;
	font-size: 75%;
}
#Rol {
	position:absolute;
	text-shadow: 1px 1px 1px #FFFFFF;
	left:402px;
	top:141px;
	width:114px;
	height:23px;
	z-index:10;
	text-align:center;
}
#verso1 {
	position:absolute;
	text-shadow: 0px 0px 2px #FFFFFF;
	left:573px;
	top:22px;
	width:216px;
	height:86px;
	z-index:11;
	font-size: 90%;
	color: #000000;
	font:bold;
}
#verso2 {
	position:absolute;
	text-shadow: 0px 0px 2px #FFFFFF;
	left:820px;
	top:20px;
	width:230px;
	height:86px;
	z-index:11;
	font-size: 90%;
}
#Pastor {
	position:absolute;
	text-shadow: 0px 0px 2px #FFFFFF;
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
#LogoAD {
	position:absolute;
	left:38px;
	top:37px;
	z-index:13;
}
-->
</style>
</head>
<body>
<?php
	if (file_exists("../img/logo.png")){
		echo '<div id="LogoAD"><img src="../img/logo.png" width="200" height="75" /></div>';
	}else {
		echo '<div id="Razao">Igreja Assembleia de Deus</div>';
	}
?>
<div id="cartao"></div>
<div id='marca'></div><!--  Cartão com logo idependente do fundo da imagem-->
<div id='Endereco'>
  <div><?PHP echo $igreja->rua().', N&ordm; '.$igreja->numero().' - '.CIDADEIG.' - '.UFIG;?>
   <?PHP echo ' CEP:&nbsp;'.$igreja->cep().' Fone: '.$igreja->fone().' CNPJ:&nbsp;'.$igreja->cnpj();?>
  </div>
</div>
<div id="foto"><img src="../img_membros/<?PHP echo $img;?>" alt="Foto do Membro" width="109" height="141" border="1" /></div>
<div id="cargo">Carteira de Identidade de <?PHP echo cargo($rolConsuta)['0'];?></div>
<div id="Nome">
 <?PHP print strtoupper(toUpper($rec_pessoais->nome()));?></div>
 <div id="mensargem"><?php echo MSGCARTAO;?></div>
<div id="Rol"><?PHP printf ("Rol: %'04u",$rolConsuta);?></div>
<div id="verso1">
<?PHP
	print "Filia&ccedil;&atilde;o: <br />{$rec_pessoais->pai()}<br /> e {$rec_pessoais->mae()}<hr>";
	print "Data de Nascimento: ".conv_valor_br ($rec_pessoais->datanasc());
	print "<br />Nacionalidade: ".$rec_pessoais->nacionalidade();
	$cidNatal = ($cidade->nome()=='') ? $rec_pessoais->naturalidade() : $cidade->nome().' - '.$cidade->coduf() ;
	print '<br />Natural de: '.$cidNatal;
?>
</div>
<div id="verso2">
<?PHP
	print "<b>Membro desde:</b> ".conv_valor_br ($rec_ecl->dat_aclam());
	print "<br />CPF: ".$rec_prof->cpf();
	printf ("<br />Identidade:  %s - %s",$rec_prof->rg(),$rec_prof->orgao_expedidor());
	print "<br />Estado Civil: ".$rec_civil->estado_civil();
	print "<br />Data do Batismo: ".conv_valor_br ($rec_ecl->batismo_em_aguas());
	if ($cong->rol()=='1') {
		$nomeCong = 'Templo '.$cong->razao();
	} else {
		$nomeCong = 'Congrega&ccedil;&atilde;o: '.$cong->razao();
	}

	echo '<br />'.$nomeCong;
?>
</div>
<div id="Pastor"><strong><?PHP echo strtoupper(toUpper($igreja->pastor()));?></strong></div>
</body>
<script type="text/javascript">window.print();</script>
</html>
<?PHP
//fim do
}else{
echo "Dados incorretos!";
}
?>
