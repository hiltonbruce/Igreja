<?PHP
//Contas Nivel 2, tipo: 1.1
	$sldN2 = number_format(abs($saldoGrp[$planoCta[$ctaCred]['nivel2']]),2,',','.');
	$sldGrupoCta = $saldoGrp[$planoCod[$ctaAtualN2]['nivel2']];//Sld do movimento grupo nível 2
	$movSld = number_format(abs($sldGrupoCta),2,',','.');
	if ($sldGrupoCta > 0 && $movSld != '0,00' ){
		$movSld .=  $dev;
	} elseif ($sldGrupoCta < 0 && $movSld != '0,00' ) {
		$movSld .= $cred;
	} else {
		$movSld = '--o--';
	}
	$sldGrupoCtaAnte = $saldoAnteGrp[$planoCod[$ctaAtualN2]['nivel2']];//Sld anterior grupo nível 2
	$saldoAntr = number_format(abs($sldGrupoCtaAnte),2,',','.');
	if ($sldGrupoCtaAnte > 0 && $saldoAntr != '0,00' ) {
		$saldoAntr .=  $dev;
	} elseif ($sldGrupoCtaAnte < 0 && $saldoAntr != '0,00' ) {
		$saldoAntr .= $cred;
	} else {
		$saldoAntr = '--o--';
	}
	$sldGrupoAtual = $sldGrupoCta+$sldGrupoCtaAnte;//Sld atual grupo nível 2
	$saldoAtual = number_format(abs($sldGrupoAtual),2,',','.');
	if ($sldGrupoCtaAnte > 0 && $saldoAtual != '0,00' ) {
		$saldoAtual .=  $dev;
	} elseif ($sldGrupoCtaAnte < 0 && $saldoAtual != '0,00' ) {
		$saldoAtual .= $cred;
	} else {
		$saldoAtual = '--o--';
	}
	#$movSld = ($sldGrupoCta > '0') ? $dev : $cred ;
	#$saldoAtual = ($sldGrupoAtual > '0') ? $dev : $cred ;
	#$saldoAntr = ($sldGrupoCtaAnte > '0') ? $dev: $cred;
if ($movSld !='--o--' || $saldoAtual !='--o--' || $saldoAntr !='--o--') {
	$nivelN02  = '<tr class="primary"><td>'.$planoCod[$ctaAtualN4]['nivel2'].'</td>';
	$nivelN02 .=	'<td title="'.$title.'">'.$planoCod[$planoCod[$ctaAtualN2]['nivel2']]['titulo'];
	$nivelN02 .=	'</td><td class="text-right">'.$movSld;
	$nivelN02 .=	'</td><td class="text-right">';
	$nivelN02 .=	$saldoAtual.'</td>';
	$nivelN02 .=	'<td class="text-right">';
	$nivelN02 .=	$saldoAntr.'</td></tr>';
	$grpN2 .= $nivelN02.$grpN3;
}
	$grpN3 = '';
