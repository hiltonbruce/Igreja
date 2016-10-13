<?php
$query="SELECT *,DATE_FORMAT(batismo_em_aguas,'%d/%m/%Y') AS batismo_em_aguas,";
$query.="DATE_FORMAT(dt_mudanca_denominacao,'%d/%m/%Y') AS dt_mudanca_denominacao,";
$query.="DATE_FORMAT(diaconato,'%d/%m/%Y') AS diaconato,DATE_FORMAT(presbitero,'%d/%m/%Y') AS presbitero,";
$query.="DATE_FORMAT(evangelista,'%d/%m/%Y') AS evangelista,DATE_FORMAT(pastor,'%d/%m/%Y') AS pastor,";
$query.="DATE_FORMAT(c_impresso,'%d/%m/%Y') AS c_impresso,DATE_FORMAT(c_entregue,'%d/%m/%Y') AS c_entregue,";
$query.="DATE_FORMAT(dt_muda_assembleia,'%d/%m/%Y') AS dt_muda_assembleia,DATE_FORMAT(data,'%d/%m/%Y') AS data,";
$query.="DATE_FORMAT(auxiliar,'%d/%m/%Y') AS auxiliar,DATE_FORMAT(dat_aclam,'%d/%m/%Y') AS dat_aclam ";
$query.="FROM eclesiastico WHERE rol='".$bsc_rol."'";
$tabela = "eclesiastico";
ver_cad($bsc_rol);
$tab="adm/atualizar_dados.php";//link q informa o form quem chamar p atualizar os dados
$tab_edit="adm/dados_ecles.php&tabela=$tabela&bsc_rol=$bsc_rol&campo=";//Link de chamada da mesma página para abrir o form de edição do item
$dad_cad = mysql_query ($query);
$arr_dad = mysql_fetch_array ($dad_cad);
$igreja = new DBRecord ("igreja",$arr_dad["congregacao"],"rol");
$cidade = new DBRecord ("cidade",$arr_dad["local_batismo"],"id");
$ind=1;
?>
