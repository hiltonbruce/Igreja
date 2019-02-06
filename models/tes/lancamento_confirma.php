<?php
if ((($mesPgto>$mesVen && $anoPgto==$anoVenc) || $anoPgto>$anoVenc) && $vencimento!='') {
	$ctaPagar = true;
} else {
	$ctaPagar = false;
}
controle ('tes');
//Verifica click duplo no form de criar recibos
if ((check_transid($_POST["transid"]) || $_POST["transid"]=="")) {
	//houve click duplo no form
	$gerarPgto = true;
}else {
	//Não houve click duplo no form
	$gerarPgto = false;
	//Grava no banco codigo de autorização para o novo recibo
	add_transid($_POST["transid"]);
}
if ((!empty($_POST['recibo']) && !$gerarPgto) || empty($_POST['recibo'])){
$provmissoes=0;
$ultimolanc = 0;
$roligreja =intval($_POST['rolIgreja']);
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
$debitar = intval($_POST['acessoDebitar']);
$creditar =  intval($_POST['acessoCreditar']);
if ($_POST['valor']<='0' || $_POST['acessoDebitar']<1 || $_POST['acessoCreditar']<1) {
	$dizimista = false;
}else {
	$status = true;
	$multa = (empty($multaUS)) ? strtr( str_replace(array('.'),array(''),$_POST['multa']), ',.','.,' ):$multaUS;
	$valor = (empty($valor_us)) ? strtr( str_replace(array('.'),array(''),$_POST['valor']), ',.','.,' ):($valor_us);
}
//inicializa variáveis
$totalDeb = 0;
$totalCred = 0;
//$corlinha = false;
$arrayCta = new tes_conta();
//print_r($arrayCta->ativosArray()['1021']);
$contaDC = $arrayCta->ativosArray();
//$contaDC[$creditar]['']
//$contaDC[$debitar]['']
	//$credora 	= new DBRecord('contas',$creditar,'acesso');
	$sldAntCred = number_format($contaDC[$creditar]['saldo'],2,',','.');
	//$devedora 	= new DBRecord('contas',$debitar,'acesso');
	$sldAntDev = number_format($contaDC[$debitar]['saldo'],2,',','.');
	if ($multa>'0') {
		$ctaMulta 	= true;//Conta Multas diversas
		//$contaDC['571']['']; Conta Multas diversas
		$histmulta = ($motivoComplemento=='') ? 'Multa':'Multa '.$motivoComplemento;
	} else {
		$ctaMulta = false;
	}
	if ($contaDC[$creditar]['tipo']=='D' && ($contaDC[$creditar]['saldo']-($valor+$multa))<'0') {
	 $msgErro  = 'Saldo n�o permitido para Conta: '.$contaDC[$creditar]['titulo'];
	 $msgErro .= ' que ficaria com o valor de '.($contaDC[$creditar]['saldo']-$valor);
 }elseif ($contaDC[$debitar]['tipo']=='C' && ($contaDC[$debitar]['saldo']-$valor)<'0'){
	 $msgErro  = 'Saldo n�o permitido para Conta: '.$contaDC[$debitar]['titulo'];
	 $msgErro .= ' que ficaria com o valor de '.($contaDC[$debitar]['saldo']-$valor);
 }elseif ($creditar<1 && $debitar<1) {
	 $msgErro = 'Conta de Cr�dito e D�bito n�o definida, lan�amento n�o confirmado !';
	}elseif ($debitar==$creditar){
	 $msgErro = 'Conta de Cr�dito e D�bito iguais, refa�a o lan�amento!';
 }elseif ($creditar<1) {
	 $msgErro = 'Conta de Cr�dito n�o definida, lan�amento n�o confirmado !';
 }elseif ($debitar<1) {
	 $msgErro = 'Conta de D�bito n�o definida, lan�amento n�o confirmado !';
	}else {
	 $msgErro='';
	}
	if ($ctaMulta) {
		if ($contaDC['571']['tipo']=='C' && ($contaDC['571']['saldo']-$multa<'0')){
	 		$msgErro .= 'Saldo n&atilde;o permitido para Conta: '.$contaDC['571']['titulo'].' que ficaria com o valor de '.($contaDC['571']['saldo']-$multa);
		}
	}
	if ($contaDC[$creditar]['nivel4']=='1.1.1.001') {
	 ;//testar se cta de caixa e não permitir o lancamento se ficar negativo e a de despesas tb
	}
	$ultimoLancNumero = mysql_query('SELECT max(lancamento) AS lanca FROM lanc');//Traz o valor do ultimo lançamento
	$lancmaior = mysql_fetch_array($ultimoLancNumero);
	$ultimolanc = intval($lancmaior['lanca']);
	$ultimolanc++;//Acrescenta uma unidade no ultimo lançamento p usar no lançamento
//Foi criado a tabela lanchist exclusivamente para o histórico dos lançamentos
//Antes de começar os lançamentos verificar se há inconcistência nos saldo antes de continuar
//Criar uma classe que retorne falso ou verdadeiro
//Analizar os valores para lançar o dízimo para COMADEP e SEMAD
$referente = (strlen($_POST['referente'])>'4') ? $_POST['referente']:false;//Atribui a variável o histórico do lançamento
if ($status && $referente && checadata($_POST['data']) && $msgErro=='') {
	//Faz o lançamento do débito da tabela lancamento
	//$exibideb = '<tr class="warning"><td colspan="5">D&eacute;bito</td></tr>';
	//$exibicred = '<tr class="warning"><td colspan="5">Cr&eacute;dito</td></tr>';
	$exibideb = '';
	$exibicred = '';
	$caixaCentral ='';$caixaEnsino = '';$caixaInfantil ='';
	$caixaMissoes = '';$caixaMocidade = '';$caixaOutros = '';
	$caixaSenhoras = '';

if ($ctaPagar) {
	//$ctaPagar = new DBRecord ('contas','2.1.1.001.099','codigo');
	//$contaDC['350'][''] -> Contas a pagar
	//$sldAntPagar = number_format($contaDC['350']['saldo'],2,',','.');
//	$valor += $multa;
	$contApgtoAprop 	= new atualconta($contaDC[$debitar]['codigo'],$ultimolanc,$contaDC['350']['id']);#devedora a Contas a pagar
	$contApgtoAprop->atualizar($valor,'D',$roligreja,$vencimento);
	$reg .= ' e ' . ($ultimolanc);

	$contcaixa = new atualconta($contaDC['350']['codigo'],$ultimolanc,'');
	$contcaixa->atualizar($valor,'C',$roligreja,$data);
	//$contApgtoAprop 	= new atualconta($ctaPagar->codigo(),$ultimolanc+1,$devedora->id());
	//$contApgtoAprop->atualizar($valor,'C',$roligreja,$vencimento);
	//Lança o histórico do lançamento
	$histAPagar .= 'Reconhecido despesa nesta data e pago em '.$_POST['data'];
	$histAPagar .= ', conf. reg. '.$ultimolanc;
	$InsertHist = sprintf("'','%s','%s','%s'",$ultimolanc,$histAPagar,$roligreja);
	$lanchist = new incluir($InsertHist, 'lanchist');
	$lanchist->inserir();

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

	$totalDeb +=$valor;
	//$devedora = $ctaPagar;
//	$creditar = 350;#Contas a pagar
	//$cor = $corlinha ? 'class="odd"' : 'class="dados"';

	$debitar = 350;
	$caixa = $contaDC[$debitar];
	if ($caixa['tipo']=='C') {
			$valorCred = -$valor;
		} else {
			$valorCred = $valor;
		}
	$valorDeb = '';
	$valorDeb = '';
	$tipoDC = $contaDC[$debitar]['tipo'];
	require 'help/tes/exibirLancamento.php';//monta a tabela para exibir
	$exibideb .= $exibi;
	$totalCred +=$valor;
	//$corlinha = !$corlinha;
	//$cor = $corlinha ? 'class="odd"' : 'class="dados"';
	$dtCtaPagar = $diaVenc.'/'.$mesVen.'/'.$anoVenc;
	$exibicred .= '<tr  class="primary"><td>Em: '.$dtCtaPagar.'</td>';
	$exibicred .= '<td colspan="4">'.$histAPagar.'</tr>';
//	$debitar = 350; //Na baixa do pgto ser� feita agora nesta conta
}

//Faz lan�ameto de multa caso exista
if ($ctaMulta) {
//	$ctaMulta = new DBRecord('contas',$ctaMulta->codigo(),'codigo');

	$multaAtraso = new atualconta($contaDC['571']['codigo'],$ultimolanc,$contaDC[$creditar]['id']);

	$multaAtraso->atualizar($multa,'D',$roligreja,$vencimento);
	$totalMulta += $multa;
	$lancMulta=true;
	$caixa = $contaDC['571'];
	$valorCred = '';
	$valorDeb = $multa;
	$tipoDC = $contaDC['571']['tipo'];
	require 'help/tes/exibirLancamento.php';//monta a tabela para exibir
	$exibicred .= $exibi;
	/*
	$exibideb .= sprintf("<tr class='odd' ><td>%s - %s</td><td id='moeda'>%s</td><td>&nbsp;</td><td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",
	$contaDC['571']['codigo'],$contaDC['571']['titulo'],number_format($multa,2,',','.'),number_format($contaDC['571']['saldo'],2,',','.'),$contaDC['571']['tipo']
	,$contaDC['571']['saldo']);
	*/
}
	//echo $credora->id().'<h1> tste </h>';
	/*
	* Se o pgto tiver vencimento de mês anterior ao pgto é feita
	* a apropriação em contas a pagar no mês de referência e o lançamento tb do
	* pgto da cta caixa e cta a pagar
	*/
		$contcaixa 	= new atualconta($contaDC[$debitar]['codigo'],$ultimolanc,$contaDC[$creditar]['id']);
		$histLac = $referente.$motivoComplemento;
		$contcaixa->atualizar($valor,'D',$roligreja,$data); //Faz o lançamento na tabela lancamento e atualiza o saldo
		$ctaVencida = '';
		$valorTotal += $valor;
//print_r($credora);
		if ($contaDC[$creditar]['nivel2']=='4.1') {
			//Receitas operacionais faz provisão automaticamente
			//exceto lançamento direto para despesas não operacionais
			if ($debitar=='2') {
				//Provisão para Missões
				$provmissoes += $valor*PROVMISSOES;
			}elseif ($contaDC[$debitar]['nivel4']=='1.1.1.001' && $debitar>0 && $contaDC[$debitar]['tipo']=='D') {
				//Para tipo 8 não há provisão para COMADEP ou Missões
				$provcomadep += $valor*PROVCONVENCAO;
				$ctaComadep = new DBRecord('contas',DESPCONVENCAO,'codigo');
				$sldAntComadep = number_format($ctaComadep->saldo(),2,',','.');
			}
		}
	$caixa = $contaDC[$debitar];
	$totalDeb = $totalDeb + $valor + $multa;
	$valorCred = '';
	$valorDeb = $valor;
	if ($caixa['tipo']=='C') {
		$valorDeb = -$valor;
	} else {
		$valorDeb = $valor;
	}
	$tipoDC = $contaDC[$debitar]['tipo'];
	require 'help/tes/exibirLancamento.php';//monta a tabela para exibir
	$exibicred .= $exibi;

	$exibideb .= $exibiCentral.$exibiMissoes.$exibiSenhoras.$exibiMocidade.$exibiInfantil.$exibiEnsino/*.$exibi*/;
 	//Lança provisões conta Despesa

 	if ($provmissoes>0) {
	$semaddesp = new atualconta(DESPMISSOES,$ultimolanc,'11');//SEMAD (Sec de Missões) provisão e despesa
	$semaddesp->atualizar($provmissoes,'D',$roligreja,$data); //Faz o lançamento da provisão de missões - Despesa
	$histTextProv =' e provis�o para SEMAD sobre a receita';

	//$cor = $corlinha ? 'class="odd"' : 'class="dados"';
	$conta = new DBRecord('contas',DESPMISSOES,'codigo');//Exibi lançamento da provisão SEMAD
	/*
	$antProvSemad = number_format($conta->saldo()-$provmissoes,2,',','.');
	$exibideb .= sprintf("<tr><td>%s - %s</td><td id='moeda'>%s</td><td>&nbsp;</td>
		<td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",
			$conta->codigo(),$conta->titulo(),number_format($provmissoes,2,',','.'),
			number_format($conta->saldo(),2,',','.'),$conta->tipo(),$antProvSemad);
*/
	$caixa = $contaDC[$conta->acesso()];
	$valorCred = '';
	$valorDeb = $provmissoes;
	$tipoDC = $contaDC[$conta->acesso()]['tipo'];
	require 'help/tes/exibirLancamento.php';//monta a tabela para exibir
	$exibideb .= $exibi;
	$totalDeb += $provmissoes;
	//$corlinha = !$corlinha;
 	}
	$provcomad = new atualconta(DESPCONVENCAO,$ultimolanc,'10');//Convenção estadual COMADEP
	if ($provcomadep>0) {
		$provcomad->atualizar($provcomadep,'D',$roligreja,$data); //Faz o lançamento da provisão de Comadep - Despesa
		$totalDeb += $provcomadep;
		if ($histTextProv!='') {
			$histTextProv = ', provis&atilde;o para COMADEP e SEMAD sobre a receita';
		} else {
			$histTextProv = ' e provis&atilde;o para COMADEP sobre a receita';
		}
		$cor = $corlinha ? 'class="odd"' : 'class="dados"';
		$conta = new DBRecord('contas',DESPCONVENCAO,'codigo');//Exibi lançamento da provisão COMADEP

		$caixa = $contaDC[$conta->acesso()];
		$valorCred = '';
		$valorDeb = $provcomadep;
		$tipoDC = $contaDC[$conta->acesso()]['tipo'];
		require 'help/tes/exibirLancamento.php';//monta a tabela para exibir
		$exibideb .= $exibi;
/*
		$exibideb .= sprintf("<tr><td>%s - %s</td><td id='moeda'>%s</td><td>&nbsp;
						</td><td id='moeda'>%s&nbsp;%s</td></td><td class='text-right'>%s</td></tr>",$conta->codigo(),$conta->titulo()
						,number_format($provcomadep,2,',','.'),number_format($conta->saldo(),2,',','.'),$conta->tipo()
						,$sldAntComadep);
		$corlinha = !$corlinha;
		*/
	}
	//esta variável é levada p/ o script views/exibilanc.php
	//Faz o leiaute do lançamento do cr�dito da tabela lancamento
	$contcaixa = new atualconta($contaDC[$creditar]['codigo'],$ultimolanc,'');
	$contcaixa->atualizar($multa+$valor,'C',$roligreja,$data); //Faz o lançamento na tabela lancamento e atualiza o saldo
	//$cor = $corlinha ? 'class="odd"' : 'class="dados"';
	//$caixa = new DBRecord('contas',$creditar,'acesso');//Exibi lançamento
	/*
	$exibicred .= sprintf("<tr><td>%s - %s</td><td>&nbsp;</td><td id='moeda'>%s</td><td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",
	$contaDC[$creditar]['codigo'],$contaDC[$creditar]['titulo'],number_format($valor+$multa,2,',','.'),number_format($contaDC[$creditar]['saldo'],2,',','.'),$contaDC[$creditar]['tipo']
	,$sldAntCred);
	*/
	$caixa = $contaDC[$creditar];
	if ($caixa['tipo']=='D') {
		$valorCred = -($valor+$multa);
	} else {
		$valorCred = $valor+$multa;
	}
	$valorDeb = '';
	$tipoDC = $contaDC[$creditar]['tipo'];
	require 'help/tes/exibirLancamento.php';//monta a tabela para exibir
	$exibicred .= $exibi;
	$totalCred += $valor+$multa;
	//$corlinha = !$corlinha;
	//Lan�a provis�es conta credora no Ativo
	$lancprovmissoes=false;
	if ($provmissoes>0) {
		//Faz o lançamento da provisão de missões - Ativo
		//$ctaSemad = new DBRecord('contas','7','codigo');//Conta provisão SEMAD
	//	$sldAntSemad = number_format($ctaSemad->saldo(),2,',','.');
		$provsemad = new atualconta('1.1.1.001.007',$ultimolanc);
		$provsemad->atualizar($provmissoes,'C',$roligreja,$data);
		$totalCred += $provmissoes;
		$lancprovmissoes=true;
		//$cor = $corlinha ? 'class="odd"' : 'class="dados"';
		//$conta = new DBRecord('contas','7','acesso');//Exibi lançamento da provisão SEMAD
		$caixa = $contaDC['7'];
		$valorCred = $provmissoes;
		$valorDeb = '';
		$tipoDC = $contaDC['7']['tipo'];
		require 'help/tes/exibirLancamento.php';//monta a tabela para exibir
		$exibicred .= $exibi;

		/*
		$exibicred .= sprintf("<tr $cor ><td>%s - %s</td><td>&nbsp;</td><td id='moeda'>%s</td><td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",
		$conta->codigo(),$conta->titulo(),number_format($provmissoes,2,',','.'),number_format($conta->saldo(),2,',','.'),$conta->tipo(),
		$sldAntSemad);
		//$corlinha 	= !$corlinha;*/
	}
	if ($provcomadep>0) {
		//$ctaProvcomad = new DBRecord('contas','6','acesso');//Exibi lançamento da provisão COMADEP
		//$sldAntProv = number_format($ctaProvcomad->saldo(),2,',','.');
		$provcomad 	= new atualconta('1.1.1.001.006',$ultimolanc); //Faz o lançamento da provisão de Comadep - Ativo
		$provcomad->atualizar($provcomadep,'C',$roligreja,$data);//Faz o lançamento da provisão da COMADEP - Ativo
		$lancprovmissoes=true;
		//$cor 		= $corlinha ? 'class="odd"' : 'class="dados"';
		//$conta 		= new DBRecord('contas','6','acesso');//Exibi lançamento da provisão COMADEP
		$caixa = $contaDC['6'];
		$valorCred = $provmissoes;
		$valorDeb = '';
		$tipoDC = $contaDC['6']['tipo'];
		require 'help/tes/exibirLancamento.php';//monta a tabela para exibir		$caixa = $contaDC[$conta->acesso()];
		$exibicred .= $exibi;
		/*
		$exibicred .= sprintf("<tr><td>%s - %s</td><td>&nbsp;</td><td id='moeda'>%s</td><td id='moeda'>%s&nbsp;%s</td><td class='text-right'>%s</td></tr>",
		$conta->codigo(),$conta->titulo(),number_format($provcomadep,2,',','.'),number_format($conta->saldo(),2,',','.'),$conta->tipo()
		,$sldAntProv);*/
		$totalCred 	+= $provcomadep;
	}
	//esta variável é levada p/ o script views/exibilanc.php que chamado ao final deste loop numa linha abaixo

	$exibicred .= '<tr  class="primary"><td>Em: '.$dtLanc.'</td>';
	$exibicred .= '<td colspan="4"> '.$referente.'</tr>';
	$exibicred .= sprintf("<tr class='success'><td>Totais</td><td id='moeda'>R$ %s</td>
	<td id='moeda'>R$ %s</td><td colspan='2'></td></tr>",number_format($totalDeb,2,',','.'),number_format($totalCred,2,',','.'));
	//echo "Missões: $provmissoes, Comadep: $provcomadep";
	//inserir o histórico do lançamento das provisões na tabela lanchist
	//Lança o histórico do lan�amento das provisões $provmissoes>0 $provcomadep>0
	if ($lancprovmissoes) {
	$HistProv = sprintf("'','%s','%s','%s'",$ultimolanc,$histTextProv,$roligreja);
	//$lanchist = new incluir($HistProv, 'lanchist');
	//$lanchist->inserir();
	}
	//Lança o histórico do lançamento
	$referente .= $histTextProv.$ctaVencida;
	$referente = mysql_real_escape_string($referente);
	$InsertHist = sprintf("'','%s','%s','%s'",$ultimolanc,$referente,$roligreja);
	$lanchist = new incluir($InsertHist, 'lanchist');
	$lanchist->inserir();
	if (!empty($_POST['recibo']) && intval($_POST['recibo']) == $_POST['recibo']) {
		#Verifica se é lançamento de recibo e atualiza tabela tes_recibo
		$upRec = new DBRecord('tes_recibo',$_POST['recibo'],'id');
		$upRec->lancamento = $ultimolanc;
		$upRec->UpdateID();
	}
$reg = $ultimolanc.$reg; //Exibi os n�meros dos lan�amentos
require_once 'views/exibilanc.php'; //Exibi a tabela com o lançamento concluído
}else {
	 //Fim do 1º if linha 7
	if ($referente=='' && !$status) {
		$mensagem = 'N&atilde;o existe nada a ser lan&ccedil;ado!';
	}elseif ($referente=='') {
		$mensagem = 'Voc&ecirc; n&atilde;o informou o motivo do lan&ccedil;amento com um m&iacute;�nimo de 5 caracteres!' ;
	}elseif ($msgErro!='') {
		$mensagem = $msgErro;
	}else {
		$mensagem = 'N&atilde;o exite valores a ser lan&ccedil;ado!';
	}
	echo '<script>alert("'.$mensagem.'");window.history.go(-1);</script>';
	echo $mensagem;
}
echo $novoLanc;
} else {
	?>
<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button"
	class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	 <strong>Atualiza&ccedil;&atilde;o de p&aacute;gina</strong><br /> Houve clique duplo ou Atualiza&ccedil;&atilde;o
	  de p&aacute;gina e impedimos o lan&ccedil;amento duplicado. </div>
	<?php
}
