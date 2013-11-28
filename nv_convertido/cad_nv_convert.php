<?php

if (empty($_SESSION['valid_user']))
header("Location: ../");

unset($_SESSION["nacao"]);//Limpa estas variáveis
unset($_SESSION["cid_natal"]);
unset($_SESSION["cid_end"]);
unset($_SESSION["cpf"]);
?>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>

<fieldset>
<legend>Livro de Novos Convertidos </legend>
<form method="post" action="">
	  <table width="345">
        <tr>
          <td width="180"><label>Nacionalidade:</label>
            <input name="nacionalidade" type="text" id="nacionalidade" value="Brasileira" size="20" onselect="1" tabindex="<?PHP echo ++$ind;?>" />
            <label></label></td>
          <td width="153"><label>Estado: </label>
            <select name="uf" id="uf" onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind;?>" >
              <option value="<?PHP echo $_GET['uf'];?>"><?PHP echo $_GET['uf'];?></option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=AC'>Acre</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=AL'>Alagoas</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=AP'>Amapá</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=AM'>Amazonas</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=BA'>Bahia</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=CE'>Ceará</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=DF'>Distrito Federal</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=GO'>Goiás</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=MA'>Maranhão</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=MT'>Mato Grosso</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=MS'>Mato Grosso do Sul</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=MG'>Minas Gerais</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=PA'>Pará</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=PB'>Paraíba</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=PR'>Paraná</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=PE'>Pernambuco</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=PI'>Piauí</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=RJ'>Rio de Janeiro</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=RN'>Rio Grande do Norte</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=RS'>Rio Grande do Sul</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=RO'>Rondônia</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=RR'>Roraima</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=SC'>Santa Catarina</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=SP'>São Paulo</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=SE'>Sergipe</option>
              <option value='./?escolha=nv_convertido/cad_nv_convert.php&uf=TO'>Tocantins</option>
            </select></td>
        </tr>
        <tr>
          <td colspan="2"><?PHP
		if (!empty($_GET["uf"])){
		$vl_uf=$_GET["uf"];
		$lst_cid = new sele_cidade("cidade","$vl_uf","coduf","nome","cidade");
		echo "<label>Cidade:</label>";		
		$vlr_linha=$lst_cid->ListDados (++$ind);//3 é o indice do formulário
		}
		?></td>
        </tr>
        <tr>
          <td><label>Nome:
              <input name="nome" type="text" id="nome" tabindex="<?PHP echo ++$ind;?>" size="30" />
          </label></td>
          <td><label>Sexo:
            <select name="sexo" id="sexo" tabindex="<?PHP echo ++$ind;?>">
              <option value="M">Masculino</option>
              <option value="F">Femino</option>
            </select></label></td>
        </tr>
        <tr>
          <td><label>Endere&ccedil;o:
            <input name="endereco" type="text" id="endereco" tabindex="<?PHP echo ++$ind;?>" size="30" />
          </label></td>
          <td><label>Número:
              <input name="numero" type="text" id="numero" size="5" tabindex="<?PHP echo ++$ind;?>" />
          </label>
            <label></label></td>
        </tr>
        <tr>
          <td><label>Bairro:
          <input name="bairro" type="text" id="bairro" size="30" tabindex="<?PHP echo ++$ind;?>" />
          </label></td>
          <td><label>Telefone
              <input name="fone" type="text" id="fone" tabindex="<?PHP echo ++$ind;?>" onkeypress="formatar('##-####-####', this);" maxlength="12" />
          </label>
            <label></label></td>
        </tr>
        <tr>
          <td><label>Celular:
              <input name="celular" type="text" id="celular" tabindex="<?PHP echo ++$ind;?>"  onkeypress="formatar('##-####-####', this);" maxlength="12" />
          </label></td>
          <td>Data de Nascimeto:<label>
              <input name="dt_nasc" type="text" id="dt_nasc" tabindex="<?PHP echo ++$ind;?>" onkeypress="formatar('##/##/####', this);" maxlength="10" />
          </label></td>
        </tr>
        <tr>
          <td>Encaminhar a Congrega&ccedil;&atilde;o:
            <label>
            <?PHP
			$congr = new List_sele ("igreja","razao","congregacao");
			$congr->List_Selec (++$ind);
			?>
          </label></td>
          <td>Aceitou em (data):<label>
              <input name="dt_aceitou" type="text" id="dt_aceitou" tabindex="<?PHP echo ++$ind;?>" onkeypress="formatar('##/##/####', this);" maxlength="10" />
          </label></td>
        </tr>
        <tr>
          <td colspan="2">Observa&ccedil;&atilde;o:
			   <textarea name="obs" cols="60" wrap=physical id="obs" tabindex="<?PHP echo $ind++;?>" onKeyDown="textCounter(this.form.obs,this.form.remLen,500);" onKeyUp="textCounter(this.form.obs,this.form.remLen,500);progreso_tecla(this,500);"  ></textarea>
			   <div id="progreso"></div>
			   (Max. 500 Carateres)
			  <input readonly type=text name=remLen size=3 maxlength=3 value="500"> 
			Caracteres restantes
		  </td>
        </tr>
      </table>
	  <label>
	    <input type="submit" name="Submit" value="Salvar" tabindex="<?PHP echo $ind++;?>">
  </label>
	  <input name="escolha" type="hidden" value="adm/cad_dados_pess.php" />
	  <input name="tabela" type="hidden" id="tabela" value="nv_convert" />
</form>
</fieldset>