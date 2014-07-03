<div id="tabs">
	<ul>
	  <li><a <?PHP link_ativo($_GET["rec"], "1");?> href="./?escolha=controller/recibo.php&menu=top_tesouraria&rec=1">
	      <span>Membros da Igreja</span></a></li>
	  <li><a <?PHP link_ativo($_GET["rec"], "2");?> href="./?escolha=controller/recibo.php&menu=top_tesouraria&rec=2">
	      <span>Pessoa Jur&iacute;dica</span></a></li>
	  <li><a <?PHP link_ativo($_GET["rec"], "3");?> href="./?escolha=controller/recibo.php&menu=top_tesouraria&rec=3">
	      <span>Não Membros</span></a></li>
	  <li><a <?PHP link_ativo($_GET["rec"], "4");?> href="./?escolha=controller/recibo.php&menu=top_tesouraria&rec=4">
	      <span>Recibos de Pgto</span></a></li>
	  <li><a <?PHP link_ativo($_GET["rec"], "5");?> href="./?escolha=controller/recibo.php&menu=top_tesouraria&rec=5">
	      <span>Impress&atilde;o de Recibos</span></a></li>
	</ul>
</div>
