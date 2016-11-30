<?php
	$tabela = "membro";
	$tab="adm/atualizar_dados.php";//link q informa o script quem receber� os dados do form para atualizar
	$tab_edit="adm/dados_pessoais.php&tabela=$tabela&bsc_rol=$bsc_rol&campo=";//Link de chamada da mesma p�gina para abrir o form de edi��o do item
	$conMem  = 'SELECT *,m.obs AS mobs, DATE_FORMAT(m.datanasc,"%d/%m/%Y") ';
	$conMem .= 'AS br_datanasc, m.datanasc AS nasc, DATE_FORMAT(m.datanasc,"%d" ';
	$conMem .= 'AS dia FROM membro AS m, cidade AS c,eclesiastico AS e ';
	$conMem .= 'WHERE m.rol="'.$bsc_rol.'" AND m.rol=e.rol';
	$dad_cad = mysql_query ($conMem);
	if (mysql_num_rows($dad_cad)<1)//Lista independente de outras tabelas
	{
		$dad_cad = mysql_query ("SELECT * FROM membro WHERE rol='".$bsc_rol."'");
	}
	$arr_dad = mysql_fetch_array ($dad_cad);
	$ind = 1;
	 if (file_exists("img_membros/".$bsc_rol.".jpg")) {
	        $img=$bsc_rol.".jpg";
	    } else {
	        $img="ver_foto.jpg";
	    }
	if ($altEdit && $membro) {
		require_once 'views/secretaria/editMembro.php';
	} elseif ($membro) {
		require_once 'views/secretaria/verMembro.php';
	}
?>
