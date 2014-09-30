<?php
$titTabela = 'Balancete - Saldo em: '.date('d/m/Y');

if ($_GET['rec']>'12' && $_GET['rec']<'20') {
	session_start();
	if ($_SESSION["setor"]=="2" || $_SESSION["setor"]>"50"){
	require "../help/impressao.php";//Include de funcões, classes e conexões com o BD
	
	$igreja = new DBRecord ("igreja","1","rol");
	
	if ($igreja->cidade()>0) {
		$cidSede = new DBRecord('cidade', $igreja->cidade(), 'id');
		$origem = $cidSede->nome();
	}else {
		$origem = $igreja->cidade();
	}
	
	require_once '../help/tes/receitaImprimir.php';//Opções de  impressões para o script 
		
	}
}else {
$ind=1;
$tabRelatorio = 'views/tesouraria/tabDizimosOfertas.php';
if ($_SESSION["setor"]=="2" || $_SESSION["setor"]>"50"){
$_SESSION['lancar']=true;
$linkLancamento  = './?escolha=tesouraria/receita.php&menu=top_tesouraria';
$linkLancamento .= '&igreja='.$_GET['igreja'];

require_once 'views/tesouraria/menu.php';//Sub-Menu de links 

$dizmista = new dizresp($_SESSION['valid_user']);
$idIgreja = (empty($_GET['igreja'])) ? 1:(int)$_GET['igreja'];
if ((int)$_POST['rolIgreja']>0) {
	$idIgreja=$_POST['rolIgreja'];
}
$igrejaSelecionada = new DBRecord('igreja', $idIgreja, 'rol');

	// verifica se há valor a ser lançado e libera os forms
	//printf('<h1> teste %s</h1>',$teste);
	$tituloColuna5 = ($idIgreja>'1') ? 'Congregação':'Igreja';
	if ($_POST['concluir']=='1') {
			$tituloColuna5 = 'Status';
			require_once 'forms/lancdizimo.php';
		} elseif ($_POST['lancar']=='1') {
			require_once 'models/feccaixaculto.php';
		} else {
			
			$linkAcesso  = 'escolha=tesouraria/receita.php&menu=top_tesouraria';
			$linkAcesso .= '&rec='.$_GET['rec'].'&idDizOf='.$idDizOf.'&igreja=';
			
			$fin = ($_GET['fin']<'1') ? '2':$_GET['fin'];
					$rec = (empty($_GET['rec'])) ? 0:$_GET['rec'];
			
			require_once 'help/tes/receitaTela.php';//Opções de exibir na tela a escolha
	}


} else {
	echo "<script> alert('Sem permissão de acesso! Entre em contato com o Tesoureiro!');location.href='../?escolha=adm/cadastro_membro.php&uf=PB';</script>";
	$_SESSION = array();
	session_destroy();
	header("Location: ./");
}
	unset($_SESSION['lancar']);
	
	require_once $tabRelatorio;
}
?>
