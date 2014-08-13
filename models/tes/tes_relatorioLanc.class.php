<?php
class tes_relatorioLanc {
	
function __construct() {
		$this->var_string  = 'SELECT l.lancamento,DATE_FORMAT(l.data,"%d/%m/%Y") AS data,l.igreja,';
		$this->var_string .= 'l.valor,l.hist,i.referente,l.conta,l.d_c ';
		$this->var_string .= 'FROM lancamento AS l, lanchist AS i ';
		$this->var_string .= 'WHERE l.lancamento=i.idlanca';
		
	}
	
function histLancamentos ($igreja,$mes,$ano) {
	
	$queryContas = mysql_query('SELECT id,acesso,titulo,codigo FROM contas') or die (mysql_error());
	while ($ctas = mysql_fetch_array($queryContas)) {
		$conta[$ctas['id']] = array ('acesso'=>$ctas['acesso'],'titulo'=>$ctas['titulo'],'codigo'=>$ctas['codigo']);
	}
	//print_r ($conta);
	if ($igreja=='0') {
		$opIgreja = '';
	}else {
		$opIgreja= ' AND l.igreja = "'.$igreja;
	}
	
	$opIgreja .= '" AND DATE_FORMAT(l.data,"%m%Y")="'.$mes.$ano.'" ORDER BY l.lancamento,l.id';
	$dquery = mysql_query($this->var_string.$opIgreja) or die (mysql_error());
		
	$tabela = '<tbody id="periodo">';
	$lancAtual = '';  $lancamento = $lancAtual;
	
	while ($linha = mysql_fetch_array($dquery)) {
		$bgcolor = $cor ? '#d0d0d0' : '#ffffff';		
		if ($congMembro!=$linha['congcadastro'] ) {
			$congMembro = $linha['congcadastro'];
			$dadosCongMembro = new DBRecord ('igreja',$linha['igreja'],'rol');
			$nomeCongMembro = $dadosCongMembro->razao();
		}
		
		
		$lancAtual = $linha['lancamento'];
		
		if ($lancAtual!=$lancamento && $lancamento!='') {
			$dataLanc  = '<p>Data do Lan&ccedil;amento: '.$linha['data'].'</p>';
			$referente .= $dataLanc.$titulo1;
			$tabela .= '<tr style="background:'.$bgcolor.'"><td>'.$referente.$historico.'</td>
			<td id="moeda">'.$lancValor.'</td></tr>';
			$cor = !$cor;
			$referente  = '';
			$titulo1  = '';$lancValor = '';
		}
		
		$historico  = '<p>Hist&oacute;rico: '.$linha['referente'].'</p>';
		$lancamento = $lancAtual;
		$titulo1  .= '<p>'.$conta[$linha['conta']]['codigo'].' - '.$conta[$linha['conta']]['titulo'].' - '.$linha['d_c'].'</p>';
		$valor = number_format($linha['valor'],2,',','.');
		$lancValor .= '<p>'.$valor.' '.$linha['d_c'].'</p>';
		
		
		}
		
	$resultado = array($tabela,$lancConfirmado);
	return $resultado;
	}
	
}
