<?php 
class ListDespesa {
	
	protected $campo_retorno;
	protected $texto_field;

	function ListDespesa ($campo_retorno= ""){
		
		$this->campo_retorno = $campo_retorno;//Campo que será retornado
		$this->query = "SELECT * from contas WHERE nivel1 = '3' AND acesso > '0' ";
		$this->sql_lst = mysql_query("{$this->query} ORDER BY codigo ");
	}
	
function List_sel ($ind,$texto_field){
	//$texto_field -> O nome que será relaciondo ao campo de retorno para envio pelo form
	//Mostra as linhas de select
	//*****************************************************************
	//*Concluir a config do selec p/ formulario de contas a pagar     *
	//*****************************************************************
	echo "<select name='{$texto_field}' id='{$texto_field}' tabindex='$ind' class='form-control'>";
	echo "<option value=''>-->> Escolha <<--</option>";
	  while($this->col_lst = mysql_fetch_array($this->sql_lst))
	  {
	       echo "<option value='".$this->campo_retorno."'>".$this->col_lst['codigo'].' - '.$this->col_lst['titulo']."</option>";
	  }
	echo "</select>";
     }
}
?>