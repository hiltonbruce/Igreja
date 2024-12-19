<?php
if ($_SESSION["setor"]==2 || $_SESSION["setor"]>50 || $_SESSION["setor"]==1){
	$dataget = ($_POST['data']!='') ? $_POST['data']:$_GET['data'];
	$hora=date('H');
	list($diaPgto,$mesPgto,$anoPgto) = explode ('-',date("d-m-Y"));
	if ($hora<"13")
	{
		$sauda="Bom Dia! ";
		$currentPgto  = mktime(0, 0, 0, $mesPgto  , $diaPgto, $anoPgto);
	}else{
		$sauda="Boa Noite! ";
		$currentPgto  = mktime(0, 0, 0, $mesPgto  , $diaPgto+1, $anoPgto);
	}
	$dtPgto = date('d/m/Y',$currentPgto);
	if (!empty($_POST['credor'])) {
		$credorAgenda = $_POST['credor'];
	}elseif (!empty($_GET['credor'])){
		$credorAgenda = $_GET['credor'];
	}else {
		$credorAgenda= '';
	}
	$credor = $credorAgenda;
	//echo date('d/m/Y',$currentPgto);
	$lista = new agenda();
	$despesasInserirdas = $lista->insdespmes();
	if (!empty($_GET['vencidas'])) {
		require_once 'tesouraria/vencidas.php';//Faz a busca dos compromissos agendados
	}
	if ($_GET['id']>0 && empty($_POST['atualizar'])) {
		require_once 'forms/pgtoagenda.php';//Form para atualiza��o, pagamento ou pend�ncia
	}elseif ($_POST['atualizar']>'0'){
		$atualizar= new updatesist('agenda',$_POST['atualizar'],'id');
		if (!empty($_POST['idlanc'])) {
			$atualizar->idlanc	=	$_POST['idlanc'];
		}
		$atualizar->resppgto	=	$_POST['resppgto'];
		//Verifica se o vencimento é uma data validade e atualiza
		if (checadata($_POST['vencimento'])) {
			$vencimento = br_data ($_POST['vencimento'],'Data de Vencimento');
			$dataAtual = new DateTime($atualizar->vencimento());
			$dataVenc  = new DateTime($vencimento);
			if ($dataVenc->format('Y-m')== $dataAtual->format('Y-m')) {
				$atualizar->vencimento	= $vencimento;
			}else {
				echo "<h1>".$dataVenc->format('Y-m')."</h1>";
				echo "<h1>".$dataAtual->format('Y-m')."</h1>";
				echo "<script> alert('O vencimento s� poder� ser alterado o dia!');</script>";
				echo 'O vencimento s&oacute; poder&aacute; ser alterado o dia!';
			}
		}else {
			echo "<script> alert('O vencimento com data inv�lida! {$_POST['vencimento']}');</script>";
		}
		list($cnpj,$razao) = explode(' ',$_POST['nome'] );
		//echo "<h1>$cnpj</h1>";
		if ($cnpj!='') {
			$nomeCredor = new DBRecord ('credores',$cnpj,'cnpj_cpf');
			$atualizar->credor = $nomeCredor->id();
		}
		if ($_POST['paraMembro']=='1') {
			 $atualizar->credor		= 	intval($_POST['rol']).'r0';
		}elseif ($_POST['paraCredor']=='1'){
			$atualizar->credor		= 	'0';
		}elseif (!empty($_POST['rol']) ){
			$atualizar->credor		= intval($_POST['rol']).'r';
		}elseif (!empty($_POST['credor']) ) {
			$atualizar->credor		= 	intval($_POST['credor']);
		}
		$atualizar->igreja		= 	$_POST['rolIgreja'];
		$atualizar->motivo		= 	$_POST['referente'];
		$atualizar->status		= 	$_POST['status'];
		if ($atualizar->idlanc()=='0') {
			#Apos confirma��o de lan�amento as contas n�o podem ser alteradas
			$atualizar->creditar	= 	$_POST['acessoCreditar'];
			$atualizar->debitar		= 	$_POST['acessoDebitar'];
			$lancDespesa = true;
		}else{
			$lancDespesa = false;
		}
		$multaUS	=	formataNumBanco ($_POST['multa']);//Valor no padr�o americano
		$atualizar->multa	=	$multaUS;
		$valor_us	=	formataNumBanco ($_POST['valor']);//Valor no padr�o americano
		$atualizar->valor	=	$valor_us;
		$hist = $_SESSION['valid_user'].": ".date('d/m/Y H:i:s');
		$atualizar->hist	=	$hist;
		$total = number_format($atualizar->valor+$atualizar->multa,2,",",".");
		if ($_POST['status']=='2'){
			$pagamento = ($_POST['data']=='') ? date('Y-m-d') : br_data($_POST['data'],"Data do pagamento!");
			$atualizar->datapgto	=	$pagamento;
			$mensagem = "<script> alert('Pagamento confirmado com sucesso! Em $pagamento, Total de: R$ $total');</script>";
		}else {
			$mensagem = '<script> alert("Conta enviada para Pagamento! Respons�vel: '.$_POST['resppgto'].');</script>';
			$atualizar->datapgto	=	'';
		}
		if ($_POST['status']=='2' && $lancDespesa) {
			# realiza lan�amento da despesa e Atualiza agenda
			require_once 'models/tes/lancAgenda.php';
		}else {
			# Atualiza agenda
			$atualizar->Update();
		}
		require_once 'forms/pgtoagenda.php';//Form para atualiza��o, pagamento ou pend�ncia
		require_once 'forms/tes/buscaAgenda.php';// Busca por Despesas Agendadas
		echo $mensagem;
	}elseif ($_POST['Submit']=='Inserir...'){
		$maior_idfat  = 'SELECT MAX(idfatura) AS maximo FROM agenda ';
		$maior_idfat = mysql_query($maior_idfat);
		$maior_idfat = mysql_fetch_array($maior_idfat);
		$maior = $valores['maior_idfat'];//�ltima fatura lan�ada
	}else {
		require_once 'forms/tes/buscaAgenda.php'; // Busca por Despesas Agendadas
	}
	require_once 'tesouraria/periodo10dias.php';//Agenda com o per�odo 5 dias a antes e ap�s a data atual
	if ($_GET['fixa']=='on') {
		?>
<fieldset>
	<legend>Despesas Fixas</legend>
	<?php
	$lista->despesasfixas();
	?>
</fieldset>
	<?php
	}
	if ($_GET['prazo']=='on') {
	?>
<fieldset>
	<legend>Despesas com prazo determinado</legend>
	<?php
	$lista->mostra10dias();
	?>
</fieldset>

	<?php
}}
if (strlen($despesasInserirdas)>'7') {
?>
<fieldset>
	<legend>Despesas Mensais Inseridas</legend>
	<?php
	echo $despesasInserirdas;
?>
</fieldset>
<?php }
?>
