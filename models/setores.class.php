<?php
class setores {

	function __construct (){
		$this->result = mysql_query("SELECT * FROM setores ORDER BY alias") or die (mysql_error());
	}

	function arrayDepto(){
     while($this->col_lst = mysql_fetch_assoc($this->result))
     {
    $setores [$this->col_lst["id"]] = array ("hier"=>$this->col_lst["hier"],"conta"=>$this->col_lst["conta"]
    							, "alias"=>$this->col_lst["alias"], "descricao"=>$this->col_lst["descricao"]
    							, "codigo"=>$this->col_lst["codigo"]);
     }
	  return $setores;
	}
}
?>
