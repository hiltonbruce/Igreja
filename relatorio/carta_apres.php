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
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Certid&atilde;o de Apresenta&ccedil;&atilde;o</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="style_apresentacao.css" />
<link rel="shortcut icon" type="image/ico" href="../img/br_igreja.gif">
</head>
<body>
<div id="container">
    <h1>Igreja Assembleia de Deus</h1>
<div id="mainnav">
<div id="foto"><?PHP printf ("<h5>Registro N&ordm;:</h5> %'03u",$most_certidao->rol());?></div>
  <div id="Tipo">
	  Certid&atilde;o de Apresenta&ccedil;&atilde;o
  </div>
  </div>
	<div id="content">
    <div id="added-div1">
      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Certifico que  foi apresentada, conforme o rito evang&eacute;lico, no dia <?PHP echo conv_valor_br ($most_certidao->dt_apresent());?>, a crian&ccedil;a  <strong><?PHP echo strtoupper( toUpper($most_certidao->nome()));?></strong>, do sexo <?PHP echo sexo($most_certidao->sexo());?>, nascid<?PHP echo a_ou_o ($most_certidao->sexo());?> no dia <?PHP echo conv_valor_br ($most_certidao->dt_nasc());?>, na maternidade: <?PHP echo $most_certidao->maternidade();?>, na cidade de <?PHP echo "{$cidade->nome()} - {$cidade->coduf()}";?>. Conforme certid&atilde;o de nascimento n&ordm; <?PHP echo $most_certidao->num_cert();?> / livro n&ordm; <?PHP echo $most_certidao->livro();?> / folha n&ordm; <?PHP echo $most_certidao->fl();?>. Filh<?PHP echo a_ou_o ($most_certidao->sexo());?> do Sr. <?PHP echo strtoupper( toUpper($most_certidao->pai()));?> e da Sra. <?PHP echo strtoupper( toUpper($most_certidao->mae()));?>.</p>
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