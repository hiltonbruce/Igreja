<?php
error_reporting(E_ALL);
ini_set('display_errors', 'off');

require("./agendaSec/config.php");
require("./agendaSec/lang/lang." . LANGUAGE_CODE . ".php");
require("./agendaSec/functions.php");
$month = intval($_GET['month']);
$year = intval($_GET['year']);
$igreja = intval($_GET['igreja']);
//print_r($_SESSION);
// set month and year to present if month
// and year not received from query string
$m = (!$month) ? date("n") : $month;
$y = (!$year) ? date("Y") : $year;
$i = (!$igreja) ? '' : $igreja;
$scrollarrows	= scrollArrows($m, $y,$lang['months'][$m-1],$lang['months'][$m-2],
    $lang['months'][$m],$i);
require("./agendaSec/templates/" . TEMPLATE_NAME . ".php");
?>
