<?php
if ($_GET['ig']!='0') {

  $query  = 'SELECT *,m.rol AS membroRol,m.rol AS membroRol from membro AS m, eclesiastico AS e, igreja AS i  WHERE m.rol=e.rol AND ';
  $query .= 'i.rol=e.congregacao AND e.situacao_espiritual<=2 '.$ordenar->cargo().' ORDER BY '.$ordenar->ordenar();

}else {

  $query  = 'SELECT *,m.rol AS membroRol from membro AS m, eclesiastico AS e, igreja AS i WHERE m.rol=e.rol AND ';
  $query .= 'i.rol=e.congregacao AND ( e.congregacao = "" OR e.congregacao = "0" OR i.razao = "" ) AND ';
  $query .= 'e.situacao_espiritual<=2 '.$ordenar->cargo().' ORDER BY '.$ordenar->ordenar();

}
 ?>
