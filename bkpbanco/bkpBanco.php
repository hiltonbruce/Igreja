<?PHP
	$nomeBanco = 'assembleia'.date('dmYHi');
	system('mysqldump -h localhost -uigreja -pG4Hd%VKC#yV5Fc[at8c assembleia > '.$nomeBanco.'.sql');
?>