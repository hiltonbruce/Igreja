<?PHP
$ind=1; //Define o indice dos campos do formulário
$id = (int) $_GET["id"];
if ($_SESSION["setor"]==2 || $_SESSION["setor"]>50 || $_SESSION["setor"]==1){
	if ($_GET['recebeu']<1 && $_GET['tipo']<1) {
	$tab="sistema/atualizar_sistema.php";//link q informa o form quem chamar p atualizar os dados
	$tab_edit='tesouraria/rec_alterar.php&menu=top_tesouraria&tabela=tes_recibo&id='.$_GET["id"].'&pag_mostra='.$_GET["pag_mostra"].'&campo=';//Link de chamada da mesma página para abrir o form de edição do item
	$rec_alterar = new DBRecord("tes_recibo", $id, "id");
	//list($anov, $mesv, $diav) = explode("-", $rec_alterar->data());
	//echo '<br />  - Data atual - ultimo Vencimento: '.$rec_alterar->data().' ---- '. ceil( (mktime() - mktime(0,0,0,$mesv,$diav,$anov))/(3600*24));
	//$diasemissao = ceil( (mktime() - mktime(0,0,0,$mesv,$diav,$anov))/(3600*24)); //quantidade de dias após a emissão do recibo

	#Verifica se o recibo j� foi lan�ado e bloqueia para altera��o
	$testLanc = ($rec_alterar->lancamento()=='' || $rec_alterar->lancamento()=='0') ? true : false;
	$testLanc = ($_SESSION["setor"]==2 || $_SESSION["setor"]>50) ? $testLanc : false;
		//Mostra informa��o do recibo n�mero n
		require_once 'views/tesouraria/verRecibo.php';
	}else {
		//echo '<h1>Recebeu --> '.$_GET['recebeu'].'</h1';
		$recBuscas ->recibosmembros();
	}
}
?>
