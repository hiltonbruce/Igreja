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
	<table class='table'>
		<tbody>
			<tr>
				<td colspan="3"><label>Nome:</label> <input type="text" name="nome"
				id="campo_estado" size="50%" class="form-control"
				placeholder="Nome do dizimista para iniciarmos a busca no cadastro da Igreja!"
				autofocus="autofocus" tabindex="<?php echo ++$ind;?>" />
				</td>
				<td><label>Rol:</label> <input type="text" id="rol" name="rol" tabindex="<?php echo ++$ind;?>"
						value="" class="form-control" placeholder="N&ordm; do membro na igreja" />
				</td>
			</tr>
			<tr>
				<td><label>Data: </label> <input type="text" id="data" name="data"
					value="<?php echo $dtlanc;?>" class="form-control" required="required"/>
				</td>
				<td><label>Referente M&ecirc;s:</label><input type="text" name="mes"
					size="2" value="<?php echo $meslanc;?>" class="form-control"
					 tabindex="<?php
					 	if ($_GET['igreja']=='1') {
					 		echo ++$ind;
					 	}?>" required="required" />
				</td>
				<td>
					 <label>Ano:</label> <input type="text"
					id="ano" name="ano" size="4" value="<?php echo $anolanc;?>"
					 required="required" class="form-control" />
				</td>
				<td><label>Congreg. do membro:</label> <input type="text" id="cong"
					class="form-control" disabled="disabled" value="" />
				</td>
			</tr>
		</tbody>
	</table>
  <table class="table">
    <tbody>
      <tr>
        <td><label>Carn&ecirc;s:</label><input type="text" id="oferta8" autocomplete="off"
          class="form-control money" name="oferta8" value="" tabindex="<?php echo ++$ind;?>"
          placeholder="Valor em R$ ( Carn&ecirc;s )"  />
        </td>
        <td><label>Oferta:</label><input type="text" id="oferta5" autocomplete="off"
          class="form-control money" name="oferta5" value="" tabindex="<?php echo ++$ind;?>"
          placeholder="Valor em R$ ( Oferta )"  />
        </td>
        <td><label>Envelopes:</label><input type="text" id="oferta6" autocomplete="off"
          class="form-control money" name="oferta6" value="" tabindex="<?php echo ++$ind;?>"
          placeholder="Valor em R$ ( Envelopes )"  />
        </td>
      </tr>
      <tr>
        <td><label>Cofres:</label><input type="text" id="oferta7" autocomplete="off"
          class="form-control money" name="oferta7" value="" tabindex="<?php echo ++$ind;?>"
          placeholder="Valor em R$ ( Cofres )"  />
        </td>
        <td></td>
        <td> <label>&nbsp;</label> <input class="btn btn-primary"
        type="submit" name="listar" value="Lan&ccedil;ar..."></td>
      </tr>
    </tbody>
  </table>
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
