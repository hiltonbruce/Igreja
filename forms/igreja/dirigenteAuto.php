

<!-- Desenvolvido por Wellington Ribeiro -->
<?php
	switch ($_GET['campo']) {
		case 'secretario1':
			$labelCampo = '1 &ordm; Secret&aacute;rio';
			break;
		case 'secretario2':
			$labelCampo = '2 &ordm; Secret&aacute;rio';
			break;

		default:
			$labelCampo = 'Dire&ccedil;&atilde;o';
			break;
	}
?>
			<tr>
				<td colspan="2"><label><?php echo $labelCampo;?></label> <input type="text" name="nome"
				id="campo_estado" size="30%" class="form-control"
				placeholder="Nome do membro da igreja para iniciarmos a busca no cadastro!"
				autofocus="autofocus" tabindex="<?php echo ++$ind;?>"
				/>
				</td>
				<td><label>Rol:</label>
					<input type="text" id="rol" name="pastor" tabindex="<?php echo ++$ind;?>"
					class="form-control" placeholder="N&ordm; no rol do <?PHP echo $labelCampo ;?>" />
				</td>
			</tr>
			<tr>
				<td><label>Congreg. do membro:</label> <input type="text" id="cong"
					class="form-control" disabled="disabled" value="" />
				</td>
				<td><?PHP
						if ($_GET['campo']=='pastor') {
					?>
					<label>Assumir a partir de:</label> <input type="text" id="data"
					class="form-control" name="data" tabindex="<?php echo ++$ind;?>"
					required="required" value='<?PHP echo date('d/m/Y');?>'
					placeholder="Data do primeiro culto"/>
					<?PHP
						}
					?>
				</td>
				<td ><label>&nbsp;</label>
				<input name="Submit" class="btn btn-primary" type="submit" value="Alterar!">
				</td>
			</tr>
<script type="text/javascript" src="js/autocomplete.js"></script>
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
		return "models/autodizimo.php?q=" + this.value;
	});
</script>
