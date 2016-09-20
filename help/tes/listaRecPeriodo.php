<?php
  $nivel1 ='';
  if (empty($_GET['ano'])) {
    $anoPer = date('Y');
  } else {
    $anoPer =$_GET['ano'];
  }
  if (empty($_GET['mes'])) {
    $mesPer = date('m');
  } else {
    $mesPer =$_GET['mes'];
  }
  $perLista = $mesPer.'/'.$anoPer;
  if (empty($_GET['dia'])) {
    $diaPer = '';
  } else {
    $diaPer =$_GET['dia'];
    $perLista = $diaPer.'/'.$mesPer.'/'.$anoPer;
  }

$credorPer = new tes_credores();
$credorLista = $credorPer->dados();
$membroPer = new membro();
$membroLista = $membroPer->nomes();

//print_r ($credorLista);
  foreach ($recBuscas->periodo($diaPer,$mesPer,$anoPer) as $key => $value) {
    $nivel1 .='<tr>';
    $nivel1 .='<td>';
    $linkPer = './?escolha=tesouraria/rec_alterar.php&menu=top_tesouraria&pag_rec=1';
    $linkPer .= '&recPer=1&dia='.$diaPer.'&mes='.$mesPer.'&ano='.$anoPer.'&id=';
    $nivel1 .='<a href="'.$linkPer.$key.'">'.$key.'</a>';
    $nivel1 .='</td>';
    $nivel1 .='<td>';

    if ($value['tipo']=='2') {
      $recebPer = $credorLista[$value['recebeu']]['3'];
    }elseif ($value['tipo']=='1') {
      $recebPer = $membroLista[$value['recebeu']]['5'];
    } else {
      $recebPer = $value['recebeu'];
    }

    $nivel1 .=$recebPer;
    $nivel1 .='</td>';
    $nivel1 .='<td>';
    $nivel1 .=$value['motivo'];
    $nivel1 .='</td>';
    $nivel1 .='<td>';
    $nivel1 .=$value['valor'];
    $nivel1 .='</td>';
    $nivel1 .='<td>';
    $nivel1 .=$value['igreja'];
    $nivel1 .='</td>';
    $nivel1 .='<td>';
    $nivel1 .=$value['data'];
    $nivel1 .='</td>';
    $nivel1 .='</tr>';
  }
?>
