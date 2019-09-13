<div>
	<a <?PHP $b=id_corrente ("ficha_limpa");?> href="relatorio/formcadastro.php" target="_blank">
	  	<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Ficha  Membro</button></a>

			<div class="btn-group" role="group">
		    <button type="button" class="btn btn-info btn-sm dropdown-toggle
				<?PHP
				echo id_corrente ("apresent");
				echo id_corrente ("formAutorizBatismo");
				?>"
					data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		      Crian&ccedil;as<span class="caret"></span></button>
		    <ul class="dropdown-menu">
		      <li class="<?PHP echo id_corrente ("apresent");?>" ><a href="./?escolha=relatorio/cert_apresent.php&menu=top_formulario">
				  	Certid&atilde;o de Apresenta&ccedil;&atilde;o</a></li>
		      <li class="<?PHP echo id_corrente ("formAutorizBatismo");?>" >
						<a href="./?escolha=forms/sec/formAutorizBatismo.php&menu=top_formulario">
							Autoriza&ccedil;&atilde;o de Batismo</a></li>
		    </ul>
		  </div>

	  <a <?PHP $b=id_corrente ("recibos");?> href="./?escolha=relatorio/recibos.php&menu=top_formulario&tipo=1">
			<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Recibos</button></a>
			<a <?PHP $b=id_corrente ("batismo");?> href="./?escolha=relatorio/batismo.php&menu=top_formulario">
				<button type="button" class="btn btn-info btn-sm <?php echo $b;?>"
					data-toggle="tooltip" data-placement="top" title="Emiss&atilde;o de Certificado de Batismo">Batismo</button></a>
	  <a <?PHP $b=id_corrente ("consagracao");?> href="./?escolha=relatorio/consagracao.php&menu=top_formulario">
			<button type="button" class="btn btn-info btn-sm <?php echo $b;?>">Consagra&ccedil;&atilde;o</button></a>
</div>
