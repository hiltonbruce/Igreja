<?php 
class bairroselpop extends List_sele {
	
	function __construct ($tabela="", $campo_retorno= "", $texto_field="",$idcidade=""){

		//$this->tabela = $tabela;//
		$this->campo_retorno = $campo_retorno;//Campo que será retornado
		$this->texto_field = $texto_field;//O nome que será relaciondo ao campo de retorno para envio pelo form
		$this->query = "SELECT * from {$tabela} WHERE idcidade=".$idcidade;

		$this->sql_lst = mysql_query("{$this->query} ORDER BY {$this->campo_retorno}");
	}
	
	function List_Selec_pop ($valor){
	//Lista Select para uso com javascrip popup

	//Mostra as linhas de select
	?>
	<select name="menu1" onchange="MM_jumpMenu('parent',this,0)">
						<option>--&gt;&gt; Escolha o Bairro&lt;&lt;-- </option>
	<?php
		while($this->col_lst = mysql_fetch_array($this->sql_lst))
		{
			echo "<option value='./?$valor{$this->col_lst["id"]}'>".htmlspecialchars(stripcslashes($this->col_lst['bairro']))."</option>";
		}

	?>
	</select>
	<?php
	}
}

?>