<?php
class tes_relatorioLanc {
	
function __construct() {
		$this->var_string  = 'SELECT l.lancamento,DATE_FORMAT(l.data,"%d/%m/%Y") AS data,l.igreja,';
		$this->var_string .= 'l.valor,l.hist,i.referente ';
		$this->var_string .= 'FROM lancamento AS l, lanchist AS i ';
		$this->var_string .= 'WHERE l.lancamento=i.idlanca';
		
	}
	
function histLancamentos ($igreja,$mes,$ano) {
	
	$queryContas = mysql_query('SELECT id,acesso,titulo FROM contas') or die (mysql_error());
	while ($ctas = mysql_fetch_array($queryContas)) {
		$conta [$cta['id']] = array ('acesso'=>$cta['acesso'],'titulo'=>$cta['titulo']);
	}
	
	if ($igreja=='0') {
		$opIgreja = '';
	}else {
		$opIgreja= ' AND l.igreja = "'.$igreja;
	}
	
	$opIgreja .= '" AND DATE_FORMAT(l.data,"%m%Y")="'.$mes.$ano.'" ORDER BY l.lancamento';
	$dquery = mysql_query($this->var_string.$opIgreja) or die (mysql_error());
		
	$tabela = '<tbody id="periodo">';
	$histLancamento = '';
	while ($linha = mysql_fetch_array($dquery)) {
						
		$valor = number_format($linha['valor'],2,',','.');
			
		$bgcolor = $cor ? '#d0d0d0' : '#ffffff';			
			
		if ($congMembro!=$linha['congcadastro'] ) {
			$congMembro = $linha['congcadastro'];
			$dadosCongMembro = new DBRecord ('igreja',$linha['igreja'],'rol');
			$nomeCongMembro = $dadosCongMembro->razao();
		}
		
		$histLancamento=$histAtual;
		
		if ($histLancamento!='' && $histLancamento!=$histAtual) {
			$referente = '<p>'.$histLancamento.'</p>';
			$tabela .= '<tr style="background:'.$bgcolor.'"><td>'.$referente.'</td>
			<td id="moeda">'.$valor.'</td></tr>';
		}
		
		$histAtual = $linha['referente'];
		
		
		$cor = !$cor;
		}
		
	$resultado = array($tabela,$lancConfirmado);
	return $resultado;
	}
	
}
