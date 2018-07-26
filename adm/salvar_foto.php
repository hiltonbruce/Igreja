<?PHP
session_start();
// var_dump($_FILES);
if ($_FILES ["userfile"]["error"])
{
	echo "Erro: ";
	switch ($_FILES ["userfile"]["error"])
	{
		case 1 : echo "O Arquirvo execede o tamanho máximo permitido pelo sistema!"; break;
		case 2 : echo "O Arquirvo execede o tamanho máximo permitido pelo formul&aacute;rio!"; break;
		case 3 : echo "O recebimento do arquivo goi incompleto!"; break;
		case 4 : echo "Nenhum arquivo foi recebido!"; break;
	}
	exit;
}

//O arquivo possui o tipo MIME correto?
if ($_FILES ["userfile"]["type"] != "image/jpeg")
{
	echo "Este arquivo n&atilde;o &eacute; permitido!";
	print "<SCRIPT>alert('Este arquivo não é permitido!');window.history.go(-1); </SCRIPT>";
	exit;
}

//Insere o arquivo onde gostariamos ../img_membros/
$upfile = "../img_membros/".intval($_POST['bsc_rol']).".jpg";

if (is_uploaded_file ($_FILES ["userfile"]["tmp_name"]))
{
	if (move_uploaded_file ($_FILES ["userfile"]["tmp_name"], $upfile))
	{
		print "<SCRIPT> alert('A foto foi enviada com sucesso...'); window.history.go(-1); </SCRIPT>";
		echo "O arquivo foi carregado com sucesso!<a href=''>Voltar...<a><br><br>";
		echo "<br><hr>";
	}else {
		echo "N&atilde;o pode gravar o arquivo para o local destinado";
		print "<SCRIPT>alert('Não foi possível salvar o arquivo no destinado!')window.history.go(-1);</SCRIPT>";
		// exit;
	}
}
else
{
	echo "&Eacute; poss&iacute;vel que este seja um tipo de arquivo indesej&aacute;vel. Arquivo:";
	echo $_FILES ["userfile"]["name"];
	exit;
}

?>
