<?php
class tes_credores {
	
	function __construct () {
		$this->query = "SELECT * FROM credores ORDER BY alias";
	}

	function dados () {
		$this->credores = mysql_query($this->query) or die (mysql_error());
		while($dados = mysql_fetch_array($this->credores))
		{
			$mud_acent = strtoupper(strtr($dados["alias"], 'срутщъэѓѕєњќчСРУТЩЪЭгедкмЧ','AAAAEEIOOOUUCAAAAEEIOOOUUC'));
			
			$todos[$dados['id']] = array($mud_acent,$dados['cnpj_cpf'],$dados['razao']
					,$dados['alias'],$dados['celular'],$dados['responsavel'],$dados['cpf'],
					$dados['end'],$dados['bairro'],$dados['cidade'].'-'.$dados['uf']) ;
			
		}
		
		return $todos ;
	}

}
?>