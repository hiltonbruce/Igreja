<?php 
class formbairro {
	
	function formulario ($cidade,$idbairro,$ind){
		echo "
		<form method='post' action='' id='formbairro'>
			<input name='escolha' type='hidden' value='sistema/atualizar.php' />
			<input name='bairro' type='text' value='{$cidade}' tabindex='{$ind}'/>			
			<input name='id' type='hidden' id='bairro' value='{$idbairro}'  />
			<input name='tabela' type='hidden' value='bairro' />
			<input name='campo' type='hidden' value='bairro' />
			<input type='submit' name='Submit' value='Alterar' tabindex='{++$ind}' />
		</form>
		";
	}
}

?>