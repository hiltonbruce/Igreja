<?PHP
	$tab="adm/atualizar_dados.php";//link q informa o form quem chamar p atualizar os dados
	$tab_edit="adm/dados_famil.php&bsc_rol=$bsc_rol&tabela=est_civil&campo=";//Link de chamada da mesma p�gina para abrir o form de edi��o do item
	$dad_cad = mysql_query ("SELECT *,DATE_FORMAT(data,'%d/%m/%Y') AS data  FROM est_civil WHERE rol='".$bsc_rol."'");
	$arr_dad = mysql_fetch_array ($dad_cad);
	$num_rows = mysql_num_rows($dad_cad);
	$ind = 1; //Define o indice dos campos do formul�rio
	ver_cad($bsc_rol);
	if ($altEdit && $membro && $num_rows>'0') {
		require_once 'views/secretaria/editFamilia.php';
	}elseif ($altEdit && $membro ) {
		require_once ("adm/form_famil.php");
	}elseif ($membro && $num_rows>'0') {
		require_once 'views/secretaria/verFamilia.php';
	}else {
	echo '<div class="alert alert-danger" role="alert">';
	echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
	echo ' <span class="sr-only">Error:</span>';
	echo ' O Rol n&ordm;: '.$bsc_rol.' <strong> N&Atilde;O</strong> possui cadastro!';
	echo '</div>';
	}
?>
