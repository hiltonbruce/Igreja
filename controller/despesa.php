<?php
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
			if (!empty($_GET['data']) && checadata($_GET['data'])) {
				$dtRelatorio = data_extenso ($_GET['data']);
			}else {
				$dtRelatorio = data_extenso (date('d/m/Y'));
			}
			$titTabela = 'Relatório COMADEP - '.$dtRelatorio;
			$recLink = '10';
			$linkImpressao ='controller/despesa.php/?rec='.$recLink;
			require_once 'models/tes/relatorioComadep.php';
			require_once ('views/saldos.php');
		break;
		case '5':
			require_once 'models/cadagendapgto.php';//Contas a pagar
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
?>