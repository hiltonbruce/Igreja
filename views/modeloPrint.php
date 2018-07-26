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
<?php
  setlocale(LC_ALL, "pt_BR","pt_BR.UTF-8","portuguese");
  if (isset($_GET['rec']) && $_GET['rec']>'0') {
    ?>
    <style type="text/css">
    body {
      font-size: 12px;
    }
    </style>
    <?php
  }

 ?>
</head>
<body>
<div id="header" style="font-size : 10px;">
	<p>
	<?PHP
	//print_r($igreja);
	echo "Templo SEDE: {$igSede->rua()}, N&ordm; {$igSede->numero()} <br /> $origem - {$igSede->uf()} - CNPJ: {$igSede->cnpj()}<br />
	CEP: {$igSede->cep()} - Fone: {$igSede->fone()} - Fax: {$igSede->fax()}";?>
	<br />Copyright &copy; <a rel="nofollow" href="http://<?PHP echo "{$igSede->site()}";?>/" title="Copyright information">Site&nbsp;</a>
    <br />Email: <a href="mailto: <?PHP echo "{$igSede->email()}";?>">Secretaria Executiva&nbsp;</a>
	</p>
</div>
	<?php
		require_once $nomeArquivo;
	?>
    <div id="footer">
    Copyright &copy; 2016  Designed by <a rel="nofollow" href="mailto: hiltonbruce@gmail.com">Joseilton Costa Bruce </a>
  </div>
</body>
</html>
