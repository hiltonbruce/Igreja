<?php
/**
 * @author Wellington Ribeiro - IdealMind.com.br
 * @since 31/10/2009
 */
require_once '../help/impressao.php';
$q = mysql_real_escape_string( $_GET['q'] );
$quantNomes = substr_count(trim($q),' ');
//critÔøΩrios de fonÔøΩtica
$exp = new fonetica($q,'nome');
switch ($quantNomes) {
	case '3':
	 list($q1,$q2,$q3,$q4) = explode (' ',$q);
	 $sql = "SELECT m.*,e.situacao_espiritual,e.congregacao FROM membro AS m, eclesiastico AS e where m.rol=e.rol AND nome LIKE '%$q1%' AND nome LIKE '%$q2%' AND nome LIKE '%$q3%' AND nome LIKE '%$q4%' order by locate('$q1',nome) ";
	break;
	case '2':
	 list($q1,$q2,$q3) = explode (' ',$q);
	 $sql = "SELECT m.*,e.situacao_espiritual,e.congregacao FROM membro AS m, eclesiastico AS e where m.rol=e.rol AND nome LIKE '%$q1%' AND nome LIKE '%$q2%' AND nome LIKE '%$q3%' order by locate('$q1',nome) ";
	break;
	case '1':
	 list($q1,$q2) = explode (' ',$q);
	 $sql = "SELECT m.*,e.situacao_espiritual,e.congregacao FROM membro AS m, eclesiastico AS e where m.rol=e.rol AND nome LIKE '%$q1%' AND nome LIKE '%$q2%' order by locate('$q1',nome) ";
	break;

	default:
	$sql = "SELECT m.*,e.situacao_espiritual,e.congregacao FROM membro AS m, eclesiastico AS e where m.rol=e.rol AND locate('$q',nome) > 0 order by locate('$q',nome) ";
	break;
}

$res = mysql_query( $sql );
$linhas = mysql_num_rows($res);
# 1ÔøΩlinha em branco
echo "<li onselect=\" \">... </li>\n";
while( $campo = mysql_fetch_array( $res ) )
{
	//echo "Id: {$campo['id']}\t{$campo['sigla']}\t{$campo['estado']}<br />";
	$id = $campo['fone_resid'];
	//$estado = $campo['nome'];
	$estado = strtoupper(strtr( $campo['nome'], '·‡„‚ÈÍÌÛıÙ˙¸Á¡¿√¬… Õ”’‘⁄‹«','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
	$endereco = strtoupper(strtr( $campo ['endereco'], '·‡„‚ÈÍÌÛıÙ˙¸Á¡¿√¬… Õ”’‘⁄‹«','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
	$endereco .=', '.$campo['numero'];
	$cargo = cargo($campo['rol']);
	$rol = $campo['rol'];
	$igreja = new DBRecord ('igreja',$campo ['congregacao'],'rol');
	if ($igreja->razao()=='') {
		$sigla = $cargo['0'].'- <code> Congrega&ccedil;&atilde;o&nbsp;n&atilde;o&nbsp;definida!</code> - '.$campo['celular'];
	} else {
		$sigla = $cargo['0'].' - '.htmlentities($igreja->razao().' - '.$campo['celular'],ENT_QUOTES,'iso-8859-1');
	}
	switch ($campo['situacao_espiritual']) {
		case '2':
			$sigla .= '<mark>&nbsp;Disciplinado </mark>';
			break;
		case '3':
			$sigla .= '<mark>&nbsp;Falecio </mark>';
			break;
		case '4':
			$sigla .= '<mark>&nbsp;Mudou de Igreja </mark>';
			break;
		case '5':
			$sigla .= '<mark>&nbsp;Afastou-se da Igreja </mark>';
			break;
		case '6':
			$sigla .= '&nbsp;<mark>Transferido</mark> ';
			break;
	}
	$estado = addslashes($estado);
	$destaque = "<strong>\$1</strong>";
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
			$html = preg_replace("/(" . $q . ")/i", "<strong>\$1</strong>", $estado);
		break;
	}
$img='../img_membros/'.$campo['rol'].'.jpg';//PHP verifica se existe
if (!file_exists($img)){
	$img='img_membros/ver_foto.jpg';//Localiza√ß√£o p/ JavaScript
}else{
	$img='img_membros/'.$campo['rol'].'.jpg';//Localiza√ß√£o p/ JavaScript
}
$html ='<img class="thumb" src="'.$img.'" title="Rol: '.$rol.'" style="width:24px;height:32px;"> '.$html;
echo "<li onselect=\"this.setText('$estado').setValue('$id','$endereco','$sigla','$rol');\">$html ($sigla)</li>\n";
$quantExibir++;
if ($quantExibir>'9') {
		break;
	}
}
	if ($linhas>'1') {
		$linhas .=' ocorr&ecirc;ncias';
	} else {
		$linhas .=' ocorr&ecirc;ncia';
	}
	echo '<p style="text-align: right;">Total de '.$linhas.'<br />';
	echo 'S&atilde;o mostradas at&eacute; as 10... primeiras!</p>';
?>
