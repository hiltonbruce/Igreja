<?php
class List_campanha extends List_sele {
	
	function __construct (){

		$this->texto_field = $texto_field;
		$this->query = "SELECT * FROM contas WHERE codigo LIKE '4.1.1.003.%' ";	
		$this->sql_lst = mysql_query($this->query." ORDER BY titulo") or die (mysql_error());
	}

	function List_Selec ($ind){

	  //Mostra as linhas de select

	  echo "<select name='acescamp' id='acescamp' class='' tabindex='$ind'>";

       while($this->col_lst = mysql_fetch_array($this->sql_lst))
       {
			$linha1 = "<option value='".$this->col_lst["acesso"]."'>".$this->col_lst["titulo"]."</option>";
       	}
      echo $linha1;
	  echo "</select>";
	  return $ind;
	}

}