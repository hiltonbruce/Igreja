<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo $titTabela;?></title>
<link rel="stylesheet" type="text/css" href="../../tesouraria/style.css" />
<link rel="stylesheet" type="text/css" href="../../css/print.css" />
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.print.css" />
<link rel="icon" type="image/gif" href="../../br_igreja.jpg">
</head>
<body>
<div id="header">
	<p>
	<?PHP
	//print_r($igreja);
	echo "Templo SEDE: {$igreja->rua()}, N&ordm; {$igreja->numero()} <br /> $origem - {$igreja->uf()} - CNPJ: {$igreja->cnpj()}<br />
	CEP: {$igreja->cep()} - Fone: {$igreja->fone()} - Fax: {$igreja->fax()}";?>
	<br />Copyright &copy; <a rel="nofollow" href="http://<?PHP echo "{$igreja->site()}";?>/" title="Copyright information">Site&nbsp;</a>
    <br />Email: <a href="mailto: <?PHP echo "{$igreja->email()}";?>">Secretaria Executiva&nbsp;</a>
	</p>
</div>
	<?php
		require_once $nomeArquivo;
	?>
    <div id="footer">
    Copyright &copy; 2015  Designed by <a rel="nofollow" href="mailto: hiltonbruce@gmail.com">Joseilton Costa Bruce </a>
    </div>
</body>
</html>
