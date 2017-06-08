<?php

class cidade {

	function __construct (){
		$this->result = mysql_query('SELECT * FROM cidade ') or die (mysql_error());
		$this->exitecad = mysql_num_rows($this->result);
		//$this->cidade = $cidade;
	}

	function exitecad (){
		if ($this->exitecad >0){
		 	echo '<div class="alert alert-error" >A cidade '.$this->cidade.' j&aacute; est&aacute; cadastrado para Cidade ';
		 	return true;
		 } else {
		 	echo '<div class="alert bg-success">Nova Cidade Cadastrada</div>';
		 	return false;
		 }
	}

	function arrayCidade(){
	//echo "<h1>Teste</h1>";
	$arrCidade = array();
   while($lst = mysql_fetch_array($this->result))
   {
  	$arrCidade [$lst['id']] = array('cidade' => $lst['nome'],'uf'=>$lst['coduf']);
   }
	  return $arrCidade;
	}

	function Deletar ($id){
		$idCid = mysql_real_escape_string($id);
		$ver = mysql_query('DELETE FROM cidade WHERE id="'.$id.'" LIMIT 1');
		if($ver){
				echo "<script> alert('Apagado com sucesso'); location.href='#';</script></a>";
				echo "Cidade apagada com sucesso<br><a href='#'>Voltar...</a>";
				}
				else
				{
				$erro=mysql_error();
				echo "N&atilde;o foi poss&iacute;vel apagar, apresentou o seguite erro:  '$erro'";
				}
	}
}
?>
