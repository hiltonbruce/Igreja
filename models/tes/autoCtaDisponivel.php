<?php
/**
 * @author Wellington Ribeiro - IdealMind.com.br
 * @since 31/10/2009
 */
require_once '../../func_class/funcoes.php';
require_once "../../func_class/classes.php";

$q = mysql_real_escape_string( $_GET['q'] );

$sqllinhas  = 'SELECT * FROM contas where locate("'.$q.'",titulo) > 0  AND nivel3="1.1.1" ';
$sqllinhas .= 'AND tipo="D" AND acesso > "0" ';
//crit�rios de fon�tica

$reslinhas = mysql_query( $sqllinhas );
$linhas = mysql_num_rows($reslinhas);

$sql  = 'SELECT * FROM contas where locate("'.$q.'",titulo) > 0 AND acesso > "0" ';
$sql .= 'AND tipo="D" AND nivel3="1.1.1" order by locate(codigo,"'.$q.'") limit 10';

$res = mysql_query( $sql );
while( $campo = mysql_fetch_array( $res ) )
{
	//echo "Id: {$campo['id']}\t{$campo['sigla']}\t{$campo['estado']}<br />";
	$id = number_format($campo['saldo'],2,',','.');
	//$estado = $campo['nome'];
	$estado = htmlentities($campo['titulo'],ENT_QUOTES,'iso-8859-1');
	$endereco = strtoupper(strtr( $campo ['codigo'], '��������������������������','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
	if ($campo['tipo']=='D') {
		$tipo = 'Devedora';
	}else {
		$tipo = 'Credora';
	}
	$grupoCta = new DBRecord('contas', $campo['nivel4'], 'codigo');
	$nomeGrp =  htmlentities($grupoCta->titulo(),ENT_QUOTES,'iso-8859-1');
	$endereco .=',  Tipo: '.$tipo;
	$sigla = $campo['acesso'];
	$detalhe = htmlentities($campo['descricao'],ENT_QUOTES,'iso-8859-1');
	$acesso = sprintf("%s - [%04s]\n", $campo['codigo'],$campo['acesso']);
	$estado = addslashes($estado);
	$html = preg_replace("/(" . $q . ")/i", "<U style='font-weight:bold'>\$1</U>", $estado);
	$estado = strtoupper(strtr( $campo['titulo'], '�������������','�������������'));
	//$estado = htmlentities($estado,ENT_QUOTES,'iso-8859-1');
	echo "<li onselect=\"this.setText('$estado').setValue('$id','$endereco','$sigla','$detalhe');\">$acesso - $html ($nomeGrp)</li>\n";
}
if ($linhas>10) {
	echo '<p style="text-align: right;">Total de '.$linhas.' ocorr&ecirc;ncias<br />';
	echo 'S&atilde;o mostradas at&eacute; as 10 primeiras!</p>';
}
?>
