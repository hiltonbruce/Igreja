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
$plano = new tes_conta();
$planoCta = $plano->contasTodas();
$planoCod = $plano->contasCod();

//Busca do movimento no m�s
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
			//Movimento do m�s atual
			//Contas debitadas
			$saldo[$planoCta[$ctaDeb]['codigo']] += $vlrConta;
			$saldoGrp[$planoCta[$ctaDeb]['nivel4']] += $vlrConta;
			$saldoGrp[$planoCta[$ctaDeb]['nivel3']] += $vlrConta;
			$saldoGrp[$planoCta[$ctaDeb]['nivel2']] += $vlrConta;
			//Contas creditadas
			$saldo[$planoCta[$ctaCred]['codigo']] -= $vlrConta;#Sld nivel de codigo
			$saldoGrp[$planoCta[$ctaCred]['nivel4']] -= $vlrConta;
			$saldoGrp[$planoCta[$ctaCred]['nivel3']] -= $vlrConta;
			$saldoGrp[$planoCta[$ctaCred]['nivel2']] -= $vlrConta;
			//$debito  += $vlrConta;//Movimento do
			$debito  += $contas['valor'];
		}else {
			//saldo meses anteriores
			//Contas debitadas
			$saldoAnte[$planoCta[$ctaDeb]['codigo']] += $vlrConta;
			$saldoAnteGrp[$planoCta[$ctaDeb]['nivel4']] += $vlrConta;
			$saldoAnteGrp[$planoCta[$ctaDeb]['nivel3']] += $vlrConta;
			$saldoAnteGrp[$planoCta[$ctaDeb]['nivel2']] += $vlrConta;
			//Contas creditadas
			$saldoAnte[$planoCta[$ctaCred]['codigo']] -= $vlrConta;
			$saldoAnteGrp[$planoCta[$ctaCred]['nivel4']] -= $vlrConta;
			$saldoAnteGrp[$planoCta[$ctaCred]['nivel3']] -= $vlrConta;
			$saldoAnteGrp[$planoCta[$ctaCred]['nivel2']] -= $vlrConta;
			//$sldGrupoAnte [$contas['creditar']] -= $vlrConta;
			/*Quando houver saldo, mas sem movimento no mes, aqui � for�ado
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
?>
