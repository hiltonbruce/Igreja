<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/jquery.easy-autocomplete.min.js" type="text/javascript" ></script>
<?php
	echo '<tr><td><label>Nome</label>';
	echo '<input type="text" class="form-control" name="nome" autofocus="autofocus"
	 value="'.$_GET["nome"].'" size="40" tabindex="'.++$ind.'" />';
	?>
	</td><td><label>CPF:</label>
		<input name="cpf" type="text" class="form-control" value="<?php echo $_GET["cpf"];?>"
		 id="cpf" tabindex="<?PHP echo ++$ind;?>" />
	</td><td>
	<?php
	echo '<label>Identidade:</label>';
	echo '<input name="rg" type="text" class="form-control" value="'.$_GET["rg"].'"
	 placeholder="Número e Expedidor" tabindex="'.$ind++.'" /></td></tr>';
	$rec = 3; 
?>
			