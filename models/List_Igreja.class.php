<?php
class List_igreja extends List_sele {
	
	protected $texto_field;
	
	function __construct ($texto_field=""){

		$this->texto_field = $texto_field;
		$this->query = "SELECT * from igreja";	
		$this->sql_lst = mysql_query($this->query." ORDER BY razao") or die (mysql_error());
	}

	function List_Selec ($ind,$igreja){

	  //Mostra as linhas de select

	  echo "<select name='{$this->texto_field}' id='{$this->texto_field}' class='' tabindex='$ind'>";
	  
	  if ($igreja=="") {
	  	 $igreja = 1;
	  }

       while($this->col_lst = mysql_fetch_array($this->sql_lst))
       {
	       	if ($igreja==$this->col_lst["rol"]) {
	       		$linha1 = "<option value='".$this->col_lst["rol"]."'>".$this->col_lst["razao"]."</option>";
	       	}else {
		    	$linst .= "<option value='".$this->col_lst["rol"]."'>".$this->col_lst["razao"]."</option>";
	       	}
       	}
      echo $linha1.$linst;
	  echo "</select>";
	  return $ind;
	}

	function igreja_pop ($ind,$igreja){
	//Lista Select para uso com javascrip popup

	//$sql_lst = mysql_query("SELECT * from {$this->tabela} ORDER BY {$this->campo_retorno}");

	//Mostra as linhas de select
	?>
		<select name='igreja' id='igreja' onchange='MM_jumpMenu("parent",this,0)' tabindex='<?php echo $ind;?>' >
	<?php
	
		//echo "<select name='igreja' id='igreja' onchange='MM_jumpMenu('parent',this,0)' tabindex='$ind' >";
		while($this->col_lst = mysql_fetch_array($this->sql_lst))
		{
			$valor = 'escolha='.$_GET['escolha'].'&menu=top_tesouraria&rec='.$_GET['rec'].'&rol=';
			//echo "<option value='./?$valor{$this->col_lst["rol"]}'>".$this->col_lst[$this->campo_retorno]."</option>";
			
	       	if ($igreja==$this->col_lst["rol"]) {
	       		$linha1 = "<option value='./?$valor{$this->col_lst["rol"]}'>".$this->col_lst["razao"]."</option>";
	       	}else {
		    	$linst .= "<option value='./?$valor{$this->col_lst["rol"]}'>".$this->col_lst["razao"]."</option>";
	       	}
		}
		echo $linha1.$linst;
		echo "</select>";

	//Disconecta do Banco
	//$db->disconnect();
	}
}