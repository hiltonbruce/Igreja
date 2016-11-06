<?php
class dizresp {

function __construct($tesoureiro='',$print='') {
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
	}
	if ($dia>0 && $dia<=31) {
		$consDia = ' AND DATE_FORMAT(data, "%d") = '.$dia;
	}
	if ($tipo=='9' || $tipo =='0') {
		$conTipos = true;
	}else {
		$consTipos =false;
	}
	//Monta a query para consulta de conta pelo n� de acesso
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
			$queryDeb .= $concatenar.'devedora="'.(int)$numAcesso.'"';
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
		if ($dataValid && $conTipos) {
			$consulta  = $this->var_string.'WHERE d.lancamento>"0" ';
			$consulta .= $incluiPessoa;
			$consulta .= $queryAcesso;
			$consulta .= ' AND d.data = "'.$dataValid.'"';
			$consulta .= $filtroIgreja.' AND d.igreja = i.rol ORDER BY d.data DESC ';
			$this->dquery = mysql_query( $consulta ) or die (mysql_error());
			$lancConfirmado = true;
		}elseif ($ano>'2000' && $ano<'2050' && $conTipos) {
			$consulta  = $this->var_string.'WHERE d.lancamento>"0" ';
			$consulta .= $incluiPessoa;
			$consulta .= $queryAcesso;
			$consulta .= $consMes.$consDia.' AND DATE_FORMAT(data, "%Y") ='.$ano;
			$consulta .= $filtroIgreja.' AND d.igreja = i.rol ORDER BY d.data DESC,d.tesoureiro,d.igreja,d.id ';
			$this->dquery = mysql_query( $consulta ) or die (mysql_error());
			$lancConfirmado = true;
		}elseif ($ano=='0') {
			$consulta  = $this->var_string.'WHERE d.lancamento>"0" ';
			$consulta .= $incluiPessoa;
			$consulta .= $queryAcesso;
			$consulta .= $consMes.$consDia.$filtroIgreja.' AND d.igreja = i.rol ORDER BY d.data DESC,d.igreja,d.id ';
			$this->dquery = mysql_query( $consulta ) or die (mysql_error());
			$lancConfirmado = true;
		}elseif ($incluiPessoa!='') {
			$consult = $this->var_string.'WHERE d.igreja = i.rol '.$incluiPessoa.$queryAcesso.$filtroIgreja;
			$this->dquery  = mysql_query($consult.'ORDER BY d.data DESC,d.tesoureiro,d.igreja,d.id ') or die (mysql_error());
			$lancConfirmado = true;
		}else {
			$this->dquery = mysql_query($this->var_string.'WHERE d.lancamento="0"'.$queryAcesso.
					$filtroIgreja.' AND d.igreja = i.rol ORDER BY d.tesoureiro,d.data DESC,d.igreja,d.id ') or die (mysql_error());
				$lancConfirmado = false;
		}
		$total = 0;
		$tabela = '';
		while ($linha = mysql_fetch_array($this->dquery)) {
			//echo $linha['id'].'===='..' -> Valor: R$ '.$linha['valor'].'<br />';
			//$mostracta = new DBRecord ('contas',$linha['credito'],'acesso');//Traz os da conta p/ mostrar coluna tipo
			$tipo = $this->arrayContas[$linha['credito']]['titulo'];//Define o titulo para a vari�vel
			if ($linha['obs']!='') {
				$tipo = '<span title="'.$linha['obs'].'"><span class="glyphicon glyphicon-paperclip"></span> '.$tipo.'</span>';
			}
			$valor = number_format($linha['valor'],2,',','.');
			if ($linha['confirma']=='') {
				$status = 'Pedente';
			}else {
				$status = 'Confimado!';
			}
			$rol = $linha['nome']<>'' ? $linha['rol'] : 'An&ocirc;nimo';
			//Criar link para altera��o pelo cadastrador - Realizar critica tb qdo abrir
			if ($_SESSION["valid_user"]==$linha['tesoureiro'] && !$lancConfirmado) {
				if ($_GET['tipo']==1) {
					$corrigir = $valor;
				}else {
					$corrigir = $valor.'&nbsp;&nbsp;<a href="'.$linkAlterar.$linha['id'].'&igreja='.$linha['rolIgreja'].'" title="Alterar!"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
						&nbsp;<a href="'.$linkLancamento.$linha['id'].'"
						title="Apagar!">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>';
				}
			}else {
				$corrigir = $valor;
			}
			if ($congMembro!=$linha['congcadastro'] ) {
				$congMembro = $linha['congcadastro'];
				//$dadosCongMembro = new DBRecord ('igreja',$linha['congcadastro'],'rol');
				$nomeCongMembro = $this->arrayIgrejas[$linha['congcadastro']]['razao'];
			}
			#Formata exibi��o de ano e m�s de refer�ncia
			$mesAno = sprintf (", ref.:  %'02u/%'04u",$linha['mesrefer'],$linha['anorefer']);
			if ( $this->impressao) {
				$linkMembro= $rol.' - '.$linha['nome'].$mesAno;
			}else {
				list($lancCPF,$lancNome) = explode(':', $linha['hist']);
				$linkMembro  = '<a href="';
				$linkMembro .= './?escolha=views/tesouraria/saldoMembros.php&id='.$linha['id'].'&bsc_rol='.$rol;
				$linkMembro .= '" title="Detalhar!(Congrega: '.$nomeCongMembro.' - Lan&ccedil;. por: '.$lancNome.')">';
				$linkMembro .= $rol.' - '.$linha['nome'].$mesAno.'</a>';
			}
			$tabela .= '<tr><td>'.$linha['data'].'</td>
				<td>'.$linkMembro.'</td><td>'.$tipo.'</td>
				<td class="text-right">'.$corrigir.'</td>
				 		<td class="text-center">'.$linha['razao'].'</td></tr>';
						$total += $linha['valor'];
		}
		$total = number_format($total,2,',','.');
		$tabela .=  '';
		if ($total==0) {
		$tabela .=  '<tfoot><tr id="total"><td colspan="5">N&atilde;o h&aacute; ';
		$tabela .=  'lan&ccedil;amentos para esta busca ou pendentes!</td></tr></tfoot>';
		}else {
		$tabela .=  '<tfoot><tr id="total"><td colspan="4" class="text-right">';
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
		$this->dquery = mysql_query($this->var_string.'WHERE d.lancamento="0" AND
		 d.igreja="'.$igreja.'" AND d.igreja=i.rol ORDER BY tesoureiro,tipo,nome ') or die (mysql_error());
		$totaltes=0;
		$tabLancamento =  '<tbody id="periodo" >';
		while ($linha = mysql_fetch_array($this->dquery)) {
			//echo $linha['id'].'===='..' -> Valor: R$ '.$linha['valor'].'<br />';
			//$mostracta = new DBRecord ('contas',$linha['credito'],'acesso');//Traz os da conta p/ mostrar coluna tipo
			$tipo = $this->arrayContas[$linha['credito']]['titulo'];//Define o titulo para a vari�vel
			//$tesoureiro = $linha['tesoureiro'];
			$vlr = $linha['valor'];
			$valor = number_format($vlr,2,',','.');
			if ($linha['confirma']=='') {
				$status = 'Pedente';
			}else {
				$status = 'Confimado!';
			}
			$rol = $linha['nome']<>'' ? $linha['rol'].' - '.$linha['nome'] : 'An&ocirc;nimo';
			if ($tesoureiro!=$linha['tesoureiro']) {
				if ($totaltes!='0') {
				$tabLancamento .= sprintf("<tr id='total'><td colspan='2' class='text-left'>
				%s</td><td colspan='3' class='text-right'>
						Total: %'.100s &nbsp;&nbsp;&nbsp;&nbsp;<b>%s</b></td></tr>"
						,$dadostesoureiro->nome(),'.',number_format($totaltes,2,',','.'));}
				$tesoureiro = $linha['tesoureiro'];
				$dadostesoureiro = new DBRecord('usuario',$tesoureiro, 'cpf');
				$tabLancamento .= sprintf('<tr><td colspan="5" class="text-right">
						Tesoureiro: <b> %s </b></td></tr>',$dadostesoureiro->nome());
				$totaltes = 0;
				//echo '<tr style="background:'.$bgcolor.'"><td>'.$linha['data'].'</td><td>'.$rol.' - '.$linha['nome'].'</td><td>'.$tipo.'</td><td style="text-align:right;">'.$valor.'</td><td>'.$status.'</td></tr>';
			}
			$totaltes += $vlr;

			$tabLancamento .= '<tr><td>'.$linha['data'].'</td><td>'.$rol.'</td><td>'.$tipo.'</td><td class="text-right">'.$valor.'</td><td>'.$status.'</td></tr>';
			$total += $linha['valor'];
		}
		$total = number_format($total,2,',','.');
		$tabLancamento .= sprintf("<tr id='total'><td colspan='2' class='text-left'>
		%s</td><td colspan='3' class='text-right'>Total: %'.100s &nbsp;&nbsp;&nbsp;
		&nbsp;<b>%s</b></td></tr>",$dadostesoureiro->nome(),'.',number_format($totaltes,2,',','.'));
		$tabLancamento .=  '</tbody>';
		$tabLancamento .=  '<tfoot><tr class="primary"><td  colspan="3"
		class="text-right">Total Geral:</td><td colspan="2" class="text-right"
		><strong> R$ '.$total.'</strong></td></tr></tfoot>';
		return $tabLancamento;
	}
}
