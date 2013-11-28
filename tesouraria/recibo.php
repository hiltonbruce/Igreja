<?php
$ind=1;
if ($_SESSION["setor"]=="2" || $_SESSION["setor"]>"50"){
?> 

<div id="tabs">
	<ul>
	  <li><a <?PHP link_ativo($_GET["rec"], "1");?> href="./?escolha=tesouraria/recibo.php&menu=top_tesouraria&rec=1"><span>Membros da Igreja</span></a></li>
	  <li><a <?PHP link_ativo($_GET["rec"], "2");?> href="./?escolha=tesouraria/recibo.php&menu=top_tesouraria&rec=2"><span>Pessoa Jur&iacute;dica</span></a></li>
	  <li><a <?PHP link_ativo($_GET["rec"], "3");?> href="./?escolha=tesouraria/recibo.php&menu=top_tesouraria&rec=3"><span>Não Membros</span></a></li>
	</ul>
</div>
<?php

require_once 'forms/recibo.php';
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
	header("Location: ./assembleia");
}
?>
