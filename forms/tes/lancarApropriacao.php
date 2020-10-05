<strong>Debitar Conta</strong>
<table class='table'>
	<tbody>
		<tr>
			<td colspan="3">
				<div class="row">
					<div class="col-xs-9">
						<label>Conta:</label>
						<input type="text" name="nome" class="form-control" id="campo_estado" tabindex="<?PHP echo ++$ind; ?>" placeholder="Qual a Despesa?" />
					</div>
					<div class="col-xs-3"><label>Código de Acesso:</label>
						<input type="text" id="acesso" name="acessoDebitar" class="form-control" value="<?PHP echo $acessoDebitar; ?>" required="required" tabindex="<?PHP echo ++$ind; ?>" />
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
						<input type="text" id="inputCta" class="form-control" autofocus="autofocus" tabindex="<?php echo ++$ind; ?>" name="nome1" placeholder="Nome ou partes deles para procurarmos, a partir de 2 caracteres!">
					</div>
					<div class="col-xs-3"><label>Código de Acesso:</label>
						<input type="text" id="inputCta2" name="acessoCreditar" value="<?PHP echo $acessoCreditar; ?>" required="required" tabindex="<?PHP echo ++$ind; ?>" class="form-control">
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
				<input type="text" size="78%" name="det" disabled="disabled" class="form-control" />
			</td>
		</tr>
	</tbody>
</table>