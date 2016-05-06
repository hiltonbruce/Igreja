<?php
/**
 * @author Wellington Ribeiro - IdealMind.com.br
 * @since 31/10/2009
 */
require_once '../../func_class/funcoes.php';
require_once "../../func_class/classes.php";
require_once "../../models/tes/tes_conta.class.php";
conectar();
$grupoContas = new tes_conta ();
$tituloCta = $grupoContas->contasGrupos();
$q = mysql_real_escape_string( $_GET['q'] );

$sqllinhas = "SELECT * FROM contas where locate('$q',titulo) > 0  AND acesso > '0' ";
//critérios de fonética

$reslinhas = mysql_query( $sqllinhas );
$linhas = mysql_num_rows($reslinhas);

$sql = "SELECT * FROM contas where locate('$q',titulo) > 0 AND acesso > '0' order by codigo limit 10";

$res = mysql_query( $sql );

while( $campo = mysql_fetch_array( $res ) )
{
	//echo "Id: {$campo['id']}\t{$campo['sigla']}\t{$campo['estado']}<br />";
	$id = number_format($campo['saldo'],2,',','.');
	$estado = strtr( $campo['titulo'], 'áàãâéêíóõôúüçÁÀÃÂÉÊÍÓÕÔÚÜÇ','aaaaeeiooouucAAAAEEIOOOUUC' );
	$estado = htmlentities($estado,ENT_QUOTES,'iso-8859-1');
	$endereco = strtoupper(strtr( $campo ['codigo'], 'áàãâéêíóõôúüçÁÀÃÂÉÊÍÓÕÔÚÜÇ','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
	if ($campo['tipo']=='D') {
		$tipo = 'Devedora';
	}else {
		$tipo = 'Credora';
	}
	$grupoCta4 = $tituloCta[$campo['nivel4']];
	$nomeGrp4 =  $grupoCta4['titulo'];
	$grupoCta = $tituloCta[$campo['nivel2']];
	$nomeGrp =  $grupoCta['titulo'];
	$endereco .=',  Tipo: '.$tipo;
	$sigla = $campo['acesso'];
	$detalhe = htmlentities($campo['descricao'],ENT_QUOTES,'iso-8859-1');
	$acesso = sprintf("%s - [%04s]\n", $campo['codigo'],$campo['acesso']);
	$estado = addslashes($estado);
	$html = preg_replace("/(" . $q . ")/i", "<U style='font-weight:bold'>\$1</U>", $estado);
	$estado = strtoupper(strtr( $campo['titulo'], 'áàãâéêíóõôúüç','ÁÀÃÂÉÊÍÓÕÔÚÜÇ'));
	$estado = htmlentities($estado,ENT_QUOTES,'iso-8859-1');
	echo "<li onselect=\"this.setText('$estado').setValue('$id','$endereco','$sigla','$detalhe');\">$acesso &#9679; $html ($nomeGrp &#10148; $nomeGrp4)</li>\n";
}
if ($linhas>10) {
	echo '<p style="text-align: right;">Total de '.$linhas.' ocorr&ecirc;ncias<br />';
	echo 'S&atilde;o mostradas at&eacute; as 10 primeiras!</p>';
	print_r($nomeGrp);
}
?>
