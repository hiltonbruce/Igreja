<fieldset>
<legend>Impress&atilde;o de Recibos</legend>
<form id="form1" name="form1" method="post" action="controller/recibo.php" target="_blank">
<table>
	<tbody>
	<tr>
	<td colspan="3"><label>N&uacute;mero, sequ&ecirc;ncia ou faixa de recibos</label> <input
		type="text" name="numeros" class="form-control" autofocus="autofocus"
		tabindex="<?PHP echo $ind++;?>" required="required"
		value="<?php echo $_GET["nome"];?>" /></td>
</tr>
<tr>
	<td>
		<label>Imprimir Envelope</label>
		<input type="checkbox" name="envelope" value="1"> Marque p/ imprimir apenas os envelopes
	</td>
	<td></td>
</tr>
<tr><td><label>Grupo p/ Observa&ccedil;&atilde;o: </label> <select name="grupo" id="grupo"
			tabindex="<?PHP echo ++$ind; ?>" class="form-control" autofocus="autofocus">
						<option></option>
						<option value="485">Minist&eacute;rio</option>
						<option value="143">Tesoureiros</option>
						<option value="103">Aux&iacute;lio</option>
						<option value="88">Zelador</option>
						<option value="180">Todos</option>
				</select>
				</td>
	<td colspan="2">
		<label>Obs. p/ os envolpes</label>
		<textarea rows="3" name="obs" cols="100"></textarea>
	</td>
</tr>
<tr>
<td colspan="2"><p>Exemplos: 1,2,3->Imprimir recibos 1,2,3 | 1-5->Imprimir
todos do 1 ao 5 | 8 - ->apartir do cinco em diante</p><p>Obs.:As sequ&ecirc;ncias n&atilde;o devem ultrapassar 200 recibos</p>
</td>
	<td><input type="submit" class="btn btn-primary" name="Submit" value="Imprimir..." tabindex="<?PHP echo ++$ind; ?>"/></td>
</tr>
</tbody>
</table>
<label></label>
<input type="hidden" name="rec" value="21">
</form>
</fieldset>
