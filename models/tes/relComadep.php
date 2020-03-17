<?php
$nivel1 = '';
$nivel2 = '';
$nivel3 = '';
$planoCta=array();
$saldoGrp=array();
$saldoAnteGrp=array();
$sldNivel3 = array();
$sldGrupoN4 = '';
$cred = '<strong> C</strong>';
$dev = '<strong> D</strong>';
#Monta array com informa��es das contas atualmente
$plano = new tes_conta($_GET['gpconta']);
$planoCta = $plano->contasTodas();
$planoCod = $plano->contasCod();

if (!empty($_GET['gpconta'])) {
	$lstCta = new tes_contas();
	$contaDC = $lstCta->contasTodas();
}else {
	$contaDC = $planoCta;
}
//Busca do movimento no m�s
$queryLanc  = 'SELECT l.*,DATE_FORMAT(l.data,"%Y%m") AS dt FROM lanc AS l';
$queryLanc .= ' WHERE DATE_FORMAT(data,"%Y%m")<="'.$a.$m.'"';
//Filtra por igreja
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
	$tipoDeb  = $contaDC[$contas['debitar']]['tipo'];#Tipo da Cta -> D/C
	$ctaCred  = $contas['creditar'];#id da cta
	$tipoCred = $contaDC[$contas['creditar']]['tipo'];#Tipo da Cta -> D/C
	$vlrConta = abs($contas['valor']);
	//$credito += $vlrConta;
	$dataLancDeb[] = array( 'Cod'=>$ctaDeb,'Data'=>$contas['data'], 'Vlr'=>$vlrConta);
	$dataLancCred[] = array( $ctaCred,$contas['data'], $vlrConta);
#echo $ctaDeb." -- ";
#echo $ctaCred."<br />";
	if ($contas['dt']==$a.$m) {
			//Movimento do m�s atual
			//Contas debitadas
			$saldo[$contaDC[$ctaDeb]['codigo']] += $vlrConta;
			$saldoGrp[$contaDC[$ctaDeb]['nivel4']] += $vlrConta;
			$saldoGrp[$contaDC[$ctaDeb]['nivel3']] += $vlrConta;
			$saldoGrp[$contaDC[$ctaDeb]['nivel2']] += $vlrConta;
			//Contas creditadas
			$saldo[$contaDC[$ctaCred]['codigo']] -= $vlrConta;#Sld nivel de codigo
			$saldoGrp[$contaDC[$ctaCred]['nivel4']] -= $vlrConta;
			$saldoGrp[$contaDC[$ctaCred]['nivel3']] -= $vlrConta;
			$saldoGrp[$contaDC[$ctaCred]['nivel2']] -= $vlrConta;
			//$debito  += $vlrConta;//Movimento do
			$debito  += $contas['valor'];
		}else {
			//saldo meses anteriores
			//Contas debitadas
			$saldoAnte[$contaDC[$ctaDeb]['codigo']] += $vlrConta;
			$saldoAnteGrp[$contaDC[$ctaDeb]['nivel4']] += $vlrConta;
			$saldoAnteGrp[$contaDC[$ctaDeb]['nivel3']] += $vlrConta;
			$saldoAnteGrp[$contaDC[$ctaDeb]['nivel2']] += $vlrConta;
			//Contas creditadas
			$saldoAnte[$contaDC[$ctaCred]['codigo']] -= $vlrConta;
			$saldoAnteGrp[$contaDC[$ctaCred]['nivel4']] -= $vlrConta;
			$saldoAnteGrp[$contaDC[$ctaCred]['nivel3']] -= $vlrConta;
			$saldoAnteGrp[$contaDC[$ctaCred]['nivel2']] -= $vlrConta;
			//$sldGrupoAnte [$contas['creditar']] -= $vlrConta;
			/*Quando houver saldo, mas sem movimento no mes, aqui � for�ado
			 * a aparecer
			*/
			if ($saldo[$contaDC[$ctaCred]['codigo']]==0) {
				$saldo[$contaDC[$ctaCred]['codigo']] = 0;
			}
			if ($saldo[$contaDC[$ctaDeb]['codigo']]==0) {
				$saldo[$contaDC[$ctaDeb]['codigo']] = 0;
			}
		}
}
?>
