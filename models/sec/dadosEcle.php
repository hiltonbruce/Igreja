<?php
$query="SELECT *,DATE_FORMAT(batismo_em_aguas,'%d/%m/%Y') AS batismo_em_aguas,";
$query.="DATE_FORMAT(dt_mudanca_denominacao,'%d/%m/%Y') AS dt_mudanca_denominacao,";
$query.="DATE_FORMAT(diaconato,'%d/%m/%Y') AS diaconato,DATE_FORMAT(presbitero,'%d/%m/%Y') AS presbitero,";
$query.="DATE_FORMAT(evangelista,'%d/%m/%Y') AS evangelista,DATE_FORMAT(pastor,'%d/%m/%Y') AS pastor,";
//$query.="DATE_FORMAT(missionario,'%d/%m/%Y') AS missionario,";
$query.="DATE_FORMAT(c_impresso,'%d/%m/%Y') AS c_impresso,DATE_FORMAT(c_entregue,'%d/%m/%Y') AS c_entregue,";
$query.="DATE_FORMAT(dt_muda_assembleia,'%d/%m/%Y') AS dt_muda_assembleia,DATE_FORMAT(data,'%d/%m/%Y') AS data,";
$query.="DATE_FORMAT(auxiliar,'%d/%m/%Y') AS auxiliar,DATE_FORMAT(dat_aclam,'%d/%m/%Y') AS dat_aclam ";
$query.="FROM eclesiastico WHERE rol='".$bsc_rol."'";
$tabela = "eclesiastico";
$tab="adm/atualizar_dados.php";//link q informa o form quem chamar p atualizar os dados
$tab_edit="adm/dados_ecles.php&tabela=$tabela&bsc_rol=$bsc_rol&campo=";//Link de chamada da mesma p�gina para abrir o form de edi��o do item
$dad_cad = mysql_query ($query);
$arr_dad = mysql_fetch_array ($dad_cad);
$num_rows = mysql_num_rows($dad_cad);
//print_r($num_rows);
//echo '++'.$bsc_rol.' ***<br />';
//print_r($arr_cad);
//exit;
$igreja = new DBRecord ("igreja",$arr_dad["congregacao"],"rol");
$cidade = new DBRecord ("cidade",$arr_dad["local_batismo"],"id");
$ind=1;
?>
