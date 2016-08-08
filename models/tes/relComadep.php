<?php
$nivel1 = '';
$nivel2 = '';
$nivel3 = '';
$planoCta=array();
$cor=true;
$saldoGrp=array();
$saldoAnteGrp=array();

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

	$vlrConta = abs($contas['valor']);
				//$credito += $vlrConta;
	$dataLancDeb[] = array( 'Cod'=>$ctaDeb,'Data'=>$contas['data'], 'Vlr'=>$vlrConta);
	$dataLancCred[] = array( $ctaCred,$contas['data'], $vlrConta);
#echo $ctaDeb." -- ";
#echo $ctaCred."<br />";
	if ($contas['dt']==$a.$m) {
			//Movimento do mês atual
			//Contas debitadas
			$saldo[$planoCta[$ctaDeb]['codigo']] += $vlrConta;
			$saldoGrp[$planoCta[$ctaDeb]['nivel4']] += $vlrConta;
			$saldoGrp[$planoCta[$ctaDeb]['nivel3']] += $vlrConta;
			//Contas creditadas
			$saldo[$planoCta[$ctaCred]['codigo']] -= $vlrConta;#Sld nivel de codigo
			$saldoGrp[$planoCta[$ctaCred]['nivel4']] -= $vlrConta;
			$saldoGrp[$planoCta[$ctaCred]['nivel3']] -= $vlrConta;
			//$debito  += $vlrConta;//Movimento do

		}else {
			//saldo meses anteriores
			//Contas debitadas
			$saldoAnte[$planoCta[$ctaDeb]['codigo']] += $vlrConta;
			$saldoAnteGrp[$planoCta[$ctaDeb]['nivel4']] += $vlrConta;
			$saldoAnteGrp[$planoCta[$ctaDeb]['nivel3']] += $vlrConta;
			//Contas creditadas
			$saldoAnte[$planoCta[$ctaCred]['codigo']] -= $vlrConta;
			$saldoAnteGrp[$planoCta[$ctaCred]['nivel4']] -= $vlrConta;
			$saldoAnteGrp[$planoCta[$ctaCred]['nivel3']] -= $vlrConta;
			//$sldGrupoAnte [$contas['creditar']] -= $vlrConta;

			/*Quando houver saldo, mas sem movimento no mes, aqui é forçado
			 * a aparecer
			*/
			if ($saldo[$planoCta[$ctaCred]['codigo']]==0) {
				$saldo[$planoCta[$ctaCred]['codigo']] = 0;
			}
			if ($saldo[$planoCta[$ctaDeb]['codigo']]==0) {
				$saldo[$planoCta[$ctaDeb]['codigo']] = 0;
			}

		}
}
$ctaAtualN4 = '';
$ctaAtualN3 = '';
////echo $planoCta['5']['4'];
//$saldo = array_merge($saldoAnte,$saldo);
#print_r($saldoAnteGrp);

ksort($saldo); #Ordena o array pela chave
#echo "<br /><br />";
#print_r($saldoGrp);
//print_r($saldo);

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

		$vlrSaldo = number_format($vlrSaldo,2,',','.');
		if ($saldo[$chave]<0) {
				$vlrSaldo .= '<strong>C</strong>';
			}elseif ($saldo[$chave]>0) {
				$vlrSaldo .= '<strong>D</strong>';
			}

		$vlrSaldoAnte = number_format(abs($saldoAnte[$chave]),2,',','.');
		if ($saldoAnte[$chave]<0) {
				 $vlrSaldoAnte .= '<strong>C</strong>';
			}elseif ($saldoAnte[$chave]>0) {
				$vlrSaldoAnte .= '<strong>D</strong>';
			}

		$vlrSaldoAtual = number_format(abs($saldo[$chave]+$saldoAnte[$chave]),2,',','.');
		if (($saldo[$chave]+$saldoAnte[$chave])<0) {
				$vlrSaldoAtual  .= '<strong>C</strong>';
			}elseif (($saldo[$chave]+$saldoAnte[$chave])>0) {
				$vlrSaldoAtual .= '<strong>D</strong>';
			}

	//	$grupoAtualForm = number_format(abs($sldGrupoAtual),2,',','.');
		if ($sldGrupoAtual<0) {
				$grupoAtualForm .= '<strong>C</strong>';
			}elseif ($sldGrupoAtual>0) {
				$grupoAtualForm .= '<strong>D</strong>';
			}

		//echo $planoCta[$chave]['4'].' -- ';
		if ($ctaAtualN4==$planoCod[$chave]['nivel4'] || $ctaAtualN4==''){
				//Contas simples
			$codAcesso = sprintf ("%'04u",$planoCod[$chave]['acesso']);
			$nivel1 .='<tr><td>'.$chave.'</td><td title="'.$title.'">'.'['.$codAcesso.'] - '.$planoCod[$chave]['titulo'].
				'</td><td id="moeda">'.$vlrSaldo.'</td><td id="moeda">'.$vlrSaldoAtual.'</td><td id="moeda">'.$vlrSaldoAnte.'</td></tr>';
		}else {

		//Contas Nivel 4
			$sldGrupoCta = $saldoGrp[$planoCod[$ctaAtualN4]['nivel4']];//Sld do movimento grupo nível 3
			$sldGrupoCtaAnte = $saldoAnteGrp[$planoCod[$ctaAtualN4]['nivel4']];//Sld anterior grupo nível 3
			$sldGrupoAtual = $sldGrupoCta+$sldGrupoCtaAnte;//Sld atual grupo nível 3

			$nivelGrupo ='<tr class="primary"><td>'.$planoCod[$ctaAtualN4]['nivel4'].'</td><td title="'.$title.'">'
				.$planoCod[$planoCod[$ctaAtualN4]['nivel4']]['titulo'].'</td><td id="moeda">'.number_format(abs($sldGrupoCta),2,',','.').$movSld
				./*$planoGrupo[$ctaAtualN4]['2'].*/'</td><td id="moeda">'.number_format(abs($sldGrupoAtual),2,',','.').$saldoAtl.'</td>
				<td id="moeda">'.number_format(abs($sldGrupoCtaAnte),2,',','.').$saldoAntr/*$planoGrupo[$ctaAtualN4]['2']*/.'</td></tr>';
			
			$codAcesso = sprintf ("%'04u",$planoCod[$chave]['acesso']);
			$nivel2 .= $nivelGrupo.$nivel1;
			$nivel1 = '<tr><td>'.$chave.'</td><td title="'.$title.'">'.'['.$codAcesso.'] - '.$planoCod[$chave]['titulo'].
				'</td><td id="moeda">'.$vlrSaldo.'</td><td id="moeda">'.$vlrSaldoAtual.'</td><td id="moeda">'.$vlrSaldoAnte.'</td></tr>';

			
		}

		if ($ctaAtualN3!=$planoCod[$chave]['nivel3'] && $nivel2!=''){

			//Contas Nivel 3
			$sldN3 = number_format(abs($saldoGrp[$planoCta[$ctaCred]['nivel3']]),2,',','.');
			$sldGrupoCta = $saldoGrp[$planoCod[$ctaAtualN4]['nivel3']];//Sld do movimento grupo nível 3
			$sldGrupoCtaAnte = $saldoAnteGrp[$planoCod[$ctaAtualN3]['nivel3']];//Sld anterior grupo nível 3
			$sldGrupoAtual = $sldGrupoCta+$sldGrupoCtaAnte;//Sld atual grupo nível 3
			
			$nivelN3 ='<tr><td class="bg-primary">'.$planoCod[$ctaAtualN4]['nivel3'].'</td><td title="'.$title.'" class="bg-primary">'
				.$planoCod[$planoCod[$ctaAtualN3]['nivel3']]['titulo'].'</td><td class="bg-primary text-right">'.number_format(abs($sldGrupoCta),2,',','.').$movSld
				./*$planoGrupo[$ctaAtualN4]['2'].*/'</td><td class="bg-primary text-right">'.number_format(abs($sldGrupoAtual),2,',','.').$saldoAtl.'</td>
				<td class="bg-primary text-right">'.number_format(abs($sldGrupoCtaAnte),2,',','.').$saldoAntr/*$planoGrupo[$ctaAtualN4]['2']*/.'</td></tr>';
			
			$nivel3 .= $nivelN3.$nivel2;
			$nivel2 = '';
		}

		$ctaAtualN4 = $planoCod[$chave]['nivel4'];
		$ctaAtualN3 = $planoCod[$chave]['nivel3'];

}

//$nivel3 .= $nivel1;

$nivel2 = $nivel3;
?>
