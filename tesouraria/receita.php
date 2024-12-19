<?php
if (intval($_POST['rolIgreja'])>0) {
	$idIgreja=intval($_POST['rolIgreja']);
}elseif (!empty($_GET['igreja'])) {
	$idIgreja = intval($_GET['igreja']);
}else {
	$idIgreja = 0;
}
$titTabela = 'Balancete - Saldo em: '.date('d/m/Y');
$tabela = (empty($_GET['tabela'])) ? '' : $_GET['tabela'];
$idLanc = (empty($_GET['id'])) ? '' : $_GET['id'];
$rec = (empty($_GET['rec'])) ? 0 : $_GET['rec'] ;
if ($rec>'12' && $rec<'20') {
	session_start();
	if ($_SESSION["setor"]=="2" || $_SESSION["setor"]>"50" || $_SESSION["setor"]==1){
	require "../help/impressao.php";//Include de funções, classes e conexï¿½es com o BD
	if ($idIgreja==0) {
			$igrejaSelecionada = $igSede;
			//$igLanc = $igrejaSelecionada;
			$cidSede = $igrejaSelecionada;
	} else {
		$igrejaSelecionada = new DBRecord('igreja', $idIgreja, 'rol');
		$igLanc = $igrejaSelecionada;
	}
	if ($igreja->cidade()>0) {
		$cidSede = new DBRecord('cidade', $igreja->cidade(), 'id');
		$origem = $cidSede->nome();
	}else {
		$origem = $igreja->cidade();
	}
	require_once '../help/tes/receitaImprimir.php';//Opï¿½ï¿½es de  impressï¿½es para o script
	}
}else {
$ind=1;
$tabRelatorio = 'views/tesouraria/tabDizimosOfertas.php';
if ($_SESSION["setor"]=="2" || $_SESSION["nivel"]>="50" || $_SESSION["setor"]==1){
$_SESSION['lancar']=true;
$linkLancamento  = './?escolha=tesouraria/receita.php&menu=top_tesouraria';
$linkLancamento .= '&igreja='.$_GET['igreja'];

require_once 'views/tesouraria/menu.php';//Sub-Menu de links

$dizmista = new dizresp($_SESSION['valid_user'],'',$rec);
if ($idIgreja==0) {
		$igrejaSelecionada = $igSede;
		//$igLanc = $igrejaSelecionada;
} else {
	$igrejaSelecionada = new DBRecord('igreja', $idIgreja, 'rol');
	$igLanc = $igrejaSelecionada;
}
	// verifica se hï¿½ valor a ser lanï¿½ado e libera os forms
	//printf('<h1> teste %s</h1>',$teste);
	$tituloColuna5 = ($idIgreja > '1') ? 'Congrega&ccedil;&atilde;o' : 'Igreja';
	if ($_POST['concluir'] == '1') {
			$tituloColuna5 = 'Status';
			require_once 'forms/lancdizimo.php';
		} elseif ($_POST['lancar'] == '1') {
			require_once 'models/feccaixaculto.php';
		} else {
			$linkAcesso  = 'escolha=tesouraria/receita.php&menu=top_tesouraria';
			$linkAcesso .= '&rec='.$_GET['rec'].'&idDizOf='.$idDizOf.'&igreja=';
			$fin = ($_GET['fin'] < '1') ? '2' : $_GET['fin'];
			$rec = (empty($_GET['rec'])) ? 0 : $_GET['rec'];
			require_once 'help/tes/receitaTela.php';//Opções de exibição na tela a escolha
	}
} else {
	echo "<script> alert('Sem permissão de acesso! Entre em contato com o Tesoureiro!');location.href='../?escolha=adm/cadastro_membro.php&uf=PB';</script>";
	$_SESSION = array();
	session_destroy();
	header("Location: ./");
}
	unset($_SESSION['lancar']);
	if ($_SESSION["setor"]==2 || $_SESSION["setor"]>50 || $_SESSION["setor"]==1) {
		require_once $tabRelatorio;
		# code...
	}
}
?>
