<div id="lst_cad">
	<table class='table'>
      <tr>
        <td colspan="2">C&ocirc;njuge:
		<?PHP
		$_GET["rol_conjugue"]=$arr_dad["rol_conjugue"];
		$nome = new editar_form("conjugue",$arr_dad["conjugue"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
		?></td>
		<?php
		if ($_GET["campo"]!=="conjugue")
		{?>
			<td>Rol do C&ocirc;njuge:
			<?PHP
				$nome = new editar_form("rol_conjugue",$arr_dad["rol_conjugue"],$tab,$tab_edit);
				$nome->getMostrar();
			?></td>
		<?php
		} ?>
      </tr>
      <tr>
        <td>Estado Civil:
		<?PHP
		$nome = new editar_form("estado_civil",$arr_dad["estado_civil"],$tab,$tab_edit);
		$nome->getMostrar();
		if ($_GET["campo"]=="estado_civil") {
		?>
		<form id="form1" name="form1" method="post" action="">
        <div class="row">
            <div class="col-xs-4">
							<select name="estado_civil" id="estado_civil" class="form-control" tabindex="<?PHP echo $ind++;?>">
              <option value="<?PHP echo $arr_dad["estado_civil"];?>"><?PHP echo $arr_dad["estado_civil"];?></option>
		  	<?PHP
		//	$membro = new DBRecord ("membro",$bsc_rol,"rol");
			if ((strtoupper($membro->sexo()))=="M") {
			?>
        <option value="Solteiro">Solteiro</option>
        <option value="Casado">Casado</option>
        <option value="Vi�vo">Vi&uacute;vo</option>
        <option value="Divorciado">Divorciado</option>
			<?PHP
			}else {
			?>
        <option value="Solteira">Solteira</option>
        <option value="Casada">Casada</option>
        <option value="Vi�va">Vi&uacute;va</option>
        <option value="Divorciada">Divorciada</option>
			<?PHP } ?>
        <option value="Outros">Outros</option>
		  </select>
      </div>
        <div class="col-xs-2">
    			<input type="submit" class="btn btn-primary" name="Submit" value="Alterar..." />
    			<input name="escolha" type="hidden" value="adm/atualizar_dados.php" />
    			<input name="tabela" type="hidden" value="est_civil" />
    			<input name="bsc_rol" type="hidden" id="campo" value="<?PHP echo $bsc_rol;?>" />
          <input name="campo" type="hidden" id="campo" value="estado_civil" />
      </div>
    </div>
		</form>
		<?PHP } /*Fim do if ($_GET["campo"]="estado_civil" */ ?>
		</td>
      <td colspan="2">Certid&atilde;o N&ordm;
      <?PHP
		$nome = new editar_form("certidao_casamento_n",$arr_dad["certidao_casamento_n"],$tab,$tab_edit);
		$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
		?></td>
      </tr>
      <tr>
        <td>Data:
        <?PHP
    		$nome = new editar_form("data",$arr_dad["data"],$tab,$tab_edit);
    		$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
    		?>
        </td>
        <td>Livro:
        <?PHP
    		$nome = new editar_form("livro",$arr_dad["livro"],$tab,$tab_edit);
    		$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
    		?>
        </td>
		    <td>Folhas:
        <?PHP
    		$nome = new editar_form("folhas",$arr_dad["folhas"],$tab,$tab_edit);
    		$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
    		?>
        </td>
      </tr>
      <tr>
        <td colspan="3">Observa&ccedil;&otilde;es:
    		<?PHP
    		$nome = new editar_form("obs",$arr_dad["obs"],$tab,$tab_edit);
    		$nome->getMostrar();$nome->getEditar('','',$bsc_rol);
    		?>
        </td>
      </tr>
    </table>
</div>
<div class="alert alert-info" role="alert">
<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
Cadastro realizado por: <?php echo $arr_dad['hist'].' em: '.$arr_dad['dt_cadastro']; ?>
</div>
