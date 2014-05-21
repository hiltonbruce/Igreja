<?php 
class formusuario {
	
	function alt_nome ($nome,$id,$ind){
		echo "
		<form method='post' action='' id='nome'>
			<input name='escolha' type='hidden' value='sistema/atualizar_sistema.php' />
			<input name='nome' type='text' class='form-control' value='{$nome}' tabindex='{$ind}'/>			
			<input name='id' type='hidden' id='id' value='{$id}'  />			
			<input name='tabela' type='hidden' id='tabela' value='usuario'  />
			<input name='campo' type='hidden' value='nome' /></td><td>
			<input type='submit' class='btn btn-primary btn-sm' name='Submit' value='Alterar Nome' tabindex='{++$ind}' />
		</form>
		";
		
	}
	
function ini_senha ($id,$ind){
	$senha = new DBRecord("usuario", $id, "id");
	$inicializar = md5($senha->cpf);
		echo "
		<form method='post' action='' id='senha'>
			<input name='escolha' type='hidden' value='sistema/atualizar_sistema.php' />
			<input name='senha' type='hidden' value='{$inicializar}' tabindex='{$ind}'/>			
			<input name='id' type='hidden' id='id' value='{$id}'  />			
			<input name='tabela' type='hidden' id='tabela' value='usuario'  />
			<input name='campo' type='hidden' value='senha' />
			<input type='submit' class='btn btn-primary btn-sm' name='Submit' value='Inicializar Senha' tabindex='{++$ind}' />
		</form></td><td> A senha será: {$senha->cpf}, deve-se digitar com os pontos e o hifen!
		";
		
	}
}

?>