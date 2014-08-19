<?php
class tes_relatorioLanc {
	
function __construct() {
		$this->var_string  = 'SELECT l.lancamento,DATE_FORMAT(l.data,"%d/%m/%Y") AS data,l.igreja,';
		$this->var_string .= 'l.valor,l.hist,i.referente,l.conta,l.d_c ';
		$this->var_string .= 'FROM lancamento AS l, lanchist AS i ';
		$this->var_string .= 'WHERE l.lancamento=i.idlanca ';
		
	}
	
function histLancamentos ($igreja,$mes,$ano) {
	
	$queryContas = mysql_query('SELECT id,acesso,titulo,codigo FROM contas') or die (mysql_error());
	while ($ctas = mysql_fetch_array($queryContas)) {
		$conta[$ctas['id']] = array ('acesso'=>$ctas['acesso'],'titulo'=>$ctas['titulo'],'codigo'=>$ctas['codigo']);
	}
	
	$queryIgrejas = mysql_query('SELECT rol,razao FROM igreja') or die (mysql_error());
	while ($igrejaNome = mysql_fetch_array($queryIgrejas)) {
		$dadosIgreja[$igrejaNome['rol']] = array ('nome'=>$igrejaNome['razao']);
	}
	
	//print_r ($conta);
	if ($igreja>'0' ) {
		$opIgreja= $this->var_string.' AND l.igreja = "'.$igreja.'"';
	}else {
		$opIgreja = $this->var_string;
	}
	
	$opIgreja .= 'AND DATE_FORMAT(l.data,"%m%Y")="'.$mes.$ano.'" ORDER BY l.lancamento,l.id';
	$dquery = mysql_query($opIgreja) or die (mysql_error());
		
	$tabela = '<tbody id="periodo">';
	$lancAtual = '';  $lancamento = $lancAtual;
	
	while ($linha = mysql_fetch_array($dquery)) {
		$bgcolor = $cor ? 'class="odd"' : 'class="odd3"';
		
		$lancAtual = $linha['lancamento'];
		
		if ($lancAtual!=$lancamento && $lancamento!='') {
			$dataLanc  = '<p><span class="badge">Data do Lan&ccedil;amento: ';
			$dataLanc  .= $linha['data'].'</span> <span class="badge">'.$numLanc.'</span></p>';
			$referente .= $dataLanc.$titulo1;
			$tabela .= '<tr '.$bgcolor.'><td>'.$referente.$historico.'</td>
			<td>'.$lancValor.'</td></tr>';
			$cor = !$cor;
			$referente  = '';
			$titulo1  = '';$lancValor = '';
		}
		
		$historico  = '<p>Hist&oacute;rico: '.$linha['referente'].', '.$dadosIgreja[$linha['igreja']]['nome'].'</p>';
		$lancamento = $lancAtual;
		$titulo1  .= '<p>'.$conta[$linha['conta']]['codigo'].' &bull; '.$conta[$linha['conta']]['titulo'].'</p>';
		$valor = number_format($linha['valor'],2,',','.');
		$lancValor .= '<p id="moeda">'.$valor.' '.$linha['d_c'].'</p>';		
		$numLanc = sprintf ("N&ordm;: %'05u",$lancamento);
		
		}
		
		if ($titulo1 != '') {
			$dataLanc  = '<p><span class="badge">Data do Lan&ccedil;amento: ';
			$dataLanc  .= $linha['data'].'</span> <span class="badge">'.$numLanc.'</span></p>';
			$referente .= $dataLanc.$titulo1;
			$tabela .= '<tr '.$bgcolor.'><td>'.$referente.$historico.'</td>
			<td id="moeda">'.$lancValor.'</td></tr>';
		}
		
	$resultado = array($tabela,$lancConfirmado);
	
	return $resultado;
	}
	
}
