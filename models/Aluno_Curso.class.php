<?php
class Aluno_Curso {
	//Lista para formulário
	
	function __construct (){
		
		$this->indice = 1;
		$this->sql_aluno = mysql_query("SELECT m.nome,a.id from membro AS m, cetad_aluno AS a WHERE m.rol = a.rol AND a.curso = '{$_GET["curso"]}' ORDER BY m.nome");
		$this->tipo_curso = new DBRecord ("cetad_curso",$_GET["curso"],"id");
		
	}

	function List_Aluno() {
	
	//Mostra as linhas de select
	
	echo "<h2>Curso: {$this->tipo_curso->tipo()}</h2>";
	echo " <label>Aluno: <select name='aluno' id='aluno' class='' tabindex='{$this->indice}'>";		
	echo "<option value=''>-->> Escolha o Aluno <<--</option>";
	
		while($this->col_aluno = mysql_fetch_array($this->sql_aluno)){
		
			echo "<option value='{$this->col_aluno["id"]}'>{$this->col_aluno["nome"]}</option>";
		
		}
	echo "</select> </label>";
	//Disconecta do Banco
	//$db->disconnect();
	}
}