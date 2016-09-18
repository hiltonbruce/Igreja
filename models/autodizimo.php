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
if (empty($_GET['igreja'])) {
	$igrejaRol = 0;
} else {
	$igrejaRol =(int)$_GET['igreja'];
}

$quantNomes = substr_count(trim($q),' ');//Quantidade de palavras

//echo '<h1>Teste: '.$_GET['teste'].'</h1>';

//crit√É¬©rios de fon√É¬©tica
//$exp = new fonetica($q,'nome');

switch ($quantNomes) {
	case '3':
	 list($q1,$q2,$q3,$q4) = explode (' ',$q);
	 $sql  = "SELECT e.congregacao,e.situacao_espiritual,m.* FROM membro AS m,";
	 $sql .= " eclesiastico AS e WHERE m.rol=e.rol AND";
	 $sql .= " m.nome LIKE '%$q1%' AND m.nome LIKE '%$q2%' AND";
	 $sql .= " m.nome LIKE '%$q3%' AND m.nome LIKE '%$q4%' ORDER BY ";
	 if ($igrejaRol>0) {
	 	$sql .= "case when e.congregacao=$igrejaRol then 0 else 1 end ASC,";
	 }
	break;
	case '2':
	 list($q1,$q2,$q3) = explode (' ',$q);
	 $sql  = "SELECT e.congregacao,e.situacao_espiritual,m.* FROM membro AS m,";
	 $sql .= " eclesiastico AS e WHERE m.rol=e.rol AND";
	 $sql .= " m.nome LIKE '%$q1%' AND m.nome LIKE '%$q2%' AND";
	 $sql .= " m.nome LIKE '%$q3%' ORDER BY ";
	 if ($igrejaRol>0) {
	 	$sql .= "case when e.congregacao=$igrejaRol then 0 else 1 end ASC,";
	 }
	break;
	case '1':
	 list($q1,$q2) = explode (' ',$q);
	 $sql  = "SELECT e.congregacao,e.situacao_espiritual,m.* FROM membro AS m,";
	 $sql .= " eclesiastico AS e WHERE m.rol=e.rol";
	 $sql .= " AND (m.nome LIKE '%$q1%' AND m.nome LIKE '%$q2%') ORDER BY ";
	 if ($igrejaRol>0) {
		 $sql .= "case when e.congregacao=$igrejaRol then 0 else 1 end ASC,";
	 }
	break;
	default:
	$q=trim($q);
	 $sql = "SELECT e.congregacao,e.situacao_espiritual,m.* FROM membro AS m,";
	 $sql .= " eclesiastico AS e WHERE";
	 $sql .= " m.rol=e.rol AND locate('$q',m.nome) > 0 ORDER BY ";
	 if ($igrejaRol>0) {
	 	$sql .= "case when e.congregacao=$igrejaRol then 0 else 1 end ASC,";
	 }
	break;
}

$res = mysql_query( $sql."locate('$q',m.nome)" );
$linhas = mysql_num_rows($res);

# 1ÔøΩlinha em branco
echo "<li onselect=\" \">... </li>\n";

while( $campo = mysql_fetch_array( $res ) )
{
	//echo "Id: {$campo['id']}\t{$campo['nomecong']}\t{$campo['estado']}<br />";
	$id = $campo['celular'];
	$rolMembro = $campo['rol'];
	//$ecles = new DBRecord ('eclesiastico',$campo ['rol'],'rol');
	$igreja = new DBRecord ('igreja',$campo ['congregacao'],'rol');
	$cargo = cargo($rolMembro);
	$nomecong = $cargo['0'].' - '.htmlentities($igreja->razao(),ENT_QUOTES,'iso-8859-1');
	switch ($campo['situacao_espiritual']) {
		case '2':
			$nomecong .= '&nbsp;<mark>Disciplinado</mark> ';
			break;
		case '3':
			$nomecong .= '&nbsp;<mark>Falecio</mark> ';
			break;
		case '4':
			$nomecong .= '&nbsp;<mark>Mudou de Igreja</mark> ';
			break;
		case '5':
			$nomecong .= '&nbsp;<mark>Afastou-se da Igreja</mark> ';
			break;
		case '6':
			$nomecong .= '&nbsp;<mark>Transferido</mark> ';
			break;
	}
	$exibiCong = strip_tags($nomecong);
	$estado = strtoupper(strtr( $campo['nome'], '·‡„‚ÈÍÌÛıÙ˙¸Á¡¿√¬… Õ”’‘⁄‹«','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
	$endereco = strtoupper(strtr( $campo ['endereco'], '·‡„‚ÈÍÌÛıÙ˙¸Á¡¿√¬… Õ”’‘⁄‹«á','AAAAEEIOOOUUCAAAAEEIOOOUUC' ));
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

	$img='../img_membros/'.$campo['rol'].'.jpg';//PHP verifica se existe
	if (!file_exists($img)){
		$img='img_membros/ver_foto.jpg';//Localiza√ß√£o p/ JavaScript
	}else{
		$img='img_membros/'.$campo['rol'].'.jpg';//Localiza√ß√£o p/ JavaScript
	}

	$html ='<img src="'.$img.'" title="Rol: '.$campo['rol'].'" style="width:24px;height:32px;"> '.$html;
	echo "<li onselect=\"this.setText('$estado').setValue('$id','$nomecong','$rolMembro','$exibiCong');\">$html ($nomecong)</li>\n";

	$quantExibir++;

	if ($quantExibir>'9') {
		break;
	}
}

if ($linhas>10) {
	echo '<p style="text-align: right;">Total de '.$linhas.' ocorr&ecirc;ncias<br />';
	echo 'S&atilde;o mostradas at&eacute; as 10 primeiras!</p>';
}

?>
