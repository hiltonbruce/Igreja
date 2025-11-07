<?php
$query = "SELECT *,DATE_FORMAT(data,'%d/%m/%Y')AS data FROM carta WHERE rol='".$bsc_rol."' ORDER BY id DESC";
$nmpp="5"; //Número de mensagens por párginas
$paginacao = Array();
$paginacao['link'] = "?"; //Paginaï¿½ï¿½o na mesma pï¿½gina
//Faz os calculos na paginaï¿½ï¿½o
$sql2 = mysql_query ("$query") or die (mysql_error());
$total = mysql_num_rows($sql2) ; //Retorna o total de linha na tabela
$paginas = ceil ($total/$nmpp); //Retorna o total de páginas
$pagina = $HTTP_GET_VARS["pagina1"];
if (!isset($pagina)) {$pagina=0;} //Especifica um valor p variï¿½vel pï¿½gina caso ela esteja setada
$inicio=$pagina * $nmpp; //Retorna qual serï¿½ a primeira linha a ser mostrada no MySQL
$sql3 = mysql_query ("$query"." LIMIT $inicio,$nmpp") or die (mysql_error());
//Executa a query no MySQL com limite de linhas para ser usado pelo while e montar a array
$arr_dad = mysql_fetch_array ($sql3);

// echo var_dump(mysql_fetch_array ($sql2));
// while($dados = mysql_fetch_assoc($sql2))
// {
//     echo var_dump($dados['destino']);
//     echo '<br>';
// }
// echo '<br>';
// echo $total;
// echo '<br>';
?>
