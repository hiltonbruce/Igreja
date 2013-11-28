<?php 
	$ind=1;
	$igreja = ($_GET['rol']!='') ? $_GET['rol']:'1';
?>
<fieldset>
<legend>Lan&ccedil;ar Ofertas</legend>
<form id="form1" name="form1" method="post" action="">
<label>Igreja:</label>
<?php 
	$lisigreja = new List_Igreja('igreja');
	$lisigreja -> igreja_pop(++$ind, $igreja);
?>
<table style="border : 0; background-color: transparent;;">
	<tbody>
		<tr>
			<td colspan="2">						
				<label>Nome do Ofertante:</label>
				<input name="nomeoferta" type="text" id="nomeoferta" size="45" tabindex="<?PHP echo ++$ind; ?>"/>
				Rol:<input name="roloferta" type="text" id="roloferta" size="5" tabindex="<?PHP echo ++$ind; ?>"/>	
				</td>
				<td>					
				<label>Valor da Oferta(R$)</label>
				<input name="oferta" type="text" id="oferta" tabindex="<?PHP echo ++$ind; ?>"/>
			</td>
		</tr>
		<tr>
			<td colspan="2">						
				<label>Nome do Ofertante Extra</label>
				<input name="nomeext" type="text" id="nomeext" size="45"  tabindex="<?PHP echo ++$ind; ?>"/>
				Rol:<input name="rolext" type="text" id="rolext" size="5" tabindex="<?PHP echo ++$ind; ?>"/></td><td>					
				<label>Valor da Oferta Extra(R$)</label>
				<input name="ofertaext" type="text" id="ofertaext" tabindex="<?PHP echo ++$ind; ?>"/>
			</td>
		</tr>
		<tr>
			<td>
				<label>Data</label>
				<input name="data" type="text" id="data" OnKeyPress="formatar('##/##/####', this);" tabindex="<?PHP echo ++$ind; ?> "maxlength="10" value="<?php echo date('d/m/Y');?>" /> </td>
				<td>
				<input type="hidden" name="tipo" id="tipo" value="2">
				<input type="submit" name="Submit" value="Lançar..." tabindex="<?PHP echo ++$ind; ?>"/>
			  	<input name="escolha" type="hidden" value="models/dizoferta.php" />
			 </td>
		</tr>
	</tbody>
</table>
</form>
</fieldset>
