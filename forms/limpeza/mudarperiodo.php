<fieldset>
<legend>Alterar Período</legend>
<form method="get" name='limpeza'>
	<table id="listTable" style="width: 100%;">
		<caption><?php echo $periodo;?></caption>
			<colgroup>
				<col id="item">
				<col id="albumCol"/>
			</colgroup>
		<tbody>
			<tr>
				<td>Mês de Referencia:
					<select name='mes' id='mes' autofocus='autofocus' tabindex="<?PHP echo ++$ind;?>"  >
						<option>Não Alterar</option>
						<option value="02">De: Fev à Mar</option>
						<option value="04">De: Abr à Mai</option>
						<option value="06">De: Jun à Jul</option>
						<option value="08">De: Ago à Set</option>
						<option value="10">De: Out à Nov</option>
						<option value="12">De: Dez à Jan</option>
					</select>
				</td>
				<td>
					<input type="text" name="ano" tabindex="<?PHP echo ++$ind;?>" value="<?php echo date('Y');?>" />
				</td>
				<td>
					<input type="submit"  tabindex="<?PHP echo ++$ind;?>" value="OK!" />
					<input type="hidden"  name="escolha" value="controller/limpeza.php" />
					<input type="hidden"  name="menu" value="top_tesouraria" />
				</td>
			</tr>
		</tbody>
	</table>
</form>
</fieldset>