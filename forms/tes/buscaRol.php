<?php
	if (empty($formCampos)) {
		$formCampos='';
	}
?>
<!-- Desenvolvido por Wellington Ribeiro -->
<form method="get" name="autocompletar" action="">
			<div class="row">
				<div class="col-sm-12">
					<label>Busca de Membro:</label>
				<input type="text" id="campoNome" class="form-control input-sm"
				placeholder="Nome, sobrenome ou partes deles para procurarmos, a partir de 2 caracteres!" />
				</div>
		  <div class="col-xs-5">
				<input type="hidden" name="escolha" value="tesouraria/rec_alterar.php" /> <!-- indica o script que receber� os dados -->
				<input type="hidden" name="menu" value="top_tesouraria" />
				<label>Rol:</label>
			<input type="text" id="rolVal" class="form-control input-sm" name="recebeu" value="" required="required" />
		  </div>
		  <div class="col-xs-2">
				<label>&nbsp;</label>
			<input type="submit" class="btn btn-primary btn-sm" name="listar" value="Listar dados...">
		  </div>
			</div>
</form>
<script type="text/javascript">
	new Autocomplete("campoNome", function() {
		this.setValue = function( rol, nome, celular, rolmem ) {
			$("#idVal").val(rol);
			$("#nomeVal").val(nome);
			$("#sigVal").val(celular);
			$("#rolVal").val(rolmem);
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 2 && this.isNotClick )
			return ;
		return "models/tes/autoRecMem.php?q=" + this.value;
	});
</script>
