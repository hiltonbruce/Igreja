<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Calendário de Eventos</title>
	<?php javaScript();?>
	<link rel="stylesheet" type="agendaSec/text/css" href="css/default.css">
</head>
<body>
<table cellpadding="0" cellspacing="0" border="0" align="center">
<tr>
	<td>
		<table BORDER=0 CELLSPACING=0 CELLPADDING=0 COLS=1 >
<tr>
<td><img SRC="agendaSec/images/tit-calendario.gif" height=59 width=310></td>
</tr>
</table>
		<?php echo $scrollarrows;?><span class="date_header">&nbsp;<?php echo $lang['months'][$m-1];?>&nbsp;
		<?php echo $y;?></span>
	</td>

	<!-- form tags must be outside of <td> tags -->
	<form name="monthYear">
	<td align="right">
	<?php echo monthPullDown($m, $lang['months']).yearPullDown($y); ?>
	<input type="button" value="Exibir" onClick="submitMonthYear()">
	</td>
	</form>

</tr>

<tr>
	<td colspan="2" bgcolor="#000000">
	<?php echo writeCalendar($m, $y);?>
	</td>
</tr>

<tr>
	<td colspan="2" align="center">
	<?php echo footprint($auth, $m, $y); ?>

	</td>
</tr>
</table>



</body>
</html>
