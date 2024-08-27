<?php
	if (empty($_GET['altdias'])) {
		$dias='';
	}else {
		$dias=$_GET['altdias'];
	}
	#Marca a opção da despesa com prazo
	if (empty($_GET['vencidas']) ) {
		$vencida2 = 'checked="checked"';
	} elseif ($_GET['vencidas']=='3') {
		$vencida3 = 'checked="checked"';
	}else {
		$vencida2 = 'checked="checked"';
		$vencida3 ='';
	}
?>
<fieldset>
<legend>Busca por Despesas Agendadas</legend>
<div class="row">
	<div class="col-xs-4">
	<form action="" method="get">
			<label>N&ordm;&nbsp;negativo&nbsp;volta&nbsp;e&nbsp;positivo&nbsp;andianta&nbsp;a&nbsp;agenda</label>
			<input type="text" name="altdias" class="form-control" value="<?php echo $dias;?>"
			placeholder="Valor negativo volta e positivo andianta os dias na agenda"
			title="Valor negativo volta e positivo andianta os dias na agenda">
			<input type="hidden" name='escolha' value="tesouraria/agenda.php">
			<input type="hidden" name='menu' value="top_tesouraria">
	</div>
  <div class="col-xs-2">
			<label>&nbsp;</label>
			<input type="submit" class="form-control btn-primary" name="submit" value="Listar">
		</form>
  </div>
  <div class="col-xs-3">
		<label>&nbsp;</label>
		<a href="./?escolha=<?PHP echo $escGET;?>&menu=top_tesouraria&igreja=
	<?php echo $_GET['igreja'];?>&credor=<?php echo $credorAgenda;?>&altdias=<?PHP echo $dias-1;?>" >
	<button type="button" class="form-control btn-primary">
	 <span class=" glyphicon glyphicon-arrow-left"> </span> Voltar 1 dia</button></a>
  </div>
  <div class="col-xs-3">
		<label>&nbsp;</label><a href="./?escolha=<?PHP echo $escGET;?>&menu=top_tesouraria&igreja=<?php echo $_GET['igreja'];?>&credor=
		<?php echo $credorAgenda;?>&altdias=<?PHP echo $dias+1;?>" >
		<button type="button" class="form-control btn-primary">
		Adiantar 1 dia <span class="glyphicon glyphicon-arrow-right"> </span></button></a>
  </div>
  <div class="col-xs-6"><label>Por fornecedor:</label>
	<select name="credor" id="credor" class="form-control" onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>" >
	<?php
		$bsccredor = new list_fornecedor('credores', 'alias', 'credor');
		echo $bsccredor->List_Selec_pop('escolha='.$_GET["escolha"].'&menu=top_tesouraria&altdias='.$dias.'&igreja='.$_GET['igreja'].'&credor=');
	?>
</select>
  </div>
  <div class="col-xs-6"><label>Por Igreja:</label>
	  <select name="igreja" id="igreja" class="form-control" onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>" >
		  <?php
		  	$bsccredor = new List_sele('igreja', 'razao', 'igreja');
		  	echo $bsccredor->List_Selec_pop('escolha='.$_GET["escolha"].'&menu=top_tesouraria&credor='.$credorAgenda.'&altdias='.$dias.'&igreja=',$_GET['igreja']);
		  ?>
	  </select>
  </div>
	<form method="get" action="" class="form-vertical" >
  <div class="col-xs-2 "><label>Despesas do tipo:
		<h5><input type="checkbox" name="fixa"> Mensais ou</label></h5>
  </div>
  <div class="col-xs-3"><label>&nbsp;
	<h5><input type="checkbox" name="prazo"> Com prazo determinado</label></h5>
  </div>
  <div class="col-xs-3"><label>Despesas com prazo:
		<h5><input type="radio" name='vencidas' value="2" <?PHP echo $vencida2;?> >
		Com data vencida ou</label></h5>
  </div>
  <div class="col-xs-4"><label>&nbsp;
		<h5><input type="radio" name='vencidas' value="3" <?PHP echo $vencida3;?> >
		 Com todas as datas!</label></h5>
  </div>
  <div class="col-xs-8"><label>Motivo do agendamento</label>
	<input type="text" name="motivo" class="form-control" autofocus="autofocus"
	 placeholder="Informe o motivo para procurarmos">
<input type="hidden" name="menu" value="top_tesouraria">
<input type="hidden" name="igreja" value="<?PHP echo $_GET["igreja"];?>">
<input type="hidden" name="altdias" value="<?PHP echo $dias;?>">
<input type="hidden" name="escolha" value="<?PHP echo $_GET["escolha"];?>">
<input type="hidden" name="credor" value="<?php echo $_GET['credor']?>">
  </div>
  <div class="col-xs-2">
    <label>&nbsp;</label><input type="submit" class="btn btn-primary" value="Listar...">
  </div>
	</form>
</div>
</fieldset>

