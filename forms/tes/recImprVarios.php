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
<tr><td colspan="2"><p>Exemplos: 1,2,3->Imprimir recibos 1,2,3 | 1-5->Imprimir 
todos do 1 ao 5 | 8 - ->apartir do cinco em diante</p><p>Obs.:As sequências não devem ultrapassar 200 recibos</p>
</td>
	<td><input type="submit" class="btn btn-primary" name="Submit" value="Imprimir..." tabindex="<?PHP echo ++$ind; ?>"/></td>
</tr>
</tbody>
</table>
<label></label>
<input type="hidden" name="rec" value="20">
</form>
</fieldset>