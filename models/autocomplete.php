<?php
/**
 * @author Wellington Ribeiro - IdealMind.com.br
 * @since 31/10/2009
 */

require_once '../help/impressao.php';
conectar();
$q = mysql_real_escape_string( $_GET['q'] );

$quantNomes = substr_count(trim($q),' ');

//critérios de fonética
$exp = new fonetica($q,'nome');


switch ($quantNomes) {
	case '3':
	 list($q1,$q2,$q3,$q4) = explode (' ',$q);
	 $sql = "SELECT * FROM membro where  nome LIKE '%$q1%' AND nome LIKE '%$q2%' AND nome LIKE '%$q3%' AND nome LIKE '%$q4%' order by locate('$q1',nome) ";
	break;
	case '2':
	 list($q1,$q2,$q3) = explode (' ',$q);
	 $sql = "SELECT * FROM membro where  nome LIKE '%$q1%' AND nome LIKE '%$q2%' AND nome LIKE '%$q3%' order by locate('$q1',nome) ";
	break;
	case '1':
	 list($q1,$q2) = explode (' ',$q);
	 $sql = "SELECT * FROM membro where  nome LIKE '%$q1%' AND nome LIKE '%$q2%' order by locate('$q1',nome) ";
	break;
	
	default:
	$sql = "SELECT * FROM membro where locate('$q',nome) > 0 order by locate('$q',nome) ";
	break;
}


$res = mysql_query( $sql );

$linhas = mysql_num_rows($res);

while( $campo = mysql_fetch_array( $res ) )
{
	//echo "Id: {$campo['id']}\t{$campo['sigla']}\t{$campo['estado']}<br />";
	$id = $campo['fone_resid'];
	//$estado = $campo['nome'];
	$estado = strtoupper(strtr( $campo['nome'], 'áàãâéêíóõôúüçÁÀÃÂÉÊÍÓÕÔÚÜÇ','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
	$endereco = strtoupper(strtr( $campo ['endereco'], 'áàãâéêíóõôúüçÁÀÃÂÉÊÍÓÕÔÚÜÇ','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
	$endereco .=', '.$campo['numero'];
	$cargo = cargo($campo['rol']);
	$sigla = $cargo.' - '.htmlentities($campo['celular'],ENT_QUOTES,'iso-8859-1');
	$estado = addslashes($estado);
	$destaque = "<span style=\"font-weight:bold\">\$1</span>";
	switch ($quantNomes) {
		case '3':
			$patterns = array("/(" . $q1 . ")/i","/(" . $q2 . ")/i","/(" . $q3 . ")/i","/(" . $q4 . ")/i");
			$replacements = array($destaque,$destaque,$destaque,$destaque);
			// preg_replace($patterns, $replacements, $string);
			$html = preg_replace($patterns, $replacements, $estado);
						
		break;
		case '2':
			$patterns = array("/(" . $q1 . ")/i","/(" . $q2 . ")/i","/(" . $q3 . ")/i");
			$replacements = array($destaque,$destaque,$destaque);
			// preg_replace($patterns, $replacements, $string);
			$html = preg_replace($patterns, $replacements, $estado);
		break;
		case '1':
			$patterns = array("/(" . $q1 . ")/i","/(" . $q2 . ")/i");
			$replacements = array($destaque,$destaque);
			// preg_replace($patterns, $replacements, $string);
			$html = preg_replace($patterns, $replacements, $estado);
		break;
		
		default:
			$html = preg_replace("/(" . $q . ")/i", "<span style=\"font-weight:bold\">\$1</span>", $estado);
		break;
	}
	
	echo "<li onselect=\"this.setText('$estado').setValue('$id','$endereco','$sigla');\">$html ($sigla)</li>\n";
	
	$quantExibir++;
	
	if ($quantExibir>'9') {
		break;
	}
}

	echo '<p style="text-align: right;">Total de '.$linhas.'ocorr&ecirc;ncias<br />';
	echo 'S&atilde;o mostradas at&eacute; as 10 primeiras!</p>';

	
?>