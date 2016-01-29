<?php
$ind=1;
if ($_SESSION["setor"]=="2" || $_SESSION["setor"]>"50"){

	require_once 'views/menus/subDespesas.php';//Sub-Menu das despesas

	$agenda = ($_POST['age']!='') ? $_POST['age']:$_GET['age'];
	switch ($agenda) {
		case '3':
			require_once 'forms/ctapagar.php';//Form p/ agendar despesa
			break;
		case '5':
			require_once 'models/cadagendapgto.php';//Cadastra a despesa
			break;
		case '6':
-			require_once 'views/agendarpgto.php';//Contas a pagar
			break;
		case '7':
			//Cargos e funções
			$pgtoDias = new tes_cargo('1');
			$listaPgto = $pgtoDias->dadosCargo();
			$recLink='escolha=controller/despesa.php&menu=top_tesouraria&id=';
			$titTabela = 'Listagem para Pagamento';
			require_once 'help/tes/reciboPgto.php';
			require_once 'forms/tes/folha.php';//Form p cadastrar cargos
			require_once 'views/tesouraria/recPgto.php';
			break;
		case '8':
			//Recibos para de pgto
			$pgtoDias = new tes_cargo();
			$listaPgto = $pgtoDias->cargoIgreja($_POST['rolIgreja'],$_POST['idfunc'] );
			$recLink='#';
			$titTabela = 'Listagem para Pagamento';
			//print_r($listaPgto);
			require_once 'models/tes/cadCargoIgreja.php';//Cadastrar Membro no Cargo despesa
			break;
		case '9':

			//
			$titTabela = 'Demonstrativo de Pgto do mês:';
			$lista = new agenda();
			require_once 'views/tesouraria/despesaMes.php';//Cadastrar Membro no Cargo despesa
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
