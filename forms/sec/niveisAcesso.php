<?php
$cons = '<option value="5">Consultar</option>';
$cad = '<option value="7">Anterior e Cadastro</option>';
$atual = '<option value="8">Anteriores e Edita</option>';
$del = '<option value="9">Anteriores e Apaga</option>';
$admUser = '<option value="10">Anteriores e Admin Usu&aacute;rios</option>';
$tes = '<option value="15">Todos e Tesouraria</option>';
$tesbasico = '<option value="10">Cadastro Tesouraria</option>';
$super = '<option value="50">Super Usu&aacute;rio</option>';

if ($_SESSION['nivel']>=50 || $_SESSION['setor']>=99) {
  $listaOp =$cons.$cad.$atual.$del.$admUser.$tes.$super;
} elseif ($_SESSION['nivel']>10 && $_SESSION['setor']=='2') {
  $listaOp =$cons.$cad.$atual.$del.$admUser.$tes;
} elseif ($_SESSION['nivel']>=10 && $_SESSION['setor']=='2' ) {
  $listaOp =$cons.$tesbasico;
} elseif ($_SESSION['nivel']>=10) {
  $listaOp =$cons.$cad.$atual.$del.$admUser;
} elseif ($_SESSION['nivel']>=9) {
  $listaOp =$cons.$cad.$atual.$del;
} elseif ($_SESSION['nivel']>=8) {
  $listaOp =$cons.$cad.$atual;
} elseif ($_SESSION['nivel']>=7) {
  $listaOp =$cons.$cad;
} else {
  $listaOp =$cons;
}
echo $listaOp;
?>
