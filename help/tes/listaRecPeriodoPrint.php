<?php
$nivel1 ='';
require_once '../help/tes/getRec.php';
$credorPer = new tes_credores();
$credorLista = $credorPer->dados();
$membroPer = new membro();
$membroLista = $membroPer->nomes();
//print_r ($credorLista);
$recLista = $recBuscas->periodo($diaPer,$mesPer,$anoPer);
  foreach ($recLista as $key => $value) {
    if ($igr && $igr!=$value['igreja']) {
      continue;
    }
    if ($recebeu && $recebeu!=$value['recebeu']) {
      continue;
    }
    $nivel1 .='<tr>';
    $nivel1 .='<td>';
    $nivel1 .= $key;
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
      $status  = '&nbsp;<span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span>&nbsp;';
      $aviso = 'Lan&ccedil;amento Confirmado!';
    }else {
      $status  = '&nbsp;<span class="glyphicon glyphicon-question-sign text-danger" aria-hidden="true"></span>&nbsp;';
      $aviso = 'Lan&ccedil;amento Pendente!';
    }
    $nivel1 .= $status.$recebPer;
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
