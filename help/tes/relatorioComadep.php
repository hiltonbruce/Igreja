<?php
if (empty($_GET['ano'])) {
	$a = date('Y');
	$ano = '';
} else {
	$a = $_GET['ano'];
	$ano = $a;
}

$d = $_GET['dia'];
$m=$_GET['mes'];
$dataMov = $d.'/'.$m.'/'.$a;

	if (!empty($_GET['igreja']) && $_GET['igreja']>'0') {
		$rolIgreja = ' AND igreja="'.intval($_GET['igreja']).'" ';
	}else {
		$rolIgreja = '';
	}

	if ($_GET['igreja']>'1') {
		$igrejaRelatorio = new DBRecord ("igreja",intval($_GET['igreja']),"rol");
		$congRelatorio = $igrejaRelatorio->razao();
	}elseif ($_GET['igreja']=='1'){
		$igreja = new DBRecord ("igreja","1","rol");
		$congRelatorio = $igreja->razao();

		if ($igreja->cidade()>0) {
			$cidSede = new DBRecord('cidade', $igreja->cidade(), 'id');
			$origem = $cidSede->nome();
		}else {
			$origem = $igreja->cidade();
		}

	}elseif ($_GET['igreja']=='-1') {
		$congRelatorio = 'Congrega&ccedil;&otilde;es';
	}else {
		$congRelatorio = 'Sede e Congrega&ccedil;&otilde;es';
	}

	if ($m<date('m') || $a<date('Y')) {
		$d=date("t",mktime(0,0,0,$m,1,$a));//recupera o ultimo dia do mês
	}elseif ($m>date('m') && $a>date('Y')){
		$d = date('d');
		$m = date('m');
		$a = date('Y');
	}

	if (checadata($dataMov)) {
		$mesRelatorio = '"'.$a.$m.'"';
	}elseif ($m>'0' && $m<'13') {
	//	$a = date('Y');
		$d=date("t",mktime(0,0,0,$m,1,$a));//recupera o ultimo dia do mês
		$mesRelatorio = '"'.$a.$m.'"';
	}else {
		list($d,$m,$a) = explode('/',date('d/m/Y'));
		$mesRelatorio = '"'.date('Ym').'"';
	}

?>
