<?php
/**
 * @author Wellington Ribeiro - IdealMind.com.br
 * @since 31/10/2009
 * @final Joseilton Costa Bruce
 * @since 29/12/2011
 */
function __autoload ($classe) {
	require_once ("../models/$classe.class.php");
}
require_once '../func_class/classes.php';
require_once '../func_class/funcoes.php';
$q = mysql_real_escape_string( $_GET['q'] );

//echo '<h1>Teste: '.$_GET['teste'].'</h1>';

$sqllinhas = "SELECT * FROM membro where locate('$q',nome) > 0 ";
//critérios de fonética

$reslinhas = mysql_query( $sqllinhas );
$linhas = mysql_num_rows($reslinhas);

$sql = "SELECT * FROM membro WHERE LOCATE('$q',nome) > 0 ORDER BY LOCATE('$q',nome) LIMIT 10";

$res = mysql_query( $sql );

while( $campo = mysql_fetch_array( $res ) )
{
	//echo "Id: {$campo['id']}\t{$campo['sigla']}\t{$campo['estado']}<br />";
	$id = $campo['celular'];
	$sigla = $campo['rol'];
	$ecles = new DBRecord ('eclesiastico',$campo ['rol'],'rol');
	$igreja = new DBRecord ('igreja',$ecles->congregacao(),'rol');
	$cargo = cargo($sigla);
	$nomecong = $cargo.' - '.htmlentities($igreja->razao(),ENT_QUOTES,'iso-8859-1');
	$estado = strtoupper(strtr( $campo['nome'], 'áàãâéêíóõôúüçÁÀÃÂÉÊÍÓÕÔÚÜÇ','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
	$endereco = strtoupper(strtr( $campo ['rol'], 'áàãâéêíóõôúüçÁÀÃÂÉÊÍÓÕÔÚÜÇ','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
	//$endereco .=', '.$campo['numero'];
	$estado = addslashes($estado);
	$html = preg_replace("/(" . $q . ")/i", "<span style=\"font-weight:bold\">\$1</span>", $estado);
	echo "<li onselect=\"this.setText('$estado').setValue('$id','$sigla','$endereco','$nomecong');\">$html ($nomecong)</li>\n";
}
if ($linhas>10) {
	echo '<p style="text-align: right;">Total de '.$linhas.' ocorr&ecirc;ncias<br />';
	echo 'S&atilde;o mostradas at&eacute; as 10 primeiras!</p>';
}
?>