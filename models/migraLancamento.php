<?PHP
$anoMes = intval($_GET['anomes']);
$queryLanc  = 'SELECT l.*, h.referente FROM lancamento AS l, lanchist AS h';
$queryLanc .= ' WHERE DATE_FORMAT(l.data,"%Y%m") = "'.$anoMes.'" AND';
$queryLanc .= ' l.lancamento=h.idlanca AND l.valor>0 AND d_c ="C"';
$queryLanc .= ' ORDER BY l.lancamento,l.d_c DESC';
$lista = mysql_query($queryLanc) or die(mysql_error());

while ($contas = mysql_fetch_array($lista)) {
   $value = '"","'.$contas['lancamento'].'","","'.$contas['conta'].'","'.$contas['valor'].'","'.$contas['igreja'].'","'.$contas['referente'].'","'.$contas['data'].'","Migracao"';
   $dados = new insert ($value,'lanc');
  // $dados->inserir();
   //$idAtual = mysql_insert_id();
  // $Atualizacao = mysql_query('UPDATE lanc SET debitar = "'.$contas['conta'].'" WHERE valor = "'.$contas['valor'].'" AND lancamento="'.$contas['lancamento'].'"');
   /*print_r($contas);*/
}

?>
