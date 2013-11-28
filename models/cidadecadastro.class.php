<?php 
class cidadecadastro extends List_sele {
	
	function __construct ($estado= ""){

		$this->estado = strtoupper($estado) ;//O nome que será relaciondo ao campo de retorno para envio pelo form
		$this->query = "SELECT * from cidade WHERE coduf='{$this->estado}'";

		$this->sql_lst = mysql_query("{$this->query} ORDER BY 'nome'");
	}
	
	function List_cidade ($valor){
	//Lista Select para uso com javascrip popup

	//Mostra as linhas de select
	?>
	<select name="menu1" onchange="MM_jumpMenu('parent',this,0)">
		<option>--&gt;&gt; Escolha a Cidade&lt;&lt;-- </option>
		<?php
			while($this->col_lst = mysql_fetch_array($this->sql_lst))
			{
				echo "<option value='./?$valor{$this->col_lst["id"]}'>".htmlspecialchars(stripcslashes($this->col_lst['nome']))."</option>";
			}
	?>
	</select>
	<?php
	}
}

?>