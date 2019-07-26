<?php
class formusuario {

	protected $cpf;
	protected $cargo;
	public function __construct($cpf=null,$cargo=null)
	{
		$this->cpf = $cpf;
		$this->cargo = $cargo;
	}

	function alt_nome ($nome,$id,$ind,$mesmoSetor,$perfil){
		echo "<form method='post' action='' id='nome'>";
		echo "<input name='escolha' type='hidden' value='sistema/atualizar_sistema.php' />";
		echo '<label>CPF: '.$this->cpf .' - Cargo:'.$this->cargo.'</label>';
		echo "<input name='nome' type='text' class='form-control' value='$nome' tabindex='$ind'/>";
		echo '<label>Perfil:</label>';
		echo "<input name='Perfil' type='text' class='form-control' value='$perfil' disabled/>";
		echo "<input name='id' type='hidden' id='id' value='{$id}'  />";
		echo "<input name='tabela' type='hidden' id='tabela' value='usuario' /></td><td width='20%'>";
		if ($mesmoSetor) {
			$setor = new List_setores();
			echo '<label>Atribuir Setor de atua&ccedil;&atilde;o</label>';
			echo $setor->List_Setor(++$ind,'class="form-control"',$_SESSION["setor"]);
		}
		if ($perfil!='') {
			$lisPerf = explode(',',$perfil);
			echo '<p class="lead">';
			foreach ($lisPerf as $key => $value) {
				echo ' <button type="button" class="btn btn-danger btn-xs" title="Excluir Perfil" data-toggle="tooltip" ';
				echo 'data-placement="top" > <span class="glyphicon glyphicon-remove"></span> '.$value.'</button> ';
			}
			echo '</p>';
		}
		echo "<input name='campo' type='hidden' value='nome' /></td><td>";
		echo "<p><input type='submit' class='btn btn-primary btn-sm' name='Submit' ";
		echo "value='Alterar' tabindex='{++$ind}' />";
		echo "</form>";
	}

function ini_senha ($id,$ind){
	$senha = new DBRecord("usuario", $id, "id");
	$inicializar = md5($senha->cpf);
		echo "</td><td>
		<form method='post' action='' id='senha'>
			<input name='escolha' type='hidden' value='sistema/atualizar_sistema.php' />
			<input name='senha' type='hidden' value='{$inicializar}' tabindex='{$ind}'/>
			<input name='id' type='hidden' id='id' value='{$id}'  />
			<input name='tabela' type='hidden' id='tabela' value='usuario'  />
			<input name='campo' type='hidden' value='senha' />
			<input type='submit' class='btn btn-warning btn-sm' name='Submit' value='Inicializar Senha' tabindex='{++$ind}' />
		</form> A senha ser&aacute;: {$senha->cpf}, deve-se digitar com os pontos e o hifen!
		";

	}
}

?>
