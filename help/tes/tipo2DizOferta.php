<?php
if ($_POST['oferta']!='') {
	$valor = strtr( str_replace(".","",$_POST["oferta"]), ',','. ' );
	$value  = "'','','701','1','2','{$_POST["igreja"]}','{$_POST["roloferta"]}','{$_POST["nomeoferta"]}','$valor}',";
	$value .= "'$y-$m-$d','$sem','$m','$y','{$_POST["igreja"]}','{$_SESSION['valid_user']}',";
	$value .= "'$tesoureiro2','{$_POST["obs"]}',NOW(),'$hist'";	
	$dados = new insert ($value,"dizimooferta");
	$dados->inserir();
}
if ($_POST['ofertaext']!='') {
	$valor = strtr( str_replace(".","",$_POST["ofertaext"]), ',','. ' );
	$value  = "'','','702','1','3','{$_POST["igreja"]}','{$_POST["rolext"]}','{$_POST["nomeext"]}','$valor',";
	$value .= "'$y-$m-$d','$sem','$m','$y','{$_POST["igreja"]}','{$_SESSION['valid_user']}',";
	$value .= "'$tesoureiro2','{$_POST["obsext"]}',NOW(),'$hist'";	
	$dados = new insert ($value,"dizimooferta");
	$dados->inserir();
}
?>