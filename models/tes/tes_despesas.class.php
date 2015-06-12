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
			if ($dados['id']!='0') {//Só das Despesas
				$todos[$dados['id']] = array('titulo'=>$dados['titulo'],'codigo'=>$dados['codigo'],
						'descricao'=>$dados['descricao'],'acesso'=>$dados['acesso'],'saldo'=>$dados['saldo']
						,'status'=>$dados['status'],'status'=>$dados['status']);
			}

		}
		$this->arrayacessoDespesas = $todos;
	}

	function dadosArray () {
		return $this->arrayacessoDespesas;
	}

	function despesasArray ($mes,$ano) {
		$mes = sprintf ("%'02u",$mes);
		$mesRelatorio = $ano.$mes;
		$sqlLancDesp  = 'SELECT l.*,c.acesso, c.titulo, c.codigo,c.tipo,i.razao, DATE_FORMAT(l.data,"%d/%m/%Y") AS dtLanc ';
		$sqlLancDesp .= 'FROM lanc AS l, contas AS c, igreja AS i WHERE c.id=l.debitar ';
		$sqlLancDesp .= 'AND DATE_FORMAT(l.data,"%Y%m")="'.$mesRelatorio.'" ';
		$sqlLancDesp .= 'AND l.igreja=i.rol AND c.nivel1 = "3" ORDER BY c.codigo,i.razao ';
		$despesa = mysql_query($sqlLancDesp) or die (mysql_error());
		while($dados = mysql_fetch_array($despesa)) {
			//Lançamento da Despesas
			$arrayDespesas[] = array('titulo'=>$dados['titulo'],'codigo'=>$dados['codigo']
				,'lancamento'=>$dados['lancamento'],'debitar'=>$dados['debitar']
				,'creditar'=>$dados['creditar'],'valor'=>$dados['valor']
				,'igreja'=>$dados['razao'],'referente'=>$dados['referente']
				,'data'=>$dados['dtLanc'],'hist'=>$dados['hist'],'acesso'=>$dados['acesso']);
		}

		return $arrayDespesas;
	}

}
?>
