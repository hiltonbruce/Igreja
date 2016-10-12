<?PHP
//print_r($planoCta);
$ctaAtualN4 = '';
$ctaAtualN3 = '';
$ctaAtualN2 = '';
$nivelCom01 = '';
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
				$vlrSaldo .= $cred;
			}elseif ($saldo[$chave]>0) {
				$vlrSaldo .= $dev;
			} else {
				$vlrSaldo = '--o--';
			}
		$vlrSaldoAnte = number_format(abs($saldoAnte[$chave]),2,',','.');
		if ($saldoAnte[$chave]<0) {
				 $vlrSaldoAnte .= $cred;
			}elseif ($saldoAnte[$chave]>0) {
				$vlrSaldoAnte .= $dev;
			} else {
				$vlrSaldoAnte = '--o--';
			}
		$vlrSaldoAtual = number_format(abs($saldo[$chave]+$saldoAnte[$chave]),2,',','.');
		if (($saldo[$chave]+$saldoAnte[$chave])<0) {
				$vlrSaldoAtual  .= $cred;
			}elseif (($saldo[$chave]+$saldoAnte[$chave])>0) {
				$vlrSaldoAtual .= $dev;
			} else {
				$vlrSaldoAtual = '--o--';
			}
		//echo $planoCta[$chave]['4'].' -- ';
		if ($ctaAtualN4==$planoCod[$chave]['nivel4'] || $ctaAtualN4==''){
			//Contas simples
			if (($vlrSaldo != '--o--' || $vlrSaldoAtual != '--o--' || $vlrSaldoAnte != '--o--') &&
			$planoCod[$chave]['titulo']!='') {
				#Inclui linha se houver saldo em dos per√≠odos
				$codAcesso = sprintf ("%'04u",$planoCod[$chave]['acesso']);
				$nivel1 .= '<tr><td>'.$chave.'</td><td title="'.$title.'">'.'['.$codAcesso.'] - ';
				$nivel1 .= $planoCod[$chave]['titulo'].'</td><td id="moeda">';
				$nivel1 .= $vlrSaldo.'</td><td id="moeda">'.$vlrSaldoAtual.'</td><td id="moeda">';
				$nivel1 .= $vlrSaldoAnte.'</td></tr>';
			}
		}elseif ($rec=='16') {
			//Contas Nivel 4, tipo: 1.1.1.001 - Impress„o
			require '../help/tes/relComadepG2.php';
		}else {
			//Contas Nivel 4, tipo: 1.1.1.001 - Tela
			require 'help/tes/relComadepG2.php';
		}
		//Contas Nivel 3
		if ($ctaAtualN3!=$planoCod[$chave]['nivel3'] && $nivel2!='' && $rec!='16'){
			//Ixibir na tela
			require 'help/tes/relComadepGrp.php';
		}elseif ($ctaAtualN3!=$planoCod[$chave]['nivel3'] && $nivel2!='' && $rec=='16') {
			//impress√£o
			require '../help/tes/relComadepGrp.php';
		}
		//add nivel 2 (tipo 1.1) no Comadep
		if (($ctaAtualN2!=$planoCod[$chave]['nivel2']) && $rec!='16'){	//Contas Nivel 3
					//Ixibir na tela
					require 'help/tes/relComadepG3.php';
				}elseif (($ctaAtualN2!=$planoCod[$chave]['nivel2'] || $ctaAtualN2=='') && $rec=='16') {
					//impress„o
					require '../help/tes/relComadepG3.php';
		}
		$ctaAtualN4 = $planoCod[$chave]['nivel4'];
		$ctaAtualN3 = $planoCod[$chave]['nivel3'];
		$ctaAtualN2 = $planoCod[$chave]['nivel2'];
}
#Inclui o final dos dados da tabela apÛs o fim do array de dados
//Contas Nivel 3
if ($rec!='16'){
	//Ixibir na tela
	require 'help/tes/relComadepG2.php';
	require 'help/tes/relComadepG3.php';
	require 'help/tes/relComadepGrp.php';
	$nivel3 .= $nivel2;
}elseif ($rec=='16') {
	//impress„o
	require '../help/tes/relComadepG2.php';
	require '../help/tes/relComadepG3.php';
	require '../help/tes/relComadepGrp.php';
	$nivel3 .= $nivel2;
}
	$nivel1 = $grpN2.$grpN3;
//$nivel1 = $nivelNi2;
if ($_GET['tipo']=='4') {
	$nivel2 = $nivelCom01;
} else {
	$nivel2 = $nivel3;
}

?>
