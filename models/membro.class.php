<?php
conectar();

class membro {
	
	function __construct () {

		$this->query = "SELECT * FROM membro ORDER BY nome";
		$this->membros = mysql_query($this->query) or die (mysql_error());
	}

	function nomes () {
		$ind = 0;
		while($dados = mysql_fetch_array($this->membros))
		{
			$mud_acent = strtoupper(strtr($dados["nome"], 'срутщъэѓѕєњќчСРУТЩЪЭгедкмЧ','AAAAEEIOOOUUCAAAAEEIOOOUUC'));
			
			$todos[$dados['rol']] = array($mud_acent,$dados['nacionalidade'],$dados['naturalidade'],$dados['pai'],$dados['mae']) ;
			
		}
		
		return $todos ;
	}

}
?>