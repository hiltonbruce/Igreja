<link rel="stylesheet" type="text/css" href="agendaSec/css/default.css">
<?php
	javaScript();
	$link = './controller/modeloPrint.php/?igreja='.$i.'&month='.$m.'&year='.$y.'&day='.$d.'&tipo=2';
?>
<table class='table' style='margin-bottom: 0px'>
<tr>
	<td>
		<?php echo $scrollarrows;?>
	</td>
	<!-- form tags must be outside of <td> tags -->
	<td align="right">
		<form name="monthYear" class="form-inline" action="" method="get">
			<div class="form-group">
				 <?php
					$bsccredor = new List_sele('igreja', 'razao', 'igreja');
					$listaIgreja = $bsccredor->List_Selec('',$i,'class="form-control" ');
					echo $listaIgreja;
					echo monthPullDown($m, $lang['months']).yearPullDown($y);
					?>
				<input name="escolha" type="hidden" value="controller/secretaria.php" >
				<input name="sec" type="hidden" value="2">
				<input type="submit" class='btn btn-primary btn-sm' value="Exibir" >
		</div>
	</form>
	</td>
	<td>
		<a href='<?php echo $link;?>' target="_blank">
			<button class='btn btn-primary' data-toggle="tooltip" data-placement="top"
			 title="Imprimir agenda"><span class="glyphicon glyphicon-print"
			aria-hidden="true"></span></button></a>
	</td>
</tr>
	<?php echo writeCalendar($m, $y,$i);?>
</table>
<!--
<fieldset>
	<legend>Rascunho</legend>
<form action="_GET" class="form-horizontal">
  <div class="form-group col-xs-6">
    <label>T&iacute;tulo</label>
    <input type="title" class="form-control" placeholder="T&iacute;tulo">
  </div>&nbsp;&nbsp;
  <div class="form-group col-xs-4">
    <label>Setor</label>
		<?php
		//	$setor = new List_setores();
		//	echo $setor->List_Setor(++$ind,'class="form-control"',50);
		 ?>
  </div>
  <div class="form-group col-xs-2 text-right"><br />
  <button type="submit" class="btn btn-primary" disabled>Cadastrar</button>
  </div>
  <div class="form-group has-error col-xs-12">
    <label>Texto</label>
    <textarea name="text" class='form-control'></textarea>
  </div>
</form>
</fiedset>
-->
