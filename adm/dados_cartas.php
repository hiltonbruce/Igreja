<?PHP
require_once 'models/sec/consCartas.php';#Select dos dados das cartas
$tab="adm/atualizar_dados.php";//link q informa o form quem chamar p atualizar os dados
$tab_edit='adm/dados_cartas.php&tabela=carta&bsc_rol='.$bsc_rol.'&campo=';//Link de chamada da mesma p�gina para abrir o form de edi��o do item

list($diav,$mesv,$anov) = explode("/", $arr_dad["data"]);
//echo '<br />  - Data atual - ultimo Vencimento: '.$rec_alterar->data().' ---- '. ceil( (mktime() - mktime(0,0,0,$mesv,$diav,$anov))/(3600*24));
$diasemissao = ceil( (mktime() - mktime(0,0,0,$mesv,$diav,$anov))/(3600*24)); //quantidade de dias ap�s a emiss�o do recibo

if ($altEdit && $membro && $total>'0') {
	require_once 'views/secretaria/editCarta.php';
}elseif ($membro) {
	require_once 'views/secretaria/verCarta.php';
}else {
echo '<div class="alert alert-danger" role="alert">';
echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
echo ' <span class="sr-only">Error:</span>';
echo ' O Rol n&ordm;: '.$bsc_rol.' <strong> N&Atilde;O</strong> possui cadastro!';
echo '</div>';
}
?>
