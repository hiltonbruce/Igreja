<?php
class cargoigreja {

	function __construct (){
		$this->result = mysql_query('SELECT * FROM cargoigreja') or die (mysql_error());
	}

	function Arrayusuario(){
     while($col = mysql_fetch_array($this->result))
     {
    $usuario_array [$col['descricao']][$col['hierarquia']]= array ('setor'=>$col['setor'],'id'=>$col['id']
				,'status'=>$col['status'],'rol'=>$col['rol']
    		,'naomembro'=>$col['naomembro'],'igreja'=>$col['igreja']
				,'pgto'=>$col['pgto'],'diapgto'=>$col['diapgto'],'tipo'=>$col['tipo']
				,'coddespesa'=>$col['coddespesa'],'descFun'=>$col['descFun']);
     }
	  return $usuario_array;
	}
}
?>
