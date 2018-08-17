<?php
class sec_membro {

	protected $rolMembro;

	function __construct ($rolMembro='') {
		$sqlConsulta  = 'SELECT m.*,i.razao,e.uf AS ufEcle,c.data AS dataCivil,c.obs AS obsCivil,';
		$sqlConsulta .= 'p.cpf,p.rg,p.obs AS obsProf ';
		$sqlConsulta .= 'FROM eclesiastico AS e,igreja AS i,membro AS m, est_civil AS c ';
		$sqlConsulta .= ',profissional AS p ';
		$sqlConsulta .= 'WHERE e.congregacao=i.rol AND m.rol=c.rol AND ';
		$sqlConsulta .= 'm.rol=p.rol AND m.rol=c.rol AND m.rol="'.$rolMembro.'" ';
		$sqlConsulta .= 'ORDER BY m.nome,i.razao';
		$this->query = $sqlConsulta;
	}

	function dadosMembro () {
		$membros = mysql_query($this->query) or die (mysql_error());
		while($dados = mysql_fetch_assoc($membros))
		{
				$arrayMembro[$dados['rol']]= array('nome'=>$dados['nome'],'bairro'=>$dados['bairro']
				,'celular'=>$dados['celular'],'cep'=>$dados['cep'],'cidade'=>$dados['cidade']
						,'datanasc'=>$dados['datanasc'],'doador'=>$dados['doador'],'dt_cadastro'=>$dados['dt_cadastro']
						,'email'=>$dados['email'],'endereco'=>$dados['endereco'],'escolaridade'=>$dados['escolaridade']
						,'fone_resid'=>$dados['fone_resid'],'graduacao'=>$dados['graduacao'],'mae'=>$dados['mae']
						,'nacionalidade'=>$dados['nacionalidade'],'naturalidade'=>$dados['naturalidade']
						,'numero'=>$dados['numero'],'obs'=>$dados['obs'],'pai'=>$dados['pai']
						,'rol_mae'=>$dados['rol_mae'],''=>$dados['rol_pai'],''=>$dados['rol_pai']
						,'sangue'=>$dados['sangue'],'sexo'=>$dados['sexo'],'uf_nasc'=>$dados['uf_nasc']
						,'uf_resid'=>$dados['uf_resid'],'auxiliar'=>$dados['auxiliar'],'batismo_em_aguas'=>$dados['batismo_em_aguas']
						,'batismo_espirito_santo'=>$dados['batismo_espirito_santo'],'congregacao'=>$dados['congregacao'],'data'=>$dados['data']
						,'dat_aclam'=>$dados['dat_aclam'],'diaconato'=>$dados['diaconato'],'evangelista'=>$dados['evangelista']
						,'pastor'=>$dados['pastor'],'presbitero'=>$dados['presbitero'],'situacao_espiritual'=>$dados['situacao_espiritual']
						,'ufEcle'=>$dados['ufEcle'],'certidao_casamento_n'=>$dados['certidao_casamento_n'],'conjugue'=>$dados['conjugue']
						,'dataCivil'=>$dados['dataCivil'],'estado_civil'=>$dados['estado_civil'],'folhas'=>$dados['folhas']
						,'livro'=>$dados['livro'],'rol_conjugue'=>$dados['rol_conjugue'],'obsCivl'=>$dados['obsCivil']
						,'cpf'=>$dados['cpf'],'obsProf'=>$dados['obsProf'],'onde_trabalha'=>$dados['onde_trabalha']
						,'orgao_expedidor'=>$dados['orgao_expedidor'],'profissao'=>$dados['profissao'],'rg'=>$dados['rg']);
		}
		return $arrayMembro;
	}
}
?>
