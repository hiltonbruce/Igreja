<div id="lst_cad">
<div class="row">
	<form enctype="multipart/form-data" method="post" action="adm/salvar_foto.php">
          <div class="col-xs-6">
             <input type="hidden" name="MAX_FILE_SIZE" value="200000">
             <label>Salvar foto:</label>
             <input name="userfile" type="file" class="btn btn-default btn-sm" >
          </div>
          <div class="col-xs-2 text-center">
            <label>&nbsp;</label>
            <input name="bsc_rol" type="hidden" value='<?PHP echo $bsc_rol;?>'>
            <input type="submit" class="btn btn-primary btn-sm" name="Submit" value="Enviar...">
          </div>
	</form>
          <div class="col-xs-2 text-center"><br />
             <?PHP
                if ($img!="ver_foto.jpg") {
              ?>
                <button onclick="myFunction()" class="btn btn-danger btn-sm">Apagar foto</button>
                <script>
                    function myFunction() {
                      var x;
                      if (confirm("Apagar a foto deste membro ?") == true) {
                          x = "OK! Para apagar foto";
                          window.location.assign("adm/apagarfoto.php?bsc_rol=<?PHP echo $bsc_rol;?>");
                      } else {
                          x = "Cancelar!";
                      }
                    }
                </script>
            <?PHP
                }
            ?>
          </div>
   </div>
	<table class='table table-condensed'>
      <tr>
        <td colspan="2">Nome:
				<?PHP
					$nome = new editar_form("nome",$arr_dad["nome"],$tab,$tab_edit);
					//$_SESSION["membro"]=$arr_dad["nome"];
					echo situacao ($arr_dad["situacao_espiritual"]);//Mostra o estado do membro: se Em comunh�o, disciplinado, falecido...
					$nome->getMostrar();
		      $nome->getEditar('','',$bsc_rol);#<!-- Mostra form para nome -->
				?>
			</td>
		<td rowspan="3" class="text-center"><?PHP
					//echo " - Idade: ";
			$mes = date ('m') - date('m',$arr_dad["nasc"]);
			$dia = date ('d') - $arr_dad["dia"];
			/*
			 *
			 * Calcular a idade do membro
			 *
			 * */
			$dataAtual = new DateTime('NOW');
			$dataNasc  = new DateTime($arr_dad["nasc"]);
			$diferenca = $dataNasc->diff($dataAtual);
			//print_r($dataNasc);
			//echo '<br/>'.$dataAtual->format('Y-m').' FormatoAtual<br/>';
			if ($diferenca->y>1) {
				echo $diferenca->y.' Anos, ';
			}elseif ($diferenca->y>0){
				echo $diferenca->y.' ano, ';
			}
			if ($diferenca->m>1) {
				echo $diferenca->m.' meses, ';
			}elseif ($diferenca->m>0){
				echo $diferenca->m.' mes, ';
			}
			if ($diferenca->d>1) {
				echo $diferenca->d.' dias<br/>';
			}elseif ($diferenca->d>0) {
				echo $diferenca->d.' dia<br/>';
			}
			//echo $dataNasc->format('Y-m').' FormatoNasc<br/>';
		?><div><?PHP print mostra_foto($bsc_rol);?></div></td>
      </tr>
      <tr>
        <td >Pai:
        <?PHP
		$_GET["rol_pai"]=$arr_dad["rol_pai"];
		$nome = new editar_form("pai",$arr_dad["pai"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
		?></td>
	    <?php
		if ($_GET["campo"]!=="pai")
		{?>
        <td>Rol do Pai:
          <p><?PHP echo $arr_dad["rol_pai"];?></p>		</td>
	<?php } ?>
      </tr>
      <tr>
        <td>M&atilde;e:
        <?PHP
		$_GET["rol_mae"]=$arr_dad["rol_mae"];
		$nome = new editar_form("mae",$arr_dad["mae"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
		?></td>
		<?php
		if ($_GET["campo"]!=="mae")
		{?>
        <td>Rol da M&atilde;e :
          <p><?PHP echo $arr_dad["rol_mae"];?></p>		</td>
		<?php } ?>
      </tr>
	  <tr>
        <td>Sexo:
		<?PHP
			$nome = new editar_form("sexo",$arr_dad["sexo"],$tab,$tab_edit);
			$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
		 ?></td>
        <td>Data Nascimento:
        <?PHP
			$nome = new editar_form("datanasc",$arr_dad["br_datanasc"],$tab,$tab_edit);
			$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
		?></td>
        <td colspan="2">Nacionalidade:
        <?PHP
			$nome = new editar_form("nacionalidade",$arr_dad["nacionalidade"],$tab,$tab_edit);
			$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
		?></td>
      </tr>
      <tr>
        <td colspan="2">Naturalidade:
          <?PHP
		//inicio
		$cidade = new DBRecord ("cidade",$arr_dad["naturalidade"],"id");
		echo $arr_dad["naturalidade"];
		$nome = new editar_form("naturalidade",$cidade->nome(),$tab,$tab_edit);
		$nome->getMostrar();
		if ($_GET["campo"]=="naturalidade"){
		?>
		<form id="form3" name="form3" method="post" action="">
		<input name="escolha" type="hidden" id="escolha" value="<?PHP echo "adm/atualizar_dados.php";?>" />
		<input name="campo" type="hidden" id="campo" value="<?PHP echo $_GET["campo"];?>" />
		<input name="bsc_rol" type="hidden" id="campo" value="<?PHP echo $bsc_rol;?>" />
		<?PHP
			$lst_cid = new sele_cidade("cidade",$arr_dad["uf_nasc"],"coduf","nome","naturalidade");
			$vlr_linha=$lst_cid->ListDados ($ind++,'','autofocus="autofocus"');
		?>
		<input name="tabela" type="hidden" id="tabela" value="<?PHP echo "membro";?>" />
		<input name="Submit" class='btn btn-primary btn-xs' type="submit" id="Submit" value="Alterar..." tabindex="<?PHP echo $ind++;?>" />
        </form>
		<?PHP
		}
		//fim
		?></td>
        <td colspan="2">UF:
        <?PHP
        	$tab_edit='adm/dados_pessoais.php&tabela='.$tabela.'&bsc_rol='.$bsc_rol.'&uf_nasc='.$arr_dad["uf_nasc"].'&campo=';
			$nome = new editar_form("uf_nasc",$arr_dad["uf_nasc"],$tab,$tab_edit);
			$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
		?></td>
      </tr>
      <tr>
        <td colspan="2">Endere&ccedil;o:
		<?PHP
		$nome = new editar_form("endereco",$arr_dad["endereco"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
		?></td>
        <td colspan="2">N&uacute;mero:
        <?PHP
		$nome = new editar_form("numero",$arr_dad["numero"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
		?></td>
      </tr>
      <tr>
        <td>Complementos:
		<?PHP
		$nome = new editar_form("complemento",$arr_dad["complemento"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
		?></td>
        <td>Cidade:
          <?PHP
		//inicio
		$cidade = new DBRecord ("cidade",$arr_dad["cidade"],"id");
		//echo $arr_dad["cidade"];
		$nome = new editar_form("cidade",$cidade->nome(),$tab,$tab_edit);
		$nome->getMostrar();
		if ($_GET["campo"]=="cidade"){
		?>
      <form id="form3" name="form3" method="post" action="">
        <input name="escolha" type="hidden" id="escolha" value="<?PHP echo "adm/atualizar_dados.php";?>" />
        <input name="campo" type="hidden" id="campo" value="<?PHP echo $_GET["campo"];?>" />
				<input name="bsc_rol" type="hidden" id="campo" value="<?PHP echo $bsc_rol;?>" />
    <?PHP
			$lst_cid = new sele_cidade("cidade",$arr_dad["uf_resid"],"coduf","nome","cidade");
			$vlr_linha=$lst_cid->ListDados ($ind++,'','autofocus="autofocus"');
		?>
        <input name="tabela" type="hidden" id="tabela" value="<?PHP echo "membro";?>" />
        <input name="Submit" class='btn btn-primary btn-xs' type="submit" id="Submit" value="Alterar..." tabindex="<?PHP echo $ind++;?>" />
      </form>
    <?PHP
		}
		//fim
		?></td>
		<td colspan="2">Bairro:
          <?PHP
		//inicio
		$bairro = new DBRecord ("bairro",$arr_dad["bairro"],"id");
		echo $bairro->bairro();
		$nome = new editar_form("bairro",$bairro->bairro(),$tab,$tab_edit);
		$nome->getMostrar();
		if ($_GET["campo"]=="bairro"){
		?>
        <form id="form3" name="form3" method="post" action="">
            <input name="escolha" type="hidden" id="escolha" value="<?PHP echo "adm/atualizar_dados.php";?>" />
            <input name="campo" type="hidden" id="campo" value="<?PHP echo $_GET["campo"];?>" />
				<input name="bsc_rol" type="hidden" id="campo" value="<?PHP echo $bsc_rol;?>" />
            <?PHP
			$lst_bairro = new sele_cidade("bairro",$arr_dad["cidade"],"idcidade","bairro","bairro");
			$vlr_bairro=$lst_bairro->ListDados ($ind++,'','autofocus="autofocus"');
		?>
            <input name="tabela" type="hidden" id="tabela" value="<?PHP echo "membro";?>" />
            <input name="Submit" class='btn btn-primary btn-xs' type="submit"
						 id="Submit" value="Alterar..." tabindex="<?PHP echo $ind++;?>" />
          </form>
        <?PHP
		}
		//fim
		?></td>
      </tr>
      <tr>
        <td>UF Resid&ecirc;ncia:
        <?PHP
			$nome = new editar_form("uf_resid",$arr_dad["uf_resid"],$tab,$tab_edit);
			$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
		?></td>
        <td >Celular:
        <?PHP
		$nome = new editar_form("celular",$arr_dad["celular"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
		?></td>
		<td>Telefone:
        <?PHP
		$nome = new editar_form("fone_resid",$arr_dad["fone_resid"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
		?></td>
      </tr>
      <tr>
        <td>CEP:
          <?PHP
		$nome = new editar_form("cep",$arr_dad["cep"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
		?></td>
        <td>Doador de Sangue:
          <?PHP
		$nome = new editar_form("doador",$arr_dad["doador"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
		?></td>
        <td>Tipo de Sangu&iacute;neo:
          <?PHP
		$nome = new editar_form("sangue",$arr_dad["sangue"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
		?></td>
    </tr>
    <tr>
      <td>Email:
				<?PHP
				$nome = new editar_form("email",$arr_dad["email"],$tab,$tab_edit);
				$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
				?></td>
		        <td>Gradua&ccedil;&atilde;o:
				<?PHP
				$nome = new editar_form("graduacao",$arr_dad["graduacao"],$tab,$tab_edit);
				$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
				?>
			</td>
    	<td colspan="2">Escolaridade:
		<?PHP
		$nome = new editar_form("escolaridade",$arr_dad["escolaridade"],$tab,$tab_edit);
		$nome->getMostrar();
		if ($_GET["campo"]=="escolaridade") {
		?>
		<form id="form" name="form" method="post" action="">
		  <label>
		  <select name="escolaridade" size="1" id="escolaridade"
			class='form-control' autofocus="autofocus" tabindex="1">
            <option value=""></option>
            <option value="N&atilde;o Estuda">N&atilde;o Estuda</option>
            <option value="N&atilde;o Sabe Informar!">N&atilde;o Sabe Informar!</option>
            <option value="Alfabetizado">alfabetizado</option>
            <option value="1&ordm; Ano">1&ordm; Ano</option>
            <option value="2&ordm; Ano">2&ordm; Ano</option>
            <option value="3&ordm; Ano">3&ordm; Ano</option>
            <option value="4&ordm; Ano">4&ordm; Ano</option>
            <option value="5&ordm; Ano">5&ordm; Ano</option>
            <option value="6&ordm; Ano">6&ordm; Ano</option>
            <option value="7&ordm; Ano">7&ordm; Ano</option>
            <option value="8&ordm; Ano">8&ordm; Ano</option>
            <option value="9&ordm; Ano">9&ordm; Ano</option>
            <option value="1&ordm; Ano - M&eacute;dio">1&ordm; Ano - M&eacute;dio</option>
            <option value="2&ordm; Ano - M&eacute;dio">2&ordm; &ordm; Ano - M&eacute;dio</option>
            <option value="3&ordm; Ano - M&eacute;dio">3&ordm; Ano - M&eacute;dio</option>
            <option value="Superior Incompleto">Superior Incompleto</option>
            <option value="Superior Completo">Superior Completo</option>
            <option value="Mestrado">Mestrado</option>
            <option value="Doutorado">Doutorado</option>
            <option value="P&oacute;s-Doutorado">P&oacute;s-Doutorado</option>
            <option value="PHD">PHD</option>
          </select>
		  <input name="tabela" type="hidden" id="tabela" value="<?PHP echo $tabela;?>" />
		  <input name="campo" type="hidden" id="campo" value="escolaridade" />
		  <input name="escolha" type="hidden" id="escolha" value="<?PHP echo $tab;?>" />
			<input name="bsc_rol" type="hidden" id="campo" value="<?PHP echo $bsc_rol;?>" />
		  <input type="submit" class='btn btn-primary btn-xs' name="Submit2" value="Alterar" tabindex="<?PHP echo $ind++;?>" />
	      </label>
		</form>
		<?PHP
		}
		?>
			</td>
    </tr>
    <tr>
      <td colspan="4">Pend&ecirc;ncias:
        <p><?PHP
				$nome = new editar_form("obs",$arr_dad["mobs"],$tab,$tab_edit);
				$nome->getMostrar();$nome->getEditar('Pedencias do cadastro','',$bsc_rol);
				?></p>
			</td>
      </tr>
  </table>
</div>
<div class="alert alert-info" role="alert">
<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
Cadastro realizado por: <?php echo $arr_dad['hist'].' em: '.$arr_dad['dt_cadastro']; ?>
</div>
