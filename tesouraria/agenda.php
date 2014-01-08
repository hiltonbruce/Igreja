
<h1>Agenda Finaceira</h1>
<?php
if ($_SESSION["setor"]==2 || $_SESSION["setor"]>50){
	$dataget = ($_POST['data']!='') ? $_POST['data']:$_GET['data'];
	$dataget = ($dataget=='') ? date('d/m/Y'):$dataget;

	$lista = new agenda();
	$despesasInserirdas = $lista->insdespmes();

	if (!empty($_GET['vencidas'])) {
		require_once 'tesouraria/vencidas.php';
	}
	
	if ($_GET['id']>0 && empty($_POST['atualizar'])) {

		require_once 'forms/pgtoagenda.php';//Form para atualização, pagamento ou pendência

	}elseif ($_POST['atualizar']>'0'){

		$atualizar= new updatesist('agenda',$_POST['atualizar'],'id');
		$atualizar->resppgto	=	$_POST['resppgto'];
		$atualizar->status		= 	$_POST['status'];
		$atualizar->multa		=	strtr($_POST['multa'], ',','.' );
		$valor_us =strtr($_POST['valor'], ',','.' );
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

		echo $mensagem;

	}elseif ($_POST['Submit']=='Inserir...'){

		$maior_idfat  = 'SELECT MAX(idfatura) AS maximo FROM agenda ';
		$maior_idfat = mysql_query($maior_idfat);
		$maior_idfat = mysql_fetch_array($maior_idfat);
		$maior = $valores['maior_idfat'];//Última fatura lançada
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