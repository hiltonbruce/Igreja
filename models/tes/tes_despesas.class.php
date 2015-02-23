<?php
conectar();

class tes_despesas {
	
	function __construct () {
		
		$sqlConsulta  = 'SELECT *';
		$sqlConsulta .= 'FROM contas ';
		$sqlConsulta .= 'WHERE ';
		$sqlConsulta .= 'nivel1="3" ORDER BY codigo';
		$this->query = $sqlConsulta;
		$this->despesa = mysql_query($this->query) or die (mysql_error());
		
		while($dados = mysql_fetch_array($this->despesa))
		{
			if ($dados['id']!='0') {//Só despesa da Despesas
				$todos[$dados['id']]= 
				array('titulo'=>$dados['titulo'],'codigo'=>$dados['codigo'],
						'descricao'=>$dados['descricao'],'acesso'=>$dados['acesso'],'saldo'=>$dados['saldo']
						,'status'=>$dados['status'],'status'=>$dados['status']);
			}
			
		}
		$this->arrayacessoDespesas = $todos;
	}

	function dadosArray () {
		return $this->arrayacessoDespesas;
	}
	
}
?>
