<?PHP
	require_once 'models/sec/dadosEcle.php';
	if ($altEdit && $membro && $num_rows>'0') {
		require_once 'views/secretaria/editEcle.php';
	}elseif ($altEdit && $membro ) {
		require_once ("adm/form_eclesiastico.php");
	}elseif ($membro) {
		require_once 'views/secretaria/verEcle.php';
	}else {
	echo '<div class="alert alert-danger" role="alert">';
	echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
	echo ' <span class="sr-only">Error:</span>';
	echo ' O Rol n&ordm;: '.$bsc_rol.' <strong> N&Atilde;O</strong> possui cadastro!';
	echo '</div>';
	}
?>
