<?PHP
	require_once '../func_class/constantes.php';
	$nomeBanco = 'assembleia'.date('dmYHi');
	system('mysqldump -h '.$servidor.' -u'.$user.' -p'.$senha.' '.$bancoD.' > ../bkpbanco/'.$nomeBanco.'.sql');
?>