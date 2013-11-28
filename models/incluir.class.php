<?php
class incluir extends insert {

	public function inserir() {

		$inserir = mysql_query ("INSERT INTO ".$this->getTabela()." VALUES (".$this->getCampos().")") or die ( mysql_error());
		if ($inserir){
			return true;
		}else{
			return false;
		}
	}
	/*Exemplo do funcionamento desta classe
		$value = "'campo1','campo2','campo3','campo4',...,'campo_N'";
		$dados_pessoais = new insert ("$value","tabela");deve-se colocar todos valores para os campos da tabela a ser inserida
		$dados_pessoais->inserir();
	*/
}