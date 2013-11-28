<?PHP
	session_start();
	require_once ("../func_class/classes.php");
	require_once ("../func_class/funcoes.php");
	//conectar ();
  	$carta = new DBRecord ("carta",$_POST["id_carta"],"id");
	$membro = new DBRecord ("membro",$_SESSION["rol"],"rol");
	$est_civil = new DBRecord ("est_civil",$_SESSION["rol"],"rol");
	$ecles = new DBRecord ("eclesiastico",$_SESSION["rol"],"rol");
	$profis = new DBRecord ("profissional",$_SESSION["rol"],"rol");
	$igreja = new DBRecord ("igreja","1","rol");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ficha de Membro</title>
<link rel="stylesheet" type="text/css" href="reset.css" />
<link rel="icon" type="image/gif" href="../img/br_igreja.gif">
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
	left:131px;
	top:85px;
	width:313px;
	height:54px;
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
	padding: 20px 0 0 0;
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
  width: 55em;
  border: 1px solid #000;
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
  border-right: 1px solid #ccc;
}

col#albumCol {
  border: none;
}

thead {
  background: #ccc;
  border-top: 1px solid #a5a5a5;
  border-bottom: 1px solid #a5a5a5;
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
  border-top: 1px solid #ccc;
}

.odd {
  background-color:#F8F8FF;
}

.dados {
  background:#CCCCCC;
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
<div id="header"></div>
<div id="lst_cad">
<fieldset><legend>Opções de Cadastro</legend><form id="form1" method="post" action="">
    <p></p>
    <p>
      <label>
        <input type="radio" name="Op&ccedil;&otilde;es de Cadstro" value="radio" />
        Novo Cadastro</label>
      <label>
        <input type="radio" name="Op&ccedil;&otilde;es de Cadstro" value="radio" />
        Re-Cadastro</label>
      <label>
        <input type="radio" name="Op&ccedil;&otilde;es de Cadstro" value="radio" />
        Candidato a Batismo</label>
      
      <label>
      <input type="radio" name="Op&ccedil;&otilde;es de Cadstro" value="radio" /> 
      Atualiza&ccedil;&atilde;o
</label>
      <br />
    </p>
    <p></p>
  </form></fieldset>
<table cellspacing="0" id="playlistTable" summary="">
<caption>
Formul&aacute;rio para Ficha de Membro
</caption>

<colgroup>
<col id="PlaylistCol" />
<col id="trackCol" />
<col id="artistCol" />
<col id="albumCol" />
</colgroup>


<tbody>
<tr>
<th height="41" colspan="3" scope="col">Nome:<p></p> </th>
<th scope="col">Rol:<p></p></th>
</tr>
<tr class="odd">
<td colspan="2">Pai:
  <p>&nbsp;</p></td>
<td><p>Data Nascimento: </p>
  <p>&nbsp;</p></td>
<td>Sexo:
  <p>&nbsp;</p></td>
</tr>

<tr>
<td colspan="2"><p>M&atilde;e: </p>
  <p>&nbsp;</p></td>
<td><p>Nacionalidade: </p>
  <p>&nbsp;</p></td>
<td><p>Natural de : </p>
  <p>&nbsp;</p></td>
</tr>

<tr class="odd">
<td colspan="2"><p>Endere&ccedil;o:
  <p>&nbsp;</p></td>
<td>N&ordm;:
  <p>&nbsp;</p>  </td>
<td><p>Complementos: </p>
  <p>&nbsp;</p></td>
</tr>

<tr>
  <td>Cidade :
    <p>&nbsp;</p></td>
  <td>Bairro :
    <p>&nbsp;</p></td>
  <td>CEP:
    <p>&nbsp;</p></td>
  <td>Telefone:
    <p>&nbsp;</p></td>
</tr>
<tr class="odd">
<td >Email:<p>&nbsp;</p></td>
<td >Celular:
  <p>&nbsp;</p></td>
<td>Gradua&ccedil;&atilde;o: <p>&nbsp;</p></td>
<td>Escolaridade:<p>&nbsp;</p> </td>
</tr>

<tr class="dados">
<td colspan="4"><strong>Dados Eclesi&aacute;sticos: </strong></td>
</tr>

<tr>
<td>Onde congrega:
  <p>&nbsp;</p></td>
<td>Data do Batismo em &Aacute;guas:
  <p>&nbsp;</p></td>
<td>Ano Batismo Espirito Santo:
  <p>&nbsp;</p></td>
<td>Local de Batismo:
  <p>&nbsp;</p></td>
</tr>

<tr class="odd">
<td>Denomina&ccedil;&atilde;o de onde veio:
  <p>&nbsp;</p></td>
<td>Mudou da denomina&ccedil;&atilde;o em:
  <p>
  <td>Auxiliar de trabalho em:
  <p>&nbsp;</p></td>
<td>Di&aacute;cono em:
  <p>&nbsp;</p></td>
</tr>

<tr>
<td>Presbit&eacute;ro em:
  <p>&nbsp;</p></td>
<td>Evangelista em:
  <p>&nbsp;</p></td>
<td>Pastor em:
  <p>&nbsp;</p></td>
<td>Veio de outra Assembleia de Deus:
  <p>&nbsp;</p></td>
</tr>

<tr class="odd">
<td>Data da mudan&ccedil;a da outra Assembleia:
  <p>&nbsp;</p></td>
<td>Cidade e UF de onde veio::
  <p>&nbsp;</p></td>
<td>Data:
  <p>&nbsp;</p></td>
<td>Data da aclama&ccedil;&atilde;o:
  <p>&nbsp;</p></td>
</tr>

<tr>
<td>Cart&atilde;o Impresso em:
  <p>&nbsp;</p></td>
<td>Cart&atilde;o Impresso em:
  <p>&nbsp;</p></td>
<td>&Eacute; membro por aclama&ccedil;&atilde;o:
  <p>&nbsp;</p></td>
<td>Situa&ccedil;&atilde;o espiritual:
  <p>&nbsp;</p></td>
</tr>

<tr class="dados">
<td colspan="4">Dados Profissionais </td>
</tr>

<tr>
<td>Profiss&atilde;o:
  <p>&nbsp;</p></td>
<td>CPF:
  <p>&nbsp;</p></td>
<td>Identidade:
  <p>&nbsp;</p></td>
<td>Empresa onde Trabalha:
  <p>&nbsp;</p></td>
</tr>

<tr class="dados">
<td colspan="4"><strong>Informa&ccedil;&otilde;es famili&aacute;res </strong></td>
</tr>

<tr>
<td colspan="2">Conjugue: <p>&nbsp;</p></td>
<td>Rol do Conjugue:
  <p>&nbsp;</p></td>
<td>Certid&atilde;o de Casamento N&ordm;:
  <p>&nbsp;</p></td>
</tr>

<tr class="odd">
<td><p>Livro:
  <p>&nbsp;</p></td>
<td>Folhas:<p> </p></td>
<td>Data: <p> </p></td>
<td>&nbsp;</td>
</tr>

<tr class="dados">
<td colspan="4"><strong>Oserva&ccedil;&otilde;es:</strong></td>
</tr>

<tr class="odd">
<td height="69" colspan="4">&nbsp;</td>
</tr>
<tr><td colspan="2">Assin. Dirigente:</td><td colspan="2">Assin. Secret&aacute;rio:</td></tr>
</tbody>
</table>

</div><!-- fim div lst_cad -->

<div id="footer">
	<?PHP echo "Templo SEDE: {$igreja->rua()}, N&ordm; {$igreja->numero()} - {$igreja->cidade()} - {$igreja->uf()}";?><br />

	  Copyright &copy; <a href="http://<?PHP echo "{$igreja->site()}";?>/" title="Copyright information"></a>
      Email: <a rel="nofollow" target="_blank" href="mailton: <?PHP echo "{$igreja->email()}";?>"><?PHP echo "{$igreja->email()}";?></a>
	  <?PHP echo "CNPJ: {$igreja->cnpj()}";?><br />
   		<?PHP echo "CEP: {$igreja->cep()} - Fone: {$igreja->fone()} - Fax: {$igreja->fax()}";?><br />
      <p>Designed by <a rel="nofollow" target="_blank" href="mailton: hiltonbruce@gmail.com">Joseilton Costa Bruce.</a></p>
    </div>

</body>
</html>
