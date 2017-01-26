<?php
$dtChave = (empty($_POST['data'.$chave])) ? false:checadata ($_POST['data'.$chave]);
if (!empty($_POST['acesso'.$chave]) && $_POST['acesso'.$chave]>0) {
  $chvAcesso = true;
}else {
  $chvAcesso = false;
}
if (!empty($_POST['disponivel'.$chave]) && $_POST['disponivel'.$chave]>0) {
  $chvDisp = true;
}else {
  $chvDisp = false;
}

?>
