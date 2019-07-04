<?php
  $nivel1 ='';
  $vlrTotal=0;
  $vlrTotPendete=0;
  if (empty($_GET['ano'])) {
    $anoForm = date('Y');
    $anoPer ='' ;
  } else {
    $anoPer =$_GET['ano'];
    $anoForm =$anoPer;
  }
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
  if ($_GET['motivo']) {
    $motivo = $_GET['motivo'];
  }

  if (!empty($_GET['lanc'])) {
    $lanc = intval($_GET['lanc']);
  }

  if (isset($_GET['rol']) && $_GET['rol']>'0' ) {
    $nome = intval($_GET['rol']);
  }elseif (isset($_GET['nome'])) {
    $nome = $_GET['nome'];
  }else {
    $nome ='';
  }
$credorPer = new tes_credores();
$credorLista = $credorPer->dados();
$membroPer = new membro();
$membroLista = $membroPer->nomes();
//print_r ($credorLista);

$recLista = $recBuscas->periodo($diaPer,$mesPer,$anoPer,$motivo,$nome,$lanc);
  foreach ($recLista as $key => $value) {
    if ($igr && $igr!=$value['igreja']) {
      continue;
    }
    if ($recebeu && $recebeu!=$value['recebeu']) {
      continue;
    }
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
      $status  = '&nbsp;<span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span>&nbsp;';
      $aviso = 'Lan&ccedil;amento Confirmado!';
      $vlrTotal += $value['valor'];
    }elseif ($value['lancamento']=='Cancelado') {
      $status  = '&nbsp;<span class="glyphicon glyphicon-ban-circle text-danger" aria-hidden="true"></span>';
      $status .= '<span class="text-danger">&nbsp;</span>';
      $aviso = 'Recibo cancelado!';
    }else {
      $status  = '&nbsp;<span class="glyphicon glyphicon-alert text-warning" aria-hidden="true"></span>&nbsp;';
      $aviso = 'Lan&ccedil;amento Pendente!';
      $vlrTotPendete += $value['valor'];
    }
    $nivel1 .='<a href="'.$linkPer.$key.'" title="'.$aviso.'">'.$status.$recebPer.'</a> ';
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
    // $vlrTotal += $value['valor'];
  }
$rodapeRec   = '<tr id="total">';
$rodapeRec  .= '<td class="text-right" colspan="2" >Total Pendente de Lan&ccedil;ado... R$ '.number_format($vlrTotPendete, 2, ",", ".").'</td>';
$rodapeRec  .= '<td class="text-right" colspan="2" >Total Lan&ccedil;ado.......... R$ '.number_format($vlrTotal, 2, ",", ".").'</td>';
$rodapeRec  .= '<td colspan="2" class="text-right">Total Geral............ R$ '.number_format($vlrTotal+$vlrTotPendete, 2, ",", ".").'</td></tr>';
?>
