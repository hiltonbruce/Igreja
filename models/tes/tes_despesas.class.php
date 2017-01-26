<?php
class tes_despesas {

	protected $ctaGrupo;

	function __construct ($ctaGrupo=null) {
		$contas = (strlen($ctaGrupo)==5) ? true : false ;
		$sqlConsulta  = 'SELECT * FROM contas ';
		if ($contas) {
			$sqlConsulta .= 'WHERE nivel3="'.$ctaGrupo.'" ';
		} /*else {
			$sqlConsulta .= 'WHERE WHERE nivel1="3" OR nivel2="1.2" ';
		}*/
		$sqlConsulta .= '';
		$sqlConsulta .= 'ORDER BY codigo';
		$this->query = $sqlConsulta;
		$this->despesa = mysql_query($this->query) or die (mysql_error());
		while($dados = mysql_fetch_array($this->despesa))
		{
				$todos[$dados['id']] = array('titulo'=>$dados['titulo'],'codigo'=>$dados['codigo'],
						'descricao'=>$dados['descricao'],'acesso'=>$dados['acesso'],'saldo'=>$dados['saldo']
						,'status'=>$dados['status'],'tipo'=>$dados['tipo']);

				if ($dados['nivel1']=='3' || $dados['nivel2']=='1.2') {
					$dispDesp[$dados['id']] = array('titulo'=>$dados['titulo'],'codigo'=>$dados['codigo'],
						'descricao'=>$dados['descricao'],'acesso'=>$dados['acesso'],'saldo'=>$dados['saldo']
						,'status'=>$dados['status'],'tipo'=>$dados['tipo']);
				}
		}
		$this->arrayacessoDespesas = $todos;
		$this->arrayDespDisp = $dispDesp;
	}

	function dadosArray () {
		return $this->arrayacessoDespesas;
	}

	function listPlan () {
		return $this->arrayDespDisp;
	}

	function despesasArray ($mes,$ano) {
		$dadosCta = $this->arrayacessoDespesas;
		$mes = sprintf ("%'02u",$mes);
		$mesRelatorio = $ano.$mes;
		//SQL das despesas agendadas
		$sqlAgenda  = 'SELECT a.*,DATE_FORMAT(a.datapgto,"%d/%m/%Y") AS dtpgto, ';
		$sqlAgenda .= 'c.acesso, c.titulo, c.codigo,c.tipo,i.razao,c.nivel1, ';
		$sqlAgenda .= 'DATE_FORMAT(a.vencimento,"%d/%m/%Y") AS venc FROM agenda AS a ';
		$sqlAgenda .= ', contas AS c, igreja AS i ';
		$sqlAgenda .= 'WHERE (DATE_FORMAT(a.datapgto,"%Y%m")="'.$mesRelatorio.'" ';
		$sqlAgenda .= 'OR (DATE_FORMAT(a.vencimento,"%Y%m")="'.$mesRelatorio.'" AND a.idlanc="0") ) ';
		$sqlAgenda .= 'AND a.igreja=i.rol AND (c.acesso=a.debitar || c.acesso=a.creditar) ORDER BY a.datapgto,i.razao';
		$agenda = mysql_query($sqlAgenda) or die (mysql_error());
		while ($arrayAgenda = mysql_fetch_array($agenda)) {
			if ($arrayAgenda['debitar']==$arrayAgenda['acesso'] && $arrayAgenda['tipo']=='D') {
				$sldLanc = 'D';
			} elseif ($arrayAgenda['debitar']==$arrayAgenda['acesso'] && $arrayAgenda['tipo']=='C') {
				$sldLanc = 'D';
			}else {
				$sldLanc = 'C';
			}
			$agendaLanc [$arrayAgenda['idlanc']] = array('venc' => $arrayAgenda['venc'],
			'dtpgto' => $arrayAgenda['dtpgto'], 'idAgenda' => $arrayAgenda['id'],'sld' =>$sldLanc);
			if ($arrayAgenda['idlanc']=='0') {
				//Despesas agendadas e não pagas
				$arrayDespesas[] = array('id'=>$arrayAgenda['id'],'titulo'=>$arrayAgenda['titulo'],'codigo'=>$arrayAgenda['codigo']
				,'lancamento'=>$arrayAgenda['idlanc'],'debitar'=>$arrayAgenda['debitar']
				,'creditar'=>$arrayAgenda['creditar'],'valor'=>$arrayAgenda['valor']
				,'igreja'=>$arrayAgenda['razao'],'referente'=>$arrayAgenda['motivo']
				,'hist'=>$arrayAgenda['hist'],'acesso'=>$arrayAgenda['acesso']
				,'dtpgto'=>$arrayAgenda['dtpgto'],'vencimento'=>$arrayAgenda['venc'],'sld' =>$sldLanc);
			}
		}
		//print_r($agendaNaoPago);
		//SQL dos lançamentos realizados com despesas debitadas
		$sqlLancDesp  = 'SELECT l.*,i.razao, h.referente AS referente, ';
		$sqlLancDesp .= 'DATE_FORMAT(l.data,"%d/%m/%Y") AS dtLanc ';
		$sqlLancDesp .= 'FROM lanc AS l, igreja AS i, lanchist AS h ';
		$sqlLancDesp .= 'WHERE DATE_FORMAT(l.data,"%Y%m")="'.$mesRelatorio.'" ';
		$sqlLancDesp .= 'AND h.idlanca=l.lancamento ';
		$sqlLancDesp .= 'AND l.igreja=i.rol ORDER BY l.data,i.razao ';
		$despesa = mysql_query($sqlLancDesp) or die (mysql_error());
		while($dados = mysql_fetch_array($despesa)) {
			//Lançamento da Despesas
			$ctaDebito  = $dadosCta[$dados['debitar']]['codigo'];
			$ctaCredito = $dadosCta[$dados['creditar']]['codigo'];
			if ($dadosCta[$dados['debitar']]['tipo']=='D' ) {
			//Lançamento da Despesas e Imobilizado debitadas
				$sldLan ='D';
			}
			if ($dadosCta[$dados['creditar']]['tipo']=='D' ) {
		//lançamentos realizados com despesas e Imobilizado creditadas
				$sldLan ='C';
			}
		#	echo "....".$dadosCta[$dados['creditar']]['tipo'].' *** '.$ctaCredito.' == '.$dados['lancamento'];
		$vencAg = (!empty($agendaLanc[$dados['lancamento']]['venc'])) ? $agendaLanc[$dados['lancamento']]['venc'] : '' ;
		$dtPgtoAg = (!empty($agendaLanc[$dados['lancamento']]['dtpgto'])) ? $agendaLanc[$dados['lancamento']]['dtpgto'] : '' ;
		$dtIdAg = (!empty($agendaLanc[$dados['lancamento']]['idAgenda'])) ? $agendaLanc[$dados['lancamento']]['idAgenda'] : '0' ;
		//echo "<h4>".$agendaLanc[$dados['lancamento']]['idAgenda'].'===</h4>';
		$arrayDespesas[] = array('id'=>$dtIdAg
			,'lancamento'=>$dados['lancamento'],'debitar'=>$dados['debitar']
			,'creditar'=>$dados['creditar'],'valor'=>$dados['valor']
			,'igreja'=>$dados['razao'],'referente'=>$dados['referente']
			,'data'=>$dados['dtLanc'],'hist'=>$dados['hist']
			,'dtpgto'=>$dtPgtoAg,'vencimento'=>$vencAg,'sld'=>$sldLan
			,'acesso'=>$dadosCta[$dados['debitar']]['acesso'],'titulo'=>$dadosCta[$dados['debitar']]['titulo']
			,'codigo'=>$ctaDebito);
		//echo '*****'. $dados['debitar'].' +++';
	//	echo ' ||'. substr($ctaDebito, 0, 2).' ---';
		//print_r($dadosCta);
		}
	//	print_r($arrayDespesas);
		//echo '<br />Testando -- arrayDespesas<br /><br />';
		//print_r($arrayDespesas);
		return $arrayDespesas;
	}
}
?>
