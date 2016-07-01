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
?>