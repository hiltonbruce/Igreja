<?php
$ind=1; 
if ($_SESSION["setor"]=="2" || $_SESSION["setor"]>"50"){
?> 
<div id="tabs">
	<ul>
	  <li><a <?PHP link_ativo($_GET["age"], "1");?> href="./?escolha=tesouraria/despesa.php&menu=top_tesouraria&age=1"><span>Adiant. p/ Compras</span></a></li>
	  <li><a <?PHP link_ativo($_GET["age"], "2");?> href="./?escolha=tesouraria/despesa.php&menu=top_tesouraria&age=2"><span>Prestar Contas</span></a></li>
	  <li><a <?PHP link_ativo($_GET["age"], "3");?> href="./?escolha=tesouraria/despesa.php&menu=top_tesouraria&age=3"><span>Agendar Contas &agrave; Pagar</span></a></li>
	</ul>
</div>

<?php

	$agenda = ($_POST['age']!='') ? $_POST['age']:$_GET['age'];
	switch ($agenda) {
		case '3':
			require_once 'forms/ctapagar.php';//Contas a pagar
		break;
		case '4':
			require_once 'views/agendarpgto.php';//Contas a pagar
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
