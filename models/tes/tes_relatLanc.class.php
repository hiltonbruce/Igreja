<?php
class tes_relatLanc {

function __construct() {
		$this->var_string  = 'SELECT l.lancamento,DATE_FORMAT(l.data,"%d/%m/%Y") AS data,l.igreja,';
		$this->var_string .= 'l.valor,l.hist,h.referente,l.debitar,l.creditar, i.razao ';
		$this->var_string .= 'FROM lanc AS l, igreja AS i, lanchist AS h ';
		$this->var_string .= 'WHERE l.igreja=i.rol AND l.lancamento=h.idlanca ';

	}

function histLancamentos ($igreja,$mes,$ano,$dia,$cta,$deb,$cred,$ref) {

	$queryContas = mysql_query('SELECT id,acesso,titulo,codigo FROM contas') or die (mysql_error());
	while ($ctas = mysql_fetch_array($queryContas)) {
		$conta[$ctas['id']] = array ('acesso'=>$ctas['acesso'],'titulo'=>$ctas['titulo'],'codigo'=>$ctas['codigo']);
	}
/*
	$queryIgrejas = mysql_query('SELECT rol,razao FROM igreja') or die (mysql_error());
	while ($igrejaNome = mysql_fetch_array($queryIgrejas)) {
		$dadosIgreja[$igrejaNome['rol']] = array ('nome'=>$igrejaNome['razao']);
	}
*/
	//print_r ($conta);
	#Filtro por igreja
	if ($igreja>'0' ) {
		$opIgreja= $this->var_string.'AND l.igreja = "'.$igreja.'" ';
	}else {
		$opIgreja = $this->var_string;
	}

	#Filtro por data
	$dataFiltro = $dia.'/'.$mes.'/'.$ano;
	if (checadata ($dataFiltro)) {
		$opIgreja .= 'AND DATE_FORMAT(l.data,"%d%m%Y")="'.$dia.$mes.$ano.'" ';
	}elseif ($mes>'0' && $mes<'13' && ($ano=='' || $ano<'2011')) {
		$opIgreja .= 'AND DATE_FORMAT(l.data,"%m")="'.$mes.'" ';
	} else {
		$opIgreja .= 'AND DATE_FORMAT(l.data,"%m%Y")="'.$mes.$ano.'" ';
	}

	#filtro por conta
	if ($cta!='') {
		if ($deb=='1' && $cred=='') {
			$opIgreja .= 'AND debitar="'.$cta.'" ';
		}elseif ($cred=='1' && $deb=='') {
			$opIgreja .= 'AND creditar="'.$cta.'" ';
		}else {
			$opIgreja .= 'AND (creditar="'.$cta.'" OR debitar="'.$cta.'") ';
		}

		//$opIgreja .= 'AND DATE_FORMAT(l.data,"%m%Y")="'.$mes.$ano.'" ';
	}

	#Filtro para campo referente
	if ($ref!='') {
		$opIgreja .= 'AND referente LIKE "%'.$ref.'%" ';
	}
	$opIgreja .= 'ORDER BY l.data,l.lancamento,l.debitar ';
	$dquery = mysql_query($opIgreja) or die (mysql_error());

	$tabela = '<tbody>';
	$lancAtual = '';  $lancamento = $lancAtual;$valorCaixaDeb=0;$CaixaCentral='';
	$CaixaMissoes ='';$CaixaOutros='';$vlrTotal =0;

	while ($linha = mysql_fetch_array($dquery)) {
		//$bgcolor = 'class="odd"';
		$lancAtual = $linha['lancamento'];

		if ($lancAtual!=$lancamento && $lancamento!='') { //Verificar se ainda estar no mesmo lançamento
			if ($valorCaixaDeb<=0) {
				$CaixaDep='';
			}

			//$bgcolor = $cor ? 'class="odd"' : 'class="odd3"';
			$valores='';
			$valorCaixaDeb = number_format($valorCaixaDeb,2,',','.');
			$lancValorCaixa = '<p id="moeda">'.$valorCaixaDeb.'C</p>';//Formata o valor p/ ser apresentado
			$dataLanc  = '<span class="badge">Data do Lan&ccedil;amento: ';
			$dataLanc  .= $dtLanc.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$numLanc.'</span>';
			$referente .= $dataLanc;
			$referente .= $CaixaCentral.$CaixaMissoes.$CaixaOutros.$titulo1;
			$historico  = '<tr class=""><td colspan="2"><strong>Hist&oacute;rico:</strong>'.$historico.'</td></tr>';
			$tabela .= '<tr class="active"><td colspan="2">'.$referente.'</td></tr>'.$historico;
			//$cor = !$cor;
			$referente  = '';$CaixaMissoes ='';$CaixaOutros='';$valorMissoes=0;
			$titulo1  = '';$lancValor = '';$valorCentral=0;$historico='';$CaixaCentral='';

		}

		$dtLanc = $linha['data'];
		//Texto do histórico de cada lançamento
		$historico  .= '<p>'.$linha['referente'].', '.$linha['razao'].'</p>';

		$lancamento = $lancAtual;
		$histAnterior = $linha['referente'];

			if ($conta[$linha['debitar']]['codigo']=='1.1.1.001.001') {
				# Acumula o total para o Caixa Central
				$valorCentral += $linha['valor'];
				$CaixaCentral  = '<tr><td>'.$conta[$linha['debitar']]['codigo'].' &bull; '
					.$conta[$linha['debitar']]['titulo']
					.'</td><td class="text-right">'.number_format($valorCentral,2,',','.').'D</td></tr>';
			} elseif ($conta[$linha['debitar']]['codigo']=='1.1.1.001.002') {
				# Acumula o total para o Caixa Missões
				$valorMissoes += $linha['valor'];
				$CaixaMissoes  = '<tr><td>'.$conta[$linha['debitar']]['codigo'].' &bull; '
					.$conta[$linha['debitar']]['titulo']
					.'</td><td class="text-right">'.number_format($valorMissoes,2,',','.').'D</td></tr>';

			}else {
				# Cria a linha dos demais débitos
				$valorOutros = $linha['valor'];
				$CaixaOutros  .= '<tr><td>'.$conta[$linha['debitar']]['codigo'].' &bull; '
					.$conta[$linha['debitar']]['titulo']
					.'</td><td class="text-right">'.number_format($valorOutros,2,',','.').'D</td></tr>';

			}

			$titulo1  .= '<tr><td>'.$conta[$linha['creditar']]['codigo'].' &bull; '
							.$conta[$linha['creditar']]['titulo']
							.'</td><td class="text-right">'.number_format($linha['valor'],2,',','.').'C</td></tr>';
			$valor = number_format($linha['valor'],2,',','.');
			//$valores ='<p id="moeda">'.$valor.' D</p>';//Valores das demais cta's que não sejam do caixa
			//$lancValor .= $valores;

		$numLanc = sprintf ("N&ordm;: %'05u",$lancamento);
		$vlrTotal +=$linha['valor'];

		}

		if ($titulo1 != '') {
			$dataLanc  = '<p><span class="badge">Data do Lan&ccedil;amento: ';
			$dataLanc  .= $dtLanc.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$numLanc.'</span></p>';
			$referente .= $dataLanc.$CaixaCentral.$CaixaMissoes.$CaixaOutros.$titulo1;
			$historico = '<tr><td colspan="2"><strong>Hist&oacute;rico:</strong>'.$historico.'</td></tr>';
			$tabela .= '<tr class="active"><td colspan="2">'.$referente.'</td></tr>'.$historico;
			$vlrTotal +=$linha['valor'];
		}

	$resultado = array($tabela,$lancConfirmado,$vlrTotal);
	return $resultado;
	}

}
