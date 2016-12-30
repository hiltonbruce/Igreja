<?php
session_start();
  require("config.php");
  require("./lang/lang.admin." . LANGUAGE_CODE . ".php");
  require("functions.php");

if (!empty($_SESSION['valid_user'])) {
  require "../func_class/classes.php";
  function __autoload ($classe) {
    $pos = strpos($classe, '_');
    if ($pos === false) {
      $nomeClasse = $classe;
      $dir='';
    } else {
      list($dir,$nomeClasse) = explode('_', $classe);
    }
		//$dir = strtr( $classe, '_','/' );
		if (file_exists("../models/$dir/$classe.class.php")){
			require_once ("../models/$dir/$classe.class.php");
		}elseif (file_exists("models/$classe.class.php")){
			require_once ("../models/$classe.class.php");
		}
		//echo "<h1>$classe ** $dir</h1>";
		//echo "<h1>$classe ** $dir</h1>";
	}

//$auth 	= auth();
$id 	= intval($_GET['id']);
$uid	= $_SESSION['authdata']['uid'];
//print_r($_SESSION);

	if (empty($id)) {
		displayEditForm('Add', $uid);
	} else {
		$sql = "SELECT * FROM " . DB_TABLE_PREFIX . "mssgs WHERE id = $id";
		$result = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($result);
		if ( $_SESSION['setor'] == $row['setor'] ) {
			displayEditForm('Edit', $uid, $id);
		} else {
			echo $lang['accessdenied'];
		}
	}
} else {
	echo $lang['accessdenied'];
  exit;
}

function displayEditForm($mode, $uid, $id="")
{
	global $lang;
	if ($mode == "Add") {
		//global $HTTP_GET_VARS;
		$d 			= $_GET['d'];
		$m 			= $_GET['m'];
		$y 			= $_GET['y'];
		$i 			= 1;
		$text 		= $title = "";
		$shour 		= $sminute = 0;
		$ehour 		= $eminute = 0;
		$headerstr 	= $lang['addheader'];
		$buttonstr 	= $lang['addbutton'];
		$pgtitle 	= $lang['addeventtitle'];
		$qstr 		= "?flag=add";
	} elseif ($mode == "Edit") {
		$sql = "SELECT * ";
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
			$i 			= $row["igreja"];
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
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
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
	<body class="text-left" style="margin:10px auto; width: 90%;" >
	<h3><?php echo $headerstr;?></h3>
  <form name="eventForm" >
    <label>
    <?php echo $lang['date'];?>
    </label>
    <div class="row">
      <?php
      echo '<div class="col-xs-3">';
        dayPullDown($d);
      echo '</div><div class="col-xs-5">';
        monthPullDown($m, $lang['months']);
      echo '</div><div class="col-xs-4">';
        yearPullDown($y);
      echo '</div>';
      ?>
      </div>
      <label><?php echo $lang['title'];?></label>
      <input type="text" name="title" class='form-control input-sm'
      value="<?php echo $title ?>" >
  		<input type="hidden" name="uid" value="<?=$uid?>">
      <label><?php echo $lang['text'];?></label>
      <textarea rows=3 name="text" class='form-control input-sm'
      ><?php echo $text;?></textarea>
      <strong>Hor&aacute;rio:</strong>
    <div class="row">
      <?php
      echo '<div class="col-xs-3">';
      hourPullDown($shour, "start");
      echo '</div><div class="col-xs-1">';
      echo '<b>:</b>';
      echo '</div><div class="col-xs-3">';
      minPullDown($sminute, "start");
      echo '</div><div class="col-xs-3">';
      $spm = ' selected';
      amPmPullDown($spm, "start");
      echo '</div>';
      ?>
    </div>
    <div class="row">
      <?php
      echo '<div class="col-xs-3">';
      hourPullDown($ehour, "end");
      echo '</div><div class="col-xs-1">';
      echo '<b>:</b>';
      echo '</div><div class="col-xs-3">';
      minPullDown($eminute, "end");
      echo '</div><div class="col-xs-3">';
      $epm = ' selected';
      amPmPullDown($epm, "end");
      echo '</div>';
       ?>
    </div>
   <label>Igreja:</label>
        <?php
         $congr = new List_sele ("igreja","razao","igreja");
         echo $congr->List_Selec (++$ind,$i,' class="form-control" ');
        ?>
      </div>
      <br />
      <div class="btn-group" role="group" aria-label="...">
        <input type="button" class="btn btn-primary" value="<?php echo $buttonstr;?>"
        onClick="formSubmit()">
        <input type="button" class='btn btn-primary' value="<?php echo $lang['cancel'];?>"
        onClick="window.close();">
    </div>
  </form>
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
