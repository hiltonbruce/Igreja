<?PHP
//Contas Nivel 3, tipo: 1.1.1
	$sldN3 = number_format(abs($saldoGrp[$planoCta[$ctaCred]['nivel3']]),2,',','.');
	$sldGrupoCta = $saldoGrp[$planoCod[$ctaAtualN3]['nivel3']];//Sld do movimento grupo nível 3
	$movSld = number_format(abs($sldGrupoCta),2,',','.');
	if ($sldGrupoCta > 0) {
		$movSld .=  $dev;
	} elseif ($sldGrupoCta < 0) {
		$movSld .= $cred;
	} else {
		$movSld = '--o--';
	}
	$sldGrupoCtaAnte = $saldoAnteGrp[$planoCod[$ctaAtualN3]['nivel3']];//Sld anterior grupo nível 3
	$saldoAntr = number_format(abs($sldGrupoCtaAnte),2,',','.');
	if ($sldGrupoCtaAnte > 0) {
		$saldoAntr .=  $dev;
	} elseif ($sldGrupoCtaAnte < 0) {
		$saldoAntr .= $cred;
	} else {
		$saldoAntr = '--o--';
	}
	$sldGrupoAtual = $sldGrupoCta+$sldGrupoCtaAnte;//Sld atual grupo nível 3
	$saldoAtual = number_format(abs($sldGrupoAtual),2,',','.');
	if ($sldGrupoCtaAnte > 0) {
		$saldoAtual .=  $dev;
	} elseif ($sldGrupoCtaAnte < 0) {
		$saldoAtual .= $cred;
	} else {
		$saldoAtual = '--o--';
	}
	#$movSld = ($sldGrupoCta > '0') ? $dev : $cred ;
	#$saldoAtual = ($sldGrupoAtual > '0') ? $dev : $cred ;
	#$saldoAntr = ($sldGrupoCtaAnte > '0') ? $dev: $cred;
if ($movSld !='--o--' || $saldoAtual !='--o--' || $saldoAntr !='--o--') {
	$nivelN3  = '<tr class="primary"><td>'.$planoCod[$ctaAtualN4]['nivel3'].'</td>';
	$nivelN3 .=	'<td title="'.$title.'">'.$planoCod[$planoCod[$ctaAtualN3]['nivel3']]['titulo'];
	$nivelN3 .=	'</td><td class="text-right">'.$movSld;
	$nivelN3 .=	'</td><td class="text-right">';
	$nivelN3 .=	$saldoAtual.'</td>';
	$nivelN3 .=	'<td class="text-right">';
	$nivelN3 .=	$saldoAntr.'</td></tr>';
	$nivel3   .= $nivelN3.$nivel2;
//	$nivelNi2 .= $nivelN02.$nivelN3.$nivelN2;
	$grpN3 .= $nivelN3.$nivel2;
	$nivelCom01 .= $nivelN3.$nivelCom02;
}
	$nivelCom02 = '';
	$nivel2 = '';
	$nivelN2 = '';
	$nivelN02 = '';
	$nivelN3 = '';
