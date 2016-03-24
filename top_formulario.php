<div>
	<a <?PHP $b=id_corrente ("ficha_limpa");?> href="relatorio/formcadastro.php">
	  	<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Ficha  Membro</button></a>
	
	  <a <?PHP $b=id_corrente ("apresent");?> href="./?escolha=relatorio/cert_apresent.php&menu=top_formulario">
	  	<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Apresenta&ccedil;&atilde;o</button></a>
	
	  <a <?PHP $b=id_corrente ("recibos");?> href="./?escolha=relatorio/recibos.php&menu=top_formulario&tipo=1">
	  	<button type="button" class="btn btn-info btn-xs <?php echo $b;?>">Recibos</button></a>
</div>