<?php

require "../func_class/funcoes.php";
require "../func_class/classes.php";
$dadosEclesic='';

#Tabela Eclesiastico1 - traz dados da eclesiastico para eclesiastico1
  $sql   = 'SELECT * ';
  $sql  .= 'FROM eclesiastico LIMIT 5,10';
  $sqlEcles = mysql_query($sql);

    while($lista = mysql_fetch_array($sqlEcles)){

      $dadosEclesic = '"'.$lista['rol'].'","'.$lista['congregacao'].'","'.$lista['batismo_em_aguas'].'","'.$lista['local_batismo'].'","'.$lista['uf'].'","'.$lista['batismo_espirito_santo'].'","","'.$lista['igreja_batismo'].'","'.$lista['auxiliar'].'","'.$lista['diaconato'].'","'.$lista['presbitero'].'","'.$lista['evangelista'].'","'.$lista['pastor'].'","","","","","'.$lista['dat_aclam'].'","'.$lista['c_impresso'].'","'.$lista['quem_imprimiu'].'","'.$lista['c_entregue'].'","'.$lista['quem_recebeu'].'","'.$lista['quem_entregou'].'","'.$lista['rec_entrega'].'","'.$lista['situacao_espiritual'].'","","'.$lista['hist'].'","'.$lista['dt_cadastro'].'","'.$lista['obs'].'" ';
     
      echo $dadosEclesic.' *** <br />';
      $insertDados = new insert ($dadosEclesic,"eclesiastico1");
      echo $insertDados->inserir();

    }