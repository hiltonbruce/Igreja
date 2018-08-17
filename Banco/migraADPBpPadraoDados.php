<?php

require "../func_class/funcoes.php";
require "../func_class/classes.php";
$dadosEclesic='';

#Tabela Eclesiastico1 - traz dados da eclesiastico para eclesiastico1
  $sql   = 'SELECT * ';
  $sql  .= 'FROM eclesiastico';
  $sqlEcles = mysql_query($sql);

    while($lista = mysql_fetch_array($sqlEcles)){

      $dadosEclesic = '"'.$lista['rol'].'","'.$lista['congregacao'].'","'.$lista['batismo_em_aguas'].'","'.$lista['local_batismo'].'","'.$lista['uf'].'","'.$lista['batismo_espirito_santo'].'","","'.$lista['igreja_batismo'].'","'.$lista['auxiliar'].'","'.$lista['diaconato'].'","'.$lista['presbitero'].'","'.$lista['evangelista'].'","'.$lista['pastor'].'","","","","","'.$lista['dat_aclam'].'","'.$lista['c_impresso'].'","'.$lista['quem_imprimiu'].'","'.$lista['c_entregue'].'","'.$lista['quem_recebeu'].'","'.$lista['quem_entregou'].'","'.$lista['rec_entrega'].'","'.$lista['situacao_espiritual'].'","","'.$lista['hist'].'","'.$lista['dt_cadastro'].'","'.$lista['obs'].'" ';

      echo $dadosEclesic.' *** <br />';
      $insertDados = new insert ($dadosEclesic,"eclesiastico1");
      echo $insertDados->inserir();

    }

#Tabela membro1 - traz dados da membro para membro1
  $sql   = 'SELECT * ';
  $sql  .= 'FROM membro';
  $sqlMembro = mysql_query($sql);

    while($lista = mysql_fetch_array($sqlMembro)){

      $dadosMembro = '"'.$lista['rol'].'","'.$lista['nome'].'","'.$lista['nacionalidade'].'",
      "'.$lista['naturalidade'].'","'.$lista['uf_nasc'].'","'.$lista['sexo'].'","",
      "'.$lista['endereco'].'","'.$lista['numero'].'","'.$lista['complemento'].'","'.$lista['cep'].'",
      "'.$lista['bairro'].'","'.$lista['cidade'].'","'.$lista['uf_resid'].'","'.$lista['escolaridade'].'","'.$lista['graduacao'].'",
      "'.$lista['email'].'","'.$lista['fone_resid'].'","'.$lista['celular'].'",
      "'.$lista['datanasc'].'","'.$lista['obs'].'","'.$lista['doador'].'","'.$lista['sangue'].'",
      "'.$lista['mae'].'","'.$lista['mae_rol'].'","'.$lista['pai'].'","'.$lista['pai_rol'].'","'.$lista['dt_cadastro'].'",
      "'.$lista['obs'].'" ';

      echo $dadosMembro.' *** <br />';
      $insertDados = new insert ($dadosMembro,"Membro1");
      echo $insertDados->inserir();

    }

#Tabela profissional1 - traz dados da membro para profissional1
  $sql   = 'SELECT * ';
  $sql  .= 'FROM profissional';
  $sqlMembro = mysql_query($sql);

    while($lista = mysql_fetch_array($sqlProfissional)){

      $dadosProfissional = '"'.$lista['rol'].'",
      "'.$lista['profissao'].'","'.$lista['obs'].'",
      "'.$lista['cpf'].'","'.$lista['rg'].'","'.$lista['orgao_expedidor'].'","'.$lista['onde_trabalha'].'","'.$lista['obs'].'",
      "'.$lista['dt_cadastro'].'" ';

      echo $dadosProfissional.' *** <br />';
      $insertDados = new insert ($dadosProfissional,"profissional1");
      echo $insertDados->inserir();

    }
