<?php javaScript();?>
	<link rel="stylesheet" type="text/css" href="agendaSec/css/default.css">
<table class='table'>
<tr>
	<td width='40%'>
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
</tr>
<tr>
	<td colspan="3">
	<?php echo writeCalendar($m, $y,$i);?>
	</td>
</tr>
</table>
