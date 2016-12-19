<?php
require("./agendaSec/config.php");
require("./agendaSec/lang/lang." . LANGUAGE_CODE . ".php");
require("./agendaSec/functions.php");
$month = intval($_GET['month']);
$year = intval($_GET['year']);
//print_r($_SESSION);
// set month and year to present if month
// and year not received from query string
$m = (!$month) ? date("n") : $month;
$y = (!$year) ? date("Y") : $year;
$scrollarrows	= scrollArrows($m, $y);
require("./agendaSec/templates/" . TEMPLATE_NAME . ".php");
?>
