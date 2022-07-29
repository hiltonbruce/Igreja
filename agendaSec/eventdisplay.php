<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'off');
require("./config.php");
require("./lang/lang." . LANGUAGE_CODE . ".php");
require("./functions.php");
require "../func_class/funcoes.php";
require "../func_class/classes.php";
$id 	= intval($_GET['id']);
$sql = "SELECT d, m, y FROM " . DB_TABLE_PREFIX . "mssgs WHERE id=" . $id;
$result = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_array($result);
$d 			= $row["d"];
$m 			= $row["m"];
$y 			= $row["y"];
$dateline	= sprintf("%02d de %s  de  %s", $d,$lang['months'][$m-1],$y);
$wday 		= date("w", mktime(0,0,0,$m,$d,$y));
writeHeader($m, $y, $dateline, $wday, $auth);
// display selected posting first
writePosting($id, $auth);
// give some space
echo '<img src="images/clear.gif" width="1" height="25" border="0"><br clear="all">';
// query for rest of this day's postings
$sql = "SELECT id, start_time FROM " . DB_TABLE_PREFIX . "mssgs ";
$sql .= "WHERE y = " . $y . " AND m = " . $m . " AND d = " . $d . " AND id != $id ";
$sql .= "ORDER BY start_time ASC";
$result = mysql_query($sql) or die(mysql_error());
if (mysql_num_rows($result)) {
	echo '<span class="display_otheritems">' . $lang['otheritems'] . '</span>';
	echo '<br clear="all"><img src="images/clear.gif" width="1" height="3" border="0"><br clear="all">';
	// display rest of this day's postings
	while ($row = mysql_fetch_array($result)) {
		writePosting($row[0], $auth);
		echo '<img src="images/clear.gif" width="1" height="12" border="0"><br clear="all">';
	}
}
echo "</body></html>";
function writeHeader($m, $y, $dateline, $wday)
{
	global $lang;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Eventos</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<link rel="stylesheet" type="text/css" href="./css/popwin.css">
	<script language="JavaScript">
		function deleteConfirm(eid) {
			var msg = "<?php echo $lang['deleteconfirm'];?>";
			if (confirm(msg)) {
				opener.location = "eventsubmit.php?flag=delete&id=" + eid + "&month=<?php echo $m;?>&year=<?php echo $y;?>";
				window.setTimeout('window.close()', 1000);
			} else {
				return;
			}
		}
	</script>
</head>
<body>
<!-- selected date -->
<table class='table'>
<tr>
	<td><span class="display_header"><?php echo $dateline; ?>, </span></td>
	<td align="right"><span class="display_header"><?php echo $lang['days'][$wday] ?></span></td>
</tr>
</table>
<img src="images/clear.gif" width="1" height="3" border="0"><br clear="all">
<?php
}

function writePosting($id, $auth)
{
	global $lang;
	$sql = 'SELECT a.y,a.m,a.d,a.title,a.text,a.start_time,a.end_time, ';
	$sql .= 'a.uid, a.setor, a.igreja, u.cpf, u.nome, u.cargo, i.razao, ';
	$sql .= 's.alias, ';
	if (TIME_DISPLAY_FORMAT == '12hr') {
		$sql .= 'TIME_FORMAT(a.start_time, "%l:%i%p") AS stime, ';
		$sql .= 'TIME_FORMAT(a.end_time, "%l:%i%p") AS etime ';
	} elseif (TIME_DISPLAY_FORMAT == "24hr") {
		$sql .= 'TIME_FORMAT(a.start_time, "%H:%i") AS stime, ';
		$sql .= 'TIME_FORMAT(a.end_time, "%H:%i") AS etime ';
	} else {
		echo 'Formato de exibição de data incorreto, verifique o arquivo de configuração.';
	}
	$sql .= 'FROM ' . DB_TABLE_PREFIX . 'mssgs AS a ';
	$sql .= 'LEFT JOIN usuario AS u ';
	$sql .= 'ON (a.uid = u.cpf ) , igreja AS i, setores AS s ';
	$sql .= 'WHERE a.id = "'.$id.'" AND (a.igreja = i.rol || a.igreja = "0" || a.igreja = "-1") ';
	$sql .= "AND a.setor=s.id GROUP BY a.id ORDER BY start_time";
	$result = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($result);
	$title		= stripslashes($row["title"]);
	$body		= stripslashes(str_replace("\n", "<br />", $row["text"]));
	if ($row["igreja"]=='0') {
		$razao = '<strong>Sede e Congrega&ccedil;&otilde;es</strong>';
	}elseif ($row["igreja"]=='-1') {
		$razao = '<strong>Congrega&ccedil;&otilde;es</strong>';
	} else {
		$razao = $row["razao"];
	}
//$eventdata[
	$postedby 	= $lang['postedby'] . ": " . $row['nome'] . "<br />" . $row['cargo'];
	$setorIgrea 	= 'Local do evento: '  . $razao . '<br />Cadastro pela: '.$row["alias"];
	if (!($row["start_time"] == "55:55:55" && $row["end_time"] == "55:55:55")) {
		if ($row["start_time"] == "55:55:55")
			$starttime = "- -";
		else
			$starttime = $row["stime"];

		if ($row["end_time"] == "55:55:55")
			$endtime = "- -";
		else
			$endtime = $row["etime"];

		$timestr = "$starttime - $endtime";
	} else {
		$timestr = "";
	}
	if ($_SESSION['setor'] == $row['setor']) {
		$editstr = "<span class=\"display_edit\">";
		$editstr .= "<a href=\"eventform.php?id=" . $id . "\"><button class='btn btn-primary btn-xs'>";
		$editstr .= "editar</button></a>&nbsp;";
		$editstr .= "<a href=\"#\" onClick=\"deleteConfirm(" . $id . ");\">";
		$editstr .= "<button class='btn btn-danger btn-xs'>apagar</button></a>&nbsp;</span>";
	} else {
		$editstr = "";
	}
?>
<table class="table" style="width:100%">
	<tr>
		<td  class='primary'><table class='table'><tr>
				<td width="100%"><span class="display_title">&nbsp;<?php echo $title;?></span></td>
				<td align="right" nowrap="yes"><span class="display_title"><?php echo $timestr;?>&nbsp;</span></td>
		</tr></table></td>
	</tr>
	<tr><td class="display_txt_bg">
		<table class='table' style="width:100%" >
			<tr>
				<td><span class="display_txt"><?php echo $body;?></span></td>
			</tr>
			<tr>
				<td align="right"><span class="display_txt"><?php echo $setorIgrea;?></td>
			</tr>
			<tr>
				<td align="right"><span class="display_user"><?php echo $postedby;?></td>
			</tr>
			<tr>
				<td align="right"><?php echo $editstr;?></td>
			</tr>
		</table>
	</td></tr>
</table>
<?php
}
?>
