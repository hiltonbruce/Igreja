<div id="lst_cad">
<table class='table'>
    <tr>
      <td>Onde congrega:<p><a href="./?escolha=adm/dados_ecles.php&bsc_rol=<?php echo $bsc_rol;?>&campo=congregacao" ><?PHP print $arr_dad["congregacao"]." - ".$igreja->razao();?></a></p>
      <?PHP
  if ($_GET["campo"]=="congregacao"){
  ?>
    <form id="form1" name="form1" method="post" action="">
       <?PHP
  //  $lst_cid = new sele_cidade("cidade","$vl_uf","{$arr_dad["uf"]}","nome","cid_nasc");
    $congr = new List_sele ("igreja","razao","congregacao");
    echo $congr->List_Selec (++$ind,$igreja->rol(),' class="form-control" ');
   ?>
   <input name="escolha" type="hidden" id="escolha" value="adm/atualizar_dados.php" />
    <input name="tabela" type="hidden" id="tabela" value="eclesiastico" />
    <input name="bsc_rol" type="hidden" id="campo" value="<?PHP echo $bsc_rol;?>" />
    <input name="campo" type="hidden" id="campo" value="congregacao" />
    <input name="Alterar..." class="btn btn-primary btn-xs" type="submit" id="Alterar..." value="Alterar..." tabindex="2" />
    </form>
  <?PHP
  }
  ?></td>
      <td>Situa&ccedil;&atilde;o espiritual:
      <?PHP
    $nome = new editar_form("situacao_espiritual",situacao ($arr_dad["situacao_espiritual"]),$tab,$tab_edit);
    $nome->getMostrar();$nome->getEditar('','',$bsc_rol);
    ?></td>
      <td>Ano  Batismo  Esp. Santo:
      <?PHP
  $nome = new editar_form("batismo_espirito_santo",$arr_dad["batismo_espirito_santo"],$tab,$tab_edit);
  $nome->getMostrar();
  $nome->getEditar('','',$bsc_rol);
  ?></td>
    </tr>
    <tr>
      <td>Data Batismo &Aacute;guas:
      <?PHP
  $nome = new editar_form("batismo_em_aguas",$arr_dad["batismo_em_aguas"],$tab,$tab_edit);
  $nome->getMostrar();
  $nome->getEditar('','',$bsc_rol);
  ?></td>
      <td colspan="2">Denomina&ccedil;&atilde;o que veio:
      <?PHP
  $nome = new editar_form("veio_qual_denominacao",$arr_dad["veio_qual_denominacao"],$tab,$tab_edit);
  $nome->getMostrar();
  $nome->getEditar('','',$bsc_rol);
  ?></td>
    </tr>
    <tr>
      <td>UF:
        <p><a href="./?escolha=adm/dados_ecles.php&bsc_rol=<?php echo $bsc_rol;?>&campo=uf"><?PHP print " > {$arr_dad["uf"]} < ";?></a>
        <?PHP
        if ($_GET["campo"]=="uf"){
        ?>
        </p>
        <form id="form2" name="form2" method="post" action="">
        <?PHP
          echo sele_uf ($arr_dad["uf"],"uf");
        ?>
          <label>
          <input name="escolha" type="hidden" id="escolha" value="<?PHP echo "adm/atualizar_dados.php";?>" />
          <input name="campo" type="hidden" id="campo" value="<?PHP echo $_GET["campo"];?>" />
          <input name="tabela" type="hidden" id="tabela" value="<?PHP echo "eclesiastico";?>" />
          <input name="bsc_rol" type="hidden" id="campo" value="<?PHP echo $bsc_rol;?>" />
          <input name="Submit" type="submit" class="btn btn-primary btn-xs" id="Submit" value="Alterar..." tabindex="2"/>
          </label>
        </form>
        <?PHP } ?></td>
  <td>Local de Batismo:
  <?PHP
  echo $arr_dad["local_batismo"];
  $nome = new editar_form("local_batismo",$cidade->nome(),$tab,$tab_edit);
  $nome->getMostrar();
  if ($_GET["campo"]=="local_batismo"){
  ?>
    <form id="form3" name="form3" method="post" action="">
    <input name="escolha" type="hidden" id="escolha" value="<?PHP echo "adm/atualizar_dados.php";?>" />
    <input name="campo" type="hidden" id="campo" value="<?PHP echo $_GET["campo"];?>" />
    <input name="bsc_rol" type="hidden" id="campo" value="<?PHP echo $bsc_rol;?>" />
  <?PHP
    $lst_cid = new sele_cidade("cidade",$arr_dad["uf"],"coduf","nome","local_batismo");
    $vlr_linha=$lst_cid->ListDados ($ind++);
  ?>
    <input name="Submit" class="btn btn-primary btn-xs" type="submit" id="Submit" value="Alterar..." tabindex="<?PHP echo $ind++;?>"/>
    <input name="tabela" type="hidden" id="tabela" value="<?PHP echo "eclesiastico";?>" />
    </form>
    <?PHP
  }
  ?></td>
      <td>Mudou da denomina&ccedil;&atilde;o:
      <?PHP
  $nome = new editar_form("dt_mudanca_denominacao",$arr_dad["dt_mudanca_denominacao"],$tab,$tab_edit);
  $nome->getMostrar();
  $nome->getEditar('','',$bsc_rol);
  ?></td>
    </tr>
    <tr>
      <td>Auxiliar de trabalho em:
      <?PHP
  $nome = new editar_form("auxiliar",$arr_dad["auxiliar"],$tab,$tab_edit);
  $nome->getMostrar();
  $nome->getEditar('','',$bsc_rol);
  ?></td>
      <td>Di&aacute;cono em:
      <?PHP
  $nome = new editar_form("diaconato",$arr_dad["diaconato"],$tab,$tab_edit);
  $nome->getMostrar();
  $nome->getEditar('','',$bsc_rol);
  ?></td>
  <td >Presbit&eacute;ro em:
      <?PHP
  $nome = new editar_form("presbitero",$arr_dad["presbitero"],$tab,$tab_edit);
  $nome->getMostrar();
  $nome->getEditar('','',$bsc_rol);
  ?></td>
    </tr>
    <tr>
      <td>Evangelista em:
        <?PHP
        $nome = new editar_form("evangelista",$arr_dad["evangelista"],$tab,$tab_edit);
        $nome->getMostrar();
        $nome->getEditar('','',$bsc_rol);
        ?>
    </td>
    <td>Pastor em:
      <?PHP
        $nome = new editar_form("pastor",$arr_dad["pastor"],$tab,$tab_edit);
        $nome->getMostrar();
        $nome->getEditar('','',$bsc_rol);
      ?>
    </td>
      <td>Mission&aacute;rio em:
        <?PHP
          $nome = new editar_form("missionario",$arr_dad["missionario"],$tab,$tab_edit);
          $nome->getMostrar();
          $nome->getEditar('','',$bsc_rol);
        ?>
      </td>
    </tr>
    <tr>
      <td>Data:
        <?PHP
        $nome = new editar_form("data",$arr_dad["data"],$tab,$tab_edit);
        $nome->getMostrar();$nome->getEditar('','',$bsc_rol);
        ?>
      </td>
      <td>Cidade e UF de onde veio:
        <?PHP
        $nome = new editar_form("lugar",$arr_dad["lugar"],$tab,$tab_edit);
        $nome->getMostrar();
        $nome->getEditar('','',$bsc_rol);
        ?>
      </td>
      <td>Data da mudan&ccedil;a da outra Assembleia:
        <?PHP
        $nome = new editar_form("dt_muda_assembleia",$arr_dad["dt_muda_assembleia"],$tab,$tab_edit);
        $nome->getMostrar();$nome->getEditar('','',$bsc_rol);
        ?>
      </td>
    </tr>
    <tr>
      <td>
        Data da aclama&ccedil;&atilde;o: (Membro desde)
        <?PHP
        $nome = new editar_form("dat_aclam",$arr_dad["dat_aclam"],$tab,$tab_edit);
        $nome->getMostrar();
        $nome->getEditar('','',$bsc_rol);
        ?>
      </td>
      <td>Cart&atilde;o Impresso em:
        <?PHP
        echo '<p>'.$arr_dad["c_impresso"].'<p>';
        ?>
      </td>
      <td>Cart&atilde;o Impresso por:
        <p><a href="./?escolha=adm/dados_pessoais.php&bsc_rol=<?PHP echo $arr_dad["quem_imprimiu"];?>" title="<?PHP echo  "Rol: ".$arr_dad["quem_imprimiu"];?> - Click aqui para dados completos">
          <?PHP echo substr (fun_igreja ($arr_dad["quem_imprimiu"]),0,25);?>
        </a>
      </p>
      </td>
    </tr>
    <tr>
      <td>Cart�o Entregue em:
      <?PHP
      echo '<p>'.$arr_dad["c_entregue"].'</p>';
  ?></td>
      <td>Cart�o Recebido por:
      <p><a href="./?escolha=adm/dados_pessoais.php&bsc_rol=<?PHP echo $arr_dad["quem_recebeu"];?>" title="<?PHP echo  "Rol: ".$arr_dad["quem_recebeu"];?> - Click aqui para dados completos">
        <?PHP  echo substr (fun_igreja ($arr_dad["quem_recebeu"]),0,25);?>
      </a></p></td>
      <td>
        Cart�o Entregue por:
        <p>
          <a href="./?escolha=adm/dados_pessoais.php&bsc_rol=<?PHP echo $arr_dad["quem_entregou"];?>" title="<?PHP echo  "Rol: ".$arr_dad["quem_entregou"];?> - Click aqui para dados completos">
          <?PHP  echo substr (fun_igreja ($arr_dad["quem_entregou"]),0,25); ?>
          </a>
        </p>
      </td>
    </tr>
    <tr>
    <td colspan="3">Observa&ccedil;&otilde;es:
        <p>
  <?PHP
  $nome = new editar_form("obs",$arr_dad["obs"],$tab,$tab_edit);
  $nome->getMostrar();$nome->getEditar('','',$bsc_rol);
  ?></p></td>
  </tr>
  <tr>
    <td>Recibo de entrega N&ordm;:
    </td>
    <td colspan="3"><p>
    <?PHP
      if ($arr_dad["rec_entrega"]>"0") {
        printf ("<a href='relatorio/recibo_print.php?recibo={$arr_dad["rec_entrega"]}'
      title='Click aqui para re-impress&atilde;o do recibo'> %'05u &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Visualizar Recibo</a>",$arr_dad["rec_entrega"]) ;
      }else {
        echo "Sem recibo de entrega";
      }
  ?></p>
  </td>
  </tr>
  </table>
</div>
<div class="alert alert-info" role="alert">
<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
Registros recentes: <?php echo $arr_dad['hist'].' em: '.$arr_dad['dt_cadastro']; ?>
</div>
