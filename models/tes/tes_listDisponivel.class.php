<?PHP
class tes_listDisponivel extends List_sele {

	function __construct (){

		$this->tabela = 'contas';//
		$this->campo_retorno = 'acesso';//Campo que serï¿½ retornado
		$this->texto_field = 'acesso';//O nome que serï¿½ relaciondo ao campo de retorno para envio pelo form
		$this->query = "SELECT * from {$this->tabela} ";

		$this->sql_lst = mysql_query($this->query.' ORDER BY '.$this->campo_retorno.' WHERE tipo="D"');
	}

	function List_Selec ($seq,$item,$required){

	  	$linha1  =  "<select name='{$this->texto_field}' id='{$this->texto_field}' $required tabindex='$seq'>";
	  	if ($item<1) {
	  		$linha1 .=  "<option value=''>-->> Escolha <<--</option>";
	  	}else {
	  		$linhas =  "<option value='0'>-->> Todas <<--</option>";
	  	}

		$linhas .= '';

	       while($this->col_lst = mysql_fetch_array($this->sql_lst))
	       {
	       	if ($this->col_lst["rol"]=='') {
	       		if ($item==$this->col_lst["id"]) {
		       		$linha1 .=  "<option value='".$this->col_lst["id"]."'>".$this->col_lst[$this->campo_retorno]."</option>";
		       	}
			    $linhas .= "<option value='".$this->col_lst["id"]."'>".$this->col_lst[$this->campo_retorno]."</option>";
	       	}else {
		       	if ($item==$this->col_lst["rol"]) {
		       		$linha1 .=  "<option value='".$this->col_lst["rol"]."'>".$this->col_lst[$this->campo_retorno]."</option>";
		       	}
			    $linhas .= "<option value='".$this->col_lst["rol"]."'>".$this->col_lst[$this->campo_retorno]."</option>";
	       	}
	       }
	    $linha3 = "</select>";

	  return $linha1.$linhas.$linha3 ;
	}

	function List_Selec_pop ($link,$rol){
	//Lista Select para uso com javascrip popup
	//Mostra as linhas de select
	$linha1='';
	$linhas .="<option value='./?$link{$this->col_lst["acesso"]}'>Todas</option>";

		while($this->col_lst = mysql_fetch_array($this->sql_lst))
		{
			if ($this->col_lst["acesso"]==$rol) {
				$linha1  = "<option value='./?$link{$this->col_lst["acesso"]}'>".$this->col_lst[$this->campo_retorno]."</option>";
			}
			 $linhas .="<option value='./?$link{$this->col_lst["acesso"]}'>".$this->col_lst[$this->campo_retorno]."</option>";
		}

		echo $linha1.$linhas;
	}

	function List_sel ($ind,$req){

	//Mostra as linhas de select
	echo "<select name='{$this->texto_field}' id='{$this->texto_field}' $req tabindex='++$ind'>";
	echo "<option value=''>-->> Escolha <<--</option>";
	  while($this->col_lst = mysql_fetch_array($this->sql_lst))
	  {
	       echo "<option value='".$this->col_lst["id"]."'>".$this->col_lst[$this->campo_retorno]."</option>";
	  }
	echo "</select>";
     }

     function List_area_atua ($ind){

	//Mostra as linhas de select
	$this->sql_area = mysql_query("{$this->query}"." WHERE codigo LIKE '_.__' AND codigo<>'1.09'");

	echo "<select name='{$this->texto_field}' id='{$this->texto_field}' class='' tabindex='++$ind'>";
	echo "<option value=''>-->> Escolha <<--</option>";
	  while($this->col_lst = mysql_fetch_array($this->sql_area))
	  {
	       echo "<option value='".Substr($this->col_lst["codigo"],0,4)."'>".$this->col_lst[$this->campo_retorno]."</option>";
	  }
	echo "</select>";
     }

}

?>