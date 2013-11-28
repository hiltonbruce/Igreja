<?php

class usuarios {
	
	protected $id;
	
	function __construct (){

		$this->result = mysql_query("SELECT * FROM usuario WHERE id<>'1' ORDER BY nome") or die (mysql_error());
		
	}
	
	function Arrayusuario(){

	       while($this->col_lst = mysql_fetch_array($this->result))
	       {
		    $usuario_array [] = array ("nome"=>$this->col_lst["nome"],"id"=>$this->col_lst["id"],"cpf"=>$this->col_lst["cpf"]
		    							, "cargo"=>$this->col_lst["cargo"]);
	       }
	  return $usuario_array;
	
	}
	
	function Deletar ($id){
	
		$ver = mysql_query("DELETE FROM igreja WHERE rol='{$this->id}' LIMIT 1");

		if($ver){
				echo "<script> alert('Apagado com sucesso'); location.href='./?escolha=tab_auxiliar/inic_usuario.php&menu=top_admusuario';</script></a>";
				echo "Usuário apagado com sucesso<br><a href='./?escolha=tab_auxiliar/inic_usuario.php&menu=top_admusuario'>Voltar...</a>";
				}
				else
				{
				$erro=mysql_error();
				echo "Não foi possível apagar, apresentou o seguite erro:  '$erro'";
				}
	}
}
?>
