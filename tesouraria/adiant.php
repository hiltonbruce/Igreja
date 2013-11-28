<?PHP
$ind=1;
if ($_SESSION["setor"]=="2" || $_SESSION["setor"]>"50"){
?> 

<div id="tabs">
	<ul>
	  <li><a <?PHP link_ativo($_GET["adiant"], "1");?> href="./?escolha=tesouraria/adiant.php&menu=top_tesouraria&adiant=1"><span>Para Compras</span></a></li>
	  <li><a <?PHP link_ativo($_GET["adiant"], "2");?> href="./?escolha=tesouraria/adiant.php&menu=top_tesouraria&adiant=2"><span>Salário</span></a></li>
	  <li><a <?PHP link_ativo($_GET["adiant"], "3");?> href="./?escolha=tesouraria/adiant.php&menu=top_tesouraria&adiant=3"><span>Auxílio</span></a></li>
	  <li><a <?PHP link_ativo($_GET["adiant"], "9");?> href="./?escolha=tesouraria/adiant.php&menu=top_tesouraria&adiant=9"><span>Prestar Contas</span></a></li>
	</ul>
</div>

<?php } 

	require_once 'views/tabhiscomp.php';
?>