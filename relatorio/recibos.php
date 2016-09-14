<?php
 require_once("func.php");
 $ind = 1;
	switch ($_GET[tipo]) {
		case "1":
			$tipo = "Cart&atilde;es de Membro";
			$rol = "Rol dos Cart&otilde;es: ";
			$dica1 = "Para v&aacute;rios cart&otilde;es separe com v&iacute;rgula &quot;,&quot;";
			break;
		case "2":
			$tipo = "Cartid&otilde;es de Apresenta&ccedil;&atilde;o";
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
  <div class="row">
  <div class="col-xs-4">
<label>Tipo de Recibo:</label>
<select name="rec_tipo" onChange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo $ind++;?>" class="form-control">
	<option value="" ><?PHP echo $tipo;?></option>
	<option value="./?escolha=relatorio/recibos.php&amp;menu=top_formulario&amp;tipo=1">Cart&atilde;o de Membro</option>
	<option value="./?escolha=relatorio/recibos.php&amp;menu=top_formulario&amp;tipo=2">Certid&atilde;o de Apresenta&ccedil;&atilde;o</option>
</select>
     </div>
     </div>
  <?PHP

  if (isset($_GET["tipo"])) {
  ?>
  <label><?PHP echo $rol;?></label>
  <input name="rols" type="text" id="rols" tabindex="<?PHP echo $ind++;?>"
     class="form-control" value="<?PHP echo $_GET["rols"];?>">
  <input name="tipo" type="hidden" value="<?PHP echo $tipo;?>" />
  <?PHP echo $dica1;?><label>Observa&ccedil;&otilde;es:</label>
   <textarea class="text_area form-control" name="obs" cols="25" wrap=physical id="obs"
   tabindex="<?PHP echo $ind++;?>" onKeyDown="textCounter(this.form.obs,this.form.remLen,255);"
   onKeyUp="textCounter(this.form.obs,this.form.remLen,255);progreso_tecla(this,255);"  ></textarea>
   <div id="progreso"></div>
  <div class="form-horizontal">
     <div class="form-group">
      <label class="col-sm-4 control-label" for="formGroupInputLarge"><h5>(Max. 255 Carateres)</h5></label>
     <div class="col-sm-2">
      <input readonly type=text name=remLen class="form-control" value="255">
     </div>
     <div class="form-group">
      <label class="col-sm-3 control-label" for="formGroupInputLarge"><h5>Caracteres restantes</h5></label>
     </div>
     </div>
   </div>
  <div class="row">
  <div class="col-xs-2">
  <label>Recebido por: (Rol) </label>
  <input name="resp_recebeu" type="text" id="resp_recebeu"
     class="form-control" tabindex="<?PHP echo $ind++;?>" >
   </div>
  <div class="col-xs-2"><br />
    <input type="submit" class="btn btn-primary" name="Submit" value="Emitir..." tabindex="<?PHP echo $ind++;?>" >
    <?PHP } ?>
   </div>
   </div>
</form>
</fieldset>
