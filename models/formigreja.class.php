<?php 
class formigreja {
	
	function formulario ($nome,$id,$ind){
		echo "
		<form method='post' action='' id='igreja'>
			<input name='escolha' type='hidden' value='sistema/atualizar_rol.php' />
			<input name='razao' type='text' value='{$nome}' tabindex='{$ind}'/>			
			<input name='id' type='hidden' id='id' value='{$id}'  />
			<input name='tabela' type='hidden' value='igreja' />
			<input name='campo' type='hidden' value='razao' />
			<input type='submit' name='Submit' value='Alterar' tabindex='{++$ind}' />
		</form>
		";
		
	}
}

?>