<div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
	<h4>Certificado de Batismo</h4>
	<form method="post" action="views/secretaria/batismoCertificado.php" target="_blank">
		<p>
			<div class="row">
				<table class="table">
					<tr>
						<?php
						require_once "forms/buscaRecMembro.php";
						?>
					</tr>
				</table>
				<!-- <div class="col-xs-2">
					<label>Rol:</label>
					<input type="text" id='detalhe2' class="form-control" placeholder="N&ordm; do membro na igreja" name='rol' value='<?php echo $_GET['rol']; ?>' required='required'>
				</div> -->
				<!-- <div class="col-xs-6">
					<label>Fun&ccedil;&atilde;o e Congrega&ccedil;&atilde;o</label>
					<input type="text" class="form-control" id='acesso2'>
				</div> -->
				<input type="hidden" name="pastor" value="<?PHP echo strtr($igSede->pastor(), '�������������', 'aaaaeeiooouuc'); ?>">
				<!-- <div class="col-xs-3">
					<label>Data do Batismo</label>
					<input type="date" name="dtbatismo" class="form-control" id='id_val2'>
				</div>
				<div class="col-xs-1">
					<label>Sexo</label>
					<input type="text" name="sexo" class="form-control" id='sexo' placeholder="M ou F">
				</div> -->
				<div class="col-xs-3">
					<div class="checkbox">
						<label>
						  <input type="checkbox" name='anoBatismo' value="true">Exibir ano de Batismo ?
						</label>
					</div>
				</div>
				<div class="col-xs-6">
					<label>Secret&aacute;rio:..</label>
					<select name="secretario" id="secretario" class="form-control" tabindex="<?PHP echo $ind++; ?>">
						<option value="<?PHP echo $igSede->secretario1(); ?>"><?PHP echo fun_igreja($igSede->secretario1()); ?></option>
						<option value="<?PHP echo $igSede->secretario2(); ?>"><?PHP echo fun_igreja($igSede->secretario2()); ?></option>
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