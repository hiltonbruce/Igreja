<?PHP
	error_reporting(E_ALL);
	ini_set('display_errors', 'off');
	session_start();
	
	if ($_SESSION["setor"]<50 && $_SESSION["setor"]!=2){
		echo "<script> alert('Sem permissão de acesso! Entre em contato com o Tesoureiro!');location.href='../?escolha=adm/cadastro_membro.php&uf=PB';</script>";
		$_SESSION = array();
		session_destroy();
		header("Location: ./");
	}
	
	require_once ("../func_class/classes.php");
	require_once ("../func_class/funcoes.php");
	
	$igreja = new DBRecord ("igreja","1","rol");
	if ($_POST["nome"]=="" && $_POST["rol"]!="") {
		$nome = new DBRecord("membro",$_POST["rol"],"rol");
		$membro = $nome->nome();
	} else {
		$membro = $_POST["nome"];
	}
	
	foreach ($_POST as $key => $valor)
	{
		if (!empty($key) && ($valor > 0)){
			if (strstr($key, 'valor')) {
				$$key = number_format($valor, 2, ",", ".");
			}elseif (strstr($key, 'dia')) {
				$$key = sprintf("%02u",$valor);
			}
			
		}
			$chave[] = array($key=>$valor);
			// $$key.' - '.$valor;
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Envelope de D&iacute;zimo</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="SHORTCUT ICON" href="../ad.ico"  type="image/vnd.microsoft.icon" />
<style type="text/css">
<!--
#header { width:400px; height: 80px; background-image: url(../img/AssDeusEnvelope.png); background-repeat: no-repeat;
	 background-position: left bottom; margin: 0; padding: 0 10px 0 120px; text-align:right;}
	#header p { width:400px; height: 50px; padding: 10px 40px 0 220px; text-align:right; font-size: 70%;}
	table {	border-collapse: collapse;font-size: 70%;} 

th, td { 
		border: 1px solid #000;
		padding: 4px 10px;
		line-height: 1.2;
		}
#footer { font-size: 50%;}
a:link:after, a:visited:after {
	content:"("attr(href)")";
	font-size: 80%;
	color:#555555;
}
#content {

}

td#moeda {
	text-align:right;
}

td#centro {
	text-align:center;
}
</style>
</head>
<body>
<div >
  <div id="header">	<p>	Copyright &copy; <a href="http://<?PHP echo "{$igreja->site()}";?>/" title="Copyright information"> Assembleia de Deus </a><br />
  <?PHP echo "Templo SEDE: {$igreja->rua()}, N&ordm; {$igreja->numero()} <br /> {$igreja->cidade()} - {$igreja->uf()} - CNPJ: {$igreja->cnpj()}<br />
	CEP: {$igreja->cep()} - Fone: {$igreja->fone()} ";?> <br />
	
    Email: <a rel="nofollow" href="mailto: <?PHP echo "{$igreja->email()}";?>">Secretaria Executiva</a>	</p>
</div>
<div>
  <table>
     <tr>
      <td>Ano:<br />&nbsp;<br />&nbsp;<strong><?php echo $_POST["ano"];?></strong></td>
      <td>Rol:<br />&nbsp;<br />&nbsp;<strong><?php echo $_POST["rol"];?></strong></td>
      <td colspan="5">Nome:<br />&nbsp;<br />&nbsp;<strong><?php echo $membro;?></strong></td>
    </tr>
    <tr align="center" bgcolor="#CCCCCC">
      <td width="44"> <strong>Dia</strong></td>
      <td width="51"> <strong>M&ecirc;s</strong></td>
      <td width="90"> <strong>D&iacute;zimo</strong></td>
      <td width="81"> <strong>Oferta</strong></td>
      <td width="76"> <strong>Troco</strong></td>
      <td width="92"> <strong>Total</strong></td>
      <td width="172"> <strong>Assin. Tesoureiro </strong></td>
    </tr>
    <tr>
      <td id= "centro">&nbsp;<?php echo $diaJan;?></td>
      <td id= "centro">Jan</td>
      <td id='moeda'>&nbsp;<?php echo $valorJan;?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td id= "centro">&nbsp;<?php echo $diaFev;?></td>
      <td id= "centro">Fev</td>
      <td id='moeda'>&nbsp;<?php echo $valorFev;?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td id= "centro">&nbsp;<?php echo $diaMar;?></td>
      <td id= "centro">Mar</td>
      <td id='moeda'>&nbsp;<?php echo $valorMar;?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td id= "centro">&nbsp;<?php echo $diaAbr;?></td>
      <td id= "centro">Abr</td>
      <td id='moeda'>&nbsp;<?php echo $valorAbr;?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td id= "centro">&nbsp;<?php echo $diaMai;?></td>
      <td id= "centro">Mai</td>
      <td id='moeda'>&nbsp;<?php echo $valorMai;?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td id= "centro">&nbsp;<?php echo $diaJun;?></td>
      <td id= "centro">Jun</td>
      <td id='moeda'>&nbsp;<?php echo $valorJun;?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td id= "centro">&nbsp;<?php echo $diaJul;?></td>
      <td id= "centro">Jul</td>
      <td id='moeda'>&nbsp;<?php echo $valorJul;?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td id= "centro">&nbsp;<?php echo $diaAgo;?></td>
      <td id= "centro">Ago</td>
      <td id='moeda'>&nbsp;<?php echo $valorAgo;?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td id= "centro">&nbsp;<?php echo $diaSet;?></td>
      <td id= "centro">Set</td>
      <td id='moeda'>&nbsp;<?php echo $valorSet;?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td id= "centro">&nbsp;<?php echo $diaOut;?></td>
      <td id= "centro">Out</td>
      <td id='moeda'>&nbsp;<?php echo $valorOut;?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td id= "centro">&nbsp;<?php echo $diaNov;?></td>
      <td id= "centro">Nov</td>
      <td id='moeda'>&nbsp;<?php echo $valorNov;?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td id= "centro">&nbsp;<?php echo $diaDez;?></td>
      <td id= "centro">Dez</td>
      <td id='moeda'>&nbsp;<?php echo $valorDez;?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
	<div id="content">"...porque Deus ama ao que d&aacute; com alegria" (II Co 9.7) </div>
    <div id="footer">
     Designed by <a rel="nofollow" href="mailto: hiltonbruce@gmail.com">Joseilton Costa Bruce.</a>
     
    </div>
</div>
</body>
</html>
	