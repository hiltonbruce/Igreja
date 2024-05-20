<?PHP
	session_start();
	require "../../help/impressao.php";//Include de func�es, classes e conex�es com o BD
	controle ("inserir");
  $secretario = new DBRecord ("membro",$_POST["secretario"],"rol");
  $cidOrigem = new DBRecord ("cidade",$igreja->cidade(),"id");
	$dadosIgreja = new igreja();
	$listInfIgr = $dadosIgreja->Arrayigreja();
	$rol = intval($_POST["rol"]);
	//echo "<h1>Teste 1 - ".$_POST["id"]."</h1>";
	if (!empty($_POST["rol"]) && !empty($_SESSION['valid_user'])) {
		$most_certidao = new sec_membro ($rol);
		$resultDados = $most_certidao->dadosMembro();
	// 	echo "<h1>TTTTTTTT</h1>";
	// var_dump($resultDados);
	} else {
		exit;
	}
	//echo "<h1>TESTE ".$most_certidao->nome()." - Post ".$_GET["id"]."</h1>";
	//if (isset($most_certidao->nome())) {
	$cidade = new DBRecord ("cidade",$resultDados['local_batismo'],"id");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Certid&atilde;o de Apresenta&ccedil;&atilde;o</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../../css/batismo.css" />
<link rel="shortcut icon" type="image/ico" href="../../ad.ico" />
</head>
<body>
<div id="container">
  <div id="header">
		<div id='headerApres'>
			<div id="nomeIgreja">
			  <!-- <?php echo NOMEIGR; ?> -->
				Certid&atilde;o de Batismo
		  </div>
		</div>
	</div>
<div id="mainnav">
  <div id="Tipo">
		<?php
			echo "<h3>".$resultDados['nome']." TTTTT</h3>";
		?>
  </div>
  <div id="foto"><?PHP printf ("<h4>Rol N&ordm;:</h4> %'05u",$resultDados['rol']);?></div>
  </div>
	<div id="content">
    <div id="added-div1">
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Certifico que conforme certid&atilde;o de nascimento n&ordm; <u><b><?PHP echo $most_certidao->num_cert();?></b></u>,
    	  folha n&ordm; <u><b>&nbsp;<?PHP echo $most_certidao->fl();?>&nbsp;</b></u>
		 do livro n&ordm; <u><b>&nbsp;<?PHP echo $most_certidao->livro();?>&nbsp;</b></u>, foi
		  apresentada ao Senhor, conforme o rito evang&eacute;lico, no dia <?PHP echo conv_valor_br ($most_certidao->dt_apresent());?>,
		   a crian&ccedil;a  <u><b><?PHP echo strtoupper( toUpper($most_certidao->nome()));?></b></u>,
		   do sexo <?PHP echo sexo($most_certidao->sexo());?>, nascid<?PHP echo a_ou_o ($most_certidao->sexo());?> no dia
		<?PHP echo conv_valor_br ($most_certidao->dt_nasc());?>, filh<?PHP echo a_ou_o ($most_certidao->sexo());?>
		do Sr. <?PHP echo strtoupper( toUpper($most_certidao->pai()));?> e da Sra. <?PHP echo strtoupper( toUpper($most_certidao->mae()));?>.
	</p>
    </div>
    <div id="added-div-2">
		<div id='comadep'></div>
      <h3>
		<?PHP  
		print $cidOrigem->nome()." - ".$cidOrigem->coduf().", ".data_extenso (conv_valor_br ($most_certidao->data()));
		?>
	</h3>
    	<br />
		<div id="pastor">
			<?PHP echo strtoupper( toUpper($igreja->pastor()));?><br />
			Pastor da Igreja
	    </div>
	 	 <?PHP
		 		if ($most_certidao->id_cong()>'1') {
		 			$congreg = 'Congrega&ccedil;&atilde;o: '.$listInfIgr[$most_certidao->id_cong()]['0'].' - ';
		 		} else {
		 			$congreg ='';
		 		}
        $assinSecret  = '../imgAssin/'.$secretario->rol().'a.png';
        if (!file_exists($assinSecret)){
          $assinSecret  = '../imgAssin/noAssin.png';
        }
    ?>
      <div id='assinSec'>
          <img src=<?PHP echo $assinSecret;?> width="300" height="100"/>
      </div>
      <div id="secretario">
	        <?PHP
						$cargo = (cargo($secretario->rol())=='Mb') ? '' : cargo($secretario->rol()) ;
						echo $cargo.' '.strtoupper( toUpper($secretario->nome()));
					?>
					<br />
					<?php
						if ($secretario->nome()=='M') {
							echo 'Secret&aacute;rio';
						} else {
							echo 'Secret&aacute;ria';
						}

					 ?>

      </div>
			<div id="footer">
					<span class="text-center">
					<?PHP echo $congreg.'Templo SEDE: '.$igreja->rua().', N&ordm; '.$igreja->numero().' - '.$cidOrigem->nome().' - '.$cidOrigem->coduf();?>
					<?PHP echo " - CNPJ: {$igreja->cnpj()} - CEP: {$igreja->cep()}<br />";?></span>
					Copyright &copy; http://<?PHP echo "{$igreja->site()}";?> - Email: <?PHP echo "{$igreja->email()}";?>
					&bull; <small>Designed by <a rel="nofollow" target="_blank"
					href="mailton: hiltonbruce@gmail.com">Joseilton Costa Bruce</a></small>
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
