<tr>
	<td><label>Nome</label> <input type="text" name="nome"
		class="form-control" autofocus="autofocus" size="40"
		tabindex="<?PHP echo $ind++;?>" value="<?php echo $_GET["nome"];?>" />
	</td>
	<td><a href="javascript:lancarSubmenu('campo=nome&rol=rol&form=0')"> <img
			border="0" src="img/lupa_32x32.png" width="18" height="18"
			title="Click aqui para pesquisar membros!" /> Pesquisar&nbsp;Membro
	</a></td>
	<td><label>Rol:</label> <input name="rol" type="text"
		class="form-control" value="<?php echo $_GET["rol"];?>" size="10"
		tabindex="<?PHP echo $ind++;?>" /></td>
</tr>
<?php
$rec = 1;
?>