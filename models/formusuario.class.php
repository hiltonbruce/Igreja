<?php 
class formusuario {
	
	function alt_nome ($nome,$id,$ind){
		echo "
		<form method='post' action='' id='nome'>
			<input name='escolha' type='hidden' value='sistema/atualizar_sistema.php' />
			<input name='nome' type='text' value='{$nome}' tabindex='{$ind}'/>			
			<input name='id' type='hidden' id='id' value='{$id}'  />			
			<input name='tabela' type='hidden' id='tabela' value='usuario'  />
			<input name='campo' type='hidden' value='nome' />
			<input type='submit' name='Submit' value='Alterar Nome' tabindex='{++$ind}' />
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
			<input type='submit' name='Submit' value='Inicializar Senha' tabindex='{++$ind}' />
		</form> A senha será: {$senha->cpf}, deve-se digitar com os pontos e o hifen!
		";
		
	}
}

?>