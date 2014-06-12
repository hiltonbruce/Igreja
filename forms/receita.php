<fieldset>
<legend>Lan&ccedil;ar D&iacute;zimos</legend>
<form id="form1" name="form1" method="post" action="">
	<label>Nome</label>
	<input type="text" name="nome" size="40" tabindex="<?PHP echo ++$ind;?>" />			
	Rol:
	<input name="rol_d" type="text" value="0" size="10"  tabindex="<?PHP echo ++$ind;?>" />
	<a href="javascript:lancarSubmenu('campo=nome&rol=rol_d&form=0')"><img border="0" src="img/lupa_32x32.png" width="18" height="18" title="Click aqui para pesquisar membros!" />Localizar Dizimista</a>
								
	<label>Valor</label>
	<input name="valor" type="text" id="valor" tabindex="<?PHP echo ++$ind; ?>"/>
	<label>Data</label>
	<input name="data" type="text" id="data" tabindex="<?PHP echo ++$ind; ?> "maxlength="10" /> Em branco para hoje!
	<label></label>
	<input type="submit" name="Submit" value="Lançar..." tabindex="<?PHP echo ++$ind; ?>"/>
  <input name="escolha" type="hidden" value="tesouraria/receita.php" />
</form>
</fieldset>


