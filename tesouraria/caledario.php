<?
	
	
	$month = new Calendar_Month_Weekdays (2011, 4, 0);
	
	$month->build();
	
	echo "<table class='calendar'>\n";
	echo "<tr><th>Abril, 2011</th></tr>";
	echo "<tr><td>Do</td><td>Se</td><td>Te</td><td>Qu</td><td>Qu</td><td>Se</td><td>Sá</td></tr>";
	print_r($month->fetch());
	while ($day = $month->fetch()) {
		
	if ($day->isFirst()){
		echo("<tr>");
	}

	if ($day->isEmpty()) {
		echo "<td>&nbsp;</td>";
	}else {
		echo '<td>'.$day->thisDay().'</td>';		
	}
	
	if ($day->isLast()) {
		echo "</tr>";
	}
	
	}
	
	echo("</table>");
	
echo "<table class='calendar'>\n";
	echo "<tr><th colspan='7'>Abril, 2011</th></tr>";
	echo "<tr><td>Do</td><td>Se</td><td>Te</td><td>Qu</td><td>Qu</td><td>Se</td><td>Sá</td></tr>";
  $Month = new Calendar_Month_Weekdays(2011, 4); // Oct 2003
  $Month->build(); // Build Calendar_Day objects
  while ($Day = & $Month->fetch()) {
      if ($Day->isFirst()) {
          echo '<tr>';
      }
      if ($Day->isEmpty()) {
          echo '<td>&nbsp;</td>';
      } else {
          echo '<td>'.$Day->thisDay().'</td>';
      }
      if ($Day->isLast()) {
          echo '</tr>';
      }
 }
	echo("</table>");
?>