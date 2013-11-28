<?php
require_once 'models/tes/atualizarDizOferta.php';

$linkreturn  = './?escolha=tesouraria/receita.php&menu=top_tesouraria&rec=9&igreja='.$_POST['rolIgreja'];
$linkreturn .= '&idDizOf='.$_POST['idDizOf'];
echo '<meta http-equiv="refresh" content="2; '.$linkreturn.'">';
echo '<a href="'.$linkreturn.'"><button autofofus="autofofus" >Continuar...</button></a>';