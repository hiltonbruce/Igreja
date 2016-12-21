<?php javaScript();?>
	<link rel="stylesheet" type="text/css" href="agendaSec/css/default.css">
<table class='table'>
<tr>
	<td>
		<?php echo $scrollarrows;?><span class="date_header">&nbsp;<?php echo $lang['months'][$m-1];?>&nbsp;
		<?php echo $y;?></span>
	</td>
	<!-- form tags must be outside of <td> tags -->
	<td align="right">
		<form name="monthYear" class="form-inline">
			<div class="form-group">
				<?php echo monthPullDown($m, $lang['months']).yearPullDown($y); ?>
				<input type="button" value="Exibir" onClick="submitMonthYear()">
			</div>
		</form>
	</td>
</tr>
<tr>
	<td colspan="2">
	<?php echo writeCalendar($m, $y);?>
	</td>
</tr>
</tr>
</table>
