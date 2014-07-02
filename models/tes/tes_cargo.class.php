<?php
conectar();

class tes_cargo {
	
	function __construct () {
		
		$sqlConsulta  = 'SELECT c.*,i.razao,m.nome,f.descricao AS nomeFuncao FROM cargoigreja AS c, ';
		$sqlConsulta .= 'igreja AS i,membro AS m, funcao AS f WHERE c.igreja=i.rol ';
		$sqlConsulta .= 'AND c.rol=m.rol AND c.descricao=f.id AND ativo="1" ORDER BY igreja';
		$this->query = $sqlConsulta;
		$this->membros = mysql_query($this->query) or die (mysql_error());
	}

	function dadosArray () {
		while($dados = mysql_fetch_array($this->membros))
		{
			$todos[$dados['descricao']][$dados['igreja']] = 
				array('nomeFunc'=>$dados['nomeFuncao'],'razao'=>$dados['razao'],
						'rolMembro'=>$dados['rol'],'nome'=>$dados['nome'],'pgto'=>$dados['pgto']
						,'diapgto'=>$dados['diapgto'],'tipo'=>$dados['tipo']);
			
		}
		
		return $todos ;
	}

}
?>