<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $titulo;?></title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<?php echo $scriptCSS;?>
<link rel="SHORTCUT ICON" href="<?php echo $icone;?>"  type="image/vnd.microsoft.icon" />
</head>
<body>
<div id="container">
	<div id="content">
		<?php
			require $arquivo;
		?>
	</div>
    <div id="footer">
	<?PHP echo "Templo SEDE: {$sede->rua()}, N&ordm; {$sede->numero()} - $origem - {$sede->uf()}";?><br />
	  Copyright &copy; <a href="http://<?PHP echo "{$sede->site()}";?>/" title="Copyright information"></a>
      Email: <a rel="nofollow" target="_blank" href="mailton: <?PHP echo "{$sede->email()}";?>"><?PHP echo "{$sede->email()}";?></a> <br />
	   <?PHP echo "CNPJ: {$sede->cnpj()}";?><br />
   		<?PHP echo "CEP: {$sede->cep()} - Fone: {$sede->fone()} - Fax: {$sede->fax()}";?><br />
	  <p>Designed by <a rel="nofollow" target="_blank" href="mailton: hiltonbruce@gmail.com">Joseilton Costa Bruce.</a></p>
    </div>
  </div>
	<?PHP
		echo $saltoPagina;
	?>
</body>
</html>
