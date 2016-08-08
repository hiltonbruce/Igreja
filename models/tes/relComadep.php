<?php
$nivel1 = '';
$nivel2 = '';
$nivel3 = '';
$planoCta=array();
$cor=true;
$sldGrupo=array();
$sldNivel3 = array();
$sldGrupoN4 = '';

#Monta array com informações das contas atualmente
$plano = new tes_conta();
$planoCta = $plano->contasTodas();
$planoCod = $plano->contasCod();
//print_r($planoCta);
//Busca do movimento no mês
$queryLanc  = 'SELECT l.*,DATE_FORMAT(l.data,"%Y%m") AS dt FROM lanc AS l';
$queryLanc .= ' WHERE DATE_FORMAT(data,"%Y%m")<="'.$a.$m.'"';
if ($idIgreja>'0' && $idIgreja!='-1') {
$queryLanc .= ' AND igreja="'.$idIgreja.'"';
}elseif ($idIgreja=='-1') {
$queryLanc .= ' AND igreja!="1"';
}
//$queryLanc .= ' AND c.id=l.creditar';
//$queryLanc .= ' ORDER BY ';
$lista = mysql_query($queryLanc) or die(mysql_error());
while ($contas = mysql_fetch_array($lista)) {

	$ctaDeb   = $contas['debitar'];#id da cta
	$tipoDeb  = $planoCta[$contas['debitar']]['tipo'];#Tipo da Cta -> D/C
	$ctaCred  = $contas['creditar'];#id da cta
	$tipoCred = $planoCta[$contas['creditar']]['tipo'];#Tipo da Cta -> D/C
				//$credito += $contas['valor'];
	$dataLancDeb[] = array( 'Cod'=>$ctaDeb,'Data'=>$contas['data'], 'Vlr'=>$contas['valor']);
	$dataLancCred[] = array( $ctaCred,$contas['data'], $contas['valor']);
#echo $ctaDeb." -- ";
#echo $ctaCred."<br />";
	if ($contas['dt']==$a.$m) {
			//Movimento do mês atual
			//Contas debitadas
			$saldo[$planoCta[$ctaDeb]['codigo']] += $contas['valor'];
			$saldoGrp[$planoCta[$ctaDeb]['nivel4']] += $contas['valor'];
			$saldoGrp[$planoCta[$ctaDeb]['nivel5']] += $contas['valor'];
			//Contas creditadas
			$saldo[$planoCta[$ctaCred]['codigo']] -= $contas['valor'];#Sld nivel de codigo
			$saldoGrp[$planoCta[$ctaCred]['nivel4']] -= $contas['valor'];
			$saldoGrp[$planoCta[$ctaCred]['nivel5']] -= $contas['valor'];
			//$debito  += $contas['valor'];//Movimento do
		}else {
			//saldo meses anteriores
			//Contas debitadas
				$saldoDisp[$planoCta[$ctaDeb]['codigo']] += $contas['valor'];
				$saldoDispGrp[$planoCta[$ctaDeb]['nivel4']] += $contas['valor'];
				$saldoDispGrp[$planoCta[$ctaDeb]['nivel5']] += $contas['valor'];
			//Contas creditadas
				$saldoDisp[$planoCta[$ctaCred]['codigo']] -= $contas['valor'];
				$saldoDispGrp[$planoCta[$ctaCred]['nivel4']] -= $contas['valor'];
				$saldoDispGrp[$planoCta[$ctaCred]['nivel4']] -= $contas['valor'];
				//$sldGrupoDisp [$contas['creditar']] -= $contas['valor'];

			/*Quando houver saldo, mas sem movimento no mes, aqui é forçado
			 * a aparecer
			
			if ($saldo[$planoCta[$ctaCred]['codigo']]==0) {
				$saldo[$planoCta[$ctaCred]['codigo']] = 0;
			}
			if ($saldo[$planoCta[$ctaDeb]['codigo']]==0) {
				$saldo[$planoCta[$ctaDeb]['codigo']] = 0;
			}*/
		}
}
$ctaAtual = '';
////echo $planoCta['5']['4'];
//$saldo = array_merge($saldoDisp,$saldo);
//print_r($planoCod);
ksort($saldo); #Ordena o array pela chave
echo "<br /><br />";
//print_r($planoCta);
print_r($saldo);

/* print_r($dataLancDeb);
echo "<br/><br/><br/>";
print_r($dataLancCred);
*/
#print_r($saldo);
$grpFim = FALSE;
foreach ($saldo AS $chave => $valor){
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
			}elseif ($saldo[$chave]>0) {
				$vlrSaldo .= 'D';
			}

		$vlrSaldoDisp = number_format(abs($saldoDisp[$chave]),2,',','.');
		if ($saldoDisp[$chave]<0) {
				 $vlrSaldoDisp .= 'C';
			}elseif ($saldoDisp[$chave]>0) {
				$vlrSaldoDisp .= 'D';
			}

		$vlrSaldoAtual = number_format(abs($saldo[$chave]+$saldoDisp[$chave]),2,',','.');
		if (($saldo[$chave]+$saldoDisp[$chave])<0) {
				$vlrSaldoAtual  .= 'C';
			}elseif (($saldo[$chave]+$saldoDisp[$chave])>0) {
				$vlrSaldoAtual .= 'D';
			}

	//	$grupoAtualForm = number_format(abs($sldGrupoAtual),2,',','.');
		if ($sldGrupoAtual<0) {
				$grupoAtualForm .= 'C';
			}elseif ($sldGrupoAtual>0) {
				$grupoAtualForm .= 'D';
			}

		//echo $planoCta[$chave]['4'].' -- ';
		if ($ctaAtual==$planoGrupo[$chave]['3'] || $ctaAtual==''){
				//Contas simples
			$codAcesso = sprintf ("%'04u",$planoCod[$chave]['acesso']);
			$nivel1 .='<tr><td>'.$chave.'</td><td title="'.$title.'">'.'['.$codAcesso.'] - '.$planoCod[$chave]['titulo'].
				'</td><td id="moeda">'.$vlrSaldo.'</td><td id="moeda">'.$vlrSaldoAtual.'</td><td id="moeda">'.$vlrSaldoDisp.'</td></tr>';
		}else {

		//Contas Nivel 3
			$sldNivel3Atual[$sldGrupoN4] += $sldGrupoAtual;//Sld atual grupo nível 3
			$sldNivel3Mov[$sldGrupoN4] += $sldGrupoCta;//Sld do movimento grupo nível 3
			$sldNivel3Ant[$sldGrupoN4] += $sldGrupoCtaDisp;//Sld anterior grupo nível 3
			if ($sldNivel3Mov[$sldGrupoN4]>'0') {
				$movSld = 'D';
			} elseif ($sldNivel3Mov[$sldGrupoN4]<'0') {
				$movSld = 'C';					
			}else {
				$movSld = '';
			}
			
			if ($sldNivel3Atual[$sldGrupoN4]>'0') {
				$saldoAtl = 'D';
			} elseif ($sldNivel3Atual[$sldGrupoN4]<'0') {
				$saldoAtl = 'C';					
			}else {
				$saldoAtl = '';
			}

			if ($sldNivel3Ant[$sldGrupoN4]>'0') {
				$saldoAntr = 'D';
			} elseif ($sldNivel3Ant[$sldGrupoN4]<'0') {
				$saldoAntr = 'C';					
			}else {
				$saldoAntr = '';
			}

			
		}

}

$nivel3 .= $nivel1;

$nivel2 = $nivel3;
?>
