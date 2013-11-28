<?php
class numlinhas {
	
  var $tabela;
  var $id;
  var $campo;

	function __construct ($tabela,$campo,$id){
			
		global $db;
		$this->tabela 	= $tabela;
		$this->id 		= $id;
		$this->campo 		= $campo;
		$this->sql_lst 	= "SELECT * from $tabela WHERE $campo=? ";
		$this->res 		= $db->query($this->sql_lst, array( $id ));
	}

	function totlinhas (){
		//Obtém o número de linhas
		 	return $this->res->numRows();
	}

}
?>