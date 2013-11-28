<?php
class selfonte extends List_sele {
	
	function List_sel ($ind){

	//Mostra as linhas de select
	echo "<select name='{$this->texto_field}' id='{$this->texto_field}' class='' tabindex='++$ind'>";
	echo "<option value='1'>-->> Dízimos e Ofertas <<--</option>";
	  while($this->col_lst = mysql_fetch_array($this->sql_lst))
	  {
	       echo "<option value='".$this->col_lst["id"]."'>".htmlspecialchars(stripcslashes($this->col_lst[$this->campo_retorno]))."</option>";
	  }
	echo "</select>";
     }
}