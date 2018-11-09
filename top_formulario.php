<div>
	<a <?PHP $b=id_corrente ("ficha_limpa");?> href="relatorio/formcadastro.php" target="_blank">
	  	<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Ficha  Membro</button></a>
	  <a <?PHP $b=id_corrente ("apresent");?> href="./?escolha=relatorio/cert_apresent.php&menu=top_formulario">
	  	<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Apresenta&ccedil;&atilde;o</button></a>
	  <a <?PHP $b=id_corrente ("recibos");?> href="./?escolha=relatorio/recibos.php&menu=top_formulario&tipo=1">
			<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Recibos</button></a>
			<a <?PHP $b=id_corrente ("batismo");?> href="./?escolha=relatorio/batismo.php&menu=top_formulario">
				<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Batismo</button></a>
	  <a <?PHP $b=id_corrente ("consagracao");?> href="./?escolha=relatorio/consagracao.php&menu=top_formulario">
			<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Consagra&ccedil;&atilde;o</button></a>
</div>
