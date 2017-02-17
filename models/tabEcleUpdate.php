<?php
$result = mysql_query("SELECT * FROM eclesiasticobkp ORDER BY rol") or die (mysql_error());
 while($col_lst = mysql_fetch_assoc($result))
 {
	 $query = 'UPDATE eclesiastico SET local_batismo = "'.$col_lst["local_batismo"].'", uf = "'.$col_lst["uf"].'" WHERE rol ='. $col_lst["rol"];
	 $up = mysql_query($query);
		if(mysql_affected_rows() > 0){
		  echo "Sucesso: Atualizado corretamente!";
		}else{
		  echo "Aviso: Não foi atualizado!";
		}
	 	 echo $col_lst["local_batismo"].' - '.$col_lst["uf"].' - '.$col_lst["rol"];
 }
?>
