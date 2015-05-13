<?php
class tes_relatLanc {

function __construct() {
		$this->var_string  = 'SELECT l.lancamento,DATE_FORMAT(l.data,"%d/%m/%Y") AS data,l.igreja,';
		$this->var_string .= 'l.valor,l.hist,l.referente,l.debitar,l.creditar, i.razao ';
		$this->var_string .= 'FROM lanc AS l, igreja AS i ';
		$this->var_string .= 'WHERE l.igreja=i.rol ';

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

	$opIgreja .= 'AND DATE_FORMAT(l.data,"%m%Y")="'.$mes.$ano.'" ORDER BY l.lancamento,l.debitar';
	$dquery = mysql_query($opIgreja) or die (mysql_error());

	$tabela = '<tbody id="periodo">';
	$lancAtual = '';  $lancamento = $lancAtual;$valorCaixaDeb=0;$CaixaDep='';

	while ($linha = mysql_fetch_array($dquery)) {
		$bgcolor = 'class="odd"';
		$lancAtual = $linha['lancamento'];

		if ($lancAtual!=$lancamento && $lancamento!='') { //Verificar se ainda estar no mesmo lançamento
			if ($valorCaixaDeb<=0) {
				$CaixaDep='';
			}

			//$bgcolor = $cor ? 'class="odd"' : 'class="odd3"';
			$valores='';
			$valorCaixaDeb = number_format($valorCaixaDeb,2,',','.');
			$lancValorCaixa = '<p id="moeda">'.$valorCaixaDeb.'C</p>';//Formata o valor p/ ser apresentado
			$dataLanc  = '<p><span class="badge">Data do Lan&ccedil;amento: ';
			$dataLanc  .= $dtLanc.' </span> <span class="badge">'.$numLanc.'</span></p>';
			$referente .= $dataLanc;
			$referente .= $CaixaDep.$titulo1;
			$historico  = '<tr><td colspan="2"><strong>Hist&oacute;rico:</strong>'.$historico.'</td></tr>';
			$tabela .= '<tr '.$bgcolor.'><td colspan="2">'.$referente.$historico.'</td></tr>';
			//$cor = !$cor;
			$referente  = '';
			$titulo1  = '';$lancValor = '';$valorCaixaDeb=0;$historico='';
		}

		$dtLanc = $linha['data'];
		if ($histAnterior!=$linha['referente']) {
			$historico  .= '<p>'.$linha['referente'].', '
						.$dadosIgreja[$linha['igreja']]['nome'].'</p>';
		}
		$lancamento = $lancAtual;
		$histAnterior = $linha['referente'];

			$valorCaixaDeb += $linha['valor'];
			$CaixaDep  = '<tr><td>'.$conta[$linha['debitar']]['codigo'].' &bull; '
							.$conta[$linha['debitar']]['titulo']
							.'</td><td class="text-right">'.number_format($valorCaixaDeb,2,',','.').'</td></tr>';

			$titulo1  .= '<tr><td>'.$conta[$linha['creditar']]['codigo'].' &bull; '
							.$conta[$linha['creditar']]['titulo']
							.'</td><td class="text-right">'.number_format($linha['valor'],2,',','.').'</td></tr>';
			$valor = number_format($linha['valor'],2,',','.');
			$valores ='<p id="moeda">'.$valor.' D</p>';//Valores das demais cta's que não sejam do caixa
			$lancValor .= $valores;

		$numLanc = sprintf ("N&ordm;: %'05u",$lancamento);

		}

		if ($titulo1 != '') {
			$dataLanc  = '<p><span class="badge">Data do Lan&ccedil;amento: ';
			$dataLanc  .= $dtLanc.'</span> <span class="badge">'.$numLanc.'</span></p>';
			$referente .= $dataLanc.$titulo1;
			$tabela .= '<tr '.$bgcolor.'><td>'.$referente.$historico.'</td>
			<td id="moeda">'.$lancValor.'</td></tr>';
		}

	$resultado = array($tabela,$lancConfirmado);
	return $resultado;
	}

}
