<?php
$reg = '';
$linkLancamento  = './?escolha=tesouraria/receita.php&menu=top_tesouraria';
$linkLancamento .= '&igreja='.$_POST['igreja'];
require_once 'views/tesouraria/menu.php';//Sub-Menu de links
#Analisa se serÃ¡ lanÃ§ado em contas a pagar e fazer o reconhecimento da despesas
list($anoVenc,$mesVen,$diaVenc) = explode('-',$vencimento);
$data = br_data($_POST['data'], 'Data do lançamento inválida!');
list($anoPgto,$mesPgto,$diaPgto) = explode('-', $data);
$dtLanc = $diaPgto.'/'.$mesPgto.'/'.$anoPgto;
$dtCtaPagar = $dtLanc;

if (MESBLOQUEA >= $data) {
	echo "<script>alert('Lançamento bloqueados para esta data!');</script>";
	$msgAlert  = '<div class="alert alert-danger" role="alert">';
	$msgAlert .= '<h3>Lan&ccedil;amento n&atilde;o permitido!</h3>';
	$msgAlert .= '<h4>Solicite ajuda do Administrador...</h4>';
	$msgAlert .= '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>';
	$msgErro .= $msgAlert.' Lan&ccedil;amentos com data igual ou anterior &agrave; '.conv_valor_br (MESBLOQUEA);
	$msgErro .= ' est&atilde;o bloqueados! <u>O lan&ccedil;mento <b>N&Atilde;O</b> ';
	$msgErro .= 'foi confirmado!</u> por&eacute;m na agenda foi confirmado o encerramento</div>';
	echo $msgErro;
} else {
	$msg ='';
	$debitar = intval($_POST['acessoDebitar']);
	$creditar =  intval($_POST['acessoCreditar']);
	$ctaDebito = new DBRecord('contas', $debitar, 'acesso');
	$ctaCredito = new DBRecord('contas', $creditar, 'acesso');
	if ($ctaDebito->acesso()<1) {
		$msg .= '<h4>Conta de <strong>d&eacute;bito</strong> inv&aacute;lida!</h4>';
		$msg .= '<p>Foi utilizado c&oacute;digo de acesso n&ordm;: '.$debitar.'</p>';
		$error = true;
	}
	if ($ctaCredito->acesso()<1) {
		$msg .= '<h4>Conta de <strong>cr&eacute;dito</strong> inv&aacute;lida!</h4>';
		$msg .= '<p>Foi utilizado c&oacute;digo de acesso n&ordm;: '.$creditar.'</p>';
		$error = true;
	}

	if ($error) {
		$msgAlert  = '<div class="alert alert-danger" role="alert">';
		$msgAlert .= '<h3>Lan&ccedil;amento n&atilde;o permitido!</h3>';
		$msgAlert .= $msg;
		$msgAlert .= '<br /> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>';
		$msgErro .= $msgAlert.' Lan&ccedil;amentos com n&Uacute;mero de conta inexistente';
		$msgErro .= '! <u>O lan&ccedil;mento <b>N&Atilde;O</b> ';
		$msgErro .= 'foi confirmado!</u></div>';
		echo $msgErro;

	} else {
		require_once 'models/tes/lancamento_confirma.php';//Confirma lançamento
	}

}
?>
