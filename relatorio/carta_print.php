<?PHP
	session_start();
	require_once ("../func_class/classes.php");
	require_once ("../func_class/funcoes.php");
	controle("consulta");
  	$carta 			= new DBRecord ("carta",$_POST["id_carta"],"id");
	$membro 		= new DBRecord ("membro",$_SESSION["rol"],"rol");
	$est_civil 		= new DBRecord ("est_civil",$_SESSION["rol"],"rol");
	$ecles 			= new DBRecord ("eclesiastico",$_SESSION["rol"],"rol");
	$igreja 		= new DBRecord ("igreja","1","rol");
	$cid_batismo 	= new DBRecord ("cidade",$ecles->local_batismo(),"id");
    $rol 			= $_POST["bsc_rol"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Carta de <?PHP echo carta($carta->tipo());?></title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="icon" type="image/gif" href="../img/br_igreja.gif">
</head>
<body>
<div id="container">
  <div id="header"></div>
<div id="mainnav">
    <div id="foto">
  	<?PHP print mostra_foto($rol);?></div>
	<div id="Tipo">
	  <h3>
	Carta <?PHP //Tipo de carta - Recomendação ou Mudança
	print carta ("{$carta->tipo()}");
	
	$destino = (int)$carta->destino();
	
	 if ((int)$carta->destino() != 0) {
			$cidade = new DBRecord ("cidade",$carta->destino(),"id");
			$destino=$cidade->nome()." - ".$cidade->coduf();
		}else {
		 	$destino = $carta->destino();
		}
	
	if ($carta->tipo()!=="3") {
		$intr = "a {$carta->igreja()}, em $destino,";
	}else {
		$intr = "";
	}
  ?></h3>
  </div>
  </div>
	<div id="content">
    <div id="added-div1">
      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Apresentamos <?PHP echo $intr; if ($membro->sexo()=="M"){ print " o irm&atilde;o ";} else {print " a irm&atilde; ";} print strtoupper( toUpper($membro->nome())).", ".$est_civil->estado_civil();?>,   <?PHP print cargo($_SESSION["rol"]); ?> da Igreja desde <?PHP print conv_valor_br((cargo_dt ())); ?>, com cadastro no Rol de membros sob o n&ordm; <?PHP printf ("%'03u",$_SESSION["rol"]); ?>, teve seu  batismo em &aacute;guas na cidade de <?PHP print "{$cid_batismo->nome()} - {$cid_batismo->coduf()} no dia ".conv_valor_br($ecles->batismo_em_aguas());?>. E  serve ao Senhor nesta igreja, e por se achar em comunh&atilde;o, &eacute; que  recomendamos para que <?PHP if ($membro->sexo()=="M"){ print "o";} else {print "a";} ?> recebais no Senhor como ousam fazer os Santos.</p>
      <fieldset>
	  <legend>Observa&ccedil;&otilde;es:</legend>
      <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?PHP echo $carta->obs(); ?>.</p>
	  </fieldset>
    </div>
    <div id="added-div-2">
      <h3><?PHP  print $igreja->cidade()." - ".$igreja->uf().", ".data_extenso (conv_valor_br($carta->data()));?></h3>
      <p>&nbsp;</p>
      <p class="bottom">&nbsp;</p>
	  <div id="pastor"><?PHP echo strtoupper(toUpper($igreja->pastor()));?><br />
	    Pastor da Igreja</div>
	  <div id="secretario"><?PHP echo strtoupper($_POST["secretario"]);?><br />
      Secret&aacute;rio </div>
	  <div id="vencimento">Esta carta deve ser apresentada a igreja destinat&aacute;ria at&eacute;:
        <?PHP 
		echo data_venc(conv_valor_br($carta->data()));
		?> (validade)
	  </div>
    </div>
    <div id="footer">
	<?PHP echo "Templo SEDE: {$igreja->rua()}, N&ordm; {$igreja->numero()} - {$igreja->cidade()} - {$igreja->uf()}";?><br />

	  Copyright &copy; <a href="http://<?PHP echo "{$igreja->site()}";?>/" title="Copyright information"></a>
      Email: <a rel="nofollow" target="_blank" href="mailton: <?PHP echo "{$igreja->email()}";?>"><?PHP echo "{$igreja->email()}";?></a> <br />
	   <?PHP echo "CNPJ: {$igreja->cnpj()}";?><br />
   		<?PHP echo "CEP: {$igreja->cep()} - Fone: {$igreja->fone()} - Fax: {$igreja->fax()}";?><br />
	  <p>Designed by <a rel="nofollow" target="_blank" href="mailton: hiltonbruce@gmail.com">Joseilton Costa Bruce.</a></p>
    </div>
  </div>
</div>
</body>
</html>
