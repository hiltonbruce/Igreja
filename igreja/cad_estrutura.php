<?php
controle ("inserir");
$ver_comunh = new DBRecord ("eclesiastico",$_POST["rol"],"rol");
	//chama o formulrio para o cadastro do responsvel
?>

<div id="lst_cad">
<fieldset>
<legend> Cadastro Unidade Org&acirc;nica </legend>
<form method="post" action="">
  <div id="lst_cad">
	<label>Descri&ccedil;&atilde;o:</label>
		<input name="descricao" type="text" id="descricao" tabindex="<?PHP echo ++$ind;?>" onKeyDown="textCounter(this.form.descricao,this.form.remLen,150);" onKeyUp="textCounter(this.form.descricao,this.form.remLen,150);progreso_tecla(this,150);" value="" size="65" />

	   <div id="progreso"></div>
	  (Max. 150 Carateres)
      <input readonly type=text name=remLen size=3 maxlength=3 value="150"> 
	Caracteres restantes
	   
	<label>Subordinado &agrave;:
	<?PHP
		$hierarquia = new List_sele ('organica','descricao','subordinado');
		$hierarquia -> List_sel (); 
	?>
	</label>
	   
	<label>
        <input type="submit" name="Submit" value="Cadastrar..." tabindex="<?PHP echo $ind++;?>" />
	</label>
	Obs.: N&atilde;o deve conter o da congrega&ccedil;&atilde;o. </div>
	<input name="escolha" type="hidden" value="adm/cad_dados_pess.php" />
	<input name="menu" type="hidden" id="menu" value="top_igreja" />
	<input name="tabela" type="hidden" value="cargos" />
</form>
</fieldset>
</div>