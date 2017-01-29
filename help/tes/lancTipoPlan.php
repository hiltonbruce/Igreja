<?php
//Verifica click duplo no form de criar recibos
$clkDuplo = (empty($_POST["transid"])) ? true : check_transid($_POST["transid"]) ;
if ($clkDuplo) {
	//houve click duplo no form
	$gerarPgto = true;
}else {
	//Não houve click duplo no form
	$gerarPgto = false;
	//Grava no banco codigo de autorização para o novo recibo
	add_transid($_POST["transid"]);
}
//print_r($ctaDespesa->dadosArray());
if ($gerarPgto && !empty($_POST["transid"])) {
	    ?>
		<div class="alert alert-danger alert-dismissible fade in" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&otimes;�</span></button> <strong>lan&ccedil;amento n&atilde;o Realizado!</strong>
		<br />Foi realizado atualiza&ccedilo;&atilde;o da p&aacute;gina ou um clique duplo. </div>
    <?PHP
    }else {
		foreach ($arrayDespesas as $chave => $valor) {
		//Verifica se foi enviado dados para lançamento, testando e executando
			require 'help/verPostChave.php';
		  if ($chvAcesso && $chvDisp && $dtChave && $_POST['rolIgreja'.$chave]>0 && !empty($_POST['hist'.$chave]) && $_POST['valor'.$chave]>'0') {
	    	$rolIgreja = $_POST['rolIgreja'.$chave];
	    	echo '<script> alert ("Pgto confimado ref. : '.$_POST['hist'.$chave].'")</script>';
	    	$valor = (empty($valor_us)) ? strtr( str_replace(array('.'),array(''),$_POST['valor'.$chave]), ',.','.,' ):($valor_us);
				$debitar = $_POST['acesso'.$chave];
				$creditar =  $_POST['disponivel'.$chave];
				//print_r($_POST);
				$referente = (strlen($_POST['hist'.$chave])>'4') ? addslashes($_POST['hist'.$chave]):false;//Atribui a variável o histórico do lançamento
				$data = br_data($_POST['data'.$chave]);
				$datasLanc = $_POST['data'.$chave];
				//echo '<br />chave : '.$chave.' - data-> '.$_POST['data'.$chave].' - dt_US:-> '.$data;
				//echo '<br />hist ->'.$_POST['hist'.$chave].' -acesso-> '.$_POST['acesso'.$chave];
				//echo '<br />rolIgreja ->'.$_POST['rolIgreja'.$chave].' -valor ->'.$_POST['valor'.$chave].'<br />';
	        # chama o script responsável pelo lançamento
	        if ($debitar == $creditar) {
	        	?>
	        	<div class="alert alert-danger alert-dismissible fade in" role="alert">
	        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	        	<span aria-hidden="true">&otimes;�</span></button> <strong>lan&ccedil;amento n&atilde;o Realizado!</strong>
	        	Cr&eacute;dito e D&eacute;bito com mesma conta n&atilde;o &eacute; realizado o lan&ccedil;amento. </div>
	        	<?PHP
	        }else{
	        	require 'models/tes/lancModPlanilha.php';
	        }
		    }
	}
}
$chqData = (empty($data)) ? false:checadata($data);
if (!$chqData) {
	$data = date('Y-m-d');
}
//print_r($datas);
if (!empty($exibicred)) {
	$exibicred .= '<tr class="success"><td colspan="5"><p class="small"><strong>Hist&oacute;rico:</strong><p>';
	$exibicred .= '<p class="text-left"><h5>'.$referente.'</h5></p></td></tr>';
	$exibicred .= sprintf("<tr  class='primary'><td>Em: %s </td><td id='moeda'>R$ %s</td>
		<td id='moeda'>R$ %s</td><td colspan='2'></td></tr>",
		$datasLanc,number_format($totalDeb,2,',','.'),number_format($totalCred,2,',','.'));
}
//$ctaDespesa = new tes_despesas();
//$arrayDesp = $ctaDespesa->despesasArray($mesEstatisca,$ano);
//Monta as linhas da tabela responsável pelas despesas ja lançadas no mês
$provmissoes=0;
$ultimolanc = 0;
//inicializa variáveis
$totalDeb = 0;
$totalCred = 0;
 $arrayDesp = $lstCta->contasTodas();
print_r($arrayDesp[$contaDC['911']['id']]);
foreach ($arrayDesp as $keyDesp => $vlrDesp) {
	$linkPagar  = '<a target="_blanck" href="./?escolha=tesouraria/agenda.php&menu=top_tesouraria&id='.$vlrDesp['id'].'"';
	$linkPagar .= '><small class="text-muted glyphicon glyphicon-new-window"></small</a>';
	//$bgcolor = $cor ? 'class="active"' : '';
	if ($vlrDesp['vencimento']!='' && $vlrDesp['dtpgto']!='00/00/0000') {
		$vencPgto  = '<small class="text-success glyphicon glyphicon-ok"></small> Pago em: '.$vlrDesp['dtpgto'];
		$dtVlrDesp = (empty($vlrDesp['data'])) ? '' : $vlrDesp['data'] ;
		$vencPgto .= ' -> lan&ccedil;.: '.$dtVlrDesp.' '.$linkPagar;
		$titleMsg = ', paga, obrigado!';
	}elseif ($vlrDesp['lancamento']=='0') {
		$vencPgto  = '<small class="text-danger btn-xs glyphicon glyphicon-warning-sign">';
		$vencPgto .= '</small>Venc.: '.$vlrDesp['vencimento'].' '.$linkPagar.' - chave: '.$keyDesp;
		$titleMsg = ', ainda n&atilde;o paga!';
	}else {
		$vencPgto = $contaDC[$arrayDesp['codigo']['titulo']];
		//	print_r($vlrDesp); $contaDC
	}
	//Exibi os pgtos das contas
	if ($vencPgto=='') {
		$linhaTab  = '<tr><td> Lan&ccedil;. N&ordm: '.$vlrDesp['lancamento'].' em: '.$vlrDesp['data'].'</td><td>';
		$linhaTab .= '<kbd>'.$vlrDesp['igreja'].'</kbd> -> '.$vlrDesp['referente'];
		$linhaTab .= '</td><td class="text-right">'.number_format($vlrDesp['valor'],2,',','.');
		$linhaTab .= ' '.$vlrDesp['sld'].'</td><tr>';
	} else {
		$linhaTab  = '<tr title="Venc.: '.$vlrDesp['vencimento'].$titleMsg.'" ><td>'.$vencPgto.'</td><td>';
		$linhaTab .= '<kbd>'.$vlrDesp['igreja'].'</kbd> -> '.$vlrDesp['referente'];
		$linhaTab .= '</td><td class="text-right">'.number_format($vlrDesp['valor'],2,',','.');
		$linhaTab .= ' '.$vlrDesp['sld'].'</td><tr>';
	}
	if (empty($linha[$vlrDesp['acesso']])) {
		$linha[$vlrDesp['acesso']]  = $linhaTab;
	}else {
		$linha[$vlrDesp['acesso']] .= $linhaTab;
	}
}
$dia1 ='';
$listDesp = '';
$igreja = (empty($_GET['igreja'])) ? '' : $_GET['igreja'] ;
$lancar = '<br /><br /><button class="btn btn-primary">Lan&ccedil;ar!</button>';
//print_r($ctaDespesa->dadosArray());
$transid = get_transid();
$ctaGrup3 = '';
$blGrupo3Fim = '';
$blGrupo3Ini = '';
$blGrupo = '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
$selIg = new List_Igreja('igreja', 'razao','rolIgreja');
$selIgOpt = $selIg->corpoSelec();
//$linha1  =  "<select name='{$this->texto_field}' id='{$this->texto_field}' $required tabindex='$seq'>";
//print_r($arrayDespesas);
foreach ($arrayDespesas as $chave => $valor) {
	//Variéveis para montagem do form
	$dataLan = '<label>Data do lan&ccedil;amento</label>'.
			'<input name="data'.$chave.'" class="form-control dataclass" ';
	$campoHist = '<label>Hit&oacute;rico</label><textarea name="hist'.$chave.'" class="form-control"></textarea>';
	//$bscCredorList = new List_sele('igreja', 'razao','rolIgreja'.$chave);
	$listaIgreja  = '<select name="rolIgreja'.$chave.'" class="form-control" >';
	$listaIgreja .= $selIgOpt;
	$listaIgreja .= '</select>';
	$campoValor = '<label>Valor</label><input name="valor'.$chave.'" class="form-control money"/>';
	$conta  ='<input name="acesso'.$chave.'" type="hidden" value="'.$valor['acesso'].'">';
	$conta .='<input name="transid" type="hidden" value="'.$transid.'">';
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
		$dia1='';
		$cabDespesa='';
		$blGrupo3Fim = '';
	}
	if (strlen($valor['codigo'])=='13') {
		//lista dos caixas dispon��veis para pgto
		$fontesPgto  = '<label>Caixas c/ Saldo:</label>';
		$fontesPgto .= '<select name="disponivel'.$chave.'" class="form-control" >';
		$fontesPgto .= $listaFonte;
		$fontesPgto .= '</select>';
		//Lista das despesas disponíveis
		$dia1 .='<tbody><tr class="sub bg-info">
		<th colspan="4"><strong>'.$valor['codigo'].'</strong> - '.$valor['titulo'].'</th>
		</tr>';
		$dia1 .='<tr><td rowspan="2">'.$valor['titulo'].$conta
		.'</abbr><p>'.$fontesPgto.'</p>'.$campoHist.'</td></tr><tr><td>'.$dataLan.
		'<br /><br /><label><strong>Igreja</strong></label>'.$listaIgreja.
		'</td><td>'.$campoValor.$lancar.'</td></tr>';

		if (!empty($linha[$valor['acesso']])) {
			$dia1 .= $linha[$valor['acesso']];
		}

	} elseif (strlen($valor['codigo'])=='9') {
		$cabDespesa  = $blGrupo3Ini.'<form  method="post"><div class="panel panel-info" ><div class="panel-body"><strong>';
		$cabDespesa .= $valor['codigo'].'</strong> - '.$valor['titulo'].'</div><table id="horario" ';
		$cabDespesa .= 'class="table table-striped table-hover">';
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
if (!empty($exibideb) && $exibideb!='') {
	$exibiRodape = '';
	require_once 'views/exibilanc.php';//monta a tabela para exibir
}
$nivel1 = $blGrupo.$listDesp.'</div></div></div></div></div>';
