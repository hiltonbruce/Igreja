<?php
class dizresp {
	
function __construct($tesoureiro='') {
		$this->var_string = "SELECT d.id,d.rol,DATE_FORMAT(d.data,'%d/%m/%Y') AS data,
		 d.nome,d.tipo,d.valor,i.razao,d.credito,d.tesoureiro, d.confirma, 
		i.rol AS rolIgreja FROM dizimooferta AS d, igreja AS i ";
		$this->tesoureiro = $tesoureiro;
		
	}
	
function dizimistas($igreja,$linkLancamento,$dia,$mes,$ano,$tipo) {

	$dataValid = (checadata ($dia.'/'.$mes.'/'.$ano)) ? $ano.'-'.$mes.'-'.$dia:false;
	if ($igreja=='') {
		$filtroIgreja = '';
	} else {
		$filtroIgreja = ' AND d.igreja="'.$igreja.'"';
	}
	
	//Gera a query de busca
	$incluiPessoa ='';
	
	if (!empty($_GET['nome']) || $_GET['rol']>=0 ) {
		
		$nome = trim($_GET['nome']);
		if ($_GET['rol']>0) {
			$incluiPessoa =' AND d.rol = "'.(int)$_GET['rol'].'" ';
		}elseif ((strlen($_GET['nome']))>'3'){
			$incluiPessoa =' AND d.nome LIKE "%'.$nome.'%" ';
		}elseif (!empty($_GET['membro']) && $_GET['membro']==true) {
			$incluiPessoa =' AND d.nome = "" AND d.rol = "0" ';
		}
		
	}
	
		if ($dataValid && $mes>0 && $mes<12 && $ano>2000 && $ano<2050 && ($tipo=='9' || $tipo=='0')) {
			$consulta  = $this->var_string.'WHERE d.lancamento>"0" ';
			$consulta .= $incluiPessoa;
			$consulta .= ' AND d.data = "'.$dataValid.'"';
			$consulta .= $filtroIgreja.' AND d.igreja = i.rol ORDER BY d.data ';
			$this->dquery = mysql_query( $consulta ) or die (mysql_error());
			$lancConfirmado = true;
		}elseif ($mes>0 && $mes<12 && $ano>2000 && $ano<2050 && ($tipo=='9' || $tipo=='0')) {
			$consulta  = $this->var_string.'WHERE d.lancamento>"0" ';
			$consulta .= $incluiPessoa;
			$consulta .= ' AND mesrefer = '.$mes.' AND anorefer='.$ano;
			$consulta .= $filtroIgreja.' AND d.igreja = i.rol ORDER BY d.tesoureiro,d.igreja,d.id ';
			$this->dquery = mysql_query( $consulta ) or die (mysql_error());
			$lancConfirmado = true;
		}elseif (($mes=='0' || empty($mes)) && $ano>2000 && $ano<2050 && ($tipo=='9' || $tipo=='0')) {
			$consulta  = $this->var_string.'WHERE d.lancamento>"0" ';
			$consulta .= $incluiPessoa;
			$consulta .= ' AND anorefer='.$ano;
			$consulta .= $filtroIgreja.' AND d.igreja = i.rol ORDER BY d.tesoureiro,d.igreja,d.id ';
			$this->dquery = mysql_query( $consulta ) or die (mysql_error());
			$lancConfirmado = true;
		}elseif (($mes=='0' || empty($mes)) && ($ano=='0') && ($tipo=='9')) {
			$consulta  = $this->var_string.'WHERE d.lancamento>"0" ';
			$consulta .= $incluiPessoa;
			$consulta .= $filtroIgreja.' AND d.igreja = i.rol ORDER BY d.igreja,d.data DESC,d.id ';
			$this->dquery = mysql_query( $consulta ) or die (mysql_error());
			$lancConfirmado = true;
		}elseif ($incluiPessoa!='') {
			$this->dquery = mysql_query($this->var_string.'WHERE d.lancamento>"0"'.$incluiPessoa.
					$filtroIgreja.' AND d.igreja = i.rol ORDER BY d.tesoureiro,d.igreja,d.id ') or die (mysql_error());
			$lancConfirmado = true;
		}else {
			$this->dquery = mysql_query($this->var_string.'WHERE d.lancamento="0"'.
					$filtroIgreja.' AND d.igreja = i.rol ORDER BY d.tesoureiro,d.igreja,d.id ') or die (mysql_error());
				$lancConfirmado = false;
		}
		
		
		//echo '<tbody>';
		$total = 0;
		while ($linha = mysql_fetch_array($this->dquery)) {
			//echo $linha['id'].'===='..' -> Valor: R$ '.$linha['valor'].'<br />';
			
			$mostracta = new DBRecord ('contas',$linha['credito'],'acesso');//Traz os da conta p/ mostrar coluna tipo
			$tipo = $mostracta->titulo;//Define o titulo para a vari�vel
			
			$valor = number_format($linha['valor'],2,',','.');
			if ($linha['confirma']=='') {
				$status = 'Pedente';
			}else {
				$status = 'Confimado!';
			}
			$bgcolor = $cor ? '#d0d0d0' : '#ffffff';
			
			$rol = $linha['nome']<>'' ? $linha['rol'] : 'An&ocirc;nimo';
			
			//Criar link para altera��o pelo cadastrador - Realizar critica tb qdo abrir
			if ($_SESSION["valid_user"]==$linha['tesoureiro'] && !$lancConfirmado) {
				if ($_GET['tipo']==1) {
					$corrigir = $valor;
				}else {
					$corrigir = '<a href="'.$linkLancamento.$linha['id'].'" 
						title="clique aqui para apagar!">'.$valor.'
						<img src="img/blackeditar.png" alt="Apagar item" /></a>';
				}
				
			}else {
				$corrigir = $valor;
			}
			
			$linkMembro= './?escolha=views/tesouraria/saldoMembros.php&bsc_rol='.$rol;
			echo '<tr style="background:'.$bgcolor.'"><td>'.$linha['data'].'</td>
				<td><a href="'.$linkMembro.'" title="Detalhar contribui&ccedil;&otilde;es confimardas!">'
				.$rol.' - '.$linha['nome'].'</a></td><td>'.$tipo.'</td><td 
				 id="moeda">'.$corrigir.'</td>
				 		<td>'.$linha['razao'].'</td></tr>';
						$total += $linha['valor'];
			$cor = !$cor;
		}
		$total = number_format($total,2,',','.');
		echo '</tbody>';
		echo '<tfoot><tr id="total"><td colspan="3">Total:
		 ..........................................................................................R$
		 </td><td id="moeda">
		 '.$total.'</td><td></td></tr></tfoot>';
		return $total;
	}
	
function outrosdizimos ($igreja) {
		
	if ($igreja=='') {
		$filtroIgreja = '';
	} else {
		$filtroIgreja = 'AND igreja="'.$igreja.'"';
	}
	
	$this->dquery  = mysql_query('SELECT SUM(valor) AS valor FROM dizimooferta 
	WHERE tesoureiro <> "'.$this->tesoureiro.'" AND lancamento="0" '.$filtroIgreja) or die (mysql_error());
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
		echo '<tbody>';
	
		while ($linha = mysql_fetch_array($this->dquery)) {
			//echo $linha['id'].'===='..' -> Valor: R$ '.$linha['valor'].'<br />';
	
			
			$mostracta = new DBRecord ('contas',$linha['credito'],'acesso');//Traz os da conta p/ mostrar coluna tipo
			$tipo = $mostracta->titulo;//Define o titulo para a vari�vel
			
			//$tesoureiro = $linha['tesoureiro'];
			
			$vlr = $linha['valor'];
			$valor = number_format($vlr,2,',','.');
			if ($linha['confirma']=='') {
				$status = 'Pedente';
			}else {
				$status = 'Confimado!';
			}
			$bgcolor = $cor ? '#d0d0d0' : '#ffffff';
			$rol = $linha['nome']<>'' ? $linha['rol'].' - '.$linha['nome'] : 'An&ocirc;nimo';
			
			if ($tesoureiro!=$linha['tesoureiro']) {
				if ($totaltes!='0') {
				printf("<tr style='background:#FFF68F; border-top: 1px solid #000;'><td></td><td colspan='2' style='text-aling:right;'>
						Total: %'.150s </td><td style='text-align:right;'><b>%s</b></td><td></td></tr>"
						,'.',number_format($totaltes,2,',','.'));}
				$tesoureiro = $linha['tesoureiro'];
				$dadostesoureiro = new DBRecord('usuario',$tesoureiro, 'cpf');
				printf('<tr style="background:#98f5ff;"><td colspan="5" style="aling:center;
						 border-top: 2px solid #000; border-bottom: 2px solid #000;">
						Tesoureiro: <b> %s </b></td></tr>',$dadostesoureiro->nome);
				$totaltes = 0;
				//echo '<tr style="background:'.$bgcolor.'"><td>'.$linha['data'].'</td><td>'.$rol.' - '.$linha['nome'].'</td><td>'.$tipo.'</td><td style="text-align:right;">'.$valor.'</td><td>'.$status.'</td></tr>';
			}
			$totaltes += $vlr;
			
			echo '<tr style="background:'.$bgcolor.'"><td>'.$linha['data'].'</td><td>'.$rol.'</td><td>'.$tipo.'</td><td style="text-align:right;">'.$valor.'</td><td>'.$status.'</td></tr>';
			$total += $linha['valor'];
			$cor = !$cor;
		}
		$total = number_format($total,2,',','.');

		printf('<tr style="background:#FFF68F; border-top: 1px solid #000;"><td></td><td colspan="2">Total deste tesoureiro:</td><td id="moeda"><b>%s</b></td><td></td></tr>',number_format($totaltes,2,',','.'));
		echo '</tbody>';
		echo '<tfoot><tr class="total"><td  colspan="3">Total Geral: R$</td>
			<td id="moeda">'.$total.'</td><td></td>
			</tr></tfoot>';
		return $total;
	}
	
}
