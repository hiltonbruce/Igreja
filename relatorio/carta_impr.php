<?PHP
session_start();
ob_start ();
$autorizado = $_SESSION['perfil'];
$numero=(int) $_GET["numero"];
$usuario=$_GET["recebeu"];
if ($_SESSION['nivel']>4)
{
$numero=$_GET["numero"];
$usuario=$_GET["recebeu"];
require "../func_class/funcoes.php";
require "../func_class/classes.php";
conectar();
$query=mysql_query("SELECT p.numero,p.local,DATE_FORMAT(p.dt_liberado,'%d/%m/%Y às %H:%i') dt_lib,p.chefe, p.quant,p.obs, p.quant_atendida,p.usu_libera,pr.codbarras,pr.descricao,pr.id FROM pedido AS p, produtos AS pr WHERE p.numero='$numero' AND p.id_produto=pr.id");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Carta de Recomenda&ccedil;&atilde;o</title>
<link rel="stylesheet" type="text/css" href="../reset.css" />
<link rel="stylesheet" type="text/css" href="print.css" />
<link rel="icon" type="image/gif" href="../img/br_igreja_n.gif">

<style type="text/css">
<!--
#Razao {
	position:absolute;
	left:169px;
	top:30px;
	width:515px;
	height:43px;
	z-index:4;
	font-size:250%;
	text-align:center;
	text-decoration:underline;
}
#Endereco {
	position:absolute;
	left:262px;
	top:79px;
	width:330px;
	height:39px;
	z-index:5;
	text-align:center;
	font-size: 80%;
}
#Layer5 {
	position:absolute;
	left:180px;
	top:152px;
	width:435px;
	height:42px;
	z-index:6;
}
#Layer6 {
	position:absolute;
	left:445px;
	top:203px;
	width:201px;
	height:34px;
	z-index:7;
}
#Layer7 {
	position:absolute;
	left:31px;
	top:252px;
	width:736px;
	height:118px;
	z-index:8;
}
#Layer8 {
	position:absolute;
	left:30px;
	top:385px;
	width:736px;
	height:28px;
	z-index:9;
}
#Layer9 {
	position:absolute;
	left:558px;
	top:419px;
	width:207px;
	height:25px;
	z-index:10;
}
#Layer10 {
	position:absolute;
	left:37px;
	top:434px;
	width:111px;
	height:115px;
	z-index:11;
}
#Layer11 {
	position:absolute;
	left:174px;
	top:489px;
	width:163px;
	height:42px;
	z-index:12;
}
#Layer12 {
	position:absolute;
	left:465px;
	top:489px;
	width:240px;
	height:40px;
	z-index:13;
}
#Layer13 {
	position:absolute;
	left:135px;
	top:560px;
	width:566px;
	height:26px;
	z-index:14;
}
-->
</style>
</head>

<body>
<div id="Razao">Igreja Assembleia de Deus</div>
<div id="Layer1"><img src="../img/br_igreja.jpg" width="91" height="120" align="baseline" /></div>

<div id="Endereco">Av. Eng. de Carvalho, 410 - Bayeux - PB<br />
CEP 58.307-150 - Fone: (0**83) 3232-1420 </div>
<div id="Layer5">CARTA DE </div>
<div id="Layer6">Destino</div>
<div id="Layer7">Corpo da Carta </div>
<div id="Layer8">Observa&ccedil;&atilde;o:</div>
<div id="Layer9">Data da Emiss&atilde;o: </div>
<div id="Layer10">Filiada a:<img src="../img/comadep.jpg" width="122" height="107" /> </div>
<div id="Layer11">Pastor da Igreja </div>
<div id="Layer12">Secret&aacute;rio da Igreja </div>
<div id="Layer13">Carta v&aacute;lida at&eacute;: </div>
    <div id="footer">
      <p><a href="http://www.adby.com.br/" title="Copyright information">Copyright &copy; Joseilton Costa Bruce</a> Designed by <a rel="nofollow" target="_blank" href="mailto: hiltonbruce@gmail.com">Joseilton Costa Bruce</a></p>
    </div>
</body>
</html>
<?PHP
//fim do 1º if que verifica a autorização para NUPAT ou NUTEL
}else{
echo "Dados incorretos!";
}
?>
