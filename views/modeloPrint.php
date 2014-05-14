<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo 'Título';?></title>
<link rel="stylesheet" type="text/css" media="print, screen" href="../../igreja/tabs.css" />
</head>
<body>
<?PHP

	
	//Sede
	$sede	= new DBRecord ("igreja",'1',"rol");
	$dircon		= 'Pastor: '.$sede->pastor();
	$templo		= '<b>Templo Sede </b> ';
	?>
	<div id="header">
	<p>
	<?PHP
		echo $dircon.' -'.$templo;
		echo " - : {$sede->rua()}, N&ordm; {$sede->numero()} <br /> {$sede->cidade()} - {$sede->uf()} - CNPJ: {$sede->cnpj()} -
	CEP: {$sede->cep()} - Fone: {$sede->fone()} - Fax: {$sede->fax()}";?>
	 - Copyright &copy; <a rel="nofollow" href="http://<?PHP echo "{$sede->site()}";?>/" title="Copyright information">Site&nbsp;</a>
     - Email: <a href="mailto: <?PHP echo "{$sede->email()}";?>">Secretaria Executiva&nbsp;</a>
	</p>
</div>
	<?php
	
	require_once $nomeArquivo;
?>
</body>
</html>