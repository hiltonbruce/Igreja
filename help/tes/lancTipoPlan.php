<?php
$ctaDespesa = new tes_despesas();
$bsccredor = new tes_listDisponivel();
$arrayDesp = $ctaDespesa->despesasArray($mesEstatisca,$ano);

foreach ($arrayDesp as $keyDesp => $vlrDesp) {
	$linhaTab  = '<tr class="active"><td>'.$vlrDesp['titulo'].'<br /><small>Venc.: '.$vlrDesp['vencimento'].' -> Pago em: '.$vlrDesp['dtpgto'].'</small></td><td>';
	$linhaTab .= $vlrDesp['igreja'].'-> Ref. '.$vlrDesp['referente'];
	$linhaTab .= '</td><td class="text-right">'.number_format($vlrDesp['valor'],2,',','.').'</td><tr>';
	$linha[$vlrDesp['acesso']] .= $linhaTab;
}

$acesso = (empty($_GET['acesso'])) ? '' : $_GET['igreja'] ;
$listaFonte = $bsccredor->List_Selec($acesso);
$dia1 ='';$listDesp = '';
$igreja = (empty($_GET['igreja'])) ? '' : $_GET['igreja'] ;
$cor=true;
$lancar = '<br /><br /><button class="btn btn-primary">Lan&ccedil;ar!</button>';

//print_r($ctaDespesa->dadosArray());
foreach ($ctaDespesa->dadosArray() as $chave => $valor) {
	//Variéveis para montagem do form

	$dataLan = '<label>Data do lan&ccedil;amento</label>'.
			'<input name="data'.$chave.'" class="form-control dataclass" value="'.date('d/m/Y').'"';
	$campoHist = '<label>Hit&oacute;rico</label><textarea name="hist'.$chave.'" class="form-control"></textarea>';
	$bsccredor = new List_sele('igreja', 'razao','rolIgreja'.$chave);
	$listaIgreja = $bsccredor->List_Selec('',$igreja,'class="form-control" autofocus="autofocus" ');
	$campoValor = '<label>Valor</label><input name="valor'.$chave.'" class="form-control"/>';
	$conta ='<input name="acesso'.$chave.'" type="hidden" value="'.$valor['acesso'].'">';

//Verifica se foi enviado dados para lançamento, testanto e executando

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
       require 'models/tes/lancModPlanilha.php';

    }

//Fecha a tabela se mudou de grupo de conta
if ($codigo5!=$valor['codigo'] && strlen($valor['codigo'])=='9') {
	$listDesp .= $cabDespesa.$dia1.'</tbody></table></div></form>';
	$dia1='';$cabDespesa='';
}

	if (strlen($valor['codigo'])=='13') {
		$bgcolor = $cor ? 'class="dados"' : 'class="odd"';
		//lista dos caixas disponíveis para pgto
		$fontesPgto  = '<label>Caixas c/ Saldo:</label>';
		$fontesPgto .= '<select name="disponivel'.$chave.'" class="form-control" >';
		$fontesPgto .= $listaFonte;
		$fontesPgto .= '</select>';
		//Lista das despesas disponíveis
		$dia1 .='<table id="horario" class="table table-hover"><tbody><tr class="sub label-info">
		<th colspan="4"><strong>'.$valor['codigo'].'</strong> - '.$valor['titulo'].'</th>
		</tr>';
		$dia1 .='<tr '.$bgcolor.'><td rowspan="2">'.$valor['titulo'].$conta
		.'</abbr><p>'.$fontesPgto.'</p>'.$campoHist.'</td></tr><tr '.$bgcolor.'><td>'.$dataLan.
		'<br /><br /><label><strong>Igreja</strong></label>'.$listaIgreja.
		'</td><td>'.$campoValor.$lancar.'</td></tr>';
		$dia1 .= $linha[$valor['acesso']];
		$cor = !$cor;
	} elseif (strlen($valor['codigo'])=='9') {
		$cabDespesa = '<form  method="post"><div class="panel panel-info" ><div class="panel-body"><strong>'.$valor['codigo'].'</strong> - '.$valor['titulo'].'</div>';
	}/*elseif (strlen($valor['codigo'])=='5') {
		$codigo5 = $valor['codigo'];
	}
echo($valor['codigo']).' **-> '.strlen($valor['codigo']).' === ';*/
}

$nivel1 = $listDesp;
