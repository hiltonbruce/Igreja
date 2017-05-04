<fieldset>
	<legend>Filtrar recibos</legend>
	<div class="form-group">
	<form method="get" name="" action="">
	<div class="row">
  <div class="col-xs-5">
		<label>Nome:</label>
		<input type="text" name="nome" id="campo_estado" autofocus="autofocus"
		class="form-control  input-sm" placeholder="Nome do Membro" tabindex="<?php echo ++$ind;?>"
		value="<?php if ($_GET['rol']<'1') echo $_GET['nome'];?>" />
</div>
  <div class="col-xs-2">
		<label>Por Rol:</label>
	 <input type="text" id="rol" name="rol" value="<?php echo $rol;?>"
		tabindex="<?php echo ++$ind;?>" class="form-control  input-sm" placeholder="Rol" />
</div>
<div class="col-sm-3">
	<label>Por CPF</label>
	<input type="text" name="cpf" class="form-control input-sm" id="cpf" placeholder="N&uacute;mero" >
</div>
<div class="col-sm-2">
	<label>Por RG</label>
	<input type="text" name="rg" class="form-control input-sm" id="rg" placeholder="N&uacute;mero" >
</div>
	<div class="col-xs-5">
	<label>Credores</label>
	<?php
		$for_num = new List_sele("credores", "alias", "recebeu");
		echo $for_num->List_Selec($ind++,$recebeu,'class="form-control input-sm"');
	?>
	</div>
  <div class="col-xs-2">
			<label>Dia:</label>
			<input type="text" size="2" maxlength="2" name="dia"
			value="<?php echo $_GET['dia'];?>"tabindex="<?PHP echo ++$ind; ?>"
			 class="form-control  input-sm" placeholder="dia" />
  </div>
  <div class="col-xs-3">
			<label>M&ecirc;s:</label>
			<select name="mes" tabindex="<?PHP echo ++$ind; ?>" class="form-control  input-sm" >
						<?php
						$mesSel = arrayMeses();
						$mesPerido = $mesSel[$mesPer];
						$linha1 = '<option value="0">Selecione o m&ecirc;s...</option>';
						foreach($mesSel as $mes => $meses) {
						 $linha2 .= '<option value='.$mes.'>'.$meses.'</options>';
							 if ($_GET['mes']==$mes) {
								$linha1 = '<option value='.$mes.'>'.$meses.'</options>'.$linha1;
								$mesPerido = $meses;
							 }
							}
							echo $linha1.$linha2;
							if ($diaPer=='' && $mesPerido=='' && $anoPer<'2000') {
								$perLista = 'Todos os anos';
							} elseif ($diaPer!='' && $mesPerido=='' && $anoPer<'2000') {
								$perLista = 'Todos do dia '.$diaPer;
							} elseif ($diaPer=='' && $mesPerido=='' && $anoPer!=''){
								$perLista = 'Todos ano de '.$anoPer;
							} elseif ($diaPer=='' && $mesPerido!='' && $anoPer<'2000') {
								$perLista = 'Todos do m&ecirc;s de '.$mesPerido;
							}elseif ($diaPer=='' && $mesPerido!='' && $anoPer!='') {
								$perLista = 'Todos de '.$mesPerido.' de '.$anoPer;
							} elseif ($diaPer!='' && $mesPerido=='' && $anoPer!='') {
								$perLista = 'Todos do dia '.$diaPer.' e do ano '.$anoPer;
							} else {
								$perLista = 'Todos da data: '.$diaPer.' de '.$mesPerido.' de '.$anoPer ;
							}
						?>
					</select>
  </div>
  <div class="col-xs-2">
		<label>Ano</label>
		<input type="text" name="ano" value="<?php echo $anoForm;?>"
		tabindex="<?PHP echo ++$ind; ?>" class="form-control  input-sm" placeholder="Ano" />
  </div>
  <div class="col-xs-5">
	<label>Congrega&ccedil;&atilde;o:</label>
	<?php
		$bsccredor = new List_sele('igreja', 'razao', 'igreja');
		$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],'class="form-control  input-sm"');
		echo $listaIgreja;
		$linkPrint = './controller/modeloPrint.php/?nome='.$nome.'&rol='.$rol.'&cpf='.$cpf.'&rg='.$rg.'&recebeu='.$recebeu.'&dia='.$diaPer.'&mes='.$mesPer.'&ano='.$anoPer.'&igreja='.$igr.'&tipo=4';
	?>
</div>
  <div class="col-xs-2">
		<input name="escolha" type="hidden" value="controller/recibo.php" />
		<input type="hidden" name="rec"	value="<?php echo $recMenu;?>" />
		<label>&nbsp;</label>
		<input type="submit" class="btn btn-primary btn-sm" name="Submit" value="Listar..."
		tabindex="<?PHP echo ++$ind; ?>" />
		<input name="menu" type="hidden" value="top_tesouraria" />
  </div>
	  <div class="col-xs-2">
		<label>&nbsp;</label>
		<a href='<?php echo $linkPrint;?>'
		target="_blank">
			<button type="button" class="btn btn-default btn-sm">
				<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir...
			</button>
		</a>
	  </div>
</div>
	</form>
	</div>
</fieldset>
<?php
$titTable = '<div class="bs-example-bg-classes"><h5><p class="bg-info">'.$perLista.'</p><h5></div><h6>';
$tagFimTable = '</h6>';
	require_once 'help/tes/listRec.php';
?>
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
