<fieldset>
<legend>Impress&atilde;o de Recibos</legend>
<form id="form1" name="form1" method="post" action="controller/recibo.php" target="_blank">
<div class="row">
  <div class="col-xs-12">
		<label>N&uacute;mero, sequ&ecirc;ncia ou faixa de recibos</label> <input
			type="text" name="numeros" class="form-control" autofocus="autofocus"
			tabindex="<?PHP echo $ind++;?>" required="required"
			value="<?php echo $_GET["nome"];?>" />
  </div>
  <div class="col-xs-12">
		<div class="checkbox">
			<label>
				<input type="checkbox" name="envelope" value="1">Envelope - Marque aqui p/ imprimir <strong>exclusivamente</strong> os envelopes
			</label>
		</div>
  </div>
  <div class="col-xs-3">
		<label>Grupo p/ Observa&ccedil;&atilde;o: </label>
		<select name="grupo" id="grupo"	tabindex="<?PHP echo ++$ind; ?>" class="form-control" autofocus="autofocus">
				<option></option>
				<option value="485">Minist&eacute;rio</option>
				<option value="143">Tesoureiros</option>
				<option value="103">Aux&iacute;lio</option>
				<option value="88">Zelador</option>
				<option value="180">Todos</option>
		</select>
  </div>
  <div class="col-xs-9">
		<label>Texto para exibir nos envolpes</label>
		<textarea rows="2" name="obs" class="form-control" ></textarea>
	</div>
  <div class="col-xs-12">
		<input type="submit" class="btn btn-primary" name="Submit" value="Imprimir..." tabindex="<?PHP echo ++$ind; ?>"/>
  </div>
</div>
<input type="hidden" name="rec" value="21">
</form>
<br/>
<div class="alert alert-warning alert-dismissible fade in" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h3>Exemplos de impress&otilde;es:</h3>
	<strong>1,2,3</strong> &rarr; Imprimir recibos 1,2,3 <br/>
	<strong>1-5</strong>&nbsp;&nbsp;&nbsp; &rarr;Imprimir
		todos do 1 ao 5  <br/>
	<strong>8 -</strong>&nbsp;&nbsp;&nbsp;&nbsp; &rarr; apartir do cinco em diante<br/>
	<p class="text-danger"><strong>Obs.: As impress&otilde;es n&atilde;o devem ultrapassar 200 recibos</strong></p>
</div>
</fieldset>
