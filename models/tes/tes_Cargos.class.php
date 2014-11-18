<?php
class tes_Cargos {

	protected $rol;
	protected $ano;

	function __construct ($rol='',$ano=''){
		$this->rol = $rol;
		$this->ano = $ano;
	}

	function ArraySaldos(){

		$this->query  = 'SELECT rol,SUM(valor) AS valor,mesrefer AS mes FROM dizimooferta ';
		$this->query .= 'WHERE anorefer ='.$this->ano.' AND rol = '.$this->rol.'';
		$this->sql_lst = mysql_query("{$this->query} GROUP BY mesrefer ORDER BY nome") or die (mysql_error());

	       while($resultado = mysql_fetch_array($this->sql_lst))
	       {
		    $valores_array [$resultado['mes']]=$resultado['valor'];
	       }
	  return $valores_array;

	}

}
?>
