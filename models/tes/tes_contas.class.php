<?php
class tes_contas {

	function __construct () {
		$sqlConsulta  = 'SELECT * ';
		$sqlConsulta .= 'FROM contas ';
		//fitra por grupo de contas
		$sqlConsulta .= ' ORDER BY codigo,titulo';
		$this->query = $sqlConsulta;
		$this->membros = mysql_query($this->query) or die (mysql_error());
		while($dados = mysql_fetch_array($this->membros))
		{
			if ($dados['status']=='1' && $dados['acesso']!='0') {
				$ativos[$dados['acesso']]=
				array('id'=>$dados['id'],'codigo'=>$dados['codigo']
						,'titulo'=>$dados['titulo'],'descricao'=>$dados['descricao']
						,'tipo'=>$dados['tipo']
						,'saldo'=>$dados['saldo'],'tipo'=>$dados['tipo']
						,'nivel1'=>$dados['nivel1'],'nivel2'=>$dados['nivel2']
						,'nivel3'=>$dados['nivel3'],'nivel4'=>$dados['nivel4']);
			}

			$todasContas[$dados['id']]=
				array('acesso'=>$dados['acesso'],'codigo'=>$dados['codigo'],
						'titulo'=>$dados['titulo'],'descricao'=>$dados['descricao'],'tipo'=>$dados['tipo']
						,'saldo'=>$dados['saldo'],'tipo'=>$dados['tipo']
						,'nivel1'=>$dados['nivel1'],'nivel2'=>$dados['nivel2']
						,'nivel3'=>$dados['nivel3'],'nivel4'=>$dados['nivel4']);

		}
		$this->arrayAtivos	= $ativos;
		$this->arrayTodos	= $todasContas;
	}

	function ativosArray() {
		#Contas de lançamento vinculada pelo código de acesso e acesso != 0
		return $this->arrayAtivos;
	}

	function contasTodas() {
		#Contas de lançamento vinculada pelo ID
		return $this->arrayTodos;
	}

}
?>
