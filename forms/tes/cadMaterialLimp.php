
<fieldset>
	<legend>
		Cadastrar Material de Limpeza
	</legend>

<form class="" action="./" method="get">
<div class="row">
<div class="col-xs-2">
	<label><small>Conte&uacute;do <span class="glyphicon glyphicon-question-sign
		text-danger" aria-hidden="true" data-toggle="tooltip" data-placement="top"
		title="Quantidade por unidade"></span></small></label>
		<input type="number" name="quant" class="form-control input-sm" autofocus required>
</div>
<div class="col-xs-2">
	<?php
	require_once ('forms/tes/selecMedida.php');
	echo $selMat;
	 ?>
</div>

<div class="col-xs-6">
	<label><small>Discrimina&ccedil;&atilde;o</small></label><input type="text" name="discrim" class="form-control input-sm" placeholder="Discriminação"  required>
</div>

<div class="col-xs-2">
	<label><small>Tempo <span class="glyphicon glyphicon-question-sign text-danger" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Valor em m&ecirc;s(es)"></span></small></label>
	<input type="number" name="tempo" class="form-control input-sm">
</div>

<div class="col-xs-2">
	<label><small data-toggle="tooltip" data-placement="top" title="Quantidade p/ Igreja classe 1 - Ver Cadastro">Igreja Classe 1</small></label>
	<input type="number" name="tipo1" class="form-control input-sm">
</div>

<div class="col-xs-2">
	<label><small data-toggle="tooltip" data-placement="top" title="Quantidade p/ Igreja classe 2 - Ver Cadastro">Igreja Classe 2</small></label>
	<input type="number" name="tipo2" class="form-control input-sm"></div>
<div class="col-xs-2">
	<label><small data-toggle="tooltip" data-placement="top" title="Quantidade p/ Igreja classe 3 - Ver Cadastro">Igreja Classe 3</small>
</label><input type="number" name="tipo3" class="form-control input-sm">
</div>
<div class="col-xs-2">
	<label><small data-toggle="tooltip" data-placement="top" title="Quantidade p/ Igreja classe 4 - Ver Cadastro">Igreja Classe 4</small></label><input type="number" name="tipo4" class="form-control input-sm">
</div>
<div class="col-xs-2">
	<label><small data-toggle="tooltip" data-placement="top" title="Quantidade p/ Igreja classe 5 - Ver Cadastro">Igreja Classe 5</small></label><input type="number" name="tipo5" class="form-control input-sm">
</div>
<div class="col-xs-2">
	<label><small data-toggle="tooltip" data-placement="top" title="Valor unit&aacute;rio em R$">Valor</small></label>
	<input type="text" name="valor" class="form-control input-sm money">
</div>
<div class="col-xs-2">
	<label><small>&nbsp;</small></label><input type="submit" class=" form-control input-sm btn-primary btn-xs" value="Cadastrar!">
</div>
<input type="hidden" name="escolha" value="controller/limpeza.php">
<input type="hidden" name="status" value="1">
<input type="hidden" name="cad" value="<?php echo date('Y-m-d H:i:s');?>">
<input type="hidden" name="hist" value="<?php echo $_SESSION['nome'].'-'.$_SESSION['valid_user'];?>">
<input type="hidden" name="menu" value="top_tesouraria">'
<input type="hidden" name="limpeza" value="14">
</form>

</fieldset>
