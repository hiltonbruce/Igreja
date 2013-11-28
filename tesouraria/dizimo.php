<div id="tabs">
	<ul>
	  <li><a <?PHP link_ativo($_GET["rec"], "1");?> href="./?escolha=tesouraria/dizimo.php&menu=top_tesouraria&rec=1"><span>D&iacute;zimos</span></a></li>
	  <li><a <?PHP link_ativo($_GET["rec"], "2");?> href="./?escolha=tesouraria/dizimo.php&menu=top_tesouraria&rec=2"><span>Ofertas</span></a></li>
	  <li><a <?PHP link_ativo($_GET["rec"], "3");?> href="./?escolha=tesouraria/dizimo.php&menu=top_tesouraria&rec=3"><span>Ora&ccedil;&atilde;o Adulto e Jovens</span></a></li>
	  <li><a <?PHP link_ativo($_GET["rec"], "4");?> href="./?escolha=tesouraria/dizimo.php&menu=top_tesouraria&rec=4"><span>Ora&ccedil;&atilde;o Infantil</span></a></li>
	  <li><a <?PHP link_ativo($_GET["rec"], "5");?> href="./?escolha=tesouraria/dizimo.php&menu=top_tesouraria&rec=5"><span>Miss&otilde;es</span></a></li>
	  <li><a <?PHP link_ativo($_GET["rec"], "6");?> href="./?escolha=tesouraria/dizimo.php&menu=top_tesouraria&rec=5"><span>Dep. de Ensino</span></a></li>
	</ul>
</div>

<?php 
require_once 'forms/dizimo.php';
?>
