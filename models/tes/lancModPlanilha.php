<?php
controle ('tes');
//inicializa variáveis
$corlinha = false;

	$credora 	= new DBRecord('contas',$creditar,'acesso');
	$devedora 	= new DBRecord('contas',$debitar,'acesso');

	if ($credora->tipo()=='D' && ($credora->saldo()-($valor))<'0') {
	 $msgErro = 'Saldo não permitido para Conta: '.$credora->titulo().' que ficaria com o valor de '.($credora->saldo()-$valor);
	}elseif ($devedora->tipo()=='C' && ($devedora->saldo()-$valor)<'0'){
	 $msgErro = 'Saldo não permitido para Conta: '.$devedora->titulo().' que ficaria com o valor de '.($devedora->saldo()-$valor);
	}else {
	 $msgErro='';
	}

	$ultimoLancNumero = mysql_query('SELECT max(lancamento) AS lanc FROM lancamento');//Traz o valor do ultimo lançamento
	$lancmaior = mysql_fetch_array($ultimoLancNumero);
	$ultimolanc = (int)$lancmaior['lanc']+1;//Acrescenta uma unidade no ultimo lançamento p usar no lançamento

//Foi criado a tabela lanchist exclusivamente para o histórico dos lançamentos
//Antes de começar os lançamentos verificar se há inconcistência nos saldo antes de continuar
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

		$contcaixa 	= new atualconta($devedora->codigo(),$ultimolanc,$credora->id());
		$histLac = $referente;
		$contcaixa->atualizar($valor,'D',$rolIgreja,$data); //Faz o lançamento na tabela lancamento e atualiza o saldo
		$valorTotal += $valor;
//print_r($credora);

	//Exibi lançamento
	$caixa = new DBRecord('contas',$debitar,'acesso');
	$totalDeb = $totalDeb + $valor;
	require 'help/tes/exibirLancamento.php';//monta a tabela para exibir

	$exibideb .= $exibiCentral.$exibiMissoes.$exibiSenhoras.$exibiMocidade.$exibiInfantil.$exibiEnsino.$exibi;
	//esta variável é levada p/ o script views/exibilanc.php

	//Faz o leiaute do lançamento do crédito da tabela lancamento
		$contcaixa = new atualconta($credora->codigo(),$ultimolanc,'');
		$contcaixa->atualizar($valor,'C',$rolIgreja,$data); //Faz o lançamento na tabela lancamento e atualiza o saldo

		$cor = $corlinha ? 'class="odd"' : 'class="dados"';
		$caixa = new DBRecord('contas',$creditar,'acesso');//Exibi lançamento
		$exibicred .= sprintf("<tr $cor ><td>%s - %s</td><td>&nbsp;</td><td id='moeda'>%s</td><td id='moeda'>%s&nbsp;%s</td></tr>",
		$caixa->codigo(),$caixa->titulo(),number_format($valor,2,',','.'),number_format($caixa->saldo(),2,',','.'),$caixa->tipo());
		$totalCred += $valor;
		$corlinha = !$corlinha;

	//esta variável é levada p/ o script views/exibilanc.php que chamado ao final deste loop numa linha abaixo
	//$exibicred .= sprintf("<tr class='total'><td colspan='2'>Total Creditado</td><td id='moeda'>R$ %s</td><td></td></tr>",number_format($totalCred,2,',','.'));

	//Lança o histórico do lançamento
	$InsertHist = sprintf("'','%s','%s','%s'",$ultimolanc,$referente,$rolIgreja);
	$lanchist = new incluir($InsertHist, 'lanchist');
	$lanchist->inserir();

	//require_once 'views/exibilanc.php'; //Exibi a tabela com o lançamento concluído

}
