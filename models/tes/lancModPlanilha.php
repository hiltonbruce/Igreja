<?php
controle ('tes');
//inicializa variáveis
$corlinha = false;
	//$credora 	= new DBRecord('contas',$creditar,'acesso');
	//$devedora 	= new DBRecord('contas',$debitar,'acesso');
	$sldAntDev = number_format($contaDC[$debitar]['saldo'],2,',','.');
	$sldAntCred = number_format($contaDC[$creditar]['saldo'],2,',','.');
	if ($contaDC[$creditar]['tipo']=='D' && ($contaDC[$creditar]['saldo']-($valor))<'0') {
	 $msgErro  = 'Saldo n&atilde;o permitido para Conta: '.$contaDC[$creditar]['titulo'];
	 $msgErro .= ' que ficaria com o valor de '.($contaDC[$creditar]['saldo']-$valor);
 }elseif ($contaDC[$debitar]['tipo']=='C' && ($contaDC[$debitar]['saldo']-$valor)<'0'){
		$msgErro  = 'Saldo n&atilde;o permitido para Conta: '.$contaDC[$debitar]['titulo'];
		$msgErro .= ' que ficaria com o valor de '.($contaDC[$debitar]['saldo']-$valor);
	}else {
	 $msgErro='';
	}
	$ultimoLancNumero = mysql_query('SELECT max(lancamento) AS lanc FROM lancamento');//Traz o valor do ultimo lançamento
	$lancmaior = mysql_fetch_array($ultimoLancNumero);
	$ultimolanc = intval($lancmaior['lanc'])+1;//Acrescenta uma unidade no ultimo lançamento p usar no lançamento
//Foi criado a tabela lanchist exclusivamente para o histórico dos lançamentos
//Antes de começar os lançamentos verificar se h� inconcistencia nos saldo antes de continuar
//Criar uma classe que retorne falso ou verdadeiro
//Analizar os valores para lançar o dízimo para COMADEP e SEMAD
if ($msgErro=='') {
	//Faz o lançamento do débito da tabela lancamento
	//$exibideb  .= '<tr><td colspan="4">Debito</td></tr>';
	//$exibicred .= '<tr><td colspan="4">Credito</td></tr>';
	$caixaCentral ='';$caixaEnsino = '';$caixaInfantil ='';
	$caixaMissoes = '';$caixaMocidade = '';$caixaOutros = '';
	$caixaSenhoras = '';
	//echo $credora->id().'<h1> tste </h>';
	$contcaixa 	= new atualconta($contaDC[$debitar]['codigo'],$ultimolanc,$contaDC[$creditar]['id']);
	$histLac = $referente;
	$contcaixa->atualizar($valor,'D',$rolIgreja,$data); //Faz o lançamento na tabela lancamento e atualiza o saldo
	$valorTotal += $valor;
	//print_r($credora);
	//Exibi lançamento
	//$caixa = new DBRecord('contas',$debitar,'acesso');

	$totalDeb = $totalDeb + $valor;

	$caixa = $contaDC[$debitar];
	$valorCred = '';
	if ($caixa['tipo']=='C') {
		$valorDeb = -$valor;
	} else {
		$valorDeb = $valor;
	}
	$tipoDC = $contaDC[$debitar]['tipo'];
	require 'help/tes/exibirLancamento.php';//monta a tabela para exibir
	$exibideb .= $exibi;

//	$igLanc = new DBRecord('igreja',$rolIgreja,'rol');//Exibi o nome da igreja no lanç.
	$exibideb .= $exibiCentral.$exibiMissoes.$exibiSenhoras.$exibiMocidade.$exibiInfantil.$exibiEnsino/*.$exibi*/;
	//esta variável é levada p/ o script views/exibilanc.php
	//Faz o leiaute do lançamento do crédito da tabela lancamento
	$contcaixa = new atualconta($contaDC[$creditar]['codigo'],$ultimolanc,'');
	$contcaixa->atualizar($valor,'C',$rolIgreja,$data); //Faz o lançamento na tabela lancamento e atualiza o saldo
	//$cor = $corlinha ? 'class="odd"' : 'class="dados"';

	//$caixa = new DBRecord('contas',$creditar,'acesso');//Exibi lançamento
	$caixa = $contaDC[$creditar];
	$valorDeb = '';
	if ($caixa['tipo']=='D') {
		$valorCred = -$valor;
	} else {
		$valorCred = $valor;
	}
	$tipoDC = $contaDC[$creditar]['tipo'];
	require 'help/tes/exibirLancamento.php';//monta a tabela para exibir
	$exibicred .= $exibi;

	//$exibicred .= sprintf("<tr $cor ><td>%s - %s</td><td>&nbsp;</td><td id='moeda'>%s</td><td id='moeda'>%s&nbsp;%s</td><td id='moeda'>%s</td></tr>",
	//$caixa->codigo(),$caixa->titulo(),number_format($valor,2,',','.'),number_format($caixa->saldo(),2,',','.'),$caixa->tipo(),
	//$sldAntCred);
	$totalCred += $valor;
	$corlinha = !$corlinha;
	//esta variável é levada p/ o script views/exibilanc.php que chamado ao final deste loop numa linha abaixo
	//$exibicred .= sprintf("<tr class='total'><td colspan='2'>Total Creditado</td><td id='moeda'>R$ %s</td><td></td></tr>",number_format($totalCred,2,',','.'));
	//Lança o histórico do lançamento
	if ($referente!='') {
		$InsertHist = sprintf("'','%s','%s','%s'",$ultimolanc,$referente,$rolIgreja);
		$lanchist = new incluir($InsertHist, 'lanchist');
		$lanchist->inserir();
	}
	//require_once 'views/exibilanc.php'; //Exibi a tabela com o lançamento concluído
}
