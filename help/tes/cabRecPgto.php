<a <?PHP $b=link_ativo($_GET["rec"], "1");?> href="./?escolha=controller/recibo.php&menu=top_tesouraria&rec=1">
	<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Membros da Igreja</button>
</a>
<a <?PHP $b=link_ativo($_GET["rec"], "2");?> href="./?escolha=controller/recibo.php&menu=top_tesouraria&rec=2">
	<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Pessoa Jur&iacute;dica</button>
</a>
<a <?PHP $b=link_ativo($_GET["rec"], "3");?> href="./?escolha=controller/recibo.php&menu=top_tesouraria&rec=3">
	<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Não Membros</button>
</a>
<a <?PHP $b=link_ativo($_GET["rec"], "4");?> href="./?escolha=controller/recibo.php&menu=top_tesouraria&rec=4">
	<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Recibos de Pgto</button>
</a>
<a <?PHP $b=link_ativo($_GET["rec"], "5");?> href="./?escolha=controller/recibo.php&menu=top_tesouraria&rec=5">
	<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Impress&atilde;o de Recibos</button>
</a>
