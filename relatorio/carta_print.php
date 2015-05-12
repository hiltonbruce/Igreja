<?PHP
	session_start();
	require_once ("../func_class/classes.php");
	require_once ("../func_class/funcoes.php");
	controle("consulta");
  	$carta 			= new DBRecord ("carta",$_POST["id_carta"],"id");
	$membro 		= new DBRecord ("membro",$_POST['bsc_rol'],"rol");
	$est_civil 		= new DBRecord ("est_civil",$_POST['bsc_rol'],"rol");
	$ecles 			= new DBRecord ("eclesiastico",$_POST['bsc_rol'],"rol");
	$profissional	= new DBRecord ("profissional",$_POST['bsc_rol'],"rol");
	$igreja 		= new DBRecord ("igreja","1","rol");
	$cidadeNatal	= new DBRecord ("cidade",$membro->naturalidade(),"id");
	$cid_batismo 	= new DBRecord ("cidade",$ecles->local_batismo(),"id");
    $rol 			= $_POST["bsc_rol"];
    $cpf = (strlen($profissional->cpf())=='14') ? $profissional->cpf() : '*********' ;


    if ($igreja->cidade()>0) {
    		$cidOrigem = new DBRecord ("cidade",$igreja->cidade(),"id");
			$origem=$cidOrigem->nome();
		}else {
		 	$origem = $igreja->cidade();
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Carta de <?PHP echo carta($carta->tipo());?></title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="../css/bootstrap.print.css" />
<link rel="stylesheet" type="text/css" href="../css/docs.min.css" />
<link rel="icon" type="image/gif" href="../ad.ico">
</head>
<body>
<div id="container">
	<table>
		<tr>
			<td><img src="../img/logo.png" alt="Brasão Assembleia de Deus" width='387' height='125' ></td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>
			</td>
		</tr>
	</table>
  <div class='row'>
  <div class="col-md-4"></div>
  <div class="col-md-8 text-left">

   	</div>
  </div>
<div id="mainnav">
    <div id="foto">
  	<?PHP print mostra_foto($rol);?></div>
	<div id="Tipo">
	  <h2 class="text-primary"><u><strong>
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
		$intr .= '<div class="panel panel-default text-center">';
		$intr .= '	 <div class="panel-body">';
		$intr .= '	    DESTINO: '.$carta->igreja().', em '.$destino;
		$intr .= '	</div>';
		$intr .= '</div>';

	}else {
		$intr = "";
	}
  ?></strong></u></h2>
  </div>
  </div>
	<div id="content">
    <div id="added-div1">
			    <?PHP echo $intr;?>
    	<p>Sauda&ccedil;&otilde;es no Senhor:</p>

     	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Apresentamos a amada Igreja, <strong><?PHP
      	if ($membro->sexo()=="M"){
      			print " o irm&atilde;o: ";}
      		else {
      			print " a irm&atilde; ";} ?>
                </strong></p>
    <table class='table table-bordered'>
		<tbody>
			<tr>
				<td colspan='3'><h4><small>Nome:</small><br><?php print strtoupper( toUpper($membro->nome())); ?></h4></td>
				<td><h4><small>Rol</small><br><?php printf ("%'03u",$_POST['bsc_rol']); ?></h4></td>
				<td><h4><small>Est. Civil</small><br><?php print $est_civil->estado_civil(); ?></h4></td>
				<td><h4><small>Func. Eclesiast&iacute;ca:</small><br><?php print cargo($_POST['bsc_rol']); ?></h4></td>
			</tr>
			<tr>
				<td><h4><small>RG:</small><br><?php print $profissional->rg(); ?></h4></td>
				<td><h4><small>CPF:</small><br><?php echo $cpf; ?></h4></td>
				<td><h4><small>Data de Nasc.:</small><br><?php print conv_valor_br($membro->datanasc()); ?></h4></td>
				<td><h4><small>Naturalidade:</small><br><?php print $cidadeNatal->nome().'-'.$cidadeNatal->coduf(); ?></h4></td>
				<td><h4><small>Batismo</small><br><?php print conv_valor_br($ecles->batismo_em_aguas()); ?></h4></td>
				<td><h4><small>Membro Desde:</small><br><?php print conv_valor_br($ecles->dat_aclam()); ?></h4></td>
			</tr>
		</tbody>
	</table>
      	<p class='text-justify'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;E  serve ao Senhor nesta igreja, e por se achar em comunh&atilde;o, &eacute; que  recomendamos para que <?PHP
      	if ($membro->sexo()=="M"){
      	 print "o";}
      	 else {
      	 	print "a";} ?> recebais no Senhor como usam fazer os Santos.
      	 <p>
		<?php
			if ($carta->obs()!='') {
				?>
					 <fieldset>
						<legend>Observa&ccedil;&otilde;es:</legend>
						<p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?PHP echo $carta->obs(); ?></p>
					 </fieldset>
				<?php
			}else {

				echo '<br /><br />';
			}
		?>

    </div><br />

    <div id="data">
        <h4><?PHP echo $origem.' - '.$igreja->uf().", ".data_extenso (conv_valor_br($carta->data()));?></h4></div>
        <br /><br /><br />
	    <p>&nbsp;</p>
	    <p>&nbsp;</p>
	  <div id="pastor"><?PHP echo strtoupper(toUpper($igreja->pastor()));?><br />
	    Pastor da Igreja</div>
	  <div id="secretario"><?PHP echo strtoupper($_POST["secretario"]);?><br />
      Secret&aacute;rio </div>
<br><br><br><br><br><br>
	<div class='mensagem'>Alcan&ccedil;ando Vidas para Cristo</div>
	  <div id="vencimento">Esta carta deve ser apresentada a igreja destinat&aacute;ria at&eacute;:
        <?PHP
		echo data_venc(conv_valor_br($carta->data()));
		?> (validade)
	  </div>

    <div id="footer"><p class="text-center">
                        <?PHP echo "Templo SEDE: {$igreja->rua()}, N&ordm; {$igreja->numero()} - $origem - {$igreja->uf()}";?>
                          <?PHP echo " - CNPJ: {$igreja->cnpj()} - CEP: {$igreja->cep()} - Fone: {$igreja->fone()} <br />";?>
                          Copyright &copy; http://<?PHP echo "{$igreja->site()}";?> -
                          Email: <?PHP echo "{$igreja->email()}";?></p>
                         <p class="text-right"><small>Designed by <a rel="nofollow" target="_blank" href="mailton: hiltonbruce@gmail.com">
                            Joseilton Costa Bruce.</a></small></p>
    </div>
  </div>
</div>
</body>
</html>
