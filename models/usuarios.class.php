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
    							, "cargo"=>$this->col_lst["cargo"], "perfil"=>strtoupper($this->col_lst["perfil"]), "situacao"=>$this->col_lst["situacao"]
    							, "setor"=>$this->col_lst["setor"],"nivel"=>$this->col_lst["nivel"]);
     }
	  return $usuario_array;
	}

	function Atualizar ($id,$situacao){
		$ver = mysql_query('UPDATE usuario SET situacao = "'.$situacao.'" WHERE id="'.$id.'" LIMIT 1');
		$msg = ($situacao=='1') ? 'Ativado' : 'Desativado' ;
		if($ver){
				echo '<script> alert("Usuário '.$msg.'"); location.href="./?escolha=tab_auxiliar/inic_usuario.php&menu=top_admusuario";</script></a>';
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
