<?php $ind=1; 
if ($_SESSION["setor"]==2 || $_SESSION["setor"]>50){
?>
<fieldset>
<legend>Emiss&atilde;o de Recibos</legend>
<form id="form1" name="form1" method="post" action="tesouraria/recibo_print.php">
	<label>Fornecedores - CNPJ
	<?php 
		$for_num = new List_sele("fornecedores", "cnpj_cpf", "numero");
		echo $for_num->List_sel($ind);
	?></label>
	<label> ou Fornecedores - por Nome
	<?php 
		$for_num = new List_sele("fornecedores", "razao", "razao");
		echo $for_num->List_sel($ind);
	?></label>		
	<label>Valor</label>
	<input name="valor" type="text" id="valor" tabindex="<?PHP echo ++$ind; ?>" />
	<label>Data</label>
	<input name="data" type="text" id="data" OnKeyPress="formatar('##/##/####', this);" tabindex="<?PHP echo ++$ind; ?> "maxlength="10" /> Em branco para hoje!
	<label> Fonte para pgto:
	<?php 
		$for_num = new List_sele("fontes", "discriminar", "fonte");
		echo $for_num->List_sel($ind);
	?></label>
	<label>Referente a/motivo do recibo</label>
   <textarea class="text_area" name="referente" cols="25" wrap=physical id="referente" tabindex="<?PHP
   echo $ind++;?>" onKeyDown="textCounter(this.form.referente,this.form.remLen,255);" 
   onKeyUp="textCounter(this.form.referente,this.form.remLen,255);progreso_tecla(this,255);" >Auxílio</textarea>
   
   <div id="progreso"></div>
   (Max. 255 Carateres)
  <input readonly type=text name=remLen size=3 maxlength=3 value="255"> 
Caracteres restantes
	<label></label>
	<input type="submit" name="Submit" value="Emitir..." tabindex="<?PHP echo ++$ind; ?>"/>
</form>
</fieldset>
<?php 
} else {
	echo "<script> alert('Sem permissão de acesso! Entre em contato com o Tesoureiro!');location.href='../?escolha=adm/cadastro_membro.php&uf=PB';</script>";
	$_SESSION = array();
	session_destroy();
	header("Location: ./");
}
?>
