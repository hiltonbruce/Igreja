<?php
  $nivel1 ='';
  if (empty($_GET['ano'])) {
    $anoPer = date('Y');
    $anoForm ='';
  } else {
    $anoPer =$_GET['ano'];
    $anoForm =$anoPer;
  }
  if (empty($_GET['mes'])) {
    $mesPer = date('m');
  } else {
    $mesPer =$_GET['mes'];
  }
  if (empty($_GET['dia'])) {
    $diaPer = '';
  } else {
    $diaPer =$_GET['dia'];
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
    if ($value['lancamento']>0) {
      $status  = '<span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span>';
    }else {
      $status  = '<span class="glyphicon glyphicon-alert text-danger" aria-hidden="true"></span>';
    }
    $nivel1 .='<a href="'.$linkPer.$key.'">'.$status.' '.$recebPer.'</a>';
    $nivel1 .='</td>';
    $nivel1 .='<td>';
    $nivel1 .=$value['motivo'];
    $nivel1 .='</td>';
    $nivel1 .='<td class="text-right">';
    $nivel1 .=number_format($value['valor'], 2, ",", ".");
    $nivel1 .='</td>';
    $nivel1 .='<td>';
    $nivel1 .=$value['nIgreja'];
    $nivel1 .='</td>';
    $nivel1 .='<td>';
    $nivel1 .=conv_valor_br ($value['data']);
    $nivel1 .='</td>';
    $nivel1 .='</tr>';

    $vlrTotal += $value['valor'];
  }

$rodapeRec  = '<tr id="total"><td colspan="3" class="text-right">Total</td>';
$rodapeRec .= '<td colspan="3" class="text-right">'.number_format($vlrTotal, 2, ",", ".").'</td></tr>';
?>
