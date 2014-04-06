<?php

controle ('tes');
$ultimolanc = 0;
$roligreja =(int) $_POST['igreja'];
$dizimista = new dizresp($roligreja);

//inicializa variáveis
$totalDeb = 0;
$totalCred = 0;
$corlinha = false;
	
	$ultimolanc = mysql_query('SELECT max(lancamento) AS lanc FROM lancamento');//Traz o valor do ultimo lançamento
	$lancmaior = mysql_fetch_array($ultimolanc);
	$ultimolanc = (int)$lancmaior['lanc']+1;//Acrescenta uma unidade no ultimo lançamento p usar no lançamento
	$idlancmis = $ultimolanc + 1;//id do lançamento das provisões
	
//Foi criado a tabela lanchist exclusivamente para o histórico dos lançamentos
//Antes de começar os lançamentos verificar se há inconcistência nos saldo antes de continuar
//Criar uma classe que retorne falso ou verdadeiro
//Analizar os valores para lançar o dízimo para COMADEP e SEMAD

$referente = ($_POST['hist']<>'') ? $_POST['hist']:$_POST['histsug'];//Atribui a variável o histórico do lançamento

$data = br_data($_POST['data'], 'Data do lançamento inválida!');

if ($dizmista->totalgeral()>'0' && $referente!='' && checadata($_POST['data'])) {
	
	//Faz o lançamento do débito para tabela lancamento
	$tablanc = mysql_query('SELECT devedora,tipo,SUM(valor) AS valor FROM dizimooferta 
			WHERE lancamento="0" AND igreja = "'.$roligreja.'" GROUP BY devedora');
	$exibideb = '<tr><td colspan="4">Debito</td></tr>';
	$exibicred = '<tr><td colspan="4">Credito</td></tr>';
	
	$caixaCentral ='';$caixaEnsino = '';$caixaInfantil ='';
	$caixaMissoes = '';$caixaMocidade = '';$caixaOutros = '';
	$caixaSenhoras = '';
	
	while ($tablancarr = mysql_fetch_array($tablanc)) {
		
		$debitar = $tablancarr['devedora'];		
		$devedora 	= new DBRecord('contas',$debitar,'acesso');
		$contcaixa 	= new atualconta($devedora->codigo(),$ultimolanc);
		$valor 		= $tablancarr['valor'];
		$contcaixa->atualizar($valor,'D',$roligreja); //Faz o lançamento na tabela lancamento e atualiza o saldo
		$valorTotal += $valor;
		
		if ($tablancarr['devedora']=='2') {
			$provmissoes += round(($valor*0.4),2);
		}elseif ($tablancarr['tipo']!='9') {
			//Para tipo 9 não há provisão para COMADEP ou Missões
			$provcomadep += round(($valor*0.1),2);		
		}
		
		//Exibi lançamento
		$caixa = new DBRecord('contas',$tablancarr['devedora'],'acesso');
		$totalDeb = $totalDeb + $valor;
		require 'help/tes/exibirLancamento.php';//monta a tabela para exibir
		
	}
	
	$exibideb .= $exibiCentral.$exibiMissoes.$exibiSenhoras.$exibiMocidade.$exibiInfantil.$exibiEnsino.$exibi;
		 
   	//Lança provisões conta Despesa
	$semaddesp = new atualconta('3.1.6.001.005',$idlancmis);
   	if ($provmissoes>0) {
   		$semaddesp->atualizar($provmissoes,'D',$roligreja); //Faz o lançamento, se possuir valor, da provisão de missões - Despesa
   	}
	
	$cor = $corlinha ? 'class="odd"' : 'class="dados"';
	$conta = new DBRecord('contas','3.1.6.001.005','codigo');//Exibi lançamento da provisão SEMAD
	$exibideb .= sprintf("<tr $cor ><td>%s - %s</td><td id='moeda'>%s</td><td>&nbsp;</td><td id='moeda'>%s&nbsp;%s</td></tr>",
			$conta->codigo(),$conta->titulo(),number_format($provmissoes,2,',','.'),number_format($conta->saldo(),2,',','.'),$conta->tipo());
	$totalDeb = $totalDeb + $provmissoes;
	
	$corlinha = !$corlinha;
	
	$provcomad = new atualconta('3.1.1.001.007',$idlancmis);
	if ($provcomadep>0) {
		$provcomad->atualizar($provcomadep,'D',$roligreja); //Faz o lançamento, se possuir valor, da provisão de Comadep - Despesa
	}
	
	$cor = $corlinha ? 'class="odd"' : 'class="dados"';
	$conta = new DBRecord('contas','3.1.1.001.007','codigo');//Exibi lançamento da provisão SEMAD
	$exibideb .= sprintf("<tr $cor ><td>%s - %s</td><td id='moeda'>%s</td><td>&nbsp;
					</td><td id='moeda'>%s&nbsp;%s</td></tr>",$conta->codigo(),$conta->titulo()
					,number_format($provcomadep,2,',','.'),number_format($conta->saldo(),2,',','.'),$conta->tipo());
	$totalDeb = $totalDeb + $provcomadep;	
	$corlinha = !$corlinha;	
	$exibideb .= sprintf("<tr class='total'><td>Total debitado</td><td id='moeda'>R$ %s</td><td></td><td></td></tr>",number_format($totalDeb,2,',','.'));
	//esta variável é levada p/ o script views/exibilanc.php
		
	//Faz o leiaute do lançamento do crédito e lança para tabela lancamento
	$tablanc_c = mysql_query('SELECT SUM(valor) AS valor,credito FROM dizimooferta WHERE lancamento="0" AND igreja = "'.$roligreja.'" GROUP BY credito');
	
	while ($tablancarrc = mysql_fetch_array($tablanc_c)) {
		
		$credora = new DBRecord('contas',$tablancarrc['credito'],'acesso');
		$contcaixa = new atualconta($credora->codigo(),$ultimolanc);
		$contcaixa->atualizar($tablancarrc['valor'],'C',$roligreja); //Faz o lançamento na tabela lancamento e atualiza o saldo
		
		$cor = $corlinha ? 'class="odd"' : 'class="dados"';
		$caixa = new DBRecord('contas',$tablancarrc['credito'],'acesso');//Exibi lançamento
		$exibicred .= sprintf("<tr $cor ><td>%s - %s</td><td>&nbsp;</td><td id='moeda'>%s</td><td id='moeda'>%s&nbsp;%s</td></tr>",
		$caixa->codigo(),$caixa->titulo(),number_format($tablancarrc['valor'],2,',','.'),number_format($caixa->saldo(),2,',','.'),$caixa->tipo());
		$totalCred = $totalCred + $tablancarrc['valor'];
		$corlinha = !$corlinha;
		
	}
	
	//Lança provisões conta credora no Ativo

	$provsemad = new atualconta('1.1.1.001.007',$idlancmis);
	if ($provmissoes>0) {
		$provsemad->atualizar($provmissoes,'C',$roligreja); //Faz o lançamento, se possuir valor, da provisão de missões - Ativo
	}
	
	$cor = $corlinha ? 'class="odd"' : 'class="dados"';
	$conta = new DBRecord('contas','7','acesso');//Exibi lançamento da provisão SEMAD
	$exibicred .= sprintf("<tr $cor ><td>%s - %s</td><td>&nbsp;</td><td id='moeda'>%s</td><td id='moeda'>%s&nbsp;%s</td></tr>",
	$conta->codigo(),$conta->titulo(),number_format($provmissoes,2,',','.'),number_format($conta->saldo(),2,',','.'),$conta->tipo());
	$totalCred = $totalCred + $provmissoes;
	
	$corlinha 	= !$corlinha;
	$provcomad 	= new atualconta('1.1.1.001.006',$idlancmis); //Faz o lançamento da provisão de Comadep - Ativo
	if ($provcomadep) {
		$provcomad->atualizar($provcomadep,'C',$roligreja);//Faz o lançamento, se possuir valor, da provisão da COMADEP - Ativo
	}
	
	$cor 		= $corlinha ? 'class="odd"' : 'class="dados"';
	$conta 		= new DBRecord('contas','6','acesso');//Exibi lançamento da provisão COMADEP
	$exibicred .= sprintf("<tr $cor ><td>%s - %s</td><td>&nbsp;</td><td id='moeda'>%s</td><td id='moeda'>%s&nbsp;%s</td></tr>",
	$conta->codigo(),$conta->titulo(),number_format($provcomadep,2,',','.'),number_format($conta->saldo(),2,',','.'),$conta->tipo());
	$totalCred 	= $totalCred + $provcomadep;

	$exibicred .= sprintf("<tr class='total'><td colspan='2'>Total Creditado</td><td id='moeda'>R$ %s</td><td></td></tr>",number_format($totalCred,2,',','.'));
	//esta variável é levada p/ o script views/exibilanc.php que chamado ao final deste loop numa linha abaixo
	
	//Atualiza a tabela dizimooferta de acordo com a igreja selecionada inserido o id do lançamento no campo lançamento
	$atualdizoferta = mysql_query("SELECT id FROM dizimooferta WHERE lancamento='0' AND igreja='$roligreja' ") or die (mysql_error());
	while ($lanc = mysql_fetch_array($atualdizoferta)) {
			$ofetdiz = new DBRecord('dizimooferta',$lanc['id'],'id');
			$ofetdiz->lancamento = $ultimolanc;
			$ofetdiz->UpdateID();
		}
		
	//Lança o histórico do lançamento
	$InsertHist = sprintf("'','%s','%s','%s'",$ultimolanc,$referente,$roligreja);
	$lanchist = new incluir($InsertHist, 'lanchist');
	$lanchist->inserir();
	
	//echo "Missões: $provmissoes, Comadep: $provcomadep";
	//inserir o histórico do lançamento das provisões na tabela lanchist
		
	//Lança o histórico do lançamento das provisões
	$HistProv = sprintf("'','%s','%s','%s'",$idlancmis,'Valor provisionado da SEMAD e COMADEP sobre a receita nesta data',$roligreja);
	$lanchist = new incluir($HistProv, 'lanchist');
	$lanchist->inserir();
		
	require_once 'views/exibilanc.php'; //Exibi a tabela com o lançamento concluído
	
}else {
	 //Fim do 1º if linha 7
	if ($referente=='' && $dizmista->totalgeral()=='') {
		$mensagem = 'Não existe nada a ser lançado!';
	}elseif ($referente=='') {
		$mensagem = 'Você não informou o motivo do lançamento!' ;
	}else {
		$mensagem = 'Não exite valores a ser lançado!';
	}
	
	echo '<script>alert("'.$mensagem.'");location.href="./?escolha=tesouraria/receita.php";</script>';
	echo $mensagem;
	
}
