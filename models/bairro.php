<?php

conectar();

class bairro {

	function __construct ($cidade="",$bairro=""){

		$this->result = mysql_query("SELECT * FROM bairro WHERE idcidade='$cidade' AND bairro='$bairro' ") or die (mysql_error());
		$this->bairro = $bairro;
		$this->cidade = $cidade;
	}

	function exitecad (){
		
		if (mysql_num_rows( $this->result)>0){
		 	echo "<h1>O bairro ' $this->bairro ' j&aacute; est&aacute; Cadastrado!</h1>";
		 	return true;
		 } else {
		 	echo "<h1>Novo Bairro Cadastrado: $this->bairro</h1>";
		 	return false;
		 }
	}
	
}
?>