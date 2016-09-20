<?php

class bairro {

	function __construct ($cidade="",$bairro=""){

		$this->result = mysql_query("SELECT * FROM bairro WHERE idcidade='$cidade' AND bairro='$bairro' ") or die (mysql_error());
		$this->bairro = $bairro;
		$this->cidade = $cidade;

	}

	function exitecad (){

		if (mysql_num_rows( $this->result)>0){
		 	echo '<div class="alert alert-error" >O bairro '.$this->bairro.' j&aacute; est&aacute; cadastrado para Cidade ';
		 	return true;
		 } else {
		 	echo '<div class="alert bg-success">Novo Bairro Cadastrado: '.$this->bairro.'</div>';
		 	return false;
		 }
	}

	function Arraybairro($idcidade){

		$this->query = "SELECT id,bairro FROM bairro WHERE idcidade=$idcidade ";
		$this->sql_lst = mysql_query("{$this->query} ORDER BY bairro") or die (mysql_error());
	//echo "<h1>Teste</h1>";

	       while($this->col_lst = mysql_fetch_array($this->sql_lst))
	       {
		    $bairr_array [$this->col_lst["id"]]=$this->col_lst["bairro"];
	       }
	  return $bairr_array;

	}

	function Deletar (){

		$ver = mysql_query("DELETE FROM bairro WHERE id='{$this->bairro}' LIMIT 1");

		if($ver){
				echo "<script> alert('Apagado com sucesso'); location.href='./?escolha=tab_auxiliar/cadastro_bairro.php&uf=PB';</script></a>";
				echo "Bairro apagado com sucesso<br><a href='./?escolha=tab_auxiliar/cadastro_bairro.php&uf=PB'>Voltar...</a>";
				}
				else
				{
				$erro=mysql_error();
				echo "N�o foi poss�vel apagar, apresentou o seguite erro:  '$erro'";
				}
	}

}
?>
