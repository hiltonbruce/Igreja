<?php
controle ('tes');
$ultimolanc = 0;
//$confirma � a vari�vel para filtrar o sql por setor
if (empty($_POST['confirma']) && ($_SESSION['setor']=='2' || $_SESSION['setor']=='99' )) {
	$confirma='2';// O 99 � desenvolvedor, super usu�rio
} elseif (empty($_POST['confirma'])) {
	$confirma=$_SESSION['setor'];
} else {
	$confirma = intval($_POST['confirma']);
}
$roligreja =intval($_POST['igreja']);
$dizimista = new dizresp($roligreja);
//inicializa vari�veis
$totalDeb = 0;
$totalCred = 0;
//$corlinha = false;
$ultimolanc = mysql_query('SELECT max(idlanca) AS lanc FROM lanchist');//Traz o valor do ultimo lan�amento
$lancmaior = mysql_fetch_array($ultimolanc);
$ultimolanc = $lancmaior['lanc']+1;//Acrescenta uma unidade no ultimo lan�amento p usar no lan�amento
$idlancmis = $ultimolanc + 1;//id do lan�amento das provis�es
//Foi criado a tabela lanchist exclusivamente para o hist�rico dos lan�amentos
//Antes de come�ar os lan�amentos verificar se h� inconcist�ncia nos saldo antes de continuar
//Criar uma classe que retorne falso ou verdadeiro
//Analizar os valres para lan�ar o d�zimo para COMADEP e SEMAD
$referente = ($_POST['hist']<>'') ? $_POST['hist']:$_POST['histsug'];//Atribui a vari�vel o hist�rico do lan�amento
$referente = mysql_escape_string($referente);
$data = br_data($_POST['data'], 'Data do lan�amento inv&aacute;lida!');
if ($dizmista->totalgeral()>'0' && $referente!='' && checadata($_POST['data'])) {
	//Faz o lan�amento do d�bito para tabela lancamento
	$sqlFecha  = 'SELECT devedora,tipo,SUM(valor) AS valor,credito ';
	$sqlFecha .= 'FROM dizimooferta WHERE lancamento="0" AND ';
	$sqlFecha .= 'igreja = "'.$roligreja.'" AND (confirma="" || ';
	$sqlFecha .= 'confirma="'.$confirma.'") GROUP BY credito,tipo';
	$tablanc = mysql_query($sqlFecha);
	$exibideb = '<tr class="primary"><td colspan="5">D&eacute;bito</td></tr>';
	$exibicred = '<tr class="primary"><td colspan="5">Cr&eacute;dito</td></tr>';

	$caixaCentral ='';
	$caixaEnsino = '';
	$caixaInfantil ='';
	$caixaMissoes = '';
	$caixaMocidade = '';
	$caixaOutros = '';
	$caixaSenhoras = '';
	$sldAntDev = '';
	$sldAntCred = '';

	$exibir = '';

	$arrayCta = new tes_conta();
	//print_r($arrayCta->ativosArray()['1021']);
	$contaDC = $arrayCta->ativosArray();

	while ($tablancarr = mysql_fetch_array($tablanc)) {
		$debitar = $tablancarr['devedora'];
		//$devedora 	= new DBRecord('contas',$debitar,'acesso');
		if ($sldAntDev=='') {
			#Manter saldo inicial se houver novo lan�amento na conta
		//	$sldAntDev = number_format($devedora->saldo(),2,',','.');
		}
		$credora 	= new DBRecord('contas',$tablancarr['credito'],'acesso');
		if ($sldAntCred =='') {
			#Manter saldo inicial se houver novo lan�amento na conta
			$sldAntCred = number_format($credora->saldo(),2,',','.');
		}
		$contcaixa 	= new atualconta($contaDC[$debitar]['codigo'],$ultimolanc,$credora->id());
		$valor 		= $tablancarr['valor'];
		$contcaixa->atualizar($valor,'D',$roligreja,$data); //Faz o lan�amento na tabela lancamento e atualiza o saldo
		$valorTotal += $valor;
		//Para nivel2='4.2'(Receitas n�o Operacionais) n�o h� provis�o para COMADEP ou Miss�es
		if ($tablancarr['devedora']=='2' && $credora->nivel2()!='4.2') {
			//provis�o para fundo de Miss�es de 40%
			$provmissoes += round(($valor*PROVMISSOES),2);
		}elseif ($credora->nivel2()!='4.2' && $credora->nivel4()!='4.1.1.003') {
			//provis�o para Conven��o de 10%
			$provcomadep += round(($valor*PROVCONVENCAO),2);
		}
		//Exibi lan�amento
		//$caixa = new DBRecord('contas',$tablancarr['devedora'],'acesso');
		$totalDeb = $totalDeb + $valor;

		$caixa = $contaDC[$debitar];
		$valorCred = '';
		if ($caixa['tipo']=='C') {
			$valorDeb = -($valor+$multa);
		} else {
			$valorDeb = $valor+$multa;
		}
		$tipoDC = $contaDC[$debitar]['tipo'];
		require 'help/tes/exibirLancDizOf.php';//monta a tabela para exibir
		$exibir .= $exibi;
	}

	$exibideb .= $exibiCentral.$exibiMissoes.$exibiSenhoras.$exibiMocidade.$exibiInfantil.$exibiEnsino.$exibir;
   	//Lan�a provis�es conta Despesa
	$semaddesp = new atualconta(DESPMISSOES,$idlancmis,11);
   	if ($provmissoes>0) {
   		$semaddesp->atualizar($provmissoes,'D',$roligreja,$data); //Faz o lan�amento, se possuir valor, da provis�o de miss�es - Despesa
   	}
	//$cor = $corlinha ? 'class="odd"' : 'class="dados"';
	$conta = new DBRecord('contas',DESPMISSOES,'codigo');//Exibi lan�amento da provis�o SEMAD
	$sldAntSemad = number_format($conta->saldo()-$provmissoes,2,',','.');//Saldo anterior da conta
	$exibideb .= sprintf("<tr><td>%s - %s</td><td id='moeda'>%s</td><td>&nbsp;</td><td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",
			$conta->codigo(),$conta->titulo(),number_format($provmissoes,2,',','.'),number_format($conta->saldo(),2,',','.'),$conta->tipo()
			,$sldAntSemad);
	$totalDeb = $totalDeb + $provmissoes;
	//$corlinha = !$corlinha;
	$provcomad = new atualconta(DESPCONVENCAO,$idlancmis,10);
	if ($provcomadep>0) {
		$provcomad->atualizar($provcomadep,'D',$roligreja,$data); //Faz o lan�amento, se possuir valor, da provis�o de Comadep - Despesa
	}
	//$cor = $corlinha ? 'class="odd"' : 'class="dados"';
	$conta = new DBRecord('contas',DESPCONVENCAO,'codigo');//Exibi lan�amento da provis�o COMADEP
	$sldAntComadep = number_format($conta->saldo()-$provcomadep,2,',','.');//Saldo anterior da conta
	$exibideb .= sprintf("<tr><td>%s - %s</td><td id='moeda'>%s</td><td>&nbsp;
					</td><td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",$conta->codigo(),$conta->titulo()
					,number_format($provcomadep,2,',','.'),number_format($conta->saldo(),2,',','.'),$conta->tipo()
					,$sldAntComadep);
	$totalDeb = $totalDeb + $provcomadep;
	//$corlinha = !$corlinha;
	$exibideb .= sprintf("<tr class='total'><td>Total debitado</td><td id='moeda'>R$ %s</td><td colspan='3'></td></tr>",number_format($totalDeb,2,',','.'));
	//esta vari�vel � levada p/ o script views/exibilanc.php
	//Faz o leiaute do lan�amento do cr�dito e lan�a para tabela lancamento
	$sqlLanCred  = 'SELECT SUM(valor) AS valor,credito FROM dizimooferta ';
	$sqlLanCred .= 'WHERE lancamento="0" AND igreja =';
	$sqlLanCred .= '"'.$roligreja.'" AND (confirma="" || confirma="'.$confirma.'") ';
	$sqlLanCred .= 'GROUP BY credito';
	$tablanc_c = mysql_query($sqlLanCred);
	while ($tablancarrc = mysql_fetch_array($tablanc_c)) {
		$credora = new DBRecord('contas',$tablancarrc['credito'],'acesso');
		$caixa = $credora;//Para exibir o lan�amento
		$sldAntCrd = number_format($credora->saldo(),2,',','.');//Saldo anterior da conta
		$contcaixa = new atualconta($credora->codigo(),$ultimolanc);
		$contcaixa->atualizar($tablancarrc['valor'],'C',$roligreja,$data); //Faz o lan�amento na tabela lancamento e atualiza o saldo
	//	$cor = $corlinha ? 'class="odd"' : 'class="dados"';
		$exibicred .= '<tr>';
		$exibicred .= '<td>'.$caixa->codigo().' - '.$caixa->titulo().'</td>';
		$exibicred .= '<td>&nbsp;</td>';
		$exibicred .= '<td id="moeda">'.number_format($tablancarrc['valor'],2,',','.').'</td>';
		$exibicred .= '<td id="moeda">'.number_format(($caixa->saldo()+$tablancarrc['valor']),2,',','.');
		$exibicred .= '&nbsp;'.$caixa->tipo().'</td>';
		$exibicred .= '<td class="text-right">'.$sldAntCrd.'</td>';
		$exibicred .= '</tr>';
		$totalCred = $totalCred + $tablancarrc['valor'];
		//$corlinha = !$corlinha;
	}
	//Lan�a provis�es conta credora no Ativo
	$histProvisao = '';
	$provsemad = new atualconta('1.1.1.001.007',$idlancmis);
	if ($provmissoes>0) {
		$provsemad->atualizar($provmissoes,'C',$roligreja,$data); //Faz o lan�amento, se possuir valor, da provis�o de miss�es - Ativo
		$histProvisao = 'Valor provisionado para SEMAD sobre a receita nesta data';
	}
	//$cor = $corlinha ? 'class="odd"' : 'class="dados"';
	$conta = new DBRecord('contas','7','acesso');//Exibi lan�amento da provis�o SEMAD
	$antProvSemad = number_format($conta->saldo()-$provmissoes,2,',','.');//Saldo anterior da conta
	$exibicred .= sprintf("<tr><td>%s - %s</td><td>&nbsp;</td><td id='moeda'>%s</td><td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",
	$conta->codigo(),$conta->titulo(),number_format($provmissoes,2,',','.'),number_format($conta->saldo(),2,',','.'),$conta->tipo()
	,$antProvSemad);
	$totalCred = $totalCred + $provmissoes;
	//$corlinha 	= !$corlinha;
	$provcomad 	= new atualconta('1.1.1.001.006',$idlancmis); //Faz o lan�amento da provis�o de Comadep - Ativo
	if ($provcomadep) {
		$provcomad->atualizar($provcomadep,'C',$roligreja,$data);//Faz o lan�amento, se possuir valor, da provis�o da COMADEP - Ativo
		if ($histProvisao=='') {
			$histProvisao = 'Valor provisionado para COMADEP sobre a receita nesta data';
		}else {
			$histProvisao = 'Valor provisionado para SEMAD e COMADEP sobre a receita nesta data';
		}
	}
	//$cor 		= $corlinha ? 'class="odd"' : 'class="dados"';
	$conta 		= new DBRecord('contas','6','acesso');//Exibi lan�amento da provis�o COMADEP
	$antProvComadep = number_format($conta->saldo()-$provcomadep,2,',','.');//Saldo anterior da conta
	$exibicred .= sprintf("<tr><td>%s - %s</td><td>&nbsp;</td><td id='moeda'>%s</td><td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",
	$conta->codigo(),$conta->titulo(),number_format($provcomadep,2,',','.'),number_format($conta->saldo(),2,',','.'),$conta->tipo()
	,$antProvComadep);
	$totalCred 	= $totalCred + $provcomadep;
	$exibicred .= sprintf("<tr class='total'><td colspan='2'>Total Creditado</td><td id='moeda'>R$ %s</td><td colspan='2'></td></tr>",number_format($totalCred,2,',','.'));
	//esta vari�vel � levada p/ o script views/exibilanc.php que chamado ao final deste loop numa linha abaixo
	//Atualiza a tabela dizimooferta de acordo com a igreja selecionada inserido o id do lan�amento no campo lan�amento
	$sqlAtuaTad  = 'SELECT id FROM dizimooferta WHERE lancamento="0" AND igreja = "';
	$sqlAtuaTad .= $roligreja.'" AND (confirma="" || confirma="'.$confirma.'") ';
	$sqlAtuaTad .= '';
	$sqlAtuaTad .= '';
	$atualdizoferta = mysql_query($sqlAtuaTad) or die (mysql_error());
	while ($lanc = mysql_fetch_array($atualdizoferta)) {
			$ofetdiz = new DBRecord('dizimooferta',$lanc['id'],'id');
			$ofetdiz->lancamento = $ultimolanc;
			$ofetdiz->UpdateID();
		}
	//Lan�a o hist�rico do lan�amento
	$InsertHist = sprintf("null,'%s','%s','%s'",$ultimolanc,$referente,$roligreja);
	$lanchist = new incluir($InsertHist, 'lanchist');
	$lanchist->inserir();
	//echo "Miss�es: $provmissoes, Comadep: $provcomadep";
	//inserir o hist�rico do lan�amento das provis�es na tabela lanchist
	//Lan�a o hist�rico do lan�amento das provis�es
	$HistProv = sprintf("null,'%s','%s','%s'",$idlancmis,$histProvisao,$roligreja);
	$lanchist = new incluir($HistProv, 'lanchist');
	$lanchist->inserir();
	$dtLanc = new DateTime (br_data($_POST['data']));
	$exibiRodape .= '<tr class="success"><td colspan="3">Data: '.$dtLanc->format('d/m/Y').'</td>';
	$linkImpDia   = './controller/modeloPrint.php/?tipo=1&rec=0&igreja='.$roligreja;
	$linkImpDia  .= '&ano='.$dtLanc->format('Y').'&mes='.$dtLanc->format('m').'&dia='.$dtLanc->format('d');
	$tesSede = new cargoigreja();
	$dadoCarg = $tesSede->Arrayusuario();
	$linkImpDia  .= '&r1='.$dadoCarg[22][1]['rol'].'&r2='.$dadoCarg[22][2]['rol'];
	$linkImpDia  .= '&r3='.$dadoCarg[22][3]['rol'].'&r4='.$dadoCarg[22][4]['rol'];
	$exibiRodape .= '<td colspan="2"><a target=_blank href="'.$linkImpDia.'" >';
	$exibiRodape .= '<button type="button" class="btn btn-primary btn-xs">';
	$exibiRodape .= '<span class="glyphicon glyphicon-print"></span> Imprimir este dia...</button></a></td></tr>';
	//Rodap� lo lan�amento
	require_once 'views/exibilanc.php'; //Exibi a tabela com o lan�amento conclu�do
}else {
	 //Fim do 1� if linha 7
	if ($referente=='' && $dizmista->totalgeral()=='') {
		$mensagem = 'N�o existe nada a ser lan�ado!';
	}elseif ($referente=='') {
		$mensagem = 'Voc� n�o informou o motivo do lan�amento!' ;
	}else {
		$mensagem = 'N�o exite valores a ser lan�ado!';
	}
	echo '<script>alert("'.$mensagem.'");location.href="./?escolha=tesouraria/receita.php";</script>';
	echo $mensagem;
}
?>
<div class="col-xs-3">
	<label>Pr�xima Igreja: </label>
		<select name="igreja" id="igreja" class="form-control"  autofocus='autofocus'
			onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>" >
			<?php
				$linkAcesso  = 'escolha=tesouraria/receita.php&menu=top_tesouraria';
				$linkAcesso .= '&rec=1&igreja=';
				$bsccredor = new List_sele('igreja', 'razao', 'rolIgreja');
				$listaIgreja = $bsccredor->List_Selec_pop($linkAcesso,'');
				//echo $listaIgreja;
			?>
	</select>
</div>
<div class="col-xs-4">
	<a href="<?php echo $linkLancamento;?>&rec=1">
	<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			<button type="button" class="btn btn-primary" tabindex="<?PHP echo ++$ind; ?>" >
				Pr�ximo culto: <?php echo $igrejaSelecionada->razao();?></button>
		</a>
</div>
<div class="col-xs-3"><label>&nbsp;</label>
	<a href='./?escolha=tesouraria/receita.php&menu=top_tesouraria&igreja=<?PHP echo $roligreja;?>&rec=2'>
		<button class='btn btn-primary' autofocus='autofocus' tabindex="<?PHP echo ++$ind; ?>">
			Fazer outro Lan&ccedil;amento!
		</button>
	</a>
</div>
