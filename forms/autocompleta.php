<link rel="stylesheet" type="text/css" href="../css/autocomplete.css">
<?php
	if (empty($formCampos)) {
		$formCampos='';
	}
?>
<!-- Desenvolvido por Wellington Ribeiro -->
<form method="get" name="autocompletar" action="">
	<div class="row">
  <div class="col-xs-7"><label>Busca por nome:</label>
		<input type="text" name="nome" id="campo_estado" class="form-control"
		placeholder="Nome, sobrenome ou partes deles para procurarmos, a partir de 2 caracteres!" />
		<input type="hidden" name="escolha" value="adm/rest_busca.php">
  </div>
  <div class="col-xs-3"><label>celular</label>
	<input type="text" id="id_val" name="id" class="form-control fone" />
  </div>
  <div class="col-xs-1"><label>&nbsp;</label>
	<input type="submit" class="btn btn-primary btn-sm" name="listar" value="Listar dados...">
  </div>
  <div class="col-xs-5"><label>Endere&ccedil;o:</label>
	<input type="text" id="estado_val" class="form-control" name="estado" />
  </div>
  <div class="col-xs-7"><label>Fun&ccedil;&atilde;o</label>
	<input type="text" id="sigla_val" class="form-control celular" name="sigla" />
	</div>
  <div class="col-xs-8">
		<?php
			echo $formCampos;
		?>
  </div>
</div>
</form>
<script type="text/javascript">
	new Autocomplete("campo_estado", function() {
		this.setValue = function( rol, nome, celular ) {
			$("#id_val").val(rol);
			$("#estado_val").val(nome);
			$("#sigla_val").val(celular);
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 2 && this.isNotClick )
			return ;
		return "models/autocomplete.php?q=" + this.value;
	});
</script>
