<?php
$eventos = new sec_AgendaSec('2017','12','d','igreja');
?>

<?php
$dia = '';
while ($campo = $eventos->listaEventos() ) {
  //print_r ($campo);
  $dateline	= sprintf("%02d de %s  de  %s", $campo['d'],$lang['months'][$campo['m']-1],$campo['y']);
  $wday 		= date("w", mktime(0,0,0,$campo['m'],$campo['d'],$campo['y']));
  echo '<table class="table"><tr>';
  echo '<td colspan="3" ><span class="display_header">'.$dateline.', ';
  echo $lang['days'][$wday].'</span></td>';
  echo '</tr>';
  echo '<td colspan="2"><td width="100%"><span class="display_title">&nbsp;'.$campo['title'].'</span></td>';
  echo '<td align="right" nowrap="yes"><span class="display_title">';
  echo $campo['start_time'].' - '.$campo['end_time'].'&nbsp;</span></td>';
  echo '</tr>';
  echo '<td colspan="3">'.$campo['text'].'</td>';
  echo '</table>';
/*  echo '<tr>';
  echo '<td>'.$campo[].'</td>';
  echo '<td>'.$campo[].'</td>';
  echo '<td>'.$campo[].'</td>';
  echo '<td>'.$campo[].'</td>';
  echo '<td>'.$campo[].'</td>';
  echo '<td>'.$campo[].'</td>';
  echo '</tr>';
*/
}
?>
</table>
