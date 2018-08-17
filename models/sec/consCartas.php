<?php
$query = "SELECT *,DATE_FORMAT(data,'%d/%m/%Y')AS data FROM carta WHERE rol='".$bsc_rol."' ORDER BY id DESC";
$nmpp="5"; //N�mero de mensagens por p�rginas
$paginacao = Array();
$paginacao['link'] = "?"; //Pagina��o na mesma p�gina
//Faz os calculos na pagina��o
$sql2 = mysql_query ("$query") or die (mysql_error());
$total = mysql_num_rows($sql2) ; //Retorna o total de linha na tabela
$paginas = ceil ($total/$nmpp); //Retorna o total de p�ginas
$pagina = $HTTP_GET_VARS["pagina1"];
if (!isset($pagina)) {$pagina=0;} //Especifica um valor p vari�vel p�gina caso ela esteja setada
$inicio=$pagina * $nmpp; //Retorna qual ser� a primeira linha a ser mostrada no MySQL
$sql3 = mysql_query ("$query"." LIMIT $inicio,$nmpp") or die (mysql_error());
//Executa a query no MySQL com limite de linhas para ser usado pelo while e montar a array
$arr_dad = mysql_fetch_array ($sql3);
?>
