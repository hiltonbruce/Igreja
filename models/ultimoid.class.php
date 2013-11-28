<?php
class ultimoid {

	protected $tabela;

	function __construct ( $tabela= ""){
		$this->tabela = $tabela;//Tabela que será para trazer o último id
		$this->query = "SELECT * from {$this->tabela} ORDER BY id DESC LIMIT 1" ;
		$this->sql = mysql_query("{$this->query}") OR DIE (mysql_error());
		$this->col_lst = mysql_fetch_array($this->sql);
     }

     function ultimo ($campo){
	//seleciona o ultimo registro subordinado ao código escolhido
	$campo = (empty($campo)) ? 'id':$campo;
	return $this->col_lst[$campo];
     }

}
?>