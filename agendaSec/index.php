<?php
require("./agendaSec/config.php");
require("./agendaSec/lang/lang." . LANGUAGE_CODE . ".php");
require("./agendaSec/functions.php");

$m = intval($_GET['month']);
$y = intval($_GET['year']);
print_r($_SESSION);
// set month and year to present if month
// and year not received from query string
$m = (!$month) ? date("n") : $month;
$y = (!$year) ? date("Y") : $year;

$scrollarrows	= scrollArrows($m, $y);
$auth 			= auth($_POST['username'],$_POST['password']);

require("./agendaSec/templates/" . TEMPLATE_NAME . ".php");
?>
