<?php

if (empty($_SESSION['valid_user']))
header("Location: ../");
//echo strlen($_POST["nome"]);
$arq='forms/usuario.php';

if ($_POST["cpf"]=="" & $_POST["nome"]==""){
	echo "<script>alert('Lembre-se voc� deve ter privil�gio para adminstra��o do Sistema de acesso para conclus�o do cadastro de acesso ao sistema!');</script>";
} elseif ($_POST["senha"]<>$_POST["senha1"] || $_POST["senha"]=="" ) {
	echo "<script>alert('Senhas n�o conferem!');</script>";
} elseif (!validaCPF($_POST["cpf"])) {
	echo "<script>alert('CPF inv�lido!');</script>";
} elseif ($_POST["nome"]=="" || strlen($_POST["nome"]) < 10){
	echo "<script>alert('Nome inv�lido, N�o deve est� em branco e com ao menos 10 caracteres!');</script>";
}elseif ($_POST["setor"]<>$_SESSION["setor"] && $_SESSION["setor"]<"50" ) {
	echo "<script>alert('Voc� n�o pode atribuir direitos a setores que n�o lhe pertence!{$_SESSION["setor"]} - {$_POST["setor"]}');</script>";
	echo "Voc&ecirc; n&atilde;o pode atribuir direitos a setores que n�o lhe pertence!";
}else {
	$arq = 'models/cad_usuario.php';
}
require_once 'forms/manutencao.php';
require_once $arq;
?>
