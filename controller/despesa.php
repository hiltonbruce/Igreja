<?php
$d = $_GET['dia'];$m=$_GET['mes'];$a=$_GET['ano'];
$dataMov = $d.'/'.$m.'/'.$a;

if (!empty($_GET['igreja']) && $_GET['igreja']>0) {
	$rolIgreja = ' AND igreja="'.$_GET['igreja'].'"';
}else {
	$rolIgreja = '';
}

if ($_GET['rec']>'12' && $_GET['rec']<'20') {
	session_start();
	if ($_SESSION["setor"]=="2" || $_SESSION["setor"]>"50"){
		require "../help/impressao.php";//Include de funcões, classes e conexões com o BD
		$igreja = new DBRecord ("igreja","1","rol");
		
		if ($_GET['igreja']>'1') {
			$igrejaRelatorio = new DBRecord ("igreja",$_GET['igreja'],"rol");
			$congRelatorio = $igrejaRelatorio->razao();
		}elseif ($_GET['igreja']==$igreja->rol()){
			$congRelatorio = $igreja->razao();
		}else {
			$congRelatorio = '';
		}
		
		if ($m<date('m')) {
			$d=date("t",mktime(0,0,0,$m,1,$a));//recupera o ultimo dia do mês
		}elseif ($m>date('m')){
			$d = date('d');
			$m = date('m');
			$a = date('Y');
		}

		if (!empty($dataMov) && checadata($dataMov)) {
			$mesRelatorio = '"'.$a.$m.'"';
		}elseif ($m>'0' && $m<'13') {
			$a = date('Y');
			$d=date("t",mktime(0,0,0,$m,1,$a));//recupera o ultimo dia do mês
			$mesRelatorio = '"'.$a.$m.'"';
		}else {
			list($d,$m,$a) = explode('/',date('d/m/Y'));
			$mesRelatorio = '"'.date('Ym').'"';
		}
			
		
		if ($igreja->cidade()>0) {
			$cidSede = new DBRecord('cidade', $igreja->cidade(), 'id');
			$origem = $cidSede->nome();
		}else {
			$origem = $igreja->cidade();
		}

		switch ($_GET['rec']) {
			
			case '13':
				$mesRelatorio .=$rolIgreja;
				$dtRelatorio = data_extenso ($d.'/'.$m.'/'.$a);
				$titTabela = 'Fluxo das Contas - '.$dtRelatorio.'<h3>'.$congRelatorio.'<h3>';
				require_once '../models/tes/relatorioComadep.php';
				$nomeArquivo='../views/saldosComadep.php';
				require_once '../views/modeloPrint.php';
				break;

			default:
				break;
		}

		
	}
}else {
	
		
	if (!empty($dataMov) && checadata($dataMov)) {
		$mesRelatorio = '"'.$a.$m.'"';
	}elseif ($m>'0' && $m<'13') {
			$a = date('Y');
			$d=date("t",mktime(0,0,0,$m,1,$a));//recupera o ultimo dia do mês
			$mesRelatorio = '"'.$a.$m.'"';
	}else {
		list($d,$m,$a) = explode('/',date('d/m/Y'));
		$mesRelatorio = '"'.date('Ym').'"';
	}

	if ($_GET['igreja']>'0') {
		$igrejaRelatorio = new DBRecord ("igreja",$_GET['igreja'],"rol");
		$congRelatorio = ' Igreja: '.$igrejaRelatorio->razao();
	}else {
		$congRelatorio = '';
	}
	
	if ($m<date('m')) {
		$d=date("t",mktime(0,0,0,$m,1,$a));//recupera o ultimo dia do mês
	}elseif ($m>date('m')){
			$d = date('d');
			$m = date('m');
			$a = date('Y');
		}

		

$ind=1; 
if ($_SESSION["setor"]=="2" || $_SESSION["setor"]>"50"){
?> 
<div id="tabs">
	<ul>
	  <li><a <?PHP link_ativo($_GET["age"], "1");?>
			href="./?escolha=controller/despesa.php&menu=top_tesouraria&age=1"><span>Adiant. p/ Compras</span></a></li>
	  <li><a <?PHP link_ativo($_GET["age"], "2");?> 
			href="./?escolha=controller/despesa.php&menu=top_tesouraria&age=2"><span>Prestar Contas</span></a></li>
	  <li><a <?PHP link_ativo($_GET["age"], "3");?>
			href="./?escolha=controller/despesa.php&menu=top_tesouraria&age=3"><span>Agendar Despesa</span></a></li>
	  <li><a <?PHP link_ativo($_GET["age"], "4");?>
			href="./?escolha=controller/despesa.php&menu=top_tesouraria&age=4"><span>COMADEP</span></a></li>
	  <li><a <?PHP link_ativo($_GET["age"], "7");?>
			href="./?escolha=controller/despesa.php&menu=top_tesouraria&age=7"><span>Folha</span></a></li>
	</ul>
</div>
<?php

	$agenda = ($_POST['age']!='') ? $_POST['age']:$_GET['age'];
	switch ($agenda) {
		case '3':
			require_once 'forms/ctapagar.php';//Contas a pagar
			break;
		case '4'://Relatório COMADEP
			$mesRelatorio .=$rolIgreja;
			$dtRelatorio = data_extenso ($d.'/'.$m.'/'.$a);
			$titTabela = 'Fluxo das Contas - COMADEP - '.$dtRelatorio.$congRelatorio;;
			$recLink = '13&dia='.$d.'&mes='.$m.'&ano='.$a;
			$linkImpressao ='controller/despesa.php/?rec='.$recLink.'&igreja='.$_GET['igreja'];
			require_once 'models/tes/relatorioComadep.php';
			require_once ('views/saldosComadep.php');
			require_once 'forms/tes/mesComadep.php';
			break;
		case '5':
			require_once 'models/cadagendapgto.php';//Agenda despesa
			break;
		case '6':
-			require_once 'views/agendarpgto.php';//Contas a pagar
			break;
		case '7':
-			require_once 'forms/tes/folha.php';//Form p cadastrar cargos
			break;
		case '8':
			
			//Recibos para de pgto
			$pgtoDias = new tes_cargo();
			$listaPgto = $pgtoDias->cargoIgreja($_POST['rolIgreja'],$_POST['idfunc'] );
			$recLink='#';
			$titTabela = 'Listagem para Pagamento';
			print_r($listaPgto);
			require_once 'models/tes/cadCargoIgreja.php';//Cadastrar Membro no Cargo despesa
			break;
		default:
			;
			break;
	}
	
} else {
	echo "<script> alert('Sem permissão de acesso! Entre em contato com o Tesoureiro!');location.href='../?escolha=adm/cadastro_membro.php&uf=PB';</script>";
	$_SESSION = array();
	session_destroy();
	header("Location: ./");
}
}
?>