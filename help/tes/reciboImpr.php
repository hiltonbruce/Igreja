<?php
$recIni=0;
if (strstr($_POST["numeros"],',')) {
	//faz a quebra dos recibos
 $num = explode(',',$_POST["numeros"]);
}else {
	$num[] = $_POST["numeros"];
}

foreach ($num as $chave => $recNum) {
	//Montando o array com número dos recibos
	 if (strstr($recNum,'-')) {
	 	//Se há faixa de recidos os acrescenta ao array
	  	list($recIni,$recFin) = explode('-',$recNum);
	  	
	  	if ($recFin=='0' || $recFin=='') {
	  	 	$rec_num = new ultimoid('tes_recibo');//recupera o id do último insert no mysql (número do recibo)	
			$recFin = $rec_num->ultimo();
	  	}
	  	
	  	if ($recIni<$recFin) {
	  		
	  		$recFin = (($recFin-$recIni)>200) ? ($recIni+200):$recFin;
	  		
	  	  for ($i = $recIni; $i <= $recFin; $i++) {
	  	   $recibosArray[]=$i;
	  	  }
	  	}elseif ($recIni>0){
	  		$recibosArray[]=$recIni;
	  	}
	 }elseif ($recNum>0) {
	  $recibosArray[]=$recNum;
	 }
}
sort ($recibosArray);
$resultado = array_unique($recibosArray);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Recibo Tesouraria Templo Sede</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<?php 
	echo $scriptCSS;
?>
<link rel="SHORTCUT ICON" href="../ad.ico"  type="../image/vnd.microsoft.icon" />
</head>
<body>
<?php 
	foreach ($resultado as $chave => $numRec) {
	 require '../views/tesouraria/reciboModelPrint.php';
	 echo $saltoPagina;
	}
	//Loop p impressão de todos os recibos

?>
</body>
</html>