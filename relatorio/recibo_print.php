<?PHP
	session_start();
	if (empty ($_POST["resp_recebeu"]) && !empty($_POST["rols"])) {
		echo "<script> alert('Você deve indicar quem está recebendo os cartões!');location.href='../?escolha=relatorio/recibos.php&rols={$_POST["rols"]}&menu=top_formulario&tipo=1';;</script>";
		header("Location: ../");

	}
	require_once ("../func_class/classes.php");
	require_once ("../func_class/funcoes.php");
	require_once("func.php");

	$igreja = new DBRecord ("igreja","1","rol");
    $cidadeIgr = new DBRecord ("cidade",$igreja->cidade(),"id");

	if (!empty($_POST["rols"])){
		$mem_rec = new DBRecord ("membro",$_POST["resp_recebeu"],"rol");
		$list_recibos = new emit_recibos ($_POST["rols"]);
		$data = date ("d/m/Y");
		$Rol_recebeu = $mem_rec->rol();
	}else {
		$recibo = new DBRecord ("recibos",$_GET["recibo"],"rol");
		$list_recibos = new emit_recibos ($recibo->rol_entregue());
		$data = conv_valor_br($recibo->data());
		$mem_rec = new DBRecord ("membro",$recibo->rol_recebeu(),"rol");
		$num_recibo = $_GET["recibo"];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ficha de Membro</title>
<link rel="stylesheet" type="text/css" href="reset.css" />
<link rel="icon" type="image/gif" href="../img/br_igreja.jpg">
<style type="text/css">
<!--

body {
  font-family:Arial, Helvetica, sans-serif;
}

#header { height: 125px; background-image: url(header2.jpg); background-repeat: no-repeat; background-position: top bottom; margin: 0; padding: 0 20px 0 100px; text-align:center; font-family:"Times New Roman", Times, serif;}

#header h5 {
	font-size: 100%;
	text-align: left;
	color: #a12621;
	font-size: 1em;
	font-weight: normal;
	padding: -200px 20px 0;
}

#endereco {
	position:absolute;
	left:650px;
	top:181px;
	width:159px;
	height:27px;
	z-index:5;
}

#footer {
	color: #636466;
	font-size:65%;
	height: 50px;
	background-repeat: no-repeat;
	background-position: top;
	text-align: left;
	clear: both;
	margin: 0;
	padding-top: 25px;
	padding: 10px 0 0 0;
	background-image: url(horbar.gif);
		width: 800px;
}

#footer a {
	color: #636466;
	text-decoration: underline;
}

a:link:after, a:visited:after {
	content:"("attr(href)")";
	font-size: 80%;
	color:#555555;
}

h1{
	color: #0000FF;
	font-size: 300%;
	font-family: Forte;
	font-weight: normal;
	text-align: left;
	height: 60px;
	padding-top: 20px;
	padding-left: 20px;
	font-family:"Times New Roman", Times, serif;

}


.clear {
  clear: both;
}

table {
  border-collapse: collapse;
  width: 50em;
  border: 1px solid #000000;
}

#lst_cad p{
	padding:2px 1px; margin: 0;
	font: 12px Arial; height:15px;
	color:#000066;
}

caption {
  font-size: 1.2em;
  font-weight: bold;
  margin: 1em 0;
}

#foto {
	float:inherit;
}

col {
  border-right: 1px solid #000000;
}

col#albumCol {
  border: none;
}

thead {
  background: #ccc;
  border-top: 1px solid #000000;
  border-bottom: 1px solid #000000;
}

th {
  font-weight: normal;
  text-align: left;
}

#playlistPosHead {
  text-indent: -1000em;
}

th, td {
  padding: 0.1em 1em;
  font-size: 70%;
}

.odd {
  background-color:#AAAAAA;
}

.dados {
  background:#E9E9E9;
}

tr:hover {
  background-color:#3d80df;
  color: #fff;
}

thead tr:hover {
  background-color: transparent;
  color: inherit;
}


-->
</style>
</head>

<body>
<div id="header">
</div>

<div id="lst_cad">
<table cellspacing="0" id="playlistTable" summary="Top 15 songs played. Top artitst include Coldplay, Yeah Yeah Yeahs, Snow Patrol, Deeper Water, Kings of Leon, Embrace, Oasis, Franz Ferdinand, Jet, The Bees, Blue States, Kaiser Chiefs and Athlete.">
<caption>
Recibo de Entrega de Cart&atilde;o de Membro
<p>Entregue conforme dados abaixo.</p>
</caption>

<colgroup>
<col id="PlaylistCol" />
<col id="trackCol" />
<col id="artistCol" />
<col id="albumCol" />
</colgroup>

<thead>
<tr>
<th scope="col">Nome</th>
<th scope="col">Rol N&uacute;mero</th>
<th scope="col">Congrega&ccedil;&atilde;o</th>
</tr>
</thead>

<tbody>

<?php
if (!empty($_POST["rols"])){
	$list_recibos->List_rol ();
	$num_recibo = $list_recibos->ultimo_id ();
}else {
	$list_recibos->reimprimir_rec ();
}


?>

</tbody>
</table>

</div>
<p>
  <!-- fim div lst_cad -->
</p>
<p>Recebido em:
  <?PHP  print $cidadeIgr->nome()." - ".$cidadeIgr->coduf().", ".data_extenso ($data);?>
  <br />
Assinatura:____________________________________________<br />
Entregue &agrave;: <?PHP echo "Rol: {$mem_rec->rol()} - {$mem_rec->nome()}";?></p>
<div id="footer">
	<?PHP echo "Templo SEDE: {$igreja->rua()}, N&ordm; {$igreja->numero()} - {$igreja->cidade()} - {$igreja->uf()}";?><br />

	  Copyright &copy; <a href="http://<?PHP echo "{$igreja->site()}";?>/" title="Copyright information"></a>
      Email: <a rel="nofollow" target="_blank" href="mailton: <?PHP echo "{$igreja->email()}";?>"><?PHP echo "{$igreja->email()}";?></a>
	   <?PHP echo "CNPJ: {$igreja->cnpj()}";?><br />
   		<?PHP echo "CEP: {$igreja->cep()} - Fone: {$igreja->fone()} - Fax: {$igreja->fax()}";?><br />
     <p> Designed by <a rel="nofollow" target="_blank" href="mailton: hiltonbruce@gmail.com">Joseilton Costa Bruce.</a></p>
</div>
<div id="endereco">N&ordm; <?PHP  printf (" %'05u",$num_recibo);?></div>
</body>
</html>
