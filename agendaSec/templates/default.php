<link rel="stylesheet" type="text/css" href="agendaSec/css/default.css">
<?php
	javaScript();
	$link = './controller/modeloPrint.php/?igreja='.$i.'&month='.$m.'&year='.$y.'&day='.$d.'&tipo=2';
?>
<table class='table'>
<tr>
	<td>
		<?php echo $scrollarrows;?>
	</td>
	<!-- form tags must be outside of <td> tags -->
	<td align="right" width='60%'>
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
<tr>
	<td colspan="3">
	<?php echo writeCalendar($m, $y,$i);?>
	</td>
</tr>
</table>
