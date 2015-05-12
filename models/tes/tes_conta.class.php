<?php
conectar();

class tes_conta {

	function __construct () {

		$sqlConsulta  = 'SELECT * ';
		$sqlConsulta .= 'FROM contas ';
		$sqlConsulta .= 'ORDER BY codigo';
		$this->query = $sqlConsulta;
		$this->membros = mysql_query($this->query) or die (mysql_error());

		while($dados = mysql_fetch_array($this->membros))
		{
			if ($dados['status']=='1' && $dados['acesso']!='0') {
				$ativos[$dados['acesso']]=
				array('id'=>$dados['id'],'codigo'=>$dados['codigo'],
						'titulo'=>$dados['titulo'],'descricao'=>$dados['descricao'],'tipo'=>$dados['tipo']
						,'saldo'=>$dados['saldo'],'tipo'=>$dados['tipo']);
			}

			if ($dados['acesso']=='0') {
				$grupos[$dados['codigo']]=
				array('id'=>$dados['id']
					,'titulo'=>htmlentities($dados['titulo'],ENT_QUOTES,'iso-8859-1')
					,'descricao'=>htmlentities($dados['descricao'],ENT_QUOTES,'iso-8859-1')
					,'tipo'=>$dados['tipo']
					,'saldo'=>$dados['saldo'],'tipo'=>$dados['tipo']);
			}

			$todasContas[$dados['id']]=
				array('acesso'=>$dados['acesso'],'codigo'=>$dados['codigo'],
						'titulo'=>$dados['titulo'],'descricao'=>$dados['descricao'],'tipo'=>$dados['tipo']
						,'saldo'=>$dados['saldo'],'tipo'=>$dados['tipo']);
		}
		$this->arrayGrupos	= $grupos;
		$this->arrayAtivos	= $ativos;
		$this->arrayTodos	= $todasContas;
	}

	function ativosArray () {
		return $this->arrayAtivos;
	}

	function contasTodas() {
		return $this->arrayTodos;
	}

	function contasGrupos() {
		return $this->arrayGrupos;
	}

}
?>
