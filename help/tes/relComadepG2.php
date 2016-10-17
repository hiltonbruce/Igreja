<?PHP
//Contas Nivel 4, tipo: 1.1.1.001
	$sldGrupoCta = $saldoGrp[$planoCod[$ctaAtualN4]['nivel4']];//Sld do movimento grupo nível 4
	$movSld = number_format(abs($sldGrupoCta),2,',','.');
	if ($sldGrupoCta > 0) {
		$movSld .=  $dev;
	} elseif ($sldGrupoCta < 0) {
		$movSld .= $cred;
	} else {
		$movSld = '--o--';
	}
	$sldGrupoCtaAnte = $saldoAnteGrp[$planoCod[$ctaAtualN4]['nivel4']];//Sld anterior grupo nível 4
	$saldoAntr = number_format(abs($sldGrupoCtaAnte),2,',','.');
	if ($sldGrupoCtaAnte > 0) {
		$saldoAntr .=  $dev;
	} elseif ($sldGrupoCtaAnte < 0) {
		$saldoAntr .= $cred;
	} else {
		$saldoAntr = '--o--';
	}
	$sldGrupoAtual = $sldGrupoCta+$sldGrupoCtaAnte;//Sld atual grupo nível 4
	$saldoAtl = number_format(abs($sldGrupoAtual),2,',','.');
	if ($sldGrupoCtaAnte > 0) {
		$saldoAtl .=  $dev;
	} elseif ($sldGrupoCtaAnte < 0) {
		$saldoAtl .= $cred;
	} else {
		$saldoAtl = '--o--';
	}
	$nivelGrupo =$planoCod[$ctaAtualN4]['nivel4'].'</td><td title="'.$title.'">'
		.$planoCod[$planoCod[$ctaAtualN4]['nivel4']]['titulo'].'</td><td id="moeda">'.$movSld
		.'</td><td id="moeda">'.$saldoAtl.'</td>
		<td id="moeda">'.$saldoAntr.'</td></tr>';
	$nivelGrupoN2 = '<tr><td>'.$nivelGrupo;
	$nivelCom02 .= '<tr><td>'.$nivelGrupo;
	$nivelGrupo = '<tr class="danger"><td>'.$nivelGrupo;
	$codAcesso = sprintf ("%'04u",$planoCod[$chave]['acesso']);
	$nivel2 .= $nivelGrupo.$nivel1;
	$nivelN2 .= $nivelGrupoN2;
	//Contas Nivel codigo, tipo: 1.1.1.001.001
	$nivel1 = '<tr><td>'.$chave.'</td><td title="'.$title.'">'.'['.$codAcesso.'] - '.$planoCod[$chave]['titulo'].
		'</td><td id="moeda">'.$vlrSaldo.'</td><td id="moeda">'.$vlrSaldoAtual.'</td><td id="moeda">'.$vlrSaldoAnte.'</td></tr>';
