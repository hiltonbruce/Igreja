<?php
$nivel1 	= '';$nivel2 	= '';
$planoCta=array();$cor=true;$sldGrupo=array();

#Monta array com informações das contas atualmente
$plano = mysql_query('SELECT * FROM contas ORDER BY codigo ');
while ($cta = mysql_fetch_array($plano)) {
	$planoCta[$cta['id']]=array($cta['titulo'],$cta['acesso'],$cta['codigo'],$cta['tipo'],$cta['nivel4']);
	$planoGrupo[$cta['codigo']]=array($cta['titulo'],$cta['codigo'],$cta['tipo'],$cta['nivel4']);
}
//print_r($planoCta);
//Busca do movimento no mês
$queryLanc  = 'SELECT l.*,DATE_FORMAT(l.data,"%Y%m") AS dt FROM lanc AS l';
$queryLanc .= ' WHERE DATE_FORMAT(data,"%Y%m")<="'.$a.$m.'"';
//$queryLanc .= ' AND c.id=l.creditar';
//$queryLanc .= ' ORDER BY ';
$lista = mysql_query($queryLanc) or die(mysql_error());
while ($contas = mysql_fetch_array($lista)) {

	$ctaDeb   = $planoCta[$contas['debitar']]['2'];#Codigo da cta
	$tipoDeb  = $planoCta[$contas['debitar']]['3'];#Tipo da Cta -> D/C
	$ctaCred  = $planoCta[$contas['creditar']]['2'];#Codigo da cta
	$tipoCred = $planoCta[$contas['creditar']]['3'];#Tipo da Cta -> D/C
				$debito += $contas['valor'];
				//$credito += $contas['valor'];
	$dataLancDeb[] = array( 'Cod'=>$ctaDeb,'Data'=>$contas['data'], 'Vlr'=>$contas['valor']);
	$dataLancCred[] = array( $ctaCred,$contas['data'], $contas['valor']);
#echo $ctaDeb." -- ";
#echo $ctaCred."<br />";
	if ($contas['dt']==$a.$m) {
			//Movimento do mês atual
			//Contas debitadas
			$saldo[$ctaDeb] += $contas['valor'];
			$sldGrupo [$planoCta[$contas['debitar']]['4']] += $contas['valor'];
			//Contas creditadas
			$saldo[$ctaCred] -= $contas['valor'];
			$sldGrupo [$planoCta[$contas['creditar']]['4']] -= $contas['valor'];
		}else {
			//saldo meses anteriores
			//Contas debitadas
				$saldoDisp[$ctaDeb] += $contas['valor'];
				$sldGrupoDisp [$planoCta[$contas['debitar']]['4']] += $contas['valor'];
			//Contas creditadas
				$saldoDisp[$ctaCred] -= $contas['valor'];
				$sldGrupoDisp [$planoCta[$contas['creditar']]['4']] -= $contas['valor'];

			/*Quando houver saldo, mas sem movimento no mes, aqui é forçado
			 * a aparecer
			*/
			if ($saldo[$ctaCred]==0) {
				$saldo[$ctaCred] = 0;
			}
			if ($saldo[$ctaDeb]==0) {
				$saldo[$ctaDeb] = 0;
			}
		}
}
$ctaAtual = '';
//print_r($sldGrupo);
//echo $planoCta['5']['4'];
//$saldo = array_merge($saldoDisp,$saldo);
//print_r($saldo);
ksort($saldo); #Ordena o array pela chave
//echo "<br />";
//print_r($saldo);

/* print_r($dataLancDeb);
echo "<br/><br/><br/>";
print_r($dataLancCred);
*/
//print_r($saldo);
foreach ($saldo AS $chave => $valor){
		$bgcolor = 'class="dados"';
		//$acesso = sprintf("[%04s]\n", $planoCta[$chave]['1']);
		$acesso = '';
		$vlrSaldo = abs($saldo[$chave]);
/*
		if ($planoGrupo[$chave]['2']=='D') {
				$debito += $vlrSaldo;
			}elseif ($planoGrupo[$chave]['2']=='C') {
				$credito += $vlrSaldo;
			} else {
				$grupoFora .= $chave.' - '.$planoGrupo[$chave]['2'].' ** ';
				$sldFora .= $vlrSaldo.' - ';
			}
*/
		$vlrSaldo = number_format($vlrSaldo,2,',','.');
		if ($saldo[$chave]<0) {
				$vlrSaldo .= 'C';
			}else {
				$vlrSaldo .= 'D';
			}

		$vlrSaldoDisp = number_format(abs($saldoDisp[$chave]),2,',','.');
		if ($saldoDisp[$chave]<0) {
				 $vlrSaldoDisp .= 'C';
			}else {
				$vlrSaldoDisp .= 'D';
			}

		$vlrSaldoAtual = number_format(abs($saldo[$chave]+$saldoDisp[$chave]),2,',','.');
		if (($saldo[$chave]+$saldoDisp[$chave])<0) {
				$vlrSaldoAtual  .= 'C';
			}else {
				$vlrSaldoAtual .= 'D';
			}

		$grupoAtualForm = number_format(abs($sldGrupoAtual),2,',','.');
		if ($sldGrupoAtual<0) {
				$grupoAtualForm .= 'C';
			}else {
				$grupoAtualForm .= 'D';
			}

		//echo $planoCta[$chave]['4'].' -- ';
		if ($ctaAtual==$planoGrupo[$chave]['3'] || $ctaAtual==''){
				//Contas simples
				$nivel1 .='<tr '.$bgcolor.'><td>'.$planoGrupo[$chave]['1'].'</td><td title="'.$title.'">'.$acesso.$planoGrupo[$chave]['0'].
				'</td><td id="moeda">'.$vlrSaldo.'</td><td id="moeda">'.$vlrSaldoAtual.'</td><td id="moeda">'.$vlrSaldoDisp.'</td></tr>';
			}else {
				//Grupo de contas
				$movSld = ($grupoAtualForm>'0') ? 'D' : 'C' ;
				$saldoAtl = ($sldGrupoCta>'0') ? 'D' : 'C' ;
				$saldoAntr = ($sldGrupoCta>'0') ? 'D' : 'C' ;
				$nivelGrupo ='<tr class="info"><td>'.$planoGrupo[$ctaAtual]['1'].'</td><td title="'.$title.'">'
					.$planoGrupo[$ctaAtual]['0'].'</td><td id="moeda">'.number_format(abs($sldGrupoCta),2,',','.').$movSld
					./*$planoGrupo[$ctaAtual]['2'].*/'</td><td id="moeda">'.number_format(abs($sldGrupoAtual),2,',','.').$saldoAtl.'</td>
					<td id="moeda">'.number_format(abs($sldGrupoCtaDisp),2,',','.').$saldoAntr/*$planoGrupo[$ctaAtual]['2']*/.'</td></tr>';
				if ($nivel2=='') {
					$nivel2 .=$nivelGrupo.$nivel1;
				}else {
					$nivelGrupo = $nivel2.$nivelGrupo.$nivel1;
					$nivel2 = $nivelGrupo;
					$nivelGrupo ='';
				}

				$saldoAtual=0;

				//Contas simples
				$nivel1 ='<tr '.$bgcolor.'><td>'.$planoGrupo[$chave]['1'].'</td><td title="'.$title.'">'.$acesso.$planoGrupo[$chave]['0'].
				'</td><td id="moeda">'.$vlrSaldo.'</td><td id="moeda">'.$vlrSaldoAtual.'</td><td id="moeda">'.$vlrSaldoDisp.'</td></tr>';
			}

			$sldGrupoCta = $sldGrupo [$planoGrupo[$chave]['3']];
			$sldGrupoCtaDisp = $sldGrupoDisp [$planoGrupo[$chave]['3']];
			$sldGrupoAtual = $sldGrupoCtaDisp+$sldGrupoCta;

		$ctaAtual = $planoGrupo[$chave]['3'];
		//print_r ($sldGrupo);
			//echo ' - Conta -> '.$planoCta[$chave]['2'];
}

if ($teste) {
	//Grupo de contas
	$bgcolorGrp = 'style="background:#C9DBF2; color:#000;border-bottom: 1px dashed #000;border-top: 1px dashed #000;"';
	$nivelGrupo ='<tr '.$bgcolorGrp.'><td>'.$planoGrupo[$ctaAtual]['1'].'</td><td title="'.$title.'">'.$planoGrupo[$ctaAtual]['0'].'</td><td id="moeda">
	'.number_format($sldGrupoCta,2,',','.').$planoGrupo[$ctaAtual]['2'].'</td><td id="moeda">'.$grupoAtualForm.'</td>
	<td id="moeda">'.number_format($sldGrupoCtaDisp,2,',','.').$planoGrupo[$ctaAtual]['2'].'</td></tr>';
	if ($nivel2=='') {
		$nivel2 .=$nivelGrupo.$nivel1;
	}else {
		$nivelGrupo = $nivel2.$nivelGrupo.$nivel1;
		$nivel2 = $nivelGrupo;
		$nivelGrupo ='';
	}
}

//Testar pq não está entrando no loop
//Exibe a última passagem das contas e finaliza os dados da tabela
//Esta acresntando na ultima passagem, no final do relatorio e repetindo o grupo, as contas fora do grupos qdo elas tem saldo após o loop
//Rever para agrupar dentro de seu grupo
if ($nivelGrupo=='') {
	$saldoCta = ($sldGrupoCta>0) ? 'D' : 'C' ;
	$saldoAtl = ($sldGrupoAtual>0) ? 'D' : 'C' ;
	$saldoCtaDisp = ($sldGrupoCtaDisp>0) ? 'D' : 'C' ;
	$nivelGrupo ='<tr class="info"><td>'.$planoGrupo[$ctaAtual]['1'].'</td><td title="'.$title.'">'.$planoGrupo[$ctaAtual]['0'].'</td><td id="moeda">
				'.number_format(abs($sldGrupoCta),2,',','.').$saldoCta.'</td><td id="moeda"> '
				.number_format(abs($sldGrupoAtual),2,',','.').$saldoAtl.'</td><td id="moeda">
				'.number_format(abs($sldGrupoCtaDisp),2,',','.').$saldoCtaDisp.'</td></tr>';
	$nivel2 .=$nivelGrupo.$nivel1;
}

$nivel1=$nivel2;
echo $grupoFora;
?>
