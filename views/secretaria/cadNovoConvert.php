<?php
if (empty($_SESSION['valid_user']))
header("Location: ../");
$uf_end = (empty($_GET['uf'])) ? 'PB' : $_GET['uf'] ;
?>
<fieldset>
<legend>Cadastro de Novos Convertidos </legend>
<form method="post" action="">
	  <table class='table'>
        <tr>
          <td colspan="2">
						<div class="form-group has-error">
						<label class="control-label" >Nome:</label>
              <input name="nome" type="text" id="nome" tabindex="<?PHP echo ++$ind;?>"
               class="form-control" autofocus='autofocus' placeholder='Campo obrigat&oacute;rio!'
							 required='required'/>
						</div>
          </td>
          <td><div class="form-group has-error">
							<label class="control-label">Congrega&ccedil;&atilde;o:</label>
              <?PHP
          			$congr = new List_sele ("igreja","razao","congregacao");
          			echo $congr->List_Selec (++$ind,'',' class="form-control"');
          		?>
						</div>
          </td>
        </tr>
        <tr>
					<td><label>Candidato ao Bastismo de:</label>
							<input name="batismo" type="text" tabindex="<?PHP echo ++$ind;?>"
							 class="form-control dataclass"  />
					</td>
          <td><label>Sexo:</label>
            <select name="sexo" id="sexo" tabindex="<?PHP echo ++$ind;?>" class="form-control" >
              <option value="M">Masculino</option>
              <option value="F">Femino</option>
          </td>
          <td><label>Data de Nascimeto:</label>
              <input name="dt_nasc" type="text" id="data" tabindex="<?PHP echo ++$ind;?>"
               class="form-control" />
          </td>
        </tr>
        <tr>
          <td><label>UF:</label>
          <select name="uf_end" class="form-control" id="uf_end"
           onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>" >
          <?PHP
            if (empty($_GET['uf'])) {
              echo '<option>Estado Natal</option>';
            }
            $estnatal = new List_UF('estado', 'nome','uf_end');
            echo $estnatal->List_Selec_pop($linkLancamento.'&sec=1&uf=',$uf_end);
          ?>
          </select>
    			</td>
          <td ><?PHP
          		if (!empty($_GET["uf"])){
          		$vl_uf=$_GET["uf"];
          		$lst_cid = new sele_cidade("cidade","$vl_uf","coduf","nome","cidade");
          		echo "<label>Cidade:</label>";
          		$vlr_linha=$lst_cid->ListDados (++$ind);//3 é o indice do formulário
          		}
          		?>
         </td>
          <td><label>Nacionalidade:</label>
            <input name="nacionalidade" type="text" value="Brasileira" class="form-control"
            tabindex="<?PHP echo ++$ind;?>" />
          </td>
        </tr>
        <tr>
          <td colspan="2"><label>Endere&ccedil;o:</label>
            <input name="endereco" type="text" id="endereco" tabindex="<?PHP echo ++$ind;?>"
             class="form-control" />
          </td>
          <td><label>N&uacute;mero:</label>
              <input name="numero" type="text" id="numero" tabindex="<?PHP echo ++$ind;?>"
               class="form-control" />
          </td>
        </tr>
        <tr>
          <td><label>Bairro:
          <input name="bairro" type="text" id="bairro" tabindex="<?PHP echo ++$ind;?>"
           class="form-control" />
          </label></td>
          <td><label>Telefone</label>
              <input name="fone" type="text" id="fone" tabindex="<?PHP echo ++$ind;?>"
               class="form-control"  />
          </td>
          <td><label>Celular:
              <input name="celular" type="text" id="celular" tabindex="<?PHP echo ++$ind;?>"
               class="form-control"  />
          </label>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label>Observa&ccedil;&atilde;o:</label>
			   <textarea name="obs" cols="60" wrap=physical id="obs" tabindex="<?PHP echo $ind++;?>"
         onKeyDown="textCounter(this.form.obs,this.form.remLen,500);"
         onKeyUp="textCounter(this.form.obs,this.form.remLen,500);progreso_tecla(this,500);"
          class="form-control" ></textarea>
			   <div id="progreso"></div>
			   (Max. 500 Carateres)
			  <input readonly type=text name=remLen size=3 maxlength=3 value="500" class="form-control" >
  			Caracteres restantes
  		  </td>
        <td><label>Aceitou em:</label>
            <input name="dt_aceitou" type="text" tabindex="<?PHP echo ++$ind;?>"
             class="form-control dataclass" />
        </td>
        </tr>
      </table>
	  <label>
	    <input type="submit" name="Submit" value="Salvar" tabindex="<?PHP echo $ind++;?>"
       class='btn btn-primary' >
  </label>
	  <input name="escolha" type="hidden" value="adm/cad_dados_pess.php" />
	  <input name="tabela" type="hidden" id="tabela" value="nv_convert" />
</form>
</fieldset>
