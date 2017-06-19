<div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
	<h4>Certid&atilde;o de Batismo</h4>
	<p>
	<div class="row">
	  <div class="col-xs-8">
			<label>Nome:</label>
	    <input type="text" name='nome' id='estado' class='form-control'
			placeholder="Busca no cadastro da Igreja!" value='<?php echo $_GET['nome'];?>'
				autofocus='autofocus' tabindex="<?php echo ++$ind;?>">
	  </div>
	  <div class="col-xs-2">
			<label>Rol:</label>
	    <input type="text" id='detalhe2'class="form-control" placeholder="N&ordm; do membro na igreja"
						name='rol' value='<?php echo $_GET['rol'];?>' required='required'>
	  </div>

    <div class="col-xs-6">
      <label>Fun&ccedil;&atilde;o e Congrega&ccedil;&atilde;o</label>
      <input type="text" class="form-control" id='acesso2' placeholder="acesso2">
    </div>
  <div class="col-xs-4">
    <label>Data do Batismo</label>
    <input type="text" class="form-control dataclass" id='id_val2' placeholder="id_val2">
  </div>
  <div class="col-xs-3">
    <label>&nbsp;</label>
    <button type="button" class="btn btn-primary">Exibir...</button>
  </div>
</div>
</p>
</div>
 <script type="text/javascript">
 	new Autocomplete("estado", function() {
 		this.setValue = function( rol, nome, celular,detalhe ) {
 			$("#id_val2").val(rol);
 			$("#nome2").val(nome);
 			$("#acesso2").val(celular);
 			$("#detalhe2").val(detalhe);
 		}
 		if ( this.isModified )
 			this.setValue("");
 		if ( this.value.length < 1 && this.isNotClick )
 			return ;
 			return "models/autocomplete.php?q=" + this.value;
 	});
 </script>
