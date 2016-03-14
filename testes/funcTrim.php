<?php

$path = '1.234.5677,8';


$fileVirg  = substr(strrchr($path, ","), 0);
	//echo $fileVirg . "  fileVirg <br>";
$virgula = strlen($fileVirg);

$filePonto  = substr(strrchr($path, "."), 0);
//	echo $filename . "  filename <br>";
$ponto = strlen($filePonto);
	//echo $quantRetira . " quantRetira <br>";


$listCar = array('.',',');
$texto = "programador";
if ($virgula <='3' && $virgula >'1') {
	//echo substr($texto, 0,-$quantRetira) . " ** substr <br>";
	$file3 = substr($path, 0,-$virgula);
	//echo $file3. " ** file3  <br>";
	$filename2  = substr(strrchr($path, ","), 1);
	$listCar = array('.',',');
	$file4 = str_replace($listCar, '', $file3);
	//echo $filename2. " ** filename2  <br>";

	echo $file4.','.$filename2;

} elseif ($ponto<='3' && $ponto>'1') {
	//echo substr($texto, 0,-$quantRetira) . " ** substr <br>";
	$file3 = substr($path, 0,-$ponto);
	//echo $file3. " ** file3  <br>";
	$filename2  = substr(strrchr($path, "."), 1);
	$file4 = str_replace($listCar, '', $file3);
	//echo $filename2. " ** filename2  <br>";

	echo $file4.'.'.$filename2;

} else {

	$file4 = str_replace($listCar, '', $path );
	echo $file4;
}

?>
