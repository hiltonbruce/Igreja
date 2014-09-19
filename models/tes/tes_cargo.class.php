<?php
conectar();

class tes_cargo {
	
	function __construct () {
		
		$sqlConsulta  = 'SELECT c.*,i.razao,m.nome,f.descricao AS nomeFuncao ';
		$sqlConsulta .= 'FROM cargoigreja AS c,igreja AS i,membro AS m, funcao AS f ';
		$sqlConsulta .= 'WHERE c.igreja=i.rol AND c.rol=m.rol AND ';
		$sqlConsulta .= 'c.descricao=f.id AND c.status="1" ORDER BY m.nome,f.descricao,c.igreja';
		$this->query = $sqlConsulta;
		$this->membros = mysql_query($this->query) or die (mysql_error());
		
		while($dados = mysql_fetch_array($this->membros))
		{
			if ($dados['rol']!='0') {//Só membros da igreja
				$todos[$dados['descricao']][$dados['igreja']][$dados['hierarquia']]= 
				array('nomeFunc'=>$dados['nomeFuncao'],'razao'=>$dados['razao'],
						'rolMembro'=>$dados['rol'],'nome'=>$dados['nome'],'pgto'=>$dados['pgto']
						,'diapgto'=>$dados['diapgto'],'tipo'=>$dados['tipo']);
			}
			
			$arrayCargos[]= array('descricao'=>$dados['descricao'],'igreja'=>$dados['igreja']
				,'nomeFunc'=>$dados['nomeFuncao'],'razao'=>$dados['razao'],'naoMembro'=>$dados['naomembro'],
						'rolMembro'=>$dados['rol'],'nome'=>$dados['nome'],'pgto'=>$dados['pgto']
						,'diapgto'=>$dados['diapgto'],'tipo'=>$dados['tipo']
						,'hierarquia'=>$dados['hierarquia']);
		}
		$this->arrayNomeIgreja = $todos;
		$this->arrayCargo = $arrayCargos;
	}

	function dadosArray () {
		return $this->arrayNomeIgreja;
	}

	function dadosCargo() {
		return $this->arrayCargo;
	}
	
	function cargoIgreja($rolIgreja,$descricao) {
		$cargoAtivo = array();
		foreach ($this->arrayCargo as $chave => $valor) {
			if ($valor['igreja']==$rolIgreja && $valor['descricao']==$descricao) {
				$cargoAtivo [] = $valor;
			}
		}
		return $cargoAtivo;
	}
	
}
?>
