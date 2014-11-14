<h1>Agenda Finaceira</h1>
<?php
if ($_SESSION["setor"]==2 || $_SESSION["setor"]>50){
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

		require_once 'forms/pgtoagenda.php';//Form para atualização, pagamento ou pendência

	}elseif ($_POST['atualizar']>'0'){

		$atualizar= new updatesist('agenda',$_POST['atualizar'],'id');
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
				echo "<script> alert('O vencimento só poderá ser alterado o dia!');</script>";
				echo 'O vencimento só poderá ser alterado o dia!';
			}

		}else {
			echo "<script> alert('O vencimento com data invalida! {$_POST['vencimento']}');</script>";
		}

		if ($_POST['paraMembro']=='1') {
			 $atualizar->credor		= 	'r0';
		}elseif ($_POST['paraCredor']=='1'){
			$atualizar->credor		= 	'0';
		}elseif (!empty($_POST['rol']) ){
			$atualizar->credor		= 'r'.(int)$_POST['rol'];
		}elseif (!empty($_POST['credor']) ) {
			$atualizar->credor		= 	(int)$_POST['credor'];
		}

		$atualizar->igreja		= 	$_POST['igreja'];
		$atualizar->motivo		= 	$_POST['motivo'];
		$atualizar->status		= 	$_POST['status'];
		$atualizar->multa		=	strtr($_POST['multa'], ',','.' );
		$valor_us 				=	strtr($_POST['valor'], ',','.' );
		$atualizar->valor		=	$valor_us;
		$hist = $_SESSION['valid_user'].": ".date('d/m/Y H:i:s');
		$atualizar->hist	= 	$hist;
		$total = number_format($atualizar->valor+$atualizar->multa,2,",",".");

		if ($_POST['status']=='2'){
			$pagamento = ($_POST['datapgto']=='') ? date('Y-m-d') : br_data($_POST['datapgto'],"Data do pagamento!");
			$atualizar->datapgto	=	$pagamento;
			$mensagem = "<script> alert('Pagamento confirmado com sucesso! Em $pagamento, Total de: R$ $total');</script>";
		}else {
			$mensagem = '<script> alert("Conta enviada para Pagamento! Responsável: '.$_POST['resppgto'].');</script>';
			$atualizar->datapgto	=	'';
		}
		$atualizar->Update();
		require_once 'forms/tes/buscaAgenda.php';// Busca por Despesas Agendadas
		echo $mensagem;

	}elseif ($_POST['Submit']=='Inserir...'){

		$maior_idfat  = 'SELECT MAX(idfatura) AS maximo FROM agenda ';
		$maior_idfat = mysql_query($maior_idfat);
		$maior_idfat = mysql_fetch_array($maior_idfat);
		$maior = $valores['maior_idfat'];//Última fatura lançada
	}else {

		require_once 'forms/tes/buscaAgenda.php'; // Busca por Despesas Agendadas
	}


	require_once 'tesouraria/periodo10dias.php';//Agenda com o período 5 dias a antes e após a data atual
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
if (strlen($despesasInserirdas)>'10') {
?>
<fieldset>
	<legend>Despesas Mensais Inseridas</legend>
	<?php
	echo $despesasInserirdas;
?>
</fieldset>
<?php }
?>
