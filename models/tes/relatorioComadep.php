<?php
$nivel1 	= '';
$nivel2 	= '';
$comSaldo	= '';$planoCta=array();$saldo=array();$cor=true;$sldGrupo=array();

$plano = mysql_query('SELECT * FROM contas ORDER BY codigo ');
while ($cta = mysql_fetch_array($plano)) {
	$planoCta[$cta['id']]=array($cta['titulo'],$cta['acesso'],$cta['codigo'],$cta['tipo'],$cta['nivel4']);
	$planoGrupo[$cta['codigo']]=array($cta['titulo'],$cta['codigo'],$cta['tipo']);
}

//print_r($planoCta);

$lista = mysql_query('SELECT  * FROM lancamento WHERE DATE_FORMAT(data,"%Y%m")="'.$mesRelatorio.'" ORDER BY conta ') or die(mysql_error());

while ($contas = mysql_fetch_array($lista)) {
	if ($contas['d_c']=='D') {
		$saldo[$contas['conta']] += $contas['valor'];
		$sldGrupo [$planoCta[$contas['conta']]['4']] += $contas['valor'];
	}else {
		$saldo[$contas['conta']] -= $contas['valor'];
		$sldGrupo [$planoCta[$contas['conta']]['4']] -= $contas['valor'];
	}
	
}

$ctaAtual = '';
//print_r($sldGrupo);
//print_r($saldo);

//echo $planoCta['5']['4'];

foreach ($saldo AS $chave => $valor){
	
		$bgcolor = ($cor) ? 'style="background:#ffffff"' : 'style="background:#d0d0d0"';
		$acesso = sprintf("[%04s]\n", $planoCta[$chave]['1']);
		$vlrSaldo = abs($saldo[$chave]);
		
		if ($planoCta[$chave]['3']=='D') {
			$debito += $vlrSaldo;
			
		}else {
			$credito += $vlrSaldo;
		}
		
		$vlrSaldo = number_format($vlrSaldo,2,',','.').$planoCta[$chave]['3'];
		
		//echo $planoCta[$chave]['4'].' -- ';
		
		if ($ctaAtual==$planoCta[$chave]['4'] || $ctaAtual==''){
			//Contas simples
			$nivel1 .='<tr '.$bgcolor.'><td>'.$planoCta[$chave]['2'].'</td><td>'.$acesso.'</td><td title="'.$title.'">'.$planoCta[$chave]['0'].
			'</td><td id="moeda"></td><td id="moeda">'.$vlrSaldo.'</td></tr>';
			$sldGrupoCta = abs($sldGrupo [$planoCta[$chave]['4']]);
		}else {
			//Grupo de contas
			$bgcolorGrp = 'style="background:#B0C4DE; color:#000;border-bottom: 1px dashed #1e90ff;"';
			$nivelGrupo ='<tr '.$bgcolorGrp.'><td>'.$planoGrupo[$ctaAtual]['1'].'</td><td></td><td title="'.$title.'">
			'.$planoGrupo[$ctaAtual]['0'].'</td><td id="moeda">'.number_format($sldGrupoCta,2,',','.').$planoGrupo[$ctaAtual]['2'].'</td><td></td></tr>';
			if ($nivel2=='') {
				$nivel2 .=$nivelGrupo.$nivel1;
			}else {
				$nivelGrupo = $nivel2.$nivelGrupo.$nivel1;
				$nivel2 = $nivelGrupo;
				$nivelGrupo ='';
			}
			
			$saldoAtual=0;
			$sldGrupoCta = abs($sldGrupo [$planoCta[$chave]['4']]);
			
			if ($cor==false) {
				$cor = !$cor;
				$bgcolor = ($cor) ? 'style="background:#ffffff"' : 'style="background:#d0d0d0"';
			}
				
			//Contas simples
			$nivel1 ='<tr '.$bgcolor.'><td>'.$planoCta[$chave]['2'].'</td><td>'.$acesso.'</td><td title="'.$title.'">'.$planoCta[$chave]['0'].
			'</td><td id="moeda"></td><td id="moeda">'.$vlrSaldo.'</td></tr>';
		}
		
			$cor = !$cor;
		
		$ctaAtual = $planoCta[$chave]['4'];
		
			
}

//print_r($planoGrupo);
/*
 * 
 * 

		if ($contas['saldo']<'0' && $contas['tipo']=='D') {
		   $tipoCta = 'C';
		}elseif ($contas['saldo']<'0' && $contas['tipo']=='C') {
		  $tipoCta = 'D';
		}else {
		 $tipoCta = $contas['tipo'];
		}
		$sldConta = (abs($contas['saldo']));
		

		
	$acesso = ($contas['acesso']>0) ? sprintf("[%04s]\n", $contas['acesso']):'';
	//Balancete de todas as contas
		$title = $contas['descricao'];
	if (strlen($contas['codigo'])<10) {
		//Grupo de contas
		$bgcolor = 'style="background:#B0C4DE; color:#000;border-bottom: 1px dashed #1e90ff;"';
		$nivel1 .='<tr '.$bgcolor.'><td>'.$contas['codigo'].'</td><td>'.$acesso.'</td><td title="'.$title.'">'.$planoCta[$contas['conta']]['titulo'].
		'</td><td></td><td id="moeda">'.number_format($sldConta,2,',','.').$tipoCta.'</td></tr>';
		$cor= true;
	}else {
		//Contas
		$bgcolor = $cor ? 'style="background:#ffffff"' : 'style="background:#d0d0d0"';
		
		
		$nivel1 .='<tr '.$bgcolor.'><td>'.$contas['codigo'].'</td><td>'.$acesso.
				'</td><td title="'.$title.'">'.$contas['titulo'].'</td><td id="moeda">'
				.number_format($sldConta,2,',','.').$tipoCta.'</td><td></td></tr>';
		$cor = !$cor;
	}

	//Balancete de todas as contas com saldo
	if ($contas['saldo']!=0) {
		if (strlen($contas['codigo'])<10) {
			//Grupo de contas
			$bgcolor2 = 'style="background:#B0C4DE; color:#000;border-bottom: 1px dashed #1e90ff;"';
			$nivel2 .='<tr '.$bgcolor2.'><td>'.$contas['codigo'].'</td><td>'.$acesso.'</td><td title="'.$title.'">'.$planoCta[$contas['conta']]['titulo'].
			'</td><td></td><td id="moeda">'.number_format($sldConta,2,',','.').$tipoCta.'</td></tr>';
			$cor2 = true;
		}else {
			//Contas
			$bgcolor2 = $cor2 ? 'style="background:#ffffff"' : 'style="background:#d0d0d0"';
			$nivel2 .='<tr '.$bgcolor2.'><td>'.$contas['codigo'].'</td><td>'.$acesso.'</td>
					<td title="'.$title.'">'.$contas['titulo'].'</td><td id="moeda">'
					.number_format($sldConta,2,',','.').$tipoCta.'</td><td></td></tr>';
			$cor2 = !$cor2;
		}
	}
	if ($contas['tipo']=='D' && $contas['acesso']!='0') {
		$debito += $contas['saldo'];
	}elseif ($contas['tipo']=='C' && $contas['acesso']!='0') {
		$credito += $contas['saldo'];
	}
 * 
 * 
 */

?>
