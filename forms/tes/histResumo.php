<fieldset>
	<legend>Lançamentos por Congrega&ccedil;&atilde;o</legend>
	<form method="get" name="" action="">
	<table>
		<tbody>
			<tr>
				<td colspan="3">
					Por Congrega&ccedil;&atilde;o:<br/> 
					<?php
					$bsccredor = new List_sele('igreja', 'razao', 'igreja');
					$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],' autofocus="autofocus" ');
					echo $listaIgreja;
					?>				
				</td><td>
					<input type="hidden" name="fin"	value="<?php echo $fin;?>" /> 
					<input type="hidden" name="rec"	value="<?php echo $rec;?>" /> <input type="submit" name="Submit" value="Listar..."
					tabindex="<?PHP echo ++$ind; ?>" /> 
					<input name="escolha" type="hidden" value="tesouraria/receita.php" /> 
					<input name="menu" type="hidden" value="top_tesouraria" />				
				</td>
			</tr>
			<tr>
				<td>Dia:<br/> 
					<input type="text" size="2" maxlength="2" name="dia" value="<?php echo $_GET['dia'];?>"tabindex="<?PHP echo ++$ind; ?>" />
				</td>
				<td>Mês:<br/> 
					<input type="text" name="mes" value="<?php echo $_GET['mes'];?>"tabindex="<?PHP echo ++$ind; ?>" />
				</td>
				<td>Ano:<br/> 
					<input type="text" name="ano" class="dica" value="<?php echo $_GET['ano'];?>" tabindex="<?PHP echo ++$ind; ?>" />
				</td>
				<td>
					<h5>No campo ANO: em branco lista os pendentes e ZERO os confimados</h5>
				</td>
			</tr>
		</tbody>
	</table>
	</form>
</fieldset>