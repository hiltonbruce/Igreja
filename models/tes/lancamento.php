<?php
controle ('tes');
$provmissoes=0;
$ultimolanc = 0;
$roligreja =(int) $_POST['rolIgreja'];
#$motivoComplemento = (empty($_POST['nome'])) ? $_POST['credor']:$_POST['nome'];
if (!empty($_POST['nome'])) {
	$motivoComplemento = ' ('.$_POST['nome'].')';
} elseif (!empty($_GET['nome'])) {
	$motivoComplemento = ' ('.$_GET['nome'].')';
} else {
	$motivoComplemento = '';
}

if ($_POST['valor']<='0' || $_POST['acessoDebitar']<1 || $_POST['acessoCreditar']<1) {
	$dizimista = false;
}else {
	$status = true;
	$valor = (empty($valor_us)) ? strtr( str_replace(array('.'),array(''),$_POST['valor']), ',.','.,' ):$valor_us;
	$debitar = $_POST['acessoDebitar'];
	$creditar =  $_POST['acessoCreditar'];
}

//inicializa variáveis
$totalDeb = 0;
$totalCred = 0;
$corlinha = false;

	$credora 	= new DBRecord('contas',$creditar,'acesso');
	$devedora 	= new DBRecord('contas',$debitar,'acesso');

	if ($credora->tipo()=='D' && ($credora->saldo()-$valor)<'0') {
	 $msgErro = 'Saldo não permitido para Conta: '.$credora->titulo().' que ficaria com o valor de '.($credora->saldo()-$valor);
	}elseif ($devedora->tipo()=='C' && ($devedora->saldo()-$valor)<'0'){
	 $msgErro = 'Saldo não permitido para Conta: '.$debitar->titulo().' que ficaria com o valor de '.($debitar->saldo()-$valor);
	}else {
	 $msgErro='';
	}


	if ($credora->nivel4()=='1.1.1.001') {
	 ;//testar se cta de caixa e não permitir o lancamento se ficar negativo e a de despesas tb
	}

	$ultimoLancNumero = mysql_query('SELECT max(lancamento) AS lanc FROM lancamento');//Traz o valor do ultimo lançamento
	$lancmaior = mysql_fetch_array($ultimoLancNumero);
	$ultimolanc = (int)$lancmaior['lanc']+1;//Acrescenta uma unidade no ultimo lançamento p usar no lançamento

//Foi criado a tabela lanchist exclusivamente para o histórico dos lançamentos
//Antes de começar os lançamentos verificar se há inconcistência nos saldo antes de continuar
//Criar uma classe que retorne falso ou verdadeiro
//Analizar os valores para lançar o dízimo para COMADEP e SEMAD

$referente = (strlen($_POST['referente'])>'4') ? $_POST['referente']:false;//Atribui a variável o histórico do lançamento

$data = br_data($_POST['data'], 'Data do lançamento inválida!');

if ($status && $referente && checadata($_POST['data']) && $msgErro=='') {

	//Faz o lançamento do débito da tabela lancamento
	$exibideb = '<tr><td colspan="4">Debito</td></tr>';
	$exibicred = '<tr><td colspan="4">Credito</td></tr>';

	$caixaCentral ='';$caixaEnsino = '';$caixaInfantil ='';
	$caixaMissoes = '';$caixaMocidade = '';$caixaOutros = '';
	$caixaSenhoras = '';
	echo $credora->id().'<h1> tste </h>';

		$contcaixa 	= new atualconta($devedora->codigo(),$ultimolanc,$credora->id());
		$histLac = $referente.$motivoComplemento;
		$contcaixa->atualizar($valor,'D',$roligreja,$histLac); //Faz o lançamento na tabela lancamento e atualiza o saldo
		$valorTotal += $valor;
//print_r($credora);
		if ($credora->nivel2()=='4.1') {
			//Receitas operacionais faz provisão automaticamente
			if ($debitar=='2') {
				//Provisão para Missões
				$provmissoes += $valor*0.4;
			}elseif ($devedora->nivel4()=='1.1.1.001' && $devedora->acesso()>0 && $devedora->tipo()=='D') {
				//Para tipo 8 não há provisão para COMADEP ou Missões
				$provcomadep += $valor*0.1;
			}

		}

		//Exibi lançamento
		$caixa = new DBRecord('contas',$debitar,'acesso');
		$totalDeb = $totalDeb + $valor;
		require 'help/tes/exibirLancamento.php';//monta a tabela para exibir


	$exibideb .= $exibiCentral.$exibiMissoes.$exibiSenhoras.$exibiMocidade.$exibiInfantil.$exibiEnsino.$exibi;

   	//Lança provisões conta Despesa
   	if ($provmissoes>0) {
		$semaddesp = new atualconta('3.1.6.001.005',$ultimolanc,'11');//SEMAD (Sec de Missões) provisão e despesa
		$semaddesp->atualizar($provmissoes,'D',$roligreja,'Valor provisionado para SEMAD sobre a receita nesta data'); //Faz o lançamento da provisão de missões - Despesa
   	}
	$cor = $corlinha ? 'class="odd"' : 'class="dados"';
	$conta = new DBRecord('contas','3.1.6.001.005','codigo');//Exibi lançamento da provisão SEMAD
	$exibideb .= sprintf("<tr $cor ><td>%s - %s</td><td id='moeda'>%s</td><td>&nbsp;</td><td id='moeda'>%s&nbsp;%s</td></tr>",
			$conta->codigo(),$conta->titulo(),number_format($provmissoes,2,',','.'),
			number_format($conta->saldo(),2,',','.'),$conta->tipo());
	$totalDeb += $provmissoes;
	$corlinha = !$corlinha;

	$provcomad = new atualconta('3.1.1.001.007',$ultimolanc,'10');//Convenção estadual COMADEP
	if ($provcomadep>0) {
		$provcomad->atualizar($provcomadep,'D',$roligreja,'Valor provisionado para COMADEP sobre a receita nesta data'); //Faz o lançamento da provisão de Comadep - Despesa
		$totalDeb += $provcomadep;
	}
	$cor = $corlinha ? 'class="odd"' : 'class="dados"';
	$conta = new DBRecord('contas','3.1.1.001.007','codigo');//Exibi lançamento da provisão SEMAD
	$exibideb .= sprintf("<tr $cor ><td>%s - %s</td><td id='moeda'>%s</td><td>&nbsp;
					</td><td id='moeda'>%s&nbsp;%s</td></tr>",$conta->codigo(),$conta->titulo()
					,number_format($provcomadep,2,',','.'),number_format($conta->saldo(),2,',','.'),$conta->tipo());
	$corlinha = !$corlinha;
	$exibideb .= sprintf("<tr class='total'><td>Total debitado</td><td id='moeda'>R$ %s</td><td></td><td></td></tr>",number_format($totalDeb,2,',','.'));
	//esta variável é levada p/ o script views/exibilanc.php

	//Faz o leiaute do lançamento do crédito da tabela lancamento
		$contcaixa = new atualconta($credora->codigo(),$ultimolanc,'');
		$contcaixa->atualizar($valor,'C',$roligreja); //Faz o lançamento na tabela lancamento e atualiza o saldo

		$cor = $corlinha ? 'class="odd"' : 'class="dados"';
		$caixa = new DBRecord('contas',$creditar,'acesso');//Exibi lançamento
		$exibicred .= sprintf("<tr $cor ><td>%s - %s</td><td>&nbsp;</td><td id='moeda'>%s</td><td id='moeda'>%s&nbsp;%s</td></tr>",
		$caixa->codigo(),$caixa->titulo(),number_format($valor,2,',','.'),number_format($caixa->saldo(),2,',','.'),$caixa->tipo());
		$totalCred += $valor;
		$corlinha = !$corlinha;

	//Lança provisões conta credora no Ativo
	$lancprovmissoes=false;
	if ($provmissoes>0) {
		//Faz o lançamento da provisão de missões - Ativo
		$provsemad = new atualconta('1.1.1.001.007',$ultimolanc);
		$provsemad->atualizar($provmissoes,'C',$roligreja);
		$totalCred += $provmissoes;
		$lancprovmissoes=true;
	}

	$cor = $corlinha ? 'class="odd"' : 'class="dados"';
	$conta = new DBRecord('contas','7','acesso');//Exibi lançamento da provisão SEMAD
	$exibicred .= sprintf("<tr $cor ><td>%s - %s</td><td>&nbsp;</td><td id='moeda'>%s</td><td id='moeda'>%s&nbsp;%s</td></tr>",
	$conta->codigo(),$conta->titulo(),number_format($provmissoes,2,',','.'),number_format($conta->saldo(),2,',','.'),$conta->tipo());
	$corlinha 	= !$corlinha;

	if ($provcomadep>0) {
		$provcomad 	= new atualconta('1.1.1.001.006',$ultimolanc); //Faz o lançamento da provisão de Comadep - Ativo
		$provcomad->atualizar($provcomadep,'C',$roligreja);//Faz o lançamento da provisão da COMADEP - Ativo
		$lancprovmissoes=true;
	}

	$cor 		= $corlinha ? 'class="odd"' : 'class="dados"';
	$conta 		= new DBRecord('contas','6','acesso');//Exibi lançamento da provisão COMADEP
	$exibicred .= sprintf("<tr $cor ><td>%s - %s</td><td>&nbsp;</td><td id='moeda'>%s</td><td id='moeda'>%s&nbsp;%s</td></tr>",
	$conta->codigo(),$conta->titulo(),number_format($provcomadep,2,',','.'),number_format($conta->saldo(),2,',','.'),$conta->tipo());
	$totalCred 	= $totalCred + $provcomadep;

	//esta variável é levada p/ o script views/exibilanc.php que chamado ao final deste loop numa linha abaixo
	$exibicred .= sprintf("<tr class='total'><td colspan='2'>Total Creditado</td><td id='moeda'>R$ %s</td><td></td></tr>",number_format($totalCred,2,',','.'));

	//Lança o histórico do lançamento
	$InsertHist = sprintf("'','%s','%s','%s'",$ultimolanc,$referente,$roligreja);
	$lanchist = new incluir($InsertHist, 'lanchist');
	$lanchist->inserir();

	//echo "Missões: $provmissoes, Comadep: $provcomadep";
	//inserir o histórico do lançamento das provisões na tabela lanchist

	//Lança o histórico do lançamento das provisões $provmissoes>0 $provcomadep>0
	if ($lancprovmissoes) {
	$HistProv = sprintf("'','%s','%s','%s'",$ultimolanc,'Valor provisionado da SEMAD e COMADEP sobre a receita nesta data',$roligreja);
	$lanchist = new incluir($HistProv, 'lanchist');
	$lanchist->inserir();
	}

	require_once 'views/exibilanc.php'; //Exibi a tabela com o lançamento concluído

}else {
	 //Fim do 1º if linha 7
	if ($referente=='' && !$status) {
		$mensagem = 'Não existe nada a ser lançado!';
	}elseif ($referente=='') {
		$mensagem = 'Você não informou o motivo do lançamento com um mínimo de 5 caracteres!' ;
	}elseif ($msgErro!='') {
		$mensagem = $msgErro;
	}else {
		$mensagem = 'Não exite valores a ser lançado!';
	}

	echo '<script>alert("'.$mensagem.'");location.href="./?escolha=tesouraria/receita.php&rec=2";</script>';
	echo $mensagem;

}
