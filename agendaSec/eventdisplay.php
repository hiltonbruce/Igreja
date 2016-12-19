<?php
session_start();
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
$dateline 	= "$d de "  . $lang['months'][$m-1] . " de $y";
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
	echo '<span class="display_header">' . $lang['otheritems'] . '</span>';
	echo '<br clear="all"><img src="images/clear.gif" width="1" height="3" border="0"><br clear="all">';

	// display rest of this day's postings
	while ($row = mysql_fetch_array($result)) {
		writePosting($row[0], $auth);
		echo '<img src="images/clear.gif" width="1" height="12" border="0"><br clear="all">';
	}
}
echo "</body></html>";

function writeHeader($m, $y, $dateline, $wday, $auth)
{
	global $lang;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Eventos</title>
	<link rel="stylesheet" type="text/css" href="./css/popwin.css">
<?php 	if ($_SESSION['setor']=='3') { ?>
	<script language="JavaScript">
		function deleteConfirm(eid) {
			var msg = "<?php echo $lang['deleteconfirm'];?>";
			if (confirm(msg)) {
				opener.location = "./eventsubmit.php?flag=delete&id=" + eid + "&month=<?php echo $m;?>&year=<?php echo $y;?>";
				window.setTimeout('window.close()', 1000);
			} else {
				return;
			}
		}
	</script>
<?php	} ?>
</head>
<body>

<!-- selected date -->
<table cellspadding="0" cellspacing="0" border="0" width="300">
<tr>
	<td><span class="display_header"><?php echo $dateline ?></span></td>
	<td align="right"><span class="display_header"><?php echo $lang['days'][$wday] ?></span></td>
</tr>
</table>
<img src="images/clear.gif" width="1" height="3" border="0"><br clear="all">
<?php
}

function writePosting($id, $auth)
{
	global $lang;

	$sql = "SELECT a.y, a.m, a.d, a.title, a.text, a.start_time, a.end_time, ";
	$sql .= "a.uid, u.cpf, u.nome, u.cargo, ";
	if (TIME_DISPLAY_FORMAT == "12hr") {
		$sql .= "TIME_FORMAT(a.start_time, '%l:%i%p') AS stime, ";
		$sql .= "TIME_FORMAT(a.end_time, '%l:%i%p') AS etime ";
	} elseif (TIME_DISPLAY_FORMAT == "24hr") {
		$sql .= "TIME_FORMAT(a.start_time, '%H:%i') AS stime, ";
		$sql .= "TIME_FORMAT(a.end_time, '%H:%i') AS etime ";
	} else {
		echo "Bad time display format, check your configuration file.";
	}
	$sql .= "FROM " . DB_TABLE_PREFIX . "mssgs AS a ";
	$sql .= "LEFT JOIN usuario AS u ";
	$sql .= "ON (a.uid = u.cpf ) ";
	$sql .= "WHERE a.id = " . $id;
	$result = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($result);
	$title		= stripslashes($row["title"]);
	$body		= stripslashes(str_replace("\n", "<br />", $row["text"]));
	$postedby 	= $lang['postedby'] . ": " . $row['nome'] . " " . $row['cargo'];
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
	if ($_SESSION['authdata']['uid'] == $row['uid']) {
		$editstr = "<span class=\"display_edit\">";
		$editstr .= "[<a href=\"eventform.php?id=" . $id . "\">editar</a>]&nbsp;";
		$editstr .= "[<a href=\"#\" onClick=\"deleteConfirm(" . $id . ");\">apagar</a>]&nbsp;</span>";
	} else {
		$editstr = "";
	}
?>
	<table cellspacing="0" cellpadding="0" border="0" width="300" class='table' >
		<tr><td bgcolor="#000000">
			<table cellspacing="1" cellpadding="1" border="0" width="100%">
				<tr>
					<td class="display_title_bg"><table cellspacing="0" cellpadding="0" border="0" width="100%"><tr>
							<td width="100%"><span class="display_title">&nbsp;<?php echo $title;?></span></td>
							<td><img src="images/clear.gif" width="20" height="1" border="0"></td>
							<td align="right" nowrap="yes"><span class="display_title"><?php echo $timestr;?>&nbsp;</span></td>
					</tr></table></td>
				</tr>
				<tr><td class="display_txt_bg">
					<table class='table' >
						<tr>
							<td><span class="display_txt"><?php echo $body;?></span></td>
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
	</td></tr></table>
<?php
}
?>
