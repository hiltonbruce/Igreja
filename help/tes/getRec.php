<?php
if (empty($_GET['ano'])) {
  $anoForm = date('Y');
  $anoPer = $anoForm ;
} else {
  $anoPer =$_GET['ano'];
  $anoForm =$anoPer;
}
$rol = (empty($_GET['rol'])) ? null : intval($_GET['rol']) ;
if (!empty($_GET['mes'])) {
  $mesPer = sprintf("%02s",intval($_GET['mes']));
} else {
  $mesPer = null;
}
if (empty($_GET['dia'])) {
  $diaPer = '';
} else {
  $diaPer = sprintf("%02s",intval($_GET['dia']));
}
if (empty($_GET['igreja'])) {
  $igr = false;
} else {
  $igr = intval($_GET['igreja']);
}
if (empty($_GET['recebeu'])) {
  $recebeu = false;
} else {
  $recebeu = intval($_GET['recebeu']);
}
 ?>
