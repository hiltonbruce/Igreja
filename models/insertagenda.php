<?php

class insertagenda {

	protected $tabela; //Nome da Tebela
	protected $campos; //Valores do insert

	function __construct ($campos="",$tabela="") {
			$this->setTabela ($tabela);
			$this->setCampos ($campos);
		}

	public function setTabela ($tabela){
			$this->_tabela=$tabela;
		}

	public function setCampos ($campos){
			$this->_campos=$campos;
		}

	public function getTabela (){
		return $this->_tabela;
	}

	public function getCampos (){
		return $this->_campos;
	}

	public function inserir() {

		$inserir = mysql_query ("INSERT INTO ".$this->getTabela()." VALUES (".$this->getCampos().")") or die ( mysql_error());
		if (!$inserir){
			echo "<script> alert('Falha no Cadastro. Se o probelama continua informe ao desenvolvedor do sistema!');window.history.go(-1);</script>";
			echo "Falha no Cadastro. Se o probelama continua informe ao desenvolvedor do sistema!";
		}
	}
	/*Exemplo do funcionamento desta classe
		$value = "'campo1','campo2','campo3','campo4',...,'campo_N'";
		$dados_pessoais = new insert ("$value","tabela");deve-se colocar todos valores para os campos da tabela a ser inserida
		$dados_pessoais->inserir();
	*/
}
?>