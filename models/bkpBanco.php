<?PHP
#	require_once '../func_class/constantes.php';
	$nomeBanco = 'assembleia'.date('dmYHi').'.sql';
	system('mysqldump -h '.$servidor.' -u'.$user.' -p'.$senha.' '.$bancoD.' > bkpbanco/'.$nomeBanco);
/*
$local_file = 'bkpbanco/';
$download_file = $nomeBanco;
sleep(10);

   $path = $local_file;
   $diretorio = dir($path);
    
    echo "Lista de Arquivos do diretório '<strong>".$path."</strong>':<br />";    
   while($arquivo = $diretorio -> read()){
      echo "<a href='".$path.$arquivo."'>".$arquivo."</a><br />";
   }
   $diretorio -> close();
*/
sleep(10);

// variável que define o diretório das imagens
$dir = "./bkpbanco/";

// esse seria o "handler" do diretório
$dh = opendir($dir);

// loop que busca todos os arquivos até que não encontre mais nada
while (false !== ($filename = readdir($dh))) {
// verificando se o arquivo é .jpg
	if (substr($filename,-4) == ".sql") {
	// mostra o nome do arquivo e um link para ele - pode ser mudado para mostrar diretamente a imagem :)
	echo '<a href='.$dir.'\\'.$filename.'><img src="img/bkp.ico" width="24px" height="24px"/> '.$filename.'</a><br>';
	}
}
?>