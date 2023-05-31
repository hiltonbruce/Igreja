<?php
class List_UF extends List_sele {

	function List_Selec ($ind,$item){

	  	echo "<select name='{$this->texto_field}' id='{$this->texto_field}' autofocus='autofocus' required='required' class='form-control' tabindex='++$ind'>";
		$linha1 =  "<option value=''>-->> Escolha <<--</option>";
		$linhas .= '';

	       while($this->col_lst = mysql_fetch_array($this->sql_lst))
	       {
		       	if ($item==$this->col_lst["iduf"]) {
		       		$linha1 =  "<option value='".$this->col_lst["iduf"]."'>".utf8_decode($this->col_lst[$this->campo_retorno])."</option>";
		       	}
			    $linhas .= "<option value='".$this->col_lst["iduf"]."'>".utf8_decode($this->col_lst[$this->campo_retorno])."</option>";

	       }
	    $linhas .= "</select>";
	  return $linha1.$linhas ;
	}

	function List_Selec_pop ($valor,$uf){
	//Lista Select para uso com javascrip popup
	//Mostra as linhas de select
	$linha1='';$linhas='';
		while($this->col_lst = mysql_fetch_array($this->sql_lst))
		{
			if ($this->col_lst["iduf"]==$uf) {
				$linha1  = "<option value='./?$valor{$this->col_lst["iduf"]}'>".utf8_decode($this->col_lst[$this->campo_retorno])."</option>";
			}
			$linhas .= "<option value='./?$valor{$this->col_lst["iduf"]}'>".utf8_decode($this->col_lst[$this->campo_retorno])."</option>";
		}
		return $linha1.$linhas;
	}
}
