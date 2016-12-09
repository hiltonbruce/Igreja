<?php
	$tab="adm/atualizar_dados.php";//link q informa o form quem chamar p atualizar os dados
	$tab_edit="adm/dados_profis.php&bsc_rol=$bsc_rol&tabela=profissional&campo=";//Link de chamada da mesma página para abrir o form de edição do item
	$arr_dad = new DBRecord ('profissional',$bsc_rol,'rol');
	$ind=1;
	if ($altEdit && $membro) {
	 require_once 'views/secretaria/editProf.php';
	} elseif ($membro) {
	 require_once 'views/secretaria/verProf.php';
	}
?>
