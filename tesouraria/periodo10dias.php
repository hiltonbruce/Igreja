<?php
if ($_SESSION["setor"]==2 || $_SESSION["setor"]>50){
	$dias = $_GET['altdias'];
	$d = ((int)$dias=='0' ) ? date("d"): $dias;
	$m = date("m");
	$y = date("Y");
	$credor = ($_GET['credor']>'0') ? $_GET['credor']:'0';
	
	if (empty($_GET['id'])) {
	?>
<fieldset>
<legend>Busca por Despesas Agendadas</legend>
<table>
	<tbody>
		<tr>
			<td>
				<form action="" method="get">
					<input type="hidden" name='escolha' value="tesouraria/agenda.php">
					<input type="hidden" name='menu' value="top_tesouraria">
					<label>N&ordm;&nbsp;negativo&nbsp;volta&nbsp;e&nbsp;positivo&nbsp;andianta&nbsp;a&nbsp;agenda</label>
					<input type="text" name="altdias" class="form-control" title="Valor negativo volta e positivo andianta os dias na agenda">
			</td>
			<td>
					<label>&nbsp;</label>
					<input type="submit" class="form-control btn-primary" name="submit" value="Listar">
				</form>
			</td>
			<td><label>&nbsp;</label><a href="./?escolha=<?PHP echo $_GET["escolha"];?>&menu=top_tesouraria&igreja=
			<?php echo $_GET['igreja']?>&credor=<?php echo $_GET['credor']?>&altdias=
			<?PHP echo $dias-1;?>" ><button type="button" class="btn btn-primary"> 
			 <span class=" glyphicon glyphicon-arrow-left"> </span> Voltar 1 dia</button></a>

  </td>
					
			<td><label>&nbsp;</label><a href="./?escolha=<?PHP echo $_GET["escolha"];?>&menu=top_tesouraria&igreja=<?php echo $_GET['igreja']?>&credor=
			<?php echo $_GET['credor']?>&altdias=<?PHP echo $dias+1;?>" >
	  	<button type="button" class="btn btn-primary">
	  	Adiantar 1 dia <span class="glyphicon glyphicon-arrow-right"> </span></button></a></td>
		</tr>
		<tr>
			<td>Por fornecedor:
	  <select name="credor" id="credor" class="form-control" onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>" >
		  <?php 
		  	$bsccredor = new list_fornecedor('credores', 'alias', 'credor');
		  	echo $bsccredor->List_Selec_pop('escolha='.$_GET["escolha"].'&menu=top_tesouraria&altdias='.$dias.'&credor=');
		  ?>
	  </select></td>
			<td colspan="2">Por Igreja:
	  <select name="igreja" id="igreja" class="form-control" onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>" >
		  <?php 
		  	$bsccredor = new List_sele('igreja', 'razao', 'igreja');
		  	echo $bsccredor->List_Selec_pop('escolha='.$_GET["escolha"].'&menu=top_tesouraria&credor='.$_GET["credor"].'&altdias='.$dias.'&igreja=',$_GET['igreja']);
		  ?>
	  </select></td>
			<td></td>
		</tr>
	</tbody>
</table>
	  <form method="get" action="" class="form-vertical" >
<table>
	<tbody>
		<tr>
			<td><label>Despesas:</label>
	  		<input type="checkbox" name="fixa">Mensais e
		</td>
			<td><label>&nbsp;</label>
		  <input type="checkbox" name="prazo">Com prazo determinado
		</td>
			<td><label>Com prazo:</label>
	 		  <input type="radio" name='vencidas' value="2" checked="checked"> Com data vencida ou
		</td>
			<td><label>&nbsp;</label>
	  		<input type="radio" name='vencidas' value="3"> Todas as datas despesas!
		</td>
		</tr>
		<tr>
			<td colspan="2">
	  	<label>Motivo do agendamento</label>
	  	<input type="text" name="motivo" class="form-control" autofocus="autofocus"
	  	 placeholder="Informe o motivo para procurarmos">
	  <input type="hidden" name="menu" value="top_tesouraria">
	  <input type="hidden" name="escolha" value="<?PHP echo $_GET["escolha"];?>">
	  <input type="hidden" name="credor" value="<?php echo $_GET['credor']?>"></td>
			<td><label>&nbsp;</label><input type="submit" class="btn btn-primary" value="Listar...">
			
			<td></td>
		</tr>
	</tbody>
</table>
</form>
</fieldset>
<?php } ?>
<table cellspacing="0" id="Contas do per&iacute;odo" width="95%" >
			<colgroup>
				<col id="dia">
				<col id="Evento">
				<col id="albumCol"/>
			</colgroup>
		<thead>
			<tr>
				<th scope="col">Dia</th>
				<th scope="col">Evento</th>
				<th scope="col">Total</th>
			</tr>
		</thead>
		<tbody id="periodo" >
		<?php 
			for ($p = 0; $p < 12; $p++) {
				$altdias = $_GET['altdias'];
				$dia_periodo = $p-5+$dias;
				$dia_periodo = strtotime("$dia_periodo days");
				
				if (date('d')==date('d',$dia_periodo)) {
					$trtab = '<tr bgcolor="#90EE90">';
				}else {
				$trtab = ($p % 2) == 0 ? '<tr class="dados" >' : '<tr >';
				}
				echo $trtab;
				echo '<td>'.date('d/m',$dia_periodo).' - '.date('D',$dia_periodo).'</td><td>';
				$evento = $lista->periodo(date('Y-m-d',$dia_periodo),$credor,$dataget);//usa o objeto do script tesouraria/agenda.php com $lista = new agenda();
				echo '</tr>';
			}
		?>
		</tbody>
</table>
	<a href="./?escolha=tesouraria/agenda.php&menu=top_tesouraria&vencidas=1&data=<?php echo $dataget;?>" title="Clique aqui para Listar...">
	<button class="btn btn-primary">Contas vencidas a mais de 5 dias: <?php echo $lista->vencidas();?></button>
	</a>
<?php	
}
 ?>