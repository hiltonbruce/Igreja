<?php
class List_campanha extends List_sele {
	
	function __construct (){

		$this->texto_field = $texto_field;
		$this->query = "SELECT * FROM contas WHERE status ='1' AND codigo LIKE '4.1.1.003.%' ";	
		$this->sql_lst = mysql_query($this->query." ORDER BY id DESC") or die (mysql_error());
	}

	function List_Selec ($ind,$campanha){

	  //Mostra as linhas de select

	  $linha0 = '<select name="acescamp" id="acescamp"  class="form-control" tabindex="'.$ind.'">';
	  $linha1="<option></option>";$linha2 = '';
       while($this->col_lst = mysql_fetch_array($this->sql_lst))
       {
			$linha2 .= "<option value='".$this->col_lst["acesso"]."'>".$this->col_lst["titulo"]."</option>";
			if ($campanha==$this->col_lst["acesso"]) {
				$linha1 = "<option value='".$this->col_lst["acesso"]."'>".$this->col_lst["titulo"]."</option>".$linha1;
			}
       	}
	  return $linha0.$linha1.$linha2.'</select>';
	}

}