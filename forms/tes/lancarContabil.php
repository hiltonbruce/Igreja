<?php
$acessoDebitar = (!empty($_GET['deb']) && $_GET['deb'] > 0) ? $_GET['deb'] : '';
$acessoCreditar = (!empty($_GET['cred']) && $_GET['cred'] > 0) ? $_GET['cred'] : '';
?>
<strong>Debitar Conta</strong>
<table class='table'>
	<tbody>
		<tr>
			<td colspan="3">
				<div class="row">
					<div class="col-xs-9">
						<label>Conta:</label>
						<input type="text" name="nome" class="form-control" id="campo_estado" tabindex="<?PHP echo ++$ind; ?>" 
						placeholder="Conta para ser debitada" />
					</div>
					<div class="col-xs-3"><label>Código de Acesso:</label>
						<input type="text" id="acesso" name="acessoDebitar" class="form-control" value="<?PHP echo $acessoDebitar; ?>" 
						required="required" tabindex="<?PHP echo ++$ind; ?>" />
					</div>
			</td>
		</tr>
		<tr>
			<td>
				<label>C&oacute;digo/tipo:</label>
				<input type="text" id="estado_val" class="form-control" name="estado_val" disabled="disabled" value="" />
			</td>
			<td>
				<label>Saldo Atual:</label>
				<input type="text" id="id_val" name="id" class="form-control" disabled="disabled" value="" />
			</td>
			<td>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<label>Descri&ccedil;&atilde;o:</label>
				<input type="text" size="78%" id="detalhe" name="det" disabled="disabled" class="form-control" />
			</td>
		</tr>
	</tbody>
</table>
<strong>Creditar Conta</strong>
<table class='table'>
	<tbody>
		<tr>
			<td colspan="3">
				<div class="row">
					<div class="col-xs-9">
						<label>Conta:</label>
						<input type="text" id="inputCta" class="form-control" autofocus="autofocus" tabindex="<?php echo ++$ind; ?>" 
						name="nome1" placeholder="Conta para ser creditada">
					</div>
					<div class="col-xs-3"><label>Código de Acesso:</label>
						<input type="text" id="inputCta2" name="acessoCreditar" value="<?PHP echo $acessoCreditar; ?>" 
						required="required" tabindex="<?PHP echo ++$ind; ?>" class="form-control">
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<label>C&oacute;digo/tipo:</label>
				<input type="text" id="codigo2" name="codigo" disabled="disabled" value="" class="form-control" />
			</td>
			<td>
				<label>Saldo Atual:</label>
				<input type="text" id="id_val2" name="id" disabled="disabled" value="" class="form-control" />
			</td>
			<td>

			</td>
		</tr>
		<tr>
			<td colspan="3">
				<label>Descri&ccedil;&atilde;o:</label>
				<input type="text" size="78%" id="detalhe2" name="det" disabled="disabled" class="form-control" />
			</td>
		</tr>
	</tbody>
</table>

<script>
	var options = {

		url: function(phrase) {
			return "models/completeEasyCta.php?q=" + phrase;
		},

		getValue: "name",

		list: {

			onSelectItemEvent: function() {
				var selectedItemValue = $("#inputCta").getSelectedItemData().acesso;
				$("#inputCta2").val(selectedItemValue).trigger("change");
				var selectedItemValue = $("#inputCta").getSelectedItemData().saldo;
				$("#id_val2").val(selectedItemValue).trigger("change");
				var selectedItemValue = $("#inputCta").getSelectedItemData().codigo;
				$("#codigo2").val(selectedItemValue).trigger("change");
				var selectedItemValue = $("#inputCta").getSelectedItemData().descricao;
				$("#detalhe2").val(selectedItemValue).trigger("change");
			},
			onHideListEvent: function() {
				$("#inputCta2").val(selectedItemValue).trigger("change");
			},
			showAnimation: {
				type: "fade", //normal|slide|fade
				time: 200,
				callback: function() {}
			},

			hideAnimation: {
				type: "slide", //normal|slide|fade
				time: 200,
				callback: function() {}
			},
			maxNumberOfElements: 10,
		},

		template: {
			type: "custom",
			method: function(value, item) {
				return item.codigo + '&bull;' + item.titulo + ' &bull; Saldo: ' + item.saldo;
			}
		},
		// theme: "round"
	};

	var options2 = {

		url: function(phrase) {
			return "models/completeEasyCta.php?q=" + phrase;
		},

		getValue: "name",

		list: {

			onSelectItemEvent: function() {
				var selectedItemValue = $("#campo_estado").getSelectedItemData().acesso;
				$("#acesso").val(selectedItemValue).trigger("change");
				var selectedItemValue = $("#campo_estado").getSelectedItemData().saldo;
				$("#id_val").val(selectedItemValue).trigger("change");
				var selectedItemValue = $("#campo_estado").getSelectedItemData().codigo;
				$("#estado_val").val(selectedItemValue).trigger("change");
				var selectedItemValue = $("#campo_estado").getSelectedItemData().descricao;
				$("#detalhe").val(selectedItemValue).trigger("change");
			},
			onHideListEvent: function() {
				$("#campo_estado").val(selectedItemValue).trigger("change");
			},
			showAnimation: {
				type: "fade", //normal|slide|fade
				time: 200,
				callback: function() {}
			},

			hideAnimation: {
				type: "slide", //normal|slide|fade
				time: 200,
				callback: function() {}
			},
			maxNumberOfElements: 10,
		},

		template: {
			type: "custom",
			method: function(value, item) {
				return item.codigo + '&bull;' + item.titulo + ' &bull; Saldo: ' + item.saldo;
			}
		},
		// theme: "round"
	};

	$("#inputCta").easyAutocomplete(options);
	$("#campo_estado").easyAutocomplete(options2);
</script>