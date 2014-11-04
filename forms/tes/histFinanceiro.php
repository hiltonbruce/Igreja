<fieldset>
	<legend>Detalhar entradas</legend>
<table class="table">
	<tbody>
		<tr id="form">
			<td>&nbsp;<br />
				<a href="./?escolha=tesouraria/receita.php&menu=top_tesouraria&direita=1&rec=12&ano=<?php echo $_GET['ano'];?>"><button
						class='btn btn-primary'>Listar todas as Igrejas</button> </a>
			</td>
			<form method="get" name="" action="">
			<td><label>Ano:</label><input type="text" name="ano" class="form-control"
							placeholder="Ano" size="5" value="<?php echo $_GET['ano'];?>"
							tabindex="<?PHP echo ++$ind; ?>" /> 
							<input type="hidden" name="fin" value="<?php echo $fin;?>" />
							<input type="hidden" name="rec" value="<?php echo '11';?>" />
							<input type="hidden" name="direita" value="1" />
			</td>

			<td><label>Congrega&ccedil;&atilde;o:</label>
						<?php
						$bsccredor = new List_sele('igreja', 'razao', 'igreja');
						$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],'class="form-control" autofocus="autofocus"');
						echo $listaIgreja;
						?>
			</td>



			</td>
			<td>&nbsp;<br /><input type="submit" class='btn btn-primary' name="Submit" value="Filtrar..."
							tabindex="<?PHP echo ++$ind; ?>" />
							<input name="escolha" type="hidden" value="tesouraria/receita.php" />
							<input name="menu" type="hidden" value="top_tesouraria" />
			</td>
			</form>
		</tr>
	
	</tbody>
</table>
</fieldset>
