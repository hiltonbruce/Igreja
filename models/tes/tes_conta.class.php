<?php
class tes_conta {

	protected $cta;
	function __construct ($cta=null) {
		$sqlConsulta  = 'SELECT * FROM contas ';
		//fitra por grupo de contas
		if (strlen($_GET['gpconta'])<='13') {
			$cta = trim($cta);
			switch (strlen($cta)) {
				case '13':
					$sqlConsulta .= 'WHERE codigo="'.$cta.'"';
					break;
				case '9':
					$sqlConsulta .= 'WHERE nivel4="'.$cta.'"';
					break;
				case '5':
					$sqlConsulta .= 'WHERE nivel3="'.$cta.'"';
					break;
				case '3':
					$sqlConsulta .= 'WHERE nivel2="'.$cta.'"';
					break;
				case '1':
					$sqlConsulta .= 'WHERE nivel1="'.$cta.'"';
					break;
			}
		}
		$sqlConsulta .= ' ORDER BY codigo,titulo';
		$this->query = $sqlConsulta;
		$this->membros = mysql_query($this->query) or die (mysql_error());
		while($dados = mysql_fetch_array($this->membros))
		{
			if ($dados['status']=='1' && $dados['acesso']!='0') {
				$ativos[$dados['acesso']]=
				array('id'=>$dados['id'],'codigo'=>$dados['codigo'],'nivel1'=>$dados['nivel1'],
						'nivel2'=>$dados['nivel2'],'nivel3'=>$dados['nivel3'],'nivel4'=>$dados['nivel4'],
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

			if (strlen($dados['codigo'])==5) {
				$ctaN3[$dados['codigo']]=
				array('id'=>$dados['id']
					,'titulo'=>htmlentities($dados['titulo'],ENT_QUOTES,'iso-8859-1')
					,'descricao'=>htmlentities($dados['descricao'],ENT_QUOTES,'iso-8859-1')
					,'tipo'=>$dados['tipo']
					,'saldo'=>$dados['saldo'],'tipo'=>$dados['tipo']);
			}

			$todasContas[$dados['id']]=
				array('acesso'=>$dados['acesso'],'codigo'=>$dados['codigo'],
						'titulo'=>$dados['titulo'],'descricao'=>$dados['descricao'],'tipo'=>$dados['tipo']
						,'saldo'=>$dados['saldo'],'tipo'=>$dados['tipo']
						,'nivel1'=>$dados['nivel1'],'nivel2'=>$dados['nivel2']
						,'nivel3'=>$dados['nivel3'],'nivel4'=>$dados['nivel4']);

			$ctaCod[$dados['codigo']]=
				array('acesso'=>$dados['acesso'],'id'=>$dados['id'],
						'titulo'=>$dados['titulo'],'descricao'=>$dados['descricao'],'tipo'=>$dados['tipo']
						,'saldo'=>$dados['saldo'],'tipo'=>$dados['tipo']
						,'nivel1'=>$dados['nivel1'],'nivel2'=>$dados['nivel2']
						,'nivel3'=>$dados['nivel3'],'nivel4'=>$dados['nivel4']);
		}
		$this->arrayGrupos	= $grupos;
		$this->arrayAtivos	= $ativos;
		$this->arrayTodos	= $todasContas;
		$this->arrayCod		= $ctaCod;
		$this->arrayCtaN3	= $ctaN3;
	}

	function ativosArray() {
		#Contas de lan�amento vinculada pelo c�digo de acesso e acesso != 0
		return $this->arrayAtivos;
	}

	function contasTodas() {
		#Contas de lan�amento vinculada pelo ID
		return $this->arrayTodos;
	}

	function contasGrupos() {
		#Contas de lançamento vinculada pelo codigo e com acesso != zero
		return $this->arrayGrupos;
	}

	function contasCod() {
		#Contas de lançamento vinculada pelo codigo
		return $this->arrayCod;
	}

	function contasN3() {
		#Contas de lançamento vinculada pelo codigo
		return $this->arrayCtaN3;
	}

}
?>
