<?php
/**
 * @author Wellington Ribeiro - IdealMind.com.br
 * @since 31/10/2009
 */
//Auto completar para raz�o Social dos credores cadastrados
require_once '../func_class/funcoes.php';
require_once "../func_class/classes.php";
$q = mysql_real_escape_string( $_GET['q'] );
$sqllinhas = "SELECT * FROM credores where razao LIKE '%$q%'";
//crit�rios de fon�tica

$reslinhas = mysql_query( $sqllinhas );
$linhas = mysql_num_rows($reslinhas);
//***************************************************************
//Concluir a listagem para config do formulario de contas a pagar
//***************************************************************
$sql = "SELECT * FROM credores where razao LIKE '%$q%' order by locate('$q',razao) limit 10";
$res = mysql_query( $sql );
while( $campo = mysql_fetch_array( $res ) )
{
	//echo "Id: {$campo['id']}\t{$campo['sigla']}\t{$campo['estado']}<br />";
	$id 		= $campo['id'];
	$estado 	= strtoupper(strtr( $campo['razao'], '��������������������������','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
	$endereco 	= strtoupper(strtr( $campo ['end'], '��������������������������','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
	$alias 		= htmlentities($campo['alias'], ENT_QUOTES,'ISO-8859-1');
	$sigla 		= $campo['cnpj_cpf'];
	$cpf 		= $campo['cpf'];
	$estado 	= addslashes($estado);
	$resp		= htmlentities($campo['responsavel'], ENT_QUOTES,'ISO-8859-1');
	$html 		= preg_replace("/(" . $q . ")/i", "<span style=\"font-weight:bold\">\$1</span>", $estado);
	echo "<li onselect=\"this.setText('$estado').setValue('$id','$endereco','$sigla','$resp','$alias','$cpf');\">$html ($sigla)</li>\n";
}
if ($linhas>10) {
	echo '<p style="text-align: right;">Total de '.$linhas.' ocorr&ecirc;ncias<br />';
	echo 'S&atilde;o mostradas at&eacute; as 10 primeiras!</p>';
}

?>
