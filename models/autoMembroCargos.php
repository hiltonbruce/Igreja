<?php
/**
 * @author Wellington Ribeiro - IdealMind.com.br
 * @since 31/10/2009
 */

require_once '../func_class/funcoes.php';
require_once '../func_class/classes.php';
conectar();
$q = mysql_real_escape_string( $_GET['q'] );

$sqllinhas  = "SELECT m.*,e.congregacao as igreja FROM membro as m,";
$sqllinhas .= "eclesiastico as e where locate('$q',nome) > 0 AND m.rol=e.rol";
//critérios de fonética

$reslinhas = mysql_query( $sqllinhas );
$linhas = mysql_num_rows($reslinhas);

$sql  = "SELECT m.*,i.razao AS igreja FROM membro as m,";
$sql .= "eclesiastico AS e, igreja AS i WHERE LOCATE('$q',nome) > 0 AND ";
$sql .= "m.rol=e.rol AND i.rol=e.congregacao order by locate('$q',nome) limit 10";

$res = mysql_query( $sql );

while( $campo = mysql_fetch_array( $res ) )
{
	//echo "Id: {$campo['id']}\t{$campo['sigla']}\t{$campo['estado']}<br />";
	$id = $campo['fone_resid'];
	//$estado = $campo['nome'];
	$estado = strtoupper(strtr( $campo['nome'], 'áàãâéêíóõôúüçÁÀÃÂÉÊÍÓÕÔÚÜÇ','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
	$endereco = strtoupper(strtr( $campo ['endereco'], 'áàãâéêíóõôúüçÁÀÃÂÉÊÍÓÕÔÚÜÇ','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
	$endereco .=', '.$campo['numero'];
	$cargo = cargo($campo['rol']);
	$cong = htmlentities($campo['igreja'],ENT_QUOTES,'iso-8859-1');
	$sigla = $cargo.' - '.htmlentities($campo['celular'],ENT_QUOTES,'iso-8859-1');
	$estado = addslashes($estado);
	$html = preg_replace("/(" . $q . ")/i", "<span style=\"font-weight:bold\">\$1</span>", $estado);
	echo "<li onselect=\"this.setText('$estado').setValue('$id','$endereco','$sigla','$cong');\">$html ($sigla $cong)</li>\n";
}
if ($linhas>10) {
	echo '<p style="text-align: right;">Total de '.$linhas.' ocorr&ecirc;ncias<br />';
	echo 'S&atilde;o mostradas at&eacute; as 10 primeiras!</p>';
}
?>