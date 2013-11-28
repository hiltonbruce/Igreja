<?php
 require_once("func.php"); 
 $ind = 1;
	switch ($_GET[tipo]) {
		case "1":
			$tipo = "Cartões de Membro";
			$rol = "Rol dos Cart&otilde;es: ";
			$dica1 = "Para v&aacute;rios cart&otilde;es separe com v&iacute;rgula &quot;,&quot;";
			break;
		case "2":
			$tipo = "Cartidões de Apresentação";
			$rol = "Rol dos Pais: ";
			$dica1 = "Indique o Rol dos Pais separados por v&iacute;rgula &quot;,&quot;";
			break;		
		default:
			break;
	}
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
<legend><?PHP echo leg_recibos ($_GET[tipo]); ?></legend>
<form action="<?PHP echo AcaoFormRecibo ($_GET["tipo"]);?>" method="post" name="form1">
<label>Tipo de Recibo:</label>
<select name="rec_tipo" onChange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo $ind++;?>">
	<option value="" ><?PHP echo $tipo;?></option>
	<option value="./?escolha=relatorio/recibos.php&amp;menu=top_formulario&amp;tipo=1">Cart&atilde;o de Membro</option>
	<option value="./?escolha=relatorio/recibos.php&amp;menu=top_formulario&amp;tipo=2">Certid&atilde;o de Apresenta&ccedil;&atilde;o</option>
</select>
  <?PHP 

  if (isset($_GET["tipo"])) { 
  ?>
  <label><?PHP echo $rol;?></label>
  <input name="rols" type="text" id="rols" tabindex="<?PHP echo $ind++;?>" size="22" value="<?PHP echo $_GET["rols"];?>">
  <input name="tipo" type="hidden" value="<?PHP echo $tipo;?>" />
  <?PHP echo $dica1;?><label>Observa&ccedil;&otilde;es:</label>
   <textarea class="text_area" name="obs" cols="25" wrap=physical id="obs" tabindex="<?PHP echo $ind++;?>" onKeyDown="textCounter(this.form.obs,this.form.remLen,255);" onKeyUp="textCounter(this.form.obs,this.form.remLen,255);progreso_tecla(this,255);"  ></textarea>
   
   <div id="progreso"></div>
   (Max. 255 Carateres)
  <input readonly type=text name=remLen size=3 maxlength=3 value="255"> 
Caracteres restantes
  <label>Recebido por:</label>
  <input name="resp_recebeu" type="text" id="resp_recebeu" tabindex="<?PHP echo $ind++;?>" value="" size="22" >
  (Rol)
  <input type="submit" name="Submit" value="Emitir..." tabindex="<?PHP echo $ind++;?>" >
  
  <?PHP } ?>

</form>
</fieldset>
