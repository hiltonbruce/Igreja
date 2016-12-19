<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Calendário de Eventos</title>
	<?php javaScript();?>
	<link rel="stylesheet" type="text/css" href="agendaSec/css/default.css">
</head>
<body>
<table class='table'>
<tr>
	<td>
		<table class='table'>
<tr>
<td><img SRC="agendaSec/images/tit-calendario.gif" height=59 width=310></td>
</tr>
</table><!-- Navegação e exibição do mês -->
		<?php echo $scrollarrows;?><span class="date_header">&nbsp;<?php echo $lang['months'][$m-1];?>&nbsp;
		<?php echo $y;?></span>
	</td>
	<!-- form tags must be outside of <td> tags -->
	<td align="right">
	<form name="monthYear" class="form-inline">
  <div class="form-group">
	<?php echo monthPullDown($m, $lang['months']).yearPullDown($y); ?>
	<input type="button" class='btn btn-primary btn-xs' value="Exibir" onClick="submitMonthYear()">
	</div>
	</form>

	</td>

</tr>
<tr>
	<td colspan="2" bgcolor="#000000">
	<?php echo writeCalendar($m, $y);?>
	</td>
</tr>
</table>
</body>
</html>
