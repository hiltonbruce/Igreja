<?php
class formrecbusca extends formularioalterar {

	public function getMostrar(){

		switch ($_GET['escolha']) {
			case 'tesouraria/receita.php':
				if ($_GET['rec']=='1' || $_GET['rec']=='3') {
					$idformulario = 3;
				}else {
					$idformulario = 2;
				}
			break;
			case 'tesouraria/rec_alterar.php':

				 if ($_GET['recebeu']!='') {
					$idformulario = 2;
				}else {
					$idformulario = ($_GET['campo']=='') ? 4:5;
				}
			break;
			case 'tesouraria/agenda.php':
				 $idformulario = 3;
			break;
			case 'controller/despesa.php':
				 $idformulario = 2;
			break;
			case 'controller/recibo.php':
				if ($_GET['rec']=='4') {
					$idformulario = 1;
				}else {
					$idformulario = 2;
				}
			break;
			case 'controller/limpeza.php':
				if ($_GET['rec']=='4') {
					$idformulario = 2;
				}else {
					$idformulario = 2;
				}
			break;
			default:
				 $idformulario = 2;
			break;

		}
		//echo $_GET['escolha'].' ** '.$idformulario;
		require_once 'forms/tes/buscaRol.php';
	}
}
?>
