<?php
	$acessoDebitar = (!empty($_GET['deb']) && $_GET['deb']>0) ? $_GET['deb'] : '' ;
	$acessoCreditar = (!empty($_GET['cred']) && $_GET['cred']>0) ? $_GET['cred'] : '' ;
?>
<script type="text/javascript" src="js/autocomplete.js"></script>
<script
	type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<link	rel="stylesheet" type="text/css" href="css/autocomplete.css">

<span style="text-align: left; font-weight: bold">Debitar Conta</span>
<table style="background-color: #D3D3D3;" class='table'>
	<tbody>
		<tr>
			<td colspan="3">
				<label>Despesas com:</label>
				<input type="text" name="nome" class="form-control"
				id="campo_estado" tabindex="<?PHP echo ++$ind; ?>"
				placeholder="Qual a Despesa?"/>
			</td>
		</tr>
		<tr>
			<td>
				<label>C&oacute;digo/tipo:</label>
				<input type="text" id="estado_val" class="form-control"
				name="estado_val" disabled="disabled" value="" />
			</td>
			<td>
				<label>Saldo Atual:</label>
				<input type="text" id="id_val" name="id" class="form-control"
				disabled="disabled" value="" />
			</td>
			<td>
				<label>Acesso:</label>
				<input type="text" id="acesso" name="acessoDebitar" class="form-control"
				value="<?PHP echo $acessoDebitar; ?>" required="required" tabindex="<?PHP echo ++$ind; ?>" />
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<label>Descri&ccedil;&atilde;o:</label>
				<input type="text" size="78%" id="detalhe" name="det"
				disabled="disabled" class="form-control" />
			</td>
		</tr>
	</tbody>
</table>
<span style="text-align: left; font-weight: bold">Creditar Conta</span>
<table style="background-color: #D3D3D3;" class='table'>
	<tbody>
		<tr>
			<td colspan="3">
				<label>Pago pela Conta:</label>
				<input type="text" name="nome1" class="form-control" id="estado" size="78%"
				 placeholder="Gasto pago com o recurso/conta: Caixa, Banco ... ?" tabindex="<?PHP echo ++$ind; ?>" />
			</td>
		</tr>
		<tr>
			<td>
				<label>C&oacute;digo/tipo:</label>
				<input type="text" id="nome" name="codigo"
				disabled="disabled" value="" class="form-control" />
			</td>
			<td>
				<label>Saldo Atual:</label>
				<input type="text" id="id_val2" name="id"
				disabled="disabled" value="" class="form-control" />
			</td>
			<td>
				<label>Acesso:</label>
				<input type="text" id="acesso2"
				name="acessoCreditar" value="<?PHP echo $acessoCreditar; ?>" required="required"
				tabindex="<?PHP echo ++$ind; ?>" class="form-control" />
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<label>Descri&cedil;&atilde;o:</label>
				<input type="text" size="78%" id="detalhe2" name="det"
				disabled="disabled" class="form-control" />
			</td>
		</tr>
	</tbody>
</table>
<script type="text/javascript">
	new Autocomplete("campo_estado", function() {
		this.setValue = function( rol, nome, celular,detalhe ) {
			$("#id_val").val(rol);
			$("#estado_val").val(nome);
			$("#acesso").val(celular);
			$("#detalhe").val(detalhe);
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick )
			return ;
		return "models/tes/autoCompletaContas.php?q=" + this.value;
	});

	new Autocomplete("estado", function() {
		this.setValue = function( rol, nome, celular,detalhe ) {
			$("#id_val2").val(rol);
			$("#nome").val(nome);
			$("#acesso2").val(celular);
			$("#detalhe2").val(detalhe);
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick )
			return ;
		return "models/tes/autoCompletaContas.php?q=" + this.value;
	});
</script>
