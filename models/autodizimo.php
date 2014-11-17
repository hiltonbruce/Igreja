<?php
/**
 * @author Wellington Ribeiro - IdealMind.com.br
 * @since 31/10/2009
 * @final Joseilton Costa Bruce
 * @since 29/12/2011
 */
require_once '../help/impressao.php';
$linha1='';$linha2='';
conectar();
$q = mysql_real_escape_string( $_GET['q'] );
$igrejaRol = mysql_real_escape_string( $_GET['igreja'] );
$quantNomes = substr_count(trim($q),' ');//Quantidade de palavras

//echo '<h1>Teste: '.$_GET['teste'].'</h1>';

//critÃ©rios de fonÃ©tica
$exp = new fonetica($q,'nome');

switch ($quantNomes) {
	case '3':
	 list($q1,$q2,$q3,$q4) = explode (' ',$q);
	 $sql = "SELECT e.congregacao,m.* FROM membro AS m, eclesiastico AS e WHERE m.rol=e.rol AND
	  m.nome LIKE '%$q1%' AND m.nome LIKE '%$q2%' AND m.nome LIKE '%$q3%' AND m.nome LIKE '%$q4%'
	  ORDER BY case when e.congregacao=$igrejaRol then 0 else 1 end ASC,LOCATE('$q1',m.nome) ";
	break;
	case '2':
	 list($q1,$q2,$q3) = explode (' ',$q);
	 $sql = "SELECT e.congregacao,m.* FROM membro AS m, eclesiastico AS e WHERE m.rol=e.rol AND
	  m.nome LIKE '%$q1%' AND m.nome LIKE '%$q2%' AND m.nome LIKE '%$q3%' ORDER BY case when e.congregacao=$igrejaRol
	  then 0 else 1 end ASC,locate('$q1',m.nome) ";
	break;
	case '1':
	 list($q1,$q2) = explode (' ',$q);
	 $sql = "SELECT e.congregacao,m.* FROM membro AS m, eclesiastico AS e WHERE m.rol=e.rol AND
	 (m.nome LIKE '%$q1%' AND m.nome LIKE '%$q2%') ORDER BY case when e.congregacao=$igrejaRol then 0 else 1 end ASC,locate('$q1',m.nome) ";
	break;

	default:
	$q=trim($q);
	$sql = "SELECT e.congregacao,m.* FROM membro AS m, eclesiastico AS e WHERE m.rol=e.rol AND
	 locate('$q',m.nome) > 0 ORDER BY case when e.congregacao=$igrejaRol then 0 else 1 end ASC,locate('$q',m.nome)";
	break;
}

$res = mysql_query( $sql );
$linhas = mysql_num_rows($res);

while( $campo = mysql_fetch_array( $res ) )
{
	//echo "Id: {$campo['id']}\t{$campo['sigla']}\t{$campo['estado']}<br />";
	$id = $campo['celular'];
	$sigla = $campo['rol'];
	$ecles = new DBRecord ('eclesiastico',$campo ['rol'],'rol');
	$igreja = new DBRecord ('igreja',$ecles->congregacao(),'rol');
	$cargo = cargo($sigla);
	$nomecong = $cargo.' - '.htmlentities($igreja->razao(),ENT_QUOTES,'iso-8859-1');
	$estado = strtoupper(strtr( $campo ['nome'], 'áàãâéêíóõôúüçÁÀÃÂÉÊÍÓÕÔÚÜÇ','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));;
	$endereco = strtoupper(strtr( $campo ['rol'],'áàãâéêíóõôúüçÁÀÃÂÉÊÍÓÕÔÚÜÇ','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
	//$endereco .=', '.$campo['numero'];
	//$estado = addslashes($estado);
	$destaque = "<span style=\"font-weight:bold\">\$1</span>";
	switch ($quantNomes) {
		case '3':
			$patterns = array("/(" . $q1 . ")/i","/(" . $q2 . ")/i","/(" . $q3 . ")/i","/(" . $q4 . ")/i");
			$replacements = array($destaque,$destaque,$destaque,$destaque);
			preg_replace($patterns, $replacements, $string);
			$html = preg_replace($patterns, $replacements, $estado);

		break;
		case '2':
			$patterns = array("/(" . $q1 . ")/i","/(" . $q2 . ")/i","/(" . $q3 . ")/i");
			$replacements = array($destaque,$destaque,$destaque);
			 preg_replace($patterns, $replacements, $string);
			$html = preg_replace($patterns, $replacements, $estado);
		break;
		case '1':
			$patterns = array("/(" . $q1 . ")/i","/(" . $q2 . ")/i");
			$replacements = array($destaque,$destaque);
			preg_replace($patterns, $replacements, $string);
			$html = preg_replace($patterns, $replacements, $estado);
		break;

		default:
			$html = preg_replace("/(" . $q . ")/i", $destaque, $estado);
		break;
	}

	if ($igrejaRol==$ecles->congregacao()) {
		$linha1 .= "<li onselect=\"this.setText('$estado').setValue('$id','$sigla','$endereco','$nomecong');\">$html ($nomecong)</li>\n";
	}else {
		$linha2 .= "<li onselect=\"this.setText('$estado').setValue('$id','$sigla','$endereco','$nomecong');\">$html ($nomecong)</li>\n";
	}

	$quantExibir++;

	if ($quantExibir>'9') {
		break;
	}
}
echo $linha1.$linha2;

	echo '<p style="text-align: right;">Total de '.$linhas.' ocorr&ecirc;ncias<br />';
	echo 'S&atilde;o mostradas at&eacute; as 10 primeiras! +++</p>';

?>
