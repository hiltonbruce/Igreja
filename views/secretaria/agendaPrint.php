<?php

$m = (empty($_GET['month'])) ? date('n') : intval($_GET['month']) ;
$y = (empty($_GET['year'])) ? date('Y') : intval($_GET['year']) ;
$d = (empty($_GET['day'])) ? '' : intval($_GET['day']) ;
$i = (empty($_GET['igreja'])) ? '' : intval($_GET['igreja']) ;

$eventos = new sec_AgendaSec($y,$m,$d,$i);
$dia = '';
while ($campo = $eventos->listaEventos() ) {
  //print_r ($campo);
  $dateline	= sprintf("%02d de %s  de  %s", $campo['d'],$lang['months'][$campo['m']-1],$campo['y']);
  $wday 		= date("w", mktime(0,0,0,$campo['m'],$campo['d'],$campo['y']));
  echo '<h4><table class="table"><tr class="active" >';
  echo '<td colspan="3">'.$dateline.', ';
  echo $lang['days'][$wday].'</td>';
  echo '</tr><tr class="primary">';
  echo '<td colspan="2" width="100%">&nbsp;'.$campo['title'].'</td>';
  echo '<td align="right" nowrap="yes"><span class="display_title">';
  echo $campo['start_time'].' - '.$campo['end_time'].'&nbsp;</span></td>';
  echo '</tr><tr>';
  echo '<td colspan="4">'.$campo['text'];
  echo '<p class="text-right">Local do evento: '.$campo['razao'].'<br/>';
  echo '<span class="small">Setor de Cadastro: '.$campo['alias'].'<br/>';
  echo 'Registrado por: '.$campo['nome'].' - '.$campo['cargo'].'</span></p></td>';
  echo '</tr>';
  echo '</table></h4>';
}
?>
</table>
