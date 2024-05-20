<?php
function auth()
{
	session_start();
	if (!empty($_SESSION['valid_user']) && !empty($_SESSION['authdata'])) {
				$_SESSION['authdata'] = array('login'=>$_SESSION['valid_user'], 'userlevel'=>$_SESSION['setor'], 'uid'=>$_SESSION['valid_user']);
		}
   	return ;
}

function monthPullDown($month, $montharray)
{
	echo "\n<select name=\"month\" class='form-control'>\n";
	for($i=0;$i < 12; $i++) {
		if ($i != ($month - 1))
			echo "	<option value=\"" . ($i + 1) . "\">$montharray[$i]</option>\n";
		else
			echo "	<option value=\"" . ($i + 1) . "\" selected>$montharray[$i]</option>\n";
	}
	echo "</select>\n\n";
}

function yearPullDown($year)
{
	echo "<select name=\"year\" class='form-control'>\n";
	$z = 3;
	for($i=1;$i < 8; $i++) {
		if ($z == 0)
			echo "	<option value=\"" . ($year - $z) . "\" selected>" . ($year - $z) . "</option>\n";
		else
			echo "	<option value=\"" . ($year - $z) . "\">" . ($year - $z) . "</option>\n";

		$z--;
	}
	echo "</select>\n\n";
}

function dayPullDown($day)
{
	echo "<select name=\"day\" class='form-control input-sm'>\n";

	for($i=1;$i <= 31; $i++) {
		if ($i == $day)
			echo "	<option value=\"$i\" selected>$i</option>\n";
		else
			echo "	<option value=\"$i\">$i</option>\n";
	}

	echo "</select>\n\n";
}

function hourPullDown($hour, $namepre)
{
	echo "<select name=\"" . $namepre . "_hour\" class='form-control input-sm'>\n";

	for($i=0;$i <= 12; $i++) {
		if ($i == $hour)
			echo "<option value=\"$i\" selected>$i</option>\n";
		else
			echo "<option value=\"$i\">$i</option>\n";
	}

	echo "</select>\n\n";
}

function minPullDown($min, $namepre)
{
	echo "\n<select name=\"" . $namepre . "_min\" class='form-control input-sm'>\n";

	for($i=0;$i <= 55; $i+=5) {

		if ($i < 10)
			$disp = "0" . $i;
		else
			$disp = $i;

		if ($i == $min)
			echo "	<option value=\"$i\" selected>$disp</option>\n";
		else
			echo "	<option value=\"$i\">$disp</option>\n";
	}

	echo "</select>\n\n";
}

function amPmPullDown($pm, $namepre)
{
	if ($pm) { $pm = " selected"; } else { $am = " selected"; }

	echo "\n<select name=\"" . $namepre . "_am_pm\" class='form-control input-sm'>\n";
	echo "	<option value=\"1\"$pm>pm</option>\n";
	echo "	<option value=\"0\"$am>am</option>\n";
	echo "</select>\n\n";
}

function javaScript()
{
?>
	<script language="JavaScript">
	function submitMonthYear() {
		document.monthYear.method = "post";
		document.monthYear.action = "./?escolha=controller/secretaria.php&sec=2&month=" + document.monthYear.month.value + "&year=" + document.monthYear.year.value;
		document.monthYear.submit();
	}

	function postMessage(day, month, year) {
		eval("page" + day + " = window.open('./agendaSec/eventform.php?d=" + day + "&m=" + month + "&y=" + year + "', 'postScreen', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=400,height=500');");
	}

	function openPosting(pId) {
		eval("page" + pId + " = window.open('./agendaSec/eventdisplay.php?id=" + pId + "', 'mssgDisplay', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=400,height=500');");
	}

	function loginPop(month, year) {
		eval("logpage = window.open('./agendaSec/login.php?month=" + month + "&year=" + year + "', 'mssgDisplay', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=400,height=500');");
	}
	</script>
	<?php
	}
	/*function footprint(, $m, $y)
	{
	global $lang;
	echo "<br><br><span class=\"footprint\">\n";
	echo "Calend�rio desenvolvido por WESPA Digital &bull; Adapta&ccedil;&atilde;o Joseilton C Bruce<br>\n[ ";

	if ($_SESSION['setor'] == 3 ) {
		echo "<a href=\"./?useradmin.php\">" . $lang['adminlnk'] . "</a> | ";
		echo " <a href=\"./?login.php&action=logout&month=$m&year=$y\">" . $lang['logout'] . "</a>";
	} else (  == 1 ) {
		echo "<a href=\"./?useradmin.php&flag=changepw\">" . $lang['changepw'] . "</a> | ";
		echo "<a href=\"./?login.php&action=logout&month=$m&year=$y\">" . $lang['logout'] . " </a>";
	} else {
		echo "<a href=\"javascript:loginPop($m, $y)\">" . $lang['login'] . "</a>";
	}

	echo " ]</span>";
}
*/

function scrollArrows($m, $y,$mes,$mesAnt,$mesPos,$igreja)
{
	// set variables for month scrolling
	$nextyear = ($m != 12) ? $y : $y + 1;
	$prevyear = ($m != 1) ? $y : $y - 1;
	$prevmonth = ($m == 1) ? 12 : $m - 1;
	$nextmonth = ($m == 12) ? 1 : $m + 1;
	$yPos = ($mes=='Dezembro') ? 'Jan/'.substr(($y+1), 2) : substr($mesPos, 0,3).'/'.substr($y, 2) ;
	$yAnt = ($mes=='Janeiro') ? 'Dez/'.substr(($y-1), 2) : substr($mesAnt, 0,3).'/'.substr($y, 2) ;
	$ig = (empty($igreja)) ? '' : $igreja;
	$s = '<a href="./?escolha=controller/secretaria.php&sec=2&igreja='.$ig.'&month=';
	$s .= $prevmonth . '&year=' . $prevyear . '"><button class="btn btn-default btn-xs" >';
	$s .= "<span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>$yAnt</button></a>&nbsp;";
	$s .=	'<button class="btn btn-primary btn-sm active" disabled="disabled" >'.$mes.' '.$y.'</button>&nbsp;';
	$s .= '<a href="./?escolha=controller/secretaria.php&sec=2&month=' . $nextmonth;
	$s .= '&igreja='.$ig.'&year=' . $nextyear . '" ><button class="btn btn-default btn-xs" >';
	$s .= $yPos."<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span></button></a>";
	return $s;
}

function writeCalendar($month, $year,$igreja)
{
	$str = getDayNameHeader();
	$eventdata = getEventDataArray($month, $year,$igreja);
	// get week position of first day of month.
	$weekpos = getFirstDayOfMonthPosition($month, $year);
	// get user permission level
//	$auth = auth();
	// get number of days in month
	$days = 31-((($month-(($month<8)?1:0))%2)+(($month==2)?((!($year%((!($year%100))?400:4)))?1:2):0));
	// initialize day variable to zero, unless $weekpos is zero
	if ($weekpos == 0) $day = 1; else $day = 0;
	// initialize today's date variables for color change
	$timestamp = mktime() + CURR_TIME_OFFSET * 3600;
	$d = date(j, $timestamp); $m = date(n, $timestamp); $y = date(Y, $timestamp);
	// loop writes empty cells until it reaches position of 1st day of month ($wPos)
	// it writes the days, then fills the last row with empty cells after last day
	while($day <= $days) {
		$str .="<tr>\n";
		for($i=0;$i < 7; $i++) {
			if($day > 0 && $day <= $days) {
				$str .= "	<td class=\"";
				if (($day == $d) && ($month == $m) && ($year == $y)){
					$str .= "today";
				}elseif ($i==0) {
					$str .= "dom";
				}else {
					$str .= "day";}
					$str .= "_cell\" valign=\"top\"><span class=\"day_number\">";
		//	if ()
					$str .= "<a href=\"javascript: postMessage($day, $month, $year)\" ";
					$str .= 'class="btn btn-default btn-xs" type="button" ';
					$str .= 'data-toggle="tooltip" data-placement="top" title="Click para novo evento">';
					$str .= '<b>'.sprintf("%02d", $day).'</b></a>';
	//			else
	//				$str .= "$day";
				$str .= "</span><br>";
				// enforce title limit
				$eventcount = count($eventdata[$day]["title"]);
				if (MAX_TITLES_DISPLAYED < $eventcount) $eventcount = MAX_TITLES_DISPLAYED;
				// write title link if posting exists for day
				for($j=0;$j < $eventcount;$j++) {
					$setorCad = 'Cadastrado pela: '.$eventdata[$day]['setor'][$j];
					$igrejaEven = 'Local do evento: '.$eventdata[$day]['igreja'][$j];
					$textEven = $eventdata[$day]["text"][$j];
					$textTitle = strip_tags($textEven.' - '.$igrejaEven.' ('.$setorCad.')');
					$titLink = 'data-toggle="tooltip" data-placement="top" title="'.$textTitle.'"';
					$str .= "<a href=\"javascript:openPosting(" . $eventdata[$day]["idMensage"][$j] . ")\">";
					if ($eventdata[$day]['rol'][$j]=='1') {
						$classDest = 'text-danger';
					} elseif ($eventdata[$day]['rol'][$j]=='0') {
						$classDest = 'text-warning';
					}elseif ($eventdata[$day]['rol'][$j]=='-1') {
						$classDest = 'text-primary';
					} else {
						$classDest = 'text-success';
					}

					$str .= '<span class="'.$classDest.'" '.$titLink.' >&bull; ';
					$str .= $eventdata[$day]['title'][$j] . '</span></a>'.$igreja;
					$str .= $eventdata[$day]['timestr'][$j];
				}
				$str .= "</td>\n";
				$day++;
			} elseif($day == 0)  {
     			$str .= "	<td class='active' valign='top'>&nbsp;</td>\n";
				$weekpos--;
				if ($weekpos == 0) $day++;
     		} else {
				$str .= "	<td class='active' valign='top'>&nbsp;</td>\n";
			}
     	}
		$str .= '</tr>';
	}
	return $str;
	}

function getDayNameHeader()
{
	global $lang;
	// adjust day name order if weekstart not Sunday
	if (WEEK_START != 0) {
		for($i=0; $i < WEEK_START; $i++) {
			$tempday = array_shift($lang['abrvdays']);
			array_push($lang['abrvdays'], $tempday);
		}
	}
	$s = "<table class='table table-bordered some_style' >\n<tr>\n";
	foreach($lang['abrvdays'] as $day) {
		if ($day!='Dom') {
			$s .= "\t<td class='primary text-center'><strong>$day</strong></td>\n";
		} else {
			$s .= "\t<td class='info text-center'><strong>$day</strong></td>\n";
		}
	}
	$s .= "</tr>\n\n";
	return $s;
}

function getEventDataArray($month, $year,$igreja)
{
	$sql = "SELECT a.*,i.*,s.*, a.id AS idMensage, ";
	if (TIME_DISPLAY_FORMAT == "12hr") {
		$sql .= "TIME_FORMAT(a.start_time, '%l:%i%p') AS stime, ";
		$sql .= "TIME_FORMAT(a.end_time, '%l:%i%p') AS etime ";
	} elseif (TIME_DISPLAY_FORMAT == "24hr") {
		$sql .= "TIME_FORMAT(a.start_time, '%H:%i') AS stime, ";
		$sql .= "TIME_FORMAT(a.end_time, '%H:%i') AS etime ";
	} else {
		echo "Bad time display format, check your configuration file.";
	}
	$sql .= "FROM " . DB_TABLE_PREFIX . "mssgs AS a, igreja AS i, setores AS s ";
	$sql .= "WHERE m = $month AND y = $year AND (a.igreja = i.rol || a.igreja = '0' ";
	$sql .= "|| a.igreja = '-1') AND a.setor = s.id ";
	if ($igreja>'0') {
		$sql .= 'AND i.rol  ='.$igreja.' ';
	}
	$sql .= "GROUP BY a.id ORDER BY a.start_time,a.end_time";
	$result = mysql_query($sql) or die(mysql_error());
	while($row = mysql_fetch_assoc($result)) {
		$eventdata[$row["d"]]["idMensage"][] = $row["idMensage"];
		if ($row["igreja"]=='0') {
			$eventdata[$row["d"]]["igreja"][] = '<strong>Sede e Congrega&ccedil;&otilde;es</strong>';
		}elseif ($row["igreja"]=='-1') {
			$eventdata[$row["d"]]["igreja"][] = '<strong>Congrega&ccedil;&otilde;es</strong>';
		} else {
			$eventdata[$row["d"]]["igreja"][] = $row["razao"];
		}
	//$eventdata[$row["d"]]["igreja"][] = $row["razao"];
		$eventdata[$row["d"]]["setor"][] = $row["alias"];
		$eventdata[$row["d"]]["text"][] = $row["text"];
		$eventdata[$row["d"]]["rol"][] = $row["igreja"];
		if (strlen($row["title"]) > TITLE_CHAR_LIMIT)
			$eventdata[$row["d"]]["title"][] = substr(stripslashes($row["title"]), 0, TITLE_CHAR_LIMIT) . "...";
		else
			$eventdata[$row["d"]]["title"][] = stripslashes($row["title"]);

		if (!($row["start_time"] == "55:55:55" && $row["end_time"] == "55:55:55")) {
			if ($row["start_time"] == "55:55:55")
				$starttime = "- -";
			else
				$starttime = $row["stime"];

			if ($row["end_time"] == "55:55:55")
				$endtime = "- -";
			else
				$endtime = $row["etime"];

			$timestr = '<br /><div class="text-info text-right small"><ins>'.$starttime.'&nbsp;-&nbsp;'.$endtime.'</ins></div>';
		} else {
			$timestr = "<br>";
		}
		$eventdata[$row["d"]]["timestr"][] = $timestr;
	}
	return $eventdata;
}

function getFirstDayOfMonthPosition($month, $year)
{
	$weekpos = date("w",mktime(0,0,0,$month,1,$year));
	// adjust position if weekstart not Sunday
	if (WEEK_START != 0)
		if ($weekpos < WEEK_START)
			$weekpos = $weekpos + 7 - WEEK_START;
		else
			$weekpos = $weekpos - WEEK_START;

	return $weekpos;
}
?>
