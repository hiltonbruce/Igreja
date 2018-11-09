<div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
	<h4>Certid&atilde;o de Batismo</h4>
<form method="post" action="views/secretaria/batismoCertificado.php" target="_blank">
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
	    <input type="text" id='detalhe2' class="form-control" placeholder="N&ordm; do membro na igreja"
						name='rol' value='<?php echo $_GET['rol'];?>' required='required'>
	  </div>
    <div class="col-xs-6">
      <label>Fun&ccedil;&atilde;o e Congrega&ccedil;&atilde;o</label>
      <input type="text" class="form-control" id='acesso2'>
    </div>
  <div class="col-xs-3">
    <label>Data do Batismo</label>
    <input type="date" name="dtbatismo" class="form-control dataclass" id='id_val2' placeholder="Data do Batismo" >
    <input type="hidden" name="pastor" value="<?PHP echo strtr( $igSede->pastor(), 'áàãâéêíóõôúüç','aaaaeeiooouuc');?>" >
  </div>
  <div class="col-xs-1">
    <label>Sexo</label>
    <input type="text" name="sexo" class="form-control" id='sexo' placeholder="M ou F" >
  </div>
 	<div class="col-xs-6">
		<label>Secret&aacute;rio:..</label>
	<select name="secretario" id="secretario" class="form-control" tabindex="<?PHP echo $ind++;?>">
		<option value="<?PHP echo fun_igreja ($igSede->secretario1());?>"><?PHP echo fun_igreja ($igSede->secretario1());?></option>
		<option value="<?PHP echo fun_igreja ($igSede->secretario2());?>"><?PHP echo fun_igreja ($igSede->secretario2());?></option>
	</select>
	</div>
  <div class="col-xs-3">
    <label>&nbsp;</label>
    <button type="submit" class="btn btn-primary">Exibir...</button>
  </div>
</div>
</p>
</form>
</div>
 <script type="text/javascript">
 	new Autocomplete("estado", function() {
 		this.setValue = function( rol,nome,celular,detalhe,sexo ) {
 			$("#id_val2").val(rol);
 			$("#nome2").val(nome);
 			$("#acesso2").val(celular);
 			$("#detalhe2").val(detalhe);
 			$("#sexo").val(sexo);
 		}
 		if ( this.isModified )
 			this.setValue("");
 		if ( this.value.length < 1 && this.isNotClick )
 			return ;
 			return "models/autocompBatismo.php?q=" + this.value;
 	});
 </script>
