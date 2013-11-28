<?php
class list_fornecedor extends List_sele {

	function List_sel (){

	//Mostra as linhas de select
	echo "<select name='{$this->texto_field}' id='{$this->texto_field}' class='' tabindex='++$ind'>";
	echo "<option value=''>-->> Escolha <<--</option>";
	  while($this->col_lst = mysql_fetch_array($this->sql_lst))
	  {
	       echo "<option value='".$this->col_lst["id"]."'>".$this->col_lst[$this->campo_retorno]."</option>";
	  }
	echo "</select>";
     }
     
	function List_Selec_pop ($valor){
	//Lista Select para uso com javascrip popup

	//Mostra as linhas de select
	$linha1 = "<option value='./?$valor'>Todos</option>";
		while($this->col_lst = mysql_fetch_array($this->sql_lst))
		{
			if ($_GET['credor']==$this->col_lst["id"]) {
				$linha1 = "<option value='./?$valor{$this->col_lst["id"]}'>".$this->col_lst[$this->campo_retorno]."</option>".$linha1;
			}
			$linha .= "<option value='./?$valor{$this->col_lst["id"]}'>".$this->col_lst[$this->campo_retorno]."</option>";
		}
		
		return $linha1.$linha;

	}
}
