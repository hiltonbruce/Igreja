<?php
//print_r($ctaDespesa->dadosArray());
$ctaDespesa = new tes_despesas();
foreach ($ctaDespesa->dadosArray() as $chave => $valor) {
//Verifica se foi enviado dados para lançamento, testando e executando
    if ($_POST['acesso'.$chave]>0 && $_POST['disponivel'.$chave]>0 && checadata ($_POST['data'.$chave]) && $_POST['rolIgreja'.$chave]>0 && !empty($_POST['hist'.$chave]) && $_POST['valor'.$chave]>0) {

    	$rolIgreja = $_POST['rolIgreja'.$chave];
    	echo '<script> alert ('.$_POST['acesso'.$chave].')</script>';
    	$valor = (empty($valor_us)) ? strtr( str_replace(array('.'),array(''),$_POST['valor'.$chave]), ',.','.,' ):($valor_us);
		$debitar = $_POST['acesso'.$chave];
		$creditar =  $_POST['disponivel'.$chave];
		//print_r($_POST);

		$referente = (strlen($_POST['hist'.$chave])>'4') ? $_POST['hist'.$chave]:false;//Atribui a variável o histórico do lançamento
		$data = br_data($_POST['data'.$chave]);
		//echo '<br />chave : '.$chave.' - data-> '.$_POST['data'.$chave].' - dt_US:-> '.$data;
		//echo '<br />hist ->'.$_POST['hist'.$chave].' -acesso-> '.$_POST['acesso'.$chave];
		//echo '<br />rolIgreja ->'.$_POST['rolIgreja'.$chave].' -valor ->'.$_POST['valor'.$chave].'<br />';
        # chama o script responsável pelo lançamento
        if ($debitar == $creditar) {
        	?>
        	<div class="alert alert-danger alert-dismissible fade in" role="alert"> 
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        	<span aria-hidden="true">×</span></button> <strong>lançamento não Realizado!</strong> 
        	Crédito e Debito com mesma conta não é realizado o lançamento. </div>
        	<?PHP
        } else {
        	require 'models/tes/lancModPlanilha.php';
        }
        
       
    }
}
$exibicred .= sprintf("<tr  class='info'><td>Totais em: %s </td><td id='moeda'>R$ %s</td><td id='moeda'>R$ %s</td><td></td></tr>",conv_valor_br($data),number_format($totalDeb,2,',','.'),number_format($totalCred,2,',','.'));

$ctaDespesa = new tes_despesas();
$bsccredor = new tes_listDisponivel();
$arrayDesp = $ctaDespesa->despesasArray($mesEstatisca,$ano);
//Monta as linhas da tabela responsável pelas despesas ja lançadas no mês
$bgcolor = 'class="active"';
$cor= true;
$provmissoes=0;
$ultimolanc = 0;

//inicializa variáveis
$totalDeb = 0;
$totalCred = 0;
//print_r($arrayDesp);
foreach ($arrayDesp as $keyDesp => $vlrDesp) {

	$linkPagar  = '<a target="_blanck" href="./?escolha=tesouraria/agenda.php&menu=top_tesouraria&id='.$vlrDesp['id'].'"';
	$linkPagar .= '><small class="text-muted glyphicon glyphicon-new-window"></small</a>';
	$bgcolor = $cor ? 'class="active"' : '';
	if ($vlrDesp['vencimento']!='' && $vlrDesp['dtpgto']!='00/00/0000') {
		$vencPgto  = '<small class="text-success glyphicon glyphicon-ok"></small> Pago em: '.$vlrDesp['dtpgto'];
		$vencPgto .= ' -> Venc.: '.$vlrDesp['vencimento'].' '.$linkPagar;
		$titleMsg = ', paga, obrigado!';
	}elseif ($vlrDesp['dtpgto']=='00/00/0000') {
		$vencPgto  = '<small class="text-danger btn-xs glyphicon glyphicon-warning-sign"> </small>Venc.: '.$vlrDesp['vencimento'];
		$vencPgto .= ' '.$linkPagar;
		$bgcolor = 'class="danger"';
		$titleMsg = ', ainda n&atilde;o paga!';
	}
	else {
		$vencPgto = '';
	}
	if ($vencPgto=='') {
		$linhaTab  = '<tr '.$bgcolor.' title="'.$vlrDesp['titulo'].'"><td> Lan&ccedil;ado em: '.$vlrDesp['data'].'</td><td>';
		$linhaTab .= '<kbd>'.$vlrDesp['igreja'].'</kbd> -> '.$vlrDesp['referente'];
		$linhaTab .= '</td><td class="text-right">'.number_format($vlrDesp['valor'],2,',','.');
		$linhaTab .= ' '.$vlrDesp['sld'].'</td><tr>';
		$linha[$vlrDesp['acesso']] .= $linhaTab;
	} else {
		$linhaTab  = '<tr '.$bgcolor.' title="'.$vlrDesp['titulo'].$titleMsg.'"><td>'.$vencPgto.'</td><td>';
		$linhaTab .= '<kbd>'.$vlrDesp['igreja'].'</kbd> -> '.$vlrDesp['referente'];
		$linhaTab .= '</td><td class="text-right">'.number_format($vlrDesp['valor'],2,',','.');
		$linhaTab .= ' '.$vlrDesp['sld'].'</td><tr>';
		$linha[$vlrDesp['acesso']] .= $linhaTab;
	}
	$cor = !$cor;
}

$acesso = (empty($_GET['acesso'])) ? '' : $_GET['igreja'] ;
$listaFonte = $bsccredor->List_Selec($acesso);
$dia1 ='';$listDesp = '';
$igreja = (empty($_GET['igreja'])) ? '' : $_GET['igreja'] ;
$cor=true;
$lancar = '<br /><br /><button class="btn btn-primary">Lan&ccedil;ar!</button>';

//print_r($ctaDespesa->dadosArray());
$ctaGrup3 = '';
$blGrupo3Fim = '';
$blGrupo3Ini = '';
$blGrupo = '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
foreach ($ctaDespesa->dadosArray() as $chave => $valor) {
	//Variéveis para montagem do form

	$dataLan = '<label>Data do lan&ccedil;amento</label>'.
			'<input name="data'.$chave.'" class="form-control dataclass" value="'.date('d/m/Y').'"';
	$campoHist = '<label>Hit&oacute;rico</label><textarea name="hist'.$chave.'" class="form-control"></textarea>';
	$bsccredor = new List_sele('igreja', 'razao','rolIgreja'.$chave);
	$listaIgreja = $bsccredor->List_Selec('',$igreja,'class="form-control" autofocus="autofocus" ');
	$campoValor = '<label>Valor</label><input name="valor'.$chave.'" class="form-control"/>';
	$conta ='<input name="acesso'.$chave.'" type="hidden" value="'.$valor['acesso'].'">';

//Contas do grupo 3
	if (strlen($valor['codigo'])=='5') {
			$blGrupo3Ini  = '<div class="panel panel-default">';
			$blGrupo3Ini .= '<div class="panel-heading" role="tab" id="headingOne">';
			$blGrupo3Ini .= '<h4 class="panel-title">';
			$blGrupo3Ini .= '<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$chave.'" aria-expanded="true" aria-controls="collapseOne">';
			$blGrupo3Ini .= $valor['codigo'].' &bull; '.$valor['titulo'];
			$blGrupo3Ini .= '</a>';
			$blGrupo3Ini .= '</h4>';
			$blGrupo3Ini .= '</div>';
			$blGrupo3Ini .= '<div id="collapse'.$chave.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">';
			$blGrupo3Ini .= '<div class="panel-body">';

		if ($ctaGrup3!=$valor['codigo'] && $listDesp!='') {
			$blGrupo3Fim  = '</div>';
			$blGrupo3Fim .= '</div>';
			$blGrupo3Fim .= '</div>';
		}

		$ctaGrup3 = $valor['codigo'];
	}

	//Fecha a tabela se mudou de grupo de conta
	if (strlen($valor['codigo'])=='9' && isset($cabDespesa)) {
		$listDesp .= $cabDespesa.$dia1.'</tbody></table></div></form>'.$blGrupo3Fim;
		$dia1='';$cabDespesa='';
		$blGrupo3Fim = '';
	}

	if (strlen($valor['codigo'])=='13') {
		$bgcolor = $cor ? 'class="odd"' : 'class="odd"';
		//lista dos caixas disponíveis para pgto
		$fontesPgto  = '<label>Caixas c/ Saldo:</label>';
		$fontesPgto .= '<select name="disponivel'.$chave.'" class="form-control" >';
		$fontesPgto .= $listaFonte;
		$fontesPgto .= '</select>';
		//Lista das despesas disponíveis
		$dia1 .='<tbody><tr class="sub bg-info">
		<th colspan="4"><strong>'.$valor['codigo'].'</strong> - '.$valor['titulo'].'</th>
		</tr>';
		$dia1 .='<tr '.$bgcolor.'><td rowspan="2">'.$valor['titulo'].$conta
		.'</abbr><p>'.$fontesPgto.'</p>'.$campoHist.'</td></tr><tr '.$bgcolor.'><td>'.$dataLan.
		'<br /><br /><label><strong>Igreja</strong></label>'.$listaIgreja.
		'</td><td>'.$campoValor.$lancar.'</td></tr>';
		$dia1 .= $linha[$valor['acesso']];
		$cor = !$cor;
	} elseif (strlen($valor['codigo'])=='9') {
		$cabDespesa  = $blGrupo3Ini.'<form  method="post"><div class="panel panel-info" ><div class="panel-body"><strong>';
		$cabDespesa .= $valor['codigo'].'</strong> - '.$valor['titulo'].'</div><table id="horario" ';
		$cabDespesa .= 'class="table">';
		$blGrupo3Ini = '';
	}/*elseif (strlen($valor['codigo'])=='5') {
		$codigo5 = $valor['codigo'];
	}
echo($valor['codigo']).' **-> '.strlen($valor['codigo']).' === ';*/

}

//Último grupo do array, completando a tabela
if ($cabDespesa!='') {
	$listDesp .= $cabDespesa.$dia1.'</form></tbody></div></table>'.$blGrupo3Fim;
}

//esta variável é levada p/ o script views/exibilanc.php que chamado ao final deste loop numa linha abaixo
if ($exibideb!='') {
	require_once 'views/exibilanc.php';//monta a tabela para exibir
}

$nivel1 = $blGrupo.$listDesp.'</div></div></div></div></div>';
