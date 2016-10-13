<?PHP
if ($_SESSION['nivel']>4){
	require_once 'models/sec/dadosEcle.php';

	if (!empty($bsc_rol)) {
		if (!empty($arr_dad["rol"]) && $altEdit) {
		require_once 'views/secretaria/editEcle.php';
		//Fim do if !empty($arr_dad["rol"]) quando não existe cadastro para este rol é aberto um form para preenchimento
	}elseif (!$altEdit) {
		require_once 'views/secretaria/verEcle.php';
	}else {
			require_once ("adm/form_eclesiastico.php");
		}
	}//Fim do if de SESSION["rol"]
	}//Fim do if de nível

	?>
