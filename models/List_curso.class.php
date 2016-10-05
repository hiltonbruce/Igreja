<?php
class List_curso {
	//Lista para formulário

	function __construct (){

		$this->indice = 1;
		$this->sql_lst = mysql_query("SELECT id,tipo from cetad_curso ORDER BY tipo");

	}

	function List_Curso() {
	//Mostra as linhas de select
	echo "<select name='curso' id='curso' class='' tabindex='{$this->indice}'>";
	echo "<option value=''>-->> Escolha o Curso <<--</option>";
		while($this->col_lst = mysql_fetch_array($this->sql_lst)){
			echo "<option value='{$this->col_lst["id"]}'>".htmlspecialchars(stripcslashes($this->col_lst["tipo"]))."</option>";
		}
	echo "</select>";
	//Disconecta do Banco
	//$db->disconnect();
	}

	function List_Curso_pop() {

	//Mostra as linhas de select

		while($this->col_lst = mysql_fetch_array($this->sql_lst)){

			echo "<option value='./?escolha=cetad/pgto.php&menu=top_cetad&curso={$this->col_lst["id"]}'>".htmlspecialchars(stripcslashes($this->col_lst["tipo"]))."</option>";

		}

	//Disconecta do Banco
	//$db->disconnect();
	}
}
