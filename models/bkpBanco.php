<?PHP
#	require_once '../func_class/constantes.php';
if (!empty($_GET['gerar'])) {
	# Caso tenha sido inicializado sera realizado o Backup
	$nomeBanco = 'assembleia'.date('YmdHis').'.sql';
	mysql_query('TRUNCATE TABLE transcheck') or die(mysql_error());
	system('mysqldump -h '.DBPATH.' -u'.DBUSER.' -p'.DBPASS.' '.DBNAME.' > bkpbanco/'.$nomeBanco);
	sleep(5);
	// Abre o arquivo Backup
	$cabArqu  = "CREATE DATABASE  IF NOT EXISTS `assembleia`; \n";
	$cabArqu .= "USE `assembleia`;\n \n";
	$cabArqu .= "-- Sistema Administrativo e Financeiro para Igrejas Evangélicas \n";
	$cabArqu .= "-- Criado por: Joseilton Costa Bruce (hiltonbruce@gmail.com) Database: assembleia \n";
	$cabArqu .= "-- Em: ".date('d/m/Y H:i:s')."\n \n-- ";

	$fp = fopen('bkpbanco/'.$nomeBanco, 'r+');
	// Escreve $cabArqu no Arquivo de Backup
	$escreve = fwrite($fp, $cabArqu);
	// Fecha o arquivo
	fclose($fp);
}
// variável que define o diretório das imagens
$gerarNovoBkp  = '<a href="./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec=25&gerar=1"';
$gerarNovoBkp .= '><button class="btn btn-primary active"> <span class="glyphicon glyphicon-save-file" >';
$gerarNovoBkp .= '</span>&nbsp;Novo Backup</button></a>';
$dir = "./bkpbanco/";
$filesEnd = '';
$ind = 0;
// esse seria o "handler" do diretório
$dh = opendir($dir);
#print_r(array_reverse(scandir($dir)));
#$arq = array();
// loop que busca todos os arquivos até que não encontre mais nada
$arq = array();
while (false !== ($filename = readdir($dh))) {
// verificando se o arquivo é .sql
	if (substr($filename,-4) == ".sql") {
		// mostra o nome do arquivo e um link para ele - pode ser mudado para mostrar diretamente a imagem :)
		$sizeFile = number_format(((stat($dir.$filename)['size'])/1024)/1024, 2, ',', '.');
		$indice = stat($dir.$filename)['ctime'];
		$arq[$indice] = array($dir.$filename,$filename,date ("d/M/Y H:i:s", stat($dir.$filename)['ctime']),$sizeFile, stat($dir.$filename)['ctime']);
	}elseif (substr($filename,-4) != '.zip') {
	   		unlink($dir.$filename);
	}
}
ksort($arq);
$variable = array_reverse($arq);
// var_dump($variable);
echo '<dl class="dl-horizontal">';
foreach ($variable as $key => $value) {
	$dtBrazil = strftime(", (%A) %d de %B de %Y &agrave;s %T",$value['4']);
	if ($key=='0') {
		echo '<dt>'.$gerarNovoBkp.'</dt>';
		echo '<dd><div class="alert alert-success" role="alert">';
		echo '<a href='.$value['0'].' target="_blank"  class="alert-link">';
		echo '<span class="sql_download_link" aria-hidden="true"></span> ';
		echo $value['1'].'- DADOS <h6>';
		echo '<div class="alert alert-success" role="alert">';
		echo '<span class="sr-only">Error:</span> ';
		echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
		echo ' Arquivo mais recente, criado: '.$dtBrazil.', com: '.$value['3']. ' MBytes</div></h6></a></div></dd>';
	} elseif ($key<'3') {
		echo '<dt><a href='.$value['0'].' target="_blank"> ';
		echo '<span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> ';
		echo $value['1'].'</a></dt>';
		echo '<dd>'."Arquivo criado em: ".$dtBrazil.', com: '.$value['3']. ' MBytes</dd>';
	} elseif ($key<'15') {
		$numArq = $key+1;
		$filesEnd .= '<li><a href='.$value['0'].' target="_blank" title="Arquivo '.($key+1).' ('.$value['1'].') criado em: '.$value['2'].', com: '.$value['3'].' MBytes"';
		$filesEnd .= '><small>'.($key+1).'</small><img src="img/bkp.ico" width="16px" height="16px"/></a>';
		$filesEnd .= '</li>';
	}else{
		#Apagar backup's antigos
	   	unlink($value['0']);
	}
}
echo '</dl>';
if (count($arq)=='0') {
	#Exibir botão em caso de não exitir nenhum arquivo na pasta de backup
	echo $gerarNovoBkp;
}
?>
<div class="bs-example bs-navbar-top-example" data-example-id="navbar-fixed-to-top">
 <nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">Anteriores</a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-6">
		<ul class="nav navbar-nav">
		  	<?PHP echo $filesEnd;
		  	?>
		</ul>
		</div>
	</div>
 </nav>
</div>
