<?php
session_start();
require("config.php");
require("./lang/lang.admin." . LANGUAGE_CODE . ".php");
require("functions.php");
require "../func_class/classes.php";

//$auth 	= auth();
$id 	= intval($_GET['id']);
$uid	= $_SESSION['authdata']['uid'];
//print_r($_SESSION);

if ($_SESSION['setor']=='3') {
	if (empty($id)) {
		displayEditForm('Add', $uid);
	} else {
		$sql = "SELECT uid FROM " . DB_TABLE_PREFIX . "mssgs WHERE id = $id";

		$result = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($result);

		if ( $auth == 2 || $uid == $row['uid'] ) {
			displayEditForm('Edit', $uid, $id);
		} else {
			echo $lang['accessdenied'];
		}
	}
} else {
	echo $lang['accessdenied'];
}

function displayEditForm($mode, $uid, $id="")
{
	global $lang;
	if ($mode == "Add") {
		//global $HTTP_GET_VARS;
		$d 			= $_GET['d'];
		$m 			= $_GET['m'];
		$y 			= $_GET['y'];
		$text 		= $title = "";
		$shour 		= $sminute = 0;
		$ehour 		= $eminute = 0;
		$headerstr 	= $lang['addheader'];
		$buttonstr 	= $lang['addbutton'];
		$pgtitle 	= $lang['addeventtitle'];
		$qstr 		= "?flag=add";
	} elseif ($mode == "Edit") {
		$sql = "SELECT uid, y, m, d, start_time, end_time, title, text ";
		$sql .= "FROM " . DB_TABLE_PREFIX . "mssgs WHERE id = $id";
		$result = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($result);
		if (!empty($row)) {
			$qstr 		= "?flag=edit&id=$id";
			$headerstr 	= $lang['editheader'];
			$buttonstr	= $lang['editbutton'];
			$pgtitle 	= $lang['editeventtitle'];
			$title 		= stripslashes($row["title"]);
			$text 		= stripslashes($row["text"]);
			$m 			= $row["m"];
			$d 			= $row["d"];
			$y 			= $row["y"];
		}

		getPullDownTimeValues($row["start_time"], $shour, $sminute, $spm);
		getPullDownTimeValues($row["end_time"], $ehour, $eminute, $epm);
	} else {
		echo $lang['accesswarning'];
	}
?>
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
	<html>
	<head>
		<title><?php echo $pgtitle;?></title>
		<link rel="stylesheet" type="text/css" href="css/popwin.css">

		<script language="JavaScript">
		function formSubmit() {
			if (document.eventForm.title.value != "") {
				document.eventForm.method = "post";
				document.eventForm.action = "eventsubmit.php<?php echo $qstr;?>";
				document.eventForm.submit();
			} else {
				alert("<?php echo $lang['titlemissing'];?>");
			}
		}
		</script>
	</head>
	<body>
	<span class="add_new_header"><?php echo $headerstr;?></span>
	<br><img src="images/clear.gif" width="1" height="5"><br>
		<table border=0 cellspacing=7 cellpadding=0>
		<form name="eventForm">
		<input type="hidden" name="uid" value="<?=$uid?>">
			<tr>
				<td nowrap valign="top" align="right" nowrap><span class="form_labels">
				<?php echo $lang['date'];?></span></td>
				<td><?php dayPullDown($d);
				monthPullDown($m, $lang['months']);
				yearPullDown('2016'); ?>
				</td>
			</tr>
			<tr>
				<td nowrap valign="top" align="right" nowrap>
				<span class="form_labels"><?php echo $lang['title'];?></span></td>
				<td><input type="text" name="title" size="29" value="<?php echo $title ?>"
				maxlength="50"></td>
			</tr>
			<tr>
				<td nowrap valign="top" align="right" nowrap>
				<span class="form_labels"><?php echo $lang['text'];?></span></td>
				<td><textarea cols=22 rows=6 name="text"><?php echo $text;?></textarea></td>
			</tr>
			<tr>
				<td nowrap valign="top" align="right" nowrap><span class="form_labels">
				<?php echo $lang['start'];?></span></td>
				<td><?php hourPullDown($shour, "start"); ?><b>:</b><?php minPullDown($sminute, "start");
				 amPmPullDown($spm, "start"); ?></td>
			</tr>
			<tr>
				<td nowrap valign="top" align="right" nowrap><span class="form_labels">
				<?php echo $lang['end'];?></span></td>
				<td><?php hourPullDown($ehour, "end"); ?><b>:</b><?php minPullDown($eminute, "end");
				amPmPullDown($epm, "end"); ?></td>
			</tr>
			<tr><td></td><td><br><input type="button" value="<?php echo $buttonstr;?>"
			onClick="formSubmit()">&nbsp;<input type="button" value="<?php echo $lang['cancel'];?>"
			onClick="window.close();"></td></tr>
		</form>
		</table>
	</body>
	</html>
<?php
}

function getPullDownTimeValues($time, &$hour, &$minute, &$pm)
{
	$hour	= (int) substr($time, 0, 2);
	$minute = (int) substr($time, 3, 2);
	if ($hour == 55) {
		$hour	= 0;
		$minute	= 0;
		$pm = false;
	} elseif ($hour > 12) {
		$hour = $hour - 12;
		$pm = true;
	} elseif ($hour == 12) {
		$pm = true;
	} elseif ($hour == 0) {
		$hour = 12;
		$pm = false;
	} else {
		$pm = false;
	}
}
?>
