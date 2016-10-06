<?php
	ver_cad($bsc_rol);
	$tabela = "membro";
	$tab="adm/atualizar_dados.php";//link q informa o script quem receber� os dados do form para atualizar
	$tab_edit="adm/dados_pessoais.php&tabela=$tabela&bsc_rol=$bsc_rol&campo=";//Link de chamada da mesma p�gina para abrir o form de edi��o do item
	$dad_cad = mysql_query ("SELECT *,m.obs AS mobs, DATE_FORMAT(m.datanasc,'%d/%m/%Y') AS br_datanasc, m.datanasc AS nasc, DATE_FORMAT(m.datanasc,'%d') AS dia FROM membro AS m, eclesiastico AS e WHERE m.rol='".$bsc_rol."' AND m.rol=e.rol");
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
	if ($altEdit) {
		require_once 'views/secretaria/editMembro.php';
	} else {
		require_once 'views/secretaria/verMembro.php';
	}
?>
