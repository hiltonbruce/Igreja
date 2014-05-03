<fieldset>
	<legend>Detalhar entradas</legend>
	<form method="get" name="" action="">
		Por Congrega&ccedil;&atilde;o:
		<?php
		$bsccredor = new List_sele('igreja', 'razao', 'igreja');
		$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],' autofocus="autofocus" ');
		echo $listaIgreja;
		?>
		Ano: <input type="text" name="ano" value="<?php echo $_GET['ano'];?>"
			tabindex="<?PHP echo ++$ind; ?>" /> <input type="hidden" name="fin"
			value="<?php echo $fin;?>" /> <input type="hidden" name="rec"
			value="11" /> <input type="submit" name="Submit" value="Listar..."
			tabindex="<?PHP echo ++$ind; ?>" /> <input name="escolha"
			type="hidden" value="tesouraria/receita.php" /> <input name="menu"
			type="hidden" value="top_tesouraria" />
	</form>
</fieldset>
