<?php

if (!empty($_GET['gerar'])) {
	$dir ='img_membros/' ;
	$dh = opendir($dir);
		#print_r(array_reverse(scandir($dir)));
		#$arq = array();

		// loop que busca todos os arquivos até que não encontre mais nada
		$arq = array();
		while (false !== ($filename = readdir($dh))) {
		// verificando se o arquivo é .jpg
			if (substr($filename,-4) == ".jpg") {
				// mostra o nome do arquivo e um link para ele - pode ser mudado para mostrar diretamente a imagem :)
				$arq[] = $filename;
			}else {
			   	unlink($dir.$filename);
			}
		}

	$bkpFotos = new ArquivoZip();
	$bkpFotos->Backup_fotos($arq, true, true);
}
	require_once 'help/bkpFotos.php'
?>
