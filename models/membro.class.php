<?php
conectar();

class membro {
	
	function __construct () {

		$this->query = "SELECT nome FROM membro ORDER BY nome";
		$this->membros = mysql_query($this->query) or die (mysql_error());
	}

	function nomes () {
		$ind = 0;
		while($this->dados = mysql_fetch_array($this->membros))
		{
			$mud_acent = strtoupper(strtr($this->dados["nome"], 'срутщъэѓѕєњќчСРУТЩЪЭгедкмЧ','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
			
			$todos[$ind++] = $mud_acent;
			
		}
		
		return $todos ;
	}

}
?>