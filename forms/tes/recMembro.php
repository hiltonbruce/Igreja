<tr>
	<td><label>Nome:</label>
			<input type='text' name='nome' id='estado' class='form-control'
			placeholder='Busca no cadastro da Igreja!' value='<?php echo $_GET['nome'];?>'
			autofocus='autofocus' tabindex="<?php echo ++$ind;?>" />
	</td>
	<td><label>Rol:</label>
			<input type='text' id='detalhe2' name='rol' tabindex='<?php echo ++$ind;?>'
					class='form-control' placeholder='N&ordm; do membro na igreja'
					value='<?php echo $_GET['rol'];?>' required='required' />
	</td>
</tr>
<?php
$rec = 1;
?>
