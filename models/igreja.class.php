<?php
class igreja {
	
	protected $id;
	
	function __construct ($id=""){

		$this->result = mysql_query("SELECT * FROM igreja WHERE rol='$id' ") or die (mysql_error());
		$this->id = $id;
		
	}

	function exitecad (){
		
		if (mysql_num_rows( $this->result)>0){
		 	echo "<h2>A Igreja ' $this->id ' j&aacute; est&aacute; cadastrado na Cidade de ";
		 	return true;
		 } else {
		 	echo "<h1>Novo Bairro Cadastrado: $this->bairro</h1>";
		 	return false;
		 }
	}
	
	function Arrayigreja(){

		$this->query = "SELECT rol,razao FROM igreja ";
		$this->sql_lst = mysql_query("{$this->query} ORDER BY razao") or die (mysql_error());
	//echo "<h1>Teste</h1>";

	       while($this->col_lst = mysql_fetch_array($this->sql_lst))
	       {
		    $bairr_array [$this->col_lst["rol"]]=$this->col_lst["razao"];
	       }
	  return $bairr_array;
	
	}
	
	function Deletar (){
	
		$ver = mysql_query("DELETE FROM igreja WHERE rol='{$this->id}' LIMIT 1");

		if($ver){
				echo "<script> alert('Apagado com sucesso'); location.href='./?escolha=tab_auxiliar/cadastro_igreja.php&uf=PB';</script></a>";
				echo "Bairro apagado com sucesso<br><a href='./?escolha=tab_auxiliar/cadastro_igreja.php&uf=PB'>Voltar...</a>";
				}
				else
				{
				$erro=mysql_error();
				echo "Não foi possível apagar, apresentou o seguite erro:  '$erro'";
				}
	}
	
}
?>