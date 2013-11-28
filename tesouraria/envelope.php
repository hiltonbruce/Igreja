<?php
$ind=1; 
if ($_SESSION["setor"]=="2" || $_SESSION["setor"]>"50"){

require_once 'forms/envelope.php';
/*
$valor = 5000.00;
$dim = extenso($valor);
$dim = ereg_replace(" E "," e ",ucwords($dim));

$valor = number_format($valor, 2, ",", ".");

echo "R$ $valor ( $dim )";
*/

} else {
	echo "<script> alert('Sem permissão de acesso! Entre em contato com o Tesoureiro!');location.href='../?escolha=adm/cadastro_membro.php&uf=PB';</script>";
	$_SESSION = array();
	session_destroy();
	header("Location: ./");
}
?>
