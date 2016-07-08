<?php
$linkLancamento  = './?escolha=tesouraria/receita.php&menu=top_tesouraria';
$linkLancamento .= '&igreja='.$_POST['igreja'];
require_once 'views/tesouraria/menu.php';//Sub-Menu de links

#Analisa se será lançado em contas a pagar e fazer o reconhecimento da despesas
list($anoVenc,$mesVen,$diaVenc) = explode('-',$vencimento);
$data = br_data($_POST['data'], 'Data do lançamento inválida!');
list($anoPgto,$mesPgto,$diaPgto) = explode('-', $data);
if ((($mesPgto>$mesVen && $anoPgto==$anoVenc) ||$anoPgto>$anoVenc) && $vencimento!='') {
	$ctaPagar = true;
} else {
	$ctaPagar = false;
}

controle ('tes');
$provmissoes=0;
$ultimolanc = 0;
$roligreja =(int) $_POST['rolIgreja'];

$novoLanc  = '<a href="./?escolha=tesouraria/receita.php&menu=top_tesouraria&rec=2&igreja='.$roligreja.'"';
$novoLanc .= '><button class="btn btn-primary active" autofocus="autofocus" > <span class="glyphicon glyphicon-save-file" >';
$novoLanc .= '</span>&nbsp;Novo Lan&ccedil;amento</button></a>';

$igLanc = new DBRecord('igreja', $roligreja, 'rol');
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
	$multa = (empty($multaUS)) ? strtr( str_replace(array('.'),array(''),$_POST['multa']), ',.','.,' ):$multaUS;
	$valor = (empty($valor_us)) ? strtr( str_replace(array('.'),array(''),$_POST['valor']), ',.','.,' ):($valor_us);
	$debitar = $_POST['acessoDebitar'];
	$creditar =  $_POST['acessoCreditar'];
}

//inicializa variáveis
$totalDeb = 0;
$totalCred = 0;
//$corlinha = false;

	$credora 	= new DBRecord('contas',$creditar,'acesso');
	$sldAntCred = number_format($credora->saldo(),2,',','.');
	$devedora 	= new DBRecord('contas',$debitar,'acesso');
	$sldAntDev = number_format($devedora->saldo(),2,',','.');

	if ($multa>'0') {
		$ctaMulta 	= new DBRecord('contas','571','acesso');//Conta Multas diversas
		$histmulta = ($motivoComplemento=='') ? 'Multa':'Multa '.$motivoComplemento;
	} else {
		$ctaMulta = false;
	}

	if ($credora->tipo()=='D' && ($credora->saldo()-($valor+$multa))<'0') {
	 $msgErro = 'Saldo não permitido para Conta: '.$credora->titulo().' que ficaria com o valor de '.($credora->saldo()-$valor);
	}elseif ($devedora->tipo()=='C' && ($devedora->saldo()-$valor)<'0'){
	 $msgErro = 'Saldo não permitido para Conta: '.$devedora->titulo().' que ficaria com o valor de '.($devedora->saldo()-$valor);
	}elseif ($debitar==$creditar){
	 $msgErro = 'Contas de Credito e Débito iguais, refaça o lançamento!';
	}else {
	 $msgErro='';
	}

	if ($ctaMulta) {
		if ($ctaMulta->tipo()=='C' && ($ctaMulta->saldo()-$multa<'0')){
	 		$msgErro .= 'Saldo não permitido para Conta: '.$ctaMulta->titulo().' que ficaria com o valor de '.($ctaMulta->saldo()-$multa);
		}
	}

	if ($credora->nivel4()=='1.1.1.001') {
	 ;//testar se cta de caixa e não permitir o lancamento se ficar negativo e a de despesas tb
	}

	$ultimoLancNumero = mysql_query('SELECT max(lancamento) AS lanca FROM lanc');//Traz o valor do ultimo lançamento
	$lancmaior = mysql_fetch_array($ultimoLancNumero);
	$ultimolanc = (int)$lancmaior['lanca']+1;//Acrescenta uma unidade no ultimo lançamento p usar no lançamento

//Foi criado a tabela lanchist exclusivamente para o histórico dos lançamentos
//Antes de começar os lançamentos verificar se há inconcistência nos saldo antes de continuar
//Criar uma classe que retorne falso ou verdadeiro
//Analizar os valores para lançar o dízimo para COMADEP e SEMAD

$referente = (strlen($_POST['referente'])>'4') ? $_POST['referente']:false;//Atribui a variável o histórico do lançamento

if ($status && $referente && checadata($_POST['data']) && $msgErro=='') {

	//Faz o lançamento do débito da tabela lancamento
	$exibideb = '<tr class="warning"><td colspan="5">Debito</td></tr>';
	$exibicred = '<tr class="warning"><td colspan="5">Credito</td></tr>';

	$caixaCentral ='';$caixaEnsino = '';$caixaInfantil ='';
	$caixaMissoes = '';$caixaMocidade = '';$caixaOutros = '';
	$caixaSenhoras = '';
	//echo $credora->id().'<h1> tste </h>';
	/*
	* Se o pgto tiver vencimento de mês anterior ao pgto é feita
	* a apropriação em contas a pagar no mês de referência e o lançamento tb do
	* pgto da cta caixa e cta a pagar
	*/
	if ($ctaPagar) {
		$ctaPagar = new DBRecord ('contas','2.1.1.001.099','codigo');
		$sldAntPagar = number_format($ctaPagar->saldo(),2,',','.');
		$contApgtoAprop 	= new atualconta($devedora->codigo(),$ultimolanc+1,$ctaPagar->id());#devedora a Contas a pagar
		$contApgtoAprop->atualizar($valor,'D',$roligreja,$vencimento);

		$contcaixa = new atualconta($ctaPagar->codigo(),$ultimolanc+1,'');
		$contcaixa->atualizar($valor,'C',$roligreja,$data);

		//$contApgtoAprop 	= new atualconta($ctaPagar->codigo(),$ultimolanc+1,$devedora->id());
		//$contApgtoAprop->atualizar($valor,'C',$roligreja,$vencimento);

		//Lança o histórico do lançamento
		$histAPagar .= 'Reconhecido despesa nesta data e pago em '.$_POST['data'];
		$InsertHist = sprintf("'','%s','%s','%s'",$ultimolanc+1,$histAPagar,$roligreja);
		$lanchist = new incluir($InsertHist, 'lanchist');
		$lanchist->inserir();

		$exibideb .= sprintf("<tr><td>%s - %s</td><td id='moeda'>%s</td><td>&nbsp;</td><td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",
				$devedora->codigo(),$devedora->titulo(),number_format($valor,2,',','.'),
				number_format($devedora->saldo(),2,',','.'),$devedora->tipo(),$sldAntPagar);
		$totalDeb +=$valor;

		$devedora = $ctaPagar;
		$debitar = $devedora->acesso();

		//$cor = $corlinha ? 'class="odd"' : 'class="dados"';
		$exibicred .= sprintf("<tr><td>%s - %s</td><td>&nbsp;</td><td id='moeda'>%s</td><td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",
		$ctaPagar->codigo(),$ctaPagar->titulo(),number_format($valor,2,',','.'),number_format($ctaPagar->saldo(),2,',','.'),$ctaPagar->tipo()
		,$sldAntPagar);
		$totalCred +=$valor;
		//$corlinha = !$corlinha;
		//$cor = $corlinha ? 'class="odd"' : 'class="dados"';

	}

		$contcaixa 	= new atualconta($devedora->codigo(),$ultimolanc,$credora->id());
		$histLac = $referente.$motivoComplemento;
		$contcaixa->atualizar($valor,'D',$roligreja,$data); //Faz o lançamento na tabela lancamento e atualiza o saldo
		$ctaVencida = '';


		$valorTotal += $valor;
//print_r($credora);
		if ($credora->nivel2()=='4.1') {
			//Receitas operacionais faz provisão automaticamente
			//exceto lançamento direto para despesas não operacionais
			if ($debitar=='2') {
				//Provisão para Missões
				$provmissoes += $valor*0.4;

			}elseif ($devedora->nivel4()=='1.1.1.001' && $devedora->acesso()>0 && $devedora->tipo()=='D') {
				//Para tipo 8 não há provisão para COMADEP ou Missões
				$provcomadep += $valor*0.1;
				$ctaComadep = new DBRecord('contas','3.1.1.001.007','codigo');
				$sldAntComadep = number_format($ctaComadep->saldo(),2,',','.');
			}

		}

	//Exibi lançamento
	//Faz lançameto de multa caso exista
	if ($ctaMulta) {
		$ctaMulta = new DBRecord('contas',$ctaMulta->codigo(),'codigo');
		$multaAtraso = new atualconta($ctaMulta->codigo(),$ultimolanc,$credora->id());
		$multaAtraso->atualizar($multa,'D',$roligreja,$data);
		$totalMulta += $multa;
		$lancMulta=true;
		$exibideb .= sprintf("<tr class='odd' ><td>%s - %s</td><td id='moeda'>%s</td><td>&nbsp;</td><td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",
		$ctaMulta->codigo(),$ctaMulta->titulo(),number_format($multa,2,',','.'),number_format($ctaMulta->saldo(),2,',','.'),$ctaMulta->tipo()
		,$ctaMulta->saldo());
	}
		$caixa = new DBRecord('contas',$debitar,'acesso');
		$totalDeb = $totalDeb + $valor + $multa;
		require 'help/tes/exibirLancamento.php';//monta a tabela para exibir

	$exibideb .= $exibiCentral.$exibiMissoes.$exibiSenhoras.$exibiMocidade.$exibiInfantil.$exibiEnsino.$exibi;

   	//Lança provisões conta Despesa
   	if ($provmissoes>0) {
		$semaddesp = new atualconta('3.1.6.001.005',$ultimolanc,'11');//SEMAD (Sec de Missões) provisão e despesa
		$semaddesp->atualizar($provmissoes,'D',$roligreja,$data); //Faz o lançamento da provisão de missões - Despesa
		$histTextProv =' e provisão para SEMAD sobre a receita';

		$cor = $corlinha ? 'class="odd"' : 'class="dados"';
		$conta = new DBRecord('contas','3.1.6.001.005','codigo');//Exibi lançamento da provisão SEMAD
		$antProvSemad = number_format($conta->saldo()-$provmissoes,2,',','.');
		$exibideb .= sprintf("<tr><td>%s - %s</td><td id='moeda'>%s</td><td>&nbsp;</td><td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",
				$conta->codigo(),$conta->titulo(),number_format($provmissoes,2,',','.'),
				number_format($conta->saldo(),2,',','.'),$conta->tipo(),$antProvSemad);
		$totalDeb += $provmissoes;
		$corlinha = !$corlinha;
   	}

	$provcomad = new atualconta('3.1.1.001.007',$ultimolanc,'10');//Convenção estadual COMADEP
	if ($provcomadep>0) {
		$provcomad->atualizar($provcomadep,'D',$roligreja,$data); //Faz o lançamento da provisão de Comadep - Despesa
		$totalDeb += $provcomadep;
		if ($histTextProv!='') {
			$histTextProv = ', provisão para COMADEP e SEMAD sobre a receita';
		} else {
			$histTextProv = ' e provisão para COMADEP sobre a receita';
		}

		$cor = $corlinha ? 'class="odd"' : 'class="dados"';
		$conta = new DBRecord('contas','3.1.1.001.007','codigo');//Exibi lançamento da provisão SEMAD
		$exibideb .= sprintf("<tr><td>%s - %s</td><td id='moeda'>%s</td><td>&nbsp;
						</td><td id='moeda'>%s&nbsp;%s</td></td><td class='text-right'>%s</td></tr>",$conta->codigo(),$conta->titulo()
						,number_format($provcomadep,2,',','.'),number_format($conta->saldo(),2,',','.'),$conta->tipo()
						,$sldAntComadep);
		$corlinha = !$corlinha;
	}
	$exibideb .= sprintf("<tr  class='primary'><td>Total debitado</td><td id='moeda'>R$ %s</td><td colspan='3'></td></tr>"
		,number_format($totalDeb,2,',','.'));
	//esta variável é levada p/ o script views/exibilanc.php

	//Faz o leiaute do lançamento do crédito da tabela lancamento
		$contcaixa = new atualconta($credora->codigo(),$ultimolanc,'');
		$contcaixa->atualizar($multa+$valor,'C',$roligreja,$data); //Faz o lançamento na tabela lancamento e atualiza o saldo

		//$cor = $corlinha ? 'class="odd"' : 'class="dados"';
		$caixa = new DBRecord('contas',$creditar,'acesso');//Exibi lançamento
		$exibicred .= sprintf("<tr><td>%s - %s</td><td>&nbsp;</td><td id='moeda'>%s</td><td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",
		$caixa->codigo(),$caixa->titulo(),number_format($valor+$multa,2,',','.'),number_format($caixa->saldo(),2,',','.'),$caixa->tipo()
		,$sldAntCred);
		$totalCred += $valor+$multa;
		//$corlinha = !$corlinha;

	//Lança provisões conta credora no Ativo
	$lancprovmissoes=false;
	if ($provmissoes>0) {
		//Faz o lançamento da provisão de missões - Ativo
		$ctaSemad = new DBRecord('contas','7','acesso');//Conta provisão SEMAD
		$sldAntSemad = number_format($ctaSemad->saldo(),2,',','.');

		$provsemad = new atualconta('1.1.1.001.007',$ultimolanc);
		$provsemad->atualizar($provmissoes,'C',$roligreja,$data);
		$totalCred += $provmissoes;
		$lancprovmissoes=true;

		//$cor = $corlinha ? 'class="odd"' : 'class="dados"';
		$conta = new DBRecord('contas','7','acesso');//Exibi lançamento da provisão SEMAD
		$exibicred .= sprintf("<tr $cor ><td>%s - %s</td><td>&nbsp;</td><td id='moeda'>%s</td><td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",
		$conta->codigo(),$conta->titulo(),number_format($provmissoes,2,',','.'),number_format($conta->saldo(),2,',','.'),$conta->tipo(),
		$sldAntSemad);
		//$corlinha 	= !$corlinha;
	}


	if ($provcomadep>0) {
		$ctaProvcomad = new DBRecord('contas','6','acesso');//Exibi lançamento da provisão COMADEP
		$sldAntProv = number_format($ctaProvcomad->saldo(),2,',','.');
		$provcomad 	= new atualconta('1.1.1.001.006',$ultimolanc); //Faz o lançamento da provisão de Comadep - Ativo
		$provcomad->atualizar($provcomadep,'C',$roligreja,$data);//Faz o lançamento da provisão da COMADEP - Ativo
		$lancprovmissoes=true;

		//$cor 		= $corlinha ? 'class="odd"' : 'class="dados"';
		$conta 		= new DBRecord('contas','6','acesso');//Exibi lançamento da provisão COMADEP
		$exibicred .= sprintf("<tr><td>%s - %s</td><td>&nbsp;</td><td id='moeda'>%s</td><td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",
		$conta->codigo(),$conta->titulo(),number_format($provcomadep,2,',','.'),number_format($conta->saldo(),2,',','.'),$conta->tipo()
		,$sldAntProv);
		$totalCred 	+= $provcomadep;
	}

	//esta variável é levada p/ o script views/exibilanc.php que chamado ao final deste loop numa linha abaixo
	$exibicred .= sprintf("<tr class='primary'><td colspan='2'>Total Creditado</td><td id='moeda'>R$ %s</td><td colspan='2'></td></tr>",number_format($totalCred,2,',','.'));

	//echo "Missões: $provmissoes, Comadep: $provcomadep";
	//inserir o histórico do lançamento das provisões na tabela lanchist

	//Lança o histórico do lançamento das provisões $provmissoes>0 $provcomadep>0
	if ($lancprovmissoes) {
	$HistProv = sprintf("'','%s','%s','%s'",$ultimolanc,$histTextProv,$roligreja);
	//$lanchist = new incluir($HistProv, 'lanchist');
	//$lanchist->inserir();
	}

	//Lança o histórico do lançamento
	$referente .= $histTextProv.$ctaVencida;
	$InsertHist = sprintf("'','%s','%s','%s'",$ultimolanc,$referente,$roligreja);
	$lanchist = new incluir($InsertHist, 'lanchist');
	$lanchist->inserir();

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

	echo '<script>alert("'.$mensagem.'");window.history.go(-1);</script>';
	echo $mensagem;

}

echo $novoLanc;