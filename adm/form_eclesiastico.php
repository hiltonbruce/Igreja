<?php

if (empty($_SESSION['valid_user']))
header("Location: ../");


if (isset($_POST["nacionalidade"])){

	$_SESSION["nacao"] = $_POST["nacionalidade"];
	$_SESSION["cid_natal"] = $_POST["cid_nasc"];
	$_SESSION["cpf"] = $_POST["cpf"];

	if (validaCPF($_POST["cpf"]) xor (empty($_GET["conf_cpf_ruim"]))){
			echo "<script>pergunta();</script>";
			echo "CPF inválido";
		}

}
	$rec = new DBRecord ("cidade",$_SESSION["cid_natal"],"id");// Aqui será selecionado a informação do campo autor com id=2
	$nome_cidade = $rec->nome()." - ".$rec->coduf();
?>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<div id="lst_cad">
<fieldset>
<legend>Dados Eclesi&aacute;sticos - Cadastro de Membro</legend>
<form method="post" action="">
	<label>UF de Batismo :</label>
	   	<select name="uf_nasc" id="uf_nasc" onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>" >
	  <?PHP
			$estnatal = new List_UF('estado', 'nome','uf_end');
			echo $estnatal->List_Selec_pop('escolha=adm/form_eclesiastico.php&bsc_rol='.$_SESSION["rol"].'&uf_end=',$_GET['uf_end']);
		?>
	  </select>
	  
	<input name="uf" type="hidden" id="uf" value="<?PHP echo $_GET['uf_end'];?>" />
	<?PHP
		if (!empty($_GET["uf_end"])){
	?>
	<div id="lst_cad">
	<table width="544" border="0">
      <tr>
        <td width="246"><?PHP
		$vl_uf=$_GET["uf_end"];
		$lst_cid = new sele_cidade("cidade","$vl_uf","coduf","nome","local_batismo");
		echo "<label>Cidade de Batismo</label>";
		$vlr_linha=$lst_cid->ListDados (++$ind);//"2" é o indice de tabulação do formulário
		?></td>
        <td width="288">Onde congrega:<label>
		<?PHP
			$congr = new List_sele ("igreja","razao","congregacao");
			echo $congr->List_Selec (++$ind,$_SESSION['igreja']);
		?>
</label></td>
      </tr>
      <tr>
        <td>Situação espiritual:<label>
          <select name="situacao_espiritual" tabindex="<?PHP echo ++$ind;?>">
            <option value="1">Em comunh&atilde;o</option>
            <option value="2">Disciplinado</option>
          </select></label>		  </td>
        <td>Data Batismo Águas:
          <label>
          <input name="batismo_em_aguas" type="text" id="batismo" tabindex="<?PHP echo ++$ind;?>" value="<?php echo $_SESSION['dtbatismo'];?>" maxlength="10" onkeypress="formatar('##/##/####', this);" />
          </label></td>
      </tr>

      <tr>
        <td>Ano Batismo Espirito Santo:
          <label>
          <input name="batismo_espirito_santo" type="text" id="batismo_espirito_santo" tabindex="<?PHP echo ++$ind;?>" maxlength="6" />
          </label></td>
        <td>Denominação que veio:
          <label>
          <input name="veio_qual_denominacao" type="text" id="veio_qual_denominacao" tabindex="<?PHP echo ++$ind;?>" />
          </label></td>
      </tr>
      <tr>
        <td>Mudou da denomina&ccedil;&atilde;o em:<label>
            <input name="dt_mudanca_denominacao" type="text" id="dt_mudanca_denominacao" maxlength="10" tabindex="<?PHP echo ++$ind;?>" onkeypress="formatar('##/##/####', this);" />
</label></td>
        <td>Auxiliar de trabalho em:<label>
            <input name="auxiliar" type="text" id="auxiliar" tabindex="<?PHP echo ++$ind;?>" maxlength="10" onkeypress="formatar('##/##/####', this);" />
</label></td>
      </tr>
      <tr>
        <td>Diácono em:<label>
            <input name="diaconato" type="text" id="diaconato" tabindex="<?PHP echo ++$ind;?>" maxlength="10" onkeypress="formatar('##/##/####', this);" />
</label></td>
        <td><label>Presbitéro em:
            <input name="presbitero" type="text" id="presbitero" tabindex="<?PHP echo ++$ind;?>" maxlength="10" onkeypress="formatar('##/##/####', this);" />
</label></td>
      </tr>
      <tr>
        <td>Evangelista em:<label>
            <input name="evangelista" type="text" id="evangelista" tabindex="<?PHP echo ++$ind;?>" maxlength="10" onkeypress="formatar('##/##/####', this);" />
</label></td>
        <td>Pastor em:<label>
            <input name="pastor" type="text" id="pastor" tabindex="<?PHP echo ++$ind;?>" maxlength="10" onkeypress="formatar('##/##/####', this);" />
</label></td>
      </tr>
      <tr>
        <td>Veio de outra Assembleia de Deus:<label>
            <input name="veio_outra_assemb_deus" type="text" id="veio_outra_assemb_deus" tabindex="<?PHP echo ++$ind;?>" />
</label></td>
        <td>Data da mudança da outra Assembleia:<label>
            <input name="dt_muda_assembleia" type="text" id="dt_muda_assembleia" tabindex="<?PHP echo ++$ind;?>" maxlength="10" onkeypress="formatar('##/##/####', this);" />
</label></td>
      </tr>
      <tr>
        <td>Cidade e UF de onde veio:<label>
            <input name="lugar" type="text" id="lugar" tabindex="<?PHP echo ++$ind;?>" />
</label></td>
        <td>
          Data da mudança:<label>
          <input name="dt_mudanca" type="text" id="dt_mudanca" maxlength="10" onkeypress="formatar('##/##/####', this);" tabindex="<?PHP echo ++$ind;?>" />
          </label></td>
      </tr>
      <tr>
        <td>Cartão Impresso em:<label>
            <input name="c_impresso" type="text" id="c_impresso" tabindex="<?PHP echo ++$ind;?>" />
        </label></td>
        <td>Cartão Entregue em:<label>
            <input name="c_entregue" type="text" id="c_entregue" tabindex="<?PHP echo ++$ind;?>" maxlength="10" OnKeyPress="formatar('##/##/####', this);" />
        </label></td>
      </tr>
      <tr>
        <td>Data da aclamação:<label>
            <input name="dat_aclam" type="text" id="dat" value="<?php echo $_SESSION['dtaclam'];?>" tabindex="<?PHP echo ++$ind;?>" maxlength="10" onkeypress="formatar('##/##/####', this);" />
</label></td>
        <td>
      </tr>
      <tr>
	<td colspan="2">
	<label>Observa&ccedil;&otilde;es:</label>
        <textarea name="obs" id="obs" tabindex="<?PHP echo ++$ind;?>" cols='50' /></textarea><br /><input type="submit" name="Submit" value="Cadastrar..." tabindex="<?PHP echo ++$ind;?>" /></td>
      </tr>
    </table>
	</div>
	<?PHP } ?>
	<input name="escolha" type="hidden" value="adm/cad_dados_pess.php" />
	<input name="tabela" type="hidden" id="tabela" value="eclesiastico" />
</form>
</fieldset>
</div>