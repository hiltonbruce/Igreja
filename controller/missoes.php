<?php
	if ($_SESSION["setor"]==4 || $_SESSION["setor"]>50){
		$tabRelatorio = 'views/tesouraria/tabDizimosOfertas.php';
		$dizmista = new dizresp($_SESSION['valid_user'],'',$rec,$_SESSION['setor']);
		if (intval($_POST['rolIgreja'])>0) {
			$idIgreja=intval($_POST['rolIgreja']);
		}elseif (!empty($_GET['igreja'])) {
			$idIgreja = intval($_GET['igreja']);
		}else {
			$idIgreja = 0;
		}
		if ($idIgreja==0) {
				$igrejaSelecionada = $igSede;
				//$igLanc = $igrejaSelecionada;
		} else {
			$igrejaSelecionada = new DBRecord('igreja', $idIgreja, 'rol');
			$igLanc = $igrejaSelecionada;
		}
		$bt1 = '';
		$bt2 = '';
		$op = (empty($_GET['rec'])) ? '0' : intval($_GET['rec']) ;
		$bt = 'bt'.$op;
		$$bt = 'active' ;
		switch ($op) {
			case '0':
				require_once 'views/emConstrucao.php';
				break;
			case '1':
				require_once 'forms/missoes/entradas.php';
				break;
			case '2':
				require_once 'views/emConstrucao.php';
				break;
			default:
				# code...
				break;
		}
	}
require_once $tabRelatorio;
?>
