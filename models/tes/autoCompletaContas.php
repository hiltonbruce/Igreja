<?php
/**
 * @author Wellington Ribeiro - IdealMind.com.br
 * @since 31/10/2009
 */
require_once '../../func_class/funcoes.php';
conectar();
$q = mysql_real_escape_string( $_GET['q'] );

$sqllinhas = "SELECT * FROM contas where locate('$q',titulo) > 0  AND acesso > '0' ";
//critérios de fonética

$reslinhas = mysql_query( $sqllinhas );
$linhas = mysql_num_rows($reslinhas);

$sql = "SELECT * FROM contas where locate('$q',titulo) > 0 AND acesso > '0' order by locate(codigo,'$q') limit 10";

$res = mysql_query( $sql );

while( $campo = mysql_fetch_array( $res ) )
{
	//echo "Id: {$campo['id']}\t{$campo['sigla']}\t{$campo['estado']}<br />";
	$id = number_format($campo['saldo'],2,',','.');
	//$estado = $campo['nome'];
	$estado = htmlentities($campo['titulo'],ENT_QUOTES,'iso-8859-1');
	$endereco = strtoupper(strtr( $campo ['codigo'], 'áàãâéêíóõôúüçÁÀÃÂÉÊÍÓÕÔÚÜÇ','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
	if ($campo['tipo']=='D') {
		$tipo = 'Devedora';
	}else {
		$tipo = 'Credora';
	}
	$endereco .=',  Tipo: '.$tipo;
	$sigla = $campo['acesso'];
	$detalhe = $campo['descricao'];
	$acesso = sprintf("%s - [%04s]\n", $campo['codigo'],$campo['acesso']);
	$estado = addslashes($estado);
	$html = preg_replace("/(" . $q . ")/i", "<span style=\"font-weight:bold\">\$1</span>", $estado);
	$estado = strtoupper(strtr( $campo['titulo'], 'áàãâéêíóõôúüç','ÁÀÃÂÉÊÍÓÕÔÚÜÇ'));
	$estado = htmlentities($estado,ENT_QUOTES,'iso-8859-1');
	echo "<li onselect=\"this.setText('$estado').setValue('$id','$endereco','$sigla','$detalhe');\">$acesso - $html</li>\n";
}
if ($linhas>10) {
	echo '<p style="text-align: right;">Total de '.$linhas.' ocorr&ecirc;ncias<br />';
	echo 'S&atilde;o mostradas at&eacute; as 10 primeiras!</p>';
}
?>