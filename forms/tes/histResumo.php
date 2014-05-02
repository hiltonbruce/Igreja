<fieldset>
	<legend>Listar Lançamentos Confirmados</legend>
	<form method="get" name="" action="">
		Por Congrega&ccedil;&atilde;o:
		<?php
		$bsccredor = new List_sele('igreja', 'razao', 'igreja');
		$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],' autofocus="autofocus" ');
		echo $listaIgreja;
		?> <br>
		Dia: <input type="text" size="2" maxlength="2" name="dia" value="<?php echo $_GET['dia'];?>"tabindex="<?PHP echo ++$ind; ?>" />
		Mês: <input type="text" name="mes" value="<?php echo $_GET['mes'];?>"tabindex="<?PHP echo ++$ind; ?>" />
		Ano: <input type="text" name="ano" value="<?php echo $_GET['ano'];?>"tabindex="<?PHP echo ++$ind; ?>" /> 
			<input type="hidden" name="fin"	value="<?php echo $fin;?>" /> 
			<input type="hidden" name="rec"	value="9" /> <input type="submit" name="Submit" value="Listar..."
			tabindex="<?PHP echo ++$ind; ?>" /> 
			<input name="escolha" type="hidden" value="tesouraria/receita.php" /> 
			<input name="menu" type="hidden" value="top_tesouraria" />
	</form>
</fieldset>
