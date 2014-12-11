<?PHP
	session_start();
	
	require_once ("../func_class/classes.php");
	require_once ("../func_class/funcoes.php");
	
	controle ("inserir");
	
	$igreja = new DBRecord ("igreja","1","rol");
	
	//echo "<h1>Teste 1 - ".$_POST["id"]."</h1>";
	
	if (empty($_POST["id"]) && isset($_POST["nome"])) {
	
		$dt_nasc = br_data ($_POST["dt_nasc"],"dt_nasc");
		$dt_apresent = br_data ($_POST["dt_apresent"],"dt_apresent");
		$value="'','{$_POST["id_cong"]}','{$_POST["nome"]}','{$_POST["pai"]}','{$_POST["rol_pai"]}',
				'{$_POST["mae"]}','{$_POST["rol_mae"]}','$dt_nasc','{$_POST["maternidade"]}',
				'{$_POST["sexo"]}','{$_POST["cidade"]}','{$_POST["uf"]}','{$_POST["fl"]}','{$_POST["livro"]}',
				'$dt_apresent','{$_POST["num_cert"]}','{$_POST["obs"]}',NOW(),'{$_SESSION['valid_user']}: {$_SESSION['nome']}'";
		$cert_apresentacao = new insert ("$value","cart_apresentacao");
		$cert_apresentacao->inserir();
		$most_certidao = new DBRecord ("cart_apresentacao",mysql_insert_id(),"rol");
		
	} else {
	
		$most_certidao = new DBRecord ("cart_apresentacao",$_POST["rol"],"rol");
	}
	
	//echo "<h1>TESTE ".$most_certidao->nome()." - Post ".$_GET["id"]."</h1>";
	
	//if (isset($most_certidao->nome())) {
	
	$cidade = new DBRecord ("cidade",$most_certidao->cidade(),"id");
	
	if ($most_certidao->sexo()=="F") {
		$estilo = "menina";
	}elseif ($most_certidao->sexo()=="M"){
		$estilo = "menino";
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Certid&atilde;o de Apresenta&ccedil;&atilde;o</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo $estilo;?>.css" />
<link rel="shortcut icon" type="image/ico" href="../ad.ico" />
</head>
<body>
<div id="container">
-    <h1>Igreja Assembleia de Deus</h1>
  <div id="header"></div>
<div id="mainnav">
  <div id="Tipo">
	  Certid&atilde;o de Apresenta&ccedil;&atilde;o
  </div>
  <div id="foto"><?PHP printf ("<h4>Registro N&ordm;:</h4> %'05u",$most_certidao->rol());?></div>
  </div>
	<div id="content">
    <div id="added-div1">
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Certifico que a folha n&ordm; <u><b>&nbsp;<?PHP echo $most_certidao->fl();?>&nbsp;</b></u>
		 do livro n&ordm; <u><b>&nbsp;<?PHP echo $most_certidao->livro();?>&nbsp;</b></u> de crian&ccedil;as, filhos de membros da igreja, consta
		  que foi apresentada, conforme o rito evang&eacute;lico, no dia <?PHP echo conv_valor_br ($most_certidao->dt_apresent());?>
		  , a crian&ccedil;a  <u><b>&nbsp;<?PHP echo strtoupper( toUpper($most_certidao->nome()));?></b></u>,
		   do sexo <?PHP echo sexo($most_certidao->sexo());?>, nascid<?PHP echo a_ou_o ($most_certidao->sexo());?> no dia
		<?PHP echo conv_valor_br ($most_certidao->dt_nasc());?>. Filh<?PHP echo a_ou_o ($most_certidao->sexo());?>
		do Sr. <?PHP echo strtoupper( toUpper($most_certidao->pai()));?> e da Sra. <?PHP echo strtoupper( toUpper($most_certidao->mae()));?>.
	</p>
    </div>
    <div id="added-div-2">

      <h3><?PHP  print $igreja->cidade()." - ".$igreja->uf().", ".data_extenso (date("d/m/Y"));?></h3>
    <br />
		<div id="pastor"><?PHP echo strtoupper( toUpper($igreja->pastor()));?><br />
	    Pastor da Igreja</div>
	  <div id="secretario"><?PHP echo strtoupper( toUpper($_POST["secretario"]));?><br />
      Secret&aacute;rio </div>
    </div>

  </div>
 <div id="footer">
	<?PHP echo "Templo SEDE: {$igreja->rua()}, N&ordm; {$igreja->numero()} - {$igreja->cidade()} - {$igreja->uf()}";?>
	  Copyright &copy; <a href="http://<?PHP echo "{$igreja->site()}";?>/" title="Copyright information"></a>
      Email: <a rel="nofollow" target="_blank" href="mailton: <?PHP echo "{$igreja->email()}";?>"><?PHP echo "{$igreja->email()}";?></a>
	   <?PHP echo "CNPJ: {$igreja->cnpj()}";?><br />
   		<?PHP echo "CEP: {$igreja->cep()} - Fone: {$igreja->fone()}";?><br />
	  <p style='text-align:right;'>Designed by <a rel="nofollow" target="_blank" href="mailton: hiltonbruce@gmail.com">Joseilton Costa Bruce</a></p>
    </div>
</div>
</body>
</html>
<?PHP
// Fim do if (isset (trim ($most_certidao->nome()))
/*
} else {
	echo "<h1>Infome os Dados!</h1>";
}
*/