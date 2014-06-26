<?php

if ($_GET['rec']>'12' && $_GET['rec']<'20') {
	session_start();
	if ($_SESSION["setor"]=="2" || $_SESSION["setor"]>"50"){
		require "../help/impressao.php";//Include de funcões, classes e conexões com o BD
		$igreja = new DBRecord ("igreja","1","rol");

		if (!empty($_GET['data']) && checadata($_GET['data'])) {
			list($d,$m,$a) = explode('/', $_GET['data']);
			$mesRelatorio = $a.$m;
		}else {
			list($d,$m,$a) = explode('/',date('d/m/Y'));
			$mesRelatorio = date('Ym');
		}
			
		if ($m<date('m')) {
			$d=date("t",mktime(0,0,0,$m,1,$a));//recupera o ultimo dia do mês
		}
		
		if ($igreja->cidade()>0) {
			$cidSede = new DBRecord('cidade', $igreja->cidade(), 'id');
			$origem = $cidSede->nome();
		}else {
			$origem = $igreja->cidade();
		}

		switch ($_GET['rec']) {
			case '13':
				
				
				$dtRelatorio = data_extenso ($d.'/'.$m.'/'.$a);
				$titTabela = 'Fluxo das Contas - COMADEP - '.$dtRelatorio;
				require_once '../models/tes/relatorioComadep.php';
				$nomeArquivo='../views/saldosComadep.php';
				//require_once ('');
				require_once '../views/modeloPrint.php';
				break;

			default:
				break;
		}

	}
}else {

	if (!empty($_GET['data']) && checadata($_GET['data'])) {
		list($d,$m,$a) = explode('/', $_GET['data']);
		$mesRelatorio = $a.$m;
	}else {
		list($d,$m,$a) = explode('/',date('d/m/Y'));
		$mesRelatorio = date('Ym');
	}
		
	if ($m<date('m')) {
		$d=date("t",mktime(0,0,0,$m,1,$a));//recupera o ultimo dia do mês
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
	</ul>
</div>
<?php

	$agenda = ($_POST['age']!='') ? $_POST['age']:$_GET['age'];
	switch ($agenda) {
		case '3':
			require_once 'forms/ctapagar.php';//Contas a pagar
		break;
		case '4'://Relatório COMADEP
			$dtRelatorio = data_extenso ($d.'/'.$m.'/'.$a);
			$titTabela = 'Fluxo das Contas - COMADEP - '.$dtRelatorio;
			$recLink = '13&data='.$_GET['data'];
			$linkImpressao ='controller/despesa.php/?rec='.$recLink;
			require_once 'models/tes/relatorioComadep.php';
			require_once ('views/saldos.php');
		break;
		case '5':
			require_once 'models/cadagendapgto.php';//Agenda despesa
		break;
		case '6':
-			require_once 'views/agendarpgto.php';//Contas a pagar
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