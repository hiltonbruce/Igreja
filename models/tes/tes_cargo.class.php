<?php
class tes_cargo {

	protected $status;

	function __construct ($status=0) {

		$sqlConsulta  = 'SELECT c.*,i.razao,m.nome,f.descricao AS nomeFuncao, i.status AS igrejaStatus ';
		$sqlConsulta .= ',m.endereco,m.numero,p.cpf,p.rg ';
		$sqlConsulta .= 'FROM cargoigreja AS c,igreja AS i,membro AS m, funcao AS f ';
		$sqlConsulta .= ',profissional AS p ';
		$sqlConsulta .= 'WHERE c.igreja=i.rol AND c.rol=m.rol AND ';
		$sqlConsulta .= 'p.rol=m.rol AND c.descricao=f.id ';
		$statusCta = ($status=='') ? 'AND c.status="1"' : '' ;
		$sqlConsulta .= $statusCta.'ORDER BY i.razao,m.nome,f.descricao';
		$this->query = $sqlConsulta;
		$this->membros = mysql_query($this->query) or die (mysql_error());

		while($dados = mysql_fetch_array($this->membros))
		{
			if ($dados['rol']!='0') {//S� membros da igreja
				$todos[$dados['descricao']][$dados['igreja']][$dados['hierarquia']]=
				array('nomeFunc'=>$dados['nomeFuncao'],'razao'=>$dados['razao'],
						'rolMembro'=>$dados['rol'],'nome'=>$dados['nome'],'pgto'=>$dados['pgto']
						,'status'=>$dados['status']
						,'diapgto'=>$dados['diapgto'],'tipo'=>$dados['tipo']);
			}
			if ($dados['igrejaStatus']!='0') { //Remove as igrejas desativadas
				$arrayCargos[]= array('descricao'=>$dados['descricao'],'igreja'=>$dados['igreja']
				,'nomeFunc'=>$dados['nomeFuncao'],'razao'=>$dados['razao'],'naoMembro'=>$dados['naomembro']
						,'rolMembro'=>$dados['rol'],'nome'=>$dados['nome'],'pgto'=>$dados['pgto']
						,'diapgto'=>$dados['diapgto'],'tipo'=>$dados['tipo']
						,'memCPF'=>$dados['cpf'],'memRG'=>$dados['rg'],'end'=>$dados['endereco']
						,'num'=>$dados['numero'],'coddespesa'=>$dados['coddespesa']
						,'status'=>$dados['status'],'hierarquia'=>$dados['hierarquia']
						,'id'=>$dados['id']);
			}
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
