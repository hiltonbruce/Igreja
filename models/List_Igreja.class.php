<?php
class List_Igreja extends List_sele {

	protected $texto_field;

	function __construct ($texto_field=""){
		$this->texto_field = $texto_field;
		$this->query = "SELECT * from igreja WHERE status='1' ";
		$this->sql_lst = mysql_query($this->query." ORDER BY razao") or die (mysql_error());
	}

	function List_Selec ($seq,$item,$required){
  	$linha1  =  "<select name='{$this->texto_field}' id='{$this->texto_field}' $required tabindex='$seq'>";
  	$linhas =  '<option value="0">-->> Todas as Igrejas <<--</option>';
		$linhas .= '<option value="-1">-->> Congrega&ccedil;&otilde;es <<--</option>';
		if ($item=='-1') {
					$linha1 .= '<option value="-1">-->> Congrega&ccedil;&otilde;es <<--</option>';
		       	}
	       while($this->col_lst = mysql_fetch_array($this->sql_lst))
	       {
            $retorLinha = strtr( $this->col_lst['razao'], 'áàãâéêíóõôúüçÁÀÃÂÉÊÍÓÕÔÚÜÇ','aaaaeeiooouucAAAAEEIOOOUUC');
		       	if ($item==$this->col_lst["rol"]) {
		       		$linha1 .=  "<option value='".$this->col_lst["rol"]."'>".$retorLinha."</option>";
		       	}
			    $linhas .= "<option value='".$this->col_lst["rol"]."'>".$retorLinha."</option>";
	       	}
	    $linha3 = "</select>";
	  return $linha1.$linhas.$linha3 ;
	}
	function corpoSelec(){
		$linhas =  '<option value="">-->> Escolha a Igrejas <<--</option>';
		while($this->col_lst = mysql_fetch_array($this->sql_lst))
		{
			$retorLinha = strtr( $this->col_lst['razao'], 'áàãâéêíóõôúüçÁÀÃÂÉÊÍÓÕÔÚÜÇ','aaaaeeiooouucAAAAEEIOOOUUC');
			$linhas .= "<option value='".$this->col_lst["rol"]."'>".$retorLinha."</option>";
		}
		return $linhas;
	}

	function igreja_pop ($ind,$igreja,$link){
	//Lista Select para uso com javascrip popup
	//Mostra as linhas de select
	?>
		<select name='igreja' id='igreja' class="form-control" onchange='MM_jumpMenu("parent",this,0)' tabindex='<?php echo $ind;?>' >
	<?php
	if (empty($link)) {
	 $valor = 'escolha='.$_GET['escolha'].'&menu=top_tesouraria&rec='.$_GET['rec'].'&rol=';
	}else {
	 $valor = $link;
	}
		//echo "<select name='igreja' id='igreja' onchange='MM_jumpMenu('parent',this,0)' tabindex='$ind' >";
		while($this->col_lst = mysql_fetch_array($this->sql_lst))
		{
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
