<?php
controle ("inserir");
$ver_comunh = new DBRecord ("eclesiastico",$_POST["rol"],"rol");
	//chama o formulrio para o cadastro do responsvel
?>

<div id="lst_cad">
<fieldset>
<legend> Cadastro de Unidade Org&acirc;nica </legend>
<form method="get" action="">
  <div id="lst_cad">
		<label>Sigla/Abreviatura
		<input name="abrev" type="text" id="abrev" size="30" maxlength="50" tabindex="<?PHP echo ++$ind;?>" />(Max. 30 Carateres)		</label>
	  Nome Completo:
		<input name="descricao" type="text" id="descricao" tabindex="<?PHP echo ++$ind;?>" onKeyDown="textCounter(this.form.descricao,this.form.remLen,200);" onKeyUp="textCounter(this.form.descricao,this.form.remLen,200);progreso_tecla(this,200);" value="" size="66" />
	   <div id="progreso"></div>
	  (Max. 150 Carateres)
      <input readonly type=text name=remLen size=3 maxlength=3 value="200"> 
	Caracteres restantes
	   
	<label><p>Subordinado &agrave;:</p>
	  <?PHP
		$organica = new DBRecord ("organica",'1',"id");	
		$ind = $organica -> cad_organica($ind);
	?>
	  </label>
	  <p>&Aacute;rea de Atua&ccedil;&atilde;o:</p>
	  	<?PHP
			$hierarquia = new List_sele ('organica','alias','area_atual');
			$hierarquia -> List_area_atua($ind);
		?>
	  
	  <label>
        <input type="submit" name="Submit" value="Cadastrar..." tabindex="<?PHP echo ++$ind?>" />
	</label>
  </div>
	<input name="escolha" type="hidden" value="adm/cad_dados_pess.php" />
	<input name="menu" type="hidden" id="menu" value="top_igreja" />
	<input name="tabela" type="hidden" value="organica" />
</form>
</fieldset>
</div>