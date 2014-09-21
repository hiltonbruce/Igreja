<?php 
class formigreja {
	
	function formulario ($nome,$id,$ind){
		echo "
		<form method='post' action='' id='igreja'>
		<div class='row'>
  			<div class='col-sm-8'>
			<input name='escolha' type='hidden' value='sistema/atualizar_rol.php' />
			<input name='razao' type='text' class='form-control input-sm' value='{$nome}' tabindex='{$ind}'/>			
			<input name='id' type='hidden' id='id' value='{$id}'  />
			<input name='tabela' type='hidden' value='igreja' />
			<input name='campo' type='hidden' value='razao' />
			</div>
  			<div class='col-sm-2'>
			<input type='submit' class='btn btn-primary btn-sm' name='Submit' value='Alterar' tabindex='{++$ind}' />
			</div>
		</div>
		</form>
		";
		
	}
}

?>