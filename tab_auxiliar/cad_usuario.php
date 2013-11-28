<?php

if (empty($_SESSION['valid_user']))
header("Location: ../");
//echo strlen($_POST["nome"]);
$arq='forms/usuario.php';

if ($_POST["cpf"]=="" & $_POST["nome"]==""){
	echo "<script>alert('Lembre-se você deve ter privilégio para adminstração do Sistema de acesso para conclusão do cadastro de acesso ao sistema!');</script>";
} elseif ($_POST["senha"]<>$_POST["senha1"] || $_POST["senha"]=="" ) {
	echo "<script>alert('Senhas não conferem!');</script>";
} elseif (!validaCPF($_POST["cpf"])) {
	echo "<script>alert('CPF inválido!');</script>";
} elseif ($_POST["nome"]=="" || strlen($_POST["nome"]) < 10){
	echo "<script>alert('Nome inválido, Não deve está em branco e com ao menos 10 caracteres!');</script>";
}elseif ($_POST["setor"]<>$_SESSION["setor"] && $_SESSION["setor"]<"50" ) {
	echo "<script>alert('Você não pode atribuir direitos a setores que não lhe pertence!{$_SESSION["setor"]} - {$_POST["setor"]}');</script>";
	echo "Você não pode atribuir direitos a setores que não lhe pertence!";
}else {
	$arq = 'models/cad_usuario.php';
}


require_once $arq;
?>