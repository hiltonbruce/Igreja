<?php
class tes_igreja {
	
	
	function __construct ($igreja='',$ano=''){
		$this->igreja = $igreja;
		$this->ano = $ano;
	}
	
	function ArraySaldos(){

		$this->query  = 'SELECT igreja,SUM(valor) AS valor,mesrefer AS mes FROM dizimooferta ';
		$this->query .= 'WHERE anorefer ='.$this->ano.' AND igreja = '.$this->igreja.'';
		$this->sql_lst = mysql_query("{$this->query} GROUP BY mesrefer ORDER BY igreja") or die (mysql_error());

	       while($resultado = mysql_fetch_array($this->sql_lst))
	       {
		    $valores_array [$resultado['mes']]=$resultado['valor'];
	       }
	  return $valores_array;
	
	}	
	
}
?>