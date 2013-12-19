<?php

if (empty($_SESSION['valid_user']))
header("Location: ../");

	$rec = new DBRecord ("cidade",$_SESSION["cid_natal"],"id");
	$nome_cidade = $rec->nome()." - ".$rec->coduf();
		
	if (isset($_POST["cid_end"])) { $id_cid = (int)$_POST["cid_end"];} else { $id_cid = (int)$_GET["cid_end"];}
	
	$rec_end = new DBRecord ("cidade",$id_cid,"id");//Faz a busca do cidade pelo id e traz o nome
	$cid_end = $rec_end->nome()." - ".$rec_end->coduf();
	
	$ind = 1; //Define o �ndece dos campos do formul�rio

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
<legend>Dados Pessoais - Cadastro</legend>
<form method="post" action="" >
  <label>Nome:</label><h3><?PHP echo $_SESSION["nome_cad"];?></h3><hr />
    <input name="nome" type="hidden" id="nome" value="<?PHP echo $_SESSION["nome_cad"];?>" />
    Doador de Sangue?
	<input type='radio' name='doador' value='Sim' tabindex='<?PHP echo $ind++;?>' />Sim
	<input type='radio' name='doador' value='N�o' tabindex='<?PHP echo $ind++;?>' />N&atilde;o
	
	<select name='sangue' size='1' class='AzulMedio' id='sangue' tabindex='<?PHP echo $ind++;?>'>
		<option value=''>Tipo de Sangue</option>
		<option value='A+'>A+</option>
		<option value='A-'>A-</option>
		<option value='B+'>B+</option>
		<option value='B-'>B-</option>
		<option value='AB+'>AB+</option>
		<option value='AB-'>AB-</option>
		<option value='O+'>O+</option>
		<option value='O-'>O-</option>
	</select>
  	
  	<p><label>Endere&ccedil;o:</label>
	<input name="endereco" type="text" id="endereco" size="32" maxlength="40" tabindex="<?PHP echo $ind++;?>">
	N&ordm;
	<input name="numero" type="text" id="numero" size="11" maxlength="5" tabindex="<?PHP echo $ind++;?>">
	</p>
  	<?PHP
		echo "<p>Cidade: $cid_end</p>";
		echo "<p><label><span style='padding-right:120px'>Bairro:</span>Complementos:</label>";
		
		$lst_cid = new sele_cidade("bairro",$id_cid,"idcidade","bairro","bairro");
		
		$vlr_linha=$lst_cid->ListDados ($ind++);
		
		if (isset($id_cid)){
			$_SESSION["cid_end"] = $id_cid;
		}
	?>
	<input name="uf_resid" type="hidden" value="<?PHP echo $rec_end->coduf();?>" />
	<input name="cidade" type="hidden" value="<?PHP echo $rec_end->id();?>" />
	<input name="complemento" type="text" id="complemento" tabindex="<?PHP echo $ind++;?>" />
	
	</p>Bairro n&atilde;o cadastrado... <a href="./?escolha=tab_auxiliar/cadastro_bairro.php&uf=<?PHP echo $rec_end->coduf();?>&cidade=<?PHP echo $rec_end->id();?>">Clique aqui!</a>
	
	<p>Nacionalidade: <?PHP echo $_SESSION["nacao"];?> - Natural de: <?PHP echo $nome_cidade;?>
	<input name="uf_nasc" type="hidden" value="<?PHP echo $rec->coduf();?>" /><p>

	<label><span style="padding-right:100px">Telefone:</span>Celular:</label>
	<input name="fone_resid" type="text" id="fone_resid" OnKeyPress="formatar('## ####-####', this);" value= "83" size="15"  maxlength="12" tabindex="<?PHP echo $ind++;?>">
	<input name="celular" type="text" id="celular" OnKeyPress="formatar('## ####-####', this);"  value= "83" size="20" maxlength="12" tabindex="<?PHP echo $ind++;?>">	
	
	  <label><span style="padding-right:125px">CEP:</span>Escolaridade:</label>
	<input name="cep" type="text" id="cep" size="15" maxlength="11" OnKeyPress="formatar('##.####-###', this);" tabindex="<?PHP echo $ind++;?>">
	<select name="escolaridade" size="1" class="AzulMedio" id="escolaridade" tabindex="<?PHP echo $ind++;?>">
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
    <p><label><span style="padding-right:120px">Gradua&ccedil;&atilde;o:</span><span>Email:</span></label>

    <input name="graduacao" type="text" id="graduacao" tabindex="<?PHP echo $ind++;?>">

	<input name="email" type="text" id="email" size="40" tabindex="<?PHP echo $ind++;?>"/>
  </p>
	<p><label><span style="padding-right:130px">Sexo:</span>Data&nbsp;de&nbsp;Nascimento:</label>
	<select name="sexo" id="sexo" tabindex="<?PHP echo $ind++;?>">
		<option value=""  selected>- Selecionar um(a) -</option>
		<option value="M" >Masculino</option>
		<option value="F" >Feminino</option>
	</select>
		
	<input name="datanasc" type="text" id="datanasc" size="15" maxlength="10"  OnKeyPress="formatar('##/##/####', this);" tabindex="<?PHP echo $ind++;?>">
		(Ex.: 21/01/2008)
	</p>
	<p><label>Pai:</label>
	<input name="pai" type="text" id="pai" size="50" maxlength="40" tabindex="<?PHP echo $ind++;?>">
	Rol:
	<input name="rol_pai" type="text" id="rol_pai" size="5" maxlength="5" tabindex="<?PHP echo $ind++;?>"/>
    <a href="javascript:lancarSubmenu('campo=pai&rol=rol_pai&form=0')" tabindex="<?PHP echo $ind++;?>"><img border="0" src="img/lupa_32x32.png" width="18" height="18" align="absbottom" title="Click aqui para pesquisar membros!" /></a></p>
	<p><label>M&atilde;e:</label>
	<input name="mae" type="text" id="mae" size="50" maxlength="40" tabindex="<?PHP echo $ind++;?>">
	Rol:
	<input name="rol_mae" type="text" id="rol_mae" size="5" maxlength="5" tabindex="<?PHP echo $ind++;?>" />
    <a href="javascript:lancarSubmenu('campo=mae&rol=rol_mae&form=0')" tabindex="<?PHP echo $ind++;?>"><img border="0" src="img/lupa_32x32.png" width="18" height="18" align="absbottom" title="Click aqui para pesquisar membros!" /></a></p>

	<p><label>Observa&ccedil;&atilde;o:</label>
	<textarea name="obs" cols="37" rows="2" id="obs" tabindex="<?PHP echo $ind++;?>"></textarea>
	</p>
	<input type="submit" name="Submit" value="Salvar" tabindex="<?PHP echo $ind++;?>">
	<h5>Obs: A data deve estar no formato: dd/mm/aaaa (00/00/0000).
	O(s) item(ns) com (<font color="#FF0000">*</font>) s&atilde;o de preenchimento obrigat&oacute;rio!
    <input name="tabela" type="hidden" id="tabela" value="membro" />
    <input type="hidden" name="escolha" value="adm/cad_dados_pess.php">
	</h5>
</form>
</fieldset>
