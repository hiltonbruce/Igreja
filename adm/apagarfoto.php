<?PHP
session_start();

//Apaga o arquivo da pasta ../img_membros/
$upfile = "../img_membros/".intval($_GET['bsc_rol']).".jpg";

if (unlink($upfile)) {
	print "<SCRIPT> alert('A foto foi excluida com sucesso...');  window.history.go(-1); </SCRIPT>\n";
	echo 'O arquivo foi apagado com sucesso!<a href="../?bsc_rol='.$_GET['bsc_rol'].'&escolha=adm%2Fdados_pessoais.php">Voltar...<a><br><br>';
} else {
	print "<SCRIPT> alert('Não existe foto...'); window.history.go(-1); </SCRIPT>\n";
	exit;
}
?>
