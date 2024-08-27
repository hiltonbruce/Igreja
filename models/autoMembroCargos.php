<?php
/**
 * @author Wellington Ribeiro - IdealMind.com.br
 * @since 31/10/2009
 */

require_once '../func_class/funcoes.php';
require_once '../func_class/classes.php';

$q = mysql_real_escape_string( $_GET['q'] );

$sqllinhas  = "SELECT m.*,e.congregacao AS igreja,p.cpf,p.rg,p.orgao_expedidor ";
$sqllinhas .= "FROM membro AS m,eclesiastico AS e,  profissional AS p ";
$sqllinhas .= " WHERE LOCATE('$q',nome) > 0 AND m.rol=e.rol AND m.rol=p.rol";
$sqllinhas .= " AND situacao_espiritual='1'";
//critï¿½rios de fonï¿½tica

$reslinhas = mysql_query( $sqllinhas );
$linhas = mysql_num_rows($reslinhas);

$sql  = "SELECT m.*,i.razao AS igreja,p.cpf,p.rg,p.orgao_expedidor FROM membro as m,";
$sql .= "eclesiastico AS e, profissional AS p, igreja AS i WHERE LOCATE('$q',nome) > 0 AND ";
$sql .= "situacao_espiritual='1' AND ";
$sql .= "m.rol=e.rol AND i.rol=e.congregacao AND m.rol=p.rol order by locate('$q',nome) limit 10";

$res = mysql_query( $sql );
while( $campo = mysql_fetch_array( $res ) )
{
	//echo "Id: {$campo['id']}\t{$campo['sigla']}\t{$campo['estado']}<br />";
	$id			= $campo['fone_resid']; 
	//$estado = $campo['nome'];
	$estado 	= strtoupper(strtr( $campo['nome'], 'áàãâéêíóõôúüçÁÀÃÂÉÊÍÓÕÔÚÜÇ','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
	$endereco 	= strtoupper(strtr( $campo ['endereco'], 'áàãâéêíóõôúüçÁÀÃÂÉÊÍÓÕÔÚÜÇ','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
	$endereco  .=', '.$campo['numero'];
	$rol		= $campo['rol'];
	$cargo 		= cargo($rol)['0'];
	$cpf		= $campo['cpf'];
	$rg			= $campo['rg'].' - '.$campo['orgao_expedidor'];
	$cong 		= $cargo.' - '.htmlentities($campo['igreja'],ENT_QUOTES,'iso-8859-1');
	$sigla 		= htmlentities($campo['celular'],ENT_QUOTES,'iso-8859-1');
	$estado 	= $estado;
	$html = preg_replace("/(" . $q . ")/i","<span style=\"font-weight:bold;\">\$1</span>",$estado);
	echo "<li onselect=\"this.setText('$estado').setValue('$id','$endereco','$sigla','$cong','$rol','$cpf','$rg');\">$html ($sigla $cong)</li>\n";
}
if ($linhas>10) {
	echo '<p style="text-align: right;">Total de '.$linhas.' ocorr&ecirc;ncias<br />';
	echo 'S&atilde;o mostradas at&eacute; as 10 primeiras!</p>';
}
?>
