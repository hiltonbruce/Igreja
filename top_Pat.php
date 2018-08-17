<p>
	<a <?PHP $b=link_ativo($_GET["rec"], "0"); ?> href="./?escolha=controller/patrimonio.php&menu=top_Pat&rec=0">
	<button type="button" class="btn btn-info btn-sm <?php echo $b;?>" >Im&oacute;veis</button></a>
	<a <?PHP $b=link_ativo($_GET["rec"], "1"); ?> href="./?escolha=controller/patrimonio.php&menu=top_Pat&rec=1">
	<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Busca</button></a>
</p>
