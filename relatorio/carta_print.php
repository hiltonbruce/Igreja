<?PHP
	session_start();
	error_reporting(0);
	ini_set(“display_errors”, 0 );
  require "../func_class/funcoes.php";
  require "../func_class/classes.php";
  function __autoload ($classe) {
    list($dir,$nomeClasse) = explode('_', $classe);
    if (file_exists("../models/$dir/$classe.class.php")){
        require_once ("../models/$dir/$classe.class.php");
    }elseif (file_exists("../models/$classe.class.php")){
        require_once ("../models/$classe.class.php");
    }
  }
	controle("consulta");
  $carta 			= new DBRecord ("carta",$_POST["id_carta"],"id");
	$membro 		= new DBRecord ("membro",$_POST['bsc_rol'],"rol");
	$est_civil 		= new DBRecord ("est_civil",$_POST['bsc_rol'],"rol");
	$ecles 			= new DBRecord ("eclesiastico",$_POST['bsc_rol'],"rol");
	$profissional	= new DBRecord ("profissional",$_POST['bsc_rol'],"rol");
	$igreja 		= new DBRecord ("igreja","1","rol");
	$cidade = new cidade ();
	$cidCad = $cidade->arrayCidade();
	
    if (is_numeric($membro->naturalidade())) {
        $cidadeNatal = new DBRecord ("cidade",$membro->naturalidade(),"id");
        $cidNatal =  $cidadeNatal->nome().' - '.$cidadeNatal->coduf();
    } else {
        $cidNatal = $membro->naturalidade();
    }
 //   $cidNatal = ($cidadeNatal->nome()=='') ? $membro->naturalidade() : $cidadeNatal->nome().' - '.$cidadeNatal->coduf() ;
	$cid_batismo 	= new DBRecord ("cidade",$ecles->local_batismo(),"id");
  $rol 			= $_POST["bsc_rol"];
  $cpf = (strlen($profissional->cpf())=='14') ? $profissional->cpf() : '*********' ;
  // $cargoIgreja = new tes_cargo();
  // $dadosCargo = $cargoIgreja->dadosArray();
	// var_dump($cargoIgreja);
  // $cargoIgrejas = $cargoIgreja->dadosCargo();
	$cargosPR = new DBRecord ("funcao",'13',"id");

	if ($dadosCargo['7']['1'][$_POST["secretario"]]['nome']=='') {

		if ($_POST["secretario"]=='1' ) {
			$sec1 = new DBRecord ('membro',$igreja->secretario1(),"rol") ;
			$secretario = $sec1->nome();
			$cargo = ($sec1->sexo()=='M') ? '&ordm; Secret&aacute;rio' : '&ordf; Secret&aacute;ria' ;
		} elseif ($_POST["secretario"]=='2') {
			$sec1 = new DBRecord ('membro',$igreja->secretario2(),"rol") ;
			$secretario = $sec1->nome();
			$cargo = ($sec1->sexo()=='M') ? '&ordm; Secret&aacute;rio' : '&ordf; Secret&aacute;ria' ;
		} else {
			$secretario ='';
			$cargo = '&ordm; Secret&aacute;rio(a)';
		}
	} else {
		$secretario = $dadosCargo['7']['1'][$_POST["secretario"]]['nome'];
		$cargo = ($dadosCargo['7']['1'][$_POST["secretario"]]['sexo']=='M') ? '&ordm; Secret&aacute;rio' : '&ordf; Secret&aacute;ria' ;
	}

 // print_r($dadosCargo);
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
	<table style="width: 100%;">
		<tr>
			<td>
				<br>
				<img src="../img/logoCarta.png" alt="Bras�o Assembleia de Deus" height='125' >
			</td>
			<td class="text-right" style="vertical-align: text-top;" >
				<h4><?php echo NOMEIGR;?></h4>
				<h5>
					<?php
						echo $igreja->rua();
						echo ', N&ordm; '.$igreja->numero();
						echo '-'.$cidCad[$igreja->cidade()]['cidade'];
						echo '-'.$cidCad[$igreja->cidade()]['uf'].'<br/>CEP: '.$igreja->cep().'';
						if ($igreja->fone() != null) {
							echo ' &bull; Fone: '.$igreja->fone().'<br/>';
						}else{
							echo '<br/>';
						}
						echo 'CNPJ: '.$igreja->cnpj();
						echo '<br/>Email: '.$igreja->email();
					?>					
				</h5>
		</td>
		</tr>
	</table>
  <!-- <div class='row'>
	<div class="col-md-5"><img src="../img/logoCarta.png" alt="Bras�o Assembleia de Deus" width='387' height='125' ></div>
	<div class="col-md-5 text-right">
		<div class="row">
			<div class="col-md-12">
			<h4>Templo SEDE</h4>
				<h5>
					<?php
						// echo $igreja->rua();
						// echo ', N&ordm;'.$igreja->numero();
						// echo ' - '.$cidCad[$igreja->cidade()]['cidade'];
						// echo ' - '.$cidCad[$igreja->cidade()]['uf'];
						// echo '<br/>Fone:'.$igreja->fone();
						// echo '<br/>CEP:'.$igreja->cep();
						// echo ' / CNPJ: '.$igreja->cnpj();
						// echo '<br/>Email: '.$igreja->email();
					?>					
				</h5>
			</div>
		</div>
	</div>
  </div> -->
	<div id="mainnav">
    <div id="foto">
  	<?PHP print mostra_foto($rol);?></div>
	<div id="Tipo">
	  <h2 class="text-primary">
	  	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <u>
		  <strong>
		  Carta <?PHP //Tipo de carta - Recomenda��o ou Mudan�a
			print carta ("{$carta->tipo()}");
			$destino = (int)$carta->destino();
			if ((int)$carta->destino() != 0) {
					$cidade = new DBRecord ("cidade",$carta->destino(),"id");
					$destino=$cidade->nome()." - ".$cidade->coduf();
				}else {
					$destino = $carta->destino();
				}

			if ($carta->tipo()!=="3") {
				$intr .= '<div class="panel-default text-center">';
				$intr .= '	 <div class="panel-body">';
				$intr .= '	    DESTINO: '.$carta->igreja().', em '.$destino;
				$intr .= '	</div>';
				$intr .= '</div>';
			}else {
				$intr = "";
			}
			?></strong>
		</u>
	</h2>
  </div>
  </div>
    <div id="added-div1">
		<?PHP echo $intr;?>
    	<p>Sauda&ccedil;&otilde;es no Senhor:</p>

     	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Apresentamos:</p>
    <table class='table table-bordered' >
		<tbody>
			<tr>
				<td colspan='3'><h4><small>Nome:</small><br><?php print strtoupper( toUpper($membro->nome())); ?></h4></td>
				<td><h4><small>Rol:</small><br><?php printf ("%'03u",$_POST['bsc_rol']); ?></h4></td>
				<td><h4><small>Est. Civil:</small><br><?php print $est_civil->estado_civil(); ?></h4></td>
				<td><h4><small>Func. Eclesiast&iacute;ca:</small><br><?php print cargo($_POST['bsc_rol'])['0']; ?></h4></td>
			</tr>
			<tr>
				<td><h4><small>RG:</small><br><?php print $profissional->rg(); ?></h4></td>
				<td><h4><small>CPF:</small><br><?php echo $cpf; ?></h4></td>
				<td><h4><small>Data de Nasc.:</small><br><?php print conv_valor_br($membro->datanasc()); ?></h4></td>
				<td><h4><small>Naturalidade:</small><br><?php print $cidNatal; ?></h4></td>
				<td><h4><small>Batismo:</small><br><?php print conv_valor_br($ecles->batismo_em_aguas()); ?></h4></td>
				<td><h4><small>Membro Desde:</small><br><?php print conv_valor_br($ecles->dat_aclam()); ?></h4></td>
			</tr>
		</tbody>
	</table>
      	<p class='text-justify'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  Que serve ao Senhor nesta igreja, e por se achar em comunh&atilde;o, &eacute; que recomendamos.
      	 <p>
		<?php
			if ($carta->obs()!='') {
				?>
						<span class='text-left'><strong>Obs.:</strong>
						<em> &nbsp;<?PHP echo $carta->obs(); ?></em></span>
				<?php
			}else {

				echo '<br />';
			}

			list ($dataCarta,$horaCarta) = explode (' ',$carta->data());
		?>

    <div id="data">
        <h4><?PHP echo $origem.' - '.$igreja->uf().", ".data_extenso (conv_valor_br($dataCarta));?></h4>
    </div>
	    <p>&nbsp;</p>
	    <p>&nbsp;</p>
	  <div id="pastor"> 
	  <table  style="width: 100%;">
			<tbody>
			<tr>
				<td>
					<!-- <img src="../imgAssin/assinPastor.png" width="" height="">  -->
					______________________________________<br />
					<?PHP echo $igreja->pastor();?><br />
					<?php echo $cargosPR->descricao();?>
				</td>
				<td>&nbsp;</td>
				<td>
					<!-- <img src="../imgAssin/2242.png" width="" height=""> -->
					______________________________________<br />
					<?PHP
					$cargoSec = ($secretario!='') ? cargo ($sec1->rol())['1'].' ' : '' ;
						echo  $cargoSec.$secretario;
					?><br />
					<?php echo $_POST["secretario"].$cargo;?> 
				</td>
			</tr>
			</tbody>
	  </table>
	</div>
	    </div>

	  <div id="vencimento"><br />Esta carta deve ser apresentada a igreja destinat&aacute;ria at&eacute;:
        <?PHP
		echo data_venc(conv_valor_br($dataCarta));
		?> (validade)
	  </div>
    <div id="footer">
        <h6><span class="text-center">
		<div class='mensagem'>Alcan&ccedil;ando Vidas para Cristo</div>
     
        <h5><p class="text-right"><small>Designed by<a rel="nofollow" target="_blank"
        href="mailton: hiltonbruce@gmail.com">Joseilton Costa Bruce</a></small></p></h5>
    </div>
  </div>
</div>
</body>
</html>
