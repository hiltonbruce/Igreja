<?php
class dizresp {

function __construct($tesoureiro='',$print='',$tipoCons='',$setor='') {
		$this->var_string  = "SELECT d.id,d.rol,DATE_FORMAT(d.data,'%d/%m/%Y') AS data,d.congcadastro,";
		$this->var_string .= "d.nome,d.mesrefer,d.anorefer,d.tipo,d.valor,d.obs,i.razao,d.credito,d.tesoureiro, ";
		$this->var_string .= "d.confirma,i.rol AS rolIgreja,d.hist FROM dizimooferta AS d, igreja AS i ";
		$this->tesoureiro = $tesoureiro;
		$this->impressao = ($print==true) ? true:false;
	// Array com os dados da tabela contas
	$sqlcontas = mysql_query( 'SELECT * FROM contas WHERE acesso>"0" ORDER BY acesso' ) or die (mysql_error());
	while ($linhaCta = mysql_fetch_array($sqlcontas)) {
		$this->arrayContas[$linhaCta['acesso']] = array('id' => $linhaCta['codigo'], 'titulo' => $linhaCta['titulo'],
			'saldo' => $linhaCta['saldo']
			);
	}
	//Array com os dados da tabela igreja
	$sqlIgreja = mysql_query( 'SELECT * FROM igreja' ) or die (mysql_error());
	while ($linhaIgr = mysql_fetch_array($sqlIgreja)) {
		$this->arrayIgrejas[$linhaIgr['rol']] = array('razao' => $linhaIgr['razao'], 'pastor' => $linhaIgr['pastor'],
			'rua' => $linhaIgr['rua']
			);
	}
	$this->setor = $setor;
	$this->rec = $tipoCons;
}

function dizimistas(
	$igreja,
	$linkLancamento,
	$dia,
	$mes,
	$ano,
	$tipo,
	$cred,
	$deb,
	$linkAlterar) {
	$dataValid = (checadata($dia.'/'.$mes.'/'.$ano)) ? $ano.'-'.$mes.'-'.$dia:false;
	if ($igreja == '') {
		$filtroIgreja = '';
	} else {
		$filtroIgreja = ' AND d.igreja="'.$igreja.'"';
	}
	if ($mes>'0' && $mes<='12') {
		$consMes = ' AND DATE_FORMAT(data, "%m") = '.$mes;
	}else {
			$consMes = '';
	}
	if ($dia>0 && $dia<=31) {
		$consDia = ' AND DATE_FORMAT(data, "%d") = '.$dia;
	}else {
		$consDia = '';
	}
	if ($tipo=='9' || $tipo =='0') {
		$conTipos = true;
	}else {
		$consTipos =false;
	}
	//Monta a query para consulta de conta pelo nº de acesso
	$queryAcesso = '';
	if (!empty($cred)) {
		$acessos = explode(',', $cred);
		$concatenar = ' ';
		foreach ($acessos as $numAcesso) {
			$queryCred .= $concatenar.'credito="'.intval($numAcesso).'"';
			$concatenar = ' OR ';
		}
		$queryCred = ' AND ('.$queryCred.')';
	}else {
		$queryCred = '';
	}
	if (!empty($deb)) {
		$acessos = explode(',', $deb);
		$concatenar = ' ';
		foreach ($acessos as $numAcesso) {
			$queryDeb .= $concatenar.'devedora="'.intval($numAcesso).'"';
			$concatenar = ' OR ';
		}
		$queryDeb = ' AND ('.$queryDeb.')';
	}else {
		$queryDeb = '';
	}
	$queryAcesso = $queryCred.$queryDeb;
	//Gera a query de busca
	$incluiPessoa ='';
	if (!empty($_GET['nome']) || $_GET['rol']>='0' ) {
		$nome = trim($_GET['nome']);
		if ($_GET['rol']>0) {
			$incluiPessoa =' AND d.rol = "'.(int)$_GET['rol'].'" ';
		}elseif ((strlen($_GET['nome']))>'3'){
			$incluiPessoa =' AND d.nome LIKE "%'.$nome.'%" ';
		}elseif (!empty($_GET['membro']) && $_GET['membro']==true) {
			$incluiPessoa =' AND d.nome = "" AND d.rol = "0" ';
		}elseif ($_GET['rol']=='0'){
			$incluiPessoa =' AND d.nome = "" AND d.rol = "0" ';
		}
	}
		$ordenar ='';
		if ($dataValid && $conTipos) {
			$consulta  = $this->var_string.'WHERE d.lancamento>"0" ';
			$consulta .= $incluiPessoa;
			$consulta .= $queryAcesso;
			$consulta .= ' AND d.data = "'.$dataValid.'"';
			$consulta .= $filtroIgreja.' AND d.igreja = i.rol';
			$ordenar = ' ORDER BY d.data DESC';
			$lancConfirmado = true;
		}elseif ($ano>'2000' && $ano<'2050' && $conTipos) {
			$consulta  = $this->var_string.'WHERE d.lancamento>"0" ';
			$consulta .= $incluiPessoa;
			$consulta .= $queryAcesso;
			$consulta .= $consMes.$consDia.' AND DATE_FORMAT(data, "%Y") ='.$ano;
			$consulta .= $filtroIgreja.' AND d.igreja = i.rol';
			$ordenar = ' ORDER BY d.data DESC,d.tesoureiro,d.igreja,d.id';
		//$this->dquery = mysql_query( $consulta ) or die (mysql_error());
			$lancConfirmado = true;
		}elseif ($ano=='0') {
			$consulta  = $this->var_string.'WHERE d.lancamento>"0" ';
			$consulta .= $incluiPessoa;
			$consulta .= $queryAcesso;
			$consulta .= $consMes.$consDia.$filtroIgreja.' AND d.igreja = i.rol';
			$ordenar = ' ORDER BY d.data DESC,d.igreja,d.id';
			//$this->dquery = mysql_query( $consulta ) or die (mysql_error());
			$lancConfirmado = true;
		}elseif ($incluiPessoa!='') {
			$consulta = $this->var_string.'WHERE d.igreja = i.rol '.$consMes.$consDia.$incluiPessoa.$queryAcesso.$filtroIgreja;
			$ordenar =' ORDER BY d.data DESC,d.tesoureiro,d.igreja,d.id';
		//	$this->dquery  = mysql_query($consult.'ORDER BY d.data DESC,d.tesoureiro,d.igreja,d.id ') or die (mysql_error());
			$lancConfirmado = true;
		} elseif (($consMes!='' || $consDia!='') && $rec!='1' && $rec!='') {
			$consulta = $this->var_string.'WHERE d.igreja = i.rol '.$consMes.$consDia.$filtroIgreja;
			$ordenar =' ORDER BY d.data DESC,d.tesoureiro,d.igreja,d.id';
			$lancConfirmado = true;
		}else {
			$consulta  = $this->var_string.' WHERE d.lancamento="0" '.$queryAcesso;
			$consulta .= $filtroIgreja.' AND d.igreja = i.rol';
		//	$this->dquery = mysql_query($this->var_string.'WHERE d.lancamento="0"'.$queryAcesso.
		//	$filtroIgreja.' AND d.igreja = i.rol') or die (mysql_error());
			$ordenar = ' ORDER BY d.tesoureiro,d.data DESC,d.igreja,d.id';
			$lancConfirmado = false;
		}
		if ($this->setor!='') {
			$consulta .=' AND d.confirma='.$this->setor;
		}
		if (empty($_GET['semana']) || $_GET['semana']>'5' || $_GET['semana']<'1' ) {
			$conSeman = '';
		} else {
			$semGet = intval($_GET['semana']);
			$conSeman = ' AND semana="'.$semGet.'"';
		}
		$this->dquery = mysql_query( $consulta.$conSeman.$ordenar ) or die (mysql_error());
		$total = 0;
		$tabela = '';
		$depto = new setores();
		$dadoDepto = $depto->arrayDepto();
		while ($linha = mysql_fetch_array($this->dquery)) {
			//echo $linha['id'].'===='..' -> Valor: R$ '.$linha['valor'].'<br />';
			//$mostracta = new DBRecord ('contas',$linha['credito'],'acesso');//Traz os da conta p/ mostrar coluna tipo
			$tipo = $this->arrayContas[$linha['credito']]['titulo'];//Define o titulo para a variï¿½vel
			if ($linha['obs']!='') {
				$tipo1 = '<span title="'.$linha['obs'].'" data-toggle="tooltip" data-placement="top">';
				$tipo = $tipo1.$tipo.' <span class="glyphicon glyphicon-paperclip"></span> </span></span>';
			}
			$valor = number_format($linha['valor'],2,',','.');
			if ($linha['confirma']=='') {
				$status = 'Pedente';
			}else {
				$status = 'Confimado!';
			}
			$rol = $linha['nome']<>'' ? $linha['rol'] : 'An&ocirc;nimo';
			//Criar link para alteraï¿½ï¿½o pelo cadastrador - Realizar critica tb qdo abrir
			if ($_SESSION["valid_user"]==$linha['tesoureiro'] && !$lancConfirmado) {
				if (!empty($_GET['tipo']) && $_GET['tipo']==1) {
					$corrigir = $valor;
				}else {
					$corrigir = $valor.'&nbsp;&nbsp;<a href="'.$linkAlterar.$linha['id'];
					$corrigir .= '&igreja='.$linha['rolIgreja'].'"';
					$corrigir .= ' title="Alterar!" data-toggle="tooltip" data-placement="left">';
					$corrigir .= '<span class="glyphicon glyphicon-edit" aria-hidden="true">';
					$corrigir .= '</span></a>&nbsp;<a href="'.$linkLancamento.$linha['id'].'" ';
					$corrigir .= 'title="Apagar!" data-toggle="tooltip" data-placement="right">';
					$corrigir .= '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>';
				}
			}else {
				$corrigir = $valor;
			}
			if ($congMembro!=$linha['congcadastro'] ) {
				$congMembro = $linha['congcadastro'];
				//$dadosCongMembro = new DBRecord ('igreja',$linha['congcadastro'],'rol');
				$nomeCongMembro = $this->arrayIgrejas[$linha['congcadastro']]['razao'];
			}
			#Formata exibiï¿½ï¿½o de ano e mï¿½s de referï¿½ncia
			$mesAno = sprintf (", ref.:  %'02u/%'04u",$linha['mesrefer'],$linha['anorefer']);
			if ( $this->impressao) {
				$linkMembro= $rol.' - '.$linha['nome'].$mesAno;
			}else {
				list($lancCPF,$lancNome) = explode(':', $linha['hist']);
				$linkMembro  = '<a  data-toggle="tooltip" data-placement="top" href="';
				$linkMembro .= './?escolha=views/tesouraria/saldoMembros.php&id='.$linha['id'].'&bsc_rol='.$rol;
				$linkMembro .= '" title="Congrega: '.$nomeCongMembro.' - Lan&ccedil;. por: '.$lancNome.'">';
				$linkMembro .= $rol.' - '.$linha['nome'].$mesAno.'</a>';
			}
			$tabela .= '<tr><td>'.$linha['data'].'</td>';
			$tabela .= '<td>'.$linkMembro.'</td>';
			$tabela .= '<td>'.$tipo.'</td>';
			$tabela .= '<td class="text-center small">'.$dadoDepto[$linha['confirma']]['alias'].'</td>';
			$tabela .= '<td class="text-right">'.$corrigir.'</td>';
			$tabela .= '<td class="text-center">'.$linha['razao'].'</td></tr>';
						$total += $linha['valor'];
		}
		$total = number_format($total,2,',','.');
		$tabela .=  '';
		if ($total==0) {
		$tabela .=  '<tfoot><tr id="total"><td colspan="6">N&atilde;o h&aacute; ';
		$tabela .=  'lan&ccedil;amentos para esta busca ou pendentes!</td></tr></tfoot>';
		}else {
		$tabela .=  '<tfoot><tr id="total"><td colspan="5" class="text-right">';
		$tabela .=  'Total&nbsp;&nbsp;............ &nbsp;&nbsp;'.$total;
		$tabela .=  '</td><td></td></tr></tfoot>';
		}
		$resultado = array($total,$tabela,$lancConfirmado);
		return $resultado;
	}

function outrosdizimos ($igreja) {
	if ($igreja=='') {
		$filtroIgreja = '';
	} else {
		$filtroIgreja = 'AND igreja="'.$igreja.'"';
	}
	$queryCons  = 'SELECT SUM(valor) AS valor FROM dizimooferta ';
	$queryCons .= 'WHERE tesoureiro<>"'.$this->tesoureiro.'" AND lancamento="0" '.$filtroIgreja;
	$this->dquery = mysql_query($queryCons ) or die (mysql_error());
	$outrosdiz = mysql_fetch_array($this->dquery);
	$totoutros = $outrosdiz['valor'];
	return $totoutros;
	}

function totaldizimos () {
		$this->dquery = mysql_query("SELECT SUM(valor) AS valor FROM dizimooferta WHERE tipo = '1' AND lancamento='0' ") or die (mysql_error());
		$outrosdiz = mysql_fetch_array($this->dquery);
		$totoutros = $outrosdiz['valor'];
		return $totoutros;
	}

function votos () {
		$this->dquery = mysql_query("SELECT SUM(valor) AS valor FROM dizimooferta WHERE tipo = '4' AND lancamento='0' ") or die (mysql_error());
		$votos = mysql_fetch_array($this->dquery);
		$totvotos = $votos['valor'];
		return $totvotos;
	}

function ofertas () {
		$this->dquery = mysql_query("SELECT SUM(valor) AS valor FROM dizimooferta WHERE tipo = '2' AND lancamento='0' ") or die (mysql_error());
		$oferta = mysql_fetch_array($this->dquery);
		$totofertas = $oferta['valor'];
		return $totofertas;
	}

function ofertaextra () {
		$this->dquery = mysql_query("SELECT SUM(valor) AS valor FROM dizimooferta WHERE tipo = '3' AND lancamento='0' ") or die (mysql_error());
		$oferta = mysql_fetch_array($this->dquery);
		$totofertas = $oferta['valor'];
		return $totofertas;
	}
function ofertamissoes () {
		$this->dquery = mysql_query("SELECT SUM(valor) AS valor FROM dizimooferta WHERE tipo = '5' AND lancamento='0' ") or die (mysql_error());
		$oferta = mysql_fetch_array($this->dquery);
		$totofertas = $oferta['valor'];
		return $totofertas;
	}

function totalgeral () {
		$this->dquery = mysql_query("SELECT SUM(valor) AS valor FROM dizimooferta WHERE lancamento='0' ") or die (mysql_error());
		$oferta = mysql_fetch_array($this->dquery);
		$totofertas = $oferta['valor'];
		return $totofertas;
	}

function caixageral () {
		$this->dquery = mysql_query("SELECT SUM(valor) AS valor FROM dizimooferta WHERE devedora = '1' AND lancamento='0' ") or die (mysql_error());
		$oferta = mysql_fetch_array($this->dquery);
		$totofertas = $oferta['valor'];
		return $totofertas;
	}

function debitar ($devedora) {
		$this->dquery = mysql_query("SELECT SUM(valor) AS valor FROM dizimooferta WHERE devedora = '$devedora' AND lancamento='0' ") or die (mysql_error());
		$oferta = mysql_fetch_array($this->dquery);
		$totofertas = $oferta['valor'];
		return $totofertas;
	}

function caixamissoes () {
		$this->dquery = mysql_query("SELECT SUM(valor) AS valor FROM dizimooferta WHERE devedora = '2' AND lancamento='0' ") or die (mysql_error());
		$oferta = mysql_fetch_array($this->dquery);
		$totofertas = $oferta['valor'];
		return $totofertas;
	}

function concluir($igreja) {
		$this->dquery = mysql_query($this->var_string.'WHERE d.lancamento="0" AND confirma="2" AND
		 d.igreja="'.$igreja.'" AND d.igreja=i.rol ORDER BY tesoureiro,tipo,nome ') or die (mysql_error());
		$totaltes=0;
		$depto = new setores();
		$dadoDepto = $depto->arrayDepto();
		$tabLancamento =  '<tbody id="periodo" >';
		while ($linha = mysql_fetch_array($this->dquery)) {
			//echo $linha['id'].'===='..' -> Valor: R$ '.$linha['valor'].'<br />';
			//$mostracta = new DBRecord ('contas',$linha['credito'],'acesso');//Traz os da conta p/ mostrar coluna tipo
			$tipo = $this->arrayContas[$linha['credito']]['titulo'];//Define o titulo para a variï¿½vel
			//$tesoureiro = $linha['tesoureiro'];
			$vlr = $linha['valor'];
			$valor = number_format($vlr,2,',','.');
			if ($linha['lancamento']=='' || $linha['lancamento']=='0') {
				$status = 'Pedente';
			}else {
				$status = 'Confimado!';
			}
			$rol = $linha['nome']<>'' ? $linha['rol'].' - '.$linha['nome'] : 'An&ocirc;nimo';
			if ($tesoureiro!=$linha['tesoureiro']) {
				if ($totaltes!='0') {
				$tabLancamento .= sprintf("<tr id='total'><td colspan='2' class='text-left'>
				%s</td><td colspan='3' class='text-right'>
						Total: <span class='glyphicon glyphicon-arrow-right' aria-hidden='true'></span> &nbsp;&nbsp;<b>%s</b></td><td></td></tr>"
						,$dadostesoureiro->nome(),number_format($totaltes,2,',','.'));}
				$tesoureiro = $linha['tesoureiro'];
				$dadostesoureiro = new DBRecord('usuario',$tesoureiro, 'cpf');
				$tabLancamento .= sprintf('<tr class="danger"><td colspan="6" class="text-right">
						<b> %s </b></td></tr>',$dadostesoureiro->nome());
				$totaltes = 0;
				//echo '<tr style="background:'.$bgcolor.'"><td>'.$linha['data'].'</td><td>'.$rol.' - '.$linha['nome'].'</td><td>'.$tipo.'</td><td style="text-align:right;">'.$valor.'</td><td>'.$status.'</td></tr>';
			}
			$totaltes += $vlr;
			$tabLancamento .= '<tr><td>'.$linha['data'].'</td>';
			$tabLancamento .= '<td>'.$rol.'</td>';
			$tabLancamento .= '<td>'.$tipo.'</td>';
			$tabLancamento .= '<td class="small">'.$dadoDepto[$linha['confirma']]['alias'].'</td>';
			$tabLancamento .= '<td class="text-right">'.$valor.'</td>';
			$tabLancamento .= '<td>'.$status.'</td></tr>';
			$total += $linha['valor'];
		}
		$total = number_format($total,2,',','.');
		$tabLancamento .= sprintf("<tr id='total'><td colspan='2' class='text-left'>
		%s</td><td colspan='3' class='text-right'>Total: <span class='glyphicon glyphicon-arrow-right' aria-hidden='true'></span>&nbsp;
		&nbsp;<b>%s</b></td><td></td></tr>",$dadostesoureiro->nome(),number_format($totaltes,2,',','.'));
		$tabLancamento .=  '</tbody>';
		$tabLancamento .=  '<tfoot><tr class="primary"><td  colspan="3"
		class="text-right">Total Geral:</td><td colspan="2" class="text-right"
		><strong> R$ '.$total.'</strong></td><td></td></tr></tfoot>';
		return $tabLancamento;
	}
}
