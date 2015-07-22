<?php
$nivel1 	= '';$nivel2 	= '';
$planoCta=array();$cor=true;$sldGrupo=array();

$plano = mysql_query('SELECT * FROM contas ORDER BY codigo ');
while ($cta = mysql_fetch_array($plano)) {
	$planoCta[$cta['id']]=array($cta['titulo'],$cta['acesso'],$cta['codigo'],$cta['tipo'],$cta['nivel4']);
	$planoGrupo[$cta['codigo']]=array($cta['titulo'],$cta['codigo'],$cta['tipo']);
}
//print_r($planoCta);
//Busca do movimento no mês
$queryLanc  = 'SELECT l.*,DATE_FORMAT(l.data,"%Y%m") AS dt FROM lanc AS l';
$queryLanc .= ' WHERE DATE_FORMAT(data,"%Y%m")<='.$mesRelatorio;
//$queryLanc .= ' AND c.id=l.creditar';
//$queryLanc .= ' ORDER BY ';
$lista = mysql_query($queryLanc) or die(mysql_error());
while ($contas = mysql_fetch_array($lista)) {
	if ($contas['dt']==$a.$m) {
			//Movimento do mês atual
			//Contas debitadas
			$saldo[$contas['debitar']] += $contas['valor'];
			$sldGrupo [$planoCta[$contas['debitar']]['4']] += $contas['valor'];
			//Contas creditadas
			$saldo[$contas['creditar']] -= $contas['valor'];
			$sldGrupo [$planoCta[$contas['creditar']]['4']] -= $contas['valor'];
		}else {
			//saldo meses anteriores
			//Contas debitadas
				$saldoDisp[$contas['debitar']] += $contas['valor'];
				$sldGrupoDisp [$planoCta[$contas['debitar']]['4']] += $contas['valor'];
			//Contas creditadas
				$saldoDisp[$contas['creditar']] -= $contas['valor'];
				$sldGrupoDisp [$planoCta[$contas['creditar']]['4']] -= $contas['valor'];

			/*Quando houver saldo, mas sem movimento no mes, aqui é forçado
			 * a aparecer
			*/
			if ($saldo[$contas['creditar']]==0) {
				$saldo[$contas['creditar']] = 0;
			}
			if ($saldo[$contas['debitar']]==0) {
				$saldo[$contas['debitar']] = 0;
			}
		}
}
$ctaAtual = '';
//print_r($sldGrupo);
//echo $planoCta['5']['4'];
//$saldo = array_merge($saldoDisp,$saldo);

//print_r($saldo);
foreach ($saldo AS $chave => $valor){
		$bgcolor = ($cor) ? 'class="dados"' : 'class="odd"';
		//$acesso = sprintf("[%04s]\n", $planoCta[$chave]['1']);
		$acesso = '';
		$vlrSaldo = abs($saldo[$chave]);

		if ($planoCta[$chave]['3']=='D') {
				$debito += $vlrSaldo;

			}else {
				$credito += $vlrSaldo;
			}

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
		if ($ctaAtual==$planoCta[$chave]['4'] || $ctaAtual==''){
				//Contas simples
				$nivel1 .='<tr '.$bgcolor.'><td>'.$planoCta[$chave]['2'].'</td><td title="'.$title.'">'.$acesso.$planoCta[$chave]['0'].
				'</td><td id="moeda">'.$vlrSaldo.'</td><td id="moeda">'.$vlrSaldoAtual.'</td><td id="moeda">'.$vlrSaldoDisp.'</td></tr>';
			}else {
				//Grupo de contas
				$movSld = ($grupoAtualForm>'0') ? 'D' : 'C' ;
				$saldoAtl = ($sldGrupoCta>'0') ? 'D' : 'C' ;
				$saldoAntr = ($sldGrupoCta>'0') ? 'D' : 'C' ;
				$bgcolorGrp = 'style="background:#C9DBF2; color:#000;border-bottom: 1px dashed #000;border-top: 1px dashed #000;"';
				$nivelGrupo ='<tr '.$bgcolorGrp.'><td>'.$planoGrupo[$ctaAtual]['1'].'</td><td title="'.$title.'">'
					.$planoGrupo[$ctaAtual]['0'].'</td><td id="moeda">'.number_format(abs($sldGrupoCta),2,',','.').$movSld
					./*$planoGrupo[$ctaAtual]['2'].*/'</td><td id="moeda">'.number_format(abs($grupoAtualForm),2,',','.').$saldoAtl.'</td>
					<td id="moeda">'.number_format(abs($sldGrupoCtaDisp),2,',','.').$saldoAntr/*$planoGrupo[$ctaAtual]['2']*/.'</td></tr>';
				if ($nivel2=='') {
					$nivel2 .=$nivelGrupo.$nivel1;
				}else {
					$nivelGrupo = $nivel2.$nivelGrupo.$nivel1;
					$nivel2 = $nivelGrupo;
					$nivelGrupo ='';
				}

				$saldoAtual=0;

				if ($cor==false) {
					$cor = !$cor;
					$bgcolor = ($cor) ? 'class="dados"' : 'class="odd"';
				}

				//Contas simples
				$nivel1 ='<tr '.$bgcolor.'><td>'.$planoCta[$chave]['2'].'</td><td title="'.$title.'">'.$acesso.$planoCta[$chave]['0'].
				'</td><td id="moeda">'.$vlrSaldo.'</td><td id="moeda">'.$vlrSaldoAtual.'</td><td id="moeda">'.$vlrSaldoDisp.'</td></tr>';
			}

			$sldGrupoCta = abs($sldGrupo [$planoCta[$chave]['4']]);
			$sldGrupoCtaDisp = $sldGrupoDisp [$planoCta[$chave]['4']];
			$sldGrupoAtual = $sldGrupoCtaDisp+$sldGrupoCta;

			$cor = !$cor;

		$ctaAtual = $planoCta[$chave]['4'];
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
	$bgcolorGrp = 'style="background:#C9DBF2; color:#000;border-bottom: 1px dashed #000;border-top: 1px dashed #000;""';
	$nivelGrupo ='<tr '.$bgcolorGrp.'><td>'.$planoGrupo[$ctaAtual]['1'].'</td><td title="'.$title.'">'.$planoGrupo[$ctaAtual]['0'].'</td><td id="moeda">
				'.number_format(abs($sldGrupoCta),2,',','.').$planoGrupo[$ctaAtual]['2'].'</td><td id="moeda"> '.$grupoAtualForm.'</td><td id="moeda">
				'.number_format(abs($sldGrupoCtaDisp),2,',','.').$planoGrupo[$ctaAtual]['2'].'</td></tr>';

	$nivel2 .=$nivelGrupo.$nivel1;
}

$nivel1=$nivel2;

?>
