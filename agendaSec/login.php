<?php
require("config.php");
require("./lang/lang.admin." . LANGUAGE_CODE . ".php");
require("functions.php");
error_reporting(E_ALL);
ini_set('display_errors', 'off');

$action	= $_GET['action'];
$m = (empty($_GET['month'])) ? date('n') : intval($_GET['month']) ;
$y = (empty($_GET['year'])) ? date('Y') : intval($_GET['year']) ;

if ( $action == "login" && auth($_POST['username'], $_POST['password']) ) {

	echo "<script language=\"JavaScript\">";
	echo "opener.location = \"index.php?month=$m&year=$y\";";
	echo "window.setTimeout('window.close()', 500);";
	echo "</script>";

} else {

	session_start();
	session_destroy();

?>
	<html>
	<head>
	<script language="JavaScript">
	function firstFocus()
	{
		if (document.forms.length > 0) {
			var TForm = document.forms[0];
			for (i=0;i<TForm.length;i++) {
				if ((TForm.elements[i].type=="text")||
				    (TForm.elements[i].type=="textarea")||
					(TForm.elements[i].type.toString().charAt(0)=="s")) {
					document.forms[0].elements[i].focus();
					break;
				}
			}
		}
	}
	</script>
	<title><?php echo $lang['logintitle'];?></title>
	<link rel="stylesheet" type="text/css" href="css/adminpgs.css">
	</head>
	<body onLoad="firstFocus()">
<?php
	if( isset( $_POST['username'] ) ) {
		echo "<span class=\"login_auth_fail\">" . $lang['wronglogin'] . "</span><p>\n";
	}
?>
	<span class="login_header"><?php echo $lang['loginheader'];?></span>
	<br><img src="images/clear.gif" width="1" height="5"><br>

	<table>
	<form action="./?action=login&month=<?php echo $m;?>&year=<?php echo $y;?>" method="post">
			<tr>
				<td nowrap valign="top" align="right" nowrap>
				<span class="login_label"><?php echo $lang['username'];?></span></td>
				<td><input type="text" name="username" size="29" maxlength="15"></td>
			</tr>
			<tr>
				<td nowrap valign="top" align="right" nowrap>
				<span class="login_label"><?php echo $lang['password'];?></span></td>
				<td><input type="password" name="password" size="29" maxlength="15"></td>
			</tr>
			<tr><td colspan="2" align="right"><input type="submit" value="<?php echo $lang['login'];?>"><td><tr>
	</form>
	</table>

	</body></html>
<?php
}
?>
