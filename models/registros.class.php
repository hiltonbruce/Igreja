<?php
class registros {

	protected $tipo;
	function registros ($situacao=""){

		$this->tipo = $tipo;
	}

	function tipo (){

		switch ($this->valor){
			case "1":
				$this->situacao = "Regularizado";
				break;
			case "2":
				$this->situacao = "Displina";
				break;
			case "3":
				$this->situacao = "Falecido";
				break;
			case "4":
				$this->situacao = "Mudan&ccedil;a de Igreja Sem Carta";
				break;
			case "5":
				$this->situacao = "Afastou-se";
				break;
			case "6":
				$this->situacao = "Transferido C/ Carta";
				break;
			default:
				$this->situacao = "Situ&ccedil;&atilde;o n&atilde;o definida!";
				break;
		}
		
		return $this->situacao;
	}

}
?>