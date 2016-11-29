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
<div id="header">
	<p>
		<?PHP echo $dadosjgreja;?>
		<br />Copyright &copy; <a rel="nofollow" href="http://<?PHP echo $siteigreja;?>/" title="Copyright information">Site&nbsp;</a>
		<br />Email: <a href="mailto: <?PHP echo $emailigreja;?>">Secretaria Executiva&nbsp;</a>
	</p>
</div>
	<div id="content">
		<?php
			require_once $arquivo;
		?>
    </div>
    <div id="footer">
     Designed by <a rel="nofollow" href="mailto: hiltonbruce@gmail.com">Joseilton Costa Bruce </a>
    </div>
  </div>
	<?PHP
		echo $saltoPagina;
	?>
</body>
</html>
