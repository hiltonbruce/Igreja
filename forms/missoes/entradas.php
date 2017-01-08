<?php
	require_once 'forms/concluirdiz.php';#Form fecha caixa
	if ($idIgreja>0) {
?>
<fieldset>
	<legend>Miss&otilde;es (Estamos na:
		<?php
			echo semana(date('d/m/Y')).'&ordf;';
		?>
		 Semana deste m&ecirc;s)
  </legend>
<div class="row">
  <div class="col-xs-6">
			<label>Nome:</label> <input type="text" name="nome"
				id="campo_estado" size="50%" class="form-control"
				placeholder="Nome para iniciarmos a busca no cadastro da Igreja!"
				autofocus="autofocus" tabindex="<?php echo ++$ind;?>" />
  </div>
  <div class="col-xs-2">
		<label>Rol:</label> <input type="text" id="rol" name="rol" tabindex="<?php echo ++$ind;?>"
						value="" class="form-control" placeholder="N&ordm; do membro na igreja" />
  </div>
  <div class="col-xs-4"><label>Congreg. do membro:</label>
					<input type="text" id="cong" tabindex="<?php echo ++$ind;?>"
					class="form-control" disabled="disabled" value="" />
  </div>
  <div class="col-xs-3">
		<label>Carn&ecirc;s:</label><input type="text" id="oferta8" autocomplete="off"
          class="form-control money" name="oferta8" value="" tabindex="<?php echo ++$ind;?>"
          placeholder="Valor em R$ ( Carn&ecirc;s )"  />
  </div>
  <div class="col-xs-3">
		<label>Oferta:</label><input type="text" id="oferta5" autocomplete="off"
          class="form-control money" name="oferta5" value="" tabindex="<?php echo ++$ind;?>"
          placeholder="Valor em R$ ( Oferta )"  />
  </div>
  <div class="col-xs-3">
		<label>Envelopes:</label><input type="text" id="oferta6" autocomplete="off"
          class="form-control money" name="oferta6" value="" tabindex="<?php echo ++$ind;?>"
          placeholder="Valor em R$ (Envelopes)"  />
  </div>
  <div class="col-xs-3">
		<label>Cofres:</label><input type="text" id="oferta7" autocomplete="off"
          class="form-control money" name="oferta7" tabindex="<?php echo ++$ind;?>"
          placeholder="Valor em R$ ( Cofres )"  />
  </div>
  <div class="col-xs-3">
		<label>Data:</label>
					<input type="text" id="data" name="data"  tabindex="<?php echo ++$ind;?>"
					value="<?php echo $dtlanc;?>" class="form-control" required="required"/>
  </div>
  <div class="col-xs-2">
		<label>Referente M&ecirc;s:</label><input type="text" name="mes"
					size="2" value="<?php echo $meslanc;?>" class="form-control"
					 tabindex="<?php echo ++$ind;?>" required="required" />
  </div>
  <div class="col-xs-3">
		 <label>Ano:</label>
		 <input type="text" tabindex="<?php echo ++$ind;?>"
		id="ano" name="ano" size="4" value="<?php echo $anolanc;?>"
		 required="required" class="form-control" />
  </div>
  <div class="col-xs-4 text-right">
		<label>&nbsp;</label><br />
					<input class="btn btn-primary" tabindex="<?php echo ++$ind;?>"
        type="submit" name="listar" value="Lan&ccedil;ar...">
  </div>
</div>
</fieldset>
<script type="text/javascript">
	new Autocomplete("campo_estado", function() {
		this.setValue = function( rol, nome, celular, congr ) {
			$("#id_val").val(rol);
			$("#estado_val").val(nome);
			$("#sigla_val").val(celular);
			$("#rol").val(celular);
			$("#cong").val(congr);
		}
		if ( this.value.length < 1 && this.isNotClick )
			return ;
		return "models/autodizimo.php?q=" + this.value + "&igreja=<?php echo $_GET['igreja'];?>" ;
	});
</script>
<?php
}
?>
